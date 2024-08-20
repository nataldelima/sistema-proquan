<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documento para Impressão</title>
    <style>
        /* Estilos gerais */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        /* Estilos para impressão */
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .no-print {
                display: none;
            }

            .print-header {
                font-size: 18px;
                font-weight: bold;
                text-align: center;
                margin-bottom: 20px;
            }

            .print-section {
                margin-bottom: 20px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            table,
            th,
            td {
                border: 1px solid black;
            }

            thead {
                font-size: 14px;
                background-color: #ccc;
            }

            th {
                background-color: #ccc;
            }

            th,
            td {
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }

            .footer {
                text-align: center;
                margin-top: 20px;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>

    <div class="print-header">
        {{$title}}
    </div>

    @yield('content')


</body>

</html>
