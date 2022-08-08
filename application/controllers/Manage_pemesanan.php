<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manage_pemesanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('M_database', 'proses');
    }

    public function index()
    {
        $data['title'] = 'Manage Pemesanan';
        $role_id = $this->session->userdata('role_id');
        $email = $this->session->userdata('email');
        $role = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        if ($role_id == 4) {
            $user = $this->db->get_where('pelanggan', ['email' => $email])->row_array();
            $data['home'] = 'page/home/home-pelanggan';
            $data['role'] = $user['nama'];
        } else { 
            $data['role'] = $role['role'];
            $data['home'] = 'page/home/home-admin';
        }
        
        
        $data['manage_pemesanan'] = $this->proses->getDataJoin2('kode_pemesanan,pemesanan.id,paket_wisata.id as paket_wisata_id , pelanggan.id AS id_pelanggan, tanggal_keberangkatan,tanggal_pemesanan, nama_instansi,custom_destinasi, jumlah_peserta,pemesanan.status,nama_paket,nama,foto_ktp', 'pemesanan', 'pelanggan', 'pelanggan_id = pelanggan.id', 'paket_wisata', 'paket_wisata_id = paket_wisata.id', 'status', 'ASC');

        $this->load->view('config/header', $data);
        $this->load->view('config/sidebar');
        $this->load->view('config/navbar', $data);
        $this->load->view('page/manage_pemesanan/view', $data);
        $this->load->view('config/footer');
        $this->load->view('config/footer-link');
    }

    public function persetujuan($setuju,$id_pelanggan,$id_pemesanan){
        if($setuju == 1){
            //get data
            $pemesanan = $this->db->get_where('pemesanan', ['id' => $id_pemesanan])->row_array();
            $pelanggan = $this->db->get_where('pelanggan', ['id' => $id_pelanggan])->row_array();

            $dp =  $pemesanan['jumlah_harga'] * 0.25;
            $tgl = $pemesanan['tanggal_pemesanan'];
            $tgl1 = date('d-m-Y', strtotime('+10 days', strtotime($tgl)));

            //update data
            $sql = $this->proses->updateData('pemesanan', ['status' => 1], ['id' => $id_pemesanan]);

            $pesan = '
            <p>Pesanan anda telah disetujui. Silahkan login dan lakukan pembayaran untuk melanjutkan proses pemesanan. Berikut Rincian</p>
            <p>Lakukkan pembayaran DP sebelum tanggal '. $tgl1 .'</p>
            <p>DP sebesar : Rp. '. number_format($dp) .'</p>
            <p>Bayar Lunas : Rp. '.number_format($pemesanan['jumlah_harga']).'</p>
            <p style="color: red;"><strong>Peringatan!</strong> Jika anda melalukkan pembayaran melebihi batas waktu yang telah ditentukan makan pesanan akan hangus.</p>
            ';

            if($sql){
                //kirim notifikasi via email
                $this->_sendEmail($pelanggan['email'],1,$pesan);
                
                $this->session->set_flashdata('message', '<center><div class="alert alert-success" role="alert"> Data Berhasil Diperbaharui. </div></center>');
                redirect(base_url('manage-pemesanan'));
            }
        }else{
            $pesan = $this->input->post('pesan');

            $sql = $this->proses->updateData('pemesanan', ['status' => 2, 'status_pemesanan' => 3], ['id' => $id_pemesanan]);

            $pelanggan = $this->db->get_where('pelanggan', ['id' => $id_pelanggan])->row_array();

            if ($sql) {
                //kirim notifikasi via email
                $this->_sendEmail($pelanggan['email'],0,$pesan);

                $this->session->set_flashdata('message', '<center><div class="alert alert-success" role="alert"> Data Berhasil Diperbaharui. </div></center>');
                redirect(base_url('manage-pemesanan'));
            }
        }
    }

    public function _sendEmail($email,$kondisi,$pesan)
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
        $this->email->to($email);

        $this->email->subject('Notifikasi Adeeva Tour');
        
        if($kondisi == 1){
            $this->email->message(''.$pesan.' <a href="' . base_url() . 'login-pelanggan" style="display: inline-block;
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
            border-color: #2e6da4;">Login</a>');
        }else{
            $this->email->message('Maaf pesanan anda ditolak. Dikarenakan '. $pesan . ' Silahkan login untuk melihat syarat dan kebijakan yang berlaku. <a href="' . base_url() . 'login-pelanggan" style="display: inline-block;
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
            border-color: #2e6da4;">Login</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            $this->email->print_debugger();
            die;
        }
    }
}
