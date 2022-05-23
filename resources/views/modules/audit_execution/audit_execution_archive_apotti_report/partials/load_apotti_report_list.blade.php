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
                <img class="card-img-top " style="height: 350px" src="https://audit-archive.tappware.com/storage/reports/DICFIA/110/Page0001.jpg">
            </a>
            <h5>{{$apotti_report['audit_report_name']}}</h5>
            <a href="javascript:;" data-apotti-id="{{$apotti_report['id']}}"
               onclick="Archive_Apotti_Report_Container.loadApottiDetails($(this))" class="btn btn-primary">
                <i class="fa fa-eye"></i>
            </a>
        </div>
    </div>
    @empty
    @endforelse
</div>




