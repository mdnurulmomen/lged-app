<form class="card" id="send_broad_sheet_to_rpu" autocomplete="off">
    <input type="hidden" name="broad_sheet_id" value="{{$broad_sheet_id}}">
    <input type="hidden" name="ref_memorandum_no" value="{{$memorandum_no}}">
    <div class="m-5">
        <div class="row">
            <div class="col-md-6">
                <label>স্মারক নং<span class="text-danger">*</span></label>
                <input class="form-control" name="memorandum_no" placeholder="স্মারক নং">
            </div>
            <div class="col-md-6">
                <label>স্মারক তারিখ<span class="text-danger">*</span></label>
                <input class="form-control date" name="memorandum_date" placeholder="স্মারক তারিখ">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="rpu_office_head_details">বরাবর <span class="text-danger">*</span></label>
                <textarea class="form-control" id="rpu_office_head_details" name="rpu_office_head_details" cols="30" rows="2"></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="subject">বিষয় <span class="text-danger">*</span></label>
                <input type="text" id="subject" class="form-control" name="subject" placeholder="বিষয়">
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <label for="description">বিস্তারিত<span class="text-danger">*</span></label>
                <textarea class="form-control" id="description" name="description" cols="30" rows="4"></textarea>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <label>অনুলিপি</label>
                <textarea class="form-control" name="braod_sheet_cc"></textarea>
            </div>
        </div>
    </div>
</form>
<div class="row mt-2">
    <div class="col-md-12">
        <button class="btn btn-sm btn-square btn-outline-primary float-right"
                onclick="Broadsheet_Reply_List_Container.storeBroadSheetReply($(this))">
            <i class="fa fa-paper-plane"></i> সংরক্ষণ করুন
        </button>
    </div>
</div>
