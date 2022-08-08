<div class="modal fade" id="modalPembayaran<?= $getData->id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <?php echo form_open_multipart('pembayaran/proses_pembayaran/' . $getData->id); ?>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Form Pembayaran</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Paket</label>
                    <input type="text" class="form-control" value="<?= $getData->nama_paket ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="">Jumlah Harga</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="text" class="form-control" value="<?= number_format($getData->jumlah_harga) ?>" readonly>
                    </div>
                </div>

                
                 
                <?php if ($getData->status_pembayaran != 0 and $getData->status_pembayaran != 4) : ?>
                    <div class="form-group">
                        <label for="">Sisa Bayar</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="text" class="form-control" value="<?php if ($getData->status_pembayaran == 0) {
                                echo '0';
                            } else {
                                echo number_format($getData->sisa_bayar);
                            } ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Cicilan Selanjutnya</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="text" name="jumlah_bayar" class="form-control" value="<?php if ($getData->status_pembayaran == 1) {
                                    echo number_format($getData->sisa_bayar * 0.75);
                                } elseif ($getData->status_pembayaran == 2) {
                                    echo number_format($getData->sisa_bayar);
                                } ?>" readonly>
                        </div>
                    </div>
                <?php endif ?>

                <div class="form-group">
                    <label for="">Pembayaran</label>
                    <select class="custom-select" name="status_pembayaran" required>
                        <option value="" selected>-Pilih Pembayaran-</option>
                        <?php
                            if($getData->status_pembayaran == 0){
                                echo '<option value="1">DP</option>
                                <option value="2">Cicilan 2</option>
                                <option value="3">Lunas</option>';
                            }elseif($getData->status_pembayaran == 1){
                                echo '
                                <option value="2">Cicilan 2</option>
                                <option value="3">Lunas</option>';
                            }elseif($getData->status_pembayaran == 2){
                                echo '<option value="3" selected>Lunas</option>';
                            }
                        ?>
                    </select>
                    <small><span style="color: red;">*</span><i>Jika memilih DP. Untuk DP sebesar Rp. <?php $cicil = number_format($getData->jumlah_harga * 0.25); echo $cicil; ?></i></small>
                </div>

                <div class="form-group">
                    <label for="">Jumlah Transfer</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="text" name="jumlah_transfer" class="form-control" required>
                    </div>
                </div> 

                <div class="form-group">
                    <div class="form-group">
                        <label for="datepicker<?= $getData->id ?>">Tanggal Pembayaran</label>
                        <input type="text" name="tanggal_bayar" class="form-control" id="datepicker<?= $getData->id ?>" onkeypress="return disableInput(event)" placeholder="yy/mm/dd" required>
                    </div>
                </div> 

                <div class="form-group">
                    <label for="">Nomor Rekening Pengirim</label>
                    <input type="text" name="nomor_rekening" onkeypress="return hanyaAngka(event)" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="">Nomor Rekening Penerima</label>
                    <input type="text" value="900-00-3492470-5 A/n Umar Said Aghil Sirad (Bank Mandiri)" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="">Upload Pembayaran</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="bukti_pembayaran" required>
                            <label class="custom-file-label"></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
            </div>
        </div>
        </form>
    </div>
</div