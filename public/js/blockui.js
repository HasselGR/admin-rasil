$(document).ready(function() {
    // Generaliza el uso de BlockUI para todas las solicitudes Ajax
    $(document).ajaxStart(function() {
        $.blockUI({
            message: '<div class="spinner-border" role="status"><span class="sr-only">Cargando...</span></div>',
            css: {
                backgroundColor: 'transparent',
                border: 'none'
            }
        });
    }).ajaxStop(function() {
        $.unblockUI();
    });

    // Manejo genérico para formularios con Ajax
    $('form').on('submit', function(event) {
        event.preventDefault(); // Evitar el envío tradicional del formulario

        var form = $(this); 
        var formData = form.serialize(); // Serializar datos del formulario

        $.ajax({
            url: form.attr('action'), // Obtener la URL desde el atributo "action" del formulario
            method: form.attr('method'), // Obtener el método (POST, PUT, DELETE) desde el atributo "method"
            data: formData,
            success: function(response) {
                if (response.success) {
                    // Redirigir a la URL de éxito si se envía en la respuesta
                    if (response.redirect_url) {
                        alert('Operación exitosa.')
                        window.location.href = response.redirect_url;
                    } else {
                        // Si no hay redirección, puedes mostrar un mensaje de éxito
                        alert(response.message || 'Operación exitosa');
                    }
                }
            },
            error: function(xhr) {
                // Manejo de errores
                var errors = xhr.responseJSON.errors || {};
                var errorMessage = xhr.responseJSON.message || 'Error inesperado.';
                
                console.log(errorMessage);
                alert(errorMessage);

                // Opcionalmente, puedes mostrar mensajes de error específicos para cada campo
                $.each(errors, function(field, messages) {
                    alert(messages.join(', ')); // Mostrar mensajes de error para cada campo
                });
            }
        });
    });
});