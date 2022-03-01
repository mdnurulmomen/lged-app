<form class="card" id="apoitti_decision_form" autocomplete="off">
    <input type="hidden" name="broad_sheet_id" value="{{$broad_sheet_id}}" >
    <input type="hidden" name="apotti_item_id" value="{{$apotti_item_id}}" >
    <input type="hidden" name="memo_id" value="{{$memo_id}}" >
    <div class="m-5">
        <div class="row mb-1">
            <div class="col-md-12">
                <label>জড়িত টাকার পরিমাণ</label>
                <input class="form-control bijoy-bangla font-size-h3" name="jorito_ortho"  value="{{$jorito_ortho}}" readonly>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label>আদায়কৃত অর্থ</label>
                <input class="form-control bijoy-bangla font-size-h3" name="collected_amount" placeholder="আদায়কৃত অর্থ">
            </div>
            <div class="col-md-6">
                <label>সমন্বয় কৃত অর্থ</label>
                <input class="form-control bijoy-bangla font-size-h3" name="adjusted_amount" placeholder="সমন্বয় কৃত অর্থ">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label class="col-form-label">আপত্তির অবস্থা</label>
                <select name="apotti_status" class="form-control">
                    <option value="">আপত্তির অবস্থা বাছাই করুন</option>
                    <option value="resolved">নিষ্পন্ন</option>
                    <option value="partially_resolved">আংশিক নিষ্পন্ন</option>
                    <option value="unresolved">অনিষ্পন্ন</option>
                </select>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <label>মন্তব্য</label>
                <textarea class="form-control" name="apotti_comment"></textarea>
            </div>
        </div>
    </div>
</form>

<div class="row mt-2">
    <div class="col-md-12">
        <button class="btn btn-sm btn-square btn-outline-primary float-right"
                onclick="ApottiDecision_Container.apottiDecision($(this))">
            <i class="fa fa-paper-plane"></i> প্রেরণ করুন
        </button>
    </div>
</div>
