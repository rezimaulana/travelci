<!-- Begin Page Content -->

<div class="container-fluid">
    <h2 class="h2 mb-4 text-gray-800">List Batal Pesanan</h2>
    <div class="table-responsive table-striped">
        <table class="table" id="datatable">
            <thead>
                <tr style="text-align: center;">
                    <th width="1%">No</th>
                    <th width="1%">Kode Pemesanan</th>
                    <th>Paket</th>
                    <th>Harga</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Tanggal Keberangakatan</th>
                    <th>Jumlah Peserta</th>
                    <th>Jumlah Bayar</th>
                    <th>Uang Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <?php $no = 1;
                foreach ($pembatalan as $getData) : ?>
                    <tr style="text-align: center;">
                        <td><?= $no; ?></td>
                        <td><?= $getData->kode_pemesanan; ?></td>
                        <td><?= $getData->nama_paket; ?></td>
                        <td>Rp. <?= number_format($getData->jumlah_bayar); ?></td>
                        <td><?= $getData->tanggal_pemesanan; ?></td>
                        <td><?= $getData->tanggal_keberangkatan; ?></td>
                        <td><?= $getData->jumlah_peserta; ?> Orang</td>
                        <td>Rp. <?= number_format($getData->jumlah_bayar); ?></td>
                        <td>Rp. <?= number_format($getData->uang_kembali); ?></td>
                        <td>
                            <span class="btn btn-danger">Dibatalkan</span>
                        </td>
                    </tr>

                    <?php $no++;
                endforeach ?>
            </tbody>
        </table>
    </div>
</div>