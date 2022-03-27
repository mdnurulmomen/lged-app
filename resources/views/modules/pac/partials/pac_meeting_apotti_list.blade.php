<div class="card sna-card-border p-2">
    <div class="ml-5">
        <div class="row">
            <b>মন্ত্রণালয়/বিভাগঃ </b> <span class="pl-2">{{$meetingInfo['ministry_name_bn']}}</span>
        </div>
        <div class="row">
            <b>অডিট অধিদপ্তরঃ </b> <span class="pl-2">{{$meetingInfo['directorate_bn']}}</span>
        </div>
        <div class="row">
            <b>অডিট রিপোর্টের নামঃ </b> <span class="pl-2">{{$meetingInfo['report_name']}}</span>
        </div>
        {{--       <span><h3>অডিট রিপোর্টেরঃ </h3>{{$meetingInfo['ministry_name_bn']}}</span>--}}
        <div class="row">

            <b>অর্থবছরঃ </b> <span class="pl-2">{{enTobn($meetingInfo['fiscal_year']['start'])}}
            - {{enTobn($meetingInfo['fiscal_year']['end'])}}</span>
        </div>
    </div>
</div>

<div class="card sna-card-border mt-2">
    <div class="card-body">
        <table class="table table-bordered" width="100%">
            <thead class="thead-light">
            <tr class="bg-light">
                <td style="text-align: center" width="30%">আলোচ্য বিষয়/অডিট আপত্তির অনুচ্ছেদ ও আপত্তির শিরোনাম</td>
                <td style="text-align: center" width="20%">পিএ কমিটির সিদ্ধান্ত</td>
                <td style="text-align: left" width="20%">সংস্থা/প্রতিষ্ঠান ও মন্ত্রণালয়/বিভাগের প্রতিবেদন</td>
                <td style="text-align: left" width="20%">সিএজি মন্তব্য</td>
                <td style="text-align: left" width="20%">সিদ্ধান্ত বাস্তবায়নের শেষ তারিখ</td>
                <td style="text-align: left" width="20%">হালনাগাদ অবস্থা</td>
                <td style="text-align: left" width="20%">অনুশাসন অনুসরণকারী অফিস</td>
                <td style="text-align: center" width="10%">
                    কার্যক্রম
                </td>
            </tr>
            </thead>
            <tbody>
            @foreach($meetingInfo['meeting_apottis'] as $apotti)
                <tr>
                    <td style="text-align: justify;">
                        <span style="padding:5px; margin-bottom: 5px">
                            <b>অডিট আপত্তি অনুচ্ছেদ নং - {{enTobn($apotti['onucched_no'])}} </b>
                            <br> {{$apotti['apotti_title']}}
                        </span>
                    </td>
                    <td style="">
                        @if($apotti['pac_meeting_apotti_decisions'] && $apotti['pac_meeting_apotti_decisions']['pac_apotti_decisions'])
                            @foreach($apotti['pac_meeting_apotti_decisions']['pac_apotti_decisions'] as $pac_apotti_decisions)
                                <div>
                                <span>
                                   <b>সিদ্ধান্ত {{enTobn($loop->iteration)}}</b><br>
                                    {{$pac_apotti_decisions['pac_decision']}}
                                </span>
                                </div>
                                <br>
                            @endforeach
                        @endif
                    </td>

                    <td style="text-align: left;vertical-align: top;">
                        {{$apotti['pac_meeting_apotti_decisions'] ? $apotti['pac_meeting_apotti_decisions']['rp_report'] : ''}}
                    </td>

                    <td style="text-align: left;vertical-align: top;">
                        {{$apotti['pac_meeting_apotti_decisions'] ? $apotti['pac_meeting_apotti_decisions']['cag_comment'] : ''}}
                    </td>

                    <td style="text-align: left;vertical-align: top;">
                        {{$apotti['pac_meeting_apotti_decisions'] ?  formatDate($apotti['pac_meeting_apotti_decisions']['decision_last_date'],'bn')  : ''}}
                    </td>

                    <td style="text-align: left;vertical-align: top;">

                        @if($apotti['pac_meeting_apotti_decisions'])
                            @if($apotti['pac_meeting_apotti_decisions']['apotti_status'] == 1)
                                নিস্পন্ন
                            @elseif($apotti['pac_meeting_apotti_decisions']['apotti_status'] == 2)
                                অনিস্পন্ন
                            @elseif($apotti['pac_meeting_apotti_decisions']['apotti_status'] == 3)
                                আংশিক নিস্পন্ন
                            @endif
                        @endif
                    </td>

                    <td style="text-align: left;vertical-align: top;">
                        {{$apotti['pac_meeting_apotti_decisions'] ? $apotti['pac_meeting_apotti_decisions']['follower_office'] : ''}}
                    </td>

                    <td>
                        <button class="mr-1 btn btn-sm btn-primary btn-square btn_apotti_decision" title="সিদ্ধান্ত"
                                data-apotti-id="{{$apotti['apotti_id']}}"
                                onclick="Pac_MeetingMinutes_Container.pacApottiDecisionForm($(this))">
                            সিদ্ধান্ত
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>


<script>
    var Pac_MeetingMinutes_Container = {
        pacApottiDecisionForm: function (elem) {
            apotti_id = elem.data('apotti-id');
            let url = '{{route('pac.pac-apotti-decision-form')}}';
            let data = {apotti_id};
            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $(".offcanvas-title").text('সিদ্ধান্ত দিন');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '50%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        submitPacMeetingDecision: function () {
            url = '{{route('pac.pac-meeting-decision-store')}}';
            data = $('#apoitti_decision_form').serializeArray();
            pac_meeting_id = '{{$meetingInfo['id']}}';
            final_report_id = '{{$meetingInfo['final_report_id']}}';

            data.push({name: "pac_meeting_id", value: pac_meeting_id});
            data.push({name: "final_report_id", value: final_report_id});

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error('Internal Serve Error');
                } else {
                    toastr.success(response.data);
                    $('.kt_quick_panel_close').click();
                    // $('.pac-meeting-link a').click();
                }
            })
        },
    };
</script>
