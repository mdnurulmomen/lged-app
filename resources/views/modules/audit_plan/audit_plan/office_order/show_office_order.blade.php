<style>
    p {
        padding: 5px;
    }
</style>
<!-- <div class="row m-0 mb-2 page-title-wrapper d-md-flex align-items-md-center">
    <div class="col-md-12">
        <div class="d-flex justify-content-end">
            @if($office_order['approved_status'] == 'draft')
                <button data-ap-office-order-id="{{$office_order['id']}}"
                        data-audit-plan-id="{{$office_order['audit_plan_id']}}"
                        data-annual-plan-id="{{$office_order['annual_plan_id']}}"
                        onclick="Show_Office_Order_Container.loadOfficeOrderApprovalAuthority($(this))"
                        class="btn btn-sent btn-sm btn-bold btn-square mr-2">
                    <i class="far fa-share-square"></i> প্রেরণ করুন
                </button>
            @endif

            @if($office_order['approved_status'] == 'draft' && $office_order['office_order_movement'] != null
            && $office_order['office_order_movement']['employee_designation_id'] == $current_designation_id)
                <button data-ap-office-order-id="{{$office_order['id']}}"
                        data-audit-plan-id="{{$office_order['audit_plan_id']}}"
                        data-annual-plan-id="{{$office_order['annual_plan_id']}}"
                        onclick="Show_Office_Order_Container.approveOfficeOrder($(this))"
                        class="btn btn-approval btn-sm btn-bold btn-square mr-2">
                    <i class="far fa-check"></i> অনুমোদন করুন
                </button>
            @endif

            <button data-ap-office-order-id="{{$office_order['id']}}"
                    data-audit-plan-id="{{$office_order['audit_plan_id']}}"
                    data-annual-plan-id="{{$office_order['annual_plan_id']}}"
                    onclick="Show_Office_Order_Container.generateOfficeOrderPDF($(this))"
                    class="btn btn-download btn-sm btn-bold btn-square">
                <i class="far fa-file-pdf"></i> Download
            </button>
        </div>
    </div>
</div> -->


<div style="text-align: right;">
    <button data-ap-office-order-id="{{$office_order['id']}}"
            data-audit-plan-id="{{$office_order['audit_plan_id']}}"
            data-annual-plan-id="{{$office_order['annual_plan_id']}}"
            onclick="Show_Office_Order_Container.generateOfficeOrderPDF($(this))"
            class="btn btn-download btn-sm btn-bold btn-square">
        <i class="far fa-file-pdf"></i> Download
    </button>
</div>

<div class="card sna-card-border mt-3" style="margin-bottom:30px; padding: 70px;">
    <div class="row" style="text-align: center; margin-top: 5%;">
        <div class="col-2">
            <img src="{{ asset('assets/images/joyonti.jpg') }}" style="width: 85%; margin-top: 30%;" alt="joyonti">
        </div>
        <div class="col-8">
            <h4>Government of the People’s Republic of Bangladesh</h4>
            <x-office-header-details officeid="{{$office_id}}"/>
        </div>
        <div class="col-2">
            <img src="{{ asset('assets/images/mujib.png') }}" style="width: 85%;" alt="mujib">
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

        <div style="text-align: center; margin-top: 5%;">
            <h2><b><u>Office Order</u></b></h2>
        </div>
        <div class="mt-2" style="text-align: justify">
            <!-- {{$office_order['heading_details']}} -->
            Under the {{$office_order['memorandum_no']}} of the Local Government Engineering Department for the financial year 2022-23, an Internal Audit Team is formed for the purpose of conducting internal audit activities as per the following instructions:
        </div>

        <!-- <div style="margin-top: 5px">
            <table width="100%" border="1">
                <thead>
                <tr>
                    <th style="text-align: center" width="5%">ক্রমিক নং</th>
                    <th style="text-align: center" width="45%">নাম</th>
                    <th style="text-align: center" width="20%">পদবী</th>
                    <th style="text-align: center" width="15%">নিরীক্ষা দলে অবস্থান</th>
                    <th style="text-align: center" width="15%">মোবাইল নং</th>
                </tr>
                </thead>
                <tbody>
                @php
                    usort($audit_team_members, "arryAortAsc");
                @endphp
                @foreach($audit_team_members as $audit_team_member)
                    <tr>
                        <td style="text-align: center">{{enTobn($loop->iteration)}}</td>
                        <td style="text-align: left;margin-left: 5px">জনাব {{$audit_team_member['team_member_name_bn']}}</td>
                        <td style="text-align: center">{{$audit_team_member['team_member_designation_bn']}}</td>
                        <td style="text-align: center">{{$audit_team_member['team_member_role_bn']}}</td>
                        <td style="text-align: center">{{enTobn($audit_team_member['mobile_no'])}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div> -->

        @php $allWorkingDates = []; @endphp

                <div style="margin-top: 5px">
                    <table width="100%" border="1">
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
                                        @php $teamMemberSL++; @endphp
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

        <div style="float: right; margin-top: 3%;">
            <!-- {!! nl2br($office_order['issuer_details']) !!} -->
            <div style="text-align: center;">   
                @php
                    $data = collect($audit_team_members)->firstWhere('team_member_role_en', 'teamLeader')
                @endphp
                <p>{{$data['team_member_name_en']}}</p>
                <p>{{ucfirst($data['team_member_role_en'])}}</p>
                <p>{{$data['team_member_designation_en']}}</p>
            </div>
        </div>

        {{--<div style="text-align: center;float: right">
            @if(isset($office_order['office_order_movement']) && $office_order['office_order_movement'] != null)
                ({{$office_order['office_order_movement']['employee_name_bn']}}) <br>
                {{$office_order['office_order_movement']['employee_designation_bn']}} <br>
                ফোনঃ {{enTobn($office_order['office_order_movement']['officer_phone'])}} <br>
                ইমেইলঃ {{enTobn($office_order['office_order_movement']['officer_email'])}}
            @endif
        </div>--}}

        <!-- <div style="width: 100%; float: right;">
            <span style="width: 85%;float: left;text-align: left">
                {{$office_order['memorandum_no_2'] ?: $office_order['memorandum_no']}}
            </span>
            <span style="width: 15%;float: right;text-align: right">
                তারিখঃ  {{$office_order['memorandum_date_2'] ? formatDate($office_order['memorandum_date_2'],'bn') : enTobn($office_order['memorandum_date'])}} খ্রি।
            </span>
        </div> -->
        <br>
        <br>

        {{--for audit advice--}}
        <div style="margin-top: 2%;text-align: left; font-style: italic;">
            <h5>Copy for kind information and necessary action:</h5>
        </div>

        <div style="text-align: justify">
            {!! nl2br($office_order['order_cc_list']) !!}
        </div>

        <!-- <div style="text-align: center;float: right">
            {!! nl2br($office_order['cc_sender_details']) !!}
        </div> -->
    </div>
</div>


<script>
    var Show_Office_Order_Container = {
        loadOfficeOrderApprovalAuthority: function (element) {
            url = '{{route('audit.plan.audit.office-orders.load-office-order-approval-authority')}}';
            ap_office_order_id = element.data('ap-office-order-id');
            audit_plan_id = element.data('audit-plan-id');
            annual_plan_id = element.data('annual-plan-id');
            data = {ap_office_order_id, audit_plan_id, annual_plan_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('অনুমোদনকারী বাছাই করুন');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '40%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        approveOfficeOrder: function (element) {
            url = '{{route('audit.plan.audit.office-orders.approve-office-order')}}';
            fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
            ap_office_order_id = element.data('ap-office-order-id');
            audit_plan_id = element.data('audit-plan-id');
            annual_plan_id = element.data('annual-plan-id');
            approved_status = 'approved';
            data = {ap_office_order_id, audit_plan_id, annual_plan_id, approved_status, fiscal_year_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'success') {
                    toastr.success('Successfully Approved!');
                } else {
                    if (response.statusCode === '422') {
                        var errors = response.msg;
                        $.each(errors, function (k, v) {
                            if (v !== '') {
                                toastr.error(v);
                            }
                        });
                    } else {
                        toastr.error(response.data.message);
                    }
                }
            });
        },

        generateOfficeOrderPDF: function (elem) {
            url = '{{route('audit.plan.audit.office-orders.download-pdf')}}';
            office_order_id = elem.data('ap-office-order-id');
            audit_plan_id = elem.data('audit-plan-id');
            annual_plan_id = elem.data('annual-plan-id');
            data = {audit_plan_id, annual_plan_id, office_order_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                message: 'Downloading Please Wait..',
                state: 'primary' // a bootstrap color
            });

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (response) {
                    KTApp.unblock('#kt_wrapper');
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "office_order.pdf";
                    link.click();
                },
                error: function (blob) {
                    toastr.error('Failed to generate PDF.')
                    console.log(blob);
                }
            });
        },
    }
</script>
