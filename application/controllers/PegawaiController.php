<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PegawaiController extends CI_Controller
{
	public function __construct()
    {
        // if ($role != 10 && $role != 5) {
			parent::__construct();
			$role = $this->session->userdata('role');
			if (empty($role)) { 
				redirect('login');
			} elseif ($role != 1 && $role != 3) { 
				redirect('beranda');
			}
    }
	public function getPegawai()
	{
		$data['title'] = "Data Pegawai";
		$data['pengurangan'] = $this->db->get('tb_pengurangan')->result_array();
		$data['datapegawai'] = $this->db->query("SELECT * FROM data_pegawai LEFT JOIN tb_pengurangan ON data_pegawai.id_pengurangan = tb_pengurangan.id_pengurangan")->result_array();
		$data['kelompok_pegawai'] = $this->db->query('SELECT DISTINCT kelompok_pegawai FROM data_pegawai')->result_array();
		$data['sub_kelompok_pegawai'] = $this->db->query('SELECT DISTINCT sub_kelompok_pegawai FROM data_pegawai ORDER BY sub_kelompok_pegawai ASC')->result_array();
		$this->load->view('data-pegawai', $data);
	}
	public function getPorsi()
	{
		$data['title'] = "Porsi Jasa Paramedis";
		$data['dataporsi'] = $this->db->get('porsi_jasa_pegawai')->result_array();
		$this->load->view('pages/paramedis/porsi', $data);
	}
	public function getRekapParamedis()
	{
		$data['title'] = "Jasa Semua";
		$data['rekapJasaParamedis'] = $this->db->get('simulasi_jasa_finish')->result_array();
		$this->load->view('pages/paramedis/rekap_jasa', $data);
	}
	public function getRekapParamedisFilter($grup = 'all', $ruangan = 'all')
	{
		$data['title'] = "Jasa Pegawai";
	
		$grup = urldecode($grup);
		$ruangan = urldecode($ruangan);
		$grup = str_replace('+', ' ', $grup);
		$ruangan = str_replace('+', ' ', $ruangan);
	
		$this->db->select('*');
		$this->db->from('simulasi_jasa_finish');
		if ($grup !== 'all' && !empty($grup)) {
			$this->db->where('grup', $grup);
		}
		if ($ruangan !== 'all' && !empty($ruangan)) {
			$this->db->where('ruangan', $ruangan);
		}
		$query = $this->db->get();
		$data['rekapJasaParamedisFillter'] = $query->result_array();
		$data['total_sisa_jasa'] = array_sum(array_column($data['rekapJasaParamedisFillter'], 'sisa_jasa_pegawai'));
	
		$data['grup'] = $this->db->query("SELECT DISTINCT grup FROM simulasi_jasa_finish ORDER BY grup ASC")->result_array();
		$data['ruangan'] = $this->db->query("SELECT DISTINCT ruangan FROM simulasi_jasa_finish ORDER BY ruangan ASC")->result_array();
	
		$this->load->view('pages/paramedis/rekap_all', $data);
	}
	

	public function simpanporsi() {
		$id = $this->input->post('id');
		$total_jasa = $this->input->post('total_jasa');
		$kebersamaan = $this->input->post('kebersamaan'); 
		$angka_kebersamaan = $this->input->post('angka_kebersamaan'); 
	
		if ($id && $total_jasa !== '' && $kebersamaan !== '' && $angka_kebersamaan !== '') {
			$data = array(
				'total_jasa' => $total_jasa,
				'kebersamaan' => $kebersamaan,
				'angka_kebersamaan' => $angka_kebersamaan
			);
	
			$this->db->where('id_porsi', $id);
			$update = $this->db->update('porsi_jasa_pegawai', $data);
	
			if ($update) {
				echo json_encode(array('status' => 'success', 'message' => 'Data berhasil diperbarui!'));
			} else {
				echo json_encode(array('status' => 'error', 'message' => 'Gagal memperbarui data.'));
			}
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'Data tidak lengkap.'));
		}
	}
	
	
	public function tarikDatapegawai()
	{
		$this->db->query("DELETE FROM data_pegawai");
        $url = "https://ws.rsaloeisaboe-gorontalokota.com/pegawai/api.php";
		$json = file_get_contents($url);
		$response = json_decode($json, true);

		if ($response['status'] == 'success') {
			$pegawai_data = [];
			foreach ($response['data'] as $pegawai) {
				$pegawai_data[] = [
					'id'                    => $pegawai['id'],
					'nama_pegawai'          => $pegawai['nama_pegawai'],
					'jabatan'               => $pegawai['jabatan'],
					'tmt'                   => $pegawai['tmt'],
					'pendidikan_formal'     => $pegawai['pendidikan_formal'],
					'pendidikan_non_formal' => $pegawai['pendidikan_non_formal'],
					'kelompok_pegawai'      => $pegawai['kelompok_pegawai'],
					'sub_kelompok_pegawai'  => $pegawai['sub_kelompok_pegawai'],
					'gaji_pokok'            => $pegawai['gaji_pokok'],
					'pengali_performance'   => $pegawai['pengali_performance'],
					'no_rekening'           => $pegawai['no_rekening'],
					'nama_bank'             => $pegawai['nama_bank'],
					'verif'                 => $pegawai['verif'],
					'kd_peg'                => $pegawai['kd_peg'],
					'id_pengurangan'        => 16
				];
			}

			if (!empty($pegawai_data)) {
				$this->db->empty_table('data_pegawai');
				$this->db->insert_batch('data_pegawai', $pegawai_data);
				$update_mappings = [
					'Manajemen-Casemix' => [
						'USMAN BARUADI', 'MAIMUN LAHABU', 'APRIS DALI', 'DWI MAGISTA CAHYANINGSIH USMAN. S.Kom',
						'SRI FAJRI MAHANI, A.Md', 'DWI FEBRIYANTI L. M. BASIMAN, A.Md.RMIK', 'NOVIYANTI AHMAD',
						'DIDIT SETIADI GANI', 'MAYA MAHMUD', 'SEVTIANSI R. ADIKO', 'AMINA HULALATA',
						'RAHMAWATY POLAMOLO, SKM.,M.Kes', 'KASMIANTI,A.Md.PK'
					],
					'Manajemen-Kabid' => [
						'ABDUL RAFID J. A. PAKAI, SE.,MM', 'MOHAMAD TAUFIK DUNGGA, S.IP.,M.Si',
						'TITIEK S. WANTOGIA, SH', 'DIAN AFFIANTI NADJAMUDIN, S.Kep.Ns',
						'FONNY LAMBA, S.Kep.Ns', 'EVARIYANTI KATILI, S.KM'
					],
					'Manajemen-SPI' => [
						'RIO FRANSISCO H. PADU, SH', 'NOVITA LAMATO, A.Md'
					],
					'Manajemen-TK' => [
						'dr. JEFRI MUSTAPA, MP.H', 'MURYATI ROKANI, S.Kep.Ns.,M.Kep', 'ERAWATY H. KARIM, S.Pd.,M.AP',
						'MOHAMAD RIFAI HIOLA, S.Kom', 'RULAN POBI, SH', 'YULFAN ANGGOWA, S.KM', 'MEMY S. BEMPAH, SKM',
						'YANTO YOESOEF PONTOH, SE', 'IRAMAYA ERAKU, SE', 'NURHAYATI F. NASIBU, SE',
						'RAHMAWATY MONOARFA, SE', 'ARIFSANDI SUPARNO TOME, S.KM', 'RAHMAN LUAWO, S.ST'
					]
				];
				foreach ($update_mappings as $kelompok => $nama_pegawai_list) {
					$this->db->where_in('nama_pegawai', $nama_pegawai_list);
					$this->db->update('data_pegawai', ['kelompok_pegawai' => $kelompok]);
				}
				echo "Data berhasil diperbarui dan kelompok_pegawai telah diperbarui!";
				return redirect('data-pegawai');
				
			} else {
				echo "Tidak ada data untuk dimasukkan.";
			}
		} else {
			echo "Gagal mengambil data dari API.";
		}

	}
	public function updatePegawai()
	{
		$id = $this->input->post('id');
		$data = [
			'pendidikan_non_formal' => $this->input->post('pendidikan_non_formal'),
			'pengali_performance' => $this->input->post('pengali_performance'),
			'id_pengurangan' => $this->input->post('id_pengurangan')
		];

		$this->db->where('id', $id);
		$update = $this->db->update('data_pegawai', $data);

		if ($update) {
			echo json_encode(["status" => "success"]);
		} else {
			echo json_encode(["status" => "error"]);
		}
	}


}