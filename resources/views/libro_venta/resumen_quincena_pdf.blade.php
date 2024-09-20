<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen del Libro de Ventas</title>
    <style>
        body {
            font-size: 10px;
            line-height: 1.2;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 4px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .table-header {
            font-size: 12px;
        }
        .table-content {
            font-size: 9px;
        }
        .container {
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Resumen de Libro de Ventas - Quincena {{ $quincenaDescripcion }}</h1>
        <h1> {{$fechaInicio}} - {{$fechaFin}} </h1>
        <table>
            <thead class="table-header">
                <tr>
                    <th>Descripción</th>
                    <th>Base Imponible</th>
                    <th>Débito Fiscal</th>
                </tr>
            </thead>
            <tbody class="table-content">
                <tr>
                    <td>Total Ventas Internas No Gravadas</td>
                    <td>0,00</td>
                    <td>0,00</td>
                </tr>
                <tr>
                    <td>Total Ventas Exportación</td>
                    <td>0,00</td>
                    <td>0,00</td>
                </tr>
                <tr>
                    <td>Total Ventas Afectadas por Alícuota General 12%</td>
                    <td>0,00</td>
                    <td>0,00</td>
                </tr>
                <tr>
                    <td>Total Ventas Afectadas por Alícuota General 16%</td>
                    <td>{{ number_format($totalBaseImponible16, 2, ',', '.') }}</td>
                    <td>{{ number_format($debitoFiscal16, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Total de las Ventas Internas Afectadas Alícuota Reducida</td>
                    <td>0,00</td>
                    <td>0,00</td>
                </tr>
                <tr>
                    <td>Total Ventas Afectadas por Alícuota General + Adicional</td>
                    <td>0,00</td>
                    <td>0,00</td>
                </tr>
                <tr>
                    <td>Total Ventas y Débitos Fiscales para Efecto de Determinación 12%</td>
                    <td>0,00</td>
                    <td>0,00</td>
                </tr>
                <tr>
                    <td>Total Ventas y Débitos Fiscales para Efecto de Determinación 16%</td>
                    <td>{{ number_format($totalBaseImponible16, 2, ',', '.') }}</td>
                    <td>{{ number_format($debitoFiscal16, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Ajustes a los Débitos Fiscales Períodos Anteriores</td>
                    <td>0,00</td>
                    <td>0,00</td>
                </tr>
                <tr>
                    <td>Total Débitos Fiscales</td>
                    <td></td>
                    <td>{{ number_format($debitoFiscal16, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Retenciones Acumuladas por Descontar</td>
                    <td></td>
                    <td>{{ number_format($retencionesAcumuladas, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Iva Retenido (por el Comprador)</td>
                    <td></td>
                    <td>{{ number_format($ivaRetenidoComprador, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Total Retenciones</td>
                    <td></td>
                    <td>{{ number_format($totalRetenciones, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Saldo de Retenciones de IVA no aplicado</td>
                    <td></td>
                    <td>0,00</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
