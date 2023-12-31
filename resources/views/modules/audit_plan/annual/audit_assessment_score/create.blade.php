<form style="height: 100vh" id="score_create_form" autocomplete="off">
    <input type="hidden" name="point" id="totalPoint">
    <div class="row">
        <div class="col-md-6">
            <label class="col-form-label">অর্থ বছর<span class="text-danger">*</span></label>
            <select class="form-control select-select2" name="fiscal_year_id">
                <option value="">--সিলেক্ট--</option>
                @foreach($fiscal_years as $fiscal_year)
                    <option
                        value="{{$fiscal_year['id']}}" {{$fiscal_year['id']==$current_fiscal_year?'selected':''}}>{{$fiscal_year['description']}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label for="ministry_id" class="col-form-label">মন্ত্রণালয়/বিভাগ<span class="text-danger">*</span></label>
            <select class="form-control select-select2" name="ministry_id" id="ministry_id">
                <option value="">বাছাই করুন</option>
                @foreach($ministries as $ministry)
                    <option value="{{$ministry['id']}}">{{$ministry['name_bng']}}</option>
                @endforeach
            </select>
            <input type="hidden" name="ministry_name_en" class="form-control ministry_name">
            <input type="hidden" name="ministry_name_bn" class="form-control ministry_name">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label class="col-form-label">ক্যাটাগরি<span class="text-danger">*</span></label>
            <select class="form-control select-select2" name="category_id" id="category_id">
                <option value="">বাছাই করুন</option>
                @foreach($categories as $category)
                    <option value="{{$category['id']}}" data-category-title-en="{{$category['category_title_en']}}"
                            data-category-title-bn="{{$category['category_title_bn']}}">{{$category['category_title_bn']}}</option>
                @endforeach
            </select>

            <input type="hidden" name="category_title_en" id="category_title_en">
            <input type="hidden" name="category_title_bn" id="category_title_bn">
        </div>

        <div class="col-md-6">
            <label for="entity_id" class="col-form-label">এনটিটি/সংস্থা<span class="text-danger">*</span></label>
            <select class="form-control select-select2" name="entity_id" id="entity_id">
                <option value="">--সিলেক্ট--</option>
            </select>
            <input type="hidden" name="entity_name_en" class="form-control entity_name">
            <input type="hidden" name="entity_name_bn" class="form-control entity_name">
            <input type="hidden" name="last_audit_year_start" class="form-control last_audit_year_start">
            <input type="hidden" name="last_audit_year_end" class="form-control last_audit_year_end">
        </div>
    </div>

    {{--style="overflow-y: scroll;height: 28em"--}}
    <div style="overflow-y: scroll;height: 21em" class="row mt-5 mb-5">
        <div class="col-md-12">
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">
                    ডাটাসমূহ
                </legend>
                <div id="criteriaTableList"></div>
            </fieldset>
        </div>
    </div>

    <button type="button" class="btn btn-success btn-sm btn-bold btn-square"
        onclick="Audit_Assessment_Score_Create_Container.auditAssessmentScoreSubmit()">
        <i class="far fa-save mr-1"></i> সংরক্ষণ করুন
    </button>
</form>


<script>
    $("select#ministry_id").change(function () {
        let category_id = $('#category_id').val();
        Audit_Assessment_Score_Create_Container.loadCriteriaList(category_id);

        let ministry_id = $('#ministry_id').val();
        Audit_Assessment_Score_Create_Container.loadEntityList(ministry_id,category_id);
    });

    $("select#category_id").change(function () {
        let category_id = $('#category_id').val();
        Audit_Assessment_Score_Create_Container.loadCriteriaList(category_id);

        let ministry_id = $('#ministry_id').val();
        Audit_Assessment_Score_Create_Container.loadEntityList(ministry_id,category_id);
    });


    var Audit_Assessment_Score_Create_Container = {
        loadCriteriaList: function (category_id) {
            url = '{{route('audit.plan.annual.audit-assessment-score.load-criteria-list')}}';
            data = {category_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                $("#criteriaTableList").html(response);
            });
        },

        loadEntityList: function (ministry_id,category_id) {
            url = '{{route('audit.plan.annual.audit-assessment-score.load-ministry-wise-entity')}}';
            data = {ministry_id,category_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error('Server Error');
                } else {
                    $("#entity_id").html(response);
                }
            });
        },

        auditAssessmentScoreSubmit: function () {
            let category = $("#category_id");
            let category_title_en = category.find('option:selected').attr('data-category-title-en');
            let category_title_bn = category.find('option:selected').attr('data-category-title-bn');
            $("#category_title_en").val(category_title_en);
            $("#category_title_bn").val(category_title_bn);

            let ministry_name = $( "#ministry_id option:selected" ).text();
            $(".ministry_name").val(ministry_name);
            let entity_name = $( "#entity_id option:selected" ).text();
            $(".entity_name").val(entity_name);

            let last_audit_year_start = $("#entity_id").find(':selected').attr('data-last-audit-year-start');
            let last_audit_year_end = $("#entity_id").find(':selected').attr('data-last-audit-year-end');
            $(".last_audit_year_start").val(last_audit_year_start);
            $(".last_audit_year_end").val(last_audit_year_end);

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

