$(document).ready(function() {
    const totalVentasInput = $('#total_ventas');
    const baseImpoContribuyenteInput = $('#base_impo_contribuyente');
    const alicuotaContribuyenteInput = $('#alicuota_contribuyente');
    const impuestoIvaContribuyenteInput = $('#impuesto_iva_contribuyente');
    const baseImpoNoContribuyenteInput = $('#base_impo_no_contribuyente');
    const alicuotaNoContribuyenteInput = $('#alicuota_no_contribuyente');
    const impuestoIvaNoContribuyenteInput = $('#impuesto_iva_no_contribuyente');
    const rifInput = $('#nro_rif');

    const calcularValores = () => {
        const totalVentas = parseFloat(totalVentasInput.val()) || 0;
        const alicuotaContribuyente = parseFloat(alicuotaContribuyenteInput.val()) / 100 || 0.16;
        const alicuotaNoContribuyente = parseFloat(alicuotaNoContribuyenteInput.val()) / 100 || 0.16;
        const rif = rifInput.val() || '';

        let baseImpoContribuyente = 0;
        let impuestoIvaContribuyente = 0;
        let baseImpoNoContribuyente = 0;
        let impuestoIvaNoContribuyente = 0;

        if (rif.startsWith('J') || rif.startsWith('G')) {
            baseImpoContribuyente = totalVentas / (1 + alicuotaContribuyente);
            impuestoIvaContribuyente = baseImpoContribuyente * alicuotaContribuyente;
        } else if (rif.startsWith('L')) {
            baseImpoNoContribuyente = 0;
        } else {
            baseImpoNoContribuyente = totalVentas / (1 + alicuotaNoContribuyente);
            impuestoIvaNoContribuyente = baseImpoNoContribuyente * alicuotaNoContribuyente;
        }

        baseImpoContribuyenteInput.val(baseImpoContribuyente.toFixed(2));
        impuestoIvaContribuyenteInput.val(impuestoIvaContribuyente.toFixed(2));
        baseImpoNoContribuyenteInput.val(baseImpoNoContribuyente.toFixed(2));
        impuestoIvaNoContribuyenteInput.val(impuestoIvaNoContribuyente.toFixed(2));
    };

    totalVentasInput.on('input', calcularValores);
    rifInput.on('input', calcularValores);
});