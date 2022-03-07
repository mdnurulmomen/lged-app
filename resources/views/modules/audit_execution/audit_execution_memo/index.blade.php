<x-title-wrapper>অডিট মেমোসমূহ</x-title-wrapper>

<div class="card sna-card-border d-flex flex-wrap flex-row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-md-7">
                <h4 class="mt-3">
                    {{$cost_center_name_bn.' ('.enTobn($audit_year_start).'-'.enTobn($audit_year_end).')'}}
                </h4>
            </div>
            <div class="col-md-5">
                <div class="d-flex justify-content-md-end">
                    <a href="javascript:;" title="ফেরত যান"
                       onclick="Audit_Query_Container.backToQuerySchedule($(this))"
                       class="btn btn-sm btn-warning btn_back btn-square mr-1">
                        <i class="fad fa-arrow-alt-left"></i> ফেরত যান
                    </a>

                    {{--                    <a class="btn btn-sm btn-light-primary btn-square mr-1"--}}
                    {{--                       onclick="Memo_List_Container.sentMemoListToRpu()"--}}
                    {{--                       title="আরপিইউতে প্রেরণ করুন" href="javascript:;">--}}
                    {{--                        <i class="fa fa-paper-plane mr-1"></i> আরপিইে প্রেরণ--}}
                    {{--                    </a>--}}

                    <a class="btn btn-sm btn-success btn_back btn-square"
                       data-schedule-id="{{$schedule_id}}"
                       data-audit-plan-id="{{$audit_plan_id}}"
                       data-cost-center-id="{{$cost_center_id}}"
                       data-cost-center-name-bn="{{$cost_center_name_bn}}"
                       data-audit-year-start="{{$audit_year_start}}"
                       data-audit-year-end="{{$audit_year_end}}"
                       data-team-leader-name-bn="{{$team_leader_name}}"
                       data-team-leader-designation-name-bn="{{$team_leader_designation_name}}"
                       data-scope-sub-team-leader="{{$scope_sub_team_leader}}"
                       data-sub-team-leader-name-bn="{{$sub_team_leader_name}}"
                       data-sub-team-leader-designation-name-bn="{{$sub_team_leader_designation_name}}"
                       onclick="Memo_List_Container.createMemo($(this))"
                       title="মেমো তৈরি করুন"
                       href="javascript:;">
                        <i class="fa fa-plus mr-1"></i> মেমো তৈরি
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card sna-card-border mt-2">
    <div id="load_memo_lists"></div>
</div>


<script>
    var Memo_List_Container = {
        loadMemoList: function (page = 1, per_page = 10) {
            audit_plan_id = '{{$audit_plan_id}}';
            cost_center_id = '{{$cost_center_id}}';
            let url = '{{route('audit.execution.memo.list')}}';
            let data = {audit_plan_id, cost_center_id, page, per_page};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#load_memo_lists').html(response);
                }
            });
        },

        createMemo: function (elem) {
            schedule_id = elem.data('schedule-id');
            cost_center_id = elem.data('cost-center-id');
            audit_plan_id = elem.data('audit-plan-id');
            cost_center_name_bn = elem.data('cost-center-name-bn');
            cost_center_name_en = elem.data('cost-center-name-bn');
            audit_year_start = elem.data('audit-year-start');
            audit_year_end = elem.data('audit-year-end');
            team_leader_name = elem.data('team-leader-name-bn');
            team_leader_designation_name = elem.data('team-leader-designation-name-bn');
            scope_sub_team_leader = elem.data('scope-sub-team-leader');
            sub_team_leader_name = elem.data('sub-team-leader-name-bn');
            sub_team_leader_designation_name = elem.data('sub-team-leader-designation-name-bn');
            data = {
                schedule_id, audit_plan_id, cost_center_id, cost_center_name_bn, audit_year_start, audit_year_end,
                team_leader_name, team_leader_designation_name, scope_sub_team_leader,
                sub_team_leader_name, sub_team_leader_designation_name
            };
            let url = '{{route('audit.execution.memo.create')}}'
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#kt_content').html(response)
                }
            });
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
                    quick_panel.css('width', '60%');
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
            data = {memo_id, memo_title_bn};

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

        editMemo: function (elem) {
            memo_id = elem.data('memo-id');
            schedule_id = '{{$schedule_id}}';
            audit_plan_id = '{{$audit_plan_id}}';
            cost_center_id = '{{$cost_center_id}}';
            cost_center_name_bn = '{{$cost_center_name_bn}}';
            cost_center_name_en = '{{$cost_center_name_bn}}';
            audit_year_start = '{{$audit_year_start}}';
            audit_year_end = '{{$audit_year_end}}';
            team_leader_name = '{{$team_leader_name}}';
            team_leader_designation_name = '{{$team_leader_designation_name}}';
            scope_sub_team_leader = '{{$scope_sub_team_leader}}';
            sub_team_leader_name = '{{$sub_team_leader_name}}';
            sub_team_leader_designation_name = '{{$sub_team_leader_designation_name}}';
            data = {
                memo_id, schedule_id, audit_plan_id, cost_center_id, cost_center_name_bn, audit_year_start, audit_year_end,
                team_leader_name, team_leader_designation_name, scope_sub_team_leader,
                sub_team_leader_name, sub_team_leader_designation_name
            };
            let url = '{{route('audit.execution.memo.edit')}}'
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#kt_content').html(response)
                }
            });
        },

        sendMemoForm: function (elem) {
            memo_id = elem.data('memo-id');
            // air_id = $('#preliminary_air_filter').val();

            let url = '{{route('audit.execution.memo.send-memo-form')}}';
            let data = {memo_id};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $(".offcanvas-title").text('আরপি বরাবর প্রেরণ ');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '40%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            })
        },

        sentMultipleMemoToRpu: function (elem) {
            data = $('#send_memo_to_rpu_form').serializeArray();

            memo_id = elem.data('memo-id');
            memos = [];
            memos.push(memo_id);
            cost_center_id = '{{$cost_center_id}}';
            // console.log(memos);

            data.push({name: "memos", value: memos});
            data.push({name: "cost_center_id", value: cost_center_id});

            // $(".select-memo").each(function (i, value) {
            //     if ($(this).is(':checked') && !$(this).is(':disabled')) {
            //         memos.push($(this).val());
            //     }
            // });

            // console.log(memos);

            if (!memos) {
                toastr.warning('Please Select Query');
                return;
            }

            url = '{{route('audit.execution.memo.sent-to-rpu')}}';

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                Memo_List_Container.loadMemoList();
                if (response.status === 'error') {
                    toastr.warning(response.data)
                } else {
                    toastr.success(response.data);
                    $('#kt_quick_panel_close').click();
                }
            })
        },

        sentMemoToRpu: function (elem) {
            data = $('#send_memo_to_rpu_form').serializeArray();
            memo_id = elem.data('memo-id');
            cost_center_id = '{{$cost_center_id}}';
            // console.log(memos);

            data.push({name: "memo_id", value: memo_id});
            data.push({name: "cost_center_id", value: cost_center_id});
            url = '{{route('audit.execution.memo.sent-to-rpu')}}';

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                Memo_List_Container.loadMemoList();
                if (response.status === 'error') {
                    toastr.warning(response.data)
                } else {
                    toastr.success(response.data);
                    $('#kt_quick_panel_close').click();
                }
            })
        },

        recommendationMemo: function (memo_id) {

            quick_panel = $("#kt_quick_panel");
            $(".offcanvas-title").text('Memo Recommendation');
            quick_panel.addClass('offcanvas-on');
            quick_panel.css('opacity', 1);
            quick_panel.css('width', '40%');
            quick_panel.removeClass('d-none');
            $("html").addClass("side-panel-overlay");


            // memo_id = elem.data('memo-id');
            data = {memo_id};
            let url = '{{route('audit.execution.memo.audit-memo-recommendation')}}'
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
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
        Memo_List_Container.loadMemoList();
    });
</script>
