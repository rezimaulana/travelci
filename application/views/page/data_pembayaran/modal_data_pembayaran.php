<!-- modal -->
<div class="modal fade" id="pesanAcc<?= $getData->id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <?php echo form_open_multipart('data-pembayaran/' . $getData->id .'/'. $getData->id_pemesanan); ?>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Data Pembayaran</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="jumlah_harga" value="<?= $getData->jumlah_harga ?>">

                <div class="form-group">
                    <label for="">Jumlah Transfer</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input name="jumlah_bayar" value="<?= number_format($getData->jumlah_transfer) ?>" type="text" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Status Pembayaran</label>
                    <select class="custom-select" name="status" required>
                        <option value="" selected>-Pilih Status Pembayaran-</option>
                        <option value="1" <?php if($getData->status_pembayaran == 1){echo 'selected'; } ?>>Dp</option>
                        <option value="2" <?php if($getData->status_pembayaran == 2){echo 'selected'; } ?>>Cicilan 2</option>
                        <option value="3" <?php if($getData->status_pembayaran == 3){echo 'selected'; } ?>>Lunas</option>
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
            </div>
        </div>
        </form>
    </div>
</div>