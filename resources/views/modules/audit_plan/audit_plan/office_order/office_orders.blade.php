<x-title-wrapper>Office Order List</x-title-wrapper>

<div class="col-lg-12 p-0 mt-3">
    <!--begin::Table-->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-light">
            <tr>
                <th>মন্ত্রণালয়/বিভাগ</th>
                <th>নিয়ন্ত্রণকারী অফিস</th>
                <th>প্রতিষ্ঠানের ধরণ</th>
                <th>অডিট প্ল্যান</th>
                <th>অফিসার</th>
                <th width="8%">সম্পাদন</th>
            </tr>
            </thead>
            <tbody>
            @foreach($audit_plans['data'] as $audit_plan)
                <tr>
                    <td>{{$audit_plan['annual_plan']['ministry_name_bn']}}</td>
                    <td>{{$audit_plan['annual_plan']['controlling_office_bn']}}</td>
                    <td>{{$audit_plan['annual_plan']['office_type']}}</td>
                    <td>অডিট প্ল্যান {{$loop->iteration}}</td>
                    <td>{{$audit_plan['draft_officer_name_bn']}},
                        {{$audit_plan['draft_designation_name_bn']}},
                        {{$audit_plan['draft_unit_name_bn']}}
                    </td>
                    <td>
                        <div class="action-group d-flex justify-content-end action-group-wrapper">
                                <a href="javascript:;" type="button" class="mr-2 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn-archive list-btn-toggle"
                                   data-audit-plan-id="{{$audit_plan['id']}}"
                                   data-annual-plan-id="{{$audit_plan['annual_plan_id']}}"
                                   onclick="Office_Order_Container.loadOfficeOrderGenerateModal($(this))">
                                    @if($audit_plan['has_office_order'] == 0)
                                        <i class="fad fa-file-import"></i>
                                    @else
                                        <i class="fa fa-pencil"></i>
                                    @endif
                                </a>

                            @if($audit_plan['has_office_order'] == 1)
                                <button class="mr-2 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                        data-toggle="tooltip" data-placement="bottom" title="Edit" data-audit-plan-id="{{$audit_plan['id']}}" data-annual-plan-id="{{$audit_plan['annual_plan_id']}}" onclick="Office_Order_Container.showOfficeOrder($(this))" type="button">
                                    <i class="fad fa-eye"></i>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!--end::Table-->

    <div class="load-office-order-modal"></div>
</div>


<script>

    var Office_Order_Container = {
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
    }
</script>

