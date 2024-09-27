$(document).ready(function() {
    // Escuchar el cambio en el select de la empresa (cliente)
    document.getElementById('empresa').addEventListener('change', function() {
        var selectedClientId = this.value; // Obtener el valor del cliente seleccionado
        var imprimirBtn = document.getElementById('imprimirBtn'); // Obtener el botón de imprimir

        // Obtener la URL base desde el atributo data-url
        var baseUrl = imprimirBtn.getAttribute('data-url');

        // Actualizar el href del botón con el id_cliente seleccionado
        if (selectedClientId) {
            imprimirBtn.href = baseUrl + '/' + selectedClientId;  
        } else {
            // Si no hay cliente seleccionado, limpiar el href
            imprimirBtn.href = '#'; 
        }
    });

    // Validar antes de permitir que el botón de imprimir se pueda usar
    $('#imprimirBtn').on('click', function(e) {
        if (!$('#empresa').val()) {
            e.preventDefault(); // Evitar la redirección
            alert("Debe Seleccionar un Cliente!");
        }
    });
});
