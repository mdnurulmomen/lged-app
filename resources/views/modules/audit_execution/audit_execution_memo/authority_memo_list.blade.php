<div class="table-search-header-wrapper mb-4 pt-3 pb-3 shadow-sm">
    <div class="col-xl-12">
        <div class="row mt-2 mb-2">
            <div class="col-md-3">
                <select class="form-select select-select2" id="directorate_filter">
                    @if(count($directorates) > 1)
                        <option value="all">Select Directorate</option>
                    @endif
                    @foreach($directorates as $directorate)
                        <option value="{{$directorate['office_id']}}">{{$directorate['office_name_bn']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select select-select2" id="fiscal_year_id">
                    @foreach($fiscal_years as $fiscal_year)
                        <option
                            value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['end']?'selected':''}}>{{$fiscal_year['description']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select select-select2" id="entity_filter">
                    <option value="">All Entity</option>
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select select-select2" id="cost_center_filter">
                    <option value="">All Cost Center</option>
                </select>
            </div>
        </div>
        <div class="row mt-2 mb-2">
            <div class="col-md-3">
                <select class="form-select select-select2" id="team_filter">
                    <option value="">All Teams</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select select-select2" id="memo_irregularity_type">
                    <option value="">আপত্তি অনিয়মের ধরন</option>
                    <option value="1">আত্মসাত, চুরি, প্রতারণা ও জালিয়াতিমূলক</option>
                    <option value="2">সরকারের আর্থিক ক্ষতি</option>
                    <option value="3">বিধি ও পদ্ধতিগত অনিয়ম</option>
                    <option value="4">বিশেষ ধরনের আপত্তি</option>
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select select-select2" id="memo_irregularity_sub_type">
                    <option value="">আপত্তি অনিয়মের সাব-ধরন</option>
                    <option value="1">ভ্যাট-আইটিসহ সরকারি প্রাপ্য আদায় না করা</option>
                    <option value="2">কম আদায় করা</option>
                    <option value="3">আদায় করা সত্ত্বেও কোষাগারে জমা না করা</option>
                    <option value="4">বাজার দর অপেক্ষা উচ্চমূল্যে ক্রয় কার্য সম্পাদন</option>
                    <option value="5">রেসপন্সিভ সর্বনিম্ন দরদাতার স্থলে উচ্চ দরদাতার নিকট থেকে কার্য/পণ্য/সেবা ক্রয়</option>
                    <option value="6">প্রকল্প শেষে অব্যয়িত অর্থ ফেরত না দেওয়া</option>
                    <option value="7">ভুল বেতন নির্ধারণীর মাধ্যমে অতিরিক্ত বেতন উত্তোলন</option>
                    <option value="8">প্রাপ্যতাবিহীন ভাতা উত্তোলন</option>
                    <option value="9">জাতীয় অন্যান্য সরকারী অর্থের ক্ষতি সংক্রান্ত আপত্তি।</option>
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-control select-select2" id="memo_type">
                    <option value="">আপত্তির ধরন</option>
                    <option value="1">এসএফআই</option>
                    <option value="2">নন-এসএফআই</option>
                    <option value="3">ড্রাফ্ট প্যারা</option>
                    <option value="4">পাণ্ডুলিপি</option>
                </select>
            </div>
        </div>
        <div class="row mt-2 mb-2">
            <div class="col-md-3">
                <select class="form-control select-select2" id="memo_status">
                    <option value="">আপত্তির অবস্থা</option>
                    <option value="1">নিস্পন্ন</option>
                    <option value="2">অনিস্পন্ন</option>
                    <option value="3">আংশিক নিস্পন্ন</option>
                </select>
            </div>
            <div class="col-md-3">
                <input class="form-control mb-1" pattern="[0-9\.]*" id="jorito_ortho_poriman" placeholder="জড়িত অর্থ (টাকা)" type="text">
            </div>

            <div class="col-md-2">
                <input class="form-control mb-1 mt-1 year-picker" id="audit_year_start" placeholder="নিরীক্ষাধীন অর্থ বছর শুরু" type="text">
            </div>

            <div class="col-md-2">
                <input class="form-control mb-1 mt-1 year-picker" id="audit_year_end" placeholder="নিরীক্ষাধীন অর্থ বছর শেষ" type="text">
            </div>

            <div class="col-md-1">
                <div class="mt-2 action-group d-flex justify-content-end position-absolute action-group-wrapper">
                    <button id="btn_filter" class="btn btn-sm btn-outline-primary btn-square" type="button">
                        <i class="fad fa-search"></i> অনুসন্ধান
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="card card-custom card-stretch">
    <div class="card-body p-0">
        <div id="load_memo_list"></div>
    </div>
</div>


<script>
    var Authority_Memo_Container = {
        loadEntityList: function (directorate_id, fiscal_year_id) {
            let url = '{{route('calendar.load-schedule-entity-fiscal-year-wise-select')}}';
            let data = {directorate_id, fiscal_year_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                console.log(response)
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#entity_filter').html(response);
                    }
                }
            );
        },
        loadCostCenterList: function (directorate_id, fiscal_year_id, entity_id) {
            let url = '{{route('calendar.load-cost-center-directorate-fiscal-year-wise-select')}}';
            let data = {directorate_id, fiscal_year_id, entity_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#cost_center_filter').html(response);
                    }
                }
            );
        },

        loadTeamList: function (directorate_id, fiscal_year_id, cost_center_id) {
            let url = '{{route('calendar.load-teams-select')}}';
            let data = {directorate_id, fiscal_year_id, cost_center_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#team_filter').html(response);
                    }
                }
            );
        },

        loadMemoList: function (directorate_id, fiscal_year_id, cost_center_id, team_id ,memo_irregularity_type, memo_irregularity_sub_type, memo_type, memo_status, jorito_ortho_poriman, audit_year_start,audit_year_end) {
            let url = '{{route('audit.execution.memo.load-authority-memo-list')}}';
            let data = {directorate_id, fiscal_year_id, cost_center_id, team_id, memo_irregularity_type, memo_irregularity_sub_type, memo_type, memo_status, jorito_ortho_poriman, audit_year_start,audit_year_end};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#load_memo_list').html(response);
                    }
                }
            );
        },


        showMemo: function (element) {
            url = '{{route('audit.execution.memo.show')}}'
            memo_id = element.data('memo-id');
            data = {memo_id};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('মেমো');
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

        showMemoAttachment: function (element) {
            url = '{{route('audit.execution.memo.show-attachment')}}'
            memo_id = element.data('memo-id');
            memo_title_bn = element.data('memo-title-bn');
            data = {memo_id,memo_title_bn};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('সংযুক্তি সমূহ');
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

        memoLog: function (elem) {

            quick_panel = $("#kt_quick_panel");
            $(".offcanvas-title").text('Memo Log');
            quick_panel.addClass('offcanvas-on');
            quick_panel.css('opacity', 1);
            quick_panel.css('width', '40%');
            quick_panel.removeClass('d-none');
            $("html").addClass("side-panel-overlay");

            memo_id = elem.data('memo-id');
            data = {memo_id};
            let url = '{{route('audit.execution.memo.audit-memo-log')}}'
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },
    };


    $(function () {
        directorate_id = $('#directorate_filter').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        team_filter = $('#team_filter').val();
        cost_center_id = $('#cost_center_filter').val();

        if (directorate_id !== 'all') {
            Authority_Memo_Container.loadMemoList(directorate_id, fiscal_year_id, cost_center_id, team_filter);
            Authority_Memo_Container.loadEntityList(directorate_id, fiscal_year_id);
        } else {
            toastr.info('Please select directorate.')
            $('#load_team_calendar').html('');
        }
    });

    $('#btn_filter').click(function () {
        directorate_id = $('#directorate_filter').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        team_filter = $('#team_filter').val();
        cost_center_id = $('#cost_center_filter').val();
        memo_irregularity_type = $('#memo_irregularity_type').val();
        memo_irregularity_sub_type = $('#memo_irregularity_sub_type').val();
        memo_type = $('#memo_type').val();
        memo_status = $('#memo_status').val();
        jorito_ortho_poriman = $('#jorito_ortho_poriman').val();
        audit_year_start = $('#audit_year_start').val();
        audit_year_end = $('#audit_year_end').val();
        if (directorate_id !== 'all') {
            Authority_Memo_Container.loadMemoList(directorate_id, fiscal_year_id, cost_center_id, team_filter, memo_irregularity_type, memo_irregularity_sub_type, memo_type, memo_status, jorito_ortho_poriman, audit_year_start,audit_year_end);
        } else {
            toastr.info('Please select a directorate.')
        }
    });

    $('#entity_filter').change(function () {
        entity_id = $('#entity_filter').val();
        directorate_id = $('#directorate_filter').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        Authority_Memo_Container.loadCostCenterList(directorate_id, fiscal_year_id, entity_id);
    });

    $('#cost_center_filter').change(function () {
        cost_center_id = $('#cost_center_filter').val();
        directorate_id = $('#directorate_filter').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        Authority_Memo_Container.loadTeamList(directorate_id, fiscal_year_id, cost_center_id);
    });
</script>
