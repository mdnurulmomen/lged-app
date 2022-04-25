<x-title-wrapper>Office Order</x-title-wrapper>

<div class="row m-0 mb-2 page-title-wrapper d-md-flex align-items-md-center">
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

            <button data-audit-plan-id="{{$office_order['audit_plan_id']}}"
                    data-annual-plan-id="{{$office_order['annual_plan_id']}}"
                    onclick="Show_Office_Order_Container.generateOfficeOrderPDF($(this))"
                    class="btn btn-download btn-sm btn-bold btn-square">
                <i class="far fa-file-pdf"></i> ডাউনলোড করুন
            </button>
        </div>
    </div>
</div>

<div class="card sna-card-border mt-3" style="margin-bottom:30px;">
    <div style="font-family:Nikosh,serif !important;text-align: center">
        {{--মহাপরিচালকের কার্যালয় <br>--}}
        <x-office-header-details />

        <div style="font-family:Nikosh,serif !important;width: 100%;margin-top: 10px">
            <span style="width: 85%;float: left;text-align: left">
                স্মারক নং- {{$office_order['memorandum_no']}}
            </span>
            <span style="width: 15%;float: right;text-align: right">
                তারিখঃ  {{enTobn($office_order['memorandum_date'])}} খ্রি।
            </span>
        </div>

        <div style="font-family:Nikosh,serif !important;text-align: center">
            <b><u>অফিস আদেশ</u></b>
        </div>
        <div style="font-family:Nikosh,serif !important;text-align: justify">
            {{$office_order['heading_details']}}
        </div>

        <div style="font-family:Nikosh,serif !important;text-align: center">
            <b><u>জনবল</u></b>
        </div>

        <div style="margin-top: 5px">
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
        </div>
        @foreach($audit_team_schedules as $audit_team_schedule)
            @if($audit_team_schedule['team_schedules'] != null)
                <div style="font-family:Nikosh,serif !important;text-align: center;margin-top: 10px">
                    <b><u>{{$audit_team_schedule['team_name']}}</u></b>
                </div>

                <div style="margin-top: 5px">
                    <table width="100%" border="1">
                        <thead>
                        <tr>
                            <th style="text-align: center" width="5%">ক্রমিক নং</th>
                            <th style="text-align: center" width="45%">নাম</th>
                            <th style="text-align: center" width="20%">পদবী</th>
                            <th style="text-align: center" width="15%">মোবাইল নং</th>
                            <th style="text-align: center" width="15%">মন্তব্য</th>
                        </tr>
                        </thead>
                        <tbody>

                        @php $teamMemberSL = 1; @endphp
                        @foreach(json_decode($audit_team_schedule['team_members'],true) as $role => $team_members)
                            @if($role != 'teamLeader')
                                @php
                                    usort($team_members, "arryAortAsc");
                                @endphp
                                @foreach($team_members as $member_key => $sub_team_leader)
                                    <tr>
                                        <td style="text-align: center">{{enTobn($teamMemberSL)}}</td>
                                        <td style="text-align: left;margin-left: 5px">জনাব {{$sub_team_leader['officer_name_bn']}}</td>
                                        <td style="text-align: center">{{$sub_team_leader['designation_bn'].' ও '.$sub_team_leader['team_member_role_bn']}}</td>
                                        <td style="text-align: center">{{enTobn($sub_team_leader['officer_mobile'])}}</td>
                                        <td style="text-align: center"></td>
                                    </tr>
                                    @php $teamMemberSL++; @endphp
                                @endforeach
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 15px">
                    <table width="100%" border="1">
                        <tbody>
                        <tr>
                            <td style="text-align: center" width="5%">ক্রমিক নং</td>
                            <td style="text-align: center" width="45%">শাখার নাম</td>
                            <td style="text-align: center" width="20%">নিরীক্ষা বছর</td>
                            <td style="text-align: center" width="15%">নিরীক্ষা সময়কাল</td>
                            <td style="text-align: center" width="15%">মোট কর্ম দিবস</td>
                        </tr>
                        <tr>
                            <td style="text-align: center" width="5%">১</td>
                            <td style="text-align: center" width="45%">২</td>
                            <td style="text-align: center" width="20%">৩</td>
                            <td style="text-align: center" width="15%">৪</td>
                            <td style="text-align: center" width="15%">৫</td>
                        </tr>
                        @php
                            $totalActivityManDays = 0;
                        @endphp
                        @foreach(json_decode($audit_team_schedule['team_schedules'],true) as $role => $team_schedule)
                            @if($team_schedule['schedule_type'] == 'schedule')
                                @php $totalActivityManDays= $totalActivityManDays+$team_schedule['activity_man_days']; @endphp
                                <tr>
                                    <td style="text-align: center">{{enTobn($loop->iteration)}}.</td>
                                    <td style="text-align: left;margin-left: 5px">{{$team_schedule['cost_center_name_bn']}}</td>
                                    <td style="text-align: center">{{enTobn($audit_team_schedule['audit_year_start'])}}-{{enTobn($audit_team_schedule['audit_year_end'])}}</td>
                                    <td style="text-align: center">{{formatDate($team_schedule['team_member_start_date'],'bn')}} খ্রি.
                                        হতে {{formatDate($team_schedule['team_member_end_date'],'bn')}} খ্রি.
                                    </td>
                                    <td style="text-align: center">{{enTobn($team_schedule['activity_man_days'])}} কর্ম দিবস</td>
                                </tr>
                            @else
                                <tr>
                                    <td style="text-align: center">{{enTobn($loop->iteration)}}.</td>
                                    <td colspan="3" style="text-align: center">{{formatDate($team_schedule['team_member_start_date'],'bn')}} খ্রি. {{$team_schedule['activity_details']}}</td>
                                    <td></td>
                                </tr>
                            @endif
                        @endforeach
                        <tr>
                            <th colspan="4" style="text-align: right">সর্বমোট</th>
                            <th style="text-align: center">{{enTobn($totalActivityManDays)}} কর্ম দিবস</th>
                        </tr>
                        </tbody>
                    </table>
                </div>

            @endif
        @endforeach


        {{--for audit advice--}}
        <div style="font-family:Nikosh,serif !important;margin-top: 10px;text-align: left">
            <u>নিরীক্ষা দলের প্রতি নির্দেশনা:</u>
        </div>

        <div style="font-family:Nikosh,serif !important;text-align: justify">
            {!! nl2br($office_order['advices']) !!}
        </div>

        <div style="font-family:Nikosh,serif !important;text-align: center;float: right">
            @if($office_order['office_order_movement'] != null)
                ({{$office_order['office_order_movement']['employee_name_bn']}}) <br>
                {{$office_order['office_order_movement']['employee_designation_bn']}} <br>
                ফোনঃ {{enTobn($office_order['office_order_movement']['officer_phone'])}} <br>
                ইমেইলঃ {{enTobn($office_order['office_order_movement']['officer_email'])}}
            @endif
        </div>

        <div style="font-family:Nikosh,serif !important;width: 100%;margin-top: 100px">
                <span style="width: 85%;float: left;text-align: left">
                    {{$office_order['memorandum_no']}}
                </span>
            <span style="width: 15%;float: right;text-align: right">
                    তারিখঃ  {{enTobn($office_order['memorandum_date'])}} খ্রি।
                </span>
        </div>
        <br>

        {{--for audit advice--}}
        <div style="font-family:Nikosh,serif !important;margin-top: 20px;text-align: left">
            <u>সদয় অবগতি ও প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য অনুলিপি প্রেরণ করা হলো :(জ্যেষ্ঠতার ক্রমানুসারে নয় )</u>
        </div>

        <div style="font-family:Nikosh,serif !important;text-align: justify">
            {!! nl2br($office_order['order_cc_list']) !!}
        </div>

        <div style="font-family:Nikosh,serif !important;text-align: center;float: right">
            {{--({{$office_order['draft_officer_name_bn']}}) <br>
            {{$office_order['draft_designation_name_bn']}} <br>
            {{$office_order['draft_office_unit_bn']}} <br>
            ফোন: {{enTobn($office_order['draft_officer_phone'])}}--}}

            {!! nl2br($office_order['cc_sender_details']) !!}
        </div>
    </div>
</div>


<script>
    var Show_Office_Order_Container={
        loadOfficeOrderApprovalAuthority: function (element) {
            url = '{{route('audit.plan.audit.office-orders.load-office-order-approval-authority')}}';
            ap_office_order_id = element.data('ap-office-order-id');
            audit_plan_id = element.data('audit-plan-id');
            annual_plan_id = element.data('annual-plan-id');
            data = {ap_office_order_id,audit_plan_id,annual_plan_id};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
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
            data = {ap_office_order_id,audit_plan_id,annual_plan_id,approved_status,fiscal_year_id};

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {
                    toastr.success('Successfully Approved!');
                }
                else {
                    if (response.statusCode === '422') {
                        var errors = response.msg;
                        $.each(errors, function (k, v) {
                            if (v !== '') {
                                toastr.error(v);
                            }
                        });
                    }
                    else {
                        toastr.error(response.data.message);
                    }
                }
            });
        },

        generateOfficeOrderPDF: function (elem) {
            url = '{{route('audit.plan.audit.office-orders.download-pdf')}}';
            audit_plan_id = elem.data('audit-plan-id');
            annual_plan_id = elem.data('annual-plan-id');
            data = {audit_plan_id,annual_plan_id};

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (response) {
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
