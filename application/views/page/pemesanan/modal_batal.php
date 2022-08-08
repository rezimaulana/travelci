<!-- Modal -->

<div class="modal fade" id="modalBatal<?= $getData->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('pembatalan/proses_pembatalan/').$getData->id; ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: red">Peringatan!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <h6>Jika Pembatalan dilakukan kurang dari 5 hari sebelum hari keberangkatan maka uang akan hangus</h6>
                    <h6>Jika Pembatalan dilakukan lebih dari 5 hari sebelum keberangkatan maka uang dikembalikan 25% dari total pembayaran</h6>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Lanjut</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>