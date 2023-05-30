<!DOCTYPE html>
<html>
<head>
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
    <div style="text-align: center">
        <h2><b>Annual Plan Details of {{$strategic_plan_year}}</b></h2>
    </div>
    <div>
        @if (! count($individual_yearly_plan['project_list']) && ! count($individual_yearly_plan['project_list']) && ! count($individual_yearly_plan['project_list']))
            <div class="row">
                <div class="col-sm-12">
                    <table>
                        <tbody>
                            <tr class="text-danger">No Data Found</tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            @if (count($individual_yearly_plan['project_list']))
                <div class="row">
                    <div class="col-sm-12">
                        <label>Project :</label>
                        <table id="project_table" class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th width="20%">Project</th>
                                    <th width="20%">Location</th>
                                    <th width="20%">Location No</th>
                                    <th width="20%">Comment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($individual_yearly_plan['project_list'] as $project)
                                    <tr class="strategic_row project_row">
                                        <td>{{ $project['project_name_en'] }}</td>
                                        <td>{{ $project['cost_center_en'] }}</td>
                                        <td>{{ $project['location_no'] }}</td>
                                        <td>{{ $project['comment'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            @if (count($individual_yearly_plan['function_list']))
                <div class="row" style="margin-top: 20px;">
                    <div class="col-sm-12">
                        <label>Function :</label>
                        <table id="function_table" class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th width="20%">Function</th>
                                    <th width="20%">Location</th>
                                    <th width="20%">Location No</th>
                                    <th width="20%">Comment</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($individual_yearly_plan['function_list'] as $function)
                                    <tr class="strategic_row function_row">
                                        <td>{{ $function['function_name_en'] }}</td>
                                        <td>{{ $function['cost_center_en'] }}</td>
                                        <td>{{ $function['location_no'] }}</td>
                                        <td>{{ $function['comment'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            @if (count($individual_yearly_plan['cost_centers']))
                <div class="row">
                    <div class="col-sm-12">
                        <label>Cost Center :</label>
                        <table id="project_table" class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th width="20%">Cost Center</th>
                                    <th width="20%">Location</th>
                                    <th width="20%">Location No</th>
                                    <th width="20%">Comment</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($individual_yearly_plan['cost_centers'] as $costCenter)
                                    <tr class="strategic_row project_row">
                                        <td>{{ $costCenter['cost_center_en'] }}</td>
                                        <td>{{ $costCenter['cost_center_en'] }}</td>
                                        <td>{{ $costCenter['location_no'] }}</td>
                                        <td>{{ $costCenter['comment'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endif
    </div>
    <div class="col-6" style="text-align: right; margin-top: 20px;"><b>Printed On:</b> {{ now()->format('d/m/Y') }}</div>
</body>
</html>