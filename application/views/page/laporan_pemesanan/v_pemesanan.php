<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cetak Laporan</title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/img/logo.png'); ?>" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
            color: #000;
            font-family: 'Times New Roman', Times, serif;
        }

        .subpage {
            padding: 1cm;
            height: 257mm;
            outline: 1cm #3E909B outset;
        }

        .adeeva-color {
            color: #3E909B;
        }

        .p {
            margin-bottom: 5px !important;
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
                margin: 0px !important;
                margin-top: 50px !important;
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

            .print {
                display: none;
            }

            .float-right {
                float: right;
            }

            .p {
                margin-bottom: 5px !important;
                text-align: right;
                margin-top: 0;
            }

            .btn {
                background-color: white;
                border: 1px white solid;
                color: black;
            }
        }
    </style>

</head>

<body>
    <div class="page" id="page">
        <div id="container">
            <div class="col-md-12 text-center">
                <img src="../../assets/img/logo.png" style="width: 30mm; float: left;">
            </div>
            <div style="width: 100%; text-align: center; padding-left: auto; font-size: 24px;"><b>ADEEVA TOUR DAN TRAVEL</b></div>
            <div style="width: 100%; text-align: center; padding-left: auto;"><b>Perum Gambiran Regency 12B Jl.Bromo Magetan ,Jawa Timur</b></div>
            <div style="width: 100%; text-align: center; padding-left: auto;"><b>Telepon +62 813-1202-842</b></div>
            <div style="width: 100%; text-align: center; padding-left: auto;"><b>E-mail
            Adeevatour@gmail.com</b></div>
            <br />
            <br />
            <hr>
        </div>

        <div class="container">
            <h2 class="text-center"><b>Laporan Pemesanan</b></h2>

            <div class="form-group">
                <table class="table table-borderless">
                    <tr class="text-left">
                        <?php
                        if ($dari_tanggal != "") {
                            echo "
                            <td>Periode Cetak</td>
                            <td>: " . $dari_tanggal . " - " . $sampai_tanggal . " </td>
                            ";
                        }
                        ?>
                    </tr>
                </table>
            </div>

            <div class="form-group">
                <table class="table table-responsive table-bordered" id="datatable">
                    <thead>
                        <tr style="text-align: center;">
                            <th>Kode Pemesanan</th>
                            <th>Nama</th>
                            <th>Paket</th>
                            <th>Destinasi</th>
                            <th>Nama Instansi</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Tanggal Keberangakatan</th>
                            <th>Jumlah Peserta</th>
                        </tr>
                    </thead>

                    <tbody>
                        <!-- <img src="<?= base_url('assets/img/kwitansi.png') ?>" alt=""> -->
                        <?php $no = 1;
                        foreach ($laporan_pemesanan as $getData) :

                            $destinasi = $this->db->select('nama_destinasi')->from('item_destinasi')->join('destinasi', 'destinasi_id = destinasi.id')->where(['paket_wisata_id' => $getData->paket_wisata_id])->get()->result();
                            ?>

                            <tr style="text-align: center;">
                                <td><?= $getData->kode_pemesanan; ?></td>
                                <td><?= $getData->nama; ?></td>
                                <td><?= $getData->nama_paket; ?></td>
                                <td>
                                    <ul>
                                        <?php foreach ($destinasi as $getDestinasi) : ?>
                                            <li><?= $getDestinasi->nama_destinasi; ?></li>
                                        <?php endforeach ?>
                                        <?php
                                        if ($getData->custom_destinasi != '') {
                                            echo '<li>' . $getData->custom_destinasi . '</li>';
                                        }
                                        ?>
                                    </ul>
                                </td>
                                <td><?= $getData->nama_instansi; ?></td>
                                <td><?= $getData->tanggal_pemesanan; ?></td>
                                <td><?= $getData->tanggal_keberangkatan; ?></td>
                                <td><?= $getData->jumlah_peserta; ?> Orang</td>
                            </tr>

                            <?php $no++;
                        endforeach ?>
                    </tbody>
                </table>
            </div>

            <div class="form-group text-right">
                <p>Tanggal Cetak : <?= date('Y-m-d ') ?></p>
                <p>Penanggung Jawab : Manager Tour</p>
            </div>

        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        window.onload = function() {
            var css = '@page { size: landscape; }',
            head = document.head || document.getElementsByTagName('head')[0],
            style = document.createElement('style');

            style.type = 'text/css';
            style.media = 'print';

            if (style.styleSheet){
            style.styleSheet.cssText = css;
            } else {
            style.appendChild(document.createTextNode(css));
            }

            head.appendChild(style);

            window.print();
        }
    </script>
</body>

</html>