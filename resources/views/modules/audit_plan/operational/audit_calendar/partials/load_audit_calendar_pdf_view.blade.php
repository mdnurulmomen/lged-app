 <!DOCTYPE html>
 <head>
    <style>
    body {
        font-family: sans-serif;
        font-size: 10pt;
    }

    p {
        margin: 0pt;
    }

    table.items {
        border: 0.1mm solid #e7e7e7;
    }

    .items td {
        border: 0.1mm solid #e7e7e7;
    }

    table thead td {
        border: 0.1mm solid #e7e7e7;
    }
    .mileston td{
        width: 100%;
        margin: 0;
        padding: 0;

    }
    </style>
</head>

<body>

    <table style="margin: 0 auto;" width="100%">
        <tr style="text-align: center">
            <td style="padding: 0"><p>Bangladesh</p></td>
        </tr>
        <tr style="text-align: center">
            <td style="padding: 0"><p>Comprotrolar and Audit General Office</p></td>
        </tr>
        <tr style="text-align: center">
            <td style="padding: 0"><p>Accounts and Report Wing</p></td>
        </tr>
        <tr style="text-align: center">
            <td style="padding: 0"><p>Audit Office</p></td>
        </tr>
        <tr style="text-align: center">
            <td style="padding: 0"><p>77/7, Kakrail, Dhaka-1000</p></td>
        </tr>
        <tr style="text-align: center">
            <td style="padding: 0"><p>www.cag.org.bd</p></td>
        </tr>

        <tr style="text-align: center">
            <td style="padding: 0"><h2><u>{{$fiscal_year['start']}} - {{$fiscal_year['end']}} Annual Audit Calender</u></h2></td>
        </tr>
    </table>

    <table class="items"  width="100%" style="font-size: 14px; border-collapse: collapse;" cellpadding="10">
                <thead style="border: 0.1mm solid #e7e7e7;">
                <tr>
                    <th style="width:20%">Activity</th>
                    <th style="width:20%">Milestones</th>
                    <th style="width:20%">Target Date</th>
                    <th style="width:20%">Responsible</th>
                    <th style="width:20%">Comment</th>
                </tr>
                </thead>
                <tbody>
                @forelse($activity_calendars as $activity_calendar)
                    @if(!empty($activity_calendar['milestones']))
                        <tr>
                            <td class="vertical-middle">
                                {{$activity_calendar['activity_no']}}
                            </td>
                            <td>
                                <table class="mileston">
                                    @foreach($activity_calendar['milestones'] as $milestone)
                                        <tr>
                                            <td style="height:60px">{{$milestone['title_en']}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                            <td>
                                <table class="table table-bordered w-100 mb-0">
                                    @foreach($activity_calendar['milestones'] as $milestone)
                                        <tr>
                                            <td style="height:60px">{{$milestone['milestone_calendar']['target_date']}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                            <td class="vertical-middle">
                                <table class="table w-100 mb-0">
                                    <tr>
                                        <td id="added_responsible_area_{{$activity_calendar['id']}}">
                                            @forelse($activity_calendar['responsibles'] as $responsible)
                                                {{--    <table>--}}
                                                {{--        <tr id="">--}}
                                                {{--            <td>--}}
                                                {{--                <i class="fas fa-building mr-2 text-primary"></i>{{$responsible['office']['short_name_en']}}--}}
                                                {{--            </td>--}}
                                                {{--        </tr>--}}
                                                {{--   </table>--}}
                                                {{$responsible['office']['short_name_en']}} {{$loop->last ? '' : ','}}
                                            @empty

                                            @endforelse
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td class="vertical-middle">
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


 </body>
 </html>
