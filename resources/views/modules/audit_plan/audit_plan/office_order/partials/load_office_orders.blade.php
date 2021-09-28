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
                    <div class="action-group d-flex justify-content-end">
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
                                    data-audit-plan-id="{{$audit_plan['id']}}" data-annual-plan-id="{{$audit_plan['annual_plan_id']}}"
                                    onclick="Office_Order_Container.showOfficeOrder($(this))" type="button">
                                <i class="fad fa-eye"></i>
                            </button>
                        @endif

                        @if($audit_plan['office_order'] != null)
                        <button class="mr-2 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                data-ap-office-order-id="{{$audit_plan['office_order']['id']}}"
                                data-audit-plan-id="{{$audit_plan['id']}}"
                                data-annual-plan-id="{{$audit_plan['annual_plan_id']}}"
                                onclick="Office_Order_Container.loadOfficeOrderApprovalAuthority($(this))"
                                type="button">
                            <i class="fad fa-share-square"></i>
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
