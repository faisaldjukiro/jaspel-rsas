<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BerandaController extends CI_Controller
{
    public function __construct()
    {
		parent::__construct();
		$role = $this->session->userdata('role');
		if (empty($role)) { 
			redirect('login');
		} elseif ($role != 1 && $role != 2 && $role != 3 && $role != 4) { 
			redirect('beranda');
		}
    }
    public function index()
    {
        $data['title'] = "Beranda";
        $this->load->view('frontend/beranda',$data);
    }
              
    public function getChartDokter()
    {
        $kd_peg = $this->session->userdata('username');
        $tahun = $this->input->get('tahun');
        if (!$tahun) {
            $tahun = date("Y");
        }
        $data = $this->db->query("SELECT 
                                    SUM(CASE WHEN LEFT(bulan, 2) = '01' THEN (total_jasa - potongan) ELSE 0 END) AS '1',
                                    SUM(CASE WHEN LEFT(bulan, 2) = '02' THEN (total_jasa - potongan) ELSE 0 END) AS '2',
                                    SUM(CASE WHEN LEFT(bulan, 2) = '03' THEN (total_jasa - potongan) ELSE 0 END) AS '3',
                                    SUM(CASE WHEN LEFT(bulan, 2) = '04' THEN (total_jasa - potongan) ELSE 0 END) AS '4',
                                    SUM(CASE WHEN LEFT(bulan, 2) = '05' THEN (total_jasa - potongan) ELSE 0 END) AS '5',
                                    SUM(CASE WHEN LEFT(bulan, 2) = '06' THEN (total_jasa - potongan) ELSE 0 END) AS '6',
                                    SUM(CASE WHEN LEFT(bulan, 2) = '07' THEN (total_jasa - potongan) ELSE 0 END) AS '7',
                                    SUM(CASE WHEN LEFT(bulan, 2) = '08' THEN (total_jasa - potongan) ELSE 0 END) AS '8',
                                    SUM(CASE WHEN LEFT(bulan, 2) = '09' THEN (total_jasa - potongan) ELSE 0 END) AS '9',
                                    SUM(CASE WHEN LEFT(bulan, 2) = '10' THEN (total_jasa - potongan) ELSE 0 END) AS '10',
                                    SUM(CASE WHEN LEFT(bulan, 2) = '11' THEN (total_jasa - potongan) ELSE 0 END) AS '11',
                                    SUM(CASE WHEN LEFT(bulan, 2) = '12' THEN (total_jasa - potongan) ELSE 0 END) AS '12'
                                FROM tb_jasa_dokter_spesialis
                                WHERE kd_peg = ? AND RIGHT(bulan, 4) = ?
                                GROUP BY RIGHT(bulan, 4)", [$kd_peg, $tahun])->row_array();

        for ($i = 1; $i <= 12; $i++) {
            if (!isset($data[$i])) {
                $data[$i] = 0;
            }
        }
        echo json_encode($data);
    }
    public function getChartNonDokter()
    {
        $kd_peg = $this->session->userdata('username');
        $tahun = $this->input->get('tahun');
        if (!$tahun) {
            $tahun = date("Y");
        }
        $data = $this->db->query("SELECT 
                                    SUM(CASE WHEN LEFT(bulan, 2) = '01' THEN (total_jasa - potongan) ELSE 0 END) AS '1',
                                    SUM(CASE WHEN LEFT(bulan, 2) = '02' THEN (total_jasa - potongan) ELSE 0 END) AS '2',
                                    SUM(CASE WHEN LEFT(bulan, 2) = '03' THEN (total_jasa - potongan) ELSE 0 END) AS '3',
                                    SUM(CASE WHEN LEFT(bulan, 2) = '04' THEN (total_jasa - potongan) ELSE 0 END) AS '4',
                                    SUM(CASE WHEN LEFT(bulan, 2) = '05' THEN (total_jasa - potongan) ELSE 0 END) AS '5',
                                    SUM(CASE WHEN LEFT(bulan, 2) = '06' THEN (total_jasa - potongan) ELSE 0 END) AS '6',
                                    SUM(CASE WHEN LEFT(bulan, 2) = '07' THEN (total_jasa - potongan) ELSE 0 END) AS '7',
                                    SUM(CASE WHEN LEFT(bulan, 2) = '08' THEN (total_jasa - potongan) ELSE 0 END) AS '8',
                                    SUM(CASE WHEN LEFT(bulan, 2) = '09' THEN (total_jasa - potongan) ELSE 0 END) AS '9',
                                    SUM(CASE WHEN LEFT(bulan, 2) = '10' THEN (total_jasa - potongan) ELSE 0 END) AS '10',
                                    SUM(CASE WHEN LEFT(bulan, 2) = '11' THEN (total_jasa - potongan) ELSE 0 END) AS '11',
                                    SUM(CASE WHEN LEFT(bulan, 2) = '12' THEN (total_jasa - potongan) ELSE 0 END) AS '12'
                                FROM tb_jasa_paramedis
                                WHERE kd_peg = ? AND RIGHT(bulan, 4) = ?
                                GROUP BY RIGHT(bulan, 4)", [$kd_peg, $tahun])->row_array();

        for ($i = 1; $i <= 12; $i++) {
            if (!isset($data[$i])) {
                $data[$i] = 0;
            }
        }
        echo json_encode($data);
    }


    
    public function checkOldPassword()
    {
        $id_user = $this->input->post('id_user');
        $old_password = md5($this->input->post('old_password'));
        $user = $this->db->get_where('tb_user', ['id_user' => $id_user])->row();

        if (!$user) {
            echo json_encode(['status' => 'error', 'message' => 'User tidak ditemukan.']);
            return;
        }

        if ($user->password !== $old_password) {
            echo json_encode(['status' => 'error', 'message' => 'Password lama salah.']);
            return;
        }

        echo json_encode(['status' => 'success', 'message' => 'Password lama benar.']);
    }

    public function changePassword()
    {
        $id_user = $this->input->post('id_user');
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');

        if ($new_password !== $confirm_password) {
            echo json_encode(['status' => 'error', 'message' => 'Konfirmasi password tidak cocok.']);
            return;
        }
        $update = $this->db->where('id_user', $id_user)->update('tb_user', ['password' => md5($new_password)]);

        if ($update) {
            echo json_encode(['status' => 'success', 'message' => 'Password berhasil diubah.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengubah password.']);
        }
    }


    
    
}