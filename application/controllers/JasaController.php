<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JasaController extends CI_Controller
{
	public function __construct()
    {
        // if ($role != 10 && $role != 5) {
			parent::__construct();
			$role = $this->session->userdata('role');
			if (empty($role)) { 
				redirect('login');
			} elseif ($role != 1) { 
				redirect('beranda');
			}
			
    }
	public function index()
	{
		$data['title'] = "Data Awal";
		$this->load->view('data-sim', $data);
	}
	public function getDatakosong()
	{
		$data['title'] = "Data Kosong";
		$data['datakosong'] = $this->M_jasa->getDatakosong();
		$this->load->view('pages/data-kosong', $data);
	}
	public function getTindakanird()
	{
		$data['title'] = "IRD Tidak Lengkap";
		$data['tindakanird'] = $this->M_jasa->getIrd();
		$this->load->view('pages/cek-tindakan-ird', $data);
	}
	public function getTindakanpoli()
	{
		$data['title'] = "Poliklinik Tidak Lengkap";
		$data['tindakanpoli'] = $this->M_jasa->getPoliklinik();
		$this->load->view('pages/cek-tindakan-poli', $data);
	}
	public function getKasuskosong()
	{
		$data['title'] = "Kasus Kosong";
		$data['kasuskosong'] = $this->M_jasa->getKasuskosong();
		$this->load->view('pages/kasus-kosong', $data);
	}
	public function getLayanankosong()
	{
		$data['title'] = "Layanan Kosong";
		$data['layanankosong'] = $this->M_jasa->getLayanankosong();
		$this->load->view('pages/layanan-kosong', $data);
	}
	public function getDpjpkosong()
	{
		$data['title'] = "Dpjp Kosong";
		$data['dpjpkosong'] = $this->M_jasa->getDpjpKosong();
		$this->load->view('pages/cek-dpjp-kosong', $data);
	}

	public function getDatasim()
	{
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$cari = $this->input->post('caridata');
		$this->db->like('no_fpk', $cari);
		$this->db->or_like('nosep', $cari);
		$this->db->or_like('nama', $cari);
		$this->db->or_like('dokter', $cari);
		$this->db->or_like('tindakan', $cari);
		$this->db->or_like('kode', $cari);
		$this->db->limit($length, $start);
		$query = $this->db->get('data_awal');
		$data = $query->result_array();
		$totalbaris = $this->db->count_all('data_awal');
		$output = array(
			"draw" => $draw,
			"recordsTotal" => $totalbaris,
			"recordsFiltered" => $totalbaris,
			"data" => $data
		);
		echo json_encode($output);
	}
	public function duplicate_data()
	{
		if ($this->input->post('nosep')) {
			$nosep = $this->input->post('nosep');
			$existing_data = $this->M_jasa->get_data_by_nosep_and_dpjp($nosep, 'dpjp_utama');
			if ($existing_data) {
				$new_data = array(
					'tgl_trans' => $existing_data['tgl_trans'],
					'noreg' => $existing_data['noreg'],
					'tgl_masuk' => $existing_data['tgl_masuk'],
					'tgl_keluar' => $existing_data['tgl_keluar'],
					'nocm' => $existing_data['nocm'],
					'nosep' => $existing_data['nosep'],
					'nama' => $existing_data['nama'],
					'rawat' => $existing_data['rawat'],
					'layanan' => $existing_data['layanan'],
					'komponen' => $existing_data['komponen'],
					'dokter' => $existing_data['dokter'],
					'keterangan' => 'PEMERIKSAAN DOKTER SPESIALIS RAWAT JALAN',
					'tindakan' => 'PEMERIKSAAN DOKTER SPESIALIS RAWAT JALAN',
					'total' => 15400,
					'ruangan' => $existing_data['ruangan'],
					'kasus' => $existing_data['kasus'],
					'kd_dpjp' => $existing_data['kd_dpjp']
				);
				$insert_result = $this->M_jasa->insert_data_sim($new_data);

				if ($insert_result) {
					echo "Data berhasil disalin dan diperbarui!";
				} else {
					echo "Gagal menyalin data!";
				}
			} else {
				echo "Data tidak ditemukan!";
			}
		} else {
			echo "Nosep tidak ditemukan!";
		}
	}
	public function duplicate_dataIrd()
	{
		if ($this->input->post('nosep')) {
			$nosep = $this->input->post('nosep');
			$existing_data = $this->M_jasa->get_data_by_nosep_and_dpjp($nosep, 'dpjp_utama');
			if ($existing_data) {
				$new_data = array(
					'tgl_trans' => $existing_data['tgl_trans'],
					'noreg' => $existing_data['noreg'],
					'tgl_masuk' => $existing_data['tgl_masuk'],
					'tgl_keluar' => $existing_data['tgl_keluar'],
					'nocm' => $existing_data['nocm'],
					'nosep' => $existing_data['nosep'],
					'nama' => $existing_data['nama'],
					'rawat' => $existing_data['rawat'],
					'layanan' => $existing_data['layanan'],
					'komponen' => $existing_data['komponen'],
					'dokter' => $existing_data['dokter'],
					'keterangan' => 'PEMERIKSAAN DOKTER UMUM RAWAT DARURAT',
					'tindakan' => 'PEMERIKSAAN DOKTER UMUM RAWAT DARURAT',
					'total' => 18480,
					'ruangan' => $existing_data['ruangan'],
					'kasus' => $existing_data['kasus'],
					'kd_dpjp' => $existing_data['kd_dpjp']
				);
				$insert_result = $this->M_jasa->insert_data_sim($new_data);

				if ($insert_result) {
					echo "Data berhasil disalin dan diperbarui!";
				} else {
					echo "Gagal menyalin data!";
				}
			} else {
				echo "Data tidak ditemukan!";
			}
		} else {
			echo "Nosep tidak ditemukan!";
		}
	}
}