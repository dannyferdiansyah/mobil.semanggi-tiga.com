<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Web extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('cookie');
        $this->load->model('user_model');
        $this->load->model('web_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('cookie', 'form', 'url');

        // Check if the user is logged in
        if (!$this->session->userdata('user_id')) {
            $remember_me = get_cookie('remember_me');
            if ($remember_me) {
                $user = $this->user_model->get_user_by_token($remember_me);
                if ($user) {
                    $this->session->set_userdata('user_id', $user->id);
                } else {
                    redirect('auth/login');
                }
            } else {
                redirect('auth/login');
            }
        }
    }


    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        $user = $this->user_model->get_user_by_id($user_id);
        $aplikasi = $this->web_model->get_aplikasi();
        $this->db->from('peminjaman');
        $this->db->where_in('status', array('Menunggu ACC Manajer Bagian', 'Menunggu ACC Bagian Umum', 'Menunggu Input Mobil'));
        $this->db->order_by('tanggal_pengajuan', 'desc');
        $peminjaman = $this->db->get();

        $this->db->from('peminjaman');
        $this->db->where('status', 'Menunggu ACC Manajer Bagian');
        $this->db->order_by('tanggal_pengajuan', 'desc');
        $this->db->limit('4');
        $notif = $this->db->get();

        $this->db->from('peminjaman');
        $this->db->where('status', 'Menunggu Input Mobil');
        $this->db->order_by('tanggal_pengajuan');
        $jmlinput = $this->db->get()->num_rows();

        $this->db->from('peminjaman');
        $this->db->where('status', 'Selesai');
        $this->db->order_by('tanggal_pengajuan');
        $jmlselesai = $this->db->get()->num_rows();
        $data = array(
            'user' => $user,
            'aplikasi'  => $aplikasi,
            'judul_web' => 'Dashboard - Aplikasi Keuangan',
            'peminjaman' => $peminjaman,
            'notif'     => $notif,
            'jmlinput'  => $jmlinput,
            'jmlselesai' => $jmlselesai,
        );


        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('page/beranda', $data);
        $this->load->view('layout/footer', $data);
    }

    public function manajemenuser()
    {
        $user_id = $this->session->userdata('user_id');
        $user = $this->user_model->get_user_by_id($user_id);
        $users = $this->user_model->get_users();
        $aplikasi = $this->web_model->get_aplikasi();
        $this->db->from('peminjaman');
        $this->db->where('status', 'Menunggu ACC Manajer Bagian');
        $this->db->order_by('tanggal_pengajuan', 'desc');
        $this->db->limit('4');
        $notif = $this->db->get();

        $this->db->from('peminjaman');
        $this->db->where('status', 'Menunggu Input Mobil');
        $this->db->order_by('tanggal_pengajuan');
        $jmlinput = $this->db->get()->num_rows();

        $this->db->from('peminjaman');
        $this->db->where('status', 'Selesai');
        $this->db->order_by('tanggal_pengajuan');
        $jmlselesai = $this->db->get()->num_rows();

        $data = array(
            'user' => $user,
            'aplikasi'  => $aplikasi,
            'judul_web' => 'Dashboard - Aplikasi Keuangan',
            'users'     => $users,
            'notif'     => $notif,
            'jmlinput'  => $jmlinput,
            'jmlselesai' => $jmlselesai,
        );
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('page/user', $data);
        $this->load->view('layout/footer', $data);
    }

    public function create_user()
    {

        $password =  $this->input->post('password');
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $data = array(
            'nama_user' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password'  => $hash,
            'sandi'     => $password,
            'level'     => $this->input->post('level'),
        );

        if ($this->web_model->create_user($data)) {
            // Redirect to success page or load success view
            $this->session->set_flashdata('msg', 'success');
            redirect('web/manajemenuser');
        } else {
            // Handle error
            $this->session->set_flashdata('msg', 'gagal');
            redirect('web/manajemenuser');
        }
    }

    public function delete_user($id)
    {
        if ($this->web_model->delete_user($id)) {
            $this->session->set_flashdata('msg', 'success');
            redirect('web/manajemenuser');
        } else {
            $this->session->set_flashdata('msg', 'gagal');
            redirect('web/manajemenuser');
        }
    }

    public function datamobil()
    {
        $user_id = $this->session->userdata('user_id');
        $user = $this->user_model->get_user_by_id($user_id);
        $users = $this->user_model->get_users();
        $aplikasi = $this->web_model->get_aplikasi();
        $datamobil = $this->db->get('kendaraan');
        $this->db->from('peminjaman');
        $this->db->where('status', 'Menunggu ACC Manajer Bagian');
        $this->db->order_by('tanggal_pengajuan', 'desc');
        $this->db->limit('4');
        $notif = $this->db->get();

        $this->db->from('peminjaman');
        $this->db->where('status', 'Menunggu Input Mobil');
        $this->db->order_by('tanggal_pengajuan');
        $jmlinput = $this->db->get()->num_rows();

        $this->db->from('peminjaman');
        $this->db->where('status', 'Selesai');
        $this->db->order_by('tanggal_pengajuan');
        $jmlselesai = $this->db->get()->num_rows();
        $data = array(
            'user' => $user,
            'aplikasi'  => $aplikasi,
            'judul_web' => 'Dashboard - Aplikasi Keuangan',
            'users'     => $users,
            'datamobil' => $datamobil,
            'notif'     => $notif,
            'jmlinput'  => $jmlinput,
            'jmlselesai' => $jmlselesai,
        );
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('page/datamobil', $data);
        $this->load->view('layout/footer', $data);
    }

    public function inputmobil($id)
    {
        $jenis_kendaraan = htmlspecialchars($this->input->post('jenis_kendaraan'));
        $data = array(
            'id_mobil'   => $jenis_kendaraan,
            'status'       => 'Menunggu Keberangkatan',
        );

        $this->db->update('peminjaman', $data, ['kode' => $id]);
        $this->session->set_flashdata('msg', 'success');
        redirect('web/datapinjammobil/' . $id);
    }

    public function pinjammobil()
    {
        $user_id = $this->session->userdata('user_id');
        $user = $this->user_model->get_user_by_id($user_id);
        $users = $this->user_model->get_users();
        $aplikasi = $this->web_model->get_aplikasi();
        $mobil = $this->db->get('kendaraan');
        $this->db->from('peminjaman');
        $this->db->where('status', 'Menunggu ACC Manajer Bagian');
        $this->db->order_by('tanggal_pengajuan', 'desc');
        $this->db->limit('4');
        $notif = $this->db->get();

        $this->db->from('peminjaman');
        $this->db->where('status', 'Menunggu Input Mobil');
        $this->db->order_by('tanggal_pengajuan');
        $jmlinput = $this->db->get()->num_rows();

        $this->db->from('peminjaman');
        $this->db->where('status', 'Selesai');
        $this->db->order_by('tanggal_pengajuan');
        $jmlselesai = $this->db->get()->num_rows();
        $data = array(
            'user' => $user,
            'aplikasi'  => $aplikasi,
            'judul_web' => 'Form Pinjam Mobil - Aplikasi Pinjam Mobil ',
            'users'     => $users,
            'notif'     => $notif,
            'jmlinput'  => $jmlinput,
            'jmlselesai' => $jmlselesai,
        );
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('page/pinjammobil', $data);
        $this->load->view('layout/footer', $data);

        $user = htmlspecialchars($this->input->post('user'));
        $nama_peminjam = htmlspecialchars($this->input->post('nama_peminjam'));
        $penumpang = htmlspecialchars($this->input->post('penumpang'));
        $tujuan = htmlspecialchars($this->input->post('tujuan'));
        $kepentingan = htmlspecialchars($this->input->post('kepentingan'));
        $mulaitanggal = htmlspecialchars($this->input->post('mulai_tanggal'));
        $selesaitanggal = htmlspecialchars($this->input->post('sampai_tanggal'));
        $kendaraan = htmlspecialchars($this->input->post('kendaraan'));
        $divisi = htmlspecialchars($this->input->post('divisi'));
        $jabatan = htmlspecialchars($this->input->post('jabatan'));
        $jam_berangkat = htmlspecialchars($this->input->post('jam'));
        $ttd = $this->input->post('ttd');
        $kode = md5(rand(1, 9999999) . date("Ymd"));
        if (isset($_POST['pinjam'])) {
            $data = array(
                'user'      => $user,
                'nama_peminjam'     => $nama_peminjam,
                'penumpang' => $penumpang,
                'tujuan'    => $tujuan,
                'kepentingan'   => $kepentingan,
                'tanggal_mulai' => $mulaitanggal,
                'tanggal_selesai'   => $selesaitanggal,
                'divisi'        => $divisi,
                'jabatan'   => $jabatan,
                'tanggal_pengajuan' => date('Y-m-d h:i:s'),
                'jam_berangkat'     => $jam_berangkat,
                'kode'      => $kode,
                'status'    => 'Menunggu ACC Manajer Bagian',
                'ttd_pengajuan'       => $ttd,
            );
            $input = $this->db->insert('peminjaman', $data);
            $this->session->set_flashdata('msg', 'success');
            redirect('web/datapinjammobil/' . $kode);
        }
    }

    public function keberangkatan($id)
    {
        $gambar = $_FILES['foto']['name']; // Nama asli file yang diunggah
        $config['upload_path']   = FCPATH . 'img'; // Lokasi penyimpanan
        $config['allowed_types'] = 'jpg|png|jpeg|webp|pdf'; // Jenis file yang diperbolehkan
        $config['max_size']      = '10048'; // Maksimal ukuran file dalam KB
        $config['file_name']     = $gambar; // Tetap menggunakan nama asli file
        $this->upload->initialize($config);
        $this->load->library('upload', $config); // Memuat library upload
        $this->upload->do_upload('foto');
        $file_data = $this->upload->data();
        $file_name = $file_data['file_name'];


        $km_berangkat = htmlspecialchars($this->input->post('km_berangkat'));
        $data = array(
            'km_berangkat'  => $km_berangkat,
            'foto_berangkat'    => $file_name,
            'status'    => 'Menunggu Pulang',
            'waktu_berangkat' => date('H:s'),
            'tgl_berangkat' => date('Y-m-d'),
        );
        $this->db->update('peminjaman', $data, ['kode' => $id]);
        $this->session->set_flashdata('msg', 'success');
        redirect('web/pinjammobil');
    }

    public function pulang($id)
    {
        $gambar = $_FILES['foto2']['name']; // Nama asli file yang diunggah
        $config['upload_path']   = FCPATH . 'img'; // Lokasi penyimpanan
        $config['allowed_types'] = 'jpg|png|jpeg|webp|pdf'; // Jenis file yang diperbolehkan
        $config['max_size']      = '10048'; // Maksimal ukuran file dalam KB
        $config['file_name']     = $gambar; // Tetap menggunakan nama asli file
        $this->upload->initialize($config);
        $this->load->library('upload', $config); // Memuat library upload
        $this->upload->do_upload('foto2');
        $file_data = $this->upload->data();
        $file_name = $file_data['filename'];

        $km_berangkat = htmlspecialchars($this->input->post('km_berangkat'));
        $data = array(
            'km_pulang'  => $km_berangkat,
            'foto_pulang'    => $gambar,
            'status'    => 'Selesai',
            'waktu_pulang'  => date('H:s'),
            'tgl_pulang'    => date('Y-m-d'),
        );
        $this->db->update('peminjaman', $data, ['kode' => $id]);
        $this->session->set_flashdata('msg', 'success');
        redirect('web/pinjammobil');
    }

    public function datapinjammobil($id)
    {
        $user_id = $this->session->userdata('user_id');
        $user = $this->user_model->get_user_by_id($user_id);
        $users = $this->user_model->get_users();
        $aplikasi = $this->web_model->get_aplikasi();
        $mobil = $this->db->get('kendaraan');
        $peminjaman = $this->db->get_where('peminjaman', array('kode' => $id))->row();
        $tanggal_mulai = $peminjaman->tanggal_mulai;
        $tanggal_selesai = $peminjaman->tanggal_selesai;

        $this->db->select('kendaraan.id, kendaraan.jenismobil, kendaraan.nomor');
        $this->db->from('kendaraan');
        $this->db->join(
            'peminjaman',
            "kendaraan.id = peminjaman.id_mobil 
            AND (peminjaman.tanggal_mulai <= '$tanggal_selesai' 
            AND peminjaman.tanggal_selesai >= '$tanggal_mulai')",
            'left'
        );
        $this->db->where('peminjaman.id_mobil IS NULL'); // Hanya yang tidak bentrok
        $mobil = $this->db->get();
        $this->db->from('peminjaman');
        $this->db->where('status', 'Menunggu ACC Manajer Bagian');
        $this->db->order_by('tanggal_pengajuan', 'desc');
        $this->db->limit('4');
        $notif = $this->db->get();

        $this->db->from('peminjaman');
        $this->db->where('status', 'Menunggu Input Mobil');
        $this->db->order_by('tanggal_pengajuan');
        $jmlinput = $this->db->get()->num_rows();

        $this->db->from('peminjaman');
        $this->db->where('status', 'Selesai');
        $this->db->order_by('tanggal_pengajuan');
        $jmlselesai = $this->db->get()->num_rows();

        $data = array(
            'user' => $user,
            'aplikasi'  => $aplikasi,
            'judul_web' => 'Form Pinjam Mobil - Aplikasi Pinjam Mobil',
            'users'     => $users,
            'peminjaman'     => $peminjaman,
            'mobil'     => $mobil,
            'notif'     => $notif,
            'jmlinput'  => $jmlinput,
            'jmlselesai' => $jmlselesai,
        );
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('page/datapinjammobil', $data);
        $this->load->view('layout/footer', $data);
    }

    public function printpinjammobil($id)
    {
        $user_id = $this->session->userdata('user_id');
        $user = $this->user_model->get_user_by_id($user_id);
        $users = $this->user_model->get_users();
        $aplikasi = $this->web_model->get_aplikasi();
        $mobil = $this->db->get('kendaraan');
        $peminjaman = $this->db->get_where('peminjaman', array('kode' => $id))->row();
        $data = array(
            'user' => $user,
            'aplikasi'  => $aplikasi,
            'judul_web' => 'Print Form Pinjam Mobil - Aplikasi Pinjam Mobil',
            'users'     => $users,
            'peminjaman'     => $peminjaman,

        );
        $this->load->view('page/printpinjammobil', $data);
    }

    public function profil()
    {
        $user_id = $this->session->userdata('user_id');
        $user = $this->user_model->get_user_by_id($user_id);
        $users = $this->user_model->get_users();
        $aplikasi = $this->web_model->get_aplikasi();
        $this->db->from('peminjaman');
        $this->db->where('status', 'Menunggu ACC Manajer Bagian');
        $this->db->order_by('tanggal_pengajuan', 'desc');
        $this->db->limit('4');
        $notif = $this->db->get();

        $this->db->from('peminjaman');
        $this->db->where('status', 'Menunggu Input Mobil');
        $this->db->order_by('tanggal_pengajuan');
        $jmlinput = $this->db->get()->num_rows();

        $this->db->from('peminjaman');
        $this->db->where('status', 'Selesai');
        $this->db->order_by('tanggal_pengajuan');
        $jmlselesai = $this->db->get()->num_rows();
        $data = array(
            'user' => $user,
            'aplikasi' => $aplikasi,
            'judul_web' => 'Profil - Aplikasi Pinjam Mobil',
            'users'     => $users,
            'notif'     => $notif,
            'jmlinput'  => $jmlinput,
            'jmlselesai' => $jmlselesai,
        );

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('page/profil.php', $data);
        $this->load->view('layout/footer.php', $data);
    }

    public function accpinjammobil($id)
    {

        $peminjaman = $this->db->get_where('peminjaman', array('kode' => $id))->row();
        $user_id = $this->session->userdata('user_id');
        $user = $this->user_model->get_user_by_id($user_id);
        $ttd = $user->ttd;
        $pengacc = $user->nama_user;

        if ($peminjaman->jabatan != 'Manager') {
            // Pengaju bukan seorang manajer
            if ($user->jabatan == 'Manager' && $peminjaman->divisi == $user->divisi) {

                $data = array(
                    'ttd_acc'   => $ttd,
                    'pengacc'   => $pengacc,
                    'tgl_acc'   => date('Y-m-d'),
                    'status'    => 'Menunggu ACC Bagian Umum',
                );
                // Yang menyetujui adalah manajer divisi yang sama
                $this->db->update('peminjaman', $data, ['kode' => $id]);
                $this->session->set_flashdata('msg', 'success');
                redirect('web/datapinjammobil/' . $id);
            } else {
                // Jika yang menyetujui bukan manajer divisi yang sama
                $this->session->set_flashdata('msg', 'error');
                redirect('web/datapinjammobil/' . $id);
            }
        } elseif ($peminjaman->jabatan == 'Manager') {
            // Pengaju adalah seorang manajer
            if ($user->jabatan == 'Admin') {

                $data = array(
                    'ttd_acc'   => $ttd,
                    'pengacc'   => $pengacc,
                    'tgl_acc'   => date('Y-m-d'),
                    'ttd_acc2'   => $ttd,
                    'pengacc2'   => $pengacc,
                    'tgl_acc2'   => date('Y-m-d'),
                    'status'    => 'Menunggu Input Mobil',
                );
                // Yang menyetujui adalah admin
                $this->db->update('peminjaman', $data, ['kode' => $id]);
                $this->session->set_flashdata('msg', 'success');
                redirect('web/datapinjammobil/' . $id);
            } else {
                // Jika yang menyetujui bukan admin
                $this->session->set_flashdata('msg', 'error');
                redirect('web/datapinjammobil/' . $id);
            }
        } else {
            // Jika logika tidak terpenuhi (fallback)
            $this->session->set_flashdata('msg', 'error');
            redirect('web/datapinjammobil/' . $id);
        }
    }

    public function acc2pinjammobil($id)
    {

        $peminjaman = $this->db->get_where('peminjaman', array('kode' => $id))->row();
        $user_id = $this->session->userdata('user_id');
        $user = $this->user_model->get_user_by_id($user_id);
        $ttd = $user->ttd;
        $pengacc = $user->nama_user;

        $data = array(
            'ttd_acc2'   => $ttd,
            'pengacc2'   => $pengacc,
            'tgl_acc2'   => date('Y-m-d'),
            'status'    => 'Menunggu Input Mobil',
        );
        // Yang menyetujui adalah admin
        $this->db->update('peminjaman', $data, ['kode' => $id]);
        $this->session->set_flashdata('msg', 'success');
        redirect('web/datapinjammobil/' . $id);
    }

    public function datauser()
    {

        $user_id = $this->session->userdata('user_id');
        $user = $this->user_model->get_user_by_id($user_id);
        $users = $this->user_model->get_users();
        $aplikasi = $this->web_model->get_aplikasi();
        $this->db->from('peminjaman');
        $this->db->where('status', 'Menunggu ACC Manajer Bagian');
        $this->db->order_by('tanggal_pengajuan', 'desc');
        $this->db->limit('4');
        $notif = $this->db->get();

        $this->db->from('peminjaman');
        $this->db->where('status', 'Menunggu Input Mobil');
        $this->db->order_by('tanggal_pengajuan');
        $jmlinput = $this->db->get()->num_rows();

        $this->db->from('peminjaman');
        $this->db->where('status', 'Selesai');
        $this->db->order_by('tanggal_pengajuan');
        $jmlselesai = $this->db->get()->num_rows();
        $data = array(
            'user'  => $user,
            'aplikasi'  =>  $aplikasi,
            'judul_web' => 'Data User - Aplikasi Pinjam Mobil',
            'users'     => $users,
            'notif'     => $notif,
            'jmlinput'  => $jmlinput,
            'jmlselesai' => $jmlselesai,
        );

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('page/datauser', $data);
        $this->load->view('layout/footer', $data);
    }

    public function edituser($id)
    {
        $gambar = $_FILES['ttd']['name'];

        if (!empty($gambar)) {
            $config['upload_path']   = FCPATH . 'ttd/'; // pastikan folder ttd sejajar index.php
            $config['allowed_types'] = 'jpg|png|jpeg|webp|pdf';
            $config['max_size']      = 2048;
            $config['file_name']     = $gambar;

            // Load dulu, baru initialize
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('ttd')) {
                $file_data = $this->upload->data();
                $file_name = $file_data['file_name'];
            } else {
                // kalau error upload tampilkan
                echo $this->upload->display_errors();
                return;
            }
        } else {
            $file_name = $this->input->post('ttd_lama'); // pakai file lama kalau tidak upload baru
        }

        $nama     = htmlspecialchars($this->input->post('nama'));
        $email    = htmlspecialchars($this->input->post('email'));
        $nomor    = htmlspecialchars($this->input->post('nomor'));
        $jabatan  = htmlspecialchars($this->input->post('jabatan'));
        $divisi   = htmlspecialchars($this->input->post('divisi'));
        $username = htmlspecialchars($this->input->post('username'));
        $nik      = htmlspecialchars($this->input->post('nik'));

        $data = array(
            'nama_user' => $nama,
            'email'     => $email,
            'username'  => $username,
            'jabatan'   => $jabatan,
            'divisi'    => $divisi,
            'ttd'       => $file_name,
            'nik'       => $nik,
        );

        $this->db->where('id', $id);
        $this->db->update('users', $data);

        $this->session->set_flashdata('msg', 'updated');
        redirect('web/datauser');
    }

    public function tambahuser()
    {
        if (strtolower($this->session->userdata('level')) !== 'administrator') {
            show_error('Anda tidak punya akses menambah user', 403);
        }

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
        if ($user) {
            $this->session->set_flashdata('msg', 'gagal');
        } else {
            $this->db->insert('users', $data);
            $this->session->set_flashdata('msg', 'success');
        }

        // Balik ke halaman user
        redirect('web/datauser');
    }

    public function datapeminjaman()
    {
        $user_id = $this->session->userdata('user_id');
        $user = $this->user_model->get_user_by_id($user_id);
        $users = $this->user_model->get_users();
        $aplikasi = $this->web_model->get_aplikasi();

        $this->db->from('peminjaman');
        $this->db->order_by('tanggal_pengajuan', 'desc');
        $peminjaman = $this->db->get();
        $this->db->from('peminjaman');
        $this->db->where('status', 'Menunggu ACC Manajer Bagian');
        $this->db->order_by('tanggal_pengajuan', 'desc');
        $this->db->limit('4');
        $notif = $this->db->get();

        $this->db->from('peminjaman');
        $this->db->where('status', 'Menunggu Input Mobil');
        $this->db->order_by('tanggal_pengajuan');
        $jmlinput = $this->db->get()->num_rows();

        $this->db->from('peminjaman');
        $this->db->where('status', 'Selesai');
        $this->db->order_by('tanggal_pengajuan');
        $jmlselesai = $this->db->get()->num_rows();
        $data = array(
            'user'      => $user,
            'aplikasi'  =>  $aplikasi,
            'judul_web' => 'Data Peminjaman - Aplikasi Pinjam Mobil',
            'users'     => $users,
            'peminjaman' => $peminjaman,
            'notif'     => $notif,
            'jmlinput'  => $jmlinput,
            'jmlselesai' => $jmlselesai,
        );

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('page/datapeminjaman', $data);
        $this->load->view('layout/footer', $data);
    }

    public function aplikasi()
    {
        $user_id = $this->session->userdata('user_id');
        $user = $this->user_model->get_user_by_id($user_id);
        $aplikasi = $this->web_model->get_aplikasi();
    }
}
