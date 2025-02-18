<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('beranda');
        }
        $data['title'] = "Login";
        $this->load->view('login/login', $data);
    }
    public function proses_login()
    {
        $username = $this->input->post('username', TRUE);
        $password = md5($this->input->post('password', TRUE));
        $captcha_input = $this->input->post('captcha', TRUE);
        $captcha_session = $this->session->userdata('captcha');

        if ($captcha_input !== $captcha_session) {
            $this->session->set_flashdata('error', 'CAPTCHA salah!');
            redirect('login');
        }

        // Query untuk validasi user
        $query = $this->db->query("SELECT * FROM tb_user WHERE username = ?", [$username]);
        $user = $query->row();

        if (!$user) {
            $this->session->set_flashdata('error', 'KODE PEG tidak terdaftar!');
        } elseif ($user->status == 'No') {
            $this->session->set_flashdata('error', 'KODE PEG tidak aktif, hubungi IT RSAS!');
        } elseif ($user->password !== $password) {
            $this->session->set_flashdata('error', 'Password salah!');
        } else {
            $sess_data = [
                'id_user'   => $user->id_user,
                'username'  => $user->username,
                'role'      => $user->role,
                'nama_pegawai' => $user->nama_pegawai,
                'logged_in' => TRUE
            ];
            $this->session->set_userdata($sess_data);
            redirect('beranda');
        }
        
        redirect('login');
    }

    public function captcha()
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
    $captchaText = substr(str_shuffle($characters), 0, 6); // Ambil 6 karakter acak
    $this->session->set_userdata('captcha', $captchaText);
    $image = imagecreate(150, 50);
    $bgColor = imagecolorallocate($image, 240, 240, 240); // Warna latar belakang
    $textColor = imagecolorallocate($image, 50, 50, 50); // Warna teks
    $lineColor = imagecolorallocate($image, 100, 100, 100); // Warna garis acak

    // Tambahkan garis acak sebagai gangguan
    for ($i = 0; $i < 5; $i++) {
        imageline($image, rand(0, 150), rand(0, 50), rand(0, 150), rand(0, 50), $lineColor);
    }

    // Tambahkan teks CAPTCHA ke gambar
    imagestring($image, 5, 40, 15, $captchaText, $textColor);

    // Kirim gambar sebagai output
    header("Content-type: image/png");
    imagepng($image);
    imagedestroy($image);
}
    
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
    
    
}