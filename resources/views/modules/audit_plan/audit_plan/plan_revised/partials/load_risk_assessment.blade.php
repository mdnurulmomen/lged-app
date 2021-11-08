<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a data-type="inherent" class="nav-link active" data-toggle="tab" href="#"
           data-target="#inherentRisk">
            সহজাত ঝুঁকি
        </a>
    </li>
    <li class="nav-item">
        <a data-type="control"  class="nav-link navigation-tab-link" data-toggle="tab" href="#" data-target="#controlRisk">
            নিয়ন্ত্রণ ঝুঁকি
        </a>
    </li>
    <li class="nav-item">
        <a data-type="detection" class="nav-link navigation-tab-link" data-toggle="tab" href="#" data-target="#detectionRisk">
            সনাক্ত ঝুঁকি
        </a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane active" id="inherentRisk" role="tabpanel">
            <div class="load_data_inherent"></div>
    </div>

    <div class="tab-pane" id="controlRisk" role="tabpanel">
            <div class="load_data_control"></div>
    </div>

    <div class="tab-pane" id="detectionRisk" role="tabpanel">
        <div class="load_data_detection"></div>
    </div>
</div>

<script>

    $(function () {
        loadData('inherent');
    });

    function setJsonContentFromPlanBook(){
        templateArray.map(function (value, index) {
            cover = $("#pdfContent_" + value.content_id).html();
            value.content = cover;
        });
    }

    $('[data-toggle="tab"]').click(function(e) {
        type = $(this).attr('data-type');

        if ( !$('.load_data_'+type ).children().length > 0 ) {
            loadData(type);
        }

    });


    function loadData(risk_assessment_type) {
        data = {risk_assessment_type};
        url = '{{route('audit.plan.audit.editor.load-risk-assessment-type-wise-list')}}';
        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            // KTApp.unblock('.content');
            if (response.status === 'error') {
                toastr.error('No data found');
            } else {
                $('.load_data_'+risk_assessment_type).html(response);
            }
        })
    }

    function calculateRiskRate(risk_type){
        checked_count = $('.select_'+risk_type).filter(':checked').length;

        if(!checked_count){
            toastr.warning('Please Select Risk Assessment');
            return;
        }
        total_number = 0;

        $(".number_"+risk_type).each(function () {
            total_number += +$(this).val();
        });

        if(!total_number){
            toastr.warning('Please Enter Value For Risk Assessment');
            return;
        }

        total_value = checked_count * 5;

        risk_rate = total_number /  total_value;

        risk = '';
        risk_en = '';

        if(risk_rate >= 0 && risk_rate <= 0.2){
            risk = 'নিম্ন ঝুঁকি';
            risk_en = 'low'
        }else if(risk_rate > 0.2 && risk_rate <= 0.6){
            risk = 'মধ্যম ঝুঁকি';
            risk_en = 'medium'
        }else if(risk_rate > 0.6 && risk_rate <= 1.0){
            risk = 'উচ্চ ঝুঁকি';
            risk_en = 'high'
        }


        $('.risk_rate_number_'+risk_type).text(risk_rate);
        $('#risk_rate_'+risk_type).val(risk_rate);

        $('.risk_rate_'+risk_type).text(' ( '+risk+' )');
        $('#total_risk_value_'+risk_type).val(total_number);

        $('#risk_'+risk_type).val(risk_en);

        $('.risk_rate_div_'+risk_type).show();

        $('.save_'+risk_type).prop("disabled",false);
    }

    function riskRateSubmit(risk_type) {

        risk_assessments = {};

        // selectType = $(".row_"+risk_type);
        is_select = 0;
        risk_assessment_id = 0;

        $(".row_"+ risk_type + " input").each(function (i, value) {
            if ($(this).hasClass('select_'+risk_type) && $(this).is(':checked')) {
                is_select = 1;
                risk_assessment_id = $(this).attr('data-risk-assessment-id');
                risk_assessments[risk_assessment_id] = {
                    risk_assessment_id: $(this).attr('data-risk-assessment-id'),
                    risk_assessment_title_en: $(this).attr('data-risk-assessment-title-en'),
                    risk_assessment_title_bn: $(this).attr('data-risk-assessment-title-bn'),
                }

            }else if ($(this).hasClass('select_'+risk_type) && !$(this).is(':checked')) {
                is_select = 0;
            }
            if ($(this).hasClass('yes') && is_select == 1) {
                risk_assessments[risk_assessment_id]['yes'] =  $(this).is(':checked') ? 1 : 0;
            }

            if ($(this).hasClass('no') && is_select == 1) {
                risk_assessments[risk_assessment_id]['no'] =  $(this).is(':checked') ? 1 : 0;
            }

            if ($(this).hasClass('number_'+risk_type) && is_select == 1) {
                risk_assessments[risk_assessment_id]['risk_value'] =  $(this).val()
            }

        });

        fiscal_year_id = "{{$fiscal_year_id}}";
        activity_id = "{{$activity_id}}";
        audit_plan_id ="{{$audit_plan_id}}";

        risk_rate = $('#risk_rate_'+risk_type).val();
        total_number = $('#total_risk_value_'+risk_type).val();
        risk = $('#risk_'+risk_type).val();
        risk_assessment_type = $('#risk_assessment_type_'+risk_type).val();

        data = {risk_assessments,fiscal_year_id,activity_id,audit_plan_id,risk_rate,total_number,risk,risk_assessment_type};

        url = '{{route('audit.plan.audit.editor.store-risk-assessment')}}';

        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            // KTApp.unblock('.content');
            if (response.status === 'error') {
                toastr.error(response.data);
            } else {
                toastr.success(response.data);
                saveInBook(risk_assessments,risk_assessment_type,risk,risk_rate,total_number);
            }
        })
    }

    function saveInBook(risk_assessments,risk_assessment_type,risk,risk_rate,total_number){
        data = {risk_assessments,risk_assessment_type,risk,risk_rate,total_number};

        url = '{{route('audit.plan.audit.editor.risk-assessment-book')}}';

        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                // $('.authorithy').html(response);
                $('.risk_'+risk_assessment_type).html(response);
                setJsonContentFromPlanBook();
        });
    }
</script>
