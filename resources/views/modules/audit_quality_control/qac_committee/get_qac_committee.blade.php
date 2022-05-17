<div class="table-search-header-wrapper mb-4 pt-3 pb-3 shadow-sm">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-md-7"></div>
                <div class="col-md-5">
                    <div class="d-flex justify-content-md-end">
                        <a onclick="Qac_Committee_Container.createCommittee()"
                           data-fiscal-year-id="{{$fiscal_year_id}}"
                           class="btn btn-sm btn-info btn-square mr-1"
                           href="javascript:;">
                            <i class="fas fa-plus-circle mr-1"></i>
                            নতুন যোগ করুন
                        </a>
                    </div>
                </div>
        </div>
    </div>
</div>

@if(!empty($committee_list))
    <div>
        <ul class="list-group list-group-flush">
            @foreach($committee_list as $committee)
                <li class="list-group-item py-2 border-bottom">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="pr-2 flex-fill cursor-pointer position-relative">
                            <div class="row d-md-flex flex-wrap align-items-start justify-content-md-between">
                                <!--begin::Title-->
                                <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3 col-md-8">
                                    <div class="font-weight-normal">
                                        <span class="mr-2 font-size-1-1">কমিটির নাম : </span>
                                        <span class="font-size-14">
                                            {{$committee['title_bn']}}
                                        </span>
                                    </div>

                                    <div class="font-weight-normal">
                                        <span class="mr-2 font-size-1-1">সদস্য : </span>
                                        <span class="font-size-14">
                                            @foreach($committee['qac_committee_members'] as $member)
                                                <span>
                                                    {{enTobn($loop->iteration)}}.
                                                    {{$member['officer_bn']}}({{$member['officer_designation_bn']}})
                                                </span>
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--end::Title-->
                                <!--begin::Info-->
                                <div class="d-flex align-items-center justify-content-md-end py-lg-0 py-2 col-md-4">
                                    <div>
                                        <div class="action-group">
{{--                                            <button class="mr-3 btn btn-sm btn-outline-primary btn-square" title="বিস্তারিত দেখুন"--}}
{{--                                                    data-annual-plan-id=""--}}
{{--                                                    onclick="">--}}
{{--                                                <i class="fad fa-eye"></i> বিস্তারিত--}}
{{--                                            </button>--}}
                                                <button class="mr-3 btn btn-sm btn-warning btn-square" title="সম্পাদনা করুন"
                                                        data-committee-id="{{$committee['id']}}"
                                                        data-committee-title-bn="{{$committee['title_bn']}}"
                                                        onclick="Qac_Committee_Container.editQacCommittee($(this))">
                                                    <i class="fad fa-edit"></i> সম্পাদনা
                                                </button>
                                                <button class="mr-3 btn btn-sm btn-danger btn-square" title="সম্পাদনা করুন"
                                                        data-committee-id="{{$committee['id']}}"
                                                        onclick="Qac_Committee_Container.deleteQacCommittee($(this))">
                                                    <i class="fad fa-trash"></i> বাতিল করুন
                                                </button>

                                        </div>
                                        <div>
                                            <div class="mb-2 mt-3">
                                                <div>
                                                    <div class="text-dark-75 ml-3" cspas="date">{{formatDateTime($committee['created_at'],'bn')}}</div>
                                                </div>
                                            </div>
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
