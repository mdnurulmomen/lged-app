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

    <div class="col-md-12">
        <div class="toolbar flex-wrap justify-content-between shadow-sm pl-1 d-flex border-bottom">
            <div class="d-flex">
                <div id="daak_group_action_panel">
                </div>
            </div>
            <div id="daak_pagination_panel" class="float-right d-flex align-items-center"
                 style="vertical-align:middle;">
            <span class="mr-2"><span id="daak_item_length_start">১</span> - <span id="daak_item_length_end">৫</span> সর্বমোট: <span
                    id="daak_item_total_record">৫</span></span>
                <div class="btn-group">
                    <button class="btn-list-prev btn btn-icon btn-secondary btn-square" disabled="disabled"
                            type="button"><i
                            class="fad fa-chevron-left" data-toggle="popover" data-content="পূর্ববর্তী"
                            data-original-title="" title=""></i></button>
                    <button class="btn-list-next btn btn-icon btn-secondary btn-square" type="button"
                            disabled="disabled"><i
                            class="fad fa-chevron-right" data-toggle="popover" data-content="পরবর্তী"
                            data-original-title=""
                            title=""></i></button>
                </div>
            </div>
        </div>
        @foreach($audit_query_schedule_list as $key=> $schedule)
            <div class="">
                <ul class="list-group list-group-flush">
                    <li id="daak_container_inbox_1_54_Daptorik"
                        class="daak_list_item list-group-item pl-0 py-2 border-bottom">
                        <div class="d-flex justify-content-between align-items-start">
                   <span class="input-group-text bg-transparent border-0" data-toggle="popover"
                         data-content="ডাক বাছাই করুন" data-original-title="" title="">
                   </span>
                            <div
                                class="pr-2 flex-fill daak_list_item_clickable_area cursor-pointer position-relative"
                                did="daak_container_inbox_1_54_Daptorik">
                                <div class="row d-md-flex flex-wrap align-items-start justify-content-md-between">
                                    <!--begin::Title-->
                                    <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3 col-md-6">
                                        <div class="d-flex align-items-center flex-wrap  font-size-1-2"><span
                                                class="mr-1 "></span><a href="javascript:void(0)"
                                                                        class=" text-dark text-hover-primary font-size-h5"
                                                                        data-toggle="popover" data-html="true"
                                                                        data-content="উৎস : বোরহান উদ্দিন, <br/>( এডমিন স্পেশালিস্ট , এডমিন, এসপায়ার টু ইনোভেট (এটু্আই) প্রোগ্রাম)<br></a>মূল-প্রাপক: এ টি এম আল ফাত্তাহ,<br /> ( ন্যাশনাল কনসালটেন্ট, ই-সার্ভিস, এসপায়ার টু ইনোভেট (এটু্আই) প্রোগ্রাম )<br/>"
                                                                        data-original-title=""
                                                                        title="">{{$schedule['cost_center_name_bn']}}
                                                @php
                                                    $toDay = date('Y-m-d');
                                                    $toDay=date('Y-m-d', strtotime($toDay));
                                                    //echo $paymentDate; // echos today!
                                                    $startDate = date('Y-m-d', strtotime($schedule['team_member_start_date']));
                                                    $endDate = date('Y-m-d', strtotime($schedule['team_member_end_date']));
                                                @endphp
                                                @if (($toDay >= $startDate) && ($toDay <= $endDate))
                                                    <span class="badge badge-pill badge-info border font-weight-bold mr-1 shadow">
                                                        <span class="en_to_bn_text text-light text-uppercase">Continue</span>
                                                    </span>
                                                @endif

                                            </a>
                                        </div>
                                        <div class=" subject-wrapper font-weight-normal font-weight-normal">
                                            <span class="mr-2 font-size-1-1">নাম:</span>
                                            <span
                                                class="description text-wrap font-size-14">{{$schedule['team_member_name_bn']}}</span>
                                        </div>
                                        <div class=" subject-wrapper font-weight-normal font-weight-normal">
                                            <span class="mr-2 font-size-1-1">তারিখ:</span>
                                            <span class="description text-wrap font-size-14"> {{formatDate($schedule['team_member_start_date'],'bn')}} - {{formatDate($schedule['team_member_end_date'],'bn')}}</span>
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
                                    <div
                                        class="d-flex align-items-center justify-content-md-end py-lg-0 py-2 col-md-6">
                                        <div class="d-block">
                                            <div class="d-flex align-items-center justify-content-md-end">
                                                <div class="btn-group folder-wrapper mb-2 mt-3 mr-3">
                                                    <button onclick="auditQuerySchedule.selectQuery()" type="button" class="btn btn-sm rounded-0 alert-warning  folder_click">
                                                        Query
                                                    </button>
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
        @endforeach
    </div>

</div>
