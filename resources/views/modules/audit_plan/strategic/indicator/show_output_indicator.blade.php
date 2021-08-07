<x-title-wrapper>Indicator Output</x-title-wrapper>
<div class="col-md-12">
    <div class="d-flex justify-content-end">
        {{-- <x-toolbar-button class="btn btn-success btn-sm btn-bold btn-square btn_create_audit_activity"
                            href="{{route('audit.plan.operational.activity.create')}}" data-toggle="modal"
        data-target="#meetingDetails">
        <i class="far fa-plus mr-1"></i> Add Meeting Activity
        </x-toolbar-button> --}}
        <a class="btn btn-success btn-sm btn-bold btn-square btn_create_indicator_output"
            href="javascript:;"><i class="far fa-plus mr-1"></i> Add Indicator Output</a>
    </div>
</div>
<div class="col-lg-12">
    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th class="align-middle">Indicator</th>
                            <th>Frequency of Measurement</th>
                            <th>Data source</th>
                            <th>Baseline FY 2020</th>
                            <th>Milestone
                                FY 2021</th>
                            <th>Milestone FY 2022</th>
                            <th>Milestone FY 2023</th>
                            <th>Milestone FY 2024</th>
                            <th>Target FY 2024</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span>Percentage of SAI reports discussed in PAC meeting.</span></td>
                            <td><span>Annually</span></td>
                            <td><span>QA Cell of
                                OCAG</span></td>
                            <td><span>20%</span></td>
                            <td><span>30%</span></td>
                            <td><span>40%</span></td>
                            <td><span>50%</span></td>
                            <td><span>75%</span></td>
                            <td><span>90%</span></td>


                        </tr>

                    </tbody>
                </table>
            </div>
            <!--end::Table-->
        </div>
        <!--end::Body-->
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex flex-wrap mr-3">
                    <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                        <i class="ki ki-bold-double-arrow-back icon-xs"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1 btn_indicator_edit">
                        <i class="ki ki-bold-arrow-back icon-xs"></i>
                    </a>

                    <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                        <i class="ki ki-bold-double-arrow-next icon-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--end::Advance Table Widget 4-->
</div>
<script>
      $('.btn_create_indicator_output').click(function () {
    url = '{{route('audit.plan.strategy.indicator.output.create')}}';

            data = {}
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                $('#kt_content').html(response)

            })
    });
    $('.btn_indicator_show').click(function () {
            url = '{{route('audit.plan.strategy.indicator.output.show')}}';
            data = {};
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $("#kt_content").html(response);
                }
            });

        $('.btn_indicator_edit').click(function () {

            url = '{{route('audit.plan.strategy.indicator.output.edit')}}';
            // outcome_id = $('#select_strategic_outcome').val();
            // fiscal_year_id = elem.data('fiscal-year-id');
            // output_id = $('#select_strategic_output').val();

            data = {}
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                $('#kt_content').html(response)
            })

        });
</script>
