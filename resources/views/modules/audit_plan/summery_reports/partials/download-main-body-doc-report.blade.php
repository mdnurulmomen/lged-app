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
                    <h5 class="form-group text-center">
                        Issue No. # {{ ucfirst($memo['onucched_no']) }}
                    </h5>

                    <h5 class="form-group">Issue: {{ ucfirst($memo['memo_title_bn']) }}</h5>
                    <h5 class="form-group">Observation (Condition):  {{ ucfirst($memo['memo_title_bn']) }}</h5>
                    <h5 class="form-group">Criteria: {{ ucfirst($memo['criteria']) }}</h5>
                    <h5 class="form-group">
                        Cause: 
                        @foreach(json_decode($memo['cause']) as $cause)
                            {{ ucfirst($cause) . ", " }}
                        @endforeach
                    </h5>
                    <h5 class="form-group">Consequence / Impact: {{ ucfirst($memo['impact']) }}</h5>
                    <h5 class="form-group">Recommendations: {{ ucfirst($memo['recommendation']) }}</h5>
                    <h5 class="form-group">Risk Level: {{ ucfirst($memo['risk_level']) }}</h5>
                    <h5 class="form-group">Management response: {{ ucfirst($memo['m_response']) }}</h5>
                    <h5 class="form-group">Auditor’s Comment: {{ ucfirst($memo['comment']) }}</h5>
                    <h5 class="form-group">Action Taken: {{ ucfirst($memo['action_taken']) }}</h5>
                    <h5 class="form-group">Responsible Person: {{ ucfirst($memo['responsible_person']) }}</h5>
                    <h5 class="form-group">Date to be implemented: {{ ucfirst($memo['date_to_be_implemented']) }}</h5>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
