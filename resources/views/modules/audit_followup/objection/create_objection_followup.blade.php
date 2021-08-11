<x-title-wrapper-return area="#kt_content" title="Back To Lists"
                        url="{{route('audit.plan.strategy.indicator.outcome')}}">
    Create Objection
</x-title-wrapper-return>
<div class="mt-4 px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <form id="outcome_indicator_create">
                        <div class="row">



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Objection Title
                                        :</label>
                                        <input type="text" name="name_en" class="form-control rounded-0" placeholder="Objection Title" />
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Objection Irregularities Type
                                        :</label>
                                        <input type="text" name="frequency_en" class="form-control rounded-0" placeholder="Objection Irregularities Type" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Involved Money
                                        :</label>
                                        <input type="text"  name="frequency_bn" class="form-control rounded-0" placeholder="Involved Money" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Audited Institution
                                        :</label>
                                        <input type="text" name="datasource_en" class="form-control rounded-0" placeholder="Audited Institution" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Audite Type
                                        :</label>
                                        <input type="text"  name="datasource_bn" class="form-control rounded-0" placeholder="Audite Type" />
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="select_fiscal_year" class="col-form-label">Objection's Year :</label>
                                    <select class="form-control rounded-0 select-select2" id="select_fiscal_year"
                                            name="base_fiscal_year_id">
                                        <option value="">Objection's Year</option>
                                        {{-- @foreach($fiscal_years as $fiscal_year)
                                            <option value="{{$fiscal_year['id']}}">{{$fiscal_year['description']}}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>

                        </div>

                            {{-- <div class="row">
                                <div class="col-md-12">
                                <h3>Details</h3>
                                <hr>

                                <table style="width:100%">
                                    <tr>
                                        <td>#</td>
                                        @foreach($fiscal_years as $fiscal_year)
                                        <input type="hidden" name="fiscal_year_id[]" value="{{ $fiscal_year['end'] }}"/>
                                        <th> {{ $fiscal_year['end'] }} </th>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td> Unit type </td>
                                        @foreach($fiscal_years as $fiscal_year)
                                        <td>
                                            <input type="text" name="unit_type[]" class="form-control rounded-0" placeholder="unit type"/>
                                        </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td> Target value </td>
                                        @foreach($fiscal_years as $fiscal_year)
                                        <td>
                                            <input type="text" name="target_value[]" class="form-control rounded-0" placeholder="target value"/>
                                        </td>
                                        @endforeach
                                    </tr>

                                </table>


                                </div>
                            </div> --}}


                            <div class="card-footer" style="padding: 3rem 0.25rem;">
                                <div class="d-flex align-items-center">
                                    <button type="button" id="submit_form" class="btn-primary btn btn-square">Submit</button>
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

    // $('#submit_form').click(function () {
    //     url = "{{route('audit.plan.strategy.indicator.outcome.store')}}";
    //     data = $('#outcome_indicator_create').serialize();
    //     ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
    //         if (resp.status === 'error') {
    //             toastr.error('no');
    //             console.log(resp.data)
    //         } else {
    //             toastr.success(resp.data);
    //             url = '{{route('audit.plan.strategy.indicator.outcome')}}';
    //             data = {}
    //             ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
    //                 $('#kt_content').html(response);
    //             })
    //         }
    //     });
    // });

</script>



