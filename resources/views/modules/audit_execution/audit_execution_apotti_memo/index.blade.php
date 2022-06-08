<x-title-wrapper>Audit Memo List</x-title-wrapper>

<div class="card sna-card-border d-flex flex-wrap flex-row">
    <div class="col-xl-12">
        <div class="row mt-2 mb-2">
            <div class="col-md-3">
                <select class="form-select select-select2" id="directorate_filter">
                    @if (count($directorates) > 1)
                        <option value="all">Select Directorate</option>
                    @endif
                    @foreach ($directorates as $directorate)
                        <option value="{{ $directorate['office_id'] }}">{{ $directorate['office_name_bn'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select select-select2" id="fiscal_year_id">
                    @foreach ($fiscal_years as $fiscal_year)
                        <option value="{{ $fiscal_year['id'] }}"
                            {{ now()->year == $fiscal_year['end'] ? 'selected' : '' }}>
                            {{ $fiscal_year['description'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-control select-select2" id="activity_id">
                    <option value="">--সিলেক্ট--</option>
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select select-select2" id="entity_filter">
                    <option value="">All Entity</option>
                </select>
            </div>
        </div>
        <div class="row mt-2 mb-2">
            <div class="col-md-3">
                <select class="form-select select-select2" id="cost_center_filter">
                    <option value="">All Cost Center</option>
                </select>
            </div>

            <div class="col-md-3">
                <input class="form-control mb-1 mt-1" pattern="[0-9\.]*" id="jorito_ortho_poriman"
                       placeholder="জড়িত অর্থ (টাকা)" type="text">
            </div>

            <div class="col-md-6">
                <select class="form-select select-select2" id="has_convert_to_apotti">
                    <option value="">--বাছাই করুন--</option>
                    <option value="yes">মেমো থেকে অডিট অবজারভেশনে রুপান্তরিত হয়েছে</option>
                    <option value="no">মেমো থেকে অডিট অবজারভেশনে রুপান্তর হয়নি</option>
                </select>
            </div>
        </div>

        <div class="row mt-2 mb-2">
            <div class="col-md-3 mt-1">
                <button id="btn_filter" class="btn icon-btn-primary" type="button">
                    <i class="fad fa-search"></i> অনুসন্ধান
                </button>
            </div>
        </div>
    </div>
</div>


<div class="memo-list-container"></div>


<script>
    var dashboard_filter_data = '{!! session('dashboard_filter_data') !!}';
    $(function() {
        if (dashboard_filter_data != "") {
            filter_data = JSON.parse(dashboard_filter_data);
            if (filter_data.directorate_id != null) {
                $("#directorate_filter").val(filter_data.directorate_id).trigger('change');
            }
            if (filter_data.fiscal_year_id != null) {
                $("#fiscal_year_id").val(filter_data.fiscal_year_id).trigger('change');
            }
            if (filter_data.entity_filter != null) {
                $("#entity_filter").val(filter_data.entity_id).trigger('change');
            }
            if (filter_data.cost_center_filter != null) {
                $("#cost_center_filter").val(filter_data.cost_center_id).trigger('change');
            }
            if (filter_data.activity_id != null) {
                $("#activity_id").val(filter_data.activity_id).trigger('change');
                Apotti_Memo_Container.loadMemoList();
            }
        }

        directorate_id = $('#directorate_filter').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        Apotti_Memo_Container.loadFiscalYearWiseActivity();

        if (directorate_id !== 'all') {
            Apotti_Memo_Container.loadMemoList();
            Apotti_Memo_Container.loadEntityList(directorate_id, fiscal_year_id);
        } else {
            toastr.warning('Please select directorate');
            $('.memo-list-container').html('');
        }
    });

    var Apotti_Memo_Container = {
        loadFiscalYearWiseActivity: function() {
            fiscal_year_id = $('#fiscal_year_id').val();
            fiscal_year = $('#fiscal_year_id').select2('data')[0].text;
            if (fiscal_year_id) {
                let url = '{{ route('audit.plan.annual.plan.revised.fiscal-year-wise-activity-select') }}';
                let data = {fiscal_year_id, fiscal_year};
                KTApp.block('#kt_content', {
                    opacity: 0.1,
                    state: 'primary' // a bootstrap color
                });
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function(response) {
                    KTApp.unblock('#kt_content');
                    if (response.status === 'error') {
                        toastr.error(response.data)
                    } else {
                        $('#activity_id').html(response);
                        Apotti_Memo_Container.setActivityAnonymously();
                        if (dashboard_filter_data.activity_id != null) {
                            $("#activity_id").val(dashboard_filter_data.activity_id).trigger('change');
                            Apotti_Memo_Container.loadMemoList();
                        }
                    }
                });
            } else {
                $('#activity_id').html('');
            }
        },

        loadEntityList: function(directorate_id, fiscal_year_id) {
            activity_id = $('#activity_id').val();
            console.log(dashboard_filter_data)
            if (dashboard_filter_data && activity_id == null) {
                // dashboard_filter_data = JSON.parse(dashboard_filter_data);
                activity_id = dashboard_filter_data.activity_id;
            }
            let url = '{{ route('calendar.load-schedule-entity-fiscal-year-wise-select') }}';
            let data = {directorate_id, fiscal_year_id, activity_id};
            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function(response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.warning(response.data)
                } else {
                    $('#entity_filter').html(response);
                }
            });
        },

        loadCostCenterList: function(directorate_id, fiscal_year_id, entity_id) {
            let url = '{{ route('calendar.load-cost-center-directorate-fiscal-year-wise-select') }}';
            let data = {directorate_id, fiscal_year_id, entity_id};
            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function(response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.warning(response.data)
                } else {
                    $('#cost_center_filter').html(response);
                }
            });
        },

        setActivityAnonymously: function() {
            preset_activity_id = getUserIndividualEvent('activity_id');
            activity_id = preset_activity_id ? preset_activity_id : $("select#activity_id option:eq(1)").val();
            $("select#activity_id").val(activity_id).trigger('change');
            Apotti_Memo_Container.loadMemoList();
        },

        loadMemoList: function(page = 1, per_page = 10) {
            directorate_id = $('#directorate_filter').val();
            fiscal_year_id = $('#fiscal_year_id').val();
            activity_id = $('#activity_id').val();
            if (dashboard_filter_data && activity_id == null) {
                dashboard_filter_data = JSON.parse(dashboard_filter_data);
                activity_id = dashboard_filter_data.activity_id;
            }
            entity_id = $('#entity_filter').val();
            cost_center_id = $('#cost_center_filter').val();
            jorito_ortho_poriman = $('#jorito_ortho_poriman').val();
            has_convert_to_apotti = $('#has_convert_to_apotti').val();

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            let url = '{{ route('audit.execution.apotti.memo.memo-list') }}';
            let data = {
                directorate_id,
                fiscal_year_id,
                activity_id,
                entity_id,
                cost_center_id,
                jorito_ortho_poriman,
                has_convert_to_apotti,
                page,
                per_page
            };
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function(response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.warning(response.data)
                } else {
                    $('.memo-list-container').html(response);
                }
            });
        },

        showMemo: function(element) {
            url = '{{ route('audit.execution.memo.show') }}'
            memo_id = element.data('memo-id');
            data = {
                memo_id
            };
            directorate_id = $('#directorate_filter').val();
            if (directorate_id) {
                data['directorate_id'] = directorate_id;
            }

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function(response) {
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

        showMemoAttachment: function(element) {
            url = '{{ route('audit.execution.memo.show-attachment') }}';
            memo_id = element.data('memo-id');
            memo_title_bn = element.data('memo-title-bn');
            directorate_id = $('#directorate_filter').val();
            data = {
                memo_id,
                memo_title_bn
            };

            if (directorate_id) {
                data['directorate_id'] = directorate_id;
            }

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function(response) {
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

        memoLog: function(elem) {

            quick_panel = $("#kt_quick_panel");
            $(".offcanvas-title").text('Memo Log');
            quick_panel.addClass('offcanvas-on');
            quick_panel.css('opacity', 1);
            quick_panel.css('width', '40%');
            quick_panel.removeClass('d-none');
            $("html").addClass("side-panel-overlay");

            memo_id = elem.data('memo-id');
            data = {
                memo_id
            };
            let url = '{{ route('audit.execution.memo.audit-memo-log') }}'
            ajaxCallAsyncCallbackAPI(url, data, 'post', function(response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        editMemo: function (elem) {
            memo_id = elem.data('memo-id');
            data = {memo_id};
            let url = '{{route('audit.execution.apotti.memo.edit')}}';
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#kt_content').html(response)
                }
            });
        },

        paginate: function(elem) {
            page = $(elem).attr('data-page');
            per_page = $(elem).attr('data-per-page');
            Apotti_Memo_Container.loadMemoList(page, per_page);
        },
    };

    $('#btn_filter').click(function() {
        directorate_id = $('#directorate_filter').val();
        if (directorate_id !== 'all') {
            Apotti_Memo_Container.loadMemoList();
        } else {
            toastr.info('Please select a directorate.')
        }
    });

    $('#directorate_filter').change(function() {
        directorate_id = $('#directorate_filter').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        Apotti_Memo_Container.loadEntityList(directorate_id, fiscal_year_id);
    });

    $('#entity_filter').change(function() {
        entity_id = $('#entity_filter').val();
        directorate_id = $('#directorate_filter').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        Apotti_Memo_Container.loadCostCenterList(directorate_id, fiscal_year_id, entity_id);
    });
</script>
