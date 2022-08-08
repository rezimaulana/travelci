<!-- modal -->
<div class="modal fade" id="batalData<?= $getData->id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <?php echo form_open_multipart('data-pembayaran/batal-pembayaran/' . $getData->pelanggan_id); ?>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Gagal Pembayaran</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?php
                if($getData->status_pembayaran == 3){
                    echo '<input type="hidden" name="jumlah_bayar" value="'.$getData->jumlah_harga.'">';
                }else{
                    echo '<input type="hidden" name="jumlah_bayar" value="'.$getData->jumlah_bayar.'">';
                }
                ?>
                <div class="form-group">
                    <label for="">Jumlah Transfer</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input name="jumlah_transfer" type="text" class="form-control">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="">Pesan Batal Pembayaran</label>
                    <textarea name="pesan" class="form-control" cols="10" rows="5"></textarea>
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