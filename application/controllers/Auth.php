<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_database', 'proses');
        
    }

    public function cek_login(){
        if ($this->session->userdata('login') == true) {
            redirect(base_url('home'));
        }
    }

    public function index(){
        $this->cek_login();
        $this->load->view('page/auth/login/view');
        
    }

    public function registrasi(){
        $this->cek_login();
        $data['title'] = 'Registrasi';
        $this->load->view('page/auth/registrasi/view');
    }

    public function proses_login(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('pelanggan', ['email' => $email])->row_array();
        
        //jika pelanggan ada
        if ($user) {
            //jika pelanggan aktif
            if ($user['aktif'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'id' => $user['id'],
                        'role_id' => 4,
                        'login' => true
                    ];
                    $this->session->set_userdata($data);
                    redirect(base_url('home'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Maaf!</strong> Password yang anda masukkan salah!</div>');
                    redirect(base_url('login-pelanggan'));
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Maaf!</strong> Email anda belum aktif!</div>');
                redirect(base_url('login-pelanggan'));
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Maaf!</strong> Email anda belum terdaftar!</div>');
            redirect(base_url('login-pelanggan'));
        }
    }

    public function proses_registrasi(){
        if($this->input->post()){
            $email = $this->input->post('email', true);

            $query = $this->db->get_where('pelanggan', ['email' => $email]);

            if($query->num_rows() > 0){
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Maaf!</strong> '. $email .' sudah terdaftar!</div>');
                redirect(base_url('login-pelanggan'));
            }

            $data = [
                'nama' => htmlspecialchars(ucwords($this->input->post('nama', true))),
                'email' => htmlspecialchars($email),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
                'aktif' => 0
            ];

            //siapkan token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];
            
            $this->sendEmail($token);
            
            $this->proses->insertData('pelanggan', $data);
            $this->proses->insertData('user_token', $user_token);
            

            $this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Selamat!</strong> Email anda telah dibuat. Silahkan cek email untuk proses verifikasi!</div>');
            redirect('auth');

        }else{
            redirect(base_url( 'registrasi'));
        }
    }

    public function sendEmail($token)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'touradeeva@gmail.com',
            'smtp_pass' => 'adeevatour123',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('touradeeva@gmail.com', 'Adeeva Tour');
        $this->email->to($this->input->post('email'));

        $this->email->subject('Verifikasi Akun');
        $this->email->message('Klik tombol disamping untuk mengaktifkan email anda <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '" style="display: inline-block;
        padding: 6px 12px;
        margin-bottom: 0;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.42857143;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -ms-touch-action: manipulation;
        touch-action: manipulation;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-image: none;
        border: 1px solid transparent;
        border-radius: 4px;
        color: #fff;
        background-color: rgba(63,146,157);
        text-decoration: none;
        border-color: #2e6da4;">Aktifkan</a>');
        
        if ($this->email->send()) {
            return true;
        } else {
            $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('pelanggan', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db-> get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->proses->updateData('pelanggan', ['aktif' => 1], ['email' => $email]);
                    // $this->db->where(['email' => $email])->update('user', ['is_active' => 1]);

                    $this->proses->deleteData('user_token', ['email' => $email]);
                    // $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Selamat!</strong> '.$email.' Telah aktif. Silahkan Login!</div>');
                    redirect(base_url('login-pelanggan'));
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['token' => $token]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Maaf!</strong> Aktifasi email gagal. Token sudah kadaluarsa.</div>');
                    redirect(base_url('login-pelanggan'));
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Maaf!</strong> Aktifasi email gagal. Token tidak tersedia.</div>');
                redirect(base_url('login-pelanggan'));
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Maaf!</strong> Aktifasi email gagal. Email yang anda masukkan salah.</div>');
            redirect(base_url('login-pelanggan'));
        }
    }

    public function blocked(){
        $data['title'] = 'Access Blocked';
        $this->load->view('config/header', $data);
        $this->load->view('page/blocked/view');
        $this->load->view('config/footer');
        $this->load->view('config/footer-link');
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url('login-pelanggan'));
    }
}

?>