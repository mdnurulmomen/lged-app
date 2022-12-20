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

        .form-row>.col, .form-row>[class*="col-"] {
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

        .table thead th, .table thead td {
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

        .table-bordered th, .table-bordered td {
            border: 1px solid #EBEDF3;
            border-color: #0c0e1a !important;
        }

        .table th, .table td {
            padding: 0.5rem;
            vertical-align: top;
        }

        .table thead th, .table thead td {
            padding: 0.75rem;
        }

        th {
            text-align: inherit;
        }

        @media print {
            table {page-break-inside: avoid;}
        }
    </style>
</head>

<body>
    <div id="writing-screen-wrapper" style="font-family:nikoshpdf,serif !important;">
        <div class="pdf-screen bangla-font">
            <div class="bangla-font" style="font-family:nikoshpdf,serif !important;text-align: center">
                <h5 class="text-center">Annoncement Memo</h5>
            </div>
        </div>

        <div class="col-sm-12 form-group">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Subject:</th>
                        <td>Commencement of Audit of {{ $announcementMemo['yearly_plan_info']['project_name_en'] ?? ($announcementMemo['yearly_plan_info']['function_name_en'] ?? $announcementMemo['yearly_plan_info']['cost_center_en']) }}
                        </td>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="col-sm-12 form-group">
            <p>IAD has planned to commence the audit of <b>(Audit Activity)</b> as per the Audit Committe's approved
                Audit Plan</p>
        </div>

        <div class="col-sm-12 form-group">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="">Audit Period</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>This audit covers the period from
                            {{ count($announcementMemo['yearly_plan_info']['teams']) ? $announcementMemo['yearly_plan_info']['teams'][0]['team_start_date'] : '--' }}
                            till
                            {{ count($announcementMemo['yearly_plan_info']['teams']) ? $announcementMemo['yearly_plan_info']['teams'][0]['team_end_date'] : '--' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-sm-12 form-group">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="">Audit Scope</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$announcementMemo['audit_plan_info']['scope']}}</td>
                    </tr>

{{--                    <tr>--}}
{{--                        <td>--}}
{{--                            <ul>--}}
{{--                                <li>a)...</li>--}}
{{--                                <li>b)...</li>--}}
{{--                                <li>c)...</li>--}}
{{--                            </ul>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
                </tbody>
            </table>
        </div>

        <div class="col-sm-12 form-group">
            <table class="table table-bordered">
                @foreach ($announcementMemo['yearly_plan_info']['teams'] as $team)
                    <thead>
                    <tr>
                        <th colspan="2">
                            Audit Team {{ $team['team_name'] }}
                        </th>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th>Designation</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($team['members'] as $member)
                        <tr>
                            <td>{{ $member['team_member_name_en'] }}</td>
                            <td>{{ $member['team_member_designation_en'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                @endforeach
            </table>
        </div>

        <div class="col-sm-12 form-group">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="3">
                            Audit Time Table
                        </th>
                    </tr>
                    <tr>
                        <th>Particulars</th>
                        <th>Strat Date</th>
                        <th>End Date</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($announcementMemo['audit_plan_info']['milestones'] as $milestone)
                    <tr>
                        <td>{{$milestone['milestone_bn']}}</td>
                        <td>{{$milestone['start_date']}}</td>
                        <td>{{$milestone['end_date']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-sm-12 form-group">
            <p>
                We would like to see you for a kick-off meeting to discuss the focus areas of auditable activities on
                audit commencement date i.e. [{{ count($announcementMemo['yearly_plan_info']['teams']) ? $announcementMemo['yearly_plan_info']['teams'][0]['team_start_date'] : '--' }}]. Kindly,
                commenicate the commencement of internal audit of relevant personnel.
            </p>

            <p>
                At the completion of field work, the audit results will be shared and discussed with you and other
                conrned personnel before submission of the draft report for management comments. The report will be
                finalized after obtaining management comments and action plan along with the target implementation date
                in writing.
            </p>

            <p>
                We look forward to a smooth audit with your assistance and co-operation
            </p>
        </div>
    </div>
</body>

</html>
