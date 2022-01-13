<div class="d-flex justify-content-end mt-4">
    <button class="mr-1 btn btn-sm {{$is_delete==1?'btn-outline-primary':'btn-outline-danger'}} btn-square" title="{{$is_delete==1?'ফেরত আনুন':'বাদ দিন'}}"
            data-air-report-id="{{$air_report_id}}"
            data-apotti-id="{{$apotti_id}}"
            data-is-delete="{{$is_delete==1?0:1}}"
            onclick="QAC_Apotti_Edit_Container.softDeleteApotti($(this))">
        @if($is_delete==1)
            ফেরত আনুন
        @else
            বাদ দিন
        @endif
    </button>
</div>


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

        @if($qac_type == 'qac-1')
        <div class="col-md-12">
            <label class="col-form-label">আপত্তির সাথে পরিশিষ্ট মিল আছে কিনা ?</label>
            <div class="col-form-label">
                <div class="radio-inline">
                        <label for="is_same_porishisto_yes" class="radio radio-success">
                            <input @if($qac_apotti_status &&  $qac_apotti_status['is_same_porishisto'] == 1) checked @endif id="is_same_porishisto_yes" type="radio" name="is_same_porishisto" value="1"/>
                            <span></span>
                            হ্যাঁ
                        </label>
                        <label for="is_same_porishisto_no" class="radio radio-success">
                            <input @if($qac_apotti_status && $qac_apotti_status['is_same_porishisto'] == 0) checked @endif id="is_same_porishisto_no" type="radio" name="is_same_porishisto" value="0"/>
                            <span></span>
                            না
                        </label>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <label class="col-form-label">বিধি-বিধান উল্লেখ আছে কিনা ?</label>
            <div class="col-form-label">
                <div class="radio-inline">
                    <label for="is_rules_and_regulation_yes" class="radio radio-success">
                        <input @if($qac_apotti_status && $qac_apotti_status['is_rules_and_regulation'] == 1) checked @endif id="is_rules_and_regulation_yes" type="radio" name="is_rules_and_regulation" value="1"/>
                        <span></span>
                        হ্যাঁ
                    </label>
                    <label for="is_rules_and_regulation_no" class="radio radio-success">
                        <input @if($qac_apotti_status && $qac_apotti_status['is_rules_and_regulation'] == 0) checked @endif id="is_rules_and_regulation_no" type="radio" name="is_rules_and_regulation" value="0"/>
                        <span></span>
                        না
                    </label>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <label class="col-form-label">আপত্তিতে কোন অসম্পূর্ণতা আছে কিনা ?</label>
            <div class="col-form-label">
                <div class="radio-inline">
                    <label for="is_imperfection_yes" class="radio radio-success">
                        <input @if($qac_apotti_status && $qac_apotti_status['is_imperfection'] == 1) checked @endif  id="is_imperfection_yes" type="radio" name="is_imperfection" value="1"/>
                        <span></span>
                        হ্যাঁ
                    </label>
                    <label for="is_imperfection_no" class="radio radio-success">
                        <input @if($qac_apotti_status && $qac_apotti_status['is_imperfection'] == 0) checked @endif id="is_imperfection_no" type="radio" name="is_imperfection" value="0"/>
                        <span></span>
                        না
                    </label>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <label class="col-form-label">আপত্তি রিস্ক অ্যানালাইসিস এরমধ্যে উত্থাপন করা হয়েছে কিনা ?</label>
            <div class="col-form-label">
                <div class="radio-inline">
                    <label for="is_risk_analysis_yes" class="radio radio-success">
                        <input @if($qac_apotti_status && $qac_apotti_status['is_risk_analysis'] == 1) checked @endif id="is_risk_analysis_yes" type="radio" name="is_risk_analysis" value="1"/>
                        <span></span>
                        হ্যাঁ
                    </label>
                    <label for="is_risk_analysis_no" class="radio radio-success">
                        <input @if($qac_apotti_status && $qac_apotti_status['is_risk_analysis'] == 0) checked @endif id="is_risk_analysis_no" type="radio" name="is_risk_analysis" value="0"/>
                        <span></span>
                        না
                    </label>
                </div>
            </div>
        </div>
        @else

        <div class="col-md-12">
            <label class="col-form-label">ব্রডশিট জবাব পাওয়া গিয়েছে কিনা ?</label>
            <div class="col-form-label">
                <div class="radio-inline">
                    <label for="is_broadsheet_response_yes" class="radio radio-success">
                        <input @if($qac_apotti_status && $qac_apotti_status['is_broadsheet_response'] == 1) checked @endif id="is_broadsheet_response_yes" type="radio" name="is_broadsheet_response" value="1"/>
                        <span></span>
                        হ্যাঁ
                    </label>
                    <label for="is_broadsheet_response_no" class="radio radio-success">
                        <input @if($qac_apotti_status && $qac_apotti_status['is_broadsheet_response'] == 0) checked @endif id="is_broadsheet_response_no" type="radio" name="is_broadsheet_response" value="0"/>
                        <span></span>
                        না
                    </label>
                </div>
            </div>
        </div>
        @endif

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

<script>
    var QAC_Apotti_Edit_Container ={
        softDeleteApotti: function (elem){
            air_report_id = elem.data('air-report-id');
            apotti_id = elem.data('apotti-id');
            is_delete = elem.data('is-delete');
            data = {air_report_id,apotti_id,is_delete};
            let url = '{{route('audit.report.air.qac.delete-air-report-wise-apotti')}}';
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    toastr.success('সফলভাবে সংরক্ষণ করা হয়েছে');
                    $('#btn_filter').click();
                    $('#kt_quick_panel_close').click();
                }
            });
        }
    }
</script>
