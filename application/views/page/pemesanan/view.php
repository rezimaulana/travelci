<!-- Begin Page Content -->

<div class="container-fluid">
    <h2 class="h2 mb-4 text-gray-800">Pemesanan</h2>
    <div class="col-lg">
        <?= $this->session->flashdata('message'); ?>
    </div>
    <p style="float: left;"><a href="<?= base_url('list-batal-pesanan') ?>" style="margin-right: 20px;" class="btn btn-info"><i class="fas fa-list"></i> List Batal Pesanan</a></p>
    <div class="table-responsive table-striped">
        <table class="table" id="datatable">
            <thead>
                <tr style="text-align: center;">
                    <th width="1%">No</th>
                    <th>Kode Pemesanan</th>
                    <th>Paket</th>
                    <th>Nama Instansi</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Tanggal Keberangakatan</th>
                    <th>Jumlah Peserta</th>
                    <th>Harga</th>
                    <th>Jumlah Bayar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead> 

            <tbody>
                <?php $no = 1;
                foreach ($pembatalan as $getData) : ?>
                    <tr style="text-align: center;">
                        <td><?= $no; ?></td>
                        <td><?= $getData->kode_pemesanan; ?></td>
                        <td><?= $getData->nama_paket; ?></td>
                        <td><?= $getData->nama_instansi; ?></td>
                        <td><?= $getData->tanggal_pemesanan; ?></td>
                        <td><?= $getData->tanggal_keberangkatan; ?></td>
                        <td><?= $getData->jumlah_peserta; ?> Orang</td>
                        <td>Rp. <?= number_format($getData->jumlah_harga); ?></td>
                        <td>Rp. <?= number_format($getData->jumlah_bayar); ?></td>
                        <td style="text-align: center;">
                            <?php
                            if($getData->status_pembayaran == 0){
                                echo '<span class="btn btn-primary">Belum Bayar</span>';
                            }elseif($getData->status_pemesanan == 0){
                                echo '<span class="btn btn-primary">Proses</span>';
                            } elseif ($getData->status_pemesanan == 1) {
                                echo '<span class="btn btn-success">Selesai</span>';
                            } elseif ($getData->status_pemesanan == 2) {
                                echo '<span class="btn btn-danger">Proses Batal</span>';
                            } elseif ($getData->status_pemesanan == 3) {
                                echo '<span class="btn btn-danger">Dibatalkan</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <a href="#" class="btn btn-danger <?php if($getData->status_pemesanan != 0){echo 'disabled'; } ?>" data-toggle="modal" data-target="#modalBatal<?= $getData->id; ?>"><i class="fas fa-ban"></i> Batalkan</a>

                            <!-- <a href="<?= base_url('pembatalan/proses_pembatalan/').$getData->id; ?>" class="btn btn-danger <?php if($getData->status_pemesanan == 2 OR $getData->status_pemesanan == 3){echo 'disabled'; } ?>"><i class="fas fa-ban"></i> Batalkan</a> -->
                        </td>
                    </tr>

                    <?php 
                    include('modal_batal.php');
                    $no++;
                endforeach ?>
            </tbody>
        </table>
    </div>
</div>