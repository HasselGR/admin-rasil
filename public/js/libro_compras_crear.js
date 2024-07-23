$(document).ready(function() {
    const totalComprasInput = $('#total_compras');
    const comprasSinDerechoIvaInput = $('#compras_sin_derecho_iva');
    const descuentoTgifInput = $('#descuento_tgif');
    const baseImpoContribuyenteInput = $('#base_impo_contribuyente');
    const impuestoIvaContribuyenteInput = $('#impuesto_iva_contribuyente');
    const baseImpoContribuyenteAlicRedInput = $('#base_impo_contribuyente_alic_red');
    const impuestoIvaContribuyenteAlicRedInput = $('#impuesto_iva_contribuyente_alic_red');
    const ivaRetenido = $('#iva_retenido');


    const calcularValores = () => {
        const totalCompras = parseFloat(totalComprasInput.val()) || 0;
        const comprasSinDerechoIva = parseFloat(comprasSinDerechoIvaInput.val()) || 0;
        const descuentoTgif = parseFloat(descuentoTgifInput.val()) || 0;
        const alicuotaGeneral = 0.16;

        const baseImpoContribuyente = (totalCompras - comprasSinDerechoIva - descuentoTgif) / (1 + alicuotaGeneral);
        const impuestoIvaContribuyente = baseImpoContribuyente * alicuotaGeneral;

        baseImpoContribuyenteInput.val(baseImpoContribuyente.toFixed(2));
        impuestoIvaContribuyenteInput.val(impuestoIvaContribuyente.toFixed(2));
        ivaRetenido.val((impuestoIvaContribuyente * 0.75).toFixed(2))
    };  


    $('#create-compra-form').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Gather form data
        var formData = $(this).serialize();

        // Perform the AJAX request
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            success: function(response) {
                // Handle success, e.g., display a success message or redirect
                alert('Form submitted successfully!');
                console.log(response);
                window.location.href = '/main'; // Redirect to the desired page
            },
            error: function(xhr, status, error) {
                // Handle error, e.g., display an error message
                alert('Error submitting form: ' + error);
                console.error(xhr, status, error);
            }
        });
    });

    
    totalComprasInput.on('input', calcularValores);
    comprasSinDerechoIvaInput.on('input', calcularValores);
    descuentoTgifInput.on('input', calcularValores);
});