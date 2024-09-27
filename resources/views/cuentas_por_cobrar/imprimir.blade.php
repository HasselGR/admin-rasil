<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Cuentas por Cobrar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .total-row {
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>

    <h2 class="text-center">{{$cliente->nombre_razon_social}}</h2>
    <p class="text-right">Fecha: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>

    <h3>SALDO CUENTAS POR COBRAR</h3>
    <h3>CONDICIONES DE PAGO: 15 DIAS</h3>

    <table>
        <thead>
            <tr>
                <th>FACTURA</th>
                <th>FECHA EMISIÓN</th>
                <th>FECHA VENCIMIENTO</th>
                <th>MONTO CON IVA</th>
                <th>ESTADO</th>
                <th>FECHA PAGO</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cuentasPorCobrar as $cuenta)
                <tr>
                    <td>{{ $cuenta->id_factura }}</td>
                    <td>{{ \Carbon\Carbon::parse($cuenta->fecha_emision)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($cuenta->fecha_vencimiento)->format('d/m/Y') }}</td>
                    <td>{{ number_format($cuenta->monto_con_iva, 2, ',', '.') }}</td>
                    <td>{{ $cuenta->estado ? 'Pagado' : 'Pendiente' }}</td>
                    <td>{{ $cuenta->estado ? \Carbon\Carbon::parse($cuenta->fecha_pago)->format('d/m/Y') : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="3" class="text-right">TOTAL A PAGAR DE CUENTAS SIN COBRAR:</td>
                <td colspan="3">{{ number_format($totalAPagar, 2, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

</body>
</html>
