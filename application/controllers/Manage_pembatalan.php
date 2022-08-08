<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manage_pembatalan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('M_database', 'proses');
    }

    public function index()
    {
        $data['title'] = 'Data Pembatalan';
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


        /* if ($this->session->userdata('role_id') == 2) {
            $query = 'SELECT pemesanan.id as pemesanan_id,nama_paket,proses_pembatalan.id, tanggal_pemesanan, tanggal_keberangkatan,uang_kembali,status_proses_pembatalan,jumlah_peserta,jumlah_bayar, nama, telepon FROM proses_pembatalan JOIN pemesanan ON pemesanan_id = pemesanan.id JOIN pelanggan ON pelanggan_id = pelanggan.id JOIN paket_wisata ON paket_wisata_id = paket_wisata.id WHERE status_proses_pembatalan = 0';
        } else {
            $query = 'SELECT pemesanan.id as pemesanan_id,nama_paket,proses_pembatalan.id, tanggal_pemesanan, tanggal_keberangkatan,uang_kembali,status_proses_pembatalan,jumlah_peserta,jumlah_bayar, nama, telepon FROM proses_pembatalan JOIN pemesanan ON pemesanan_id = pemesanan.id JOIN pelanggan ON pelanggan_id = pelanggan.id JOIN paket_wisata ON paket_wisata_id = paket_wisata.id WHERE status_proses_pembatalan = 1';
        } */

        $query = 'SELECT pemesanan.id as pemesanan_id,kode_pemesanan,nama_paket,proses_pembatalan.id, tanggal_pemesanan, tanggal_keberangkatan,uang_kembali,status_proses_pembatalan,jumlah_peserta,jumlah_bayar, nama, telepon FROM proses_pembatalan JOIN pemesanan ON pemesanan_id = pemesanan.id JOIN pelanggan ON pelanggan_id = pelanggan.id JOIN paket_wisata ON paket_wisata_id = paket_wisata.id';

        $data['proses_pembatalan'] = $this->db->query($query)->result();

        $this->load->view('config/header', $data);
        $this->load->view('config/sidebar');
        $this->load->view('config/navbar', $data);
        $this->load->view('page/manage_pembatalan/view', $data);
        $this->load->view('config/footer');
        $this->load->view('config/footer-link');
    }

    public function proses_pembatalan($id_proses, $id_pemesanan, $uangkembali)
    {
        if ($this->session->userdata('role_id') == 2) {
            $sql = $this->proses->updateData('proses_pembatalan', ['status_proses_pembatalan' => 1], ['id' => $id_proses]);

            if ($sql) {
                $this->session->set_flashdata('message', '<center><div class="alert alert-success" role="alert"> Data berhasil diperbaharui. </div></center>');
                redirect(base_url('manage-pembatalan'));
            }
        } else {
            
            $sql = $this->proses->updateData('pemesanan', ['status_pemesanan' => 3, 'uang_kembali' => $uangkembali], ['id' => $id_pemesanan]);

            $this->proses->updateData('proses_pembatalan', ['status_proses_pembatalan' => 2], ['id' => $id_proses]);
            // $this->proses->deleteData('proses_pembatalan', ['id' => $id_proses]);

            $query = "SELECT pemesanan.*, nama_paket, email FROM `pemesanan` JOIN paket_wisata ON paket_wisata_id = paket_wisata.id JOIN pelanggan ON pelanggan_id = pelanggan.id WHERE pemesanan.id = '$id_pemesanan'";

            $pemesanan = $this->db->query($query)->row_array();

            $pesan = '
            <p>Untuk Pemesanan Paket '.$pemesanan["nama_paket"].' Telah Dibatalkan. Berikut Rincian:</p>
            <p>Kode Pemesanan : '.$pemesanan["kode_pemesanan"].'</p>
            <p>Nama Paket : '.$pemesanan["nama_paket"].'</p>
            <p>Total Bayar : Rp. '.number_format($pemesanan['jumlah_bayar']).'</p>
            <p>Total Uang Kembali : Rp. '.number_format($pemesanan['uang_kembali']).'</p>
            ';

            $email = $pemesanan['email'];

            $this->_sendEmail($email, $pesan);

            if ($sql) {
                $this->session->set_flashdata('message', '<center><div class="alert alert-success" role="alert"> Data berhasil diperbaharui. </div></center>');
                redirect(base_url('manage-pembatalan'));
            }
        }
    }

    public function _sendEmail($email, $pesan)
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

        $this->email->message('' . $pesan . ' <a href="' . base_url() . 'login-pelanggan" style="display: inline-block;
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

        if ($this->email->send()) {
            return true;
        } else {
            $this->email->print_debugger();
            die;
        }
    }
}
