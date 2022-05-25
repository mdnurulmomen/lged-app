<style>
    .card-img-top {
        width: 100%;
        border-top-left-radius: calc(.25rem - 1px);
        border-top-right-radius: calc(.25rem - 1px);
    }
</style>
<div class="row mt-3">
    @forelse($apotti_report_list as $apotti_report)
    <div class="col-md-3">
        <div class="card sna-card-border">
            <a href="https://audit-archive.tappware.com/report-view/1560">
                <img class="card-img-top" style="height: 350px" src="{{$apotti_report['cover_page_path'].'/'.$apotti_report['cover_page']}}">
            </a>
            <h5>{{$apotti_report['audit_report_name']}}</h5>
            <div class="row">
                {{--<div class="col-md-1 mr-5">
                    <a href="javascript:;" data-report-id="{{$apotti_report['id']}}"
                       onclick="Archive_Apotti_Report_Container.loadApottiDetails($(this))" class="btn btn-sm btn-primary">
                        <i class="fa fa-eye"></i>
                    </a>
                </div>--}}

                <div class="col-md-6">
                    <a href="javascript:;" data-report-id="{{$apotti_report['id']}}"
                       onclick="Archive_Apotti_Report_Container.load_apotti_upload($(this))"
                       class="btn btn-sm btn-primary">
                        <i class="fa fa-plus-circle"></i>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="javascript:;" data-report-id="{{$apotti_report['id']}}"
                       onclick="Archive_Apotti_Report_Container.apotti_sync($(this))"
                       class="btn btn-sm btn-primary float-right">
                        <i class="fa fa-sync"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    @endforelse
</div>




