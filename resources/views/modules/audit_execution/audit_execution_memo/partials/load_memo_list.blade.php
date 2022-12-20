@if(!empty($memo_list))
    {{--list view--}}
    <div>
        <ul class="list-group list-group-flush">
            @foreach($memo_list as $memo)
                <li class="list-group-item pl-0 py-2 border-bottom">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="pr-2 flex-fill cursor-pointer position-relative">
                            <div class="row d-md-flex flex-wrap align-items-start justify-content-md-between">
                                <!--begin::Title-->
                                <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3 col-md-9">
                                    <div class="d-flex align-items-center flex-wrap  font-size-1-2">
                                        <span class="mr-2 font-size-1-1 font-weight-bolder">{{___('Audit Observation')}} : </span>
                                        <span class="description text-wrap font-size-14">{{$memo['audit_observation']}}</span>
                                    </div>

                                    <div class="subject-wrapper font-weight-normal">
                                        <span class="mr-2 font-size-1-1 font-weight-bolder">{{___('Cost Center')}} : </span>
                                        <span class="description text-wrap font-size-14">{{$memo['cost_center_name_en']}}</span>
                                    </div>

                                    <div class="subject-wrapper font-weight-normal">
                                        <span class="mr-2 font-size-1-1 font-weight-bolder">{{___('Heading')}} : </span>
                                        <span class="description text-info text-wrap font-size-14">{{$memo['heading']}}</span>
                                    </div>

                                    <div class="subject-wrapper font-weight-normal">
                                        <span class="mr-2 font-size-1-1 font-weight-bolder">{{___('Criteria')}}  :</span>
                                        <span class="description text-wrap font-size-14">{{$memo['criteria']}}</span>
                                    </div>

                                    <div class="subject-wrapper font-weight-normal">
                                        <span class="mr-2 font-size-1-1 font-weight-bolder">{{___('Instances')}} : </span>
                                        <span class="description text-info text-wrap font-size-14">{{$memo['instances']}}</span>
                                    </div>

                                    <div class="subject-wrapper font-weight-normal">
                                        <span class="mr-2 font-size-1-1 font-weight-bolder">{{___('Date To Be Implemented')}} : </span>
                                        <span class="description text-wrap font-size-14">{{$memo['date_to_be_implemented']}}</span>
                                    </div>

                                    <!-- @if($memo['irregularity_cause'])
                                        <div class="font-weight-normal">
                                            <span class="mr-2 font-size-1-1">{{___('generic.list_views.conducting.memo.irregularity_cause')}}:</span>
                                            <span class="font-size-14">
                                                {{$memo['irregularity_cause']}}
                                            </span>
    {{--                                        <span class="label label-outline-warning label-pill label-inline">--}}
    {{--                                            {{$memo['memo_type_name']}}--}}
    {{--                                        </span>--}}
                                        </div>
                                    @endif -->

                                    <!-- <div class=" subject-wrapper font-weight-normal">
                                        <span class="mr-2 font-size-1-1">{{___('generic.list_views.conducting.memo.jorito_ortho')}}:</span>
                                        <span class="text-info font-size-14">
                                            {{enTobn(currency_format($memo['jorito_ortho_poriman']))}}
                                        </span>
                                    </div> -->

                                    <!-- @if($memo['finder_details'])
                                        @php $finder_details = json_decode($memo['finder_details'],true); @endphp
                                        <div class="font-weight-normal">
                                            <span class="mr-2 font-size-1-1">উত্থাপনকারী:</span>
                                            <span class="font-size-14">
                                               {{$finder_details['team_member_name_bn'].', '.$finder_details['team_member_designation_bn']}}
                                            </span>
                                        </div>
                                    @endif -->

                                    <div class="font-weight-normal d-none predict-wrapper">
                                        <span class="predict-label text-success "></span>
                                    </div>
                                </div>
                                <!--end::Title-->
                                <!--begin::Info-->
                                <div class="d-flex align-items-center justify-content-md-end py-lg-0 py-2 col-md-3">
                                    <div class="d-block">
                                        <div
                                            class="d-md-flex flex-wrap mb-2 align-items-center justify-content-md-end text-nowrap">
                                            <div class="ml-3  d-flex align-items-center text-primary">
                                                <i class="flaticon2-copy mr-2 text-primary"></i>
                                            </div>
                                        </div>
                                        <!-- <div class="d-flex align-items-center justify-content-md-end">
                                            <div class="mb-2 mt-3 soongukto-wrapper">
                                                <div class="d-flex justify-content-end align-items-center">
                                                    
                                                    <div class="text-dark-75 ml-3 rdate" cspas="date">{{formatDateTime($memo['created_at'],'bn')}}</div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="action-group d-flex justify-content-end position-absolute action-group-wrapper">
                                            <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                                title="See Details" data-memo-id="{{$memo['id']}}"
                                                    onclick="Memo_List_Container.showMemo($(this))">
                                                <i class="fad fa-eye"></i>
                                            </button>

                                            <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                                    title="{{___('generic.buttons.title.edit')}}" data-memo-id="{{$memo['id']}}"
                                                    onclick="Memo_List_Container.editMemo($(this))">
                                                <i class="fad fa-edit"></i>
                                            </button>

                                            <!-- @if(!$memo['has_sent_to_rpu'])
                                                <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                                        title="আরপিতে প্রেরণ করুন" data-memo-id="{{$memo['id']}}"
                                                        onclick="Memo_List_Container.sendMemoForm($(this))">
                                                    <i class="fa fa-paper-plane "></i>
                                                </button>
                                            @endif -->

                                            <!-- <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary
                                            list-btn-toggle"
                                                    title="{{___('generic.buttons.title.history')}}" data-memo-id="{{$memo['id']}}"
                                                    onclick="Memo_List_Container.memoLog($(this))">
                                                <i class="fad fa-repeat-alt"></i>
                                            </button> -->
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
        <div class="alert-text">No Data Found</div>
    </div>
@endif
