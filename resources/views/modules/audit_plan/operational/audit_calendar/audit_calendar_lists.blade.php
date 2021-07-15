<x-title-wrapper>Annual Audit Calender</x-title-wrapper>
<div class="col-lg-12">
    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Header-->
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-0 pb-3">
            <!--begin::Table-->
            <div class="table-responsive datatable datatable-default datatable-bordered datatable-loaded">

                <table class="datatable-bordered datatable-head-custom datatable-table"
                       id="kt_datatable"
                       style="display: block;">

                    <thead class="datatable-head">
                    <tr class="datatable-row" style="left: 0px;">
                        <th class="datatable-cell datatable-cell-sort">
                            Fiscal Year
                        </th>

                        <th class="datatable-cell datatable-cell-sort">
                            Initiator
                        </th>

                        <th class="datatable-cell datatable-cell-sort">
                            Current Desk
                        </th>

                        <th class="datatable-cell datatable-cell-sort">
                            <i class="fas fa-eye"></i>
                        </th>
                    </tr>
                    </thead>
                    <tbody style="" class="datatable-body">
                    @foreach($yearly_calendars as $yearly_calendar)
                        <tr data-row="0" class="datatable-row" style="left: 0px;">
                            <td class="datatable-cell text-center">
                                <span>{{$yearly_calendar['fiscal_year']['description']}}</span></td>
                            <td class="datatable-cell text-center">
                                <span>{{$yearly_calendar['initiator_name_en']}}</span></td>
                            <td class="datatable-cell text-center"><span>{{$yearly_calendar['cdesk_name_en']}}</span>
                            </td>
                            <td class="datatable-cell text-center">
                                <a href="javascript:;"
                                   data-fiscal-year-id="{{$yearly_calendar['fiscal_year_id']}}"
                                   data-url="{{route('audit.plan.operational.calendar.single')}}"
                                   class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_view_operational_calendar">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $('.btn_view_operational_calendar').on('click', function () {
        url = $(this).data('url')
        fiscal_year_id = $(this).data('fiscal-year-id')
        ajaxCallAsyncCallbackAPI(url, {fiscal_year_id}, 'POST', function (response) {
            if (response.status === 'error') {
                toastr.error('Error')
            } else {
                $("#kt_content").html(response);
            }
        });
    })
</script>
