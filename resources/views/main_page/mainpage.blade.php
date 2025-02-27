@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1 class="text-center">Bienvenidos a la plataforma administrativa del Hotel Rasil!</h1>
    <h4 class="text-center">Por favor, seleccione una opción para continuar</h4>
@stop

@section('content')

        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <a href="{{ route('nomina-empleados.index') }}" class="btn btn-primary btn-lg btn-block">
                    <i class="fas fa-users fa-3x"></i>
                    <h3>Nómina de Empleados</h3>
                    <p>Gestiona los datos de los empleados y accede a sus registros de salarios</p>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <a href="{{ route('compras.index') }}" class="btn btn-success btn-lg btn-block">
                    <i class="fas fa-shopping-cart fa-3x"></i>
                    <h3>Libro de Compra</h3>
                    <p>Gestiona los registros del libro de compra</p>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <a href="{{ route('ventas.index') }}" class="btn btn-info btn-lg btn-block">
                    <i class="fas fa-chart-line fa-3x"></i>
                    <h3>Libro de Venta</h3>
                    <p>Gestiona los registros del libro de venta</p>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <a href="{{ route('ingredientes.index') }}" class="btn btn-warning btn-lg btn-block">
                    <i class="fas fa-carrot fa-3x"></i>
                    <h3>Ingredientes</h3>
                    <p>Verifica el inventario de ingredientes</p>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <a href="{{ route('locales.index') }}" class="btn btn-danger btn-lg btn-block">
                    <i class="fas fa-store fa-3x"></i>
                    <h3>Locales</h3>
                    <p>Añade y edita locales del precinto</p>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <a href="{{ route('clientes_renta.index') }}" class="btn btn-secondary btn-lg btn-block">
                    <i class="fas fa-user-friends fa-3x"></i>
                    <h3>Clientes</h3>
                    <p>Gestiona información de contacto de clientes</p>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <a href="{{ route('cuentas_por_cobrar.index') }}" class="btn btn-dark btn-lg btn-block">
                    <i class="fas fa-file-invoice-dollar fa-3x"></i>
                    <h3>Cuentas por Cobrar</h3>
                    <p>Asigna, habilita e inhabilita deudas de clientes</p>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <a href="{{ route('quincenas.indexPagina') }}" class="btn btn-dark btn-lg btn-block">
                    <i class="fas fa-clock fa-3x"></i>
                    <h3>Gestión de Quincenas</h3>
                    <p>Maneja periodos de tiempo para asignar a registros</p>
                </a>
            </div>
        </div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    <style>
        .btn-lg {
            font-size: 1.5rem;
            padding: 2rem;
            text-align: center;
        }
        .btn-lg i {
            display: block;
            margin-bottom: 1rem;
        }
        .btn-lg h3 {
            margin: 0;
            font-size: 1.25rem;
        }
        .btn-lg p {
            margin: 0;
            font-size: 1rem;
        }
        .container {
            margin: 15px;
        }
        .row {
            margin: 0 -15px;
        }
        .col-lg-4, .col-md-6, .col-12 {
            padding: 15px;
        }
    </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop