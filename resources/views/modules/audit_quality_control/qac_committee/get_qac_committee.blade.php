<div class="table-search-header-wrapper mb-4 pt-3 pb-3 shadow-sm">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-md-7"></div>
                <div class="col-md-5">
                    <div class="d-flex justify-content-md-end">
                        <a onclick="Qac_Committee_Container.createCommittee()"
                           data-fiscal-year-id="{{$fiscal_year_id}}"
                           class="btn btn-sm btn-light-info btn-square mr-1"
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
    <div class="search-all position-relative">
        <div class="row">
            <div class="col align-self-start">
                <div class="input-group-append">
                    <button class="btn btn-icon btn-light-info btn-square advanced_button" type="button"><i
                            class="fa fa-caret-down"></i>
                    </button>
                    <input type="text" placeholder="অনুসন্ধান করুন" class="form-control rounded-0">
                    <button data-toggle="tooltip" data-placement="left" title="খুঁজুন"
                            class="btn btn-icon btn-light-success btn-square" type="button"><i
                            class="fad fa-search"></i>
                    </button>
                    <button data-toggle="tooltip" data-placement="left" title="রিসেট"
                            class="btn btn-icon btn-light-danger btn-square" id="reset_btn" type="reset"><i
                            class="fad fa-recycle"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="toolbar flex-wrap justify-content-between shadow-sm pl-1 d-flex border-bottom">
        <div class="d-flex">
            <div id="daak_group_action_panel">
                <div class="d-flex flex-wrap">
                    <div class="btn-group">
                        <div class="dropdown bootstrap-select form-control">
                            <button type="button" tabindex="-1" class="btn dropdown-toggle btn-light border-0"
                                    data-toggle="dropdown" role="combobox" aria-owns="bs-select-1"
                                    aria-haspopup="listbox" aria-expanded="false" data-id="daak_status_selectpicker"
                                    title="সকল">
                                <div class="filter-option">
                                    <div class="filter-option-inner">
                                        <div class="filter-option-inner-inner">সকল</div>
                                    </div>
                                </div>
                            </button>
                            <div class="dropdown-menu " style="max-height: 406px; overflow: hidden; min-height: 118px;">
                                <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1"
                                     aria-activedescendant="bs-select-1-0"
                                     style="max-height: 406px; overflow-y: auto; min-height: 118px;">
                                    <ul class="dropdown-menu inner show" role="presentation"
                                        style="margin-top: 0px; margin-bottom: 0px;">
                                        <li class="selected active"><a role="option"
                                                                       class="dropdown-item active selected"
                                                                       id="bs-select-1-0" tabindex="0" aria-setsize="5"
                                                                       aria-posinset="1" aria-selected="true"><span
                                                    class="text">সকল</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button id="btn-daak-toolbar-reset" class="btn btn-icon mx-1" type="button" data-toggle="tooltip"
                            title="রিসেট">
                        <span class="fas fa-recycle text-warning"></span>
                    </button>
                    <button id="btn-daak-toolbar-refresh" class="btn btn-icon mx-1" type="button" data-toggle="tooltip"
                            title="রিফ্রেশ">
                        <span class="fa fa-sync text-info"></span>
                    </button>
                    <div id="personal_folder_selected_name" class="p-2 d-none">
                    </div>
                </div>
            </div>
        </div>
        <div id="daak_pagination_panel" class="float-right d-flex align-items-center" style="vertical-align:middle;">
                <span class="mr-2"><span id="daak_item_length_start">১</span> - <span id="daak_item_length_end">{{enTobn(count($committee_list))}}</span> সর্বমোট: <span
                        id="daak_item_total_record">{{enTobn(count($committee_list))}}</span></span>
            <div class="btn-group">
                <button class="btn-list-prev btn btn-icon btn-secondary btn-square" disabled="disabled" type="button"><i
                        class="fad fa-chevron-left" data-toggle="popover" data-content="পূর্ববর্তী"
                        data-original-title="" title=""></i></button>
                <button class="btn-list-next btn btn-icon btn-secondary btn-square" type="button" disabled="disabled"><i
                        class="fad fa-chevron-right" data-toggle="popover" data-content="পরবর্তী" data-original-title=""
                        title=""></i></button>
            </div>
        </div>
    </div>
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
{{--                                        <div class="action-group">--}}
{{--                                            <button class="mr-3 btn btn-sm btn-outline-primary btn-square" title="বিস্তারিত দেখুন"--}}
{{--                                                    data-annual-plan-id=""--}}
{{--                                                    onclick="">--}}
{{--                                                <i class="fad fa-eye"></i> বিস্তারিত--}}
{{--                                            </button>--}}
{{--                                                <button class="mr-3 btn btn-sm btn-outline-warning btn-square" title="সম্পাদনা করুন"--}}
{{--                                                        data-annual-plan-id=""--}}
{{--                                                        data-fiscal-year-id=""--}}
{{--                                                        data-op-audit-calendar-event-id=""--}}
{{--                                                        onclick="">--}}
{{--                                                    <i class="fad fa-edit"></i> সম্পাদনা--}}
{{--                                                </button>--}}
{{--                                                <button class="mr-3 btn btn-sm btn-outline-danger btn-square" title="সম্পাদনা করুন"--}}
{{--                                                        data-annual-plan-id=""--}}
{{--                                                        data-fiscal-year-id=""--}}
{{--                                                        data-op-audit-calendar-event-id=""--}}
{{--                                                        onclick="">--}}
{{--                                                    <i class="fad fa-trash"></i> বাতিল করুন--}}
{{--                                                </button>--}}

{{--                                        </div>--}}
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
