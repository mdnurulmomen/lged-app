<div class="py-7" id="load_audit_calendar_print_view">
    <div class="border" style="padding: 0.25in;">
        <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" id="potroTemplateWrapper">
            <tbody>
            <tr>
                <td colspan="3">
                    <table style="width:100%; margin-top:15px;" cellpadding="0" cellspacing="0">
                        <tbody>
                        <tr>
                            <td style="text-align:center;" valign="top">
                                <div style="text-align:center;  margin:0 auto">
                                            <span contenteditable="false"
                                                  style="line-height:1.8;font-size:18pt;display:block;">
                                                <p class=" write_here" contenteditable="true"
                                                   style="line-height: initial; margin: 0; ">
                                                    Bangladesh</p>
                                            </span>
                                    <span contenteditable="false"
                                          style="line-height:1.8;font-size:15pt;display:block; ">
                                                <p contenteditable="true"
                                                   style="line-height: 1.8; margin: 0; "
                                                   class="ministry_name write_here">
                                                    Comptroller and Audit General Office <br/>Accounts and Report Wing
                                                </p>
                                            </span>
                                    <span contenteditable="false"
                                          style="line-height:1.8;font-size:13pt;display:block;">
                                                <p class=" write_here" contenteditable="true"
                                                   style="line-height: initial; margin: 0;  ">
                                                    Audit Office</p>
                                            </span>
                                    <span contenteditable="false"
                                          style="line-height:1.8;font-size:13pt;display:block;">
                                                <p class=" write_here" contenteditable="true"
                                                   style="line-height: initial; margin: 0; ">
                                                    77/7, Kakrail, Dhaka-1000</p>
                                            </span>
                                    <span contenteditable="false"
                                          style="line-height:1.8;font-size:13pt;display:block;">
                                                <a href="#" class=" write_here" contenteditable="true"
                                                   style="line-height: initial; margin: 0; color: #000;">
                                                    www.cag.org.bd</a>
                                            </span>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="mt-5 text-center">
            <h2><u>{{$fiscal_year['start']}} - {{$fiscal_year['end']}} Annual Audit Calender</u></h2>
        </div>
        <div class="mt-5">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                    <tr>
                        <th style="width: 12%">Activity</th>
                        <th style="width: 25%;">Milestones</th>
                        <th style="width: 15%">Target Date</th>
                        <th style="width: 20%">Responsible</th>
                        <th style="width: 23%">Comment</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($activity_calendars as $activity_calendar)
                        @if(!empty($activity_calendar['milestones']))
                            <tr>
                                <td class="vertical-middle" width="12%">
                                    {{$activity_calendar['activity_no']}}
                                </td>
                                <td class="p-0" width="25%">
                                    <table class="table table-bordered w-100 mb-0">
                                        @foreach($activity_calendar['milestones'] as $milestone)
                                            <tr>
                                                <td style="height:60px">{{$milestone['title_en']}}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </td>
                                <td class="p-0" width="15%">
                                    <table class="table table-bordered w-100 mb-0">
                                        @foreach($activity_calendar['milestones'] as $milestone)
                                            <tr>
                                                <td style="height:60px">{{$milestone['milestone_calendar'] ? $milestone['milestone_calendar']['target_date'] : ''}}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </td>
                                <td class="vertical-middle" width="20%">
                                    <table class="table w-100 mb-0">
                                        <tr>
                                            <td id="added_responsible_area_{{$activity_calendar['id']}}">
                                                @forelse($activity_calendar['responsibles'] as $responsible)
                                                    {{$responsible['short_name_en']}} {{$loop->last ? '' : ','}}
                                                @empty

                                                @endforelse
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td class="p-0 vertical-middle" width="23%">
                                    @if(isset($activity_calendar['comment']))
                                        {!! $activity_calendar['comment']['comment_en'] !!}
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td class="vertical-middle" colspan="5">
                                No Data Found
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="text-right">
    <button id="download_pdf" type="button" class="btn btn-success btn-square mr-2">
        <i class="fad fa-file-pdf"></i>
    </button>
</div>

<script>
    $('#select_fiscal_year_print_view').change(function () {
        let fiscal_year = $('#select_fiscal_year_print_view').val();
        if (fiscal_year) {
            let url = '{{route('audit.plan.operational.calendar.print.view.load')}}';
            let data = {fiscal_year};
            ajaxCallAsyncCallback(url, data, 'html', 'POST', function (response) {
                $('#load_audit_calendar_print_view').html(response);
            });
        } else {
            $('#load_audit_calendar_print_view').html('');
        }
    });
    $("#download_pdf").click(function () {

        let fiscal_year = $('#select_fiscal_year_print_view').va();
        $.ajax({
            type: 'GET',
            url: '{{route('audit.plan.operational.calendar.pdf.view.load')}}',
            data: {fiscal_year},
            xhrFields: {
                responseType: 'blob'
            },

            success: function (response) {

                var blob = new Blob([response]);

                var link = document.createElement('a');

                link.href = window.URL.createObjectURL(blob);

                link.download = "audit_clander.pdf";

                link.click();

            },

            error: function (blob) {
                toastr.error('Failed to generate PDF.')
                console.log(blob);
            }

        });

    });

</script>
