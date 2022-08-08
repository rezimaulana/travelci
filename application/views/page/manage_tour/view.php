<!-- Begin Page Content -->

<div class="container-fluid"> 
    <h2 class="h2 mb-4 text-gray-800">Manage Tour</h2>
    <?= $this->session->flashdata('message') ?>
    <div class="table-responsive table-striped">
        <table class="table" id="datatable">
            <thead>
                <tr style="text-align: center;">
                    <th width="1%">No</th>
                    <th width="1%">kode Pemesanan</th>
                    <th>Nama Paket</th>
                    <th width="1%">Nama Pelanggan</th>
                    <th>No Telepon</th>
                    <th>Tanggal Keberangkatan</th>
                    <th>Jumlah Peserta</th>
                    <th>Status Pembayaran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $no = 1;
                foreach ($manage_tour as $getData) :
                    ?>
                    <tr style="text-align: center;">
                        <td><?= $no; ?></td>    
                        <td><?= $getData->kode_pemesanan; ?></td>
                        <td><?= $getData->nama_paket; ?></td>    
                        <td><?= $getData->nama; ?></td>    
                        <td><?= $getData->telepon; ?></td>    
                        <td><?= $getData->tanggal_keberangkatan; ?></td>    
                        <td><?= $getData->jumlah_peserta; ?></td>    
                        <td>
                            <?php
                                if($getData->status_pembayaran == 0){
                                    echo '<span class="btn btn-danger">Belum Bayar</span>';
                                }elseif($getData->status_pembayaran == 1){
                                    echo '<span class="btn btn-warning">DP</span>';
                                }elseif($getData->status_pembayaran == 2){
                                    echo '<span class="btn btn-warning">Cicilan 2</span>';
                                }elseif($getData->status_pembayaran == 3){
                                    echo '<span class="btn btn-success">Lunas</span>';
                                }else
                            ?>
                        </td>
                        <td>
                            <?php 
                                if($getData->status_pemesanan == 0){
                                    echo '<span class="btn btn-warning">proses..</span>';
                                }else{
                                    echo '<span class="btn btn-success">selesai</span>';
                                }
                            ?>
                        </td>   
                        <td>
                            <a href="<?= base_url('manage-tour/').$getData->pemesanan_id; ?>" class="btn btn-success"><i class="fas fa-check"></i></a>
                        </td>
                    </tr>
                    <?php
                    $no++;
                endforeach
                ?>
            </tbody>
        </table>
    </div>
</div>