<!-- Begin Page Content -->

<div class="container-fluid">
    <h2 class="h2 mb-4 text-gray-800">Data Pembatalan</h2>
    <div class="table-responsive table-striped">
        <table class="table" id="datatable">
            <thead>
                <tr style="text-align: center;">
                    <th width="1%">No</th>
                    <th>Nama</th>
                    <th>Telepon</th> 
                    <th>Paket</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Tanggal Keberangakatan</th>
                    <th>Jumlah Peserta</th>
                    <th>Jumlah Bayar</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $no=1; foreach($data_pembatalan as $getData) : ?>
                    <tr style="text-align: center;">
                        <td><?= $no; ?></td>
                        <td><?= $getData->nama; ?></td>
                        <td><?= $getData->telepon; ?></td>
                        <td><?= $getData->nama_paket; ?></td>
                        <td><?= $getData->tanggal_pemesanan; ?></td>
                        <td><?= $getData->tanggal_keberangkatan; ?></td>
                        <td><?= $getData->jumlah_peserta; ?> Orang</td>
                        <td>Rp. <?= $getData->jumlah_bayar; ?></td>
                        
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>