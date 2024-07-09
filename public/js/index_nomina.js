$(document).ready(function() {
    $('#empleados-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/nomina-empleados/data',
        columns: [
            { data: 'nombre_empleado', name: 'nombre_empleado' },
            { data: 'cedula_identidad', name: 'cedula_identidad' },
            { data: 'cod_contrato', name: 'cod_contrato' },
            { data: 'salario_gobierno', name: 'salario_gobierno' },
            { data: 'salario_empresa', name: 'salario_empresa' },
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