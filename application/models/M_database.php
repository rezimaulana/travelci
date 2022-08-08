<?php

class M_database extends CI_Model
{
    public function getData($table, $where){
        return $this->db->get_where($table, $where)->result();
    }

    public function getAllData($table){
        return $this->db->get($table)->result();
    }

    public function getDataJoin($select, $table, $join, $on, $where)
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->join($join, $on); 
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getDataJoin2($select, $table, $join, $on, $join2, $on2, $field, $ascDsc)
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->join($join, $on);
        $this->db->join($join2, $on2);
        $this->db->order_by($field, $ascDsc);
        $query = $this->db->get();
        return $query->result();
    }

    public function insertData($table, $data)
    {
        //$sql = mysqli_query($koneksi, "INSERT INTO `buku`(`field`) VALUES ('data')");
        return $this->db->insert($table, $data);
    }

    public function updateData($table, $data, $where)
    {
        // return $this->db->where($id)->get($table)->update();
        return $this->db->where($where)->update($table, $data);
    }

    public function deleteData($table, $where)
    {
        // DELETE FROM `divisi` WHERE id = $id
        return $this->db->where($where)->delete($table);
    }

    public function send_email_paymant(){
        $today = date('Y-m-d');
        
        $pemesanan = $this->db->select('pemesanan.*,nama,nama_paket')->from('pemesanan')->join('pelanggan', 'pelanggan_id = pelanggan.id')->join('paket_wisata', 'paket_wisata_id = paket_wisata.id')->result();
        
        foreach ($pemesanan as $getData) {

            $tgl = $getData->tanggal_pemesanan;
            $email = $getData->email;

            $tgl1 = date('Y-m-d', strtotime('+10 days', strtotime($tgl)));
            $tgl2 = date('Y-m-d', strtotime('+20 days', strtotime($tgl)));
            $tgl3 = date('Y-m-d', strtotime('+30 days', strtotime($tgl)));

            if($getData->status_pembayaran == 0){
                $status = "DP";
            }elseif($getData->status_pembayaran == 1){
                $status = "Cicilan 2";
            }elseif($getData->status_pembayaran == 2){
                $status = "Lunas";
            }

            if($getData->status == 1){
                if($getData->status_pembayaran == 0){
                    if($today == $tgl1){
                        $pesan = '
                        <p> Silahkan melakukkan pembayaran untuk pemesanan : </p>
                        <p> Nama Paket : '.$getData->nama_paket.' </p>
                        <p> Tanggal Keberangkatan : '.$getData->tanggal_keberangkatan.' </p>
                        <p> Harga      : Rp. '.number_format($getData->jumlah_harga).' </p>
                        <p> Nama Instansi      : Rp. '.$getData->nama_instansi.' </p>
                        <p> Pembayaran      : Rp. '.$status.' </p>
                        ';
                        $this->_sendEmail($email, $pesan);
                    }
                }elseif($getData->status_pembayaran == 1){

                }elseif($getData->status_pembayaran == 2){

                }
            }

            if($h7day == $today){
                $pesan = '
                <p> Silahkan melakukkan pembayaran untuk pemesanan : </p>
                <p> Nama Paket : '.$getData->nama_paket.' </p>
                <p> Harga      : Rp. '.$getData->harga.' </p>
                ';
                $this->_sendEmail($email, $pesan);
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

?>