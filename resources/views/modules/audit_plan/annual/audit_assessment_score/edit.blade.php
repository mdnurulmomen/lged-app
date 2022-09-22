<form style="height: 100vh" id="score_create_form" autocomplete="off">
    <input type="hidden" name="point" id="totalPoint">
    <div class="row">
        <div class="col-md-6">
            <label class="col-form-label">অর্থ বছর<span class="text-danger">*</span></label>
            <select class="form-control select-select2" name="fiscal_year_id">
                <option value="">--সিলেক্ট--</option>
                @foreach($fiscal_years as $fiscal_year)
                    <option
                        value="{{$fiscal_year['id']}}" {{$auditAssessmentScoreInfo['fiscal_year_id']==$fiscal_year['id']?'selected':''}}>{{$fiscal_year['description']}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="col-form-label">মন্ত্রণালয়/বিভাগ<span class="text-danger">*</span></label>
            <input type="text" value="{{$auditAssessmentScoreInfo['ministry_name_en']}}" name="ministry_name_bn" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label class="col-form-label">ক্যাটাগরি<span class="text-danger">*</span></label>
            <input class="form-control" type="text" value="{{$auditAssessmentScoreInfo['category_title_bn']}}" name="category_title_bn">
        </div>

        <div class="col-md-6">
            <label class="col-form-label">এনটিটি/সংস্থা<span class="text-danger">*</span></label>
            <input type="text" name="entity_name_bn" value="{{$auditAssessmentScoreInfo['entity_name_bn']}}" class="form-control">
        </div>
    </div>

    {{--style="overflow-y: scroll;height: 28em"--}}
    <div class="row mt-5 mb-5">
        <div class="col-md-12">
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">
                    ডাটাসমূহ
                </legend>
                <table width="100%" class="table table-bordered table-striped table-hover table-condensed table-sm"
                       id="tblAuditAssessmentScore">
                    <thead>
                    <tr>
                        <th width="40%">Criteria</th>
                        <th width="35%">Value</th>
                        <th width="25%">Score(0-5)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($auditAssessmentScoreInfo['audit_assessment_score_items'] as $item)
                        <tr class="criteria_row">
                            <td>
                                <input type="hidden" name="criteria_ids[]" value="{{$item['id']}}" class="criteria_id">
                                {{$item['criteria']['name_bn']}}
                            </td>
                            <td><input type="text" value="{{$item['value']}}" name="values[]" class="form-control"></td>
                            <td><input type="number" min="0" max="5" value="{{$item['score']}}" name="scores[]" onkeyup="if(this.value > 5 || this.value < 0) this.value = null;" class="form-control score"></td>
                        </tr>
                    @endforeach
                    <tr>
                        <th>Total</th>
                        <th></th>
                        <th>{{$auditAssessmentScoreInfo['total_score'].' ('.$auditAssessmentScoreInfo['point'].')'}}</th>
                    </tr>
                    </tbody>
                </table>
            </fieldset>
        </div>
    </div>

    {{--<button type="button" class="btn btn-success btn-sm btn-bold btn-square"
        onclick="">
        <i class="far fa-save mr-1"></i> সংরক্ষণ করুন
    </button>--}}
</form>


<script>
    var Audit_Assessment_Score_Edit_Container = {
        auditAssessmentScoreSubmit: function (submit_type,id) {
            let category = $("#category_id");
            let category_title_en = category.find('option:selected').attr('data-category-title-en');
            let category_title_bn = category.find('option:selected').attr('data-category-title-bn');
            $("#category_title_en").val(category_title_en);
            $("#category_title_bn").val(category_title_bn);

            let ministry_name = $( "#ministry_id option:selected" ).text();
            $(".ministry_name").val(ministry_name);
            let entity_name = $( "#entity_id option:selected" ).text();
            $(".entity_name").val(entity_name);

            url = '{{route('audit.plan.annual.audit-assessment-score.store')}}';
            data = $('#score_create_form').serialize();

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'success') {
                    toastr.success('Successfully Added!');
                    fiscal_year_id = $("#fiscal_year_id").val();
                    Assessment_Score_Container.list(fiscal_year_id);
                } else {
                    toastr.error(response.data.message);
                }
            })
        }
    };
</script>

