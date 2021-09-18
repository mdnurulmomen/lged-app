{{--<div class="search-all position-relative">
    <div class="row">
        <div class="col align-self-start">
            <div class="input-group-append">
                <button class="btn btn-icon btn-light-info btn-square advanced_button" type="button"><i
                        class="fa fa-caret-down"></i>
                </button>
                <input type="text" placeholder="বিষয়/সিদ্ধান্ত দিয়ে খুঁজুন" name="list_daak_subject"
                       title="বিষয়/সিদ্ধান্ত দিয়ে খুঁজুন" id="list_daak_subject" class="form-control rounded-0">
                <button data-toggle="tooltip" data-placement="left" title="খুঁজুন"
                        class="btn btn-icon btn-light-success btn-square daak_list_subject_search" type="button"><i
                        class="fad fa-search"></i></button>
                <button data-toggle="tooltip" data-placement="left" title="রিসেট"
                        class="btn btn-icon btn-light-danger btn-square" id="reset_btn" type="reset"><i
                        class="fad fa-recycle"></i></button>
                <!-- <button class="btn btn-icon btn-light-danger btn-square" type="button"><i class="fa fa-sync-alt"></i></button> -->
                <button data-content=""
                        class="d-none btn btn-info btn-sm btn-square btn-nothi-list cd-btn js-cd-panel-trigger"
                        data-panel="main"><i class="fad fa-book"></i> নথিসমূহ
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
               <span class="input-group-text bg-transparent border-0 inbox_checkbox" data-toggle="popover"
                     data-title="সকল ডাক বাছাই করুন" data-original-title="" title="">
               <label class="checkbox checkbox-outline" id="alabel_checkbox_daak_item_toolbox"
                      for="checkbox_daak_item_toolbox">
               <input type="checkbox" id="checkbox_daak_item_toolbox" name="checkbox_daak_item_toolbox">
               <span></span>
               </label>
               </span>
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
                                    <li><a role="option" class="dropdown-item" id="bs-select-1-1" tabindex="0"><span
                                                class="text">অপঠিত</span></a></li>
                                    <li><a role="option" class="dropdown-item" id="bs-select-1-2" tabindex="0"><span
                                                class="text">পঠিত</span></a></li>
                                    <li><a role="option" class="dropdown-item" id="bs-select-1-3" tabindex="0"><span
                                                class="text">মূল-প্রাপক</span></a></li>
                                    <li><a role="option" class="dropdown-item" id="bs-select-1-4" tabindex="0"><span
                                                class="text">অনুলিপি</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="input select">
                        <div class="dropdown bootstrap-select form-control">
                            <button type="button" tabindex="-1"
                                    class="btn dropdown-toggle bs-placeholder btn-light border-0"
                                    data-toggle="dropdown" role="combobox" aria-owns="bs-select-3"
                                    aria-haspopup="listbox" aria-expanded="false"
                                    data-id="daak_security_selectpicker" title="গোপনীয়তা">
                                <div class="filter-option">
                                    <div class="filter-option-inner">
                                        <div class="filter-option-inner-inner">গোপনীয়তা</div>
                                    </div>
                                </div>
                            </button>
                            <div class="dropdown-menu "
                                 style="max-height: 406px; overflow: hidden; min-height: 118px;">
                                <div class="inner show" role="listbox" id="bs-select-3" tabindex="-1"
                                     style="max-height: 406px; overflow-y: auto; min-height: 118px;">
                                    <ul class="dropdown-menu inner show" role="presentation"
                                        style="margin-top: 0px; margin-bottom: 0px;">
                                        <li><a role="option" class="dropdown-item" id="bs-select-3-0"
                                               tabindex="0"><span class="text">বাছাই করুন</span></a></li>
                                        <li><a role="option" class="dropdown-item" id="bs-select-3-1"
                                               tabindex="0"><span class="text">অতি গোপনীয়</span></a></li>
                                        <li><a role="option" class="dropdown-item" id="bs-select-3-2"
                                               tabindex="0"><span class="text">বিশেষ গোপনীয়</span></a></li>
                                        <li><a role="option" class="dropdown-item" id="bs-select-3-3"
                                               tabindex="0"><span class="text">গোপনীয়</span></a></li>
                                        <li><a role="option" class="dropdown-item" id="bs-select-3-4"
                                               tabindex="0"><span class="text">সীমিত</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="input select">
                        <div class="dropdown bootstrap-select form-control">
                            <button type="button" tabindex="-1"
                                    class="btn dropdown-toggle bs-placeholder btn-light border-0"
                                    data-toggle="dropdown" role="combobox" aria-owns="bs-select-4"
                                    aria-haspopup="listbox" aria-expanded="false" data-id="daak_type_selectpicker"
                                    title="ডাকের ধরণ">
                                <div class="filter-option">
                                    <div class="filter-option-inner">
                                        <div class="filter-option-inner-inner">ডাকের ধরণ</div>
                                    </div>
                                </div>
                            </button>
                            <div class="dropdown-menu "
                                 style="max-height: 406px; overflow: hidden; min-height: 0px;">
                                <div class="inner show" role="listbox" id="bs-select-4" tabindex="-1"
                                     style="max-height: 406px; overflow-y: auto; min-height: 0px;">
                                    <ul class="dropdown-menu inner show" role="presentation"
                                        style="margin-top: 0px; margin-bottom: 0px;">
                                        <li><a role="option" class="dropdown-item" id="bs-select-4-0"
                                               tabindex="0"><span class="text">দাপ্তরিক</span></a></li>
                                        <li><a role="option" class="dropdown-item" id="bs-select-4-1"
                                               tabindex="0"><span class="text">নাগরিক</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="input select">
                        <div class="dropdown bootstrap-select form-control">
                            <button type="button" tabindex="-1"
                                    class="btn dropdown-toggle bs-placeholder btn-light border-0"
                                    data-toggle="dropdown" role="combobox" aria-owns="bs-select-5"
                                    aria-haspopup="listbox" aria-expanded="false"
                                    data-id="daak_priority_selectpicker" title="অগ্রাধিকার">
                                <div class="filter-option">
                                    <div class="filter-option-inner">
                                        <div class="filter-option-inner-inner">অগ্রাধিকার</div>
                                    </div>
                                </div>
                            </button>
                            <div class="dropdown-menu "
                                 style="max-height: 406px; overflow: hidden; min-height: 118px;">
                                <div class="inner show" role="listbox" id="bs-select-5" tabindex="-1"
                                     style="max-height: 406px; overflow-y: auto; min-height: 118px;">
                                    <ul class="dropdown-menu inner show" role="presentation"
                                        style="margin-top: 0px; margin-bottom: 0px;">
                                        <li><a role="option" class="dropdown-item" id="bs-select-5-0"
                                               tabindex="0"><span class="text">বাছাই করুন</span></a></li>
                                        <li><a role="option" class="dropdown-item" id="bs-select-5-1"
                                               tabindex="0"><span class="text">সর্বোচ্চ অগ্রাধিকার</span></a></li>
                                        <li><a role="option" class="dropdown-item" id="bs-select-5-2"
                                               tabindex="0"><span class="text">অবিলম্বে</span></a></li>
                                        <li><a role="option" class="dropdown-item" id="bs-select-5-3"
                                               tabindex="0"><span class="text">জরুরি</span></a></li>
                                    </ul>
                                </div>
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
                <div class="">
                    <button type="button" class="btn btn-icon btn-daak-sort" data-toggle="tooltip"
                            title="ডাক বক্স শেয়ারিং">
                        <i class="fas fa-share-alt text-success"></i>
                    </button>
                </div>
                <div class="d-none" id="daak-toolbar">
                    <div class="d-flex btn-daak-group bg-transparent">
                        <button class="btn btn-icon mx-1 daak-seal-forward" type="button" data-toggle="tooltip"
                                title="ডাক প্রেরণ করুন">
                            <span class="fad fa-share text-info"></span>
                        </button>
                        <button class="btn btn-icon mx-1 btn-nothivukto-selected" type="button"
                                data-toggle="tooltip" title="নথিতে উপস্থাপন">
                            <i class="fad fa-books text-warning"></i>
                        </button>
                        <button class="btn btn-icon mx-1 btn-nothijato-selected" type="button" data-toggle="tooltip"
                                title="নথিজাত">
                            <i class="fal fa-folder-open text-primary"></i>
                        </button>
                        <button class="btn btn-icon mx-1 btn-archive-selected" type="button" data-toggle="tooltip"
                                title="আর্কাইভ">
                            <i class="fa fa-archive text-success"></i>
                        </button>
                        <button id="btn-daak-toolbar-draft-send" class="btn btn-icon mx-1" type="button"
                                data-toggle="tooltip" title="বাছাইকৃত ডাক প্রেরণ">
                            <span class="fas fa-share text-success"></span>
                        </button>
                        <button id="btn-daak-toolbar-dak-drafting" class="btn btn-icon mx-1 daak-seal-forward"
                                type="button" data-toggle="tooltip" title="ডাক  সর্টিং">
                            <span class="fas fa-share text-success"></span>
                        </button>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn" type="button" id="titleFilter" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                        <i data-toggle="popover" data-content="তথ্য গোপন / প্রদর্শন" data-placement="top"
                           class="fal fa-eye text-dark-100" data-original-title="" title=""></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="filter" id="filterDropdown">
                        <div class="checkbox-inline dropdown-item">
                            <label class="checkbox showHidecheckBox">
                                <input type="checkbox" name="filter[]" value="filterPerok" checked="">
                                <span></span>প্রেরক</label>
                        </div>
                        <div class="checkbox-inline dropdown-item">
                            <label class="checkbox showHidecheckBox">
                                <input type="checkbox" name="filter[]" value="filterMulPerok" checked="">
                                <span></span>মূল প্রাপক</label>
                        </div>
                        <div class="checkbox-inline dropdown-item">
                            <label class="checkbox showHidecheckBox">
                                <input type="checkbox" name="filter[]" value="filterBisoy" checked="">
                                <span></span>বিষয়</label>
                        </div>
                        <div class="checkbox-inline dropdown-item">
                            <label class="checkbox showHidecheckBox">
                                <input type="checkbox" name="filter[]" value="filterSiddhanto" checked="">
                                <span></span>সিদ্ধান্ত</label>
                        </div>
                        <div class="checkbox-inline dropdown-item">
                            <label class="checkbox showHidecheckBox">
                                <input type="checkbox" name="filter[]" value="filterSongjukto" checked="">
                                <span></span>সংযুক্তি এবং তারিখ</label>
                        </div>
                        <div class="checkbox-inline dropdown-item">
                            <label class="checkbox showHidecheckBox">
                                <input type="checkbox" name="filter[]" value="filterPersonalFolder" checked="">
                                <span></span>ফোল্ডার</label>
                        </div>
                    </div>
                </div>
                <button class="btn-digital-postbox mr-1 btn btn-icon btn-square btn-sm btn-icon-primary py-5"
                        type="button">
                    <i class="fa fa-envelope" data-toggle="popover" data-content="ডিজিটাল পোস্টবক্স"
                       data-original-title="" title=""></i>
                </button>
                <div id="personal_folder_selected_name" class="p-2 d-none">
                </div>
            </div>
        </div>
    </div>
    <div id="daak_pagination_panel" class="float-right d-flex align-items-center" style="vertical-align:middle;">
                    <span class="mr-2"><span id="daak_item_length_start">{{$all_entities['from']}}</span> - <span
                            id="daak_item_length_end">{{$all_entities['to']}}</span> সর্বমোট: <span
                            id="daak_item_total_record">{{$all_entities['total']}}</span></span>
        <div class="btn-group">
            <button class="btn-list-prev btn btn-icon btn-secondary btn-square" disabled="disabled" type="button"><i
                    class="fad fa-chevron-left" data-toggle="popover" data-content="পূর্ববর্তী"
                    data-original-title="" title=""></i></button>
            <button class="btn-list-next btn btn-icon btn-secondary btn-square" type="button" disabled="disabled"><i
                    class="fad fa-chevron-right" data-toggle="popover" data-content="পরবর্তী" data-original-title=""
                    title=""></i></button>
        </div>
    </div>
</div>--}}

<div class="col-lg-12 p-0 mt-3">
    <!--begin::Table-->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-light">
            <tr>
                <th class="align-middle">মন্ত্রণালয়/বিভাগ</th>
                <th>প্রতিষ্ঠানের নাম</th>
                <th>প্রতিষ্ঠানের ধরণ</th>
                <th>প্রতিষ্ঠানের মোট ইউনিটের সংখ্যা</th>
                <th>অডিটের জন্য প্রস্তাবিত ইউনিটের নাম ও সংখ্যা</th>
                <th>সাবজেক্ট ম্যাটার</th>
                <th>প্রয়োজনীয় লোকবল</th>
                <th>মন্তব্য</th>
                <th width="8%">প্ল্যান</th>
            </tr>
            </thead>
            <tbody>
            @foreach($all_entities['data'] as $annual_plan)
                <tr>
                    <td>{{$annual_plan['ministry_name_bn']}}</td>
                    <td>{{$annual_plan['controlling_office_bn']}}</td>
                    <td>{{$annual_plan['office_type']}}</td>
                    <td>{{enTobn($annual_plan['total_unit_no'])}}</td>
                    <td>
                        @foreach(json_decode($annual_plan['nominated_offices'],true) as $office)
                            {{enTobn($loop->iteration)}}| {{$office['office_name_bn']}} <br>
                        @endforeach
                        <span style="float: right;font-weight: bold">মোট {{enTobn($annual_plan['nominated_office_counts'])}}টি ইউনিট</span>
                    </td>
                    <td>{{$annual_plan['subject_matter']}}</td>
                    <td>
                        @foreach(json_decode($annual_plan['nominated_man_powers'],true)['staffs'] as $man)
                            {{enTobn($loop->iteration)}}| {{$man['designation_bn'].', '.
                                        $man['responsibility_bn'].' - '.enTobn($man['staff']).'জন'}} <br>
                        @endforeach
                    </td>
                    <td>{{$annual_plan['comment']}}</td>
                    <td>
                        <span
                            data-annual-plan-id="{{$annual_plan['id']}}"
                            data-activity-id="{{$annual_plan['activity_id']}}"
                            data-fiscal-year-id="{{$annual_plan['fiscal_year_id']}}"
                            class="btn btn-sm btn-transparent-success btn-icon btn-square"
                            onclick="Audit_Plan_Container.loadAuditPlanBookCreatable($(this))"><i
                                class="fal fa-plus"></i></span>
                        <ul class="list-unstyled mb-0 mt-2">
                            @foreach($annual_plan['audit_plans'] as $audit_plans)
                                <li>{{enTobn($loop->iteration)}}|
                                    <a href="javascript:;"
                                       data-audit-plan-id="{{$audit_plans['id']}}"
                                       data-fiscal-year-id="{{$audit_plans['fiscal_year_id']}}"
                                       data-annual-plan-id="{{$audit_plans['annual_plan_id']}}"
                                       onclick="Audit_Plan_Container.loadAuditPlanBookEditable($(this))">
                                        প্ল্যান: {{enTobn($audit_plans['id'])}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!--end::Table-->
</div>

<script>
    $('.entity_list_item_clickable_area').click(function () {
        Audit_Plan_Container.loaoAuditPlanBookEditable($(this));
    })
</script>
