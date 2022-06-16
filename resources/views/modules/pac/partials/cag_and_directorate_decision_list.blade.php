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
                <td style="text-align: center" width="30%">আপত্তির অনুচ্ছেদ ও আপত্তির শিরোনাম</td>
                <td style="text-align: center" width="20%">নিরীক্ষিত প্রতিষ্ঠানের জবাব</td>
                <td style="text-align: left" width="20%">সংস্থার নির্বাহী প্রধানের জবাব</td>
                <td style="text-align: left" width="20%">মন্ত্রণালয়/বিভাগ/অন্যান্য এর জবাব</td>
                <td style="text-align: left" width="20%">অধিদপ্তরের মন্তব্য</td>
                <td style="text-align: left" width="10%">আপত্তির অবস্থা</td>
                <td style="text-align: center" width="20%">
                    কার্যক্রম
                </td>
            </tr>
            </thead>
            <tbody>
            @foreach($meetingInfo['meeting_apotti_details'] as $apotti)
                <tr>
                    <td style="text-align: justify;">
                        <span style="padding:5px; margin-bottom: 5px">
                            <b>অনুচ্ছেদ নং - {{enTobn($apotti['onucched_no'])}}  </b>

                            @if($apotti['is_combined'])
                                <span class="badge badge-info text-uppercase m-1 p-1 ">
                                {{enTobn(count($apotti['apotti_items'])) }}
                                    টি আপত্তি একীভূত
                                </span>
                            @endif

                            <br> {{$apotti['apotti_title']}}

                        </span>
                    </td>
                    <td style="text-align: left;vertical-align: top;">
                        {{$apotti['is_combined'] == 0 ? $apotti['apotti_items'][0]['unit_response'] : ''}}
                    </td>
                    <td style="text-align: left;vertical-align: top;">
                        {{$apotti['is_combined'] == 0 ? $apotti['apotti_items'][0]['entity_response'] : ''}}
                    </td>
                    <td style="text-align: left;vertical-align: top;">
                        {{$apotti['is_combined'] == 0 ? $apotti['apotti_items'][0]['ministry_response'] : ''}}
                    </td>
                    <td style="text-align: left;vertical-align: top;"></td>

                    <td style="text-align: left;vertical-align: top;">
                        @if($apotti['status'] == 1)
                            নিস্পন্ন
                        @elseif($apotti['status'] == 2)
                            অনিস্পন্ন
                        @elseif($apotti['status'] == 3)
                            আংশিক নিস্পন্ন
                        @endif
                    </td>
                    <td>
                        <button class="mr-1 btn btn-sm btn-primary btn-square btn_apotti_decision" title="সিদ্ধান্ত"
                                data-apotti-id="{{$apotti['id']}}"
                                onclick="CagAndDirectorateDecision_Container.pacApottiDecisionForm($(this))">
                            সিদ্ধান্ত
                        </button>

                        @if($apotti['is_combined'])
                            <button id="apotti_{{$apotti['id']}}"  class="mr-1 btn btn-sm btn-primary btn-square btn_apotti_decision" title="সিদ্ধান্ত"
                                    data-apotti-id="{{$apotti['id']}}"
                                    onclick="CagAndDirectorateDecision_Container.showApottiItem($(this))">
                                একীভূত আপত্তি সমূহ
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>


<script>
    var CagAndDirectorateDecision_Container = {
        showApottiItem: function (elem) {
            apotti_id = elem.data('apotti-id');
            let url = '{{route('pac.get-apotti-item')}}';
            let data = {apotti_id};
            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $(".offcanvas-title").text('একীভূত আপত্তি সমূহ');
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
        cagAndDirectoreateApottiDecisionForm: function (elem) {
            apotti_item_id = elem.data('apotti-item-id');
            let url = '{{route('pac.cag-and-directorate-decision-form')}}';
            let data = {apotti_item_id};
            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $(".offcanvas-title").text('সিদ্ধান্ত দিন');
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        backToMargedApotti: function (elem) {
            apotti_id = elem.data('apotti-id');
            $('#apotti_'+apotti_id).click();
        }
    };
</script>
