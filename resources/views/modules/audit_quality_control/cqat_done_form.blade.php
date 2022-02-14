<form class="card" id="cqat_done_form" autocomplete="off">
    <input type="hidden" name="air_id" value="{{$air_report_id}}">
    <input type="hidden" name="qac_type" value="{{$qac_type}}">
    <div class="m-5">
        <div class="row">
            <div class="col-md-12">
                <label>তারিখ</label>
                <input class="form-control date" name="approved_date" placeholder="তারিখ">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <label>মন্তব্য</label>
                <textarea class="form-control" name="comment"></textarea>
            </div>
        </div>
    </div>
</form>
<div class="row mt-2">
    <div class="col-md-12">
        <button class="btn btn-sm btn-square btn-outline-primary float-right"
                onclick="QAC_Apotti_List_Container.ApprovedCqat($(this))">
            <i class="fa fa-save"></i> সম্পন্ন করুন
        </button>
    </div>
</div>
