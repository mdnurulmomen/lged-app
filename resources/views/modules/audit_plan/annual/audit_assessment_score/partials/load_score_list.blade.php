@if(!empty($scores['data']))
    {{--list view--}}
    <div class="card sna-card-border mt-3" style="margin-bottom:30px;">
        <div>
            <ul class="list-group list-group-flush">
                @foreach($scores['data'] as $score)
                    <li class="list-group-item py-2 border-bottom">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="pr-2 flex-fill cursor-pointer position-relative">
                                <div class="row d-md-flex flex-wrap align-items-start justify-content-md-between">
                                    <!--begin::Title-->
                                    <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3 col-md-8">
                                        <div class="d-flex align-items-center flex-wrap  font-size-1-2">
                                            <span class="mr-1 ">এনটিটি/সংস্থাঃ</span>
                                            <a href="javascript:void(0)" class="text-dark text-hover-primary font-size-h5">
                                                {{$score['entity_name_bn']}}
                                            </a>
                                            <span class="ml-2 label label-outline-info label-pill label-inline">
                                                {{$score['fiscal_year']['start']}} - {{$score['fiscal_year']['end']}}
                                            </span>
                                        </div>
                                        <div class="subject-wrapper font-weight-normal">
                                            <span class="mr-2 font-size-1-1">মন্ত্রণালয়/বিভাগঃ</span>
                                            <span class="font-size-14">{{$score['ministry_name_bn']}}</span>
                                        </div>
                                        <div class="font-weight-normal">
                                            <span class="mr-2 font-size-1-1">ক্যাটাগরিঃ</span>
                                            <span class="description text-info text-wrap font-size-14">
                                                {{$score['category_title_bn']}}
                                            </span>
                                        </div>
                                        <div class="font-weight-normal">
                                            <span class="mr-2 font-size-1-1">পয়েন্টঃ</span>
                                            <span class="description text-info text-wrap font-size-14">
                                                {{enTobn($score['point'])}}
                                            </span>
                                        </div>
                                        <div class="font-weight-normal d-none predict-wrapper">
                                            <span class="predict-label text-success "></span>
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
                                                        <div class="text-dark-75 ml-3 rdate" cspas="date">{{formatDateTime($score['created_at'],'bn')}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="action-group d-flex justify-content-end position-absolute action-group-wrapper">
                                                <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                                        title="{{___('generic.buttons.title.details')}}"
                                                        data-audit-assessment-score-id="{{$score['id']}}"
                                                        onclick="Assessment_Score_Container.edit($(this))">
                                                    <i class="fad fa-eye"></i>
                                                </button>

                                                <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                                        title="{{___('generic.buttons.title.edit')}}"
                                                        data-audit-assessment-score-id="{{$score['id']}}"
                                                        onclick="Assessment_Score_Container.edit($(this))">
                                                    <i class="fad fa-edit"></i>
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




