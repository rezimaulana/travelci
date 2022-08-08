<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h2 class="h2 mb-4 text-gray-800">Form Pemesanan</h2>
    <?php foreach ($paket_wisata as $getData) : ?>
        <?php foreach ($pelanggan as $getPelanggan) : ?>
            <div class="row">
                <div class="col-lg">
                    <?php echo form_open_multipart('pemesanan/proses_pemesanan/' . $getData->id); ?>
                    <div class="col-md col-sm col-lg-7 mx-auto">
                        <?= $this->session->flashdata('message'); ?>
                        <div class="form-group">
                            <label for="">Paket</label>
                            <input type="text" class="form-control" value="<?= $getData->nama_paket; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="">Harga</label>
                            <input type="text" class="form-control" value="Rp. <?= number_format($getData->harga); ?> / Orang" readonly>
                        </div>

                        <div class="form-group">
                            <label for="">Tanggal Keberangkatan</label>
                            <div class="input-group mb-3">
                                <input name="tgl_berangkat" type="text" class="form-control" id="datepicker" onkeypress="return disableInput(event)" required>
                                <div class="input-group-append">
                                    <label class="input-group-text" for="datepicker"><i class="far fa-calendar-alt"></i></label>
                                </div> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Jumlah Peserta</label>
                            <input name="jumlah_peserta" type="text" class="form-control" onkeypress="return hanyaAngka(event)" required>
                        </div>

                        <div class="form-group">
                            <label for="">Nama Instansi</label>
                            <input name="nama_instansi" type="text" class="form-control" required>
                        </div>

                        <label for="">Destinasi</label>
                        <div class="form-row mb-4">
                            <?php foreach($destinasi as $getDestinasi) : ?>
                            <div class="col-4">
                                <input type="text" value="<?= $getDestinasi->nama_destinasi ?>" class="form-control" readonly>
                            </div>
                            <?php endforeach ?>

                            <?php 
                                foreach($destinasi3 as $destinasi3){
                                    $otherDestination = $destinasi3->nama_destinasi;
                                }
                            ?>
                            
                            <div class="col-4">
                                <select name="custom_destinasi" class="form-control" required>
                                    <option value="<?= $otherDestination ?>" selected><?= $otherDestination; ?></option>
                                    <?php foreach($custom_destinasi as $getCustomDestinasi) : ?>
                                    <option value="<?= $getCustomDestinasi->nama_custom_destinasi ?>"><?= $getCustomDestinasi->nama_custom_destinasi ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            
                          
                        </div>

                        <?php if ($getPelanggan->telepon == '') : ?>
                            <div class="form-group">
                                <label for="">Telepon</label>
                                <input name="telepon" type="text" class="form-control" onkeypress="return hanyaAngka(event)" required>
                            </div>
                        <?php endif ?>

                        <?php if ($getPelanggan->alamat == '') : ?>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input name="alamat" type="text" class="form-control" required>
                            </div>
                        <?php endif ?>

                        <?php if ($getPelanggan->foto_ktp == '') : ?>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="fotoKtp">
                                    <label class="custom-file-label">Upload KTP</label>
                                </div>
                            </div>
                        <?php endif ?>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>
<!-- /.container-fluid -->