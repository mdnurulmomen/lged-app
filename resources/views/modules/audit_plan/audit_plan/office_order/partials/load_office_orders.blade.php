@if(!empty($audit_plans['data']))
    <div class="card sna-card-border mt-3" style="margin-bottom:30px;">
        {{--list view--}}
        <div>
            <ul class="list-group list-group-flush">
                @foreach($audit_plans['data'] as $audit_plan)
                    <li class="list-group-item py-2 border-bottom">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="pr-2 flex-fill cursor-pointer position-relative">
                                <div class="row d-md-flex flex-wrap align-items-start justify-content-md-between">
                                    <!--begin::Title-->
                                    <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3 col-md-8">
                                        <div class="font-weight-normal">
                                            <span class="mr-2 font-size-1-1">{{___('generic.list_views.plan.audit_plan.ministry_or_bivag')}}</span>
                                            <span class="font-size-14">
                                                    @php
                                                        $ministries = [];
                                                        foreach($audit_plan['annual_plan']['ap_entities'] as $ap_entities){
                                                            $ministry =  $ap_entities['ministry_name_bn'];
                                                            $ministries[] = $ministry;
                                                        }
                                                    @endphp
                                                {{implode(' , ', array_unique($ministries))}}
                                                </span>
                                        </div>
                                        <div class="d-flex align-items-center flex-wrap  font-size-1-2">
                                            <span class="mr-1">{{___('generic.list_views.plan.audit_plan.entity_or_institute')}}</span>
                                            <a href="javascript:void(0)" class="text-info font-size-h5">
                                                @php
                                                    $entities = [];
                                                    foreach($audit_plan['annual_plan']['ap_entities'] as $ap_entities){
                                                        $entity =  $ap_entities['entity_name_bn'];
                                                        $entities[] = $entity;
                                                    }
                                                @endphp
                                                {{implode(' , ', array_unique($entities))}}
                                            </a>
                                        </div>
                                        <div class="font-weight-normal">
                                            <span class="mr-2 font-size-1-1">{{___('generic.list_views.plan.audit_plan.institute_type')}}</span>
                                            <span class="font-size-14">
                                                    {{$audit_plan['annual_plan']['office_type']}}
                                                </span>
                                        </div>
                                        <div class="font-weight-normal">
                                            <span class="mr-2 font-size-1-1">প্ল্যানঃ</span>
                                            <span class="font-size-14">
                                                    অডিট প্ল্যান {{enTobn($audit_plan['id'])}}
                                                </span>
                                            <span class="label label-outline-danger label-pill label-inline">
                                                    {{$audit_plan['office_order'] != null? ucfirst($audit_plan['office_order']['approved_status']):'অফিস অর্ডার তৈরি হয়নি'}}
                                                </span>
                                        </div>
                                        <div class="font-weight-normal d-none predict-wrapper">
                                            <span class="predict-label text-success "></span>
                                        </div>

                                        <div class="d-flex mt-3">
                                            @if($audit_plan['office_order_log'])
                                                @foreach($audit_plan['office_order_log'] as $office_order_log)
                                                    <a href="{{ config('amms_bee_routes.file_url').$office_order_log['log_path'] }}"
                                                       title="অফিস আদেশ বিস্তারিত দেখুন"
                                                       class="badge-square rounded-0 badge d-flex align-items-center
                                                       alert-success font-weight-normal mr-1 border decision">
                                                        <i class="fa fa-download mr-2 text-dark-100"></i>
                                                        অফিস আদেশ ({{enTobn($office_order_log['memorandum_no'])}})
                                                    </a>
                                                @endforeach
                                            @endif

                                            @if($audit_plan['has_office_order'] == 1)
                                                <button
                                                    class="mr-1 btn btn-sm btn-details" title="বিস্তারিত দেখুন"
                                                    data-office-order-id="{{$audit_plan['office_order']['id']}}"
                                                    data-audit-plan-id="{{$audit_plan['id']}}"
                                                    data-annual-plan-id="{{$audit_plan['annual_plan_id']}}"
                                                    onclick="Office_Order_Container.showOfficeOrder($(this))" type="button">
                                                    <i style="color: white" class="fad fa-eye"></i>
                                                    {{$audit_plan['office_order']['approved_status'] == 'approved' ? 'অনুমোদিত' : ''}}

                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Info-->
                                    <div class="d-flex align-items-center justify-content-md-end py-lg-0 py-2 col-md-4">
                                        <div class="d-block">
                                            <div class="mt-5 d-flex align-items-center justify-content-md-end">
                                                <div class="mb-2 mt-5 soongukto-wrapper">
                                                    <div class="d-flex justify-content-end align-items-center">
                                                        <div class="text-dark-75 ml-3 rdate" cspas="date">{{formatDateTime($audit_plan['created_at'],'bn')}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="action-group d-flex justify-content-end position-absolute action-group-wrapper">
                                                @if($audit_plan['has_office_order'] == 0 || $audit_plan['has_update_office_order'] == 2)
                                                    <button class="mr-3 btn btn-sm btn-create" title="অফিস অর্ডার তৈরি করুন"
                                                            data-audit-plan-id="{{$audit_plan['id']}}"
                                                            data-annual-plan-id="{{$audit_plan['annual_plan_id']}}"
                                                            data-has-update-request="{{$audit_plan['audit_team_update_count']}}"
                                                            onclick="Office_Order_Container.loadOfficeOrderCreateForm($(this))">
                                                        <i style="color:#ffffff;" class="fad fa-plus-circle"></i> অফিস অর্ডার তৈরি করুন
                                                    </button>
                                                @endif

                                                @if($audit_plan['has_office_order'] == 1)
                                                    @if($audit_plan['office_order']['approved_status'] == 'draft' || $audit_plan['has_update_office_order'] == 1 )
                                                        <button class="mr-1 btn btn-sm btn-edit" title="হালনাগাদ করুন"
                                                                data-office-order-id="{{$audit_plan['has_update_office_order'] == 1 ? $audit_plan['office_order_update']['id'] : $audit_plan['office_order']['id']}}"
                                                                data-audit-plan-id="{{$audit_plan['id']}}"
                                                                data-annual-plan-id="{{$audit_plan['annual_plan_id']}}"
                                                                onclick="Office_Order_Container.loadOfficeOrderCreateForm($(this))">
                                                            <i style="color: white" class="fad fa-edit"></i>
                                                        </button>
                                                    @endif
                                                @endif

                                                @if($audit_plan['has_office_order'] == 1)
                                                        @if($audit_plan['has_update_office_order'] == 1)
                                                            <button
                                                                class="mr-1 btn btn-sm btn-details"
                                                                title="বিস্তারিত দেখুন"
                                                                data-office-order-id="{{$audit_plan['office_order_update']['id']}}"
                                                                data-audit-plan-id="{{$audit_plan['id']}}"
                                                                data-annual-plan-id="{{$audit_plan['annual_plan_id']}}"
                                                                onclick="Office_Order_Container.showUpdateOfficeOrder($(this))"
                                                                type="button">
                                                                <i style="color: white" class="fad fa-eye"></i> আপডেট
                                                            </button>
                                                        @endif
                                                @endif

                                                @if($audit_plan['has_office_order'] == 1)
                                                    @if($audit_plan['office_order']['approved_status'] == 'draft' || (isset($audit_plan['office_order_update']) && $audit_plan['office_order_update']['approved_status'] == 'draft'))
                                                        <button
                                                            class="mr-1 btn btn-sm btn-sent" title="প্রেরণ করুন"
                                                            data-ap-office-order-id="{{$audit_plan['has_update_office_order'] == 1 ? $audit_plan['office_order_update']['id'] : $audit_plan['office_order']['id'] }}"
                                                            data-audit-plan-id="{{$audit_plan['id']}}"
                                                            data-annual-plan-id="{{$audit_plan['annual_plan_id']}}"
                                                            onclick="Office_Order_Container.loadOfficeOrderApprovalAuthority($(this))"
                                                            type="button">
                                                            <i style="color: white" class="fad fa-share-square"></i>
                                                        </button>
                                                    @endif

                                                    @if(($audit_plan['office_order']['approved_status'] == 'draft' && $audit_plan['office_order']['office_order_movement'] != null
                                                    && $audit_plan['office_order']['office_order_movement']['employee_designation_id'] == $current_designation_id) || (isset($audit_plan['office_order_update']) && $audit_plan['office_order_update']['approved_status'] == 'draft' && isset($audit_plan['office_order_update']['office_order_movement']) && $audit_plan['office_order_update']['office_order_movement'] != null
                                                    && $audit_plan['office_order_update']['office_order_movement']['employee_designation_id'] == $current_designation_id))
                                                        <button
                                                            class="mr-1 btn btn-approval" title="অনুমোদন করুন"
                                                            data-ap-office-order-id="{{$audit_plan['has_update_office_order'] == 1 ? $audit_plan['office_order_update']['id'] : $audit_plan['office_order']['id'] }}"
                                                            data-audit-plan-id="{{$audit_plan['id']}}"
                                                            data-annual-plan-id="{{$audit_plan['annual_plan_id']}}"
                                                            data-has-office-order-update="{{$audit_plan['has_update_office_order']}}"
                                                            onclick="Office_Order_Container.approveOfficeOrder($(this))"
                                                            type="button">
                                                            <i style="color: white" class="fad fa-check"></i>
                                                        </button>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@else
    <div class="alert alert-custom alert-white alert-shadow fade show gutter-b" role="alert">
        <div class="alert-icon">
            <i class="text-danger flaticon-warning"></i>
        </div>
        <div class="alert-text">
            {{___('generic.no_data_found')}}
        </div>
    </div>
@endif

