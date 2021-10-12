<x-title-wrapper>Office Order List</x-title-wrapper>

<form>
    <div class="form-row">
        <div class="col-md-2 d-md-flex align-items-md-center">
            <p class="mb-0">Fiscal Year</p>
        </div>
        <div class="col-md-4 ">
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

<div class="col-lg-12 p-0 mt-3">
    <div class="load-office-orders"></div>

    <div class="load-office-order-modal"></div>
</div>


<script>
    $(function () {
        Office_Order_Container.loadOfficeOrderList();
    });

    $('#select_fiscal_year_annual_plan').change(function () {
        Office_Order_Container.loadOfficeOrderList();
    });

    var Office_Order_Container = {
        loadOfficeOrderList: function (page = 1, per_page = 200) {
            let fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
            if (fiscal_year_id) {
                let url = '{{route('audit.plan.audit.office-orders.load-office-order-list')}}';
                let data = {fiscal_year_id, page, per_page};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data);
                    } else {
                        $('.load-office-orders').html(response);
                    }
                });
            }
            else {
                $('.load-office-orders').html('');
            }
        },

        loadOfficeOrderGenerateModal: function (element) {
            url = '{{route('audit.plan.audit.office-orders.load-office-order-generate-modal')}}';
            audit_plan_id = element.data('audit-plan-id');
            annual_plan_id = element.data('annual-plan-id');

            data = {audit_plan_id,annual_plan_id};

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".load-office-order-modal").html(response)
                    $('#officeOrderGenerateModal').modal('show');
                }
            });
        },

        generateOfficeOrder: function (elem) {
            url = '{{route('audit.plan.audit.office-orders.generate-office-order')}}';
            data = $('#office_order_generate_form').serialize();
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {
                    toastr.success('Successfully Office Order Generated!');
                    $("#officeOrderGenerateModal").hide();
                    $('.ki-close').click();
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

        showOfficeOrder: function (elem) {
            url = '{{route('audit.plan.audit.office-orders.show-office-order')}}';
            audit_plan_id = elem.data('audit-plan-id');
            annual_plan_id = elem.data('annual-plan-id');
            is_print = 0;
            data = {audit_plan_id,annual_plan_id,is_print}
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
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

        saveOfficeOrderApprovalAuthority: function () {
            url = '{{route('audit.plan.audit.office-orders.store-office-order-approval-authority')}}';
            data = $('#approval_authority_form').serialize();
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {
                    toastr.success('সফলভাবে প্রেরণ করা হয়েছে');
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
            url = '{{route('audit.plan.audit.office-orders.approve-office-order')}}';
            fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
            ap_office_order_id = element.data('ap-office-order-id');
            audit_plan_id = element.data('audit-plan-id');
            annual_plan_id = element.data('annual-plan-id');
            approved_status = 'approved';
            data = {ap_office_order_id,audit_plan_id,annual_plan_id,approved_status,fiscal_year_id};

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
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
        },
    }
</script>

