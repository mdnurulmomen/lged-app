<form id="apotti_qac_form">
    <div class="form-row pt-4">
        <input type="hidden" name="apotti_id" value="{{$apotti_id}}">
        <div class="col-md-12">
            <label class="col-form-label">আপত্তির ধরন বাছাই করুন</label>
            <select class="form-control select-select2" name="apotti_type">
                <option value="">আপত্তির ধরন বাছাই করুন</option>
                <option @if($qac_apotti_status && isset($qac_apotti_status['apotti_type']) && $qac_apotti_status['apotti_type'] == 'sfi')
                        selected
                        @endif value="sfi">এসএফআই</option>
                <option @if($qac_apotti_status && isset($qac_apotti_status['apotti_type']) && $qac_apotti_status['apotti_type'] == 'non-sfi')
                        selected
                        @endif
                        value="non-sfi">নন-এসএফআই</option>
            </select>
        </div>

        <div class="col-md-12 mb-2">
            <label class="col-form-label">মন্তব্য</label>
            <textarea class="form-control mb-1" name="comment"
                      placeholder="মন্তব্য" cols="30"
                      rows="2">
                @if($qac_apotti_status && isset($qac_apotti_status['comment']))
                    {{$qac_apotti_status['comment']}}
                @endif
            </textarea>
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-square btn-outline-primary mr-2"
            onclick="Qac_Container.qacApottiSubmit()"><i class="fa fa-save"></i> সংরক্ষণ
    </button>
</form>
