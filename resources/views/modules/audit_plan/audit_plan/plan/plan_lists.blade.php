<div class="search-all position-relative">
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
                            <div class="d-flex align-items-center flex-wrap  font-size-1-2">
                                <a href="javascript:void(0)"
                                   class=" text-dark text-hover-primary font-size-h5"
                                   data-toggle="popover" data-html="true"
                                   data-content=""
                                   data-original-title="" title="">জনপ্রশাসন মন্ত্রণালয় এবং এর নিয়ন্ত্রনাধীন
                                    প্রতিষ্ঠানসমূহের মঞ্জুরি ও বরাদ্দ ভিত্তিক এনটিটি ওয়াইড নির্দিষ্টকরণ ও নিয়মানুগ
                                    নিরীক্ষা।</a>
                            </div>
                            <div class=" font-weight-normal d-md-flex flex-wrap">
                                <div class="font-size-1-1">
                                    <span
                                        class="perok-wrapper sender_name" data-toggle="popover"
                                        data-content="প্রোগ্রাম এসোসিয়েট, টেকনোলজি, এসপায়ার টু ইনোভেট (এটু্আই) প্রোগ্রাম"
                                        data-original-title="" title="">অর্থবছরঃ ২০১৮-২০১৯, নিরীক্ষা বছরঃ ২০১৯-২০২০
                                    </span>
                                </div>
                            </div>
                            <div class=" subject-wrapper font-weight-normal font-weight-normal">
                                <span class="mr-2 font-size-1-1">মঞ্জুরী নং:</span>
                                <span class="description text-wrap font-size-14">০৫</span>
                            </div>
                            <div class=" font-weight-normal siddhanto-wrapper">
                                <span class="mr-2 font-size-1-1">সিদ্ধান্ত:</span>
                                <span class="text-info font-size-14">নিরীক্ষা পরিকল্পনা জনাব নাম-এর নেতৃত্বে ১ অক্টোবর ২০২১ হতে ১৫ অক্টোবর ২০২১ পর্যন্ত</span>
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
                            <div class="d-flex align-items-center flex-wrap  font-size-1-2">
                                <a href="javascript:void(0)"
                                   class=" text-dark text-hover-primary font-size-h5"
                                   data-toggle="popover" data-html="true"
                                   data-content=""
                                   data-original-title="" title="">যুব ও ক্রীড়া মন্ত্রণালয় মঞ্জুরী ও বরাদ্দভিত্তিক নির্দিষ্টকরণ নিরীক্ষা</a>
                            </div>
                            <div class=" font-weight-normal d-md-flex flex-wrap">
                                <div class="font-size-1-1">
                                    <span
                                        class="perok-wrapper sender_name" data-toggle="popover"
                                        data-content="প্রোগ্রাম এসোসিয়েট, টেকনোলজি, এসপায়ার টু ইনোভেট (এটু্আই) প্রোগ্রাম"
                                        data-original-title="" title="">অর্থবছরঃ ২০১৮-২০১৯, নিরীক্ষা বছরঃ ২০১৯-২০২০
                                    </span>
                                </div>
                            </div>
                            <div class=" subject-wrapper font-weight-normal font-weight-normal">
                                <span class="mr-2 font-size-1-1">মঞ্জুরী নং:</span>
                                <span class="description text-wrap font-size-14">৩৩</span>
                            </div>
                            <div class=" font-weight-normal siddhanto-wrapper">
                                <span class="mr-2 font-size-1-1">সিদ্ধান্ত:</span>
                                <span class="text-info font-size-14">নিরীক্ষা পরিকল্পনা জনাব নাম-এর নেতৃত্বে ১ অক্টোবর ২০২১ হতে ১৫ অক্টোবর ২০২১ পর্যন্ত</span>
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
                            <div class="d-flex align-items-center flex-wrap  font-size-1-2">
                                <a href="javascript:void(0)"
                                   class=" text-dark text-hover-primary font-size-h5"
                                   data-toggle="popover" data-html="true"
                                   data-content=""
                                   data-original-title="" title="">২০১৮-২০১৯ অর্থ বছরের স্বাস্থ‍্য শিক্ষা ও পরিবার কল‍্যাণ বিভাগ, স্বাস্থ‍্য ও পরিবার কল‍্যাণ মন্ত্রণালয় ও এর অধীনস্থ কার্যালয়সমূহের মঞ্জুরী ও বরাদ্দ ভিত্তিক নির্দিষ্টকরণ ও নিয়মানুগ নিরীক্ষা</a>
                            </div>
                            <div class=" font-weight-normal d-md-flex flex-wrap">
                                <div class="font-size-1-1">
                                    <span
                                        class="perok-wrapper sender_name" data-toggle="popover"
                                        data-content="প্রোগ্রাম এসোসিয়েট, টেকনোলজি, এসপায়ার টু ইনোভেট (এটু্আই) প্রোগ্রাম"
                                        data-original-title="" title="">অর্থবছরঃ ২০১৮-২০১৯, নিরীক্ষা বছরঃ ২০১৯-২০২০
                                    </span>
                                </div>
                            </div>
                            <div class=" subject-wrapper font-weight-normal font-weight-normal">
                                <span class="mr-2 font-size-1-1">মঞ্জুরী নং:</span>
                                <span class="description text-wrap font-size-14">৫৯</span>
                            </div>
                            <div class=" font-weight-normal siddhanto-wrapper">
                                <span class="mr-2 font-size-1-1">সিদ্ধান্ত:</span>
                                <span class="text-info font-size-14">নিরীক্ষা পরিকল্পনা জনাব নাম-এর নেতৃত্বে ১ অক্টোবর ২০২১ হতে ১৫ অক্টোবর ২০২১ পর্যন্ত</span>
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
