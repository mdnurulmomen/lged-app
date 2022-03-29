<form class="card" id="apoitti_decision_form" autocomplete="off">
    <input type="hidden" name="broad_sheet_id" value="{{$broad_sheet_id}}">
    <input type="hidden" name="apotti_item_id" value="{{$apotti_item_id}}">
    <input type="hidden" name="memo_id" value="{{$memo_id}}">
    <input type="hidden" name="office_id" value="{{$office_id}}">
    <div class="m-5">
        @if($broad_sheet_type != 'final_report')
            <div class="row mb-1">
                <div class="col-md-12">
                    <label>জড়িত টাকার পরিমাণ</label>
                    <input class="form-control bijoy-bangla" name="jorito_ortho" value="{{$jorito_ortho}}" readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label>আদায়কৃত অর্থ</label>
                    <input class="form-control bijoy-bangla" name="collected_amount"
                           value="{{isset($apotti_item_info['collected_amount']) ? $apotti_item_info['collected_amount'] : ''}}"
                           placeholder="আদায়কৃত অর্থ">
                </div>
                <div class="col-md-6">
                    <label>সমন্বয় কৃত অর্থ</label>
                    <input class="form-control bijoy-bangla" name="adjusted_amount"
                           value="{{isset($apotti_item_info['adjusted_amount']) ? $apotti_item_info['adjusted_amount'] : ''}}"
                           placeholder="সমন্বয় কৃত অর্থ">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label class="col-form-label">আপত্তির অবস্থা</label>
                    <select name="apotti_status" class="form-control">
                        <option value="0">আপত্তির অবস্থা বাছাই করুন</option>
                        <option @if(isset($apotti_item_info['status']) && $apotti_item_info['status'] == '1') selected
                                @endif value="1">নিষ্পন্ন
                        </option>
                        <option @if(isset($apotti_item_info['status']) && $apotti_item_info['status'] == '2') selected
                                @endif  value="2"> অনিষ্পন্ন
                        </option>
                        <option @if(isset($apotti_item_info['status']) && $apotti_item_info['status'] == '3') selected
                                @endif value="3"> আংশিক নিষ্পন্ন
                        </option>
                    </select>
                </div>
            </div>
        @endif

        @if($office_id != 1)
            <div class="row mt-2">
                <div class="col-md-12">
                    <label>সিএজি মন্তব্য</label>
                    <textarea class="form-control"
                              name="cag_comment">{{isset($apotti_item_info['comment']) ? $apotti_item_info['comment'] : ''}}</textarea>
                </div>
            </div>
        @else
            <div class="row mt-2">
                <div class="col-md-12">
                    <label>অধিদপ্তরের মন্তব্য</label>
                    <textarea class="form-control"
                              name="comment">{{isset($apotti_item_info['comment']) ? $apotti_item_info['comment'] : ''}}</textarea>
                </div>
            </div>
        @endif


    </div>
</form>

<div class="row mt-2">
    <div class="col-md-12">
        <button class="btn btn-sm btn-square btn-outline-primary float-right"
                onclick="ApottiDecision_Container.apottiDecision($(this))">
            <i class="fa fa-save"></i> সিদ্ধান্ত দিন
        </button>
    </div>
</div>
