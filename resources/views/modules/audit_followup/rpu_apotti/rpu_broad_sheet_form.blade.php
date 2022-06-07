<form id="broad_sheet_form">

    <div class="row">
        <input type="hidden" value="{{implode(',',$apottis)}}" name="apottis">
        <div class="col-md-6">
            <label for="memorandum_no">স্মারক নং</label>
            <input class="form-control" type="text" name="memorandum_no" id="memorandum_no">

        </div>
        <div class="col-md-6">
            <label for="memorandum_date">স্মারক তারিখ</label>
            <input class="form-control date" type="text" name="memorandum_date" id="memorandum_date" autocomplete="off">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label for="details">প্রাপকের বিস্তারিত</label>
            <textarea class="form-control" id="receiver_details" name="receiver_details" cols="30" rows="2"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label for="details">বিষয়</label>
            <textarea class="form-control" id="subject" name="subject" cols="30" rows="2"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label for="details">বিস্তারিত</label>
            <textarea class="form-control" id="details" name="details" cols="30" rows="2"></textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <label for="details">অনুলিপি</label>
            <textarea class="form-control" id="cc_list" name="cc_list" cols="30" rows="2"></textarea>
        </div>
    </div>

</form>

<div class="row mt-2">
    <div class="col-md-12">
        <button class="btn btn-sm btn-square btn-outline-primary float-right"
                onclick="Rpu_Apotti_Container.rpuBroadSheetSubmit($(this))">
            <i class="fa fa-save"></i> প্রেরণ করুন
        </button>
    </div>
</div>
