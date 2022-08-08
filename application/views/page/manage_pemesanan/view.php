<!-- Begin Page Content -->

<div class="container-fluid">
    <h2 class="h2 mb-4 text-gray-800">Manage Pemesanan</h2>
    <?= $this->session->flashdata('message') ?>
    <div class="table-responsive table-striped">
        <table class="table" id="datatable">
            <thead>
                <tr style="text-align: center;">
                    <th>No</th>
                    <th>Kode Pemesanan</th>
                    <th>Nama Paket</th>
                    <th>Destinasi</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Instansi</th>
                    <th>Foto Ktp</th>
                    <th>Tanggal Keberangkatan</th>
                    <th>Jumlah Peserta</th>
                    <th>Status</th>
                    <th>Persetujuan</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $no = 1;
                foreach ($manage_pemesanan as $getData) :
                    
                    $destinasi = $this->db->select('nama_destinasi')->from('item_destinasi')->join('destinasi', 'destinasi_id = destinasi.id')->where(['paket_wisata_id' => $getData->paket_wisata_id])->limit(2)->get()->result();
                    
                    ?>
                    <tr style="text-align: center;">
                        <td><?= $no; ?></td>
                        <td><?= $getData->kode_pemesanan; ?></td>
                        <td><?= $getData->nama_paket; ?></td>
                        <td>
                            <ul>
                                <?php foreach($destinasi as $getDestinasi) : ?>
                                <li><?= $getDestinasi->nama_destinasi ?></li>
                                <?php endforeach ?>
                                <?php
                                    if($getData->custom_destinasi != ''){
                                        echo '<li>'.$getData->custom_destinasi.'</li>';
                                    }
                                ?>
                            </ul>
                        </td>
                        <td><?= $getData->nama; ?></td>
                        <td><?= $getData->nama_instansi; ?></td>
                        <td>
                            <button type="button" class="btn" data-toggle="modal" data-target="#myModal<?= $getData->id_pelanggan; ?>">
                                <img src="<?= base_url('assets/img/ktp/') . $getData->foto_ktp; ?>" alt="" width="100">
                            </button>
                        </td>
                        <td><?= $getData->tanggal_keberangkatan; ?></td>
                        <td><?= $getData->jumlah_peserta; ?></td>
                        <td>
                            <?php if ($getData->status == 0) : ?>
                                <span class="btn btn-warning">Pending</span>
                            <?php elseif ($getData->status == 1) : ?>
                                <span class="btn btn-success">Disetujui</span>
                            <?php elseif ($getData->status == 2) : ?>
                                <span class="btn btn-danger">Tidak</span>
                            <?php endif ?>
                        </td>
                        <td>
                            
                            <a class="btn btn-success <?php if($getData->status != 0){echo 'disabled'; } ?>" href=" <?= base_url('manage-pemesanan/1/') . $getData->id_pelanggan . '/' . $getData->id; ?>"><i class=" fas fa-check"></i></a>

                            <a class="btn btn-danger <?php if($getData->status != 0){echo 'disabled'; } ?>" href="#" data-toggle="modal" data-target="#modalPenolakkan<?= $getData->id; ?>"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                    <?php
                    include('modal_ktp.php');
                    include('modal_penolakan.php');
                    $no++;
                endforeach
                ?>
            </tbody>
        </table>
    </div>
</div>