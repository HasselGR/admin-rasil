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


    $(document).on('submit', '.form-eliminar', function (e) {
        e.preventDefault(); // Previene el envío inmediato
        console.log('Formulario de eliminación enviado');
        // Confirmación
        if (confirm('¿Estás seguro de que deseas eliminar este registro? Esta acción no se puede deshacer. Recuerde que si posee otro registro asignado no podrá eliminarlo.')) {
            const form = this;

            // Enviar el formulario manualmente con AJAX para manejar errores
            $.ajax({
                url: form.action,
                method: $(form).attr('method'),
                data: $(form).serialize(),
                success: function (response) {
                    // Puedes mostrar una alerta o recargar la tabla
                    alert('registro eliminado correctamente.');
                    $('#empleados-table').DataTable().ajax.reload(); // Recarga tabla
                },
                error: function (xhr, status, error) {
                    console.error('Error al eliminar:', error);
                    alert('Ocurrió un error al intentar eliminar el registro. Recuerde que si posee un registro asignado no podrá eliminarlo.');
                }
            });
        }
    });

});