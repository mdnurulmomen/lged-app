<x-title-wrapper>Office Order List</x-title-wrapper>

<div class="col-lg-12 p-0 mt-3">
    <div class="load-office-orders"></div>

    <div class="load-office-order-modal"></div>
</div>


<script>


    $(function() {
        Office_Order_Container.loadOfficeOrderList();
    });

    var Office_Order_Container = {
        loadOfficeOrderList: function () {
            let url = '{{route('audit.plan.audit.office-orders.load-office-order-list')}}';
            let data = {};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('.load-office-orders').html(response);
                }
            });
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
                    location.reload();
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

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
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
                    toastr.success('Successfully Saved!');
                    location.reload();
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

    }
</script>

