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
    </style>
</head>
<body>
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

    <div class="row" style="margin-top: 10px">
        <div class="col-6" style="text-align: left;"><b>Memo No-</b> {{$office_order['memorandum_no']}}</div>
        <?php
            $date = \Carbon\Carbon::parse($office_order['memorandum_date'])->format('d/m/Y');
        ?>
        <div class="col-6" style="text-align: right;"><b>Date:</b> {{$date}}</div>
    </div>

    <div style="text-align: center">
        <h2><b><u>Office Order</u></b></h2>
    </div>

    <div style="text-align: justify">
        <!-- {{$office_order['heading_details']}} -->
        Under the {{$office_order['memorandum_no']}} of the Local Government Engineering Department for the financial year 2022-23, an Internal Audit Team is formed for the purpose of conducting internal audit activities as per the following instructions:
    </div>

    @php $allWorkingDates = []; @endphp

    <div style="margin-top: 5px">
        <table class="table" width="100%">
            <thead>
            <tr>
                <th style="text-align: center" width="30%">Internal Audit Team Members</th>
                <th style="text-align: center" width="10%">Auditable Office</th>
                <th style="text-align: center" width="10%">Audit Type</th>
                <th style="text-align: center" width="10%">Auditable Year</th>
                <th style="text-align: center" width="10%">Kick-off Meeting</th>
                <th style="text-align: center" width="10%">Audit Timeline</th>
                <th style="text-align: center" width="10%">Tentative Exit Meeting</th>
                <th style="text-align: center" width="10%">Tentative Date of  Draft Report Submission</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center">1</td>
                    <td style="text-align: center">2</td>
                    <td style="text-align: center">3</td>
                    <td style="text-align: center">4</td>
                    <td style="text-align: center">5</td>
                    <td style="text-align: center">6</td>
                    <td style="text-align: center">7</td>
                    <td style="text-align: center">8</td>
                </tr>
                <tr>
                    <td style="text-align: left; vertical-align: top;">
                    <!-- @foreach($audit_team_schedules as $key=>$audit_team_schedule)
                        @if($audit_team_schedule['team_schedules'] != null)
                            @php $teamMemberSL = 1; @endphp
                            @foreach(json_decode($audit_team_schedule['team_members'],true) as $role => $team_members)
                                @php
                                    usort($team_members, "arryAortAsc");
                                @endphp
                                @foreach($team_members as $member_key => $sub_team_leader)
                                    <p>{{$teamMemberSL}}. Mr {{$sub_team_leader['officer_name_en']}} , 
                                        <br>
                                        {{$sub_team_leader['designation_en'].' and '.$sub_team_leader['team_member_role_en']}}</p> 
                                    @php $teamMemberSL++; @endphp
                                @endforeach
                            @endforeach
                        @endif
                        @php unset($allWorkingDates); @endphp
                    @endforeach -->
                        @php $teamMemberSL = 1; @endphp
                        @foreach($audit_team_members as $member_key => $member)
                            <p>{{$teamMemberSL}}. Mr {{$member['team_member_name_en']}} , 
                                <br>
                                {{$member['team_member_designation_en'].' and '.$member['team_member_role_en']}}</p> 
                                <br>
                            @php $teamMemberSL++; @endphp
                        @endforeach
                    </td>
                    <td style="text-align: center; vertical-align: top;">
                        @foreach($auditable_units as $key=>$auditable_unit)
                            <p>{{$auditable_unit['cost_center_name_en']}}</p> 
                        @endforeach
                    </td>
                    <td style="text-align: center; vertical-align: top;">{{$audit_type['audit_type']}}</td>
                    <td style="vertical-align: top;">2021-2022</td>
                    <td style="text-align: center; vertical-align: top;">{{$milestones[0]['start_date']}}</td>
                    <td style="text-align: center; vertical-align: top;">{{$milestones[1]['start_date']}} To {{$milestones[1]['end_date']}}</td>
                    <td style="text-align: center; vertical-align: top;">{{$milestones[2]['start_date']}}</td>
                    <td style="text-align: center; vertical-align: top;">{{$milestones[3]['start_date']}}</td>
                </tr>
                    
            
            </tbody>
        </table>
    </div>

    {{--for audit advice--}}
    <div style="margin-top: 10px;text-align: left; font-style: italic;">
        <h5>Tentative Scope of Audit Procedure:</h5>
    </div>

    <div style="text-align: -moz-left;">
        {!! nl2br($office_order['advices']) !!}
    </div>

    <div style="text-align: center;">
        <h6>Kindly note that Additional Chief Engineer (Audit) will be present in the Exit Meeting.</h6>
    </div>

    <div style="text-align: right; margin-top: 3%;">
        <!-- {!! nl2br($office_order['issuer_details']) !!} -->  
        @php
            $data = collect($audit_team_members)->firstWhere('team_member_role_en', 'teamLeader')
        @endphp
        <h6>{{$data['team_member_name_en']}} <br>
        {{ucfirst($data['team_member_role_en'])}} <br>
        {{$data['team_member_designation_en']}} </h6>
    </div>

    <br>
    <br>

    <div style="margin-top: 3%; text-align: left; font-style: italic;">
        <h5>Copy for kind information and necessary action:</h5>
    </div>

    <div style="text-align: -moz-left;">
        {!! nl2br($office_order['order_cc_list']) !!}
    </div>

</body>
</html>