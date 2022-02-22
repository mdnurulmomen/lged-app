<form class="card" id="send_memo_to_rpu_form" autocomplete="off">
    <div class="m-5">
        <div class="row">
            <div class="col-md-6">
                <label>স্মারক নং</label>
                <input class="form-control" name="memo_sharok_no" placeholder="স্মারক নং">
            </div>
            <div class="col-md-6">
                <label>স্মারক তারিখ</label>
                <input class="form-control date" name="memo_send_date" placeholder="স্মারক তারিখ">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label class="col-form-label">দলনেতা</label>
                <input class="form-control" value="{{$memoInfo['team_leader_name'].' ('.$memoInfo['team_leader_designation'].')'}}" readonly>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label class="col-form-label">উপদলনেতা</label>
                <input class="form-control" value="{{empty($memoInfo['sub_team_leader_name'])?'':$memoInfo['sub_team_leader_name'].' ('.$memoInfo['sub_team_leader_designation'].')'}}" readonly>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <label class="col-form-label text-primary bold mr-3">ইস্যুকারীঃ</label>
                <input type="radio" class="mr-1" name="issued_by" value="team_leader" {{empty($memoInfo['sub_team_leader_name'])?'checked':''}}><span class="mr-3">দলনেতা</span>
                <input type="radio" class="mr-1" name="issued_by" value="sub_team_leader" {{empty($memoInfo['sub_team_leader_name'])?'':'checked'}}><span class="mr-3">উপদলনেতা</span>
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
        <button class="btn btn-sm btn-square btn-outline-primary float-right"
                data-memo-id="{{$memoInfo['id']}}"
                onclick="Memo_List_Container.sentMemoToRpu($(this))">
            <i class="fa fa-paper-plane"></i> প্রেরণ করুন
        </button>
    </div>
</div>
