@extends('sideMenuLayout')
@section('content')
    <div class="search-all position-relative">
        <div class="row">
            <div class="col align-self-start">
                <!-- <input type="text"  class="form-control rounded-0" placeholder="আবেদন গ্রহণ নম্বর"/> -->
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
            <span class="mr-2"><span id="daak_item_length_start">১</span> - <span id="daak_item_length_end">৫</span> সর্বমোট: <span
                    id="daak_item_total_record">৫</span></span>
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
    <h2 class="mt-3 text-primary ml-3">{{ __('লিস্ট স্টাইল ১') }}</h2>
    <div>
        <ul class="list-group list-group-flush">
            <li id="daak_container_inbox_1_54_Daptorik" class="daak_list_item list-group-item pl-0 py-2 border-bottom">
                <div class="d-flex justify-content-between align-items-start">
               <span class="input-group-text bg-transparent border-0" data-toggle="popover"
                     data-content="ডাক বাছাই করুন" data-original-title="" title="">
                  <label class="checkbox checkbox-outline">
                        <input data-draft-decisions="" type="checkbox"
                               name="daak_container_inbox_daak_list_item_checkbox" data-attention="0"
                               class="daak_container_inbox_daak_list_item_checkbox">
                        <span></span>
                  </label>
               </span>
                    <div class="pr-2 flex-fill daak_list_item_clickable_area cursor-pointer position-relative"
                         did="daak_container_inbox_1_54_Daptorik">
                        <div class="row d-md-flex flex-wrap align-items-start justify-content-md-between">
                            <!--begin::Title-->
                            <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3 col-md-6">
                                <div class="d-flex align-items-center flex-wrap  font-size-1-2"><span
                                        class="mr-1 ">উৎস: </span><a href="javascript:void(0)"
                                                                     class=" text-dark text-hover-primary font-size-h5"
                                                                     data-toggle="popover" data-html="true"
                                                                     data-content="উৎস : বোরহান উদ্দিন, <br/>( এডমিন স্পেশালিস্ট , এডমিন, এসপায়ার টু ইনোভেট (এটু্আই) প্রোগ্রাম)<br></a>মূল-প্রাপক: এ টি এম আল ফাত্তাহ,<br /> ( ন্যাশনাল কনসালটেন্ট, ই-সার্ভিস, এসপায়ার টু ইনোভেট (এটু্আই) প্রোগ্রাম )<br/>"
                                                                     data-original-title="" title="">বোরহান উদ্দিন</a>
                                </div>
                                <div class=" font-weight-normal d-md-flex flex-wrap">
                                    <div class="font-size-1-1"><span class="mr-2 perok-wrapper">প্রেরক:</span><span
                                            class="perok-wrapper sender_name" data-toggle="popover"
                                            data-content="প্রোগ্রাম এসোসিয়েট, টেকনোলজি, এসপায়ার টু ইনোভেট (এটু্আই) প্রোগ্রাম"
                                            data-original-title="" title="">মানিক মাহমুদ</span></div>
                                    <div class="font-size-1-1"><span class="mx-2 prapok-wrapper perok-wrapper"><i
                                                class="la la-caret-right"></i></span><span class="mr-2 prapok-wrapper">মূল-প্রাপক:</span><span
                                            class="prapok-wrapper" data-toggle="popover"
                                            data-content="ন্যাশনাল কনসালটেন্ট, ই-সার্ভিস, এসপায়ার টু ইনোভেট (এটু্আই) প্রোগ্রাম"
                                            data-original-title="" title="">এ টি এম আল ফাত্তাহ</span></div>
                                </div>
                                <div class=" subject-wrapper font-weight-normal font-weight-normal">
                                    <span class="mr-2 font-size-1-1">বিষয়:</span>
                                    <span class="description text-wrap font-size-14">sdd</span>
                                </div>
                                <div class=" font-weight-normal siddhanto-wrapper">
                                    <span class="mr-2 font-size-1-1">সিদ্ধান্ত:</span>
                                    <span class="text-info font-size-14">সদয় সিদ্ধান্তের জন্যে প্রেরণ করা হলো</span>
                                </div>
                                <div class=" font-weight-normal d-none predict-wrapper">
                                    <span class="predict-label text-success "></span>
                                </div>
                            </div>
                            <!--end::Title-->
                            <!--begin::Info-->
                            <div class="d-flex align-items-center justify-content-md-end py-lg-0 py-2 col-md-6">
                                <div class="d-block">
                                    <div
                                        class="d-md-flex flex-wrap mb-2 align-items-center justify-content-md-end text-nowrap">
                                        <div class="ml-3  d-flex align-items-center text-primary"><i
                                                class="flaticon2-copy mr-2 text-primary"></i>অনুলিপি
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-md-end">
                                        <div class="btn-group folder-wrapper mb-2 mt-3 mr-3">
                                            <button type="button"
                                                    class="btn btn-sm rounded-0 alert-warning  folder_click">SQA
                                            </button>
                                            <div class="dropdown dropdown-inline">
                                                <button type="button"
                                                        class="btn btn-light-warning btn-icon btn-sm  rounded-0 alert-warning"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="true">
                                                    <i class="ki ki-bold-more-ver"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-sm folder_click"
                                                     x-placement="bottom-start">
                                                    <span class="dropdown-item">Developers</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-2 mt-3 soongukto-wrapper">
                                            <div class="d-flex justify-content-end align-items-center">
                                                <button
                                                    data-info="{&quot;id&quot;:54,&quot;origin_office_id&quot;:65,&quot;dak_priority&quot;:&quot;0&quot;,&quot;dak_security&quot;:&quot;0&quot;,&quot;dak_type&quot;:&quot;Daptorik&quot;,&quot;is_copied_dak&quot;:1,&quot;dak_subject&quot;:&quot;sdd&quot;,&quot;sender&quot;:&quot;&quot;,&quot;attachment_count&quot;:1,&quot;sending_date&quot;:&quot;&quot;}"
                                                    class="btn-attachment btn btn-outline-warning btn-sm" type="button">
                                                    <i class="fal fa-link" style="font-size:11px"></i>
                                                    <span class="text-danger">১</span>
                                                </button>
                                                <div class="text-dark-75 ml-3 rdate" cspas="date">২০/৫/২১ ১:০৮ PM</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="action-group d-flex justify-content-end position-absolute action-group-wrapper">

                                        <a data-popout="true" data-toggle="confirmation"
                                           data-title="আপনি কি ডাকটি আর্কাইভ করতে চান ?" href="javascript:;"
                                           class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn-archive list-btn-toggle"
                                           data-dak-info="daak_container_inbox_1_54_Daptorik" data-original-title=""
                                           title="">
                                            <i class="fa fa-archive" data-toggle="popover" data-content="আর্কাইভ"
                                               data-original-title="" title=""></i>
                                        </a>
                                        <button
                                            data-info="{&quot;id&quot;:54,&quot;origin_office_id&quot;:65,&quot;dak_priority&quot;:&quot;0&quot;,&quot;dak_security&quot;:&quot;0&quot;,&quot;dak_type&quot;:&quot;Daptorik&quot;,&quot;is_copied_dak&quot;:1,&quot;dak_subject&quot;:&quot;sdd&quot;,&quot;sender&quot;:&quot;&quot;,&quot;attachment_count&quot;:1,&quot;sending_date&quot;:&quot;&quot;}"
                                            class="panel_single_daak_forward_dropdown mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                            type="button">
                                            <i class="fad fa-share" data-toggle="popover" data-content="ডাক প্রেরণ করুন"
                                               data-original-title="" title=""></i>
                                        </button>
                                        <a href="javascript:;"
                                           class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn-nothivukto list-btn-toggle"
                                           data-subject="sdd" data-dak-info="daak_container_inbox_1_54_Daptorik">
                                            <i class="fad fa-books" data-toggle="popover" data-content="নথিতে উপস্থাপন"
                                               data-original-title="" title=""></i>
                                        </a>
                                        <a href="javascript:;"
                                           class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn-nothijato list-btn-toggle"
                                           data-subject="sdd" data-dak-info="daak_container_inbox_1_54_Daptorik">
                                            <i class="fal fa-folder-open" data-toggle="popover" data-content="নথিজাত"
                                               data-original-title="" title=""></i>
                                        </a>

                                        <button data-subject="sdd" data-dak-info="daak_container_inbox_1_54_Daptorik"
                                                class="btn_daak_movement mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                                type="button">
                                            <i data-toggle="popover" data-content="ডাক গতিবিধি"
                                               class="fas fa-repeat-alt" data-original-title="" title=""></i>
                                        </button>
                                        <button data-subject="sdd" data-dak-info="daak_container_inbox_1_54_Daptorik"
                                                data-personal-folder="{&quot;15&quot;:15,&quot;11&quot;:11}"
                                                class="daak_tagging_dropdown mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                                type="button">
                                            <i class="fal fa-tags" data-toggle="popover" data-content="ডাক ট্যাগসমূহ"
                                               data-original-title="" title=""></i>
                                        </button>


                                        <!--                            <button data-info='-->
                                        <!--?//=h(json_encode($row))?-->
                                        <!--' class="btn-prediction mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle" type="button">-->
                                        <!--                                <i class="far fa-brain" data-toggle="popover" data-content="ডাক প্রেডিকশন"></i>-->
                                        <!--                            </button>-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Info-->
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <br/>
    <h2 class="mt-3 text-danger ml-3">{{ __('লিস্ট স্টাইল ২') }}</h2>
    <div
        class="row d-md-flex align-items-md-start justify-content-md-between flex-wrap border-bottom border-top-0 border-left-0 border-right-0 m-2 p-2 daak_list_item list-group-item">
        <div id="potro_information"
             class="col-md-12 d-md-flex flex-row align-items-md-start justify-content-md-between px-0">
            <div class="d-flex align-items-top justify-content-md-between w-100">
                <div class="">
                    <div class="mb-1 d-md-flex align-items-md-center flex-wrap">
                        <span class="badge alert-primary">নথি: </span>
                        <span class="mx-1 text-purple ">৫৬.০৪.০০০০.১১০.০১.০১৯.২১ check</span>
                    </div>
                    <div class="d-md-flex align-items-md-start flex-wrap">
                        <div class="mb-1 d-md-flex align-items-md-center">
                            <span class="badge alert-primary">নোট: </span>
                            <span class="mx-1 text-purple ">---</span>
                        </div>
                        <div class="d-md-flex align-items-md-start justify-content-md-start flex-wrap">
                            <div class="d-flex align-items-top mb-1 mr-2">
                                <span class=" text-dark-50 mr-1 ">বিষয়: </span>
                                <span class="text-dark text-hover-primary">check</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-md-flex align-items-md-start justify-content-md-start flex-wrap">
                        <div class="d-md-flex align-items-center justify-content-start flex-wrap mr-4">
                            <div class="d-flex align-items-center flex-wrap mb-1">
                                <span class=" text-dark-50 mr-1 ">ধরণ: </span>
                                <span class="text-dark text-hover-primary mr-2"><span>অনুচ্ছেদ</span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-block flex-wrap align-self-center">
                    <div class="mb-1 d-flex align-items-md-center justify-content-md-end">
                        <span class="badge alert-light border p-1 m-1"><i class="fas fa-user-edit"></i></span>
                        <span class="badge alert-light border text-purple">---</span>
                        <span class="badge alert-light border text-purple">২০/৫/২১ ১০:৪৩ PM</span>
                    </div>
                    <div class="d-md-flex align-items-center justify-content-end flex-wrap mb-2">
                        <div class="d-flex align-items-center flex-wrap mb-1">
                            <span class=" text-dark-50 mr-1 "></span>
                        </div>
                    </div>
                    <div class="d-md-flex justify-content-end">
                        <div class="dropdown">
                            <button data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-key="2"
                                    class="btn-share-user-list font-size-lg rounded-0 mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                                    type="button" data-original-title="" title="">
                                <i data-toggle="popover" data-content="শেয়ার তালিকা" class="fad fa-share-alt"
                                   data-original-title="" title=""></i>
                            </button>
                            <div class="dropdown-menu share-user-list" aria-labelledby="dropdownMenuLink">

                            </div>
                        </div>
                        <a target="_blank" data-toggle="popover" data-content="এডিটরে দেখুন" href="#"
                           class="text-dark text-hover-primary mb-1 font-size-lg link_review_editor mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                           data-original-title="" title=""><i class="fas fa-file-import"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <h2 class="mt-3 text-warning ml-3">{{ __('লিস্ট স্টাইল ৩') }}</h2>
    <div id="potrojari-group-list-view" class="p-0" style="">
        <div id="accordionTesting">
            <li class="d-flex daak_list_item align-items-start position-relative list-group-item px-0 border-bottom border-top-0 border-left-0 border-right-0 py-0">
                <div class="View nothi-list-item w-100">
                    <div class="d-md-flex align-items-start">
                        <div class="details-control cursor-pointer align-middle">
                            <div class="details-control p-3 cursor-pointer align-middle border-bottom border-right">
                                <div class="" style="padding:0px">
                                </div>
                                <a class="btn btn-lg btn-icon btn-success btn-square potrojari_all" data-value=""
                                   data-toggle="collapse" href="#collapseExample_0" data-target="#collapseExample_0"
                                   aria-expanded="false"><i data-toggle="popover" data-content="সদস্য তালিকা"
                                                            class="fas fa-users" data-original-title=""
                                                            title=""></i></a>
                            </div>
                        </div>
                        <div class="p-3 d-md-flex flex-fill">
                            <div
                                class="d-md-flex align-items-md-start justify-content-md-between w-100 overflow-hidden">
                                <div>
                                    <div class="mb-1 d-md-flex align-items-md-center">
                                        <span class="mx-1 text-purple ">সকল বিভাগীয় কমিশনার</span>
                                    </div>
                                </div>
                                <div>
                                    <span class="badge alert-primary rounded-0">মোট সদস্য:  ৮ </span>
                                </div>
                            </div>
                            <div class="ml-3 mr-2 d-flex align-items-start">
                     <span class="mr-2 badge alert-warning rounded-0">
                     পাবলিক                                                                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap align-items-start w-100">
                        <!---->
                        <div class="d-flex align-items-center justify-content-start w-100 border-top"
                             style="padding:0px">
                        </div>
                        <div class="card rounded-0 border-0 w-100">
                            <div class="collapse potrojari_all_exapnded_view" id="collapseExample_0"
                                 data-parent="#accordionTesting">
                                <div class="d-flex justify-content-between  flex-column">
                                    <div class="card h-100 w-100 p-0 rounded-0">
                                        <div class="card-header p-0">
                                            <div class="d-flex align-item-center justify-content-end shadow-sm">
                                                <div id="only_potrojari_user_list_view_toolbar">
                                                    <div class="d-flex align-items-center justify-content-end w-100">
                                                        <div class="btn-group align-items-center pl-3">
                                                            <span class="mr-2"><span
                                                                    id="item_length_start"></span> - <span
                                                                    id="item_length_end"
                                                                    class="mr-2"></span>সর্বমোট: <span
                                                                    id="item_total_record"></span></span>
                                                            <button id="btn-list-prev"
                                                                    class="btn btn-light btn-list-prev rounded-0"
                                                                    type="button"><span class="fad fa-chevron-left"
                                                                                        data-toggle="popover"
                                                                                        data-content="পূর্ববর্তী"
                                                                                        data-original-title=""
                                                                                        title=""></span></button>
                                                            <button id="btn-list-next"
                                                                    class="btn btn-light btn-list-next rounded-0"
                                                                    type="button"><span class="fad fa-chevron-right"
                                                                                        data-toggle="popover"
                                                                                        data-content="পরবর্তী"
                                                                                        data-original-title=""
                                                                                        title=""></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <div id="potrojari-group-list-view" data-scroll="true" class="h-100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-body user_list_all p-3 rounded-0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </div>
    </div>

    {{--    KT TABLE--}}
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">HTML Table
                    <span class="d-block text-muted pt-2 font-size-sm">Datatable initialized from HTML table</span></h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <div class="dropdown dropdown-inline mr-2">
                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<span class="svg-icon svg-icon-md">
													<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/PenAndRuller.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                         viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none"
                                                           fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24"></rect>
															<path
                                                                d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                                                                fill="#000000" opacity="0.3"></path>
															<path
                                                                d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                                                                fill="#000000"></path>
														</g>
													</svg>
                                                    <!--end::Svg Icon-->
												</span>Export
                    </button>
                    <!--begin::Dropdown Menu-->
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <!--begin::Navigation-->
                        <ul class="navi flex-column navi-hover py-2">
                            <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">
                                Choose an option:
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-print"></i>
																</span>
                                    <span class="navi-text">Print</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-copy"></i>
																</span>
                                    <span class="navi-text">Copy</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-file-excel-o"></i>
																</span>
                                    <span class="navi-text">Excel</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-file-text-o"></i>
																</span>
                                    <span class="navi-text">CSV</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-file-pdf-o"></i>
																</span>
                                    <span class="navi-text">PDF</span>
                                </a>
                            </li>
                        </ul>
                        <!--end::Navigation-->
                    </div>
                    <!--end::Dropdown Menu-->
                </div>
                <!--end::Dropdown-->
                <!--begin::Button-->
                <a href="#" class="btn btn-primary font-weight-bolder">
											<span class="svg-icon svg-icon-md">
												<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/Flatten.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                     viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24"></rect>
														<circle fill="#000000" cx="9" cy="15" r="6"></circle>
														<path
                                                            d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                                            fill="#000000" opacity="0.3"></path>
													</g>
												</svg>
                                                <!--end::Svg Icon-->
											</span>New Record</a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Search Form-->
            <!--begin::Search Form-->
            <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-xl-8">
                        <div class="row align-items-center">
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="Search..."
                                           id="kt_datatable_search_query">
                                    <span>
																	<i class="flaticon2-search-1 text-muted"></i>
																</span>
                                </div>
                            </div>
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <label class="mr-3 mb-0 d-none d-md-block">Status:</label>
                                    <div class="dropdown bootstrap-select form-control">
                                        <select class="form-control" id="kt_datatable_search_status">
                                            <option value="">All</option>
                                            <option value="1">Pending</option>
                                            <option value="2">Delivered</option>
                                            <option value="3">Canceled</option>
                                            <option value="4">Success</option>
                                            <option value="5">Info</option>
                                            <option value="6">Danger</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <label class="mr-3 mb-0 d-none d-md-block">Type:</label>
                                    <div class="dropdown bootstrap-select form-control">
                                        <select class="form-control" id="kt_datatable_search_type">
                                            <option value="">All</option>
                                            <option value="1">Online</option>
                                            <option value="2">Retail</option>
                                            <option value="3">Direct</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                        <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
                    </div>
                </div>
            </div>
            <!--end::Search Form-->
            <!--end: Search Form-->
            <!--begin: Datatable-->
            <div class="datatable datatable-default datatable-bordered datatable-loaded">
                <table class="datatable-bordered datatable-head-custom datatable-table" id="kt_datatable"
                       style="display: block;">
                    <thead class="datatable-head">
                    <tr class="datatable-row" style="left: 0px;">
                        <th data-field="Order ID" class="datatable-cell datatable-cell-sort"><span
                                style="width: 108px;">Order ID</span></th>
                        <th data-field="Car Make" class="datatable-cell datatable-cell-sort"><span
                                style="width: 108px;">Car Make</span></th>
                        <th data-field="Car Model" class="datatable-cell datatable-cell-sort"><span
                                style="width: 108px;">Car Model</span></th>
                        <th data-field="Color" class="datatable-cell datatable-cell-sort"><span style="width: 108px;">Color</span>
                        </th>
                        <th data-field="Deposit Paid" class="datatable-cell datatable-cell-sort"><span
                                style="width: 108px;">Deposit Paid</span></th>
                        <th data-field="Order Date" class="datatable-cell datatable-cell-sort"><span
                                style="width: 108px;">Order Date</span></th>
                        <th data-field="Status" data-autohide-disabled="false"
                            class="datatable-cell datatable-cell-sort"><span style="width: 108px;">Status</span></th>
                        <th data-field="Type" data-autohide-disabled="false" class="datatable-cell datatable-cell-sort">
                            <span style="width: 108px;">Type</span></th>
                    </tr>
                    </thead>
                    <tbody style="" class="datatable-body">
                    <tr data-row="0" class="datatable-row" style="left: 0px;">
                        <td data-field="Order ID" aria-label="0006-3629" class="datatable-cell"><span
                                style="width: 108px;">0006-3629</span></td>
                        <td data-field="Car Make" aria-label="Land Rover" class="datatable-cell"><span
                                style="width: 108px;">Land Rover</span></td>
                        <td data-field="Car Model" aria-label="Range Rover" class="datatable-cell"><span
                                style="width: 108px;">Range Rover</span></td>
                        <td data-field="Color" aria-label="Orange" class="datatable-cell"><span style="width: 108px;">Orange</span>
                        </td>
                        <td data-field="Deposit Paid" aria-label="$22672.60" class="datatable-cell"><span
                                style="width: 108px;">$22672.60</span></td>
                        <td data-field="Order Date" aria-label="2016-11-28" class="datatable-cell"><span
                                style="width: 108px;">2016-11-28</span></td>
                        <td data-field="Status" data-autohide-disabled="false" aria-label="3" class="datatable-cell">
                            <span style="width: 108px;"><span
                                    class="label font-weight-bold label-lg label-light-primary label-inline">Canceled</span></span>
                        </td>
                        <td data-field="Type" data-autohide-disabled="false" aria-label="3" class="datatable-cell"><span
                                style="width: 108px;"><span class="label label-success label-dot mr-2"></span><span
                                    class="font-weight-bold text-success">Direct</span></span></td>
                    </tr>
                    <tr data-row="1" class="datatable-row datatable-row-even" style="left: 0px;">
                        <td data-field="Order ID" aria-label="66403-315" class="datatable-cell"><span
                                style="width: 108px;">66403-315</span></td>
                        <td data-field="Car Make" aria-label="GMC" class="datatable-cell"><span style="width: 108px;">GMC</span>
                        </td>
                        <td data-field="Car Model" aria-label="Jimmy" class="datatable-cell"><span
                                style="width: 108px;">Jimmy</span></td>
                        <td data-field="Color" aria-label="Goldenrod" class="datatable-cell"><span
                                style="width: 108px;">Goldenrod</span></td>
                        <td data-field="Deposit Paid" aria-label="$55141.29" class="datatable-cell"><span
                                style="width: 108px;">$55141.29</span></td>
                        <td data-field="Order Date" aria-label="2017-04-29" class="datatable-cell"><span
                                style="width: 108px;">2017-04-29</span></td>
                        <td data-field="Status" data-autohide-disabled="false" aria-label="3" class="datatable-cell">
                            <span style="width: 108px;"><span
                                    class="label font-weight-bold label-lg label-light-primary label-inline">Canceled</span></span>
                        </td>
                        <td data-field="Type" data-autohide-disabled="false" aria-label="2" class="datatable-cell"><span
                                style="width: 108px;"><span class="label label-primary label-dot mr-2"></span><span
                                    class="font-weight-bold text-primary">Retail</span></span></td>
                    </tr>
                    </tbody>
                </table>
                <div class="datatable-pager datatable-paging-loaded">
                    <ul class="datatable-pager-nav my-2 mb-sm-0">
                        <li><a title="First"
                               class="datatable-pager-link datatable-pager-link-first datatable-pager-link-disabled"
                               data-page="1" disabled="disabled"><i class="flaticon2-fast-back"></i></a></li>
                        <li><a title="Previous"
                               class="datatable-pager-link datatable-pager-link-prev datatable-pager-link-disabled"
                               data-page="1" disabled="disabled"><i class="flaticon2-back"></i></a></li>
                        <li style="display: none;"><input type="text" class="datatable-pager-input form-control"
                                                          title="Page number"></li>
                        <li><a class="datatable-pager-link datatable-pager-link-number datatable-pager-link-active"
                               data-page="1" title="1">1</a></li>
                        <li><a class="datatable-pager-link datatable-pager-link-number" data-page="2" title="2">2</a>
                        </li>
                        <li><a class="datatable-pager-link datatable-pager-link-number" data-page="3" title="3">3</a>
                        </li>
                        <li><a class="datatable-pager-link datatable-pager-link-number" data-page="4" title="4">4</a>
                        </li>
                        <li><a class="datatable-pager-link datatable-pager-link-number" data-page="5" title="5">5</a>
                        </li>
                        <li><a title="Next" class="datatable-pager-link datatable-pager-link-next" data-page="2"><i
                                    class="flaticon2-next"></i></a></li>
                        <li><a title="Last" class="datatable-pager-link datatable-pager-link-last" data-page="15"><i
                                    class="flaticon2-fast-next"></i></a></li>
                    </ul>
                    <div class="datatable-pager-info my-2 mb-sm-0">
                        <div class="dropdown bootstrap-select datatable-pager-size" style="width: 60px;"><select
                                class="selectpicker datatable-pager-size" title="Select page size" data-width="60px"
                                data-container="body" data-selected="10">
                                <option class="bs-title-option" value=""></option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <button type="button" tabindex="-1" class="btn dropdown-toggle btn-light"
                                    data-toggle="dropdown" role="combobox" aria-owns="bs-select-3"
                                    aria-haspopup="listbox" aria-expanded="false" title="Select page size">
                                <div class="filter-option">
                                    <div class="filter-option-inner">
                                        <div class="filter-option-inner-inner">10</div>
                                    </div>
                                </div>
                            </button>
                            <div class="dropdown-menu ">
                                <div class="inner show" role="listbox" id="bs-select-3" tabindex="-1">
                                    <ul class="dropdown-menu inner show" role="presentation"></ul>
                                </div>
                            </div>
                        </div>
                        <span class="datatable-pager-detail">Showing 1 - 10 of 143</span></div>
                </div>
            </div>
            <!--end: Datatable-->
        </div>
    </div>


@endsection
