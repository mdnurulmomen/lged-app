@if(!empty($apottiItemList['data']))
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
                <span class="mr-2"><span id="daak_item_length_start">১</span> - <span id="daak_item_length_end">{{enTobn(count($apottiItemList['data']))}}</span> সর্বমোট: <span
                        id="daak_item_total_record">{{enTobn(count($apottiItemList['data']))}}</span></span>
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
            @foreach($apottiItemList['data'] as $item)
                <li class="list-group-item pl-2 py-2 border-bottom">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="pr-2 flex-fill cursor-pointer position-relative">
                            <div class="row d-md-flex flex-wrap align-items-start justify-content-md-between">
                                <!--begin::Title-->
                                <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3 col-md-8">
                                    <div class="d-flex align-items-center flex-wrap  font-size-1-2">
                                        <span class="mr-1 ">স্মারক নংঃ</span>
                                        <a  data-entity-name="{{$item['sender_office_name_bn']}}"
                                            data-broad-sheet-id="{{$item['id']}}"
                                            data-memorandum-no="{{enTobn($item['memorandum_no'])}}"
                                            data-memorandum-date="{{enTobn($item['memorandum_date'])}}"
                                            onclick="Broadsheet_Reply_List_Container.loadBroadSheetItem($(this))"
                                           class="text-dark text-hover-primary font-size-h5">
                                            {{enTobn($item['memorandum_no'])}}
                                            <span class="label label-outline-danger label-pill label-inline">
                                                {{enTobn($item['broad_sheet_items_count'])}} টি আপত্তি
                                            </span>
                                        </a>
                                    </div>
                                    <div class="subject-wrapper font-weight-normal">
                                        <span class="mr-2 font-size-1-1">এনটিটিঃ</span>
                                        <span class="description text-info text-wrap font-size-14">{{$item['sender_office_name_bn']}}</span>
                                    </div>
                                    <div class="subject-wrapper font-weight-normal">
                                        <span class="mr-2 font-size-1-1">তারিখঃ</span>
                                        <span class="description text-info text-wrap font-size-14">{{formatDateTime($item['memorandum_date'],'bn')}}</span>
                                    </div>

                                    @if(!$item['broad_sheet_reply'])
                                        @if($item['broad_sheet_items_count'] == $item['broad_sheet_item_decision'])
                                            <div class="subject-wrapper font-weight-normal mt-2">
                                                <button class="mr-3 btn btn-sm btn-outline-primary btn-square"
                                                        title="জারিপত্র"
                                                        data-broad-sheet-id="{{$item['id']}}"
                                                        data-memorandum-no="{{$item['memorandum_no']}}"
                                                        onclick="Broadsheet_Reply_List_Container.sendToRpuForm($(this))">
                                                    <i class="fa fa-plus"></i> জারিপত্র তৈরি করুন
                                                </button>
                                            </div>
                                        @endif
                                    @else
                                        <div class="d-flex mt-3">

                                            @if($item['broad_sheet_reply']['is_sent_rpu'])
                                                <button class="mr-3 btn btn-sm btn-info btn-square">
                                                    জারিপত্র প্রেরণ করা হয়েছে
                                                </button>
                                            @else
                                                <button data-broad-sheet-id="{{$item['id']}}"
                                                        onclick="Broadsheet_Reply_List_Container.sentBroadSheetReplyToRpu($(this))"
                                                        class="mr-3 btn btn-sm btn-primary btn-square">
                                                    <i class="fa fa-paper-plane"></i>জারিপত্র প্রেরণ করুন
                                                </button>
                                            @endif

                                            <button class="mr-3 btn btn-sm btn-primary btn-square"
                                                    title="দেখুন"
                                                    data-broad-sheet-id="{{$item['id']}}"
                                                    onclick="Broadsheet_Reply_List_Container.showSentBroadSheetReply($(this))">
                                                <i class="fa fa-eye"></i>  জারিপত্র দেখুন
                                            </button>
                                        </div>
                                    @endif


                                    <div class="font-weight-normal d-none predict-wrapper">
                                        <span class="predict-label text-success"></span>
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
                                                    <div class="text-dark-75 ml-3 rdate" cspas="date">{{formatDateTime($item['created_at'],'bn')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="action-group d-flex justify-content-end position-absolute action-group-wrapper">
                                            <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                                    title="{{___('generic.buttons.title.details')}}"
                                                    data-broad-sheet-id="{{$item['id']}}"
                                                    data-memorandum-no="{{enTobn($item['memorandum_no'])}}"
                                                    data-memorandum-date="{{enTobn($item['memorandum_date'])}}"
                                                    data-scope=""
                                                    onclick="Broadsheet_Reply_List_Container.showBroadSheet($(this))">
                                                <i class="fad fa-eye"></i>
                                            </button>

{{--                                            @if($item['latest_broad_sheet_movement'] && $item['latest_broad_sheet_movement']['receiver_officer_id'] == $desk_officer_id)--}}
                                                <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                                        title=""
                                                        data-broad-sheet-id="{{$item['id']}}"
                                                        onclick="Broadsheet_Reply_List_Container.loadBraodSheetApprovalAuthority($(this))">
                                                    <i class="fa fa-paper-plane"></i>
                                                </button>
{{--                                            @endif--}}

{{--                                            @if($item['unit_response'] != null)--}}
                                            <button
                                                class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                                title="ডাউনলোড করুন"
                                                data-broad-sheet-id="{{$item['id']}}"
                                                data-memorandum-no="{{enTobn($item['memorandum_no'])}}"
                                                data-memorandum-date="{{enTobn($item['memorandum_date'])}}"
                                                data-scope="pdf"
                                                onclick="Broadsheet_Reply_List_Container.downloadBroadSheet($(this))">
                                                <i class="fad fa-download"></i>
                                            </button>

{{--                                                <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"--}}
{{--                                                        title="" data-scope="jobab"--}}
{{--                                                        data-apotti-item-id="{{$item['id']}}"--}}
{{--                                                        onclick="Broadsheet_Reply_List_Container.editApottiItem($(this))">--}}
{{--                                                    <i class="fad fa-comments-alt"></i>--}}
{{--                                                </button>--}}

                                                <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                                        title="সিদ্ধান্ত দিন" data-scope="response"
                                                        data-broad-sheet-id="{{$item['id']}}"
                                                        onclick="Broadsheet_Reply_List_Container.loadBroadSheetItem($(this))">
                                                    <i class="fas fa-plus-octagon"></i>
                                                </button>
{{--                                            @endif--}}

                                            {{--<button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary
                                            list-btn-toggle"
                                                    title="{{___('generic.buttons.title.history')}}" data-apotti-item-id="{{$item['id']}}"
                                                    onclick="">
                                                <i class="fad fa-repeat-alt"></i>
                                            </button>--}}
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

<script>
    var Broadsheet_Reply_List_Container = {

        showBroadSheet : function (elem) {

            broad_sheet_id = elem.data('broad-sheet-id');
            memorandum_no = elem.data('memorandum-no');
            memorandum_date = elem.data('memorandum-date');
            scope = elem.data('scope');

            data = {broad_sheet_id,memorandum_no,memorandum_date,scope};

            let url = '{{route('audit.followup.broadsheet.reply.show-braod-sheet')}}';

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('জবাব');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '60%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        loadBroadSheetItem : function (elem) {
            broad_sheet_id = elem.data('broad-sheet-id');
            office_id = '{{$office_id}}'
            data = {broad_sheet_id,office_id};

            let url = '{{route('audit.followup.broadsheet.reply.laod-broad-sheet-item')}}';

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $("#kt_content").html(response);
                }
            });
        },

        loadBraodSheetApprovalAuthority: function (elem) {

            broad_sheet_id = elem.data('broad-sheet-id');

            data = {broad_sheet_id};

            url = '{{route('audit.followup.broadsheet.reply.get-broad-sheet-approval-authority')}}';

            KTApp.block('.content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('.content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('');
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

        sendToRpuForm: function (elem) {

            broad_sheet_id = elem.data('broad-sheet-id');
            memorandum_no = elem.data('memorandum-no');

            data = {broad_sheet_id,memorandum_no};

            url = '{{route('audit.followup.broadsheet.reply.send-broad-sheet-reply-form')}}';

            KTApp.block('.content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('.content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '50%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        showSentBroadSheetReply: function (elem) {

            broad_sheet_id = elem.data('broad-sheet-id');
            scope = 'preview';
            data = {broad_sheet_id,scope};

            url = '{{route('audit.followup.broadsheet.reply.show-sent-broad-sheet-reply')}}';

            KTApp.block('.content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('.content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '50%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        downloadSentBroadSheet: function (elem) {

            broad_sheet_id = elem.data('broad-sheet-id');
            scope = 'download';
            data = {broad_sheet_id,scope};

            url = '{{route('audit.followup.broadsheet.reply.show-sent-broad-sheet-reply')}}';

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (response) {
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "jaripotro_"+new Date().toDateString().replace(/ /g,"_")+".pdf";
                    link.click();
                },
                error: function (blob) {
                    toastr.error('Failed to generate PDF.')
                    console.log(blob);
                }
            });
        },

        downloadBroadSheet : function (elem) {

            broad_sheet_id = elem.data('broad-sheet-id');
            memorandum_no = elem.data('memorandum-no');
            memorandum_date = elem.data('memorandum-date');
            scope = elem.data('scope');

            data = {broad_sheet_id,memorandum_no,memorandum_date,scope};

            let url = '{{route('audit.followup.broadsheet.reply.show-braod-sheet')}}';

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (response) {
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "broadsheet_"+new Date().toDateString().replace(/ /g,"_")+".pdf";
                    link.click();
                },
                error: function (blob) {
                    toastr.error('Failed to generate PDF.')
                    console.log(blob);
                }
            });
        },

        storeBroadSheetReply : function (elem) {

            data  = $('#send_broad_sheet_to_rpu').serializeArray();

            let url = '{{route('audit.followup.broadsheet.reply.store-broad-sheet-reply')}}';

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    toastr.success(response.data);
                    $('#kt_quick_panel_close').click();
                }
            });
        },

        sentBroadSheetReplyToRpu : function (elem) {
            broad_sheet_id = elem.data('broad-sheet-id');

            swal.fire({
                title: 'আপনি কি প্রেরণ করতে চান?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'হ্যাঁ',
                cancelButtonText: 'না'
            }).then(function(result) {
                if (result.value) {

                    data  = {broad_sheet_id};

                    let url = '{{route('audit.followup.broadsheet.reply.send-broad-sheet-reply-to-rpu')}}';

                    KTApp.block('#kt_content', {
                        opacity: 0.1,
                        state: 'primary' // a bootstrap color
                    });

                    ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                        KTApp.unblock('#kt_content');
                        if (response.status === 'error') {
                            toastr.error(response.data);
                        } else {
                            toastr.success(response.data);
                            $('#kt_quick_panel_close').click();
                        }
                    });
                }
            });

        },


        editApottiItem: function (elem) {
            scope = elem.data('scope');
            apotti_item_id = elem.data('apotti-item-id');
            cost_center_name_bn = elem.data('cost-center-name-bn');
            cost_center_name_en = elem.data('cost-center-name-en');

            let url = '{{route('audit.followup.broadsheet.reply.edit-apottoi-item')}}';
            data = {scope,apotti_item_id,cost_center_name_bn,cost_center_name_en};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('অডিট অনুচ্ছেদ');
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
    }
</script>
