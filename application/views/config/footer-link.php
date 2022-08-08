<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/js/sb-admin-2.min.js'); ?>"></script>

<!-- datatable -->

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<!-- datapicker -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
    $(function () {
          window.onload = $('#sidebarToggleTop').click();
      });
</script>

<script>
    $(document).ready(function() {
        $('#ExportTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'print', 'colvis'
            ]
        });
    });

</script>

<script>
    <?php
    $user = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();
    $pembayaran = $this->db->select('pemesanan.id')->from('pemesanan')->join('paket_wisata', 'paket_wisata_id = paket_wisata.id')->where(['pelanggan_id' => $user['id'], 'pemesanan.status' => 1, 'status_pemesanan' => 0])->get()->result();

    foreach ($pembayaran as $getData) :
        ?>
        var currentDate = new Date();
        $('#datepicker<?= $getData->id; ?>').datepicker({
        dateFormat: 'yy-mm-dd',
        //maxDate: currentDate,
        });
    <?php endforeach ?>
    $('#datepicker').datepicker({
    dateFormat: 'yy-mm-dd',
    });

    $('.datepicker').datepicker({
    dateFormat: 'yy-mm-dd',
    });
    $('.datepicker2').datepicker({
    dateFormat: 'yy-mm-dd',
    });
</script>

<!-- get filename -->
<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>

<script type="text/javascript" language="javascript">
    function printing() {
        window.print();
    }
</script>

<script>
    function opening(url) {
        window.open(url, 'open', "width=800,height=500");
    }
</script>

<script>
    function disableInput(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 1 && (charCode < 2 || charCode > 1))

            return false;
        return true;
    }

    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
    }
</script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "language": {
                "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
                "sProcessing": "Sedang memproses...",
                "sLengthMenu": "Tampilkan _MENU_ data",
                "sZeroRecords": "Tidak ditemukan data yang sesuai",
                "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                "sInfoFiltered": "(disaring dari _MAX_ data keseluruhan)",
                "sInfoPostFix": "",
                "sSearch": "Cari:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "First",
                    "sPrevious": "Previous",
                    "sNext": "Next",
                    "sLast": "Last"
                }
            }
        });
    });
</script>

<script>
    function printContent(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>

</body>

</html>