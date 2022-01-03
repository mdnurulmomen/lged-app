<style>
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
        box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
</style>

<form style="height: 100vh" id="score_create_form" autocomplete="off">
    <div class="row">
        <div class="col-md-6">
            <label class="col-form-label">ক্যাটাগরি<span class="text-danger">*</span></label>
            <select class="form-control select-select2" name="category_id" id="category_id">
                <option value="0">বাছাই করুন</option>
                @foreach($categories as $category)
                    <option value="{{$category['id']}}" data-category-title-en="{{$category['category_title_en']}}"
                            data-category-title-bn="{{$category['category_title_bn']}}">{{$category['category_title_bn']}}</option>
                @endforeach
            </select>

            <input type="hidden" name="category_title_en" id="category_title_en">
            <input type="hidden" name="category_title_bn" id="category_title_bn">
        </div>
        <div class="col-md-6">
            <label class="col-form-label">অর্থ বছর</label>
            <select class="form-control select-select2" name="fiscal_year_id">
                <option value="">--সিলেক্ট--</option>
                @foreach($fiscal_years as $fiscal_year)
                    <option
                        value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['start']?'selected':''}}>{{$fiscal_year['description']}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="ministry_id" class="col-form-label">মন্ত্রণালয়/বিভাগ<span class="text-danger">*</span></label>
            <select class="form-control select-select2" name="ministry_id" id="ministry_id">
                <option value="0">বাছাই করুন</option>
                @foreach($ministries as $ministry)
                    <option value="{{$ministry['id']}}">{{$ministry['name_bng']}}</option>
                @endforeach
            </select>
            <input type="hidden" name="ministry_name_en" class="form-control ministry_name">
            <input type="hidden" name="ministry_name_bn" class="form-control ministry_name">
        </div>
        <div class="col-md-6">
            <label for="entity_id" class="col-form-label">এনটিটি/সংস্থা</label>
            <select class="form-control select-select2" name="entity_id" id="entity_id">
                <option value="">--সিলেক্ট--</option>
            </select>
            <input type="hidden" name="entity_name_en" class="form-control entity_name">
            <input type="hidden" name="entity_name_bn" class="form-control entity_name">
        </div>
    </div>

    {{--style="overflow-y: scroll;height: 28em"--}}
    <div style="overflow-y: scroll;height: 24em" class="row mt-5 mb-5">
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
                        <th width="25%">Score</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($criteriaList as $criteria)
                        <tr class="criteria_row">
                            <td>
                                <input type="hidden" name="criteria_ids[]" value="{{$criteria['id']}}" class="criteria_id">
                                {{$criteria['name_bn']}}
                            </td>
                            <td><input type="text" name="values[]" class="form-control"></td>
                            <td><input type="number" min="0" max="5" name="scores[]" onkeyup="if(this.value > 5) this.value = null;" class="form-control score"></td>
                        </tr>
                    @endforeach
                    <tr>
                        <th>Total</th>
                        <th></th>
                        <th><span id="finalTotalScore"></span></th>
                    </tr>
                    </tbody>
                </table>
            </fieldset>
        </div>
    </div>

    <button type="button" class="btn btn-success btn-sm btn-bold btn-square"
        onclick="auditAssessmentScoreSubmit('insert','')">
        <i class="far fa-save mr-1"></i> সংরক্ষণ করুন
    </button>
</form>


<script>
    $("select#ministry_id").change(function () {
        var ministry_id = $('#ministry_id').val();
        loadEntity(ministry_id);
    });

    function loadEntity(ministry_id) {
        url = '{{route('audit.plan.annual.audit-assessment-score.load-ministry-wise-entity')}}';
        data = {ministry_id};
        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            if (response.status === 'error') {
                toastr.error('Server Error');
            } else {
                $("#entity_id").html(response);
            }
        });
    }

    $(".score").keyup(calculateTotal);

    function calculateTotal() {
        let finalTotalScore = 0;
        let totalData = $("tr.criteria_row").length * 5;
        $("tr.criteria_row").each(function () {
            let score = $('.score', this).val() == ''?0:parseInt($('.score', this).val());
            finalTotalScore += score;
        });
        let totalPoint = parseFloat(finalTotalScore/totalData).toFixed(2);
        $("#finalTotalScore").text(finalTotalScore+' ('+totalPoint+')');
    }


    function auditAssessmentScoreSubmit(submit_type,id) {
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

        KTApp.block('#kt_content', {
            opacity: 0.1,
            state: 'primary' // a bootstrap color
        });

        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            KTApp.unblock('#kt_content');
            if (response.status === 'success') {
                toastr.success('Successfully Added!');
                fiscal_year_id = $("#fiscal_year_id").val();
                Assessment_Score_Container.list(fiscal_year_id);
            } else {
                if (response.statusCode === '422') {
                    var errors = response.msg;
                    $.each(errors, function (k, v) {
                        if (v !== '') {
                            toastr.error(v);
                        }
                    });
                } else {
                    toastr.error(response.data.message);
                }
            }
        })
    }
</script>

