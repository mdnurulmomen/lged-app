<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <style>
        html {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        body {
            margin: 0;
            font-family: nikoshpdf !important;
        }

        .bangla-font {
            font-family: nikoshpdf !important;
        }

        .form-row>.col,
        .form-row>[class*="col-"] {
            padding-right: 5px;
            padding-left: 5px;
        }

        .form-group {
            margin-bottom: 1.75rem;
        }

        @media (min-width: 576px) .col-sm-12 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%;
            position: relative;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #000;
            background-color: transparent;
            page-break-inside: auto;
            border-spacing: 0px;
            border-collapse: collapse;
        }

        .table-bordered {
            border: 1px solid #e7e9f0 !important;
        }

        thead {
            display: table-header-group;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        .table thead th,
        .table thead td {
            font-weight: 600;
            font-size: 1rem;
            border-bottom-width: 1px;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #EBEDF3;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #EBEDF3;
            border-color: #0c0e1a !important;
        }

        .table th,
        .table td {
            padding: 0.5rem;
            vertical-align: top;
        }

        .table thead th,
        .table thead td {
            padding: 0.75rem;
        }

        th {
            text-align: inherit;
        }

        @media print {
            table {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>
    <div id="writing-screen-wrapper"
        style="font-family:nikoshpdf,serif !important; text-align: justify; text-justify: inter-word;">
        <div class="pdf-screen bangla-font">
            <div class="bangla-font" style="font-family:nikoshpdf,serif !important;text-align: center">
                <h2 class="text-center">Summery Report</h2>
            </div>
        </div>

        <br>

        <div class="col-sm-12 form-group">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Issue</th>
                        <th>Recommendations</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($allMemos as $memo)
                    <tr>
                        <td>{{ $memo['memo_title_bn'] }}</td>
                        <td>{{ $memo['recommendation'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
