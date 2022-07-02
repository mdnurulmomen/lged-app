<style>
    .card-img-top {
        width: 100%;
        border-top-left-radius: calc(.25rem - 1px);
        border-top-right-radius: calc(.25rem - 1px);
    }
</style>
<div class="row ml-5">
    <span><p class="float-left pr-5 font-size-h4-sm">মোট অডিট রিপোর্ট : {{enTobn(count($report_list['airList']))}}</p>  <p class="float-left font-size-h4-sm">মোট আপত্তি : {{enTobn($report_list['totalApottiCount'])}}</p></span>
</div>
<div class="row mt-3">
    @forelse($report_list['airList'] as $report)
        <div class="col-md-3 mb-2">
            <div class="card sna-card-border">
                <a href="javascript:;">
                    @if($report['has_report_attachments'] == 1)
                        <img class="card-img-top" style="height: 250px" src="{{$report['reported_apotti_cover_page']?rtrim(config('amms_bee_routes.file_url'),'/').$report['reported_apotti_cover_page']['attachment_path'].$report['reported_apotti_cover_page']['cover_page_name']:''}}">
                    @endif
                </a>
                <h5>{{$report['report_name']}}</h5>
                <div class="row">
                    <div class="col-md-3 mr-5">
                        <a href="javascript:;"
                           data-report-id="{{$report['id']}}"
                           data-report-name="{{$report['report_name']}}"
                           data-directorate-id="{{$data['directorate_id']}}"
                           onclick="loadFinalReportDetails($(this))" class="btn btn-sm btn-primary">
                            <i class="fa fa-eye"></i>
                        </a>
                    </div>

                    <div class="col-md-6">
                        <b> আপত্তি : {{($report['report_apotti_map_count'])}}</b>
                    </div>

                </div>
            </div>
        </div>
    @empty
    @endforelse
</div>

<script>
    function loadFinalReportDetails(elem){
        air_id = elem.data('report-id');
        office_id = elem.data('directorate-id');
        report_name = elem.data('report-name');
        let url = '{{route('audit.final-report.get-final-report-details')}}';
        let data = {air_id,office_id,report_name};

        KTApp.block('#kt_wrapper', {
            opacity: 0.1,
            state: 'primary' // a bootstrap color
        });

        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
            KTApp.unblock('#kt_wrapper');
            if (response.status === 'error') {
                toastr.warning(response.data);
            } else {
                $('#kt_content').html(response);
            }
        });
    }
</script>




