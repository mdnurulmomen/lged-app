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

        .text-center {
            text-align: center;
        }

        @media (min-width: 576px) .col-sm-12 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%;
            position: relative;
        }
    </style>
</head>

<body>
    <div id="writing-screen-wrapper"
        style="font-family:nikoshpdf,serif !important; text-align: justify; text-justify: inter-word;">
        <div class="pdf-screen bangla-font">
            <div class="bangla-font" style="font-family:nikoshpdf,serif !important;text-align: center">
                <h2 class="text-center">Main Body Doc Report</h2>
            </div>
        </div>

        <br>

        <div class="form-row">
            @foreach ($allMemos as $memo)
                <div class="col-sm-12 form-group" style="width: 100%">
                    <h5 class="text-center">
                        Issue No. # {{ $memo['onucched_no'] }}
                    </h5>
    
                    <h5>Issue: {{ $memo['memo_title_bn'] }}</h5>
                    <h5>Observation (Condition):  {{ $memo['memo_title_bn'] }}</h5>
                    <h5>Criteria: </h5>
                    <h5>Cause:</h5>
                    <h5>Consequence / Impact:</h5>
                    <h5>Recommendations:</h5>
                    <h5>Risk Level: </h5>
                    <h5>Management response:</h5>
                    <h5>Auditor’s Comment:</h5>
                    <h5>Action Taken: </h5>
                    <h5>Responsible Person: </h5>
                    <h5>Date to be implemented:</h5>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
