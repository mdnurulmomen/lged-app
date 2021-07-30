<x-title-wrapper>Annual Plan Lists</x-title-wrapper>
<form>
    <div class="form-row">
        <div class="col-md-2 d-md-flex align-items-md-center">
            <p class="mb-0">Fiscal Year</p>
        </div>
        <div class="col-md-4 ">
            <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_annual_plan">
                <option value="">Choose Fiscal Year</option>
                @foreach($fiscal_years as $fiscal_year)
                    <option value="{{$fiscal_year['id']}}">{{$fiscal_year['description']}}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>

<div class="px-3" id="load_annual_plan_lists">

</div>


<script>
    var Annual_Plan_Container = {
        loadAnnualPlanList: function (fiscal_year_id) {
            let url = '{{route('audit.plan.annual.plan.list.all')}}';
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
            let url = '{{route('audit.plan.annual.plan.list.show.entity-selection')}}'
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#kt_content').html(response)
                }
            });
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

            ajaxCallAsyncCallbackAPI(url, {}, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
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
                    '<td width="38%">' + officer_info.officer_name + '</td>' +
                    '</tr>';
                $(".assigned_officers_table tbody").prepend(newRow);
                $(".assigned_officers_table tbody").find('#designation_to_assign_' + officer_info.designation_id).val(JSON.stringify(officer_info));
            }
        },

        removeOfficerFromAssignedList: function (designation_id) {
            $('#selected_officer_to_assign_' + designation_id).remove();
        }
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
