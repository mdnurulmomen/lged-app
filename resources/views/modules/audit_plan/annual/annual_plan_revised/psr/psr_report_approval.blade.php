<x-title-wrapper>PSR List</x-title-wrapper>
<div class="card sna-card-border mt-3">
    <form>
        <div class="form-row">
            <div class="col-md-4">
                <label>অধিদপ্তর :</label>
                <select class="form-select select-select2" id="directorate_filter">
                    <option value="">অধিদপ্তর বাছাই করুন</option>
                    @foreach($directorates as $directorate)
                        <option value="{{$directorate['office_id']}}">{{$directorate['office_name_bn']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 ">
                <label>অর্থবছর :</label>
                <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_annual_plan">
                    <option value="">অর্থবছর বাছাই করুন</option>
                    @foreach($fiscal_years as $fiscal_year)
                        <option
                            value="{{$fiscal_year['id']}}" {{$current_fiscal_year == $fiscal_year['id']?'selected':''}}>{{$fiscal_year['description']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>
</div>

<div class="card sna-card-border mt-3">
    <div id="load_psr_approval_list">
        <div class="alert alert-custom alert-light-primary fade show mb-5" role="alert">
            <div class="alert-icon">
                <i class="flaticon-warning"></i>
            </div>
            <div class="alert-text">অধিদপ্তর বাছাই করুন</div>
        </div>
    </div>
</div>

@include('scripts.script_generic')
@include('modules.audit_plan.annual.annual_plan_revised.psr.partials.approve_psr_common_script')
<script>

    $('#select_fiscal_year_annual_plan,#directorate_filter').change(function () {
        Approve_Psr_Reprot_List_Container.loadPsrReportList();
    });

    var Approve_Psr_Reprot_List_Container = {
        loadPsrReportList: function () {
            office_id = $('#directorate_filter').val();
            fiscal_year_id = $('#select_fiscal_year_annual_plan').val();

            let url = '{{route('audit.plan.annual.psr.get-psr-report-approval-list')}}';
            let data = {fiscal_year_id, office_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#load_psr_approval_list').html(response);
                }
            });
        },

        printAnnualPlan: function (elem) {
            url = '{{route('audit.plan.annual.plan.revised.book')}}';
            office_id = elem.data('office-id');
            fiscal_year_id = elem.data('fiscal-year-id');
            annual_plan_main_id = elem.data('annual-plan-main-id');
            has_update_request = elem.data('has-update-request');
            activity_type = elem.data('activity-type');

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                message: 'ডাউনলোড হচ্ছে অপেক্ষা করুন...',
                state: 'primary' // a bootstrap color
            });

            $.ajax({
                type: 'POST',
                url: url,
                data: {office_id,fiscal_year_id,annual_plan_main_id,activity_type,has_update_request},
                xhrFields: {
                    responseType: 'blob'
                },

                success: function (response) {
                    KTApp.unblock("#kt_wrapper");
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "annual_plan.pdf";
                    link.click();
                },

                error: function (blob) {
                    toastr.error('Failed to generate PDF.')
                    console.log(blob);
                }

            });
        },

        previewPSRPlan: function (elem) {
            scope_editable = 0;
            psr_plan_id = elem.data('psr-plan-id');
            office_id = $('#directorate_filter').val();

            data = {scope_editable,psr_plan_id,office_id};
            url = '{{route('audit.plan.annual.psr.preview')}}';

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                message: 'লোড হচ্ছে অপেক্ষা করুন',
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');

                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('প্ল্যান');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '90%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            })
        }
    };
</script>
