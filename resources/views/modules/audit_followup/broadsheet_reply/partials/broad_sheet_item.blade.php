<div class="table-search-header-wrapper mb-4 p-4 shadow-sm">
    <div class="row">
        <div class="col-xl-4 text-left">
            <h3>স্মারক নংঃ {{$memorandum_no}}</h3>
        </div>
        <div class="col-xl-4 text-center">
            <h3>এন্টিটিঃ {{$entity_name}}</h3>
        </div>
        <div class="col-xl-4 text-right">
            <h3>তারিখঃ {{$memorandum_date}}</h3>
        </div>
    </div>
</div>

<div class="card card-custom card-stretch">
    <div class="card-body">
        <table class="table table-bordered" width="100%">
            <thead class="thead-light">
            <tr class="bg-light">
                <td style="text-align: center" width="5%">অনুচ্ছেদ নং</td>
                <td style="text-align: center" width="10%">কস্ট সেন্টার/ইউনিট</td>
                <td style="text-align: center" width="5%">নিরীক্ষা বছর</td>
                <td style="text-align: center" width="5%">আপত্তি ক্যাটাগরি</td>
                <td style="text-align: center" width="25%">শিরোনাম ও বিবরণ</td>
                <td style="text-align: right" width="10%">জড়িত টাকার পরিমাণ</td>
                <td style="text-align: right" width="10%">অনিষ্পন্ন জড়িত টাকার পরিমাণ</td>
                <td style="text-align: center" width="5%">
                    ডিরেক্টরেট এর সিদ্ধান্ত
                </td>
                <td style="text-align: left" width="15%">নিরীক্ষিত প্রতিষ্ঠানের জবাব</td>
                <td style="text-align: left" width="15%">সংস্থার নির্বাহী প্রধানের জবাব</td>
                <td style="text-align: left" width="15%">মন্ত্রণালয়/বিভাগ/অন্যান্য এর জবাব</td>
                <td style="text-align: center" width="20%">
                    কার্যক্রম
                </td>
            </tr>
            </thead>
            <tbody>
            @foreach($broadSheetItem as $broadSheet)
                <tr>
                    <td style="text-align: center;vertical-align: top;">{{enTobn($broadSheet['apotti']['onucched_no'])}}</td>
                    <td style="text-align: center;vertical-align: top;">{{enTobn($broadSheet['apotti']['cost_center_name_bn'])}}</td>
                    <td style="text-align: center;vertical-align: top;">{{enTobn($broadSheet['apotti']['fiscal_year']['start']).'-'.enTobn($broadSheet['apotti']['fiscal_year']['end'])}}</td>
                    <td style="text-align: center;vertical-align: top;">
                        @if($broadSheet['apotti']['memo_type'] == 'sfi')
                            @php $apottiType = 'এসএফআই'; @endphp
                        @else
                            @php $apottiType = 'নন-এসএফআই'; @endphp
                        @endif
                        {{$apottiType}}
                    </td>
                    <td style="text-align: justify;">
                        <span style="padding:5px; margin-bottom: 5px"><b>শিরোনামঃ</b> <br> {{$broadSheet['apotti']['memo_title_bn']}}</span>
                        <br>
                        <br>
                        <span
                            style="padding:5px;"><b>বিবরণঃ</b> {!! $broadSheet['apotti']['memo_description_bn'] !!}</span>
                    </td>
                    <td style="text-align: right;vertical-align: top;">{{enTobn(number_format($broadSheet['jorito_ortho_poriman'],0))}}
                    </td>

                    <td style="text-align: right;vertical-align: top;">{{enTobn(number_format($broadSheet['onishponno_jorito_ortho_poriman'],0))}}
                    </td>
                    <td style="text-align: left;vertical-align: top;padding:5px;">
                        <p>

                            @if($broadSheet['status'] == '1')
                                <b>আপত্তি অবস্থা :</b>  নিষ্পন্ন
                            @elseif($broadSheet['status'] == '2')
                                <b>আপত্তি অবস্থা :</b> অনিষ্পন্ন
                            @elseif($broadSheet['status'] == '3')
                                <b>আপত্তি অবস্থা :</b> আংশিক নিষ্পন্ন
                            @endif

                        </p>

                        <br>

                        <p>
                           <b>মন্তব্য :</b> {{$broadSheet['comment']}}
                        </p>

                    </td>
                    <td style="text-align: left;vertical-align: top;padding:5px;">{{$broadSheet['apotti']['unit_response']}}</td>
                    <td style="text-align: left;vertical-align: top;padding:5px;">{{$broadSheet['apotti']['entity_response']}}</td>
                    <td style="text-align: left;vertical-align: top;padding:5px;">{{$broadSheet['apotti']['ministry_response']}}</td>
                    <td>
                        @if(!$broadSheet['approval_status'])
                            <button class="mr-1 btn btn-sm btn-primary btn-square btn_apotti_decision" title="সিদ্ধান্ত"
                                    data-broad-sheet-id="{{$broadSheet['broad_sheet_reply_id']}}"
                                    data-apotti-item-id="{{$broadSheet['apotti']['id']}}"
                                    data-memo-id="{{$broadSheet['apotti']['memo_id']}}"
                                    data-jorito-ortho="{{$broadSheet['apotti']['jorito_ortho_poriman']}}"
                                    onclick="ApottiDecision_Container.getApottiDecisionForm($(this))">
                                সিদ্ধান্ত
                            </button>
                        @endif

                        @if($broadSheet['approval_status'])
                            <a href="javascript:;"
                               class="badge-square rounded-0 badge d-flex align-items-center alert-success
                                       font-weight-normal mr-1 border decision">
                                অনুমোদিত
                            </a>
                        @endif

                        @if($desk_officer_grade == 3)
                            <button class="mr-1 btn btn-sm btn-primary btn-square" title="সিদ্ধান্ত"
                                    data-broad-sheet-id="{{$broadSheet['broad_sheet_reply_id']}}"
                                    data-apotti-item-id="{{$broadSheet['apotti']['id']}}"
                                    data-memo-id="{{$broadSheet['apotti']['memo_id']}}"
                                    onclick="ApottiDecision_Container.approveBraodSheetApotti($(this))">
                                অনুমোদন করুন
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

    var ApottiDecision_Container = {

        getApottiDecisionForm : function (elem) {

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            broad_sheet_id = elem.data('broad-sheet-id');
            apotti_item_id = elem.data('apotti-item-id');
            jorito_ortho = elem.data('jorito-ortho');
            memo_id = elem.data('memo-id');

            url = '{{route('audit.followup.broadsheet.reply.get-apotti-decision-form')}}';

            var data = {apotti_item_id,jorito_ortho,broad_sheet_id,memo_id};

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
                    KTApp.unblock('#kt_content');

                    quick_panel = $("#kt_quick_panel");
                    $('.offcanvas-wrapper').html('');
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '40%');
                    $('.offcanvas-footer').hide();
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $('.offcanvas-title').html('সিদ্ধান্ত দিন');

                    $('.offcanvas-wrapper').html(resp);
            });
        },

        apottiDecision : function (elem) {
            data  = $('#apoitti_decision_form').serializeArray();

            let url = '{{route('audit.followup.broadsheet.reply.get-apotti-decision-submit')}}';

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    toastr.success(response.data);
                    $('#kt_quick_panel_close').click();
                }
            });
        },

        approveBraodSheetApotti : function (elem) {
            swal.fire({
                title: 'আপনি কি অনুমোদন করতে চান?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'হ্যাঁ',
                cancelButtonText: 'না'
            }).then(function(result) {
                if (result.value) {
                    KTApp.block('#kt_content', {
                        opacity: 0.1,
                        state: 'primary'
                    });

                    broad_sheet_id = elem.data('broad-sheet-id');
                    apotti_item_id = elem.data('apotti-item-id');
                    memo_id = elem.data('memo-id');

                    let url = '{{route('audit.followup.broadsheet.reply.approve-broad-sheet-apotti')}}';

                    var data = {apotti_item_id,broad_sheet_id,memo_id};

                    ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                        KTApp.unblock('#kt_content');
                        if (response.status === 'error') {
                            toastr.error(response.data);
                        } else {
                            toastr.success(response.data);
                        }
                    });
                }
            });

        },
    }
</script>
