
    
<style media="print">
    @page {
        margin: 0px auto;
    }

    .printing {
        display: none !important;
    }
</style>

<style type="text/css">
    /* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Tahoma";
    }

    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        color: #3E909B;
    }

    .subpage {
        padding: 1cm;
        height: 257mm;
        outline: 1cm #3E909B outset;
    }

    .adeeva-color {
        color: #3E909B;
    }
    .p{
        margin-bottom: 5px!important;
        text-align: right;
    }

    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 5mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    @page {
        size: A4;
    }

    @media print {

        html,
        body {
            color: red !important;
            margin: 0px!important;
            margin-top: 50px!important;
        }

        .page {
            margin: 20px;
            padding: 0px;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }

        .print{
            display: none;
        }

        .float-right {
            float: right;
        }

        .p{
        margin-bottom: 5px!important;
        text-align: right;
        margin-top: 0;
    }
    }
</style>

<body>
    <div class="page" id="page">
        <?php foreach($cetak_kwitansi as $getData) :?>
        <?php
            $tanggal_pembayaran = date('Y', strtotime($getData->tanggal_pembayaran)); 
            if($getData->status_pembayaran == 1){
                $status_pembayaran = "DP";
            }elseif($getData->status_pembayaran == 2){
                $status_pembayaran = "Cicilan 2";
            }elseif($getData->status_pembayaran == 3){
                $status_pembayaran = "Lunas";
            }

            $destinasi = $this->db->select('nama_destinasi')->from('item_destinasi')->join('destinasi', 'destinasi_id = destinasi.id')->where(['paket_wisata_id' => $getData->paket_wisata_id])->get()->result();
        ?>
        <div class="container">
            <div class="print mb-5">
                <a href="#" onclick="printing()" class="btn btn-warning"><i class="fas fa-print"></i> Print</a>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <img src="<?= base_url('assets/img/kwitansi.png') ?>" alt="" class="img-responsive float-left" width="300">
                </div>

                <div class="col-md-5 ">
                    <p class="p">Nama Pelanggan : <?= $getData->nama ?></p>
                    <p class="p">Nama Instansi : <?= $getData->nama_instansi ?></p>
                    <p class="p">No Pembayaran : <?= $getData->kode_pemesanan ?></p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="table-responsive">
                <h4 class="text-center">INVOICE</h2>
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Tanggal Transfer</th>
                                <th>Deskripsi</th>
                                <th>Jumlah Transfer</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="text-center">
                                <td>1</td>
                                <td><?= date('d-m-Y', strtotime($getData->tanggal_pembayaran)) ?></td>
                                <td>
                                    <p>Pelunasan <?= $getData->nama_paket ?></p>
                                    <p>pembayaran untuk : <?= $status_pembayaran ?></p>
                                    <p>Route/Tujuan : 
                                    <?php 
                                        foreach($destinasi as $getDestinasi): 
                                            echo $getDestinasi->nama_destinasi.'->';
                                        endforeach;
                                            echo $getData->custom_destinasi;
                                    ?>

                                    </p>
                                </td>
                                <td>Rp. <?= number_format($getData->jumlah_bayar) ?></td>
                            </tr>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="4"><p class="text-right">Total : Rp. <?= number_format($getData->jumlah_bayar) ?></p></td>
                            </tr>
                        </tfoot>
                    </table>
            </div>

            <div class="container">
                <p><b>Mohon Diperhatikan!!!</b></p>
                <ul>
                    <li>Uang muka 25% dari total pembayaran dan tidak bisa ditarik kembali apabila dibatalkan </li>
                    <li>Pelunasan maksimal 7 hari sebelum tanggal keberangkatan Tour</li>
                </ul>
            </div>
        </div>
        <?php endforeach ?>
    </div>