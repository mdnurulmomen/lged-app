<div class="table-search-header-wrapper mb-4 pt-3 pb-3 shadow-sm">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-md-12">
                <a data-qac-type="{{$qac_type}}"
                   data-air-report-id="{{$responseData['rAirInfo']['r_air_child']['id']}}"
                   onclick="QAC_Apotti_List_Container.loadAIREdit($(this))"
                   class="mr-1 btn btn-sm {{$responseData['rAirInfo']['r_air_child']['status']=='approved'?'btn-outline-primary':'btn-outline-danger'}} btn-square" href="javascript:;">
                    <i class="far fa-book"></i> {{$qac_type == 'qac-1'?'এআইআর':'রিপোর্ট'}} বিস্তারিত
                </a>

                <a data-qac-type="{{$qac_type}}"
                   data-air-report-id="{{$responseData['rAirInfo']['r_air_child']['id']}}"
                   onclick="QAC_Apotti_List_Container.selectCommittee($(this))"
                   class="mr-1 btn btn-sm btn-outline-primary btn-square" href="javascript:;">
                    <i class="far fa-book"></i>  কমিটি বাছাই করুন
                </a>

                <a data-qac-type="{{$qac_type}}"
                   data-air-report-id="{{$responseData['rAirInfo']['r_air_child']['id']}}"
                   onclick="QAC_Apotti_List_Container.createQacReport($(this))"
                   class="mr-1 btn btn-sm btn-outline-primary btn-square" href="javascript:;">
                    <i class="far fa-book"></i>  রিপোর্ট
                </a>

                @if($qac_type == 'qac-1' && $responseData['rAirInfo']['r_air_child']['status']=='approved')
                    @if($responseData['rAirInfo']['r_air_child']['is_sent']== 0)
                        <button data-air-report-id="{{$responseData['rAirInfo']['r_air_child']['id']}}"
                            class="btn btn-sm btn-square btn-primary btn-hover-primary air_sent_responsible_party"
                                onclick="QAC_Apotti_List_Container.airSendToRpu($(this))">
                            <i class="fad fa-paper-plane"></i> রেস্পন্সিবল পার্টিকে প্রেরণ করুন
                        </button>
                    @elseif($responseData['rAirInfo']['r_air_child']['is_received']== null)
                        <span class="badge badge-primary">
                          <i class="fal fa-info text-white"></i>  রেস্পন্সিবল পার্টিকে প্রেরণ করা হয়েছে
                        </span>
                    @elseif($responseData['rAirInfo']['r_air_child']['is_received']== 1)
                        <span class="badge badge-primary">
                          Received
                        </span>
                    @endif
                @endif

                <span class="text-warning ml-2 mt-2">
                    {{empty($responseData['rAirInfo']['r_air_child']['latest_r_air_movement'])?'':'('.$responseData['rAirInfo']['r_air_child']['latest_r_air_movement']['receiver_employee_designation_bn'].' এর কাছে প্রেরণ করা হয়েছে)'}}
                </span>
            </div>
        </div>
    </div>
</div>

<table class="table table-hover" width="100%">
    <thead class="thead-light">
    <tr class="bg-hover-warning">
        <th width="7%" class="text-center">
            অনুচ্ছেদ নং
        </th>

        <th width="37%" class="text-left">
            আপত্তির শিরোনাম
        </th>

        <th width="15%" class="text-right">
            জড়িত অর্থ (টাকা)
        </th>

        <th width="12%" class="text-left">
            আপত্তির ধরন
        </th>

        <th width="33%" class="text-left">
            কার্যক্রম
        </th>
    </tr>
    </thead>

    <tbody>
    @forelse($responseData['apottiList'] as $apotti)
        <tr class="text-center">
            <td>
                {{enTobn($apotti['apotti_map_data']['onucched_no'])}}

                @if(count($apotti['apotti_map_data']['apotti_items']) > 1)
                    <span class="badge badge-info text-uppercase m-1 p-1 ">
                     {{enTobn(count($apotti['apotti_map_data']['apotti_items'])) }} টি
                        আপত্তি একীভূত</span>
                @endif
            </td>
            <td class="text-left">
                <span>{{$apotti['apotti_map_data']['apotti_title']}}</span>
            </td>
            <td class="text-right">
                <span>{{enTobn(number_format($apotti['apotti_map_data']['total_jorito_ortho_poriman'],0))}}/-</span>
            </td>
            <td class="text-left">
                @if($apotti['apotti_map_data']['is_delete'] == 1)
                    প্রত্যাহার
                @elseif($apotti['apotti_map_data']['final_status'] == 'draft')
                    রিপোর্ট ভুক্তির জন্য প্রস্তাবকৃত এসএফআই
                @elseif($apotti['apotti_map_data']['final_status'] == 'approved')
                    রিপোর্ট ভুক্তির জন্য চূড়ান্তকৃত এসএফআই
                @elseif($apotti['apotti_map_data']['apotti_type'] == 'sfi')
                    এসএফআই
                @elseif($apotti['apotti_map_data']['apotti_type'] == 'non-sfi')
                    নন-এসএফআই
                @endif
            </td>
            <td class="text-left">
                <button class="mr-1 btn btn-sm btn-primary btn-square" title="বিস্তারিত দেখুন"
                        data-apotti-id="{{$apotti['apotti_map_data']['id']}}"
                        onclick="Qac_Container.showApotti($(this))">
                    <i class="fad fa-eye"></i> বিস্তারিত
                </button>

                @if($responseData['rAirInfo']['r_air_child']['status'] != 'approved')
                    @if($qac_type == 'cqat')
                        @if($apotti['apotti_map_data']['final_status'] == 'draft')
                            <button type="button" class="ml-1 btn btn-sm btn-primary btn-square"
                                    title="প্রস্তাবিত খসড়া"
                                    data-air-report-id="{{$responseData['rAirInfo']['r_air_child']['id']}}"
                                    data-apotti-id="{{$apotti['apotti_map_data']['id']}}"
                                    data-final-approval-status="approved"
                                    onclick="QAC_Apotti_List_Container.apottiFinalApproval($(this))">
                                চূড়ান্ত করুন
                            </button>
                        @endif
                    @else
                        @if(empty($responseData['rAirInfo']['r_air_child']['latest_r_air_movement']) || $responseData['rAirInfo']['r_air_child']['latest_r_air_movement']['receiver_employee_designation_id'] == $current_designation_id)
                            <button class="btn btn-sm btn-primary btn-square mr-1" title="QAC-01"
                                    data-air-report-id="{{$responseData['rAirInfo']['r_air_child']['id']}}"
                                    data-is-delete="{{$apotti['apotti_map_data']['is_delete']}}"
                                    data-final-status="{{$apotti['apotti_map_data']['final_status']}}"
                                    data-apotti-id="{{$apotti['apotti_map_data']['id']}}"
                                    data-qac-type="{{$qac_type}}"
                                    onclick="Qac_Container.qacApotti($(this))">
                                @if(!empty($apotti['apotti_map_data']['apotti_status']))
                                    <i class="fa fa-check"></i>
                                @endif
                                {{strtoupper($qac_type)}}
                            </button>

                            <button class="mr-1 btn btn-sm btn-primary btn-square" title="সম্পাদন করুন"
                                    data-apotti-id="{{$apotti['apotti_map_data']['id']}}"
                                    onclick="Qac_Container.editApotti($(this))">
                                <i class="fad fa-pencil"></i> সম্পাদন
                            </button>
                        @endif
                    @endif
                @endif
            </td>
        </tr>
    @empty
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td colspan="4" class="datatable-cell text-center"><span>Nothing Found</span></td>
        </tr>
    @endforelse
    </tbody>
</table>
<script>

    //select all checkboxes
    $("#selectAll").change(function(){
        var status = this.checked;
        $('.select-apotti').each(function(){
            if (!$(this).is(':disabled')) {
                this.checked = status;
            }
        });
    });

    $('.select-apotti').change(function(){
        if(this.checked == false){
            $("#selectAll")[0].checked = false;
        }

        if ($('.select-apotti:checked').length == $('.select-apotti').length ){
            $("#selectAll")[0].checked = true;
            $("#selectAll")[0].addClass('checkbox-disabled');
        }
    });


    var QAC_Apotti_List_Container = {
        loadAIREdit: function (elem) {
            url = '{{route('audit.report.air.qac.edit-air-report')}}';
            qac_type = elem.data('qac-type');
            air_report_id = elem.data('air-report-id');
            data = {qac_type,air_report_id};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    var newDoc = document.open("text/html", "replace");
                    newDoc.write(response);
                    newDoc.close();
                }
            })
        },

        loadDeleteApottiView: function (elem) {
            url = '{{route('audit.report.air.qac.load-apotti-delete-view')}}';
            air_report_id = elem.data('air-report-id');
            apotti_id = elem.data('apotti-id');
            data = {air_report_id,apotti_id};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $(".offcanvas-title").text('বিস্তারিত');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '30%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            })
        },

        airSendToRpu: function (elem) {
            let url = '{{route('audit.report.air.air-send-to-rpu')}}';
            air_id = elem.data('air-report-id');
            let data = {air_id};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_content');
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        toastr.success(response.data);
                        $('.air_sent_responsible_party').hide();
                    }
                }
            );
        },

        apottiFinalApproval: function (elem){
            air_report_id = elem.data('air-report-id');
            apotti_id = elem.data('apotti-id');
            final_status = elem.data('final-approval-status');
            data = {air_report_id,apotti_id,final_status};
            let url = '{{route('audit.report.air.qac.apotti-final-approval-status')}}';
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    toastr.success('সফলভাবে সংরক্ষণ করা হয়েছে');
                    $('#btn_filter').click();
                    $('#kt_quick_panel_close').click();
                }
            });
        },

        createQacReport: function (elem) {
            qac_type = elem.data('qac-type');
            air_id = elem.data('air-report-id');
            // air_id = $('#preliminary_air_filter').val();

            let url = '{{route('audit.qac.create-qac-report')}}';
            let data = {air_id,qac_type};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $(".offcanvas-title").text('QAC-1 সভার কার্যবিবরণী');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '70%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            })
        },

        exportQacReport: function (elem) {
            url = '{{route('audit.qac.create-qac-report')}}';
            qac_type = elem.data('qac-type');
            air_id = elem.data('air-report-id');
            scope = elem.data('scope');
            $.ajax({
                type: 'POST',
                url: url,
                data: {qac_type,air_id,scope},
                xhrFields: {
                    responseType: 'blob'
                },

                success: function (response) {
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "qac_report.pdf";
                    link.click();
                },

                error: function (blob) {
                    toastr.error('Failed to generate PDF.')
                    console.log(blob);
                }

            });
        },

        selectCommittee: function (elem) {
            url = '{{route('audit.qac.select-qac-committee-form')}}';

            air_report_id = elem.data('air-report-id');
            qac_type = elem.data('qac-type');
            fiscal_year_id = $('#fiscal_year_id').val();

            data = {air_report_id,fiscal_year_id,qac_type};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $(".offcanvas-title").text('কমিটি বাছাই');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '40%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            })
        },
    };
</script>
