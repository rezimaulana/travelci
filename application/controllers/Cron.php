<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends CI_Controller 
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_database', 'proses');
    }

    public function index(){
        $pelanggan = $this->db->select('pemesanan.*,email')->from('pemesanan')->join('pelanggan', 'pelanggan.id = pelanggan_id')->get()->result();

        foreach ($pelanggan as $pelanggan) {
            $tgl = $pelanggan->tanggal_pemesanan;
            $tgl_otw = $pelanggan->tanggal_keberangkatan;
            $tgl1 = date('Y-m-d', strtotime('+10 days', strtotime($tgl)));
            $tgl2 = date('Y-m-d', strtotime('+20 days', strtotime($tgl)));
            $tgl3 = date('Y-m-d', strtotime('-7 days', strtotime($tgl_otw)));
            $today = date("Y-m-d");
            $email = $pelanggan->email;
            
            if($pelanggan->status_pembayaran == 0){
                if($today > $tgl1){
                    $this->proses->updateData('pemesanan', ['status_pemesanan' => 3], ['id' => $pelanggan['id']]);
                    $this->sendEmail($email);
                }
                
            }elseif($pelanggan->status_pembayaran == 1){
                if($today > $tgl2){
                    $this->proses->updateData('pemesanan', ['status_pemesanan' => 3], ['id' => $pelanggan['id']]);
                    $this->sendEmail($email);
                }
                 
            }elseif($pelanggan->status_pembayaran == 2){
                if($today > $tgl3){
                    $this->proses->updateData('pemesanan', ['status_pemesanan' => 3], ['id' => $pelanggan['id']]);
                    $this->sendEmail($email);
                }
                
            }

        }
    }
    
    /**
     * This function is used to update the age of users automatically
     * This function is called by cron job once in a day at midnight 00:00
     */
    public function sendEmail($email)
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

        $this->email->subject('Pembatalan Pesanan');
        $this->email->message('Maaf pesanan anda telah dibatalkan karna telah melewati batas pembayaran dan uang yang telah di bayarkan telah hangus');
        
        if ($this->email->send()) {
            return true;
        } else {
            $this->email->print_debugger();
            die;
        }
    }
    
    public function addToken(){
        $sql = $this->db->insert('user_token', ['email' => 'testcron@gmail.com', 'token' => 'testcron']);
        
        if($sql){
            echo "Berhasil";
        }else{
            echo "Gagal";
        }
    }
}
