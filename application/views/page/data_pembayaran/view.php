<!-- Begin Page Content -->

<div class="container-fluid">
    <h2 class="h2 mb-4 text-gray-800">Manage Pembayaran</h2>
    <?= $this->session->flashdata('message'); ?>
    <div class="table-responsive table-striped">
        <table class="table" id="datatable">
            <thead>
                <tr style="text-align: center;">
                    <th>No</th>
                    <th>Kode Pemesanan</th>
                    <th>Nama</th>
                    <th>Paket Wisata</th>
                    <th>No Telepon</th>
                    <th>Nomor Rekening</th>
                    <th>Bukti Pembayaran</th>
                    <th>Jumlah Harus Bayar</th>
                    <th>Jumlah Transfer</th>
                    <th style="width: 10px">Pembayaran Untuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $no = 1;
                foreach ($data_pembayaran as $getData) : ?>
                    <tr style="text-align: center;">
                        <td><?= $no; ?></td>
                        <td><?= $getData->kode_pemesanan; ?></td>
                        <td><?= $getData->nama; ?></td>
                        <td><?= $getData->nama_paket; ?></td>
                        <td><?= $getData->telepon; ?></td>
                        <td><?= $getData->nomor_rekening; ?></td>
                        <td>
                            <button type="button" class="btn" data-toggle="modal" data-target="#myModal<?= $getData->id; ?>">
                                <img src="<?= base_url('assets/img/bukti_pembayaran/') . $getData->bukti_pembayaran; ?>" alt="" width="60">
                            </button>
                        </td>
                        <td>Rp. 
                            <?php
                                    echo number_format($getData->jumlah_bayar);
                            ?> 
                        </td>
                        <td>Rp. <?= number_format($getData->jumlah_transfer); ?></td>
                        <td>
                            <span class="btn btn-primary">
                                <?php
                                    if ($getData->status_pembayaran == 1) {
                                        echo 'DP';
                                    } elseif ($getData->status_pembayaran == 2) {
                                        echo 'Cicilan 2';
                                    } elseif ($getData->status_pembayaran == 3) {
                                        echo 'Lunas';
                                    }
                                ?>
                            </span>
                        </td>
                        <td>
                            <a href="" class="btn btn-info <?php if ($getData->status != 0) { echo 'disabled'; }  ?>" data-toggle="modal" data-target="#pesanAcc<?= $getData->id; ?>"><i class="fas fa-check"></i></a>
                            <a href="" class="btn btn-danger <?php if ($getData->status != 0) { echo 'disabled'; }  ?>" data-toggle="modal" data-target="#batalData<?= $getData->id; ?>"><i class="fas fa-times"></i></a>
                            
                        </td>
                    </tr>
                    <?php include('modal_batal.php') ?>
                    <?php include('modal_bukti.php') ?>
                    <?php include('modal_data_pembayaran.php') ?>
                    <?php $no++;
                endforeach ?>

            </tbody>
        </table>
    </div>
</div>