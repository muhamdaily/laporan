$(document).ready(function () {
    // Inisialisasi DataTables
    var table = $('#table-custom').DataTable({
        paging: true,
        pageLength: 10,
        lengthChange: false,
        ordering: false,
        autoWidth: false,
        processing: true,
        language: {
            emptyTable: "Tidak ada data yang tersedia pada tabel ini.",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "(disaring dari total _MAX_ data)",
            zeroRecords: "Data yang kamu cari tidak ditemukan.",
            paginate: {
                next: "Berikutnya",
                previous: "Sebelumnya",
            },
        }
    });

    // Event listener untuk input pencarian
    $('#search-custom').on('keyup', function () {
        table.search($(this).val()).draw();
    });
});
