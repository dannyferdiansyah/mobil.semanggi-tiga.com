<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->model('web_model');
        $this->load->helper('cookie', 'form', 'url');
    }

    public function index()
    {
        $this->login();
    }

    public function login()
    {
        // Jika pengguna sudah login, arahkan ke dashboard
        if ($this->session->userdata('user_id')) {
            redirect('web');
        }

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['aplikasi'] = $this->web_model->get_aplikasi();
            $this->load->view('login/login', $data);
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $remember = $this->input->post('remember');

            $user = $this->user_model->get_user($username);

            if ($user && password_verify($password, $user->password)) {
                $this->session->set_userdata([
                    'user_id' => $user->id,
                    'level'   => $user->level
                ]);

                if ($remember) {
                    $token = bin2hex(openssl_random_pseudo_bytes(16));
                    $this->user_model->update_user_token($user->id, $token);

                    $cookie = array(
                        'name'   => 'remember_me',
                        'value'  => $token,
                        'expire' => strtotime('+30 days'), // 2 weeks
                        'secure' => TRUE
                    );
                    $this->input->set_cookie($cookie);
                }

                redirect('web');
            } else {
                $this->session->set_flashdata('error', 'Invalid username or password');
                redirect('auth/login');
            }
        }
    }

    public function register()
    {
        // Jika pengguna sudah login, arahkan ke dashboard
        $aplikasi = $this->web_model->get_aplikasi();
        $data = array(
            'aplikasi'  => $aplikasi,
            'judul_web' => 'Register - Aplikasi Pinjam Mobil',
        );

        $this->load->view('login/register', $data);
    }

    public function inputregister()
    {

        $gambar                  = $_FILES['ttd']['name']; // Nama asli file yang diunggah
        $config['upload_path']   = FCPATH . 'ttd'; // Lokasi penyimpanan
        $config['allowed_types'] = 'jpg|png|jpeg|webp|pdf'; // Jenis file yang diperbolehkan
        $config['max_size']      = '2048'; // Maksimal ukuran file dalam KB
        $config['file_name']     = $gambar; // Tetap menggunakan nama asli file
        $this->upload->initialize($config);
        $this->load->library('upload', $config); // Memuat library upload
        $this->upload->do_upload('ttd');
        $file_data = $this->upload->data();
        $file_name = $file_data['file_name'];

        $nama = htmlspecialchars($this->input->post('nama'));
        $email = htmlspecialchars($this->input->post('email'));
        $nomor = htmlspecialchars($this->input->post('nomor'));
        $jabatan = htmlspecialchars($this->input->post('jabatan'));
        $divisi = htmlspecialchars($this->input->post('divisi'));
        $username = htmlspecialchars($this->input->post('username'));
        $nik = htmlspecialchars($this->input->post('nik'));
        $password = htmlspecialchars($this->input->post('password'));
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $data = array(
            'nama_user'     => $nama,
            'email'         => $email,
            'username'      => $username,
            'jabatan'       => $jabatan,
            'divisi'        => $divisi,
            'password'      => $hash,
            'kunci'         => $password,
            'ttd'           => $file_name,
            'nik'           => $nik,
        );
        $user = $this->db->get_where('users', array('nik' => $nik))->row();
        if (isset($user)) {
            $this->session->set_flashdata('msg', 'gagal');
            redirect('auth/register');
        } else {
            $this->db->insert('users', $data);
            $this->session->set_flashdata('msg', 'success');
            redirect('auth/login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user_id');
        delete_cookie('remember_me');
        $this->session->set_flashdata('msg', 'success');
        redirect('auth/login');
    }

    public function check_remember_me()
    {
        $token = get_cookie('remember_me');
        if ($token) {
            $user = $this->user_model->get_user_by_token($token);
            if ($user) {
                $this->session->set_userdata('user_id', $user->id);
                redirect('web');
            }
        }
    }

    public function error_not_found()
    {
        $this->load->view('404_content');
    }
}
