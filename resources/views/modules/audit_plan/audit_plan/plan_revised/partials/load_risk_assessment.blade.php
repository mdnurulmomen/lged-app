<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a data-type="inherent" class="nav-link active" data-toggle="tab" href="#"
           data-target="#inherentRisk">
            সহজাত ঝুঁকি
        </a>
    </li>
    <li class="nav-item">
        <a data-type="control"  class="nav-link navigation-tab-link" data-toggle="tab" href="#"
           data-target="#controlRisk">
            নিয়ন্ত্রণ ঝুঁকি
        </a>
    </li>
    <li class="nav-item">
        <a data-type="detection" class="nav-link navigation-tab-link" data-toggle="tab" href="#"
           data-target="#detectionRisk">
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

    fiscal_year_id = '{{$fiscal_year_id}}';
    audit_plan_id = '{{$audit_plan_id}}';

    $(function () {
        loadData('inherent',fiscal_year_id,audit_plan_id);
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
            loadData(type,fiscal_year_id,audit_plan_id);
        }
    });


    function loadData(risk_assessment_type,fiscal_year_id,audit_plan_id) {
        data = {risk_assessment_type,fiscal_year_id,audit_plan_id};
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
        totalRow = $("#"+risk_type+"ItemTblList tr").length -1;
        if(!totalRow){
            toastr.warning('No Data Found');
            return;
        }
        total_number = 0;

        $(".row_risk_item_"+ risk_type + " .risk_score").each(function () {
            total_number += +$(this).val();
        });

        if(!total_number){
            toastr.warning('Please Enter Value For Risk Assessment');
            return;
        }

        total_value = totalRow * 5;
        risk_rate_calculate = total_number /  total_value;
        risk_rate = parseFloat(risk_rate_calculate).toFixed(2);

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


        $('.risk_rate_number_'+risk_type).text(EngFromBn(risk_rate));
        $('#risk_rate_'+risk_type).val(risk_rate);

        $('.risk_rate_'+risk_type).text(' ( '+risk+' )');
        $('#total_risk_value_'+risk_type).val(total_value);
        $('#total_risk_score_'+risk_type).val(total_number);

        $('#risk_'+risk_type).val(risk_en);

        $('.risk_rate_div_'+risk_type).show();

        $('.save_'+risk_type).prop("disabled",false);
    }

    function riskRateSubmit(risk_type,submit_type,id) {

        risk_assessments = {};
        $(".row_risk_item_"+ risk_type + " input").each(function () {
            if($(this).hasClass('risk_score')) {
                risk_assessment_id = $(this).data('risk-assessment-id');
                risk_assessment_title_bn = $(this).data('risk-assessment-title-bn');
                risk_assessment_title_en = $(this).data('risk-assessment-title-en');

                risk_assessments[risk_assessment_id] = {
                    risk_assessment_id: risk_assessment_id,
                    risk_assessment_title_bn: risk_assessment_title_bn,
                    risk_assessment_title_en: risk_assessment_title_en,
                }
                risk_assessments[risk_assessment_id]['risk_value'] =  $(this).val();
            }
        });

        fiscal_year_id = "{{$fiscal_year_id}}";
        activity_id = "{{$activity_id}}";
        audit_plan_id ="{{$audit_plan_id}}";

        risk_rate = $('#risk_rate_'+risk_type).val();
        total_number = $('#total_risk_value_'+risk_type).val();
        total_score = $('#total_risk_score_'+risk_type).val();
        risk = $('#risk_'+risk_type).val();
        risk_assessment_type = $('#risk_assessment_type_'+risk_type).val();

        data = {id,risk_assessments,fiscal_year_id,activity_id,audit_plan_id,risk_rate,total_score,risk,risk_assessment_type};

        if(submit_type == 'add'){
            url = '{{route('audit.plan.audit.editor.store-risk-assessment')}}';
        }else{
             url = '{{route('audit.plan.audit.editor.update-risk-assessment')}}';
        }

        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            // KTApp.unblock('.content');
            if (response.status === 'error') {
                toastr.error(response.data);
            } else {
                toastr.success(response.data);
                saveInBook(risk_assessments,risk_assessment_type,risk,risk_rate,total_score,total_number);
            }
        })
    }

    function saveInBook(risk_assessments,risk_assessment_type,risk,risk_rate,total_score,total_number){

        $('.risk_'+risk_assessment_type+'_point').text(BnFromEng(parseFloat(risk_rate).toFixed(2)));
        $('.total_score_risk_'+risk_assessment_type).text(BnFromEng(total_score));
        $('.risk_'+risk_assessment_type+'_calculation').text('('+BnFromEng(total_score)+'/'+BnFromEng(total_number)+')');

        data = {risk_assessments,risk_assessment_type,risk,risk_rate,total_score};
        url = '{{route('audit.plan.audit.editor.risk-assessment-book')}}';

        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                // $('.authorithy').html(response);
                $('.risk_'+risk_assessment_type+'_list').html(response);
                setJsonContentFromPlanBook();
        });

        overallRiskDetailsSaveInBook();
    }


    function overallRiskDetailsSaveInBook(){
        inherentPoint = $('.risk_inherent_point').text() == ""?'0':$('.risk_inherent_point').text();
        controlPoint = $('.risk_control_point').text() == ""?'0':$('.risk_control_point').text();
        detectionPoint = $('.risk_detection_point').text() == ""?'0':$('.risk_detection_point').text();
        $('.risk_overall_details').text(inherentPoint.slice(0,3)+' X '+controlPoint.slice(0,3)+' X '+detectionPoint.slice(0,3)+' =');
    }


    function addRiskItemList(elem){
        riskAssessmentType = elem.data('risk-assessment-type');
        selectedRiskAssessment = $("#risk_assessment_"+riskAssessmentType+" option:selected");
        riskAssessmentId = selectedRiskAssessment.val();
        riskAssessmentTitleBn = selectedRiskAssessment.text().trim();

        if ($("#"+riskAssessmentType+"ItemTblList").find("#riskAssessmentId"+riskAssessmentId).length > 0) {
            toastr.warning('Item already exist');
            return;
        }

        $("#"+riskAssessmentType+"ItemTblList").append(`
        <tr id="riskAssessmentId${riskAssessmentId}" class="row_risk_item_${riskAssessmentType}">
            <th width="85%">${riskAssessmentTitleBn}</th>
            <th width="10%">
            <input style="width: 100%" type="number" data-risk-assessment-id="${riskAssessmentId}"
data-risk-assessment-title-bn="${riskAssessmentTitleBn}" data-risk-assessment-title-en="${riskAssessmentTitleBn}"
class="integer_type_positive risk_score" value="1">
            </th>
            <th width="5%">
                <button type="button" class="btn btn-icon btn-outline-danger btn-xs border-0"
                    onclick="deleteRiskItem($(this))">
                    <i class="fal fa-trash-alt"></i>
                </button>
            </th>
        </tr>
        `);
    }

    function deleteRiskItem(elem){
        var delete_row = elem.closest('tr').attr('id');
        console.log(delete_row);
        $('#' + delete_row).remove();
    }
</script>
