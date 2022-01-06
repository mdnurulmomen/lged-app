<x-title-wrapper-return area="#kt_content" title="Back To Lists"
                        url="{{route('audit.plan.strategy.indicator.outcome')}}">
    Create Outcome Indicator
</x-title-wrapper-return>
<div class="mt-4 px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <form id="outcome_indicator_create">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="duration" class="col-form-label">Duration <span
                                            class="text-danger">(*)</span></label>
                                    <select class="form-control rounded-0 select-select2" id="duration"
                                            name="duration_id">
                                        <option value="">Choose Duration</option>
                                        @foreach($plan_durations['data'] as $duration)
                                            <option
                                                value="{{$duration['id']}}">{{$duration['start_year']}}
                                                - {{$duration['end_year']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="select_strategic_outcome" class="col-form-label">Outcome
                                        :</label>
                                    <select class="form-control rounded-0 select-select2" id="select_strategic_outcome"
                                            name="outcome_id">
                                        <option value="">Choose Outcome</option>
                                        @foreach($plan_outcomes['data'] as $outcome)
                                            <option
                                                value="{{$outcome['id']}}">{{$outcome['outcome_no']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Indicator Name English
                                        :</label>
                                    <input type="text" name="name_en" class="form-control rounded-0"
                                           placeholder="Name English"/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Indicator Name Bangla
                                        :</label>
                                    <input type="text" name="name_bn" class="form-control rounded-0"
                                           placeholder="Name Bangla"/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Frequency English
                                        :</label>
                                    <input type="text" name="frequency_en" class="form-control rounded-0"
                                           placeholder="Frequency English"/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Frequency Bangla
                                        :</label>
                                    <input type="text" name="frequency_bn" class="form-control rounded-0"
                                           placeholder="Frequency Bangla"/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Data Source English
                                        :</label>
                                    <input type="text" name="datasource_en" class="form-control rounded-0"
                                           placeholder="DataSource English"/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Data Source Bangla
                                        :</label>
                                    <input type="text" name="datasource_bn" class="form-control rounded-0"
                                           placeholder="DataSource Bangla"/>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="base_fiscal_year" class="col-form-label">Base Fiscal Year :</label>
                                    <input type="text" id="base_fiscal_year" name="base_fiscal_year_id" class="form-control year-picker -0"
                                           placeholder="Base Value"/>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Base Value:</label>
                                    <input type="text" name="base_value" class="form-control rounded-0"
                                           placeholder="Base Value"/>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="unit_type" class="col-form-label">Unit type:</label>
                                    <select class="form-control rounded-0 select-select2" id="unit_type"
                                            name="unit_type">
                                        <option>Percentage</option>
                                        <option>Fixed amount</option>
                                        <option>Text</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status" class="col-form-label">Status:</label>
                                    <input style="width:20%; height: 16px;" name="status"
                                           class="form-check-input form-control" type="checkbox">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h3>Details</h3>
                                <hr>

                                <table style="width:100%">
                                    <tr class="baseYears">
                                    </tr>
                                    <tr class="targetValues">
                                    </tr>

                                </table>


                            </div>
                        </div>


                        <div class="card-footer" style="padding: 3rem 0.25rem;">
                            <div class="d-flex align-items-center">
                                <button type="button" id="submit_form" class="btn-primary btn btn-square">Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#btn_op_activity_modal_save').click(function () {
        url = $(this).data('url');
        data = $('#op_activity_form').serialize();
        method = $(this).data('method');
        submit = submitModalData(url, data, method, 'op_activity_modal')
    });

    $('#submit_form').click(function () {
        url = "{{route('audit.plan.strategy.indicator.outcome.store')}}";
        data = $('#outcome_indicator_create').serialize();
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
            if (resp.status === 'error') {
                toastr.error('no');
                console.log(resp.data)
            } else {
                toastr.success(resp.data);
                url = '{{route('audit.plan.strategy.indicator.outcome')}}';
                data = {}
                ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
                    $('#kt_content').html(response);
                })
            }
        });
    });

    $('#duration').change(function () {
        let duration_id = $(this).val();
        if (duration_id !== ''){
            let duration = $(this).find("option:selected").text();
            url = "{{route('audit.plan.strategy.indicator.gen.year')}}";
            data = {duration_id,duration};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
                if (resp.status === 'error') {
                    toastr.error('Error on generating year');
                } else {
                    $('.baseYears').html(resp.columns);
                    $('.targetValues').html(resp.target_value);
                }
            });
        }else {
            $('.baseYears').html('');
            $('.targetValues').html('');
        }
    });


</script>


{{-- @include('scripts.script_audit_plan_operational_activity')
@include('scripts.script_generic') --}}
