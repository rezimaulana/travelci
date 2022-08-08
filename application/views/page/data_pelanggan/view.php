<!-- Begin Page Content -->

<div class="container-fluid">
    <h2 class="h2 mb-4 text-gray-800">Data Pelanggan</h2>
    <div class="table-responsive table-striped">
        <table class="table" id="datatable">
            <thead>
                <tr style="text-align: center;">
                    <th width="1%">No</th>
                    <th>Nama</th>
                    <th>KTP</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Jenis Kelamin</th>
                </tr>
            </thead>

            <tbody>
                <?php $no = 1; foreach($pelanggan as $getData) : ?>
                    <tr style="text-align: center;">
                        <td><?= $no; ?></td>
                        <td><?= $getData->nama; ?> </td>
                        <td>
                            <?php
                                if($getData->foto_ktp == ''){
                                    echo '<span class="btn btn-warning">Belum ada KTP</span>';
                                }else{
                                    echo '<button type="button" class="btn" data-toggle="modal" data-target="#myModal'.$getData->id.'">
                                    <img src="'.base_url().'assets/img/ktp/'.$getData->foto_ktp.'" alt="" width="100">
                                </button>';
                                }
                            ?>
                        </td>
                        <td><?= $getData->alamat; ?> </td>
                        <td><?= $getData->telepon; ?> </td>
                        <td>
                            <?php 
                                if($getData->jenis_kelamin == "L"){
                                    echo "Laki-laki";
                                }else{
                                    echo "Perempuan";
                                }
                            ?> 
                        </td>
                    </tr>
                <?php 
                include('modal_ktp.php');
                $no++; 
                endforeach ?>
            </tbody>
        </table>
    </div>
</div>