<!-- resources/views/resumen_quincena_pdf.blade.php -->
<html>
<head>
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
    <h1>Resumen de Libro de Compras - Quincena {{ $quincena->descripcion }}</h1>
    <h1> {{$quincena->fecha_inicio}} - {{$quincena->fecha_final}} </h1>

    <table>
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Base Imponible</th>
                <th>Crédito Fiscal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total de las Compras de Importación Afectadas solo en Alícuota General</td>
                <td>{{ $importacionAfectadaGeneral }}</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td>Total de las Compras de Importación Afectadas en Alícuota General + Adicional</td>
                <td>{{ $importacionAfectadaGeneralAdicional }}</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td>Total de las Compras de Importación Afectadas en Alícuota Reducidas</td>
                <td>{{ $importacionAfectadaReducida }}</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td>Total Exento Compras de Importación</td>
                <td>{{ $exentoImportacion }}</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td>Total Compras Internas Afectadas solo Alícuota General 16%</td>
                <td>{{ $baseImpoContribuyente }}</td>
                <td>{{ $creditoFiscal }}</td>
            </tr>
            <tr>
                <td>Total Compras Internas Afectadas Alícuota General + Adicional</td>
                <td>{{ $internasAfectadasAdicional }}</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td>Total Compras Internas Afectadas Alícuota del 12%</td>
                <td>{{ $internasAfectadas12 }}</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td>Total Compras Internas Afectadas Alícuota del 8%</td>
                <td>{{ $internasAfectadas8 }}</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td>Total Compras Internas Afectadas Alícuota del 7%</td>
                <td>{{ $internasAfectadas7 }}</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td>Totale Exento Compras Internas</td>
                <td>{{ $exentoInternas }}</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td>Totales de las Compras No Sujetas</td>
                <td>{{ $comprasNoSujetas }}</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td>Total sin Derecho A Crédito IVA</td>
                <td>{{ $comprasSinDerechoIVA }}</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td>Totales Generales</td>
                <td>{{ $totalesGenerales }}</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td>Créditos Fiscales Totalmente Deducibles</td>
                <td></td>
                <td>{{ $creditoFiscalTotal }}</td>
            </tr>
            <tr>
                <td>Créditos Fiscales Parcialmente Deducibles</td>
                <td></td>
                <td>{{ $creditoFiscalParcialmenteDeducible }}</td>
            </tr>
            <tr>
                <td>Total Créditos Fiscales Totalmente Deducibles</td>
                <td></td>
                <td>{{ $totalCreditosFiscalesDeducibles }}</td>
            </tr>
            <tr>
                <td>Total IVA Retenido</td>
                <td>{{ $ivaRetenido }}</td>
                <td>0.00</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
