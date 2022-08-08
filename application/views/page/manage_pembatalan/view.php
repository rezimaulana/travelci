<!-- Begin Page Content -->

<div class="container-fluid">
    <h2 class="h2 mb-4 text-gray-800">Manage Pembatalan</h2>
    <div class="col-lg">
        <?= $this->session->flashdata('message') ?>
    </div>
    <div class="table-responsive table-striped">
        <table class="table" id="datatable">
            <thead>
                <tr style="text-align: center;">
                    <th width="1%">No</th>
                    <th>Kode Pemesanan</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Paket</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Tanggal Keberangakatan</th>
                    <th>Jumlah Peserta</th>
                    <th>Jumlah Bayar</th>
                    <?php
                    if($this->session->userdata('role_id') == 3){
                        echo '<th>Uang Kembali</th>';
                        echo '<th>Nomor Rekening</th>';
                    }
                    ?>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $no = 1;
                foreach ($proses_pembatalan as $getData) : ?>
                    <tr style="text-align: center;">
                        <td><?= $no; ?></td>
                        <td><?= $getData->kode_pemesanan; ?></td>
                        <td><?= $getData->nama; ?></td>
                        <td><?= $getData->telepon; ?></td>
                        <td><?= $getData->nama_paket; ?></td>
                        <td><?= $getData->tanggal_pemesanan; ?></td>
                        <td><?= $getData->tanggal_keberangkatan; ?></td>
                        <td><?= $getData->jumlah_peserta; ?> Orang</td>
                        <td>Rp. <?= number_format($getData->jumlah_bayar); ?></td>
                        <?php
                        $norek = $this->db->select('nomor_rekening')->from('proses_pembayaran')->where(['pemesanan_id' => $getData->id])->order_by('nomor_rekening', 'DESC')->limit(1)->get()->row_array();

                            if($this->session->userdata('role_id') == 3){
                                $tgl = $getData->tanggal_keberangkatan;
                                $tgl1 = date('Y-m-d', strtotime('-1 days', strtotime($tgl)));
                                $tgl2 = date('Y-m-d', strtotime('-2 days', strtotime($tgl)));
                                $tgl3 = date('Y-m-d', strtotime('-3 days', strtotime($tgl)));
                                $tgl4 = date('Y-m-d', strtotime('-4 days', strtotime($tgl)));
                                $tgl5 = date('Y-m-d', strtotime('-5 days', strtotime($tgl)));
                                
                                //proses uang kembali
                                $today = date('Y-m-d');
                                $uang_kembali = $getData->jumlah_bayar * 0.25;
                                if ($today == $tgl or $today == $tgl1 or $today == $tgl2 or $today == $tgl3 or $today == $tgl4 or $today == $tgl5) {
                                    echo '<td>Rp. 0</td>';
                                } else {
                                    echo '<td>Rp. '.number_format($uang_kembali).'  </td>';
                                }
                                

                                echo '<td>'.$norek['nomor_rekening'].'</td>';


                            }else{
                                $uang_kembali = 0;
                            }
                        ?>
                        <td>
                            <a href="<?= base_url('manage-pembatalan/') . $getData->id . '/' . $getData->pemesanan_id.'/'.$uang_kembali; ?>" class="btn btn-success 
                            <?php 
                            if($this->session->userdata('role_id') == 2){
                                if($getData->status_proses_pembatalan == 1){
                                    echo 'disabled';
                                }
                            }else{
                                if($getData->status_proses_pembatalan == 2 OR $getData->status_proses_pembatalan == 0){
                                    echo 'disabled';
                                }
                            }

                            ?>"><i class="fas fa-check"></i></a>
                        </td>
                    </tr>
                <?php $no++; endforeach ?>
            </tbody>
        </table>
    </div>
</div>