<x-title-wrapper>Audit Plan List</x-title-wrapper>

<div class="card sna-card-border mt-3" style="margin-bottom:15px;">
    <div class="row">
        <div class="col-md-3">
            <select class="form-select select-select2" id="directorate_filter">
                @if(count($directorates) > 1)
                    <option value="">অধিদপ্তর বাছাই করুন</option>
                @endif
                @foreach($directorates as $directorate)
                    <option value="{{$directorate['office_id']}}">{{$directorate['office_name_bn']}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_annual_plan">
                <option value="">--সিলেক্ট--</option>
                @foreach($fiscal_years as $fiscal_year)
                    <option
                        value="{{$fiscal_year['id']}}" {{$current_fiscal_year == $fiscal_year['id']?'selected':''}}>{{$fiscal_year['description']}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-control select-select2" id="activity_id">
                <option value="">--সিলেক্ট--</option>
            </select>
        </div>
    </div>
</div>

<div id="load_auditable_plan_lists"></div>
<div class="load-office-wise-employee mb-15"></div>

@include('scripts.script_generic')
<script>
    $(function () {
        Audit_Plan_Container.loadFiscalYearWiseActivity();
    });

    $('#select_fiscal_year_annual_plan').change(function () {
        fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
        activity_id = $('#activity_id').val();
        if (fiscal_year_id) {
            Audit_Plan_Container.loadFiscalYearWiseActivity();
            Audit_Plan_Container.loadAuditablePlanList(fiscal_year_id,activity_id);
        } else {
            $('#load_auditable_plan_lists').html('');
        }
    });

    $('#activity_id').change(function () {
        activity_id = $(this).val();
        fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
        Audit_Plan_Container.loadAuditablePlanList(fiscal_year_id,activity_id);
    });

    $('#directorate_filter').change(function () {
        activity_id = $('#activity_id').val();
        fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
        Audit_Plan_Container.loadAuditablePlanList(fiscal_year_id,activity_id);
    });

    var Audit_Plan_Container = {
        loadAuditablePlanList: function (fiscal_year_id,activity_id, page = 1, per_page = 100) {
            office_id = $('#directorate_filter').val();
            let url = '{{route('audit.plan.audit.revised.plan.load-all-lists')}}';
            let data = {fiscal_year_id,activity_id,office_id, page, per_page};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#load_auditable_plan_lists').html(response);
                }
            });
        },

        loadAuditPlans: function () {
            let url = '{{route('audit.plan.audit.revised.plan.load-all-lists')}}';
            let data = {fiscal_year_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#load_auditable_plan_lists').html(response);
                }
            });
        },

        loadAuditPlanBookOpen: function (elem) {
            url = '{{route('audit.plan.audit.revised.plan.book-audit-plan')}}';
            scope_editable= elem.data('scope-editable')
            audit_plan_id = elem.data('audit-plan-id')
            fiscal_year_id = elem.data('fiscal-year-id')
            annual_plan_id = elem.data('annual-plan-id')
            approval_status = elem.data('approval-status');
            office_id =  $('#directorate_filter').val();

            data = {
                scope_editable,
                audit_plan_id,
                fiscal_year_id,
                annual_plan_id,
                approval_status,
                office_id
            };

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('অডিট প্ল্যান');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '90%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            })
        },

        loadAuditPlanBookEditable: function (elem) {
            url = '{{route('audit.plan.audit.revised.plan.update-entity-audit-plan')}}';
            audit_plan_id = elem.data('audit-plan-id')
            fiscal_year_id = elem.data('fiscal-year-id')
            annual_plan_id = elem.data('annual-plan-id')

            data = {
                audit_plan_id,
                fiscal_year_id,
                annual_plan_id,
            };

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    var newDoc = document.open("text/html", "replace");
                    newDoc.write(response);
                    newDoc.close();
                }
            })
        },


        loadAuditPlanBookCreatable: function (elem) {
            swal.fire({
                title: 'আপনি কি নতুন প্ল্যান প্রস্তুত করতে চান?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'হ্যাঁ',
                cancelButtonText: 'না'
            }).then(function(result) {
                if (result.value) {
                    url = '{{route('audit.plan.audit.revised.plan.create-entity-audit-plan')}}';
                    annual_plan_id = elem.data('annual-plan-id')
                    fiscal_year_id = elem.data('fiscal-year-id')
                    activity_id = elem.data('activity-id')

                    data = {
                        activity_id,
                        annual_plan_id,
                        fiscal_year_id,
                    };

                    KTApp.block('#kt_wrapper', {
                        opacity: 0.1,
                        state: 'primary' // a bootstrap color
                    });

                    ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                        KTApp.unblock('#kt_wrapper');
                        if (response.status === 'error') {
                            toastr.error(response.data);
                        } else {
                            var newDoc = document.open("text/html", "replace");
                            newDoc.write(response);
                            newDoc.close();
                        }
                    })
                }
            });

        },

        showPlanInfo: function (elem) {
            office_id = elem.data('office-id');
            annual_plan_id = elem.data('annual-plan-id');

            data = {office_id,annual_plan_id};
            let url = '{{route('audit.plan.annual.plan.revised.show_plan_info')}}';

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $(".offcanvas-title").text('বিস্তারিত');
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

        showTeamDataCollectionCreateModal: function (elem) {
            url = '{{route('audit.plan.audit.editor.load-audit-team-modal')}}';
            annual_plan_id = elem.data('annual-plan-id');
            fiscal_year_id = elem.data('fiscal-year-id')
            activity_id = elem.data('activity-id')
            audit_plan_id = '0';
            parent_office_id = elem.data('parent-office-id');
            modal_type = 'data-collection';
            data = {annual_plan_id, activity_id, fiscal_year_id, audit_plan_id, parent_office_id,modal_type};

            KTApp.block('.content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('.content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".load-office-wise-employee").html(response)
                    $('#officeEmployeeModal').modal('show');
                }
            })
        },

        loadFiscalYearWiseActivity: function () {
            fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
            fiscal_year = $('#select_fiscal_year_annual_plan').select2('data')[0].text;

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            if (fiscal_year_id) {
                let url = '{{route('audit.plan.annual.plan.revised.fiscal-year-wise-activity-select')}}';
                let data = {fiscal_year_id, fiscal_year};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    KTApp.unblock('#kt_wrapper');
                    if (response.status === 'error') {
                        toastr.error(response.data)
                    } else {
                        $('#activity_id').html(response);
                        setActivityAnonymously();
                        // alert(activity_id);
                        // $('#activity_id').val(7);
                        // Annual_Plan_Container.loadAnnualPlanList();
                    }
                });
            } else {
                $('#activity_id').html('');
            }
        },
    };
</script>
