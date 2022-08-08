<!-- Begin Page Content -->

<div class="container-fluid">
    <h2 class="h2 mb-4 text-gray-800">Pembayaran</h2>
    <?= $this->session->flashdata('message'); ?>
    <p style="float: left;"><a href="<?= base_url('cetak-kwitansi'); ?>" style="margin-right: 20px;" class="btn btn-info"><i class="fas fa-print"></i> Cetak Kwitansi</a></p>
    <div class="table-responsive table-striped">
        <table class="table" id="datatable">
            <thead>
                <tr style="text-align: center;">
                    <th width="1%">No</th>
                    <th width="1%">Kode Pemesanan</th>
                    <th>Paket</th>
                    <th>Harga</th>
                    <th>Tanggal Keberangkatan</th>
                    <th width="1%">Peserta</th>
                    <th>Total Bayar</th>
                    <th>Sisa Bayar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $no = 1;
                foreach ($pemesanan as $getData) : ?>
                    <tr>
                        <td style="text-align: center;"><?= $no; ?></td>
                        <td style="text-align: center;"><?= $getData->kode_pemesanan; ?></td>
                        <td style="text-align: center;"><?= $getData->nama_paket; ?></td>
                        <td style="text-align: center;">Rp. <?= number_format($getData->jumlah_harga); ?></td>
                        <td style="text-align: center;"><?= $getData->tanggal_keberangkatan; ?></td>
                        <td style="text-align: center;"><?= $getData->jumlah_peserta; ?> Orang</td>
                        <td style="text-align: center;">Rp. <?= number_format($getData->jumlah_bayar); ?></td>
                        <td style="text-align: center;">Rp. <?= number_format($getData->sisa_bayar); ?></td>
                        <td style="text-align: center;">
                            <span class=" btn btn-primary">
                                <?php
                                if ($getData->status_pembayaran == 1) {
                                    echo 'DP';
                                } elseif ($getData->status_pembayaran == 2) {
                                    echo 'Cicilan 2';
                                } elseif ($getData->status_pembayaran == 3) {
                                    echo 'Lunas';
                                } else {
                                    echo 'Belum bayar';
                                }
                                ?>
                            </span>
                        </td>
                        <td style="text-align: center;"><a href="" class="btn btn-success 
                        <?php if ($getData->status_pembayaran == 3) { echo 'disabled';} ?>" data-toggle="modal" data-target="#modalPembayaran<?= $getData->id; ?>"><i class="fas fa-money-check"></i> Bayar</a></td>
                    </tr>
                    <?php
                    include('modal_pembayaran.php');
                    $no++;
                endforeach ?>
            </tbody>

        </table>
    </div>
</div>
