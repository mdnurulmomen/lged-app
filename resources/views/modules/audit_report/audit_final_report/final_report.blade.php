<x-title-wrapper>ফাইনাল রিপোর্ট তালিকা</x-title-wrapper>
<div class="card sna-card-border d-flex flex-wrap flex-row">
    <div class="col-xl-12">
        <div class="row mt-2 mb-2">
            <div class="col-md-3">
                <select class="form-select select-select2" id="directorate_filter">
                    @if(count($directorates) > 1)
                        <option value="all"> অধিদপ্তর বাছাই করুন</option>
                    @endif
                    @foreach($directorates as $directorate)
                        <option value="{{$directorate['office_id']}}">{{$directorate['office_name_bn']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select select-select2" id="fiscal_year_id">
                    @foreach($fiscal_years as $fiscal_year)
                        <option
                            value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['end']?'selected':''}}>{{enTobn($fiscal_year['description'])}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select select-select2" id="activity_id">
                    <option value="">অ্যাক্টিভিটি বাছাই করুন</option>
                </select>
            </div>

{{--            <div class="col-md-3">--}}
{{--                <select class="form-select select-select2" id="audit_plan_id">--}}
{{--                    <option value="">প্ল্যান বাছাই করুন</option>--}}
{{--                </select>--}}
{{--            </div>--}}
        </div>
    </div>
</div>

<div class="card sna-card-border mt-2">
    <div id="load_final_report">
        <div class="d-flex align-items-center">
            <div class="spinner-grow text-warning mr-3" role="status">
                <span class="sr-only"></span>
            </div>
            <div>
                loading.....
            </div>
        </div>
    </div>
</div>


<script>
    $(function () {
        fiscal_year_id = $('#fiscal_year_id').val();
        team_filter = $('#team_filter').val();
        cost_center_id = $('#cost_center_filter').val();
        //Qac_Container.loadApottiList(fiscal_year_id);
        Final_Report_Container.loadActivity(fiscal_year_id);

    });

    $('#activity_id').change(function (){
        Final_Report_Container.loadFinalReportList();
    });

    var Final_Report_Container = {
        loadActivity: function (fiscal_year_id) {
            let url = '{{route('audit.plan.operational.activity.select')}}';
            let data = {fiscal_year_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#activity_id').html(response);
                        $("#activity_id").val($("#activity_id option:eq(1)").val()).trigger('change');
                    }
                }
            );
        },

        loadActivityWiseAuditPlan: function (fiscal_year_id,activity_id) {
            office_id = $('#directorate_filter').val();
            let url = '{{route('audit.plan.operational.activity.audit-plan')}}';
            let data = {fiscal_year_id,activity_id,office_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#audit_plan_id').html(response);
                    }
                }
            );
        },

        loadFinalReportList: function (){
            office_id = $('#directorate_filter').val();
            activity_id = $('#activity_id').val();
            qac_type = 'cqat';
            let url = '{{route('audit.final-report.get-audit-final-report')}}';
            let data = {qac_type,activity_id,office_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    KTApp.unblock('#kt_wrapper');
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#load_final_report').html(response);
                    }
                }
            );
        },

        loadAIREdit: function (elem) {
            office_id = $('#directorate_filter').val();
            url = '{{route('audit.final-report.edit-audit-final-report')}}';
            qac_type = 'cqat';
            air_report_id = elem.data('air-report-id');
            data = {qac_type, air_report_id, office_id};

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

        loadFinalReportStatusUpdate: function (elem) {

            is_bg_press = elem.data('bg-press');
            is_printing_done = elem.data('printing-done');

            label = is_bg_press ? 'আপনি কি বিজি প্রেসে প্রেরণ করতে চান?' : 'আপনি কি মুদ্রণ সম্পন্ন করতে চান?';

                swal.fire({
                    title: label,
                    text: "",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'হ্যাঁ',
                    cancelButtonText: 'না'
                }).then(function(result) {
                    if (result.value) {

                        office_id = $('#directorate_filter').val();
                        url = '{{route('audit.final-report.final-report-status-update')}}';
                        air_id = elem.data('air-report-id');
                        data = {air_id, office_id, is_bg_press, is_printing_done};

                        KTApp.block('#kt_wrapper', {
                            opacity: 0.1,
                            state: 'primary' // a bootstrap color
                        });

                        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                            KTApp.unblock('#kt_wrapper');
                            if (response.status === 'error') {
                                toastr.error(response.data);
                            } else {
                                toastr.success(response.data);
                                Final_Report_Container.loadFinalReportList();
                            }
                        })
                    }
                });
        },
    };
</script>
