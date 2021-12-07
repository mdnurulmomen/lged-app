<table class="annual-plan-table" border="1">
    <tr>
        <td class="annual-plan-title">মন্ত্রণালয়/বিভাগ</td>
        <td style="width: 60%;padding-left: 2%">
            @php
                $ministries = [];
                foreach($annual_plan_info['ap_entities'] as $ap_entities){
                   $ministry =  $ap_entities['ministry_name_bn'];
                    $ministries[] = $ministry;
                }
            @endphp
            {{implode(' , ', array_unique($ministries))}}
        </td>
    </tr>
    <tr>
        <td class="annual-plan-title">এনটিটি / প্রতিষ্ঠান</td>
        <td style="width: 60%;padding-left: 2%">
            @php
                $entities = [];
                foreach($annual_plan_info['ap_entities'] as $ap_entities){
                   $entity =  $ap_entities['entity_name_bn'];
                    $entities[] = $entity;
                }
            @endphp
            {{implode(' , ', array_unique($entities))}}
        </td>
    </tr>
    <tr>
        <td class="annual-plan-title">প্রতিষ্ঠানের ধরণ</td>
        <td style="width: 60%;padding-left: 2%">{{$annual_plan_info['office_type']}}</td>
    </tr>
    <tr>
        <td class="annual-plan-title">প্রতিষ্ঠানের ইউনিটের সংখ্যা</td>
        <td style="width: 60%;padding-left: 2%">{{enTobn($annual_plan_info['total_unit_no'])}}</td>
    </tr>
    <tr>
        <td class="annual-plan-title">নির্বাচিত ইউনিটের সংখ্যা</td>
        <td style="width: 60%;padding-left: 2%">{{enTobn($annual_plan_info['nominated_office_counts'])}}</td>
    </tr>
    <tr>
        <td class="annual-plan-title">অডিটের জন্য প্রস্তাবিত ইউনিটের নাম</td>
        <td style="width: 60%;padding-left: 2%">
            @foreach($annual_plan_info['ap_entities'] as $ap_entities)
                {{$ap_entities['entity_name_bn']}} (এনটিটি) <br>
                @foreach(json_decode($ap_entities['nominated_offices'],true) as $office)
                    {{enTobn($loop->iteration)}}| {{$office['office_name_bn']}} <br>
                @endforeach
                <br>
            @endforeach
        </td>
    </tr>
    <tr>
        <td class="annual-plan-title">সাবজেক্ট ম্যাটার</td>
        <td style="width: 60%;padding-left: 2%">{{$annual_plan_info['subject_matter']}}</td>
    </tr>
    <tr>
        <td class="annual-plan-title">প্রতিষ্ঠানের মোট বাজেট</td>
        <td style="width: 60%;padding-left: 2%">{{enTobn($annual_plan_info['budget'])}}</td>
    </tr>
    <tr>
        <td class="annual-plan-title"> নির্বাচিত ইউনিটের মোট বাজেট</td>
        <td style="width: 60%;padding-left: 2%">{{ enTobn($annual_plan_info['cost_center_total_budget'])}}</td>
    </tr>
    <tr>
        <td class="annual-plan-title">মন্তব্য</td>
        <td style="width: 60%;padding-left: 2%">{{$annual_plan_info['comment']}}</td>
    </tr>
</table>
@if($nominated_man_powers['staffs'])
    <br>
    <h4>জনবল</h4>
    <table class="table table-striped text-center">
        <thead class="thead-light">
        <tr>
            <th width="10%">ক্রঃ নং</th>
            <th width="30%">পদবি</th>
            <th width="30%">দায়িত্ব</th>
            <th width="30%">জন</th>
        </tr>
        </thead>
        <tbody>
        @foreach($nominated_man_powers['staffs'] as $staff)
            <tr class="milestone_row">
                <td>{{enTobn($loop->iteration)}}</td>
                <td>
                    {{$staff['designation_bn']}}
                </td>
                <td>
                    {{$staff['responsibility_bn']}}
                </td>
                <td>
                    {{enTobn($staff['staff'])}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

@if($annual_plan_info['ap_milestones'])
    <br>
    <h4>নিরীক্ষা কাজের পর্যায়</h4>
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th width="5%">ক্রঃ নং</th>
            <th width="30%">মাইলস্টোন</th>
            <th width="15%">নির্ধারিত তারিখ</th>
            <th width="15%">শুরুর তারিখ</th>
            <th width="15%">শেষের তারিখ</th>
        </tr>
        </thead>
        <tbody>
        @foreach($annual_plan_info['ap_milestones'] as $milestone)
            <tr class="milestone_row">
                <td>{{enTobn($loop->iteration)}}</td>
                <td>
                    {{$milestone['milestone']['title_bn']}}
                </td>
                <td>
                    {{formatDate($milestone['milestone_target_date'],'bn','/')}}
                </td>
                <td>
                    {{formatDate($milestone['start_date'],'bn','/')}}
                </td>
                <td>
                    {{formatDate($milestone['end_date'],'bn','/')}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
