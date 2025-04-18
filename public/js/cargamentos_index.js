$(document).ready(function() {
    $('#cargamentos-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/cargamentos/data',
        columns: [
            { data: 'id_cargamento', name: 'id_cargamento' },
            { data: 'nro_factura', name: 'nro_factura' },
            { data: 'fecha', name: 'fecha' },
            {
                data: 'acciones',
                name: 'acciones',
                orderable: false,
                searchable: false
            }
        ],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            }
        ]
    });
});