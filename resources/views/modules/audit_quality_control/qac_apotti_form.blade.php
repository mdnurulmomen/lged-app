<form id="apotti_qac_form">
    <div class="form-row pt-4">
        <input type="hidden" name="apotti_id" value="{{$apotti_id}}">

        @if($qac_type == 'qac-1')
            <div class="col-md-12">
                    <label class="col-form-label">Audit Criteria ঠিক আছে কিনা ?</label>
                    <div class="col-form-label">
                        <div class="radio-inline">
                            <label for="is_audit_criteria_yes" class="radio radio-success">
                                <input @if($qac_apotti_status &&  $qac_apotti_status['is_audit_criteria'] == 1) checked @endif id="is_audit_criteria_yes" type="radio" name="is_audit_criteria" value="1"/>
                                <span></span>
                                হ্যাঁ
                            </label>
                            <label for="is_audit_criteria_no" class="radio radio-success">
                                <input @if($qac_apotti_status && $qac_apotti_status['is_audit_criteria'] == 0) checked @endif id="is_audit_criteria_no" type="radio" name="is_audit_criteria" value="0"/>
                                <span></span>
                                না
                            </label>
                        </div>
                    </div>
                </div>
            <div class="col-md-12">
                    <label class="col-form-label">আপত্তিটি 5W 1H মডেল প্যারা অনুসারে করা হয়েছে কিনা ?</label>
                    <div class="col-form-label">
                        <div class="radio-inline">
                            <label for="is_5w_pera_model_yes" class="radio radio-success">
                                <input @if($qac_apotti_status && $qac_apotti_status['is_5w_pera_model'] == 1) checked @endif  id="is_5w_pera_model_yes" type="radio" name="is_5w_pera_model" value="1"/>
                                <span></span>
                                হ্যাঁ
                            </label>
                            <label for="is_5w_pera_model_no" class="radio radio-success">
                                <input @if($qac_apotti_status && $qac_apotti_status['is_5w_pera_model'] == 0) checked @endif id="is_5w_pera_model_no" type="radio" name="is_5w_pera_model" value="0"/>
                                <span></span>
                                না
                            </label>
                        </div>
                    </div>
                </div>
            <div class="col-md-12">
                    <label class="col-form-label">বিধি-বিধান সঠিকভাবে উল্লেখ আছে কিনা ?</label>
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
                <label class="col-form-label">আপত্তিটি  উপযুক্ত প্রমাণক দ্বারা সমর্থিত কিনা ?</label>
                <div class="col-form-label">
                    <div class="radio-inline">
                        <label for="is_apotti_evidence_yes" class="radio radio-success">
                            <input @if($qac_apotti_status && $qac_apotti_status['is_apotti_evidence'] == 1) checked @endif  id="is_apotti_evidence_yes" type="radio" name="is_apotti_evidence" value="1"/>
                            <span></span>
                            হ্যাঁ
                        </label>
                        <label for="is_apotti_evidence_no" class="radio radio-success">
                            <input @if($qac_apotti_status && $qac_apotti_status['is_apotti_evidence'] == 0) checked @endif id="is_apotti_evidence_no" type="radio" name="is_apotti_evidence" value="0"/>
                            <span></span>
                            না
                        </label>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-12">
                <label class="col-form-label">অডিট Criteria -এর  আলোকে প্রযোজ্য বিধি বিধান Quote করা হয়েছে কিনা ?</label>
                <div class="col-form-label">
                    <div class="radio-inline">
                        <label for="is_audit_criteria_yes" class="radio radio-success">
                            <input @if($qac_apotti_status &&  $qac_apotti_status['is_audit_criteria'] == 1) checked @endif id="is_audit_criteria_yes" type="radio" name="is_audit_criteria" value="1"/>
                            <span></span>
                            হ্যাঁ
                        </label>
                        <label for="is_audit_criteria_no" class="radio radio-success">
                            <input @if($qac_apotti_status && $qac_apotti_status['is_audit_criteria'] == 0) checked @endif id="is_audit_criteria_no" type="radio" name="is_audit_criteria" value="0"/>
                            <span></span>
                            না
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <label class="col-form-label">5W ও 1H সকল এর সকল ধাপ পরিপালন করে আপত্তি গঠন করা হয়েছে কিনা ?</label>
                <div class="col-form-label">
                    <div class="radio-inline">
                        <label for="is_5w_pera_model_yes" class="radio radio-success">
                            <input @if($qac_apotti_status && $qac_apotti_status['is_5w_pera_model'] == 1) checked @endif  id="is_5w_pera_model_yes" type="radio" name="is_5w_pera_model" value="1"/>
                            <span></span>
                            হ্যাঁ
                        </label>
                        <label for="is_5w_pera_model_no" class="radio radio-success">
                            <input @if($qac_apotti_status && $qac_apotti_status['is_5w_pera_model'] == 0) checked @endif id="is_5w_pera_model_no" type="radio" name="is_5w_pera_model" value="0"/>
                            <span></span>
                            না
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <label class="col-form-label">আপত্তির সমর্থনে উপযুক্ত প্রমাণকের সঠিকতা যাচাই করা হয়েছে কিনা ?</label>
                <div class="col-form-label">
                    <div class="radio-inline">
                        <label for="is_same_porishisto_yes" class="radio radio-success">
                            <input @if($qac_apotti_status && $qac_apotti_status['is_same_porishisto'] == 1) checked @endif  id="is_same_porishisto_yes" type="radio" name="is_same_porishisto" value="1"/>
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
                <label class="col-form-label">আপত্তির বিবরণে উল্লিখিত Criteria-এর সাথে অনিয়মের কারণ অংশের মিল আছে কিনা
                    ?</label>
                <div class="col-form-label">
                    <div class="radio-inline">
                        <label for="is_criteria_same_as_irregularity_yes" class="radio radio-success">
                            <input
                                @if($qac_apotti_status && $qac_apotti_status['is_criteria_same_as_irregularity'] == 1) checked
                                @endif id="is_criteria_same_as_irregularity_yes" type="radio"
                                name="is_criteria_same_as_irregularity" value="1"/>
                            <span></span>
                            হ্যাঁ
                        </label>
                        <label for="is_criteria_same_as_irregularity_no" class="radio radio-success">
                            <input
                                @if($qac_apotti_status && $qac_apotti_status['is_criteria_same_as_irregularity'] == 0) checked
                                @endif id="is_criteria_same_as_irregularity_no" type="radio"
                                name="is_criteria_same_as_irregularity" value="0"/>
                            <span></span>
                            না
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
            <label class="col-form-label">নিরীক্ষা মন্তব্য অংশে অডিটি প্রতিষ্ঠানের জবাবের আলোকে মন্তব্য প্রদান করা হয়েছে কিনা ?</label>
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

        <div class="col-md-12">
            <label class="col-form-label">আপত্তির ক্যাটাগরি বাছাই করুন</label>
            <select class="form-control select-select2" name="apotti_type">
                <option value="">আপত্তির ক্যাটাগরি বাছাই করুন</option>

                <option @if($qac_apotti_status && isset($qac_apotti_status['apotti_type']) && $qac_apotti_status['apotti_type'] == 'sfi')
                        selected
                        @endif value="sfi">এসএফআই</option>

                @if($qac_type == 'qac-1')
                    <option @if($qac_apotti_status && isset($qac_apotti_status['apotti_type']) && $qac_apotti_status['apotti_type'] == 'non-sfi')
                            selected
                            @endif
                            value="non-sfi">নন-এসএফআই</option>
                    <option @if($qac_apotti_status && isset($qac_apotti_status['apotti_type']) && $qac_apotti_status['apotti_type'] == 'reject')
                            selected
                            @endif
                            value="reject"> প্রত্যাহার </option>
                @endif
                @if($qac_type == 'qac-2')
                    <option @if($qac_apotti_status && isset($qac_apotti_status['apotti_type']) && $qac_apotti_status['apotti_type'] == 'draft')
                            selected
                            @endif
                            value="draft"> রিপোর্ট ভুক্তির জন্য প্রস্তাবকৃত এসএফআই </option>
                @endif
            </select>
        </div>

        <div class="col-md-12 mb-2">
            <label class="col-form-label">মন্তব্য</label>
            <textarea class="form-control mb-1" name="comment" placeholder="মন্তব্য" cols="30" rows="2">@if($qac_apotti_status && isset($qac_apotti_status['comment'])){{$qac_apotti_status['comment']}}@endif</textarea>
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
        },

        apottiFinalApproval: function (elem){
            air_report_id = elem.data('air-report-id');
            apotti_id = elem.data('apotti-id');
            final_status = elem.data('final-approval-status');
            data = {air_report_id,apotti_id,final_status};
            let url = '{{route('audit.report.air.qac.apotti-final-approval-status')}}';
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    toastr.success('সফলভাবে সংরক্ষণ করা হয়েছে');
                    $('#btn_filter').click();
                    $('#kt_quick_panel_close').click();
                }
            });
        },
    }
</script>
