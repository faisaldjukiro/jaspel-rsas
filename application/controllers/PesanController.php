<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PesanController extends CI_Controller
{
	public function __construct()
    {
			parent::__construct();
			$role = $this->session->userdata('role');
			if (empty($role)) { 
				redirect('login');
			} elseif ($role != 1 && $role != 2) {
				redirect('beranda');
			}
    }
	public function index()
	{

        $role = $this->session->userdata('role');
		$nama_pegawai = $this->session->userdata('nama_pegawai');
        $username = $this->session->userdata('username');
        $data['title'] = "Informasi - " . (!empty($nama_pegawai) ? $nama_pegawai : "Dokter");
        $data['pegawai'] = $this->db->like('nama_pegawai', 'sp.')->get('tb_user')->result_array();
        if ($role == 1) {
            $data['informasi'] = $this->db->order_by('id_informasi', 'DESC')
                                        ->get_where('tb_informasi', ['status' =>'0'])    
                                        ->result_array();
        } else if ($role == 2) {
            $data['informasi'] = $this->db->order_by('id_informasi', 'DESC')
                                        ->get_where('tb_informasi', ['kd_pegawai' => $username,'status' => '0'])
                                        ->result_array();
        }
		$this->load->view('pages/pesan/informasi', $data);

	}
    public function get_unread_messages($id_informasi)
    {
        $user_kd_peg = $this->session->userdata('username');
        $this->db->where('id_informasi', $id_informasi);
        $this->db->where('read', 0);
        $this->db->where('kd_pegawai !=', $user_kd_peg);
        $unread_count = $this->db->count_all_results('tb_informasi_chat');
        echo json_encode(['count' => $unread_count]);
    }
    
    public function chating($id)
    {
        $data['title'] = "Chatting";
        $data['user_role'] = $this->session->userdata('role'); 
        $data['user_id'] = $this->session->userdata('username');
        $data['informasi'] = $this->db->get_where('tb_informasi', ['id_informasi' => $id])->row_array();
        $data['pesan'] = $this->db->order_by('id_chat', 'ASC')->get_where('tb_informasi_chat', ['id_informasi' => $id])->result_array();
    
        $this->load->view('pages/pesan/chating', $data);
    }
    
    public function kirimpesan()
    {
        date_default_timezone_set('Asia/Makassar');
        $id_informasi = $this->input->post('id_informasi');
        $kd_pegawai = $this->session->userdata('username');
        $pesan = $this->input->post('pesan');
        $tgl_pesan = date('Y-m-d H:i:s');
    
        if (!empty($pesan)) {
            $this->db->insert('tb_informasi_chat', [
                'id_informasi' => $id_informasi,
                'kd_pegawai' => $kd_pegawai,
                'pesan' => $pesan,
                'tgl_pesan' => $tgl_pesan
            ]);
        }
        redirect('chat/' . $id_informasi);
    }
    public function view_pdf($filename) {
        $file_path = FCPATH . 'berkas/' . $filename;

        if (file_exists($file_path)) {
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . basename($filename) . '"'); 
            header('Content-Length: ' . filesize($file_path));
            readfile($file_path);
            exit;
        } else {
            show_404();
        }
    }
    public function tambahInformasi()
    {
        $this->form_validation->set_rules('kd_pegawai', 'Dokter', 'required');
        $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required');
        $this->form_validation->set_rules('pesan', 'Pesan', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
    
        if ($this->form_validation->run() === FALSE) {
            echo json_encode([
                'status' => 'error',
                'message' => validation_errors()
            ]);
            return;
        } else {
            $kd_pegawai = $this->input->post('kd_pegawai');
            $nama_pasien = $this->input->post('nama_pasien');
            $tags = $this->input->post('tags');
            $pesan = $this->input->post('pesan');
            $status = $this->input->post('status');
    
            $berkas = null;
            $berkas_error = '';
    
            if (!empty($_FILES['berkas']['name'])) {
                $config['upload_path'] = 'berkas';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 2048;
         
                $this->load->library('upload', $config);
    
                $file_name = $_FILES['berkas']['name'];

                $file_path = $config['upload_path'] . '/' . $file_name;
                if (file_exists($file_path)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'File dengan nama yang sama sudah ada.'
                    ]);
                    return;
                }
                
    
                if ($this->upload->do_upload('berkas')) {
                    $upload_data = $this->upload->data();
                    $berkas = $upload_data['file_name'];
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => $this->upload->display_errors()
                    ]);
                    return;
                }
            }
            $data = array(
                'kd_pegawai' => $kd_pegawai,
                'nama_pasien' => $nama_pasien,
                'tags' => $tags,
                'pesan' => $pesan,
                'berkas' => $berkas,
                'status' => $status
            );
    
            $this->db->insert('tb_informasi', $data);
    
            echo json_encode([
                'status' => 'success',
                'message' => 'Data berhasil disimpan.'
            ]);
        }
    }
}