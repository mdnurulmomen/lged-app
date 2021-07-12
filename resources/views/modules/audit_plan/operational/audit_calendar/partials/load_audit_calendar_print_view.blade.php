<div class="border" style="padding: 0.5in;">
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
                                                    Comprotrolar and Audit General Office <br/>Accounts and Report Wing
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
        <h2><u>2021-2022 Annual Audit Calender</u></h2>
    </div>
    <div class="mt-5">
        <div class="table-responsive">
            <table class="table table-bordered">
            <thead>
            <tr>
                <th>Activity</th>
                <th style="">Milestones</th>
                <th style="width:180px">Target Date</th>
                <th style="width:220px">Responsible</th>
                <th style="width:220px">Comment</th>
            </tr>
            </thead>
            <tbody>
            @forelse($activityMilestones as $activityMilestone)
                @if(!empty($activityMilestone['milestones']))
                    <tr>
                        <td class="vertical-middle">
                            {{$activityMilestone['activity_no']}}
                        </td>
                        <td class="p-0">
                            <table class="table table-bordered w-100 mb-0">
                                @foreach($activityMilestone['milestones'] as $milestone)
                                    <tr>
                                        <td style="height:60px">{{$milestone['title_en']}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                        <td class="p-0">
                            <table class="table table-bordered w-100 mb-0">
                                @foreach($activityMilestone['milestones'] as $milestone)
                                    <tr>
                                        <td style="height:60px">{{$milestone['milestone_calendar']['target_date']}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                        <td class="vertical-middle">
                            <table class="table w-100 mb-0">
                                <tr>
                                    <td>
                                        <span>Responsible</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td class="p-0">
                            comment
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
