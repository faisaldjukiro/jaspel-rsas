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

        if ($role == 1) {
            $data['informasi'] = $this->db->order_by('id_informasi', 'DESC')
                                        ->get('tb_informasi')
                                        ->result_array();
        } else if ($role == 2) {
            $data['informasi'] = $this->db->order_by('id_informasi', 'DESC')
                                        ->get_where('tb_informasi', ['kd_peg' => $username])
                                        ->result_array();
        }
		$this->load->view('pages/pesan/informasi', $data);

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
    
}