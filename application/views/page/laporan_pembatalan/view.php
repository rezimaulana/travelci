<!-- Begin Page Content -->
<?php 

$dari_tanggal = isset($_GET['dari_tanggal']) ? $_GET['dari_tanggal']: "" ;
$sampai_tanggal = isset($_GET['sampai_tanggal']) ? $_GET['sampai_tanggal']: "";
?>


<div class="container-fluid">
    <h2 class="h2 mb-4 text-gray-800">Laporan Pembatalan</h2>
    <div class="row mb-5 bg-white" style="min-height:200px">
        <div class="col-md-6 col-lg-6 col-sm-10 m-auto" style="padding:30px">
            <form action="" method="get">
                <div class="form-group">
                    <label for="dari_tanggal"> Dari Tanggal </label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control datepicker" name="dari_tanggal" id="dari_tanggal" placeholder="yyyy-mm-dd" onkeypress="return disableInput(event)" value="<?= $dari_tanggal ?>">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="dari_tanggal"><i class="fas fa-calendar-alt"></i></label>
                        </div>
                    </div>
                </div>
                

                <div class="form-group">
                    <label for="sampai_tanggal"> Sampai Tanggal </label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control datepicker2" name="sampai_tanggal" id="sampai_tanggal" placeholder="yyyy-mm-dd" onkeypress="return disableInput(event)" value="<?= $sampai_tanggal ?>">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="sampai_tanggal"><i class="fas fa-calendar-alt"></i></label>
                        </div>
                    </div>
                </div>
                
                
                <div class="form-group">
                    <button class="btn btn-success">Tampilkan Data</button>
                    

                    <?php if($dari_tanggal == "" AND $sampai_tanggal == ""): ?>
                    <a href="" class="btn btn-warning" onclick="opening('<?= base_url('laporan-pembatalan/0/0') ?>')"><i class="fas fa-print"></i> Cetak</a>
                    <?php else : ?>
                    <a href="" class="btn btn-warning" onclick="opening('<?= base_url('laporan-pembatalan/').$dari_tanggal.'/'.$sampai_tanggal ?>')"><i class="fas fa-print"></i> Cetak</a>
                    <?php endif ?>
                </div>
            </form>
        </div>

    </div>


    <div class="table-responsive table-striped">
        <table class="table" id="datatable">
            <thead>
                <tr style="text-align: center;">
                    <th width="1%">No</th>
                    <th>Kode Pemesanan</th>
                    <th>Nama</th>
                    <th>Paket</th>
                    <th>Harga</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Tanggal Keberangakatan</th>
                    <th>Tanggal Pembatalan</th>
                    <th>Jumlah Peserta</th>
                    <th>Jumlah Bayar</th>
                    <th>Uang Kembali</th>
                </tr>
            </thead> 

            <tbody>
                <?php $no = 1;
                foreach ($laporan_pembatalan as $getData) : ?>
                    <tr style="text-align: center;">
                        <td><?= $no; ?></td>
                        <td><?= $getData->kode_pemesanan; ?></td>
                        <td><?= $getData->nama; ?></td>
                        <td><?= $getData->nama_paket; ?></td>
                        <td>Rp. <?= number_format($getData->jumlah_bayar); ?></td>
                        <td><?= $getData->tanggal_pemesanan; ?></td>
                        <td><?= $getData->tanggal_keberangkatan; ?></td>
                        <td><?= $getData->tanggal_pembatalan; ?></td>
                        <td><?= $getData->jumlah_peserta; ?> Orang</td>
                        <td>Rp. <?= number_format($getData->jumlah_bayar); ?></td>
                        <td>Rp. <?= number_format($getData->uang_kembali); ?></td>
                    </tr>

                    <?php $no++;
                endforeach ?>
            </tbody>
        </table>
    </div>
</div>