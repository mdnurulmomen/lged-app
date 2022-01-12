<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-end mt-4">
            @if($air_status == 'approved')
                <button onclick="" title="Send To Rpu"
                        class="ml-2 btn btn-warning btn-sm btn-bold btn-square">
                    <i class="fad fa-share-square"></i> Send To Rpu
                </button>
            @else
                <button onclick="Report_AIR_Details_Container.loadApprovalAuthority()"
                        title="Send For Approval"
                        class="ml-2 btn btn-primary btn-sm btn-bold btn-square">
                    <i class="fad fa-share-square"></i> Send For Approval
                </button>
            @endif
        </div>
    </div>
</div>

<div id="writing-screen-wrapper" style="font-family:solaimanlipipdf,serif !important;">
    {{--<div class="pdf-screen bangla-font" style="height: 100%">
        {!! $cover['content'] !!}
    </div>--}}

    <div class="pdf-screen bangla-font" style="height: 100%">
        @foreach(json_decode($air_descriptions,true) as $report)
            <div class="plan_content bangla-font">
                {!! $report['content'] !!}
            </div>
        @endforeach
    </div>
</div>

<script>
    var Report_AIR_Details_Container = {
        loadApprovalAuthority: function (element) {
            url = '{{route('audit.report.air.get-approval-authority')}}';
            air_report_id = '{{$air_report_id}}';
            data = {air_report_id};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('অনুমোদনকারী বাছাই করুন');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '40%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },
    }
</script>

