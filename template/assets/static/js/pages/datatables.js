let jquery_datatable = $("#table1").DataTable({
    responsive: true,
    "pageLength": 25,
})
let datakosong_datatable = $("#datakosong").DataTable({
    responsive: true,
    "pageLength": 25,
})
let kasuskosong_datatable = $("#kasuskosong").DataTable({
    responsive: true,
    "pageLength": 25,
    "lengthMenu": [
        [10, 25, 50, 100, 250, 500, 1000, 1500, 2000, 2500, 5000, -1], 
        [10, 25, 50, 100, 250, 500, 1000, 1500, 2000, 2500, 5000, "All"]
    ]
})
let dokter_datatable = $("#dokter").DataTable({
    responsive: true,
    "pageLength": 25,
})
let poliklinik_datatable = $("#tindakanpoliklinik").DataTable({
    responsive: true,
    "pageLength": 25,
})
let ird_datatable = $("#tindakanird").DataTable({
    responsive: true,
    "pageLength": 25,
})
let layanan_datatable = $("#tablelayanan").DataTable({
    responsive: true,
    "pageLength": 25,
})
let customized_datatable = $("#table2").DataTable({
    responsive: true,
    pagingType: 'simple',
    dom:
		"<'row'<'col-3'l><'col-9'f>>" +
		"<'row dt-row'<'col-sm-12'tr>>" +
		"<'row'<'col-4'i><'col-8'p>>",
    "language": {
        "info": "Page _PAGE_ of _PAGES_",
        "lengthMenu": "_MENU_ ",
        "search": "",
        "searchPlaceholder": "Search.."
    }
})

const setTableColor = () => {
    document.querySelectorAll('.dataTables_paginate .pagination').forEach(dt => {
        dt.classList.add('pagination-primary')
    })
}
setTableColor()
jquery_datatable.on('draw', setTableColor)