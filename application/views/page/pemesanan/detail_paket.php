<!-- Begin Page Content -->

<div class="container-fluid">
    <h2 class="h2 mb-4 text-gray-800">Detail Paket</h2>

    <div class="row">
        <?php foreach ($detail_paket_wisata as $getData) : ?>
            <div class="col-sm-4">
                <?php foreach ($thumbnail as $getThumbnail) : ?>
                    <img src="<?= base_url('assets/img/') . $getThumbnail->nama_thumbnail; ?>" class="img-responsive" width="300">
                    <div style="margin-top: 10px"></div>
                <?php endforeach; ?>

            </div>
            <div class="col-sm-8">
                <h2 class="h2 mb-4 text-gray-800 text-center"><?= $getData->nama_paket; ?></h2>
                <p><?= $getData->deskripsi; ?></p>
                <p>Fasilitas :
                    <ul>
                        <?php foreach ($fasilitas as $getFasilitas) : ?>
                            <li><?= $getFasilitas->nama_fasilitas; ?></li>
                        <?php endforeach ?>
                    </ul>
                </p>
                <p>Destinasi :
                    <ul>
                        <?php foreach ($destinasi as $getDestinasi) : ?>
                            <li><?= $getDestinasi->nama_destinasi; ?></li>
                        <?php endforeach ?>
                    </ul>
                </p>
                <p>Harga : Rp. <?= number_format($getData->harga); ?> / Orang</p>
                <p>Minimal Orang : <?= $getData->minimal_orang; ?> Orang</p>
                <div class="col-sm-8 mx-auto mt-5">
                    <a href="<?= base_url('form-pemesanan/') . $getData->id; ?>" class="btn btn-info btn-lg btn-block">Pesan Sekarang</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>