<!-- Modal paket wisata -->
<div class="modal fade bd-example-modal-lg" id="modalEdit<?= $getData->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <?= form_open_multipart('data-paket-wisata/edit-paket/'.$getData->id) ?>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Paket Wisata</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" name="nama_paket" value="<?= $getData->nama_paket ?>">
                </div>

                <div class="form-row">
                    <?php $number = 1;
                    foreach ($destinasi as $getDestinasi) : ?>
                        <div class="form-group col-4">
                            <input type="text" name="destinasi[]" class="form-control" value="<?= $getDestinasi->nama_destinasi; ?>">
                            <input type="hidden" name="destinasi_id[]" class="form-control" value="<?= $getDestinasi->id; ?>">
                        </div>
                    <?php endforeach ?>
                </div>

                <div class="form-row">
                <?php foreach ($custom_destinasi as $getCustomDestinasi) : ?>
                    <div class="form-group col-4">
                        <input type="text" name="custom_destinasi[]" value="<?= $getCustomDestinasi->nama_custom_destinasi ?>" class="form-control"  required>
                        <input type="hidden" name="custom_destinasi_id[]" class="form-control" value="<?= $getCustomDestinasi->id; ?>">
                    </div>
                <?php endforeach ?>
                </div>

                <?php
                $item_fasilitas = $this->db->get_where('item_fasilitas', ['paket_wisata_id' => $getData->id])->result();
                
                $i = 0;
                foreach($item_fasilitas as $getItemFasilitas) : 
                    $itemFasilitas[$i] = $getItemFasilitas->fasilitas_id;
                    $i++;
                    echo '<input type="hidden" name="fasilitas_id[]" value="'.$getItemFasilitas->fasilitas_id.'">';
                endforeach;

                ?>
        

                <?php $fasilitas = $this->db->get('fasilitas')->result(); ?>
                <label for="">Fasilitas</label>
                <div class="form-row">
                    <?php foreach ($fasilitas as $getFasilitas) :?>
                        <div class="form-group col-4">
                            <input type="checkbox" name="fasilitas[]" value="<?= $getFasilitas->id; ?>" <?php if (in_array($getFasilitas->id,$itemFasilitas)){ echo 'checked'; } ?>> <?= ucfirst($getFasilitas->nama_fasilitas); ?>
                        </div>
                        
                    <?php endforeach ?>
                </div>

                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                        </div>
                        <input type="text" class="form-control" name="harga" value="<?= $getData->harga ?>" onkeypress="return hanyaAngka(event)">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="minimal_orang" value="<?= $getData->minimal_orang ?>" onkeypress="return hanyaAngka(event)">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">Orang</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <textarea name="deskripsi" value="Deskripsi" class="form-control" cols="10" rows="3"><?= $getData->deskripsi ?></textarea>
                </div>

                <div class="form-group row">
                    <div class="col-lg">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?= base_url('assets/img/') . $getData->thumbnail; ?>" class="img-thumbnail">
                            </div>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="thumbnail">
                                    <label class="custom-file-label" for="image">Thumbnail Home</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $thumbnail = $this->db->select('thumbnail.id, nama_thumbnail')->from('item_thumbnail')->join('thumbnail', 'thumbnail_id = thumbnail.id')->join('paket_wisata', 'paket_wisata_id = paket_wisata.id')->where(['paket_wisata.id' => $getData->id])->get()->result();

                $no = 1;
                foreach ($thumbnail as $getThumbnail) :
                    ?>
                    <div class="form-group row">
                        <div class="col-lg">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="<?= base_url('assets/img/') . $getThumbnail->nama_thumbnail; ?>" class="img-thumbnail">
                                    <input type="hidden" name="thumbnail_id[]" value="<?= $getThumbnail->id ?>">
                                    <input type="hidden" name="thumbnail_nama[]" value="<?= $getThumbnail->nama_thumbnail ?>">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="thumbnail<?= $no; ?>">
                                        <label class="custom-file-label" for="image">Thumbnail Detail Paket</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $no++;
                endforeach ?>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</div>