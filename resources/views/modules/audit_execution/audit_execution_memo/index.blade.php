<x-title-wrapper>Audit Findings</x-title-wrapper>

<div class="card sna-card-border d-flex flex-wrap flex-row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-md-9">
                <h4 class="mt-3">
                    @if(!empty($project_name_bn))
                        Project: {{$project_name_en}}
                    @endif
                    {{$cost_center_name_en.' ('.bnToen($audit_year_start).'-'.bnToen($audit_year_end).')'}}
                </h4>
            </div>
            <div class="col-md-3">
                <div class="d-flex justify-content-md-end">
                    <a href="javascript:;" title="Go Back"
                       onclick="Memo_List_Container.backToQuerySchedule($(this))"
                       class="btn btn-sm btn-warning btn_back btn-square mr-1">
                        <i class="fad fa-arrow-alt-left"></i> Go Back
                    </a>

                    <a class="btn btn-sm btn-primary btn_back btn-square"
                       data-schedule-id="{{$schedule_id}}"
                       data-team-id="{{$team_id}}"
                       data-project-id="{{$project_id}}"
                       data-project-name-en="{{$project_name_en}}"
                       data-project-name-bn="{{$project_name_bn}}"
                       data-audit-plan-id="{{$audit_plan_id}}"
                       data-cost-center-id="{{$cost_center_id}}"
                       data-cost-center-name-bn="{{$cost_center_name_bn}}"
                       data-cost-center-name-en="{{$cost_center_name_en}}"
                       data-audit-year-start="{{$audit_year_start}}"
                       data-audit-year-end="{{$audit_year_end}}"
                       data-team-leader-name-bn="{{$team_leader_name}}"
                       data-team-leader-designation-name-bn="{{$team_leader_designation_name}}"
                       data-scope-sub-team-leader="{{$scope_sub_team_leader}}"
                       data-sub-team-leader-name-bn="{{$sub_team_leader_name}}"
                       data-sub-team-leader-designation-name-bn="{{$sub_team_leader_designation_name}}"
                       onclick="Memo_List_Container.createMemo($(this))"
                       title="Create Memo"
                       href="javascript:;">
                        <i class="fa fa-plus mr-1"></i> Create Findings
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card sna-card-border mt-2 mb-15">
    <div class="load_memo_lists">
        <div class="d-flex align-items-center">
            <div class="spinner-grow text-warning mr-3" role="status">
                <span class="sr-only"></span>
            </div>
            <div>
                loading.....
            </div>
        </div>
    </div>
</div>


<script>
    $(function () {
        Memo_List_Container.loadMemoList();
    });

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
                    $('.load_memo_lists').html(response);
                }
            });
        },

        createMemo: function (elem) {
            schedule_id = elem.data('schedule-id');
            team_id = elem.data('team-id');
            cost_center_id = elem.data('cost-center-id');
            audit_plan_id = elem.data('audit-plan-id');
            cost_center_name_bn = elem.data('cost-center-name-bn');
            cost_center_name_en = elem.data('cost-center-name-en');
            audit_year_start = elem.data('audit-year-start');
            project_id = elem.data('project-id');
            project_name_en = elem.data('project-name-en');
            project_name_bn = elem.data('project-name-bn');

            data = {schedule_id, team_id, audit_plan_id, cost_center_id, cost_center_name_bn, cost_center_name_en, audit_year_start, audit_year_end, project_id, project_name_en, project_name_bn};

            let url = '{{route('audit.execution.memo.create')}}';
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('#kt_content').html(response);
                }
            });
        },


        showMemo: function (element) {
            url = '{{route('audit.execution.memo.show')}}'
            memo_id = element.data('memo-id');
            data = {memo_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('Findings');
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

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
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
            team_id = '{{$team_id}}';
            audit_plan_id = '{{$audit_plan_id}}';
            cost_center_id = '{{$cost_center_id}}';
            cost_center_name_bn = '{{$cost_center_name_bn}}';
            cost_center_name_en = '{{$cost_center_name_en}}';
            audit_year_start = '{{$audit_year_start}}';
            audit_year_end = '{{$audit_year_end}}';

            data = {memo_id, schedule_id, team_id, audit_plan_id, cost_center_id, cost_center_name_bn, cost_center_name_en,audit_year_start, audit_year_end};
            
            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            let url = '{{route('audit.execution.memo.edit')}}';
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
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

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
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

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
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
            $("#sentMemoToRpu").hide();

            data = $('#send_memo_to_rpu_form').serializeArray();
            memo_id = elem.data('memo-id');
            cost_center_id = '{{$cost_center_id}}';
            // console.log(memos);

            data.push({name: "memo_id", value: memo_id});
            data.push({name: "cost_center_id", value: cost_center_id});
            url = '{{route('audit.execution.memo.sent-to-rpu')}}';

            KTApp.block('#kt_quick_panel', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                $("#sentMemoToRpu").show();
                KTApp.unblock('#kt_quick_panel');
                $('#kt_quick_panel_close').click();
                Memo_List_Container.loadMemoList();
                if (response.status === 'error') {
                    toastr.warning(response.data)
                } else {
                    toastr.success(response.data);
                }
            },function (response) {
                $("#sentMemoToRpu").show();
                KTApp.unblock('#kt_quick_panel');
                if (response.responseJSON.errors) {
                    $.each(response.responseJSON.errors, function (k, v) {
                        if (isArray(v)) {
                            $.each(v, function (n, m) {
                                toastr.error(m);
                            })
                        } else {
                            if (v !== '') {
                                toastr.error(v);
                            }
                        }
                    });
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
            let url = '{{route('audit.execution.memo.audit-memo-log')}}';

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock("#kt_content");
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        backToQuerySchedule:function (){
            $('.audit_query_schedule_menu a').click();
        }
    };
</script>
