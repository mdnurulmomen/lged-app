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
                            <th>Baseline</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span>Percentage of SAI reports discussed in PAC meeting.</span></td>
                            <td><span>Annually</span></td>
                            <td><span>A&R Wing of OCAG</span></td>
                            <td><span>36 months from the year end</span></td>
                            <td>
                                <div class="btn-group">
                                    <a href="javascript:;" data-url="" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_view_audit_annual_activity">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="javascript:;" data-url="" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_audit_annual_activity">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:;" data-url="" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-danger btn_edit_audit_annual_activity">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>

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
                    <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
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
</script>
