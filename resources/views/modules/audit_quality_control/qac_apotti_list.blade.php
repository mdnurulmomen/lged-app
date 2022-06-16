<div class="table-search-header-wrapper mb-4 pt-3 pb-3 shadow-sm">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-md-12">

                <input type="hidden" id="entity_id" value="">

                <a data-qac-type="{{$qac_type}}"
                   style="color: black"
                   data-parent-air-id="{{$parent_air_id}}"
                   data-scope="{{$scope}}"
                   data-air-report-id="{{$responseData['rAirInfo']['r_air_child']['id']}}"
                   onclick="QAC_Apotti_List_Container.loadAIREdit($(this))"
                   class="tap-button mr-1 btn btn-sm {{$responseData['rAirInfo']['r_air_child']['status']=='approved'?'btn-outline-primary':'btn-outline-danger'}} btn-square"
                   href="javascript:;">
                    <i style="color: black" class="far fa-book"></i> {{$qac_type == 'qac-1'?'এআইআর':'রিপোর্ট'}} বিস্তারিত
                    @if($responseData['rAirInfo']['r_air_child']['status']=='approved')
                        <span style="color: black">(অনুমোদিত)</span>
                    @else
                        <span style="color: black">(অননুমোদিত)</span>
                    @endif
                </a>

                @if($qac_type != 'cqat')
                    @if(!$responseData['rAirInfo']['qac_committee'])
                        <a style="color: black" data-qac-type="{{$qac_type}}"
                           data-air-report-id="{{$responseData['rAirInfo']['id']}}"
                           onclick="QAC_Apotti_List_Container.selectCommittee($(this))"
                           class="tap-button mr-1 btn btn-sm btn-outline-primary btn-square" href="javascript:;">
                            <i style="color: black" class="far fa-users"></i> কমিটি বাছাই করুন
                        </a>
                    @endif
                @endif

                @if($responseData['rAirInfo']['qac_committee'])
                    <a style="color: black" data-qac-type="{{$qac_type}}"
                       data-air-report-id="{{$responseData['rAirInfo']['id']}}"
                       onclick="QAC_Apotti_List_Container.createQacReport($(this))"
                       class="tap-button mr-1 btn btn-sm btn-outline-primary btn-square" href="javascript:;">
                        <i style="color: black" class="fad fa-file" aria-hidden="true"></i>
                        @if($qac_type == 'qac-1')
                            কিউএসি-১ রিপোর্ট
                        @elseif($qac_type == 'qac-2')
                            কিউএসি-২ রিপোর্ট
                        @elseif($qac_type == 'cqat')
                            সিকিউএটি রিপোর্ট
                        @endif
                    </a>
                @endif

                @if($qac_type == 'qac-1' && $responseData['rAirInfo']['r_air_child']['status']=='approved')
                    @if($responseData['rAirInfo']['r_air_child']['is_sent']== 0)
                        <button style="color: black" data-air-report-id="{{$responseData['rAirInfo']['r_air_child']['id']}}"
                                data-entity-ids="{{is_array($entity_ids) ? implode(',',$entity_ids) : $entity_ids}}"
                                data-air-report-name="{{$responseData['rAirInfo']['report_name']}}"
                                class="tap-button btn btn-sm btn-square btn-outline-primary btn-hover-primary air_sent_responsible_party"
                                onclick="QAC_Apotti_List_Container.airSendToRpu($(this))">
                            <i style="color: black" class="fad fa-paper-plane"></i> রেস্পন্সিবল পার্টি বরাবর প্রেরণ করুন
                        </button>
                    @elseif($responseData['rAirInfo']['r_air_child']['is_received']== null)
                        <span class="badge tap-badge-warning">
                          রেস্পন্সিবল পার্টি বরাবর প্রেরণ করা হয়েছে
                        </span>
                    @elseif($responseData['rAirInfo']['r_air_child']['is_received']== 1)
                        <span class="badge tap-badge-success">
                          Received
                        </span>
                    @endif
                @endif

                @if($responseData['rAirInfo']['r_air_child']['status']!='approved')
                    <span class="text-warning ml-2 mt-2">
                        {{empty($responseData['rAirInfo']['r_air_child']['latest_r_air_movement'])?'':'('.$responseData['rAirInfo']['r_air_child']['latest_r_air_movement']['receiver_employee_designation_bn'].' এর কাছে প্রেরণ করা হয়েছে)'}}
                    </span>
                @endif

                @if($qac_type == 'cqat')
                    @if($responseData['rAirInfo']['r_air_child']['status'] != 'approved')
                        <a data-qac-type="{{$qac_type}}"
                           data-air-report-id="{{$responseData['rAirInfo']['r_air_child']['id']}}"
                           onclick="QAC_Apotti_List_Container.ApprovedCqatForm($(this))"
                           class="mr-1 btn btn-sm btn-outline-primary btn-square" href="javascript:;">
                            সিকিউএটি সম্পন্ন করুন
                        </a>
                    @endif
                @endif
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

        <th width="25%" class="text-left">
            শিরোনাম
        </th>

        <th width="10%" class="text-right">
            জড়িত অর্থ (টাকা)
        </th>

        <th width="10%" class="text-left">
            {{$qac_type == 'qac-1' ? 'ক্যাটাগরি' : 'কিউএসি ১ এর সিদ্ধান্ত'}}
        </th>

        @if($qac_type == 'qac-2' || $qac_type == 'cqat')
            <th width="10%" class="text-left">
                কিউএসি ২ এর সিদ্ধান্ত
            </th>
        @endif

        @if($qac_type == 'cqat')
            <th width="10%" class="text-left">
                সিকিউএটি এর সিদ্ধান্ত
            </th>
        @endif

        <th width="25%" class="text-left">
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
                <span>{{enTobn(currency_format($apotti['apotti_map_data']['total_jorito_ortho_poriman']))}}/-</span>
            </td>
            <td class="text-left">

                @foreach($apotti['apotti_map_data']['apotti_status'] as $apotti_status)
                    @if($apotti_status['qac_type'] == 'qac-1')
                        @if($apotti_status['apotti_type'] == 'draft')
                            রিপোর্ট ভুক্তির জন্য প্রস্তাবকৃত এসএফআই
                        @elseif($apotti_status['apotti_type'] == 'approved')
                            রিপোর্ট ভুক্তির জন্য চূড়ান্তকৃত এসএফআই
                        @elseif($apotti_status['apotti_type'] == 'sfi')
                            এসএফআই
                        @elseif($apotti_status['apotti_type'] == 'non-sfi')
                            নন-এসএফআই
                        @elseif($apotti_status['apotti_type'] == 'reject')
                            প্রত্যাহার
                        @endif
                    @endif
                @endforeach
            </td>
            @if($qac_type == 'qac-2' || $qac_type == 'cqat')
                <td class="text-left">
                    @foreach($apotti['apotti_map_data']['apotti_status'] as $apotti_status)
                        @if($apotti_status['qac_type'] == 'qac-2')
                            @if($apotti_status['apotti_type'] == 'draft')
                                রিপোর্ট ভুক্তির জন্য প্রস্তাবকৃত এসএফআই
                            @elseif($apotti_status['apotti_type'] == 'approved')
                                রিপোর্ট ভুক্তির জন্য চূড়ান্তকৃত এসএফআই
                            @elseif($apotti_status['apotti_type'] == 'sfi')
                                এসএফআই
                            @elseif($apotti_status['apotti_type'] == 'non-sfi')
                                নন-এসএফআই
                            @elseif($apotti_status['apotti_type'] == 'reject')
                                প্রত্যাহার
                            @endif
                        @endif
                    @endforeach
                </td>
            @endif

            @if($qac_type == 'cqat')
                <td class="text-left">
                    @foreach($apotti['apotti_map_data']['apotti_status'] as $apotti_status)
                        @if($apotti_status['qac_type'] == 'cqat')
                            @if($apotti_status['apotti_type'] == 'draft')
                                রিপোর্ট ভুক্তির জন্য প্রস্তাবকৃত এসএফআই
                            @elseif($apotti_status['apotti_type'] == 'approved')
                                রিপোর্ট ভুক্তির জন্য গৃহীত এসএফআই
                            @elseif($apotti_status['apotti_type'] == 'sfi')
                                এসএফআই
                            @elseif($apotti_status['apotti_type'] == 'non-sfi')
                                নন-এসএফআই
                            @elseif($apotti_status['apotti_type'] == 'reject')
                                প্রত্যাহার
                            @endif
                        @endif
                    @endforeach
                </td>
            @endif

            <td class="text-left">
                <button class="mr-1 btn btn-sm btn-primary btn-square" title="বিস্তারিত দেখুন"
                        data-apotti-id="{{$apotti['apotti_map_data']['id']}}"
                        onclick="Qac_Container.showApotti($(this))">
                    <i class="fad fa-eye"></i> বিস্তারিত
                </button>

                @if($responseData['rAirInfo']['r_air_child']['status'] != 'approved')
                    @if($qac_type == 'cqat')
                        @if($apotti['apotti_map_data']['apotti_type'] != 'approved')
                            <button type="button" class="ml-1 btn btn-sm btn-primary btn-square"
                                    title="গৃহীত"
                                    data-air-report-id="{{$responseData['rAirInfo']['r_air_child']['id']}}"
                                    data-apotti-id="{{$apotti['apotti_map_data']['id']}}"
                                    data-final-approval-status="approved"
                                    onclick="QAC_Apotti_List_Container.apottiFinalApproval($(this))">
                                <i class="fa fa-arrow-down-to-square"></i> গৃহীত করুন
                            </button>
                        @endif
                    @else
                        @if(empty($responseData['rAirInfo']['r_air_child']['latest_r_air_movement']) || $responseData['rAirInfo']['r_air_child']['latest_r_air_movement']['receiver_employee_designation_id'] == $current_designation_id)
                            @if($responseData['rAirInfo']['qac_committee'])
                                <button class="btn btn-sm btn-primary btn-square mr-1" title="QAC-01"
                                        data-air-report-id="{{$responseData['rAirInfo']['r_air_child']['id']}}"
                                        data-is-delete="{{$apotti['apotti_map_data']['is_delete']}}"
                                        data-final-status="{{$apotti['apotti_map_data']['final_status']}}"
                                        data-apotti-id="{{$apotti['apotti_map_data']['id']}}"
                                        data-qac-type="{{$qac_type}}"
                                        onclick="Qac_Container.qacApotti($(this))">
                                    @if(!empty($apotti['apotti_map_data']['apotti_status']))
                                        @foreach($apotti['apotti_map_data']['apotti_status'] as $apotti_status)
                                            @if($apotti_status['qac_type'] == $qac_type)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        @endforeach
                                    @endif
                                    {{strtoupper($qac_type)}}
                                </button>
                            @endif
                        @endif
                    @endif
                @endif

                <button class="mr-1 btn btn-sm btn-primary btn-square" title="সম্পাদন করুন"
                        data-apotti-id="{{$apotti['apotti_map_data']['id']}}"
                        onclick="Qac_Container.editApotti($(this))">
                    <i class="fad fa-pencil"></i> সম্পাদন
                </button>
            </td>
        </tr>
    @empty
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td colspan="7" class="datatable-cell text-center"><span>Nothing Found</span></td>
        </tr>
    @endforelse
    </tbody>
</table>
<script>

    //select all checkboxes
    $("#selectAll").change(function () {
        var status = this.checked;
        $('.select-apotti').each(function () {
            if (!$(this).is(':disabled')) {
                this.checked = status;
            }
        });
    });

    $('.select-apotti').change(function () {
        if (this.checked == false) {
            $("#selectAll")[0].checked = false;
        }

        if ($('.select-apotti:checked').length == $('.select-apotti').length) {
            $("#selectAll")[0].checked = true;
            $("#selectAll")[0].addClass('checkbox-disabled');
        }
    });


    var QAC_Apotti_List_Container = {
        loadAIREdit: function (elem) {
            office_id = $('#directorate_filter').val();
            url = '{{route('audit.report.air.qac.edit-air-report')}}';
            qac_type = elem.data('qac-type');
            parent_air_id = elem.data('parent-air-id');
            air_report_id = elem.data('air-report-id');
            scope = elem.data('scope');
            data = {qac_type, parent_air_id, air_report_id, office_id, scope};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
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
            data = {air_report_id, apotti_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
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
            entity_ids = elem.data('entity-ids')
            report_name = elem.data('air-report-name');
            let data = {air_id, entity_ids, report_name};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    KTApp.unblock('#kt_wrapper');
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        toastr.success(response.data);
                        $('#btn_filter').click();
                        $('.air_sent_responsible_party').hide();
                    }
                }
            );
        },

        apottiFinalApproval: function (elem) {
            air_report_id = elem.data('air-report-id');
            apotti_id = elem.data('apotti-id');
            final_status = elem.data('final-approval-status');
            office_id = $('#directorate_filter').val();
            data = {air_report_id, apotti_id, final_status, office_id};
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
            let data = {air_id, qac_type};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
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

        qacReportDate: function (elem) {
            air_id = elem.data('air-report-id');
            qac_type = elem.data('qac-type');
            office_id = $('#directorate_filter').val();
            qac_report_date = $('#report_date').val();
            data = {air_id, office_id, qac_report_date, qac_type};
            let url = '{{route('audit.report.air.qac.qac-report-date')}}';
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

        exportQacReport: function (elem) {
            url = '{{route('audit.qac.create-qac-report')}}';
            qac_type = elem.data('qac-type');
            air_id = elem.data('air-report-id');
            scope = elem.data('scope');
            $.ajax({
                type: 'POST',
                url: url,
                data: {qac_type, air_id, scope},
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

            data = {air_report_id, fiscal_year_id, qac_type};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
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

        ApprovedCqatForm: function (elem) {

            air_report_id = elem.data('air-report-id');
            qac_type = elem.data('qac-type');

            $(".offcanvas-title").text('সিকিউএটি সম্পন্ন করুন');

            quick_panel = $("#kt_quick_panel");
            quick_panel.addClass('offcanvas-on');
            quick_panel.css('opacity', 1);
            quick_panel.css('width', '40%');
            quick_panel.removeClass('d-none');
            $("html").addClass("side-panel-overlay");

            data = {air_report_id, qac_type}

            let url = '{{route('audit.qac.cqat-done-form')}}';

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        ApprovedCqat: function (elem) {

            data = $('#cqat_done_form').serializeArray();

            office_id = $('#directorate_filter').val();

            data.push({name: "office_id", value: office_id});
            let url = '{{route('audit.qac.cqat-done-submit')}}';

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    toastr.success(response.data);
                    $('#kt_quick_panel_close').click();
                    $('#btn_filter').click();
                }
            });
        },
    };
</script>
