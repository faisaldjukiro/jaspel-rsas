<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekapController extends CI_Controller
{
	public function __construct()
    {
        // if ($role != 10 && $role != 5) {
		parent::__construct();
		$role = $this->session->userdata('role');
		if (empty($role)) { 
			redirect('login');
		} elseif ($role != 1 && $role != 2) { 
			redirect('beranda');
		}
    }

	public function getRekap()
	{
		$data['title'] = "Rincian Dokter";
		$this->load->view('rekap', $data);
	}
	public function getRekapBynosep($nosep)
	{
		$data['title'] = "Rincian Dokter / Pasien";
		$data['dokter_pasien'] = $this->M_rekap->getRekapByNosep($nosep);
		$this->load->view('pages/rekap-dokter-pasien', $data);
	}

	public function getRekapBydokter($dokter)
	{
		$dokter = urldecode($dokter);
		$data['title'] = "Rincian / Dokter";
		$data['dokter_pasien'] = $this->M_rekap->getRekapByDokter($dokter);
		$this->load->view('pages/rekap-dokter-detail', $data);
	}
	public function rekapDokter()
	{
		$data['title'] = "Rekap Dokter";
		$data['rekap_dokter'] = $this->M_rekap->rekapDokter();
		$this->load->view('pages/rekap-dokter', $data);
	}
	public function getRinciandokter()
	{
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$cari = $this->input->post('caridata');
		if (!empty($cari)) {
			$cari = $this->db->escape_str($cari);
		} else {
			$cari = '';
		}
		if (!empty($cari)) {
			$this->db->group_start();
			$this->db->like('data_fix.nosep', $cari);
			$this->db->or_like('data_fix.nama', $cari);
			$this->db->or_like('data_fix.dokter', $cari);
			$this->db->or_like('data_fix.kasus', $cari);
			$this->db->or_like('data_fix.rawat', $cari);
			$this->db->group_end();
		}

		$this->db->limit($length, $start);
		$data = $this->M_rekap->getRekap();
		$totalbaris = $this->_hitungcari($cari);
		$output = array(
			"draw" => $draw,
			"recordsTotal" => $totalbaris,
			"recordsFiltered" => $totalbaris,
			"data" => $data
		);
		echo json_encode($output);
	}

	public function rekapSemua()
	{
		$data['title'] = "Rekap Jasa Semua";
		$data['semua_jasa'] = $this->M_rekap->getRekapSemua();
		$this->load->view('pages/rekap-semua', $data);
	}

	public function _hitungcari($cari)
	{
		$this->db->from('data_fix');
		$this->db->join('index_layanan AS i', 'data_fix.kd_dpjp = i.nama', 'left');
		$this->db->join('kasus AS k', 'data_fix.id_kasus = k.id_kasus', 'left');
		$this->db->join('index_dpjp as d', 'data_fix.id_dpjp = d.id_dpjp', 'left');

		if (!empty($cari)) {
			$this->db->group_start();
			$this->db->like('data_fix.nosep', $cari);
			$this->db->or_like('data_fix.nama', $cari);
			$this->db->or_like('data_fix.dokter', $cari);
			$this->db->or_like('data_fix.kasus', $cari);
			$this->db->or_like('data_fix.rawat', $cari);
			$this->db->group_end();
		}
		return $this->db->count_all_results();
	}


	

	private function getJumlahJasa($row)
	{
		if ($row['kd_dpjp'] == 'dpjp_utama') {
			return format_rupiah($row['jasa_dpjp_utama']);
		} elseif ($row['kd_dpjp'] == 'dpjp2_dst') {
			return format_rupiah($row['jasa_dpjp2_dst']);
		} elseif ($row['kd_dpjp'] == 'jasa operasi') {
			return format_rupiah($row['jasa_operator']);
		} elseif ($row['kd_dpjp'] == 'jasa anestesi') {
			return format_rupiah($row['jasa_anestesi']);
		} elseif (in_array($row['kd_dpjp'], ['LAB', 'LAB PA', 'FOTO', 'USG', 'RAD KONTRAS', 'CT - SCAN', 'MRI', 'KONSUL'])) {
			return format_rupiah($row['penunjang']);
		}
		return 'Tidak ada jasa yang cocok';
	}
}