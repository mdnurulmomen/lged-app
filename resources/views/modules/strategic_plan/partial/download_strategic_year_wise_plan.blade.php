<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <style>
        table, td, th {
        border: 1px solid;
        padding: 8px;
        }

        table {
        width: 100%;
        border-collapse: collapse;
        }

        p {
            padding: 5px;
        }

        body {
            margin: 0;
            font-family: nikoshpdf !important;
        }

        .bangla-font {
            font-family: nikoshpdf !important;
        }

        .row {
            display:table;
            width: 100%;
            clear: both;
        }
        .col {
            float: left;
            width: 32%;
        }

        @page {
            odd-header-name: odd-header;
            even-header-name: even-header;
            odd-footer-name: odd-footer;
            even-footer-name: even-footer;

            margin-left: 2cm;
            margin-right: 2cm;
        }
    </style>
</head>
<body>
<div id="writing-screen-wrapper" style="font-family:nikoshpdf,serif !important;">
    <div class="pdf-screen bangla-font" style="height: 100%">
        <htmlpagefooter name="even-footer">
            <div style="width: 100%; text-align: center;">
                Page No <span> {PAGENO}</span>
            </div>
        </htmlpagefooter>

        <htmlpagefooter name="odd-footer">
            <div style="width: 100%; text-align: center;">
                Page No <span> {PAGENO}</span>
            </div>
        </htmlpagefooter>
        <div class="row">
            <div class="col" style="width: 15%;">
                <img src="{{ base_path('public/assets/images/joyonti.jpg') }}" style="width: 100px; height: 80px; margin-top: 10%;" alt="joyonti">
            </div>
            <div class="col" style="width: 68%; text-align: center;">
                <h4>Government of the People’s Republic of Bangladesh</h4>
                <x-office-header-details officeid="{{$office_id}}"/>
            </div>
            <div class="col" style="float: left; width: 15%;">
                <img src="{{ base_path('public/assets/images/mujib.png') }}" style="width: 100px; height: 80px;" alt="mujib">
                <h5 class="bangla-font" style="text-align: center; font-family:Nikosh,serif !important;">
                    শেখ হাসিনার <br>
                    মূলনীতি <br>
                    গ্রাম শহরের <br>
                    উন্নতি <br>
                </h5>
            </div>
        </div>
        <div class="card sna-card-border mt-3">
            <div class="row">
                <div class="col-12 form-group">
                <h3 style="text-align: center; margin-top: 10px;">Strategic Plan For {{$start}} - {{$end}}</h3>
                    @foreach($strategic_plan_list as $year => $strategic_plans)
                    <div>
                        <h4 style="text-align: left; margin-top: 10px;">Strategic Plan For {{$year}}</h4>
                        <table class="table table-bordered" style="font-size: 13vh;">
                            <thead class="thead-light">
                                <tr>
                                    <th>Projects</th>
                                    <th>Location</th>
                                    <th>Number of Location</th>
                                    <th>Comment</th>
                                </tr>
                            </thead>
                            @foreach ($strategic_plans['projects'] as $project)
                                <tbody>
                                    <tr>
                                        <td>
                                            {{ $project['project_name_en']}}
                                        </td>
                                        <td >
                                            {{ $project['cost_center_en']}}
                                        </td>
                                        <td>
                                            {{ $project['location_no'] }}
                                        </td>
                                        <td>
                                            {{ $project['comment'] }}
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>

                    <div style="margin-top: 10px;">
                        <table class="table table-striped table-bordered" style="font-size: 13vh;">
                            <thead class="thead-light">
                                <tr>
                                    <th>Functions</th>
                                    <th>Location</th>
                                    <th>Number of Location</th>
                                    <th>Comment</th>
                                </tr>
                            </thead>
                            @foreach ($strategic_plans['functions'] as $function)
                                <tbody>
                                    <tr>
                                        <td>
                                            {{ $function['function_name_en']}}
                                        </td>
                                        <td >
                                            {{ $function['cost_center_en']}}
                                        </td>
                                        <td>
                                            {{ $function['location_no'] }}
                                        </td>
                                        <td>
                                            {{ $function['comment'] }}
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-6" style="text-align: right; margin-top: 10px;"><h5><b>Printed On:</b> {{ now()->format('d/m/Y') }}</h5></div>
</div>
</body>
</html>