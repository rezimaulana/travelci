<!-- Begin Page Content -->
<div class="container-fluid">
    <h2 class="h2 mb-4 text-gray-800">Home - Paket Wisata</h2>

    <div class="row">
        <div class="col-lg">
            <?php
            
                $pelanggan = $this->db->get_where('pemesanan', ['pelanggan_id' => $this->session->userdata('id'), 'status_pemesanan' => 0])->row_array();

                $query = $this->db->get_where('pemesanan', ['pelanggan_id' => $this->session->userdata('id'), 'status_pemesanan' => 0])->num_rows();


                if($query > 0){
                    $tgl = $pelanggan['tanggal_pemesanan'];
                    $tgl_otw = $pelanggan['tanggal_keberangkatan'];
                    $tgl1 = date('Y-m-d', strtotime('+10 days', strtotime($tgl)));
                    $tgl2 = date('Y-m-d', strtotime('+20 days', strtotime($tgl)));
                    $tgl3 = date('Y-m-d', strtotime('-7 days', strtotime($tgl_otw)));

                    if($pelanggan['status_pembayaran'] == 0){
                        $status = "DP";
                    }elseif($pelanggan['status_pembayaran'] == 1){
                        $status = "Cicilan 2";
                    }elseif($pelanggan['status_pembayaran'] == 2){
                        $status = "Lunas";
                    }

                    if($this->session->flashdata('message')){
                        echo $this->session->flashdata('message');
                    }elseif($pelanggan['status'] == 1){
                        if($pelanggan['status_pembayaran'] == 0){
                            echo '<center>
                            <div class="alert alert-primary" role="alert">
                                Silahkan lakukan pembayaran untuk pembayaran '.$status.' sebelum tanggal '. date('d-m-Y', strtotime($tgl1)) .'
                            </div>
                        </center>';
                        }elseif($pelanggan['status_pembayaran'] == 1){
                            echo '<center>
                            <div class="alert alert-primary" role="alert">
                                Silahkan lakukan pembayaran untuk pembayaran '.$status.' sebelum tanggal '. date('d-m-Y', strtotime($tgl2)).'
                            </div>
                        </center>';
                        }elseif($pelanggan['status_pembayaran'] == 2){
                            echo '<center>
                            <div class="alert alert-primary" role="alert">
                                Silahkan lakukan pembayaran untuk pembayaran '.$status.' sebelum tanggal '. date('d-m-Y', strtotime($tgl3)) .'
                            </div>
                        </center>';
                    }
                }

                }
            ?>

        </div>
    </div>

    <div class="row">
        <?php $no = 0;
        foreach ($paket_wisata as $getData) { ?>
            <div class="col-md-6 col-lg-4 col-sm-2" <?php if ($no > 2) {echo 'style="margin-top: 25px;"';} ?>>
                <div class="hovereffect">
                    <img class="img-responsive" src="<?= base_url('assets/img/') . $getData->thumbnail; ?>" alt="">
                    <div class="overlay">
                        <h2><?= $getData->nama_paket; ?></h2>
                        <p class="text-white">
                            <?php
                            if (strlen($getData->deskripsi) >= 220) {
                                echo substr($getData->deskripsi, 0, 210);
                                echo '...';
                            } else {
                                echo $getData->deskripsi;
                            }
                            ?>
                        </p>
                        <a class="btn btn-info info" href="<?= base_url('detail-paket/') . $getData->id; ?>">Detail Paket</a>
                    </div>
                </div>
            </div>

            <?php
            $no++;
        }
        ?>
    </div>
</div>