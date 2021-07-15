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
                        <th class="datatable-cell datatable-cell-sort" style="width: 10%">
                            Fiscal Year
                        </th>

                        <th class="datatable-cell datatable-cell-sort" style="width: 40%">
                            Initiator
                        </th>

                        <th class="datatable-cell datatable-cell-sort" style="width: 40%">
                            Current Desk
                        </th>

                        <th class="datatable-cell datatable-cell-sort" style="width: 5%">
                            <i class="fas fa-eye"></i>
                        </th>

                        <th class="datatable-cell datatable-cell-sort" style="width: 5%">
                            <i class="fad fa-share"></i>
                        </th>
                    </tr>
                    </thead>
                    <tbody style="" class="datatable-body">
                    @foreach($yearly_calendars as $yearly_calendar)
                        <tr data-row="{{$loop->iteration}}" class="datatable-row" style="left: 0px;">
                            <td class="datatable-cell" style="width: 10%">
                                <span>{{$yearly_calendar['fiscal_year']['description']}}</span>
                            </td>
                            <td class="datatable-cell" style="width: 40%">
                                <span>{{$yearly_calendar['initiator_name_en'] ?: 'Empty'}}</span>
                            </td>
                            <td class="datatable-cell" style="width: 40%">
                                <span>{{$yearly_calendar['cdesk_name_en'] ?: 'Empty'}}</span>
                            </td>
                            <td class="datatable-cell"  style="width: 5%">
                                <a href="javascript:;"
                                   data-fiscal-year-id="{{$yearly_calendar['fiscal_year_id']}}"
                                   data-url="{{route('audit.plan.operational.calendar.single')}}"
                                   class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_view_operational_calendar">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>

                            <td class="datatable-cell"  style="width: 5%">
                                <button
                                    data-info="{&quot;id&quot;:54,&quot;origin_office_id&quot;:65,&quot;dak_priority&quot;:&quot;0&quot;,&quot;dak_security&quot;:&quot;0&quot;,&quot;dak_type&quot;:&quot;Daptorik&quot;,&quot;is_copied_dak&quot;:1,&quot;dak_subject&quot;:&quot;sdd&quot;,&quot;sender&quot;:&quot;&quot;,&quot;attachment_count&quot;:1,&quot;sending_date&quot;:&quot;&quot;}"
                                    class="panel_single_daak_forward_dropdown mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                    type="button">
                                    <i class="fad fa-share" data-toggle="popover" data-content="ডাক প্রেরণ করুন"
                                       data-original-title="" title=""></i>
                                </button>
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
