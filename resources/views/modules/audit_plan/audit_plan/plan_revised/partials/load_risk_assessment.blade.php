<ul class="nav nav-tabs custom-tabs mb-0" role="tablist">
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
        totalRow = $("#"+risk_type+"ItemListTblBody tr").length;

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


        $('.risk_total_score_'+risk_type).text(EngFromBn(total_number));
        $('.risk_rate_number_'+risk_type).text(EngFromBn(risk_rate));
        $('#risk_rate_'+risk_type).val(risk_rate);

        $('.risk_rate_'+risk_type).text('('+risk+')');
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

        risk_rate = parseFloat(risk_rate).toFixed(2);
        $('.risk_'+risk_assessment_type+'_point').text(BnFromEng(risk_rate));
        $('.total_score_risk_'+risk_assessment_type).text(BnFromEng(total_score));
        $('.risk_'+risk_assessment_type+'_calculation').text('('+BnFromEng(total_score)+'/'+BnFromEng(total_number)+')');

        if (risk_assessment_type == 'inherent'){
            inherentRiskTotalPoint = risk_rate;
        }
        else if(risk_assessment_type == 'control'){
            controlRiskTotalPoint = risk_rate;
        }

        saveInBookOverallRiskData();

        data = {risk_assessments,risk_assessment_type,risk,risk_rate,total_score};
        url = '{{route('audit.plan.audit.editor.risk-assessment-book')}}';

        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                // $('.authorithy').html(response);
                $('.risk_'+risk_assessment_type+'_list').html(response);
                setJsonContentFromPlanBook();
        });
    }

    function addRiskItemList(elem){
        riskAssessmentType = elem.data('risk-assessment-type');
        selectedRiskAssessment = $("#risk_assessment_"+riskAssessmentType+" option:selected");
        riskAssessmentId = selectedRiskAssessment.val();
        riskAssessmentTitleBn = selectedRiskAssessment.text().trim();

        if (riskAssessmentId === "") {
            toastr.warning('দয়া করে রিস্ক এসেসমেন্ট আইটেম সিলেক্ট করুন');
            return;
        }

        $("#risk_assessment_"+riskAssessmentType+" option[value='"+riskAssessmentId+"']").remove();

        if (riskAssessmentType === 'detection'){
            $("#detectionItemTblList").append(`
            <tr id="riskAssessmentId${riskAssessmentId}" class="row_risk_item_${riskAssessmentType}">
                <td width="45%">${riskAssessmentTitleBn}</td>
                <td width="45%">
                    <textarea class="form-control risk_score" data-risk-assessment-id="${riskAssessmentId}"
    data-risk-assessment-title-bn="${riskAssessmentTitleBn}" data-risk-assessment-title-en="${riskAssessmentTitleBn}"></textarea>
                </td>
                <td width="10%">
                    <button type="button" class="btn btn-icon btn-outline-danger btn-xs border-0"
                        data-risk-assessment-type="${riskAssessmentType}"
                        data-risk-assessment-id="${riskAssessmentId}"
                        data-risk-assessment-title-bn="${riskAssessmentTitleBn}"
                        onclick="deleteRiskItem($(this))">
                        <i class="fal fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
            `);
        }

        else {
            $("#"+riskAssessmentType+"ItemListTblBody").append(`
                <tr id="riskAssessmentId${riskAssessmentId}" class="row_risk_item_${riskAssessmentType}">
                    <td width="85%">${riskAssessmentTitleBn}</td>
                    <td width="10%">
                    <input style="width: 100%" type="number" min="1" max="5" data-risk-assessment-id="${riskAssessmentId}"
        data-risk-assessment-title-bn="${riskAssessmentTitleBn}" data-risk-assessment-title-en="${riskAssessmentTitleBn}"
        onchange="calculateTotalRiskScoreSum('${riskAssessmentType}')"
        class="integer_type_positive risk_score" value="0">
                    </td>
                    <td width="5%">
                        <button type="button" class="btn btn-icon btn-outline-danger btn-xs border-0"
                            data-risk-assessment-type="${riskAssessmentType}"
                            data-risk-assessment-id="${riskAssessmentId}"
                            data-risk-assessment-title-bn="${riskAssessmentTitleBn}"
                            onclick="deleteRiskItem($(this))">
                            <i class="fal fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
           `);
        }
    }

    function deleteRiskItem(elem){
        riskAssessmentType = elem.data('risk-assessment-type')
        riskAssessmentId = elem.data('risk-assessment-id')
        riskAssessmenTitleBn = elem.data('risk-assessment-title-bn')
        $("#risk_assessment_"+riskAssessmentType).append('<option value="'+riskAssessmentId+'">'+riskAssessmenTitleBn+'</option>');

        var delete_row = elem.closest('tr').attr('id');
        $('#' + delete_row).remove();

        if (riskAssessmentType !== 'detection'){
            calculateTotalRiskScoreSum(riskAssessmentType);
        }
    }



    function detectionRiskSubmit(submit_type,id) {
        risk_assessments = {};
        $(".row_risk_item_detection textarea").each(function () {
            if($(this).hasClass('risk_score')) {
                risk_assessment_id = $(this).data('risk-assessment-id');
                risk_assessment_title_bn = $(this).data('risk-assessment-title-bn');
                risk_assessment_title_en = $(this).data('risk-assessment-title-en');

                risk_assessments[risk_assessment_id] = {
                    risk_assessment_id: risk_assessment_id,
                    risk_assessment_title_bn: risk_assessment_title_bn,
                    risk_assessment_title_en: risk_assessment_title_en,
                }
                risk_assessments[risk_assessment_id]['detection_risk_value_en'] =  $(this).val();
                risk_assessments[risk_assessment_id]['detection_risk_value_bn'] =  $(this).val();
            }
        });

        fiscal_year_id = "{{$fiscal_year_id}}";
        activity_id = "{{$activity_id}}";
        audit_plan_id ="{{$audit_plan_id}}";
        risk_assessment_type = 'detection';

        riskDetectionPoint = $("#risk_assessment_point_detection").val();
        risk_rate = parseFloat(riskDetectionPoint).toFixed(2);
        risk_bn = '';
        risk = '';

        if(risk_rate >= 0 && risk_rate <= 0.2){
            risk_bn = 'নিম্ন ঝুঁকি';
            risk = 'low'
        }else if(risk_rate > 0.2 && risk_rate <= 0.6){
            risk_bn = 'মধ্যম ঝুঁকি';
            risk = 'medium'
        }else if(risk_rate > 0.6 && risk_rate <= 1.0){
            risk_bn = 'উচ্চ ঝুঁকি';
            risk = 'high'
        }

        //console.log(risk_assessments);
        data = {id,risk_assessments,fiscal_year_id,activity_id,audit_plan_id,risk_assessment_type,risk_rate,risk};

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
                saveInBookRiskDetectionData(risk_assessments,risk_assessment_type,risk_rate);
            }
        })
    }

    function saveInBookRiskDetectionData(risk_assessments,risk_assessment_type,risk_rate){
        $('.risk_'+risk_assessment_type+'_point').text(BnFromEng(risk_rate));
        detectionRiskTotalPoint = risk_rate;

        saveInBookOverallRiskData();
        data = {risk_assessments,risk_assessment_type};
        url = '{{route('audit.plan.audit.editor.risk-assessment-book')}}';
        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            $('.risk_detection_list').html(response);
            setJsonContentFromPlanBook();
        });
    }


    function calculateTotalRiskScoreSum(risk_type){
        total_number = 0;
        $(".row_risk_item_"+risk_type+"  .risk_score").each(function () {
            if($(this).val() != ""){
                    if ($(this).val() > 5) {
                        $(this).val(0);
                        toastr.warning('স্কোর (০-৫)');
                    }
                total_number += parseInt($(this).val());

            }
        });
        $(".total-"+risk_type+"-risk-score").text(total_number);
    }

    function saveInBookOverallRiskData(){
        overAllPoint = detectionRiskTotalPoint * detectionRiskTotalPoint * detectionRiskTotalPoint;
        risk_bn = '';
        if(overAllPoint >= 0 && overAllPoint <= 0.2){
            risk_bn = 'নিম্ন ঝুঁকি';
        }else if(overAllPoint > 0.2 && overAllPoint <= 0.6){
            risk_bn = 'মধ্যম ঝুঁকি';
        }else if(overAllPoint > 0.6 && overAllPoint <= 1.0){
            risk_bn = 'উচ্চ ঝুঁকি';
        }

        $('.risk_overall_point').text(BnFromEng(parseFloat(overAllPoint).toFixed(4)));
        $('.risk_overall_type').text(risk_bn);
    }
</script>
