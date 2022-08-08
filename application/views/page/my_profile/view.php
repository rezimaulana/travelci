<div class="container-fluid">
    <h2 class="h2 mb-4 text-gray-800">My Profile</h2>
    <?= $this->session->flashdata('message') ?>
    <div class="col-lg-10 mx-auto">
        <?php echo form_open_multipart('my-profile/edit-profile'); ?>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="email" value="<?= $pelanggan['email'] ?>" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nama" value="<?= $pelanggan['nama'] ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="alamat" value="<?= $pelanggan['alamat'] ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Telepon</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="telepon" value="<?= $pelanggan['telepon'] ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-2">Foto Ktp</div>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-3">
                        <a href="" data-toggle="modal" data-target="#fotoKtp">
                            <img src="<?= base_url('assets/img/ktp/') . $pelanggan['foto_ktp']; ?>" class="img-thumbnail">
                        </a>
                    </div>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="picture">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group justify-content-end row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </div>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="fotoKtp" tabindex="-1" role="dialog" aria-labelledby=" myLargeModalLabel " aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col-lg">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" class="mb-4">
                        <span aria-hidden="true"><i class="fas  fa-window-close" style="color: red;"></i></span>
                    </button>
                    <!-- gambar ktp -->
                    <img src="<?= base_url('assets/img/ktp/') . $pelanggan['foto_ktp']; ?>" class="img-thumbnail" width="740">
                </div>
            </div>
        </div>
    </div>
</div>