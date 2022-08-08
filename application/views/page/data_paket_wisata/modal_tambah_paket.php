<!-- Modal paket wisata -->
<div class="modal fade" id="tambahPaket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <?= form_open_multipart('data-paket-wisata/tambah-paket') ?>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Paket Wisata</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" name="nama_paket" placeholder="Nama Paket" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-4">
                        <input type="text" name="destinasi[]" class="form-control" placeholder="Destinasi 1"  required>
                    </div>
                    <div class="form-group col-4">
                        <input type="text" name="destinasi[]" class="form-control" placeholder="Destinasi 2"  required>
                    </div>
                    <div class="form-group col-4">
                        <input type="text" name="destinasi[]" class="form-control" placeholder="Destinasi 3"  required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-4">
                        <input type="text" name="custom_destinasi[]" class="form-control" placeholder="Custom Destinasi 1"  required>
                    </div>
                    <div class="form-group col-4">
                        <input type="text" name="custom_destinasi[]" class="form-control" placeholder="Custom Destinasi 2"  required>
                    </div>
                    <div class="form-group col-4">
                        <input type="text" name="custom_destinasi[]" class="form-control" placeholder="Custom Destinasi 3"  required>
                    </div>
                </div>

                <?php $fasilitas = $this->db->get('fasilitas')->result(); ?>
                <label for="">Fasilitas</label>
                <div class="form-row">
                    <?php foreach ($fasilitas as $getFasilitas) : ?>
                        <div class="form-group col-4">
                            <input type="checkbox" name="fasilitas[]" value="<?= $getFasilitas->id; ?>"> <?= ucfirst($getFasilitas->nama_fasilitas); ?>

                        </div>
                    <?php endforeach ?>
                </div>

                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                        </div>
                        <input type="text" class="form-control" name="harga" placeholder="Harga" onkeypress="return hanyaAngka(event)" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="minimal_orang" placeholder="Minimal Orang" onkeypress="return hanyaAngka(event)" required>
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">Orang</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <textarea name="deskripsi" placeholder="Deskripsi" class="form-control" cols="10" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <div class="input-group mb-3">

                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="thumbnail" required>
                            <label class="custom-file-label">Thumbnail Home</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="thumbnail_detail1" required>
                            <label class="custom-file-label">Thumbnail Detail Paket</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="thumbnail_detail2" required>
                            <label class="custom-file-label">Thumbnail Detail Paket</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="thumbnail_detail3">
                            <label class="custom-file-label">Thumbnail Detail Paket</label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</div>