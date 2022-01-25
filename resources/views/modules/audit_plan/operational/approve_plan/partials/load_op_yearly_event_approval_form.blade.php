<!--begin::Table-->
<form class="mb-10" id="approval_form">
    <input type="hidden" name="fiscal_year_id" value="{{$fiscal_year_id}}">
    <input type="hidden" name="op_audit_calendar_event_id" value="{{$op_audit_calendar_event_id}}">
    <input type="hidden" name="office_id" value="{{$office_id}}">
    <input type="hidden" name="annual_plan_main_id" value="{{$annual_plan_main_id}}">
    <input type="hidden" name="activity_type" value="{{$activity_type}}">
    <input type="hidden" name="receiver_type" value="sender">

    <div class="row">
        <div class="col-md-12">
            <div class="form-row">
                <div class="col-md-12">
                    <label>Status</label>
                    <select class="form-control select-select2" name="status">
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="reject">Reject</option>
                    </select>
                </div>
            </div>
            <div class="form-row pb-4">
                <div class="col-md-12">
                    <label for="comments">মন্তব্য</label>
                    <textarea class="form-control" id="comments" name="comments"></textarea>
                </div>
            </div>

            <div class="text-left mt-5">
                <a tabindex="0" href="javascript:;" role="button"
                   onclick="Approve_Plan_List_Container.sendAnnualPlanReceiverToSender()"
                   class="btn btn-primary btn-sm btn-square btn-forward">
                    <i class="fa fa-paper-plane"></i>প্রেরণ করুন</a>
            </div>
        </div>
    </div>
</form>

<div class="annual-plan-view"></div>
<!--end::Table-->
