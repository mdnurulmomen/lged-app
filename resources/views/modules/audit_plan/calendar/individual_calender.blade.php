    <div style="display: none" class="search-all position-relative">
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

    <div class="row pt-5">
        <div class="col-md-7">
            <div class="toolbar flex-wrap justify-content-between shadow-sm pl-1 d-flex border-bottom">
        <div class="d-flex">
            <div id="daak_group_action_panel">
{{--                <div class="d-flex flex-wrap">--}}
{{--                    <div class="btn-group">--}}
{{--               <span class="input-group-text bg-transparent border-0 inbox_checkbox" data-toggle="popover"--}}
{{--                     data-title="সকল ডাক বাছাই করুন" data-original-title="" title="">--}}
{{--               <label class="checkbox checkbox-outline" id="alabel_checkbox_daak_item_toolbox"--}}
{{--                      for="checkbox_daak_item_toolbox">--}}
{{--               <input type="checkbox" id="checkbox_daak_item_toolbox" name="checkbox_daak_item_toolbox">--}}
{{--               <span></span>--}}
{{--               </label>--}}
{{--               </span>--}}
{{--                        <div class="dropdown bootstrap-select form-control">--}}
{{--                            <button type="button" tabindex="-1" class="btn dropdown-toggle btn-light border-0"--}}
{{--                                    data-toggle="dropdown" role="combobox" aria-owns="bs-select-1"--}}
{{--                                    aria-haspopup="listbox" aria-expanded="false" data-id="daak_status_selectpicker"--}}
{{--                                    title="সকল">--}}
{{--                                <div class="filter-option">--}}
{{--                                    <div class="filter-option-inner">--}}
{{--                                        <div class="filter-option-inner-inner">সকল</div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </button>--}}
{{--                            <div class="dropdown-menu " style="max-height: 406px; overflow: hidden; min-height: 118px;">--}}
{{--                                <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1"--}}
{{--                                     aria-activedescendant="bs-select-1-0"--}}
{{--                                     style="max-height: 406px; overflow-y: auto; min-height: 118px;">--}}
{{--                                    <ul class="dropdown-menu inner show" role="presentation"--}}
{{--                                        style="margin-top: 0px; margin-bottom: 0px;">--}}
{{--                                        <li class="selected active"><a role="option"--}}
{{--                                                                       class="dropdown-item active selected"--}}
{{--                                                                       id="bs-select-1-0" tabindex="0" aria-setsize="5"--}}
{{--                                                                       aria-posinset="1" aria-selected="true"><span--}}
{{--                                                    class="text">সকল</span></a></li>--}}
{{--                                        <li><a role="option" class="dropdown-item" id="bs-select-1-1" tabindex="0"><span--}}
{{--                                                    class="text">অপঠিত</span></a></li>--}}
{{--                                        <li><a role="option" class="dropdown-item" id="bs-select-1-2" tabindex="0"><span--}}
{{--                                                    class="text">পঠিত</span></a></li>--}}
{{--                                        <li><a role="option" class="dropdown-item" id="bs-select-1-3" tabindex="0"><span--}}
{{--                                                    class="text">মূল-প্রাপক</span></a></li>--}}
{{--                                        <li><a role="option" class="dropdown-item" id="bs-select-1-4" tabindex="0"><span--}}
{{--                                                    class="text">অনুলিপি</span></a></li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <button id="btn-daak-toolbar-reset" class="btn btn-icon mx-1" type="button" data-toggle="tooltip"--}}
{{--                            title="রিসেট">--}}
{{--                        <span class="fas fa-recycle text-warning"></span>--}}
{{--                    </button>--}}
{{--                    <button id="btn-daak-toolbar-refresh" class="btn btn-icon mx-1" type="button" data-toggle="tooltip"--}}
{{--                            title="রিফ্রেশ">--}}
{{--                        <span class="fa fa-sync text-info"></span>--}}
{{--                    </button>--}}
{{--                    <div class="">--}}
{{--                        <button type="button" class="btn btn-icon btn-daak-sort" data-toggle="tooltip"--}}
{{--                                title="ডাক বক্স শেয়ারিং">--}}
{{--                            <i class="fas fa-share-alt text-success"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="d-none" id="daak-toolbar">--}}
{{--                        <div class="d-flex btn-daak-group bg-transparent">--}}
{{--                            <button class="btn btn-icon mx-1 daak-seal-forward" type="button" data-toggle="tooltip"--}}
{{--                                    title="ডাক প্রেরণ করুন">--}}
{{--                                <span class="fad fa-share text-info"></span>--}}
{{--                            </button>--}}
{{--                            <button class="btn btn-icon mx-1 btn-nothivukto-selected" type="button"--}}
{{--                                    data-toggle="tooltip" title="নথিতে উপস্থাপন">--}}
{{--                                <i class="fad fa-books text-warning"></i>--}}
{{--                            </button>--}}
{{--                            <button class="btn btn-icon mx-1 btn-nothijato-selected" type="button" data-toggle="tooltip"--}}
{{--                                    title="নথিজাত">--}}
{{--                                <i class="fal fa-folder-open text-primary"></i>--}}
{{--                            </button>--}}
{{--                            <button class="btn btn-icon mx-1 btn-archive-selected" type="button" data-toggle="tooltip"--}}
{{--                                    title="আর্কাইভ">--}}
{{--                                <i class="fa fa-archive text-success"></i>--}}
{{--                            </button>--}}
{{--                            <button id="btn-daak-toolbar-draft-send" class="btn btn-icon mx-1" type="button"--}}
{{--                                    data-toggle="tooltip" title="বাছাইকৃত ডাক প্রেরণ">--}}
{{--                                <span class="fas fa-share text-success"></span>--}}
{{--                            </button>--}}
{{--                            <button id="btn-daak-toolbar-dak-drafting" class="btn btn-icon mx-1 daak-seal-forward"--}}
{{--                                    type="button" data-toggle="tooltip" title="ডাক  সর্টিং">--}}
{{--                                <span class="fas fa-share text-success"></span>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="dropdown">--}}
{{--                        <button class="btn" type="button" id="titleFilter" data-toggle="dropdown" aria-haspopup="true"--}}
{{--                                aria-expanded="false">--}}
{{--                            <i data-toggle="popover" data-content="তথ্য গোপন / প্রদর্শন" data-placement="top"--}}
{{--                               class="fal fa-eye text-dark-100" data-original-title="" title=""></i>--}}
{{--                        </button>--}}
{{--                        <div class="dropdown-menu" aria-labelledby="filter" id="filterDropdown">--}}
{{--                            <div class="checkbox-inline dropdown-item">--}}
{{--                                <label class="checkbox showHidecheckBox">--}}
{{--                                    <input type="checkbox" name="filter[]" value="filterPerok" checked="">--}}
{{--                                    <span></span>প্রেরক</label>--}}
{{--                            </div>--}}
{{--                            <div class="checkbox-inline dropdown-item">--}}
{{--                                <label class="checkbox showHidecheckBox">--}}
{{--                                    <input type="checkbox" name="filter[]" value="filterMulPerok" checked="">--}}
{{--                                    <span></span>মূল প্রাপক</label>--}}
{{--                            </div>--}}
{{--                            <div class="checkbox-inline dropdown-item">--}}
{{--                                <label class="checkbox showHidecheckBox">--}}
{{--                                    <input type="checkbox" name="filter[]" value="filterBisoy" checked="">--}}
{{--                                    <span></span>বিষয়</label>--}}
{{--                            </div>--}}
{{--                            <div class="checkbox-inline dropdown-item">--}}
{{--                                <label class="checkbox showHidecheckBox">--}}
{{--                                    <input type="checkbox" name="filter[]" value="filterSiddhanto" checked="">--}}
{{--                                    <span></span>সিদ্ধান্ত</label>--}}
{{--                            </div>--}}
{{--                            <div class="checkbox-inline dropdown-item">--}}
{{--                                <label class="checkbox showHidecheckBox">--}}
{{--                                    <input type="checkbox" name="filter[]" value="filterSongjukto" checked="">--}}
{{--                                    <span></span>সংযুক্তি এবং তারিখ</label>--}}
{{--                            </div>--}}
{{--                            <div class="checkbox-inline dropdown-item">--}}
{{--                                <label class="checkbox showHidecheckBox">--}}
{{--                                    <input type="checkbox" name="filter[]" value="filterPersonalFolder" checked="">--}}
{{--                                    <span></span>ফোল্ডার</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <button class="btn-digital-postbox mr-1 btn btn-icon btn-square btn-sm btn-icon-primary py-5"--}}
{{--                            type="button">--}}
{{--                        <i class="fa fa-envelope" data-toggle="popover" data-content="ডিজিটাল পোস্টবক্স"--}}
{{--                           data-original-title="" title=""></i>--}}
{{--                    </button>--}}
{{--                    <div id="personal_folder_selected_name" class="p-2 d-none">--}}
{{--                    </div>--}}
{{--                </div>--}}
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
            @foreach($calendar_data as $datum)
           @if($datum['status'] == 'done')
               <div class="">
            <ul class="list-group list-group-flush">
                <li id="daak_container_inbox_1_54_Daptorik" class="daak_list_item list-group-item pl-0 py-2 border-bottom">
                    <div class="d-flex justify-content-between align-items-start">
                   <span class="input-group-text bg-transparent border-0" data-toggle="popover"
                         data-content="ডাক বাছাই করুন" data-original-title="" title="">
{{--                      <label class="checkbox checkbox-outline">--}}
{{--                            <input data-draft-decisions="" type="checkbox"--}}
{{--                                   name="daak_container_inbox_daak_list_item_checkbox" data-attention="0"--}}
{{--                                   class="daak_container_inbox_daak_list_item_checkbox">--}}
{{--                            <span></span>--}}
{{--                      </label>--}}
                   </span>
                        <div class="pr-2 flex-fill daak_list_item_clickable_area cursor-pointer position-relative"
                             did="daak_container_inbox_1_54_Daptorik">
                            <div class="row d-md-flex flex-wrap align-items-start justify-content-md-between">
                                <!--begin::Title-->
                                <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3 col-md-6">
                                    <div class="d-flex align-items-center flex-wrap  font-size-1-2"><span
                                            class="mr-1 "></span>
                                        <a href="javascript:void(0)" class="text-primary font-size-h6">
                                            {{$datum['schedule_type'] == 'schedule'?$datum['cost_center_name_bn']:$datum['activity_location']}}
                                        </a>
                                    </div>
                                    <div class=" subject-wrapper font-weight-normal font-weight-normal">
                                        <span class="mr-2 font-size-1-1">নাম:</span>
                                        <span class="description text-wrap font-size-14">{{$datum['team_member_name_bn']}}</span>
                                    </div>
                                    <div class=" subject-wrapper font-weight-normal font-weight-normal">
                                        <span class="mr-2 font-size-1-1">তারিখ:</span>
                                        <span class="description text-wrap font-size-14">{{formatDate($datum['team_member_start_date'],'bn')}} - {{formatDate($datum['team_member_end_date'],'bn')}}</span>
                                    </div>
{{--                                    <div class=" subject-wrapper font-weight-normal font-weight-normal">--}}
{{--                                        <span class="mr-2 font-size-1-1">মন্তব্য:</span>--}}
{{--                                        <span class="description text-wrap font-size-14">{{$datum['team_member_activity_description']}}</span>--}}
{{--                                    </div>--}}
                                    <div class=" font-weight-normal d-none predict-wrapper">
                                        <span class="predict-label text-success "></span>
                                    </div>
                                </div>
                                <!--end::Title-->
                                <!--begin::Info-->
                                <div class="d-flex align-items-center justify-content-md-end py-lg-0 py-2 col-md-6">
                                    <div class="d-block">
                                        <div class="d-flex align-items-center justify-content-md-end">
                                            <div class="btn-group folder-wrapper mb-2 mt-3 mr-3">
                                                <button type="button"
                                                        class="btn btn-sm rounded-0 alert-warning  folder_click">{{$datum['status']}}
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
                                                        @foreach(config('cag_amms_config.visit_calendar_status') as $value)
                                                            <span onclick="calenderFunctions.updateVisitCalenderStatus('{{$datum['id']}}','{{$value}}')" class="dropdown-item">{{strtoupper($value)}}</span>
                                                        @endforeach
                                                    </div>

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
            </ul>
        </div>
           @endif

       @endforeach
        </div>
        <div class="col-md-5">
            <div class="toolbar flex-wrap justify-content-between shadow-sm pl-1 d-flex border-bottom">
                <h2>অনিষ্পন্ন তালিকা</h2>
            </div>

            @foreach($calendar_data as $datum)
               @if($datum['status'] != 'done')
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li id="daak_container_inbox_1_54_Daptorik" class="daak_list_item list-group-item pl-0 py-2 border-bottom">
                                <div class="d-flex justify-content-between align-items-start">
                               <span class="input-group-text bg-transparent border-0" data-toggle="popover"
                                     data-content="ডাক বাছাই করুন" data-original-title="" title="">
{{--                                  <label class="checkbox checkbox-outline">--}}
{{--                                        <input data-draft-decisions="" type="checkbox"--}}
{{--                                               name="daak_container_inbox_daak_list_item_checkbox" data-attention="0"--}}
{{--                                               class="daak_container_inbox_daak_list_item_checkbox">--}}
{{--                                        <span></span>--}}
{{--                                  </label>--}}
                               </span>
                                    <span></span>
                                    <div class="pr-2 flex-fill daak_list_item_clickable_area cursor-pointer position-relative"
                                         did="daak_container_inbox_1_54_Daptorik">
                                        <div class="row d-md-flex flex-wrap align-items-start justify-content-md-between">
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3 col-md-6">
                                                <div class="d-flex align-items-center flex-wrap  font-size-1-2">
                                                    <span class="mr-1 "></span>
                                                    <a href="javascript:void(0)" class="text-primary font-size-h6">{{$datum['schedule_type'] == 'schedule'?$datum['cost_center_name_bn']:$datum['activity_location']}}</a>
                                                </div>
                                                <div class=" subject-wrapper font-weight-normal font-weight-normal">
                                                    <span class="mr-2 font-size-1-1">নাম:</span>
                                                    <span
                                                        class="description text-wrap font-size-14">{{$datum['team_member_name_bn']}}</span>
                                                </div>
                                                <div class=" subject-wrapper font-weight-normal font-weight-normal">
                                                    <span class="mr-2 font-size-1-1">তারিখ:</span>
                                                    <span class="description text-wrap font-size-14">{{formatDate($datum['team_member_start_date'],'bn')}} - {{formatDate($datum['team_member_end_date'],'bn')}}</span>
                                                </div>
                                                <div class=" font-weight-normal d-none predict-wrapper">
                                                    <span class="predict-label text-success "></span>
                                                </div>
                                            </div>
                                            <!--end::Title-->
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center justify-content-md-end py-lg-0 py-2 col-md-6">
                                                <div class="d-block">
                                                    <div class="d-flex align-items-center justify-content-md-end">
                                                        <div class="btn-group folder-wrapper mb-2 mt-3 mr-3">
                                                            <button type="button"
                                                                    class="btn btn-sm rounded-0 alert-warning  folder_click">{{$datum['status']}}
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
                                                                    @foreach(config('cag_amms_config.visit_calendar_status') as $value)
                                                                        <span onclick="calenderFunctions.updateVisitCalenderStatus('{{$datum['id']}}','{{$value}}')" class="dropdown-item">{{strtoupper($value)}}</span>
                                                                    @endforeach
                                                                </div>
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
                        </ul>
                    </div>
               @endif
            @endforeach
        </div>
    </div>

    <script>

    var calenderFunctions = {
        updateVisitCalenderStatus: function (schedule_id,status) {
            url = '{{route('calendar.update-visit-calender-status')}}';
            data = {schedule_id, status};
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {
                    $('.fc-calendarListButton-button').trigger('click');
                    toastr.success(response.data);
                } else {
                    toastr.error(response.data);
                    console.log(response)
                }
            })
        }
    }
</script>
