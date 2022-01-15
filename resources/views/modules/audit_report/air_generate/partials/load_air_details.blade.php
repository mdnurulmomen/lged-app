<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-end mt-4">

            @if($air_status != 'approved')
                @if($latest_receiver_designation_id == 0 || $latest_receiver_designation_id == $current_designation_id)
                    <button onclick="Report_AIR_Details_Container.loadApprovalAuthority()"
                            title="প্রাপক বাছাই করুন"
                            class="ml-2 btn btn-primary btn-sm btn-bold btn-square">
                        <i class="fad fa-share-square"></i> প্রাপক বাছাই করুন
                    </button>

                    <button data-air-report-id="{{$air_report_id}}"
                            onclick="AIR_Container.loadAIREdit($(this))" title="সম্পাদন করুন"
                            class="ml-2 btn btn-warning btn-sm btn-bold btn-square">
                        <i class="fad fa-edit"></i> সম্পাদনা করুন
                    </button>
                @endif
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
        loadApprovalAuthority: function () {
            url = '{{route('audit.report.air.get-approval-authority')}}';
            air_type = '{{$air_type}}';
            air_report_id = '{{$air_report_id}}';
            data = {air_report_id,air_type};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('');
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

