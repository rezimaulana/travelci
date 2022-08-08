<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="myModal<?= $getData->id; ?>" tabindex="-1" role="dialog" aria-labelledby=" myLargeModalLabel " aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col-lg">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" class="mb-4">
                        <span aria-hidden="true"><i class="fas  fa-window-close" style="color: red;"></i></span>
                    </button>
                    <!-- gambar ktp -->
                    <img src=" <?= base_url('assets/img/bukti_pembayaran/') . $getData->bukti_pembayaran; ?>" alt="" class="img-responsive" width="740">
                </div>
            </div>
        </div>
    </div>
</div>