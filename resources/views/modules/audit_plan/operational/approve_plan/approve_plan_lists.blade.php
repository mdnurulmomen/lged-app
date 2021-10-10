<x-title-wrapper>Approve Plan List</x-title-wrapper>
<form class="pl-4 pt-4">
    <div class="form-row">
        <div class="col-md-4 ">
            <label>Fiscal Year</label>
            <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_annual_plan">
                <option value="">Choose Fiscal Year</option>
                @foreach($fiscal_years as $fiscal_year)
                    <option
                        value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['start']?'selected':''}}>{{$fiscal_year['description']}}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>

<div class="px-3 py-3" id="load_directorate_lists">

</div>

@include('scripts.script_generic')
<script>
    var Approve_Plan_List_Container = {
        loadDirectorateList: function () {
            fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
            fiscal_year = $('#select_fiscal_year_annual_plan').select2('data')[0].text;
            if (fiscal_year_id) {
                let url = '{{route('audit.plan.operational.plan.load-directorate-list')}}';
                calendar_id = 1;
                let data = {fiscal_year_id, fiscal_year,calendar_id};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data)
                    } else {
                        $('#load_directorate_lists').html(response);
                    }
                })
            } else {
                $('#load_directorate_lists').html('');
            }
        },

        viewDirectorateWiseAnnualPlan:function (element){
            url = '{{route('audit.plan.operational.plan.load-directorate-wise-annual-plan')}}';
            fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
            office_id = element.data('office-id');
            data = {fiscal_year_id,office_id};

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

        loadAnnualPlanApprovalForm: function (element) {
            url = '{{route('audit.plan.operational.plan.load-annual-plan-approval-form')}}';
            office_name_bn = element.data('office-name-bn');
            data = {};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text(office_name_bn);
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '40%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });

            loadAnnualPlanUrl = '{{route('audit.plan.operational.plan.load-directorate-wise-annual-plan')}}'
            fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
            office_id = element.data('office-id');
            dataLoadAnnualPlan = {fiscal_year_id,office_id};

            ajaxCallAsyncCallbackAPI(loadAnnualPlanUrl, dataLoadAnnualPlan, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".annual-plan-view").html(response);
                }
            });
        },

        sendAnnualPlanReceiverToSender: function () {
            url = '{{route('audit.plan.operational.plan.send-annual-plan-receiver-to-sender')}}';
            data = $('#approval_form').serialize();
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {
                    toastr.success('অনুমোদনের জন্য প্রেরিত হয়েছে');
                    $("#kt_quick_panel_close").click();
                    //Office_Order_Container.loadOfficeOrderList();
                }
                else {
                    if (response.statusCode === '422') {
                        var errors = response.msg;
                        $.each(errors, function (k, v) {
                            if (v !== '') {
                                toastr.error(v);
                            }
                        });
                    }
                    else {
                        toastr.error(response.data.message);
                    }
                }
            })
        },
    };

    $(function () {
        Approve_Plan_List_Container.loadDirectorateList();
    });

    $('#select_fiscal_year_annual_plan').change(function () {
        Approve_Plan_List_Container.loadDirectorateList();
    });
</script>
