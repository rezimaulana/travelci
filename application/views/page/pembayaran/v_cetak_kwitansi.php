<!-- Begin Page Content -->

<div class="container-fluid">
    <h2 class="h2 mb-4 text-gray-800">Cetak Kwitansi</h2>
    <?= $this->session->flashdata('message'); ?>
    <div class="table-responsive table-striped">
        <table class="table" id="datatable">
            <thead>
                <tr style="text-align: center;">
                    <th width="1%">No</th>
                    <th>Nama Paket</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Jumlah Transfer</th>
                    <th>Status</th>
                    <th>Cetak</th>
                </tr>
            </thead>

            <tbody>
                <?php $no = 1;
                foreach ($pemesanan as $getData) :

                        if($getData->status_pembayaran == 1){
                            $status_pembayaran = 'DP';
                        }elseif($getData->status_pembayaran == 2){
                            $status_pembayaran = 'Cicilan 2';
                        }elseif($getData->status_pembayaran == 3){
                            $status_pembayaran = 'Lunas';
                        } 
                        
                        
                        
                    ?>
                    <tr style="text-align: center;">
                        <td><?= $no; ?></td>
                        <td><?= $getData->nama_paket; ?></td>
                        <td> <?= date('d-m-Y', strtotime($getData->tanggal_pembayaran)); ?></td>
                        <td>Rp. <?= number_format($getData->total_cicilan); ?></td>
                        <td>
                            <span class="btn btn-primary"><?= $status_pembayaran; ?></span>
                        </td>
                        <td><a href="" class="btn btn-warning" onclick="opening('<?= base_url('pembayaran/tab_pembayaran/').$getData->id; ?>')"><i class="fas fa-print"></i> Cetak</a></td>
                    </tr>
                    <?php
                    $no++;
                endforeach ?>
            </tbody>

        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="lihatBank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Daftar Bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Bank</th>
                                <th>No Rekening</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 1;
                            foreach ($rekening as $getRekening) : ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $getRekening->nama_bank; ?></td>
                                    <td><?= $getRekening->no_rekening; ?></td>
                                </tr>
                                <?php $no++;
                            endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>