@if(!empty($pacMeetingList['data']))
    <div class="search-all position-relative">
        <div class="row">
            <div class="col align-self-start">
                <div class="input-group-append">
                    <button class="btn btn-icon btn-light-info btn-square advanced_button" type="button"><i
                            class="fa fa-caret-down"></i>
                    </button>
                    <input type="text" placeholder="{{___('generic.placeholders.search')}}" class="form-control rounded-0">
                    <button data-toggle="tooltip" data-placement="left" title="{{___('generic.buttons.title.search')}}"
                            class="btn btn-icon btn-light-success btn-square" type="button">
                        <i class="fad fa-search"></i>
                    </button>
                    <button data-toggle="tooltip" data-placement="left" title="{{___('generic.buttons.title.reset')}}"
                            class="btn btn-icon btn-light-danger btn-square" id="reset_btn" type="reset">
                        <i class="fad fa-recycle"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="toolbar flex-wrap justify-content-between shadow-sm p-0 d-flex border-bottom">
        <div class="d-flex">
            <div id="daak_group_action_panel">
                <div class="d-flex flex-wrap">
{{--                    <div class="btn-group">--}}
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
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <button id="btn-daak-toolbar-reset" class="btn btn-icon mx-1" type="button" data-toggle="tooltip"
                            title="{{___('generic.buttons.title.reset')}}">
                        <span class="fas fa-recycle text-warning"></span>
                    </button>
                    <button id="btn-daak-toolbar-refresh" class="btn btn-icon mx-1" type="button" data-toggle="tooltip"
                            title="{{___('generic.buttons.title.refresh')}}">
                        <span class="fa fa-sync text-info"></span>
                    </button>
                    <div id="personal_folder_selected_name" class="p-2 d-none">
                    </div>
                </div>
            </div>
        </div>
        <div id="daak_pagination_panel" class="float-right d-flex align-items-center" style="vertical-align:middle;">
                <span class="mr-2"><span id="daak_item_length_start">১</span> - <span id="daak_item_length_end">
                        {{enTobn(count($pacMeetingList['data']))}}
                    </span> সর্বমোট: <span
                        id="daak_item_total_record">
                        {{enTobn(count($pacMeetingList['data']))}}
                    </span></span>
            <div class="btn-group">
                <button class="btn-list-prev btn btn-icon btn-secondary btn-square" disabled="disabled" type="button"><i
                        class="fad fa-chevron-left" data-toggle="popover"
                        data-original-title="" title="পূর্ববর্তী"></i></button>
                <button class="btn-list-next btn btn-icon btn-secondary btn-square" type="button" disabled="disabled"><i
                        class="fad fa-chevron-right" data-toggle="popover" data-original-title=""
                        title="পরবর্তী"></i></button>
            </div>
        </div>
    </div>

    <div>
        <ul class="list-group list-group-flush">
            @foreach($pacMeetingList['data'] as $meeting)
                <li class="list-group-item pl-2 py-2 border-bottom">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="pr-2 flex-fill cursor-pointer position-relative">
                            <div class="row d-md-flex flex-wrap align-items-start justify-content-md-between">
                                <!--begin::Title-->
                                <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3 col-md-8">
                                    <div class="d-flex align-items-center flex-wrap  font-size-1-2">
                                        <span class="mr-1 ">বৈঠক নংঃ</span>
                                        {{$meeting['meeting_no']}}
                                    </div>
                                    <div class="subject-wrapper font-weight-normal">
                                        <span class="mr-2 font-size-1-1">তারিখঃ</span>
                                        <span class="description text-info text-wrap font-size-14">
                                             {{formatDate($meeting['meeting_date'],'bn')}}
                                        </span>
                                    </div>
                                    <div class="subject-wrapper font-weight-normal">
                                        <span class="mr-2 font-size-1-1">সংসদ নংঃ</span>
                                        <span class="description text-info text-wrap font-size-14">{{$meeting['parliament_no']}}</span>
                                    </div>
                                    <div class="subject-wrapper font-weight-normal">
                                        <span class="mr-2 font-size-1-1">স্থানঃ</span>
                                        <span class="description text-info text-wrap font-size-14">{{$meeting['meeting_place']}}</span>
                                    </div>
                                    <div class="font-weight-normal d-none predict-wrapper">
                                        <span class="predict-label text-success"></span>
                                    </div>

                                    @if($meeting['is_sent_pac'])
                                        <div class="subject-wrapper font-weight-normal mt-2">
                                            <button
                                                    class="badge-square rounded-0 badge d-flex align-items-center alert-success
                                           font-weight-normal mr-1 border decision">
                                                প্রেরণ করা হয়েছে
                                            </button>
                                        </div>
                                    @endif

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
                                                    <div class="text-dark-75 ml-3 rdate" cspas="date">
                                                        {{formatDateTime($meeting['created_at'],'bn')}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="action-group d-flex justify-content-end position-absolute action-group-wrapper">

                                            @if($type == 'meeting')
                                                <button class="mr-1 btn btn-sm btn-primary btn-square"
                                                        title="{{___('generic.buttons.title.details')}}"
                                                        data-pac-meeting-id="{{$meeting['id']}}"
                                                        onclick="Pac_Container.showPacMeeting($(this))">
                                                    বিস্তারিত
                                                </button>
                                                <button class="mr-1 btn btn-sm btn-primary btn-square"
                                                        title="{{___('generic.buttons.title.details')}}"
                                                        data-pac-meeting-id="{{$meeting['id']}}"
                                                        onclick="Pac_Container.cagAndDirectorateDecision($(this))">
                                                    সিদ্ধান্ত
                                                </button>
                                                @if(!$meeting['is_sent_pac'])
                                                    <button
                                                        class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                                        title="প্রেরণ করুন"
                                                        data-pac-meeting-id="{{$meeting['id']}}"
                                                        onclick="Pac_Container.sentToPac($(this))">
                                                        <i class="fa fa-paper-plane"></i>
                                                    </button>
                                                @endif
                                            @endif

                                            @if($type == 'worksheet')
                                                <button class="mr-1 btn btn-sm btn-primary btn-square"
                                                        title="রিপোর্ট তৈরি করুন"
                                                        data-pac-meeting-id="{{$meeting['id']}}"
                                                        data-directorate-id="{{$meeting['directorate_id']}}"
                                                        data-meeting-no="{{$meeting['meeting_no']}}"
                                                        data-parliament-no="{{$meeting['parliament_no']}}"
                                                        data-meeting-date="{{$meeting['meeting_date']}}"
                                                        data-meeting-place="{{$meeting['meeting_place']}}"
                                                        onclick="Pac_Container.createPacWorksheetReport($(this))">
                                                    কার্যপত্র
                                                </button>
                                            @endif

                                            @if($type == 'minutes')
                                                <button class="mr-1 btn btn-sm btn-primary btn-square"
                                                        title="{{___('generic.buttons.title.details')}}"
                                                        data-pac-meeting-id="{{$meeting['id']}}"
                                                        onclick="Pac_Container.showPacMeetingMinutes($(this))">
                                                    কার্যবিবরণী
                                                </button>
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
@else
    <div class="alert alert-custom alert-light-primary fade show mb-5" role="alert">
        <div class="alert-icon">
            <i class="flaticon-warning"></i>
        </div>
        <div class="alert-text">{{___('generic.no_data_found')}}</div>
    </div>
@endif

