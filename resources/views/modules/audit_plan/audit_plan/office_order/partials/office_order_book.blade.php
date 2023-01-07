<div class="row" style="text-align: center; margin-top: 5%;">
    <div class="col-2">
    </div>
    <div class="col-8">
        <h4>Government of the People’s Republic of Bangladesh</h4>
        <x-office-header-details officeid="{{$office_id}}"/>
    </div>
    <div class="col-2">
        <div>
            <h5>শেখ হাসিনার <br>
                মূলনীতি <br>
                গ্রাম শহরের <br>
                উন্নতি <br>
            </h5>
        </div>
    </div>
</div>

<div style="text-align: center">
    <div class="row" style="margin-top: 10px">
        <div class="col-6" style="text-align: left;"><b>Memo No-</b> {{$office_order['memorandum_no']}}</div>
        <div class="col-6" style="text-align: right;"><b>Date:</b> {{$office_order['memorandum_date']}}</div>
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
                <table class="table" border="1" width="100%">
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
                            <td style="text-align: left;">
                            @foreach($audit_team_schedules as $key=>$audit_team_schedule)
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
                            @endforeach
                            </td>
                            <td style="text-align: center">
                                @foreach($auditable_units as $key=>$auditable_unit)
                                    <p>{{$auditable_unit['cost_center_name_en']}}</p> 
                                @endforeach
                            </td>
                            <td style="text-align: center">{{$audit_type['audit_type']}}</td>
                            <td>2021-2022</td>
                            <td style="text-align: center">{{$milestones[0]['start_date']}}</td>
                            <td style="text-align: center">{{$milestones[1]['start_date']}} To {{$milestones[1]['end_date']}}</td>
                            <td style="text-align: center">{{$milestones[2]['start_date']}}</td>
                            <td style="text-align: center">{{$milestones[3]['start_date']}}</td>
                        </tr>
                            
                    
                    </tbody>
                </table>
            </div>

    {{--for audit advice--}}
    <div style="margin-top: 10px;text-align: left; font-style: italic;">
        <h5>Tentative Scope of Audit Procedure:</h5>
    </div>

    <div style="text-align: justify">
        {!! nl2br($office_order['advices']) !!}
    </div>

    <div style="text-align: center;">
        <h6>Kindly note that Additional Chief Engineer (Audit) will be present in the Exit Meeting.</h6>
    </div>

    <div style="text-align: right;">
        <div>
            <h6>(Md. Nur Hossain Howlader)</h6>
            <h6>Additional Chief Engineer (Audit)</h6>
            <h6>LGED, HQ, Dhaka</h6>
            <h6>e-mail: ace.aduit@lged.gov.bd</h6>
        </div>
    </div>
    <br>
    <br>
    <div style="margin-top: 20px;text-align: left; font-style: italic;">
        <h5>Copy for kind information and necessary action:</h5>
    </div>

    <div style="text-align: justify">
        {!! nl2br($office_order['order_cc_list']) !!}
    </div>
</div>

