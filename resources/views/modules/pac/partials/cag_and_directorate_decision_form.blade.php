<button class="btn btn-sm btn-square btn-warning float-right"
        data-apotti-id="{{$apotti_item_info['apotti_id']}}"
        onclick="CagAndDirectorateDecision_Container.backToMargedApotti($(this))">
    <i class="fa fa-arrow-left"></i> ফেরত যান
</button>

<form class="card" id="apoitti_decision_form" autocomplete="off">
    <input type="hidden" name="apotti_item_id" value="{{$apotti_item_info['id']}}">
    <div class="m-5">
        <div class="row mt-2">
            <div class="col-md-12">
                <label>আপত্তির শিরোনাম</label>
                <textarea class="form-control float-left" readonly
                          placeholder="আপত্তির শিরোনাম">{{$apotti_item_info['memo_title_bn']}}</textarea>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <label>নিরীক্ষিত প্রতিষ্ঠানের জবাব</label>
                <textarea class="form-control float-left" readonly
                          placeholder="নিরীক্ষিত প্রতিষ্ঠানের জবাব">{{$apotti_item_info['unit_response']}}</textarea>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <label>সংস্থার নির্বাহী প্রধানের জবাব</label>
                <textarea class="form-control float-left" readonly
                          placeholder="সংস্থার নির্বাহী প্রধানের জবাব">{{$apotti_item_info['entity_response']}}</textarea>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <label>মন্ত্রণালয়/বিভাগ/অন্যান্য এর জবাব</label>
                <textarea class="form-control float-left" readonly
                          placeholder="মন্ত্রণালয়/বিভাগ/অন্যান্য এর জবাব">{{$apotti_item_info['ministry_response']}}</textarea>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <label>সিএজি মন্তব্য</label>
                <textarea class="form-control float-left" name="cag_comment"
                          placeholder="সিএজি মন্তব্য"></textarea>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <label>অধিদপ্তরের মন্তব্য</label>
                <textarea class="form-control float-left" name="directorate_comment"
                          placeholder="অধিদপ্তরের মন্তব্য"></textarea>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <label>অবস্থা</label>
                <select class="form-control" id="apotti_status" name="apotti_status">
                    <option value="0">অবস্থা বাছাই করুন</option>
                    <option value="1">নিস্পন্ন</option>
                    <option value="2">অনিস্পন্ন</option>
                    <option value="3">আংশিক নিস্পন্ন</option>
                </select>
            </div>
        </div>
    </div>
</form>

<div class="row mt-2">
    <div class="col-md-12">
        <button class="btn btn-sm btn-square btn-primary float-right"
                onclick="Pac_MeetingMinutes_Container.submitPacMeetingDecision($(this))">
            <i class="fa fa-save"></i> সিদ্ধান্ত দিন
        </button>
    </div>
</div>
