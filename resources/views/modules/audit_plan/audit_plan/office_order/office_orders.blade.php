<x-title-wrapper>Office Order</x-title-wrapper>
<!-- <div class="card sna-card-border mt-3" style="margin-bottom:15px;">
    <div class="row">
        <div class="col-md-3">
            <select class="form-select select-select2" id="directorate_filter">
                @if(count($directorates) > 1)
                    <option value="">অধিদপ্তর বাছাই করুন</option>
                @endif
                @foreach($directorates as $directorate)
                    <option value="{{$directorate['office_id']}}">{{$directorate['office_name_bn']}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_annual_plan">
                <option value="">--সিলেক্ট--</option>
                @foreach($fiscal_years as $fiscal_year)
                    <option
                        value="{{$fiscal_year['id']}}" {{$current_fiscal_year == $fiscal_year['id']?'selected':''}}>{{$fiscal_year['description']}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-control select-select2" id="activity_id">
                <option value="">--সিলেক্ট--</option>
            </select>
        </div>
    </div>
</div> -->

<div class="load-office-orders mb-15"></div>

<script>
    $(function () {
        Office_Order_Container.loadOfficeOrderList();
        // Office_Order_Container.loadFiscalYearWiseActivity();
    });

    // $('#select_fiscal_year_annual_plan').change(function () {
    //     Office_Order_Container.loadOfficeOrderList();
    //     Office_Order_Container.loadFiscalYearWiseActivity();
    // });

    // $('#activity_id,#directorate_filter').change(function () {
    //     Office_Order_Container.loadOfficeOrderList();
    // });

    var Office_Order_Container = {
        loadOfficeOrderList: function (page = 1, per_page = 500) {
            // let fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
            // let activity_id = $('#activity_id').val();
            // let office_id = $('#directorate_filter').val();

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            let url = '{{route('audit.plan.audit.office-orders.load-office-order-list')}}';
            let data = {page, per_page};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('.load-office-orders').html(response);
                }
            });
           
        },

        loadFiscalYearWiseActivity: function () {
            fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
            fiscal_year = $('#select_fiscal_year_annual_plan').select2('data')[0].text;

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            if (fiscal_year_id) {
                let url = '{{route('audit.plan.annual.plan.revised.fiscal-year-wise-activity-select')}}';
                let data = {fiscal_year_id, fiscal_year};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    KTApp.unblock('#kt_wrapper');
                    if (response.status === 'error') {
                        toastr.error(response.data)
                    } else {
                        $('#activity_id').html(response);
                        setActivityAnonymously();
                        // alert(activity_id);
                        // $('#activity_id').val(7);
                        // Annual_Plan_Container.loadAnnualPlanList();
                    }
                });
            } else {
                $('#activity_id').html('');
            }
        },

        loadOfficeOrderCreateForm: function (element) {
            url = '{{route('audit.plan.audit.office-orders.load-office-order-create')}}';
            audit_plan_id = element.data('audit-plan-id');
            annual_plan_id = element.data('annual-plan-id');

            data = {audit_plan_id,annual_plan_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error('No data found');
                }
                else {
                    $(".offcanvas-title").text('Office Order');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '60%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        showOfficeOrder: function (elem) {
            url = '{{route('audit.plan.audit.office-orders.show-office-order')}}';
            office_order_id = elem.data('office-order-id');
            audit_plan_id = elem.data('audit-plan-id');
            annual_plan_id = elem.data('annual-plan-id');
            office_id = $('#directorate_filter').val();
            data = {audit_plan_id,annual_plan_id,office_order_id,office_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#kt_content').html(response)
                }
            });
        },

        showUpdateOfficeOrder: function (elem) {
            url = '{{route('audit.plan.audit.office-orders.show-update-office-order')}}';
            office_order_id = elem.data('office-order-id');
            audit_plan_id = elem.data('audit-plan-id');
            annual_plan_id = elem.data('annual-plan-id');
            data = {office_order_id,audit_plan_id,annual_plan_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#kt_content').html(response)
                }
            });
        },

        loadOfficeOrderApprovalAuthority: function (element) {
            url = '{{route('audit.plan.audit.office-orders.load-office-order-approval-authority')}}';
            ap_office_order_id = element.data('ap-office-order-id');
            audit_plan_id = element.data('audit-plan-id');
            annual_plan_id = element.data('annual-plan-id');
            data = {ap_office_order_id,audit_plan_id,annual_plan_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
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

        saveOfficeOrderApprovalAuthority: function () {
            url = '{{route('audit.plan.audit.office-orders.store-office-order-approval-authority')}}';
            data = $('#approval_authority_form').serialize();

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'success') {
                    toastr.success('{{___('generic.sent_successfully')}}');
                    $('#kt_quick_panel_close').click();
                    Office_Order_Container.loadOfficeOrderList();
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

        approveOfficeOrder: function (element) {
            swal.fire({
                title: 'আপনি কি অনুমোদন করতে চান?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'হ্যাঁ',
                cancelButtonText: 'না'
            }).then(function(result) {
                if (result.value) {
                    url = '{{route('audit.plan.audit.office-orders.approve-office-order')}}';
                    fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
                    ap_office_order_id = element.data('ap-office-order-id');
                    audit_plan_id = element.data('audit-plan-id');
                    annual_plan_id = element.data('annual-plan-id');
                    has_office_order_update = element.data('has-office-order-update');
                    approved_status = 'approved';
                    data = {ap_office_order_id,audit_plan_id,annual_plan_id,approved_status,fiscal_year_id,has_office_order_update};
                    KTApp.block('#kt_wrapper', {
                        opacity: 0.1,
                        state: 'primary' // a bootstrap color
                    });
                    ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                        KTApp.unblock('#kt_wrapper');
                        if (response.status === 'success') {
                            toastr.success('Successfully Approved!');
                            Office_Order_Container.loadOfficeOrderList();
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
                    });
                }
            });
        },
    }
</script>

