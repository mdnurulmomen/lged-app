<x-title-wrapper>Annual Plan Lists</x-title-wrapper>
<form class="pl-4 pt-4">
    <div class="form-row">
        <div class="col-md-4 ">
            <label>Select Fiscal Year For Annual Planning</label>
            <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_annual_plan">
                <option value="">Choose Fiscal Year</option>
                @foreach($fiscal_years as $fiscal_year)
                    <option value="{{$fiscal_year['id']}}">{{$fiscal_year['description']}}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>

<div class="px-3 py-3" id="load_annual_plan_lists">

</div>

@include('scripts.script_generic')
<script>
    var Annual_Plan_Container = {
        loadAnnualPlanList: function (fiscal_year_id) {
            let url = '{{route('audit.plan.annual.plan.revised.list.all')}}';
            let data = {fiscal_year_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#load_annual_plan_lists').html(response);
                }
            });
        },

        loadEntitySelection: function (elem) {
            schedule_id = elem.data('schedule-id');
            activity_id = elem.data('activity-id');
            milestone_id = elem.data('milestone-id');
            data = {schedule_id, activity_id, milestone_id}
            let url = '{{route('audit.plan.annual.plan.list.show.revised.entity-selection')}}'
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#kt_content').html(response)
                }
            });
        },

        loadRPAuditeeOffices: function (ministry_id, layer_id) {
            let url = '{{route('audit.plan.annual.plan.list.show.rp-auditee-offices')}}'
            ministry_name_en = $('#ministry_name_en').val()
            ministry_name_bn = $('#ministry_name_bn').val()
            data = {ministry_id, layer_id, ministry_name_en, ministry_name_bn};
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('.rp_auditee_office_tree').html(response)
                }
            });
        },

        addSelectedRPAuditeeList: function (entity_info) {
            if ($('#selected_rp_auditee_' + entity_info.entity_id).length === 0) {
                var newRow = '<tr id="selected_rp_auditee_' + entity_info.entity_id + '">' +
                    '<td width="2%">' +
                    '<input name="selected_entity[]" class="selected_entity" data-auditee-id="' + entity_info.entity_id + '" id="selected_entity_' + entity_info.entity_id + '" type="hidden" value=""/>' +
                    '<span id="btn_remove_auditee_' + entity_info.entity_id + '" data-auditee-id="' + entity_info.entity_id + '" onclick="Annual_Plan_Container.removeSelectedRPAuditee(' + entity_info.entity_id + ')" style="cursor:pointer;color:red;"><i class="fa fa-trash d-none"></i></span>' +
                    '</td>' +
                    '<td width="68%">' + entity_info.entity_name_en + '</td>' +
                    '<td width="5%">' + '' + '</td>' +
                    '<td width="15%">' + '' + '</td>' +
                    '<td width="5%">' + '' + '</td>' +
                    '<td width="5%"><button data-entity-id="' + entity_info.entity_id + '" type="button" class="btn btn-primary font-weight-bold btn-square d-none" onclick="Annual_Plan_Container.loadSubmissionHRModal($(this))">Plan</button></td>' +
                    '</tr>';
                $(".selected_rp_auditees_table tbody").prepend(newRow);
                $(".selected_rp_auditees_table tbody").find('#selected_entity_' + entity_info.entity_id).val(JSON.stringify(entity_info));
            }
        },

        removeSelectedRPAuditee: function (entity_id) {
            $('#selected_rp_auditee_' + entity_id).remove();
        },

        loadSelectedAuditeeEntities: function (annual_plan_data) {
            url = '{{route('audit.plan.annual.plan.list.show.selected-entity')}}';

            annualObj = {};
            $.each(annual_plan_data, function () {
                annualObj[this.name] = this.value;
            });
            activity_id = annualObj.activity_id
            milestone_id = annualObj.milestone_id
            schedule_id = annualObj.schedule_id

            ajaxCallAsyncCallbackAPI(url, {activity_id, milestone_id, schedule_id}, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#selected_auditee_entities_area').html(response)
                }
            })
        },

        loadSubmissionHRModal: function (elem) {
            url = '{{route('audit.plan.annual.plan.list.show.hr-modal')}}';
            plan_responsible_party_id = elem.data('plan-responsible-party-id');

            ajaxCallAsyncCallbackAPI(url, {plan_responsible_party_id}, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#annual_plan_submission_hr_modal_area').html('');
                    $('#annual_plan_submission_hr_modal_area').html(response)
                    $('#annual_plan_submission_hr_modal').modal('show')
                }
            });
        },

        showHideHRModalSaveBtn: function () {
            if ($(".assigned_officers_to_plan_area").length > 0) {
                $("#btn_annual_plan_submission_hr_modal_save").show();
            } else {
                $("#btn_annual_plan_submission_hr_modal_save").hide();
            }
        },

        addOfficerToAssignedList: function (officer_info) {
            if ($('#selected_officer_to_assign_' + officer_info.designation_id).length === 0) {
                var newRow = '<tr id="selected_officer_to_assign_' + officer_info.designation_id + '">' +
                    '<td width="2%">' +
                    '<input name="designation_to_assign[]" class="designation_to_assign" data-designation-id="' + officer_info.designation_id + '" id="designation_to_assign_' + officer_info.designation_id + '" type="hidden" value=""/>' +
                    '<span id="btn_remove_officer_' + officer_info.designation_id + '" data-designation-id="' + officer_info.designation_id + '" onclick="Annual_Plan_Container.removeOfficerFromAssignedList(' + officer_info.designation_id + ')" style="cursor:pointer;color:red;"><i class="fa fa-trash"></i></span>' +
                    '</td>' +
                    '<td width="60%">' + officer_info.designation_bn + '</td>' +
                    '<td width="30%">' + officer_info.officer_name_en + '</td>' +
                    '<td width="10%">' + '<select name="designation_role[]" class="select-select2"><option value="member_' + officer_info.designation_id + '">Member</option><option value="leader_' + officer_info.designation_id + '" selected>Team Leader</option></select>' + ' </td>' +
                    '</tr>';
                $(".assigned_officers_table tbody").prepend(newRow);
                $(".assigned_officers_table tbody").find('#designation_to_assign_' + officer_info.designation_id).val(JSON.stringify(officer_info));
            }
        },

        removeOfficerFromAssignedList: function (designation_id) {
            $('#selected_officer_to_assign_' + designation_id).remove();
        },

        saveAnnualPlanHRAssigned: function (elem) {
            url = elem.data('url');
            data = $('#annual_plan_core_data_form, #assigned_officers_to_plan_form').serialize();
            method = elem.data('method');
            submitModalData(url, data, method, 'annual_plan_submission_hr_modal')
        },

        jsTreeInit: function (className) {
            $(`.${className}`).jstree({
                "core": {
                    "themes": {
                        "responsive": true
                    }
                },
                "types": {
                    "default": {
                        "icon": "fal fa-folder"
                    },
                    "person": {
                        "icon": "fal fa-file "
                    }
                },
                "plugins": ["types", "checkbox",]
            });
            $(`.${className}`).jstree("open_all");
        },

        submitSelectedEntities: function () {
            url = '{{route('audit.plan.annual.plan.list.store.selected-entity')}}';
            data = $('#selected_rp_auditee_form, #annual_plan_core_data_form').serialize();

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {
                    toastr.success(response.data);
                    Annual_Plan_Container.loadSelectedAuditeeEntities($('#annual_plan_core_data_form').serializeArray())
                } else {
                    toastr.error(response.data)
                }
            })
        },

        submitToOCAG: function (elem) {
            url = '{{route('audit.plan.annual.plan.list.submit.plan-to-ocag')}}';
            fiscal_year_id = elem.data('fiscal-year-id');

            ajaxCallAsyncCallbackAPI(url, {fiscal_year_id}, 'post', function (response) {
                if (response.status === 'success') {
                    toastr.success(response.data);
                } else {
                    toastr.error(response.data)
                }
            })
        },

        addPlanInfo: function (elem) {
            data = {}
            let url = '{{route('audit.plan.annual.plan.list.show.revised.crate_plan_info')}}'
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#kt_content').html(response)
                }
            });
        },
        addTeamSection: function (elem) {
            $('.team-section').append(
            `<div class="form-row pt-4">
                    <div class="col-md-4">
                        <label>পদবি</label>
                        <select class="form-control" name="" id="">
                            <option value="">--পপদবি--</option>
                            <option value="">Layer 1</option>
                            <option value="">Layer 2</option>
                            <option value="">Layer 3</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>দায়িত্ব</label>
                        <select class="form-control" name="" id="">
                            <option value="">--দায়িত্ব--</option>
                            <option value="">Layer 1</option>
                            <option value="">Layer 2</option>
                            <option value="">Layer 3</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>জন</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-md-2 mt-8">
                        <button onclick="Annual_Plan_Container.removeTeamSection($(this))" class="btn btn-danger"><i class="fa fa-minus"></i></button>
                    </div>
                </div>`
        );
        },

        removeTeamSection: function (elem) {
            elem.parent().parent().remove();
        },
    };

    $('#select_fiscal_year_annual_plan').change(function () {
        let fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
        if (fiscal_year_id) {
            Annual_Plan_Container.loadAnnualPlanList(fiscal_year_id);
        } else {
            $('#load_annual_plan_lists').html('');
        }
    });
</script>
