<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="public/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <style>
        body {
            font-family: solaimanlipipdf;
        }

        .table-bordered tr {
            text-align: center;
        }

        .no-border tbody, .no-border td, .no-border tfoot, .no-border th, .no-border thead, .no-border tr {
            border: 0 !important;
        }
    </style>
</head>

<body>
<div id="writing-screen-wrapper" style="font-family:solaimanlipipdf,serif !important;">
    <div class="pdf-screen">
        {!! $cover['content'] !!}
    </div>
    <div class="pdf-screen">
        @foreach($plans as $plan)
            <div class="plan_content">
                {!! $plan['content'] !!}
            </div>
        @endforeach
    </div>
</div>
<script src="public/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
