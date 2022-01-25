<form autocomplete="off" id="annual_plan_list_milestone_edit_form">

    <input type="hidden" name="schedule_id" value="{{$schedule_info['id']}}">

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="heading_details">No of Items<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="no_of_items" name="no_of_items" placeholder="No of Items" value="{{$schedule_info['no_of_items']}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="advices">Staff Assigned<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="staff_assigne" name="staff_assigne" placeholder="Staff Assigne" value="{{$schedule_info['staff_assigne']}}">
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <a href="javascript:;" role="button" onclick="Plan_Milestone_Edit_Container.editPlanMilestone($(this))"
           class="btn btn-primary btn-sm btn-square btn-forward">
            <i class="fa fa-save"></i>
            সংরক্ষন করুন
        </a>
    </div>
</form>

<script>
    var Plan_Milestone_Edit_Container ={
        editPlanMilestone: function (elem) {
            url = '{{route('audit.plan.annual.plan.list.edit-milestone')}}';
            data = $('#annual_plan_list_milestone_edit_form').serialize();
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {
                    toastr.success('সফলভাবে সংরক্ষন করা হয়েছে');
                    $('#kt_quick_panel_close').click();
                }
                else {
                    if (response.statusCode === '422') {
                        var errors = response.msg;
                        $.each(errors, function (k, v) {
                            if (v !== '') {
                                toastr.error(v);
                            }
                        });
                    }
                    else {
                        toastr.error(response.data.message);
                    }
                }
            })
        },
    };
</script>
