$(function () {
    $(".datatable").DataTable({
        responsive: true,
        autoWidth: false,
        pageLength: 10,
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100],
        ],
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data",
            zeroRecords: "Data tidak ditemukan",
            paginate: {
                previous: "Sebelumnya",
                next: "Berikutnya",
            },
        },
    });
});
