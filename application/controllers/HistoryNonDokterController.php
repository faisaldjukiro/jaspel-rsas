<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HistoryNonDokterController extends CI_Controller
{
	public function __construct()
    {
        // if ($role != 10 && $role != 5) {
			parent::__construct();
			$role = $this->session->userdata('role');
			if (empty($role)) { 
				redirect('login');
			} elseif ($role != 1 && $role != 3 && $role != 4) {
				redirect('beranda');
			}
    }
	public function index()
	{
		$nama_pegawai = $this->session->userdata('nama_pegawai');
		$data['title'] = "JASA - " . (!empty($nama_pegawai) ? $nama_pegawai : "Dokter");
		$data['jasa_non_dokter'] = $this->db->order_by('id_jasa', 'DESC')
								->get_where('tb_jasa_paramedis', ['kd_peg' => $this->session->userdata('username')])
								->result_array();
		$this->load->view('pages/hasil/non-dokter', $data);

	}
	public function getRekapBydokter($kd_peg,$jenis_jasa,$bulan)
	{
		$username_session = $this->session->userdata('username');
		if ($username_session != $kd_peg) {
			$this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk melihat rincian dokter ini!');
			redirect('rincian-dokter/' . $username_session.'/'.$jenis_jasa.'/'.$bulan);
			return;
		}
		$nama_pegawai = $this->session->userdata('nama_pegawai');
		$data['title'] = "Rincian Jasa " . (!empty($nama_pegawai) ? $nama_pegawai : "Dokter");
		$data['rincian_dokter'] = $this->M_hasil->getRekapByDokter($kd_peg,$jenis_jasa,$bulan);
		$this->load->view('pages/hasil/dokter-detail', $data);
	}
	public function getRekapBynosep($nosep,$jenis_jasa,$bulan)
	{
		$data['dokter_pasien'] = $this->M_hasil->getRekapByNosep($nosep,$jenis_jasa,$bulan);
		$data['title'] = "Rincian Pasien - " . $data['dokter_pasien'][0]['nama_pasien'];
		$this->load->view('pages/hasil/dokter-pasien', $data);
	}
   
}