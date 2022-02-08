<form class="ml-10 card" id="send_memo_to_rpu_form">
    <div class="m-5">
        <div class="row">
            <div class="col-md-6">
                <label>স্মারক  নং</label>
                <input class="form-control" name="memo_sharok_no">
            </div>
            <div class="col-md-6">
                <label>তারিখ</label>
                <input class="form-control date" name="memo_send_date">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label class="col-form-label">প্রতিষ্ঠান প্রধানের পদবী</label>
                <input type="text" class="form-control mb-1" name="rpu_acceptor_designation_name_bn"
                       placeholder="প্রতিষ্ঠান প্রধানের পদবী">
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <label>অনুলিপি</label>
                <textarea class="form-control" name="memo_cc"></textarea>
            </div>
        </div>
    </div>
</form>
<div class="row mt-2">
    <div class="col-md-12">
        <button class="btn btn-sm btn-square btn-outline-primary mr-2 float-right"
                data-memo-id="{{$memo_id}}"
                onclick="Memo_List_Container.sentMemoListToRpu($(this))"><i class="fa fa-paper-plane"></i> প্রেরণ
        </button>
    </div>
</div>
