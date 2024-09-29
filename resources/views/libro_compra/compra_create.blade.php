@extends('adminlte::page')

@section('title', 'Crear Libro de Compras')

@section('content_header')
    <h1>Crear Libro de Compras</h1>
@stop

@section('content')
    <form action="{{ route('compras.store') }}" method="POST" id="create-compra-form">
        @csrf

        <div class="d-flex flex-row flex-wrap justify-content-between">

            <!-- Grupo 1: Información de la Factura -->
            <div class="card mb-3 flex-fill mx-2" style="min-width: 20%;">
                <div class="card-header">
                    <h3>Información de la Factura</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="id_quincena">Quincena</label>
                        <select class="form-control" name="id_quincena" id="id_quincena" required>
                            <option value="">Seleccione una opción</option>
                            @foreach ($quincenas as $quincena)
                                <option value="{{ $quincena->id_quincena }}">{{ $quincena->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fecha_factura">Fecha de Factura</label>
                        <input type="date" class="form-control" name="fecha_factura" id="fecha_factura" required>
                    </div>
                    <div class="form-group">
                        <label for="nro_rif">Número de RIF</label>
                        <input type="text" class="form-control" name="nro_rif" id="nro_rif" required>
                    </div>
                    <div class="form-group">
                        <label for="prov_razon_social">Razón Social del Proveedor</label>
                        <input type="text" class="form-control" name="prov_razon_social" id="prov_razon_social" required>
                    </div>
                    <div class="form-group">
                        <label for="nro_factura">Número de Factura</label>
                        <input type="number" class="form-control" name="nro_factura" id="nro_factura" required>
                    </div>
                    <div class="form-group">
                        <label for="nro_control_factura">Número de Control de Factura</label>
                        <input type="number" class="form-control" name="nro_control_factura" id="nro_control_factura"  required>
                    </div>
                    <div class="form-group">
                        <label for="tipo_transaccion">Tipo de Transacción</label>
                        <select class="form-control" name="tipo_transaccion" id="tipo_transaccion" required>
                            <option value="01 REGISTRO">01 REGISTRO</option>
                            <option value="03">03</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nro_factura_afectada">Número de Factura Afectada</label>
                        <input type="number" class="form-control" name="nro_factura_afectada" id="nro_factura_afectada"  >
                    </div>
                    <div class="form-group">
                        <label for="total_compras">Total Compras Incluyendo IVA</label>
                        <input type="number" step="0.01" class="form-control" name="total_compras" id="total_compras" required>
                    </div>
                    <div class="form-group">
                        <label for="compras_sin_derecho_iva">Compras sin Derecho a Crédito IVA</label>
                        <input type="number" step="0.01" class="form-control" name="compras_sin_derecho_iva" id="compras_sin_derecho_iva">
                    </div>
                    <div class="form-group">
                        <label for="descuento_tgif">Descuento 3% IGTF</label>
                        <input type="number" step="0.01" class="form-control" name="descuento_tgif" id="descuento_tgif">
                    </div>
                </div>
            </div>

            <!-- Grupo 2: Contribuyentes -->
            <div class="card mb-3 flex-fill mx-2" style="min-width: 20%;">
                <div class="card-header">
                    <h3>Contribuyentes</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="base_impo_contribuyente">Base Imponible</label>
                        <input type="number" step="0.01" class="form-control" name="base_impo_contribuyente" id="base_impo_contribuyente">
                    </div>
                    <div class="form-group">
                        <label for="alicuota_contribuyente">Alicuota 16%</label>
                        <input type="number" step="0.01" class="form-control" name="alicuota_contribuyente"  id="alicuota_contribuyente" value="16" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="impuesto_iva_contribuyente">Impuesto IVA</label>
                        <input type="number" step="0.01" class="form-control" name="impuesto_iva_contribuyente" id="impuesto_iva_contribuyente" >
                    </div>
                </div>
            </div>

            <!-- Grupo 3: Contribuyentes Alic. Red. -->
            <div class="card mb-3 flex-fill mx-2" style="min-width: 20%;">
                <div class="card-header">
                    <h3>Contribuyentes Alic. Red.</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="base_impo_contribuyente_alic_red">Base Imponible</label>
                        <input type="number" step="0.01" class="form-control" name="base_impo_contribuyente_alic_red" id="base_impo_contribuyente_alic_red" value="0.00">
                    </div>
                    <div class="form-group">
                        <label for="alicuota_contribuyente_alic_red">Alicuota</label>
                        <input type="number" step="0.01" class="form-control" name="alicuota_contribuyente_alic_red"  id="alicuota_contribuyente_alic_red" value="16" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="impuesto_iva_contribuyente_alic_red">Impuesto IVA</label>
                        <input type="number" step="0.01" class="form-control" name="impuesto_iva_contribuyente_alic_red" id="impuesto_iva_contribuyente_alic_red" value="0.00" >
                    </div>
                </div>
            </div>
            

            <!-- Grupo 5: IVA Retenido -->
            <div class="card mb-3 flex-fill mx-2" style="min-width: 20%;">
                <div class="card-header">
                    <h3>IVA Retenido</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="iva_retenido">IVA Retenido</label>
                        <input type="number" step="0.01" class="form-control" name="iva_retenido" id="iva_retenido">
                    </div>
                    <div class="form-group">
                        <label for="nro_comprobante">Número de Comprobante</label>
                        <input type="number" class="form-control" name="nro_comprobante" id="nro_comprobante">
                    </div>
                    <div class="form-group">
                        <label for="fecha_comprobante_retencion">Fecha de Comprobante de Retención</label>
                        <input type="date" class="form-control" name="fecha_comprobante_retencion" id="fecha_comprobante_retencion">
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
@stop

@section('js')
    <script src="{{ asset('vendor/blockui/js/jquery.blockui.min.js') }}"></script>
    <script src="{{ asset('js/libro_compras_crear.js') }}"></script>
    <script src="{{ asset('js/blockUI.js') }}"></script> <!-- Importa el script generalizado -->
@stop
