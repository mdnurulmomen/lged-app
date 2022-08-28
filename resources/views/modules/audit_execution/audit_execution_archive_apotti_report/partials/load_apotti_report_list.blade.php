<style>
    .card-img-top {
        width: 100%;
        border-top-left-radius: calc(.25rem - 1px);
        border-top-right-radius: calc(.25rem - 1px);
    }
</style>
<div class="row mt-3">
    @forelse($apotti_report_list as $apotti_report)
    <div class="col-md-3 mb-2">
        <div class="card sna-card-border">
            <a href="javascript:;">
                <img class="card-img-top" style="height: 350px" src="{{$apotti_report['cover_page_path'].'/'.$apotti_report['cover_page']}}">
            </a>
            <h5>{{$apotti_report['audit_report_name']}}</h5>
            <div class="row">
                <div class="col-md-12 mr-5">
                    <a href="javascript:;"
                       data-report-id="{{$apotti_report['id']}}"
                       data-directorate-id="{{$apotti_report['directorate_id']}}"
                       onclick="Archive_Apotti_Report_Container.load_report_details($(this))" class="btn btn-sm btn-primary">
                        <i class="fa fa-eye"></i>
                    </a>

                    <a href="javascript:;" data-report-id="{{$apotti_report['id']}}"
                       onclick="Archive_Apotti_Report_Container.load_apotti_upload($(this))"
                       class="btn btn-sm btn-primary">
                        <i class="fa fa-plus-circle"></i>
                    </a>

                    <a href="javascript:;" data-report-id="{{$apotti_report['id']}}"
                       onclick="Archive_Apotti_Report_Container.apotti_sync($(this))"
                       class="btn btn-sm btn-primary">
                        <i class="fa fa-sync"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    @endforelse
</div>




