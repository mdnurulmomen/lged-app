@if(!empty($audit_query_list))
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
                <span class="mr-2"><span id="daak_item_length_start">১</span> - <span id="daak_item_length_end">৫</span> সর্বমোট: <span
                        id="daak_item_total_record">৫</span></span>
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

    {{--list view--}}
    <div>
        <ul class="list-group list-group-flush">
            @foreach($audit_query_list as $query)
                <li class="list-group-item py-2 border-bottom">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="pr-2 flex-fill cursor-pointer position-relative">
                            <div class="row d-md-flex flex-wrap align-items-start justify-content-md-between">
                                <!--begin::Title-->
                                <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3 col-md-8">
                                    <div class="d-flex align-items-center flex-wrap  font-size-1-2">
                                        <span class="mr-1 ">স্মারক নংঃ</span>
                                        <a href="javascript:void(0)" class="text-dark text-hover-primary font-size-h5">
                                            {{$query['memorandum_no']}}
                                        </a>
                                        <span class="ml-2 label label-outline-info label-pill label-inline">
                                            {{strtoupper($query['status'])}}
                                        </span>
                                    </div>
                                    <div class="subject-wrapper font-weight-normal">
                                        <span class="mr-2 font-size-1-1">স্মারক তারিখঃ</span>
                                        <span class="font-size-14">{{enTobn($query['memorandum_date'])}}</span>
                                    </div>
                                    <div class="font-weight-normal">
                                        <span class="mr-2 font-size-1-1">বিষয়ঃ</span>
                                        <span class="description text-info text-wrap font-size-14">
                                            {{$query['subject']}}
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
                                                    <div class="text-dark-75 ml-3 rdate" cspas="date">{{formatDateTime($query['created_at'],'bn')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="action-group d-flex justify-content-end position-absolute action-group-wrapper">
                                            <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                                    title="{{___('generic.buttons.title.details')}}" data-ac-query-id="{{$query['id']}}"
                                                    data-has-sent-to-rpu="{{$query['has_sent_to_rpu']}}"
                                                    onclick="Audit_Query_List_Container.viewQuery($(this))">
                                                <i class="fad fa-eye"></i>
                                            </button>

                                            @if($query['has_sent_to_rpu'] == 0)
                                                <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                                        title="{{___('generic.buttons.title.edit')}}" data-schedule-id="{{$schedule_id}}"
                                                        data-ac-query-id="{{$query['id']}}"
                                                        onclick="Audit_Query_List_Container.editQuery($(this))">
                                                    <i class="fad fa-edit"></i>
                                                </button>
                                            @endif

                                            @if($query['has_sent_to_rpu'] == 0)
                                                <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary
                                                list-btn-toggle" title="প্রেরণ করুন" data-ac-query-id="{{$query['id']}}"
                                                        data-audit-plan-id="{{$query['audit_plan_id']}}"
                                                        data-entity-id="{{$query['entity_office_id']}}"
                                                        data-cost-center-id="{{$query['cost_center_id']}}"
                                                        onclick="Audit_Query_List_Container.sendQueryToRpu($(this))">
                                                    <i class="fad fa-paper-plane"></i>
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

    <script>
        var Audit_Query_List_Container = {
            editQuery: function (elem) {
                ac_query_id = elem.data('ac-query-id');
                schedule_id = elem.data('schedule-id');
                data = {ac_query_id, schedule_id};
                url = '{{route('audit.execution.query.edit')}}';

                KTApp.block('#kt_content', {
                    opacity: 0.1,
                    state: 'primary' // a bootstrap color
                });

                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    KTApp.unblock('#kt_content');
                    if (response.status === 'error') {
                        toastr.error(response.data)
                    } else {
                        $('#kt_content').html(response)
                    }
                });
            },

            viewQuery: function (elem) {
                scope_authority = 0;
                ac_query_id = elem.data('ac-query-id');
                has_sent_to_rpu = elem.data('has-sent-to-rpu');

                data = {scope_authority, ac_query_id, has_sent_to_rpu};
                url = '{{route('audit.execution.query.view')}}';

                KTApp.block('#kt_content', {
                    opacity: 0.1,
                    state: 'primary' // a bootstrap color
                });

                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    KTApp.unblock('#kt_content');
                    if (response.status === 'error') {
                        toastr.error('No data found');
                    } else {
                        $(".offcanvas-title").text('কোয়েরি শিটের বিস্তারিত');
                        quick_panel = $("#kt_quick_panel");
                        quick_panel.addClass('offcanvas-on');
                        quick_panel.css('opacity', 1);
                        quick_panel.css('width', '40%');
                        quick_panel.removeClass('d-none');
                        $("html").addClass("side-panel-overlay");
                        $(".offcanvas-wrapper").html(response);
                    }
                });
            },

            sendQueryToRpu: function (elem) {
                ac_query_id = elem.data('ac-query-id');
                cost_center_id = elem.attr('data-cost-center-id')
                data = {ac_query_id, cost_center_id};
                url = '{{route('audit.execution.query.send-to-rpu')}}';

                KTApp.block('#kt_content', {
                    opacity: 0.1,
                    state: 'primary' // a bootstrap color
                });

                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    KTApp.unblock('#kt_content');
                    if (response.status === 'error') {
                        toastr.error(response.data)
                    } else {
                        toastr.success(response.data)

                        KTApp.block('#kt_content', {
                            opacity: 0.1,
                            state: 'primary' // a bootstrap color
                        });
                        schedule_id = '{{$schedule_id}}';
                        audit_plan_id = elem.data('audit-plan-id');
                        entity_id = elem.data('entity-id');
                        cost_center_id = elem.data('cost-center-id');
                        url = '{{route('audit.execution.query.load-list')}}';
                        data = {audit_plan_id,schedule_id,entity_id,cost_center_id};
                        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                            KTApp.unblock('#kt_content');
                            if (response.status === 'error') {
                                toastr.warning(response.data)
                            } else {
                                $('#load_query_list').html(response);
                            }
                        })
                    }
                })
            },
        }
    </script>

@else
    <div class="alert alert-custom alert-light-primary fade show mb-5" role="alert">
        <div class="alert-icon">
            <i class="flaticon-warning"></i>
        </div>
        <div class="alert-text">{{___('generic.no_data_found')}}</div>
    </div>
@endif




