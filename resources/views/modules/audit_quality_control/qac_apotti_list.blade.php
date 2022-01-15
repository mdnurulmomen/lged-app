<div class="table-search-header-wrapper mb-4 pt-3 pb-3 shadow-sm">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-md-6 mt-2">
                <span class="text-warning ">
                        {{empty($responseData['rAirInfo']['r_air_child']['latest_r_air_movement'])?'':$responseData['rAirInfo']['r_air_child']['latest_r_air_movement']['receiver_employee_name_bn'].' এর কাছে প্রেরণ করা হয়েছে'}}
                    </span>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-md-end">
                    <a data-qac-type="{{$qac_type}}"
                        data-air-report-id="{{$responseData['rAirInfo']['r_air_child']['id']}}"
                       onclick="QAC_Apotti_List_Container.loadAIREdit($(this))"
                       class="mr-1 btn btn-sm {{$responseData['rAirInfo']['r_air_child']['status']=='approved'?'btn-outline-primary':'btn-outline-danger'}} btn-square" href="javascript:;">
                        <i class="far fa-book"></i> এআইআর
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<table class="table table-hover" width="100%">
    <thead class="thead-light">
    <tr class="bg-hover-warning">
        <th width="10%" class="text-center">
            অনুচ্ছেদ নং
        </th>

        <th width="40%" class="text-left">
            আপত্তির শিরোনাম
        </th>

        <th width="15%" class="text-right">
            জড়িত অর্থ (টাকা)
        </th>

        <th width="10%" class="text-left">
            আপত্তির ধরন
        </th>

        <th width="30%" class="text-left">
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
                @if($apotti['is_delete'] == 1)
                    প্রত্যাহার
                @else
                    @php $apotti_type = ''; @endphp
                    @foreach($apotti['apotti_map_data']['apotti_status'] as $apotti_status)
                        @if($apotti_status['qac_type'] == $qac_type)
                            @if($apotti_status['apotti_type'] == 'sfi')
                                @php $apotti_type = 'এসএফআই'; @endphp
                            @elseif($apotti_status['apotti_type'] == 'non-sfi')
                                @php $apotti_type = 'নন-এসএফআই'; @endphp
                            @else
                                @php $apotti_type = $apotti_status['apotti_type']; @endphp
                            @endif
                        @endif
                    @endforeach
                    {{$apotti_type}}
                @endif
            </td>
            <td class="text-left">
                <button class="mr-1 btn btn-sm btn-outline-primary btn-square" title="বিস্তারিত দেখুন"
                        data-apotti-id="{{$apotti['apotti_map_data']['id']}}"
                        onclick="Qac_Container.showApotti($(this))">
                    <i class="fad fa-eye"></i> বিস্তারিত
                </button>

                @if($responseData['rAirInfo']['r_air_child']['status'] != 'approved')
                    @if(empty($responseData['rAirInfo']['r_air_child']['latest_r_air_movement']) || $responseData['rAirInfo']['r_air_child']['latest_r_air_movement']['receiver_employee_designation_id'] == $current_designation_id)
                        <button class="btn btn-sm btn-outline-primary btn-square mr-1" title="QAC-01"
                                data-air-report-id="{{$responseData['rAirInfo']['r_air_child']['id']}}"
                                data-is-delete="{{$apotti['is_delete']}}"
                                data-apotti-id="{{$apotti['apotti_map_data']['id']}}"
                                data-qac-type="{{$qac_type}}"
                                onclick="Qac_Container.qacApotti($(this))">
                            {{strtoupper($qac_type)}}
                        </button>

                        <button class="mr-1 btn btn-sm btn-outline-warning btn-square" title="সম্পাদন করুন"
                                data-apotti-id="{{$apotti['apotti_map_data']['id']}}"
                                onclick="Qac_Container.editApotti($(this))">
                            <i class="fad fa-pencil"></i> সম্পাদন
                        </button>
                    @endif

                    {{--@if($apotti['is_delete'] == 1)
                        <button class="mr-1 btn btn-sm btn-outline-danger btn-square" title="মুছে ফেলুন"
                                data-air-report-id="{{$responseData['rAirInfo']['r_air_child']['id']}}"
                                data-apotti-id="{{$apotti['apotti_map_data']['id']}}"
                                data-is-delete="0"
                                onclick="QAC_Apotti_List_Container.softDeleteApotti($(this))">
                            <i class="fad fa-undo-alt"></i>
                        </button>
                    @else
                        <button class="mr-1 btn btn-sm btn-outline-danger btn-square" title="মুছে ফেলুন"
                                data-air-report-id="{{$responseData['rAirInfo']['r_air_child']['id']}}"
                                data-apotti-id="{{$apotti['apotti_map_data']['id']}}"
                                data-is-delete="1"
                                onclick="QAC_Apotti_List_Container.softDeleteApotti($(this))">
                            <i class="fad fa-trash"></i>
                        </button>
                    @endif--}}
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
    };
</script>
