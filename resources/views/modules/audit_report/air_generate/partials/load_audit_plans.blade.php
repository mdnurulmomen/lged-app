@if(!empty($audit_plans['data']))
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
                                                $ministry_ids = [];
                                                foreach($audit_plan['annual_plan']['ap_entities'] as $ap_entities){
                                                    $ministry =  $ap_entities['ministry_name_bn'];
                                                    $ministries[] = $ministry;

                                                    $ministry_id =  $ap_entities['ministry_id'];
                                                    $ministry_ids[] = $ministry_id;
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
                                                $entitie_ids = [];
                                                foreach($audit_plan['annual_plan']['ap_entities'] as $ap_entities){
                                                    $entity =  $ap_entities['entity_name_bn'];
                                                    $entities[] = $entity;

                                                    $entitie_id =  $ap_entities['entity_id'];
                                                    $entitie_ids[] = $entitie_id;
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
                                            অডিট প্ল্যান : {{enTobn($audit_plan['id'])}}
{{--                                            অডিট প্ল্যান : {{enTobn($audit_plan['plan_no'])}}--}}
                                        </span>
                                        {{--<span class="label label-outline-primary label-pill label-inline">
                                            {{$audit_plan['office_order'] != null? ucfirst($audit_plan['office_order']['approved_status']):'Not Generated'}}
                                        </span>--}}
                                    </div>
                                    <div class="font-weight-normal d-none predict-wrapper">
                                        <span class="predict-label text-success "></span>
                                    </div>

                                    <div class="d-flex mt-3">
                                        @foreach($audit_plan['air_reports'] as $airReport)
                                            <a href="javascript:;"
                                               title="এআইআর-{{enTobn($airReport['id'])}} বিস্তারিত দেখুন"
                                               class="badge-square rounded-0 badge d-flex align-items-center {{$airReport['status'] == 'approved'?'tap-alert-success':'tap-alert-danger'}}
                                                   font-weight-normal mr-1 border decision"
                                               data-fiscal-year-id="{{$audit_plan['fiscal_year_id']}}"
                                               data-activity-id="{{$audit_plan['activity_id']}}"
                                               data-annual-plan-id="{{$audit_plan['annual_plan_id']}}"
                                               data-audit-plan-id="{{$audit_plan['id']}}"
                                               data-audit-entity-info="{{json_encode($audit_plan['annual_plan']['ap_entities'])}}"
                                               data-audit-plan-entities="{{implode(' , ', array_unique($entities))}}"
                                               data-air-report-id="{{$airReport['id']}}"
                                               onclick="AIR_Container.loadAIRShow($(this))">
                                                <i class="fad fa-badge-sheriff mr-2 text-dark-100"></i>
                                                ড্রাফ্ট এআইআর: {{enTobn($airReport['id'])}}
                                                @if($airReport['status'] == 'draft')
                                                    {{empty($airReport['latest_r_air_movement'])?'':'('.$airReport['latest_r_air_movement']['receiver_employee_designation_bn'].' এর কাছে প্রেরণ করা হয়েছে)'}}
                                                @endif
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <!--end::Title-->
                                <!--begin::Info-->
                                <div class="d-flex align-items-center justify-content-md-end py-lg-0 py-2 col-md-4">
                                    <div class="d-block">
                                        <div
                                            class="d-md-flex flex-wrap mb-2 align-items-center justify-content-md-end text-nowrap">
                                            <div class="ml-3  d-flex align-items-center text-primary">
                                                <i class="flaticon2-copy mr-2 text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-md-end">
                                            <div class="mb-2 mt-3 soongukto-wrapper">
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <div class="text-dark-75 ml-3 rdate" cspas="date">{{formatDateTime($audit_plan['created_at'],'bn')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="action-group d-flex justify-content-end position-absolute action-group-wrapper">
                                            <button class="mr-3 btn btn-sm btn-primary btn-square" title="নতুন এআইআর করুন"
                                                    data-fiscal-year-id="{{$audit_plan['fiscal_year_id']}}"
                                                    data-fiscal-year-start="{{$audit_plan['fiscal_year']['start']}}"
                                                    data-fiscal-year-end="{{$audit_plan['fiscal_year']['end']}}"
                                                    data-activity-id="{{$audit_plan['activity_id']}}"
                                                    data-annual-plan-id="{{$audit_plan['annual_plan_id']}}"
                                                    data-audit-plan-id="{{$audit_plan['id']}}"
                                                    data-audit-plan-entity-info="{{json_encode($audit_plan['annual_plan']['ap_entities'])}}"
                                                    data-audit-plan-entities="{{implode(' , ', array_unique($entities))}}"
                                                    onclick="AIR_Container.loadAIRCreate($(this))">
                                                <i class="fad fa-plus-circle"></i> ড্রাফট এআইআর তৈরি করুন
                                            </button>
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
@else
    <div class="alert alert-custom alert-light-primary fade show mb-5" role="alert">
        <div class="alert-icon">
            <i class="flaticon-warning"></i>
        </div>
        <div class="alert-text">{{___('generic.no_data_found')}}</div>
    </div>
@endif

