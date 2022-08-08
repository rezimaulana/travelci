<!-- Begin Page Content -->

<div class="container-fluid">
    <h2 class="h2 mb-4 text-gray-800">Data Paket Wisata</h2>
    <?= $this->session->flashdata('message'); ?>
    <p style="float: left;"><a href="#" style="margin-right: 20px;" class="btn btn-info" data-toggle="modal" data-target="#tambahPaket"><i class="fas fa-plus"></i> Tambah Paket Wisata</a></p>
    <p style="float: left;"><a href="#" style="margin-right: 20px;" class="btn btn-info" data-toggle="modal" data-target="#tambahFasilitas"><i class="fas fa-plus"></i> Tambah Fasilitas</a></p>
    <div class="table-responsive table-striped">
        <table class="table" id="datatable">
            <thead>
                <tr style="text-align: center;">
                    <th width="1%">No</th>
                    <th>Nama Paket</th>
                    <th>Nama Destinasi</th>
                    <th>Custom Destinasi</th>
                    <th>Fasilitas</th>
                    <th>Harga Paket</th>
                    <th>Minimal Orang</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $no_paket = 1;
                foreach ($paket_wisata as $getData) : ?>
                    <tr style="text-align: center;">
                        <td><?= $no_paket; ?></td>
                        <td><?= $getData->nama_paket; ?></td>
                        <?php
                        $fasilitas = $this->db->select('item_fasilitas.id,nama_fasilitas')->from('item_fasilitas')->join('fasilitas', 'fasilitas_id = fasilitas.id')->where(['paket_wisata_id' => $getData->id])->get()->result();

                        $destinasi = $this->db->select('destinasi.id,nama_destinasi')->from('item_destinasi')->join('destinasi', 'destinasi_id = destinasi.id')->where(['paket_wisata_id' => $getData->id])->get()->result();

                        $custom_destinasi = $this->db->select('custom_destinasi.id,nama_custom_destinasi')->from('item_custom_destinasi')->join('custom_destinasi', 'custom_destinasi_id = custom_destinasi.id')->where(['paket_wisata_id' => $getData->id])->get()->result();
                        ?>
                        <td>
                            <ul>
                                <?php foreach ($destinasi as $getDestinasi) : ?>
                                    <li><?= $getDestinasi->nama_destinasi; ?></li>
                                <?php endforeach ?>
                            </ul>
                        </td>
                        <td>
                            <ul>
                                <?php foreach ($custom_destinasi as $getCustomDestinasi) : ?>
                                    <li><?= $getCustomDestinasi->nama_custom_destinasi; ?></li>
                                <?php endforeach ?>
                            </ul>
                        </td>
                        <td>
                            <ul>
                                <?php foreach ($fasilitas as $getFasilitas) : ?>
                                    <li><?= $getFasilitas->nama_fasilitas; ?></li>
                                <?php endforeach ?>
                            </ul>
                        </td>

                        <td>Rp. <?= number_format($getData->harga) ?></td>
                        <td><?= $getData->minimal_orang ?> Orang</td>
                        <td>
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit<?= $getData->id ?>"><i class="fas fa-edit"></i></a>
                            <a href="<?= base_url('data-paket-wisata/') . $getData->id; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php
                    $no_paket++;
                    include('modal_edit_paket.php');
                endforeach ?>

            </tbody>
        </table>
    </div>
</div>

<?php $this->load->view('page/data_paket_wisata/modal_tambah_paket'); ?>
<?php $this->load->view('page/data_paket_wisata/modal_tambah_fasilitas'); ?>