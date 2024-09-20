@extends('adminlte::page')

@section('title', 'Crear Libro de Ventas')

@section('content_header')
    <h1>Crear Libro de Ventas</h1>
@stop

@section('content')
    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf
        <div class="d-flex flex-wrap justify-content-around">

            <!-- Grupo 1 -->
            <div class="card mb-3 flex-fill mx-2" style="min-width: 300px;">
                <div class="card-header">
                    <h3>Información General</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="id_quincena">Quincena</label>
                        <select class="form-control form-control-sm" name="id_quincena" id="id_quincena" required>
                            @foreach ($quincenas as $quincena)
                                <option value="{{ $quincena->id_quincena }}">{{ $quincena->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fecha_factura">Fecha de Factura</label>
                        <input type="date" class="form-control form-control-sm" name="fecha_factura" id="fecha_factura" required>
                    </div>
                    <div class="form-group">
                        <label for="nro_rif">Número de RIF</label>
                        <input type="text" class="form-control form-control-sm" name="nro_rif" id="nro_rif" required>
                    </div>
                    <div class="form-group">
                        <label for="prov_razon_social">Razón Social del Proveedor</label>
                        <input type="text" class="form-control form-control-sm" name="prov_razon_social" id="prov_razon_social" required>
                    </div>
                    <div class="form-group">
                        <label for="nro_factura">Número de Factura</label>
                        <input type="number" class="form-control form-control-sm" name="nro_factura" id="nro_factura" required>
                    </div>
                    <div class="form-group">
                        <label for="nro_control_factura">Número de Control de Factura</label>
                        <input type="number" class="form-control form-control-sm" name="nro_control_factura" id="nro_control_factura" required>
                    </div>
                    <div class="form-group">
                        <label for="tipo_transaccion">Tipo de Transacción</label>
                        <select class="form-control form-control-sm" name="tipo_transaccion" id="tipo_transaccion">
                            <option value="01 REGISTRO" selected>01 REGISTRO</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="total_ventas">Total Ventas con IVA incluido</label>
                        <input type="number" step="0.01" class="form-control form-control-sm" name="total_ventas" id="total_ventas" required>
                    </div>
                </div>
            </div>

            <!-- Grupo 2: Contribuyentes -->
            <div class="card mb-3 flex-fill mx-2" style="min-width: 300px;">
                <div class="card-header">
                    <h3>Contribuyentes</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="base_impo_contribuyente">Base Imponible</label>
                        <input type="number" step="0.01" class="form-control form-control-sm" name="base_impo_contribuyente"  id="base_impo_contribuyente" required>
                    </div>
                    <div class="form-group">
                        <label for="alicuota_contribuyente">ALICUOTA 16%</label>
                        <input type="number" step="0.01" class="form-control form-control-sm" name="alicuota_contribuyente" id="alicuota_contribuyente" value="16" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="impuesto_iva_contribuyente">IMPUESTO IVA</label>
                        <input type="number" step="0.01" class="form-control form-control-sm" name="impuesto_iva_contribuyente" id="impuesto_iva_contribuyente" required>
                    </div>
                </div>
            </div>

            <!-- Grupo 3: No Contribuyentes -->
            <div class="card mb-3 flex-fill mx-2" style="min-width: 300px;">
                <div class="card-header">
                    <h3>No Contribuyentes</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="base_impo_no_contribuyente">Base Imponible</label>
                        <input type="number" step="0.01" class="form-control form-control-sm" name="base_impo_no_contribuyente"  id="base_impo_no_contribuyente" >
                    </div>
                    <div class="form-group">
                        <label for="alicuota_no_contribuyente">ALICUOTA 16%</label>
                        <input type="number" step="0.01" class="form-control form-control-sm" name="alicuota_no_contribuyente" id="alicuota_no_contribuyente"  value="16" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="impuesto_iva_no_contribuyente">IMPUESTO IVA</label>
                        <input type="number" step="0.01" class="form-control form-control-sm" name="impuesto_iva_no_contribuyente" id="impuesto_iva_no_contribuyente">
                    </div>
                </div>
            </div>

            <!-- Grupo 4 -->
            <div class="card mb-3 flex-fill mx-2" style="min-width: 300px;">
                <div class="card-header">
                    <h3>Retenciones</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="iva_retenido">IVA Retenido</label>
                        <input type="number" step="0.01" class="form-control form-control-sm" name="iva_retenido" id="iva_retenida">
                    </div>
                    <div class="form-group">
                        <label for="nro_comprobante">Número de Comprobante</label>
                        <input type="number" class="form-control form-control-sm" name="nro_comprobante" id="nro_comprobante">
                    </div>
                    <div class="form-group">
                        <label for="fecha_comprobante_retencion">Fecha de Comprobante de Retención</label>
                        <input type="date" class="form-control form-control-sm" name="fecha_comprobante_retencion" id="fecha_comprobante_retencion">
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Guardar</button>
    </form>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
@stop

@section('js')
    <script src="{{ asset('js/libro_ventas_crear.js') }}"></script>
@stop
