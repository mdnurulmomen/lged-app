<!--begin::Table-->
<form id="approve_reject_form">
    <div class="row">
        <div class="col-md-12">
            <div class="form-row">
                <div class="col-md-12">
                    <label>Status</label>
                    <select class="form-control select-select2" name="approve_status">
                        <option value="">Select</option>
                        <option value="approve">Approve</option>
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
                <a tabindex="0" href="javascript:;" role="button" onclick=""
                   class="btn btn-primary btn-sm btn-square btn-forward"><i class="fa fa-paper-plane"></i>প্রেরণ করুন</a>
            </div>
        </div>
    </div>
</form>
<!--end::Table-->
