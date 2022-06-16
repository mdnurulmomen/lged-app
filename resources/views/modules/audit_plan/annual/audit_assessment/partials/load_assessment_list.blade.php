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

@if(!empty($entities))
    <div class="card sna-card-border mt-3" style="margin-bottom:30px;">
        <form id="generate_form" autocomplete="off">
            <input type="hidden" name="fiscal_year_id" value="{{$fiscal_year_id}}">
            <div class="row">
                <div class="col-md-12">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">
                            ডাটাসমূহ
                        </legend>
                        <table width="100%" class="table table-bordered table-hover table-condensed table-sm"
                               id="tblAuditAssessmentScore">
                            <thead>
                            <tr>
                                <th width="25%">মন্ত্রণালয়/বিভাগ</th>
                                <th width="25%">এনটিটি/সংস্থা</th>
                                <th width="10%">পয়েন্ট</th>
                                <th width="15%">সর্বশেষ অডিট বছর</th>
                                <th width="10%">১ম অর্ধ বার্ষিক</th>
                                <th width="10%">২য় অর্ধ বার্ষিক</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($entities as $entity)
                                <input type="hidden" name="audit_assessment_score_ids[]" value="{{$entity['id']}}">
                                <input type="hidden" name="category_ids[]" value="{{$entity['category_id']}}">
                                <input type="hidden" name="en_category_titles[]" value="{{$entity['category_title_en']}}">
                                <input type="hidden" name="bn_category_titles[]" value="{{$entity['category_title_bn']}}">

                                <tr class="assessment_score_row">
                                    <td>
                                        <input type="hidden" name="ministry_ids[]" value="{{$entity['ministry_id']}}">
                                        <input type="hidden" name="bn_ministry_names[]" value="{{$entity['ministry_name_bn']}}">
                                        <input type="hidden" name="en_ministry_names[]" value="{{$entity['ministry_name_en']}}">
                                        {{$entity['ministry_name_bn']}}
                                    </td>
                                    <td>
                                        <input type="hidden" name="entity_ids[]" value="{{$entity['entity_id']}}">
                                        <input type="hidden" name="bn_entity_names[]" value="{{$entity['entity_name_bn']}}">
                                        <input type="hidden" name="en_entity_names[]" value="{{$entity['entity_name_en']}}">
                                        {{$entity['entity_name_bn']}}
                                    </td>
                                    <td>{{enTobn($entity['point'])}}</td>
                                    <td>{{enTobn($entity['last_audit_year_start'])}}-{{enTobn($entity['last_audit_year_end'])}}</td>
                                    <td>
                                        <input name="first_half"  value="{{$entity['id']}}" {{$entity['is_first_half'] ==1?'checked':''}} type="checkbox"  {{$entity['has_first_half_annual_plan']==1?'disabled':''}}>
                                        <input type="hidden" name="has_first_half_annual_plans[]" value="{{$entity['has_first_half_annual_plan']}}">
                                    </td>
                                    <td>
                                        <input name="second_half" value="{{$entity['id']}}" {{$entity['is_second_half'] ==1?'checked':''}} type="checkbox" {{$entity['has_second_half_annual_plan']==1?'disabled':''}}>
                                        <input type="hidden" name="has_second_half_annual_plans[]" value="{{$entity['has_second_half_annual_plan']}}">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <input type="hidden" name="first_half_data" id="first_half_data">
                        <input type="hidden" name="second_half_data" id="second_half_data">
                    </fieldset>
                </div>
            </div>

            @if(!empty($entities))
                <button type="button" class="btn btn-success btn-sm btn-bold btn-square"
                        onclick="Assessment_Container.store()">
                    <i class="far fa-save mr-1"></i> সংরক্ষণ করুন
                </button>
                <button type="button" class="btn btn-primary btn-sm btn-bold btn-square"
                        onclick="Assessment_Container.storeAnnualPlan()">
                    <i class="far fa-save mr-1"></i> বার্ষিক পরিকল্পনা তৈরি করুন
                </button>
            @endif
        </form>
    </div>
@else
    <div class="alert alert-custom alert-white alert-shadow fade show gutter-b" role="alert">
        <div class="alert-icon">
            <i class="text-danger flaticon-warning"></i>
        </div>
        <div class="alert-text">
            {{___('generic.no_data_found')}}
        </div>
    </div>
@endif


<script>
    var Assessment_Container = {
        store: function () {

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            var first_half_data = [];
            $.each($("input[name='first_half']"), function(index, element){
                if (element.checked === true) {
                    first_half_data.push(1);
                }
                else {
                    first_half_data.push(0);
                }
            });
            $("#first_half_data").val(first_half_data);

            var second_half_data = [];
            $.each($("input[name='second_half']"), function(index, element){
                if (element.checked === true) {
                    second_half_data.push(1);
                }
                else {
                    second_half_data.push(0);
                }
            });
            $("#second_half_data").val(second_half_data);

            url = '{{route('audit.plan.annual.audit-assessment.store')}}';
            data = $('#generate_form').serialize();

            const isAllZeroFirstHalf = first_half_data.every(item => item === 0);
            const isAllZeroSecondHalf = second_half_data.every(item => item === 0);

            if (isAllZeroFirstHalf === false || isAllZeroSecondHalf === false){
                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    KTApp.unblock('#kt_wrapper');
                    if (response.status === 'success') {
                        toastr.success('Successfully Added!');
                        let fiscal_year_id = $("#fiscal_year_id").val();
                        Assessment_Score_Container.list(fiscal_year_id);
                    } else {
                        toastr.error(response.data.message);
                    }
                })
            }else {
                KTApp.unblock('#kt_wrapper');
                toastr.error('Please choose activity');
            }
        },


        storeAnnualPlan: function () {
            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            var first_half_data = [];
            $.each($("input[name='first_half']"), function(index, element){
                if (element.checked === true) {
                    first_half_data.push(1);
                }
                else {
                    first_half_data.push(0);
                }
            });
            $("#first_half_data").val(first_half_data);

            var second_half_data = [];
            $.each($("input[name='second_half']"), function(index, element){
                if (element.checked === true) {
                    second_half_data.push(1);
                }
                else {
                    second_half_data.push(0);
                }
            });
            $("#second_half_data").val(second_half_data);

            url = '{{route('audit.plan.annual.audit-assessment.store_annual_plan')}}';
            data = $('#generate_form').serialize();

            const isAllZeroFirstHalf = first_half_data.every(item => item === 0);
            const isAllZeroSecondHalf = second_half_data.every(item => item === 0);

            if (isAllZeroFirstHalf === false || isAllZeroSecondHalf === false){
                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    KTApp.unblock('#kt_wrapper');
                    if (response.status === 'success') {
                        toastr.success('Successfully Added!');
                        let fiscal_year_id = $("#fiscal_year_id").val();
                        Assessment_Score_Container.list(fiscal_year_id);
                    } else {
                        toastr.error(response.data.message);
                    }
                })
            }else {
                KTApp.unblock('#kt_wrapper');
                toastr.error('Please choose activity');
            }
        }
    }
</script>
