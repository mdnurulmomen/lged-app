<style>
    .card-img-top {
        width: 100%;
        border-top-left-radius: calc(.25rem - 1px);
        border-top-right-radius: calc(.25rem - 1px);
    }
</style>
<div class="row mt-3">
    @forelse($report_list as $report)
        <div class="col-md-3 mb-2">
            <div class="card sna-card-border">
                <a href="javascript:;">
                    <img class="card-img-top" style="height: 350px" src="">
                </a>
                <h5>{{$report['report_name']}}</h5>
                <div class="row">
                    <div class="col-md-12 mr-5">
                        <a href="javascript:;"
                           data-report-id="{{$report['id']}}"
                           data-report-name="{{$report['report_name']}}"
                           data-directorate-id="{{$data['directorate_id']}}"
                           onclick="loadFinalReportDetails($(this))" class="btn btn-sm btn-primary">
                            <i class="fa fa-eye"></i>
                        </a>
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
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.warning(response.data);
                } else {
                    $('#kt_content').html(response);
                }
            }
        );
    }
</script>




