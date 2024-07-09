// public/js/asignaciones_deducciones.js

$(document).ready(function() {
    // Cargar quincenas al cargar la página
    loadQuincenas();
    let salario = 0


    $('#id_quincena').on("change", function() {
        var selectedOption = $(this).find(':selected');
        var fechaInicio = selectedOption.data('fecha-inicio');
        console.log("🚀 ~ $ ~ fechaInicio:", fechaInicio)
        var fechaFinal = selectedOption.data('fecha-final');
        console.log("🚀 ~ $ ~ fechaFinal:", fechaFinal)

        if (fechaInicio && fechaFinal) {
            var numeroDeLunes = calcularLunes(fechaInicio, fechaFinal);
            console.log('Número de lunes:', numeroDeLunes);
            $('#numero_lunes').val(numeroDeLunes);
        }
    });


    $('#id_empleado').change(function() {
        salario = $(this).find(':selected').data('salario');
        $('#salario_empresa').val(salario);
        console.log(salario);
    });

    $('#dias_trabajados, #dias_descanso, #horas_extra_diurnas, #horas_extra_nocturnas, #bono_nocturno, #clt, #dia_feriado_trabajado').on('change', function() {
        calcularTotalDevengado(salario);
    });
    $('#s_s_o, #paro_forzoso, #ley_politica_habit, #sindicato, #descuento_faltas, #descuento_prestamos').on('change', function() {
        calcularTotalDeducido(salario);
    });
    //los dias de descanso siguen la misma formula


    $('#quincena-form').on('submit', function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: '/quincenas', // Puedes usar la ruta directamente
            method: 'POST',
            data: formData,
            success: function(response) {
                alert(response.message);
                $('#quincenaModal').modal('hide');
                $('#quincena-form')[0].reset();
                loadQuincenas(); // Recargar las quincenas
            },
            error: function(response) {
                alert('Hubo un error al crear la quincena.');
            }
        });
    });
});

function loadQuincenas() {
    $.ajax({
        url: '/quincenas',
        method: 'GET',
        success: function(response) {
            var quincenaSelect = $('#id_quincena');
            quincenaSelect.empty(); // Limpiar el selector

            response.forEach(function(quincena) {
                var option = new Option(
                    `${quincena.descripcion} (${quincena.fecha_inicio} - ${quincena.fecha_final})`,
                    quincena.id_quincena
                );
                $(option).attr('data-fecha-inicio', quincena.fecha_inicio);
                $(option).attr('data-fecha-final', quincena.fecha_final);
                quincenaSelect.append(option);
            });
        },
        error: function() {
            alert('Hubo un error al cargar las quincenas.');
        }
    });
}


function calcularTotalDevengado(salario) { // Funciona
    var diasTrabajados = parseFloat($('#dias_trabajados').val() * salario/30) || 0;
    
    var diasDescanso = $('#dias_descanso').val() ? parseFloat($('#dias_descanso').val()* salario/30) : 0;
    
    var horasExtraDiurnas = $('#horas_extra_diurnas').val() ? parseFloat(($('#horas_extra_diurnas').val() * (salario / 30 / 8)) +  (salario / 30 / 8 * 0.5)  ) : 0;
    
    var horasExtraNocturnas =  $('#horas_extra_nocturnas').val()? parseFloat($('#horas_extra_nocturnas').val() * (salario / 30 / 8 * 0.5) + (salario / 30 / 8 * 0.5 * 0.3) ) : 0;
    
    var bonoNocturno = $('#bono_nocturno').val()? parseFloat($('#bono_nocturno').val() * (salario / 30 / 8) * 0.3) : 0;
    
    var clt = $('#clt').val()? parseFloat($('#clt').val() * ((salario/30 * 0.5) + salario/30) ) : 0;
    
    var diaFeriadoTrabajado = $('#dia_feriado_trabajado').val()? parseFloat($('#dia_feriado_trabajado').val()  * ((salario/30 * 0.5) + salario/30)) : 0;
    

    var totalDevengado =  diasTrabajados + diasDescanso + horasExtraDiurnas + horasExtraNocturnas + bonoNocturno + clt + diaFeriadoTrabajado; 
    $('#total_devengado').val(totalDevengado.toFixed(2));
    $('#total_pagar').val(parseFloat(totalDevengado - $('#total_deducciones').val() ).toFixed(2));
}


function calcularTotalDeducido(salario) {
    var SSO = parseFloat($('#s_s_o').val() * (0.04 * salario*12/52)) || 0;
    console.log("🚀 ~ SSO:", SSO)

    var paroForzoso = $('#paro_forzoso').val() ? parseFloat($('#paro_forzoso').val() * 0.005 * salario*12/52) : 0;
    console.log("🚀 ~ paroForzoso:", paroForzoso)

    var leyPolitica = $('#total_devengado').val() ? parseFloat(($('#total_devengado').val() * 0.01)) : 0;
    console.log("🚀 ~ leyPolitica:", leyPolitica)

    //SINDICATO HAY QUE HABILITARLO CON UN CHECKBOX
    var sindicato =  $('#total_devengado').val() ?  parseFloat(($('#total_devengado').val() * 0.01)) : 0;
    console.log("🚀 ~ sindicato:", sindicato)

    var descuentoFaltas = $('#descuento_faltas').val()? parseFloat($('#descuento_faltas').val() * (salario / 30)) : 0;
    console.log("🚀 ~ descuentoFaltas:", descuentoFaltas)

    var descuentoPrestamos = $('#descuento_prestamos').val()? parseFloat($('#descuento_prestamos').val()) : 0;
    console.log("🚀 ~ descuentoPrestamos:", descuentoPrestamos)

    var totalDeducido =  SSO + paroForzoso + leyPolitica + sindicato + descuentoFaltas + descuentoPrestamos;
    console.log(totalDeducido) 
    $('#total_deducciones').val(totalDeducido.toFixed(2));
    $('#total_pagar').val(parseFloat( $('#total_devengado').val() - totalDeducido ).toFixed(2));
}


function calcularLunes(fechaInicio, fechaFinal) {
    var startDate = new Date(fechaInicio);
    var endDate = new Date(fechaFinal);
    var count = 0;

    while (startDate <= endDate) { //al colocarlo menor incluiria el lunes
        if (startDate.getDay() === 1) { // 1 representa lunes
            count++;
        }
        startDate.setDate(startDate.getDate() + 1);
    }
    $('#s_s_o, #paro_forzoso').val(count) 

    return count;
}