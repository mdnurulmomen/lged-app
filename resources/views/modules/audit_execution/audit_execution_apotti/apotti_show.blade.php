<table class="annual-plan-table" border="1">
    <tr>
        <td class="annual-plan-title">অনুচ্ছেদ নং </td>
        <td style="width: 60%;padding-left: 2%">
            {{$apotti_info['onucched_no']}}
        </td>
    </tr>
    <tr>
        <td class="annual-plan-title">শিরোনাম </td>
        <td style="width: 60%;padding-left: 2%">
            {{$apotti_info['apotti_title']}}
        </td>
    </tr>
    <tr>
        <td class="annual-plan-title">বিবরণ</td>
        <td style="width: 60%;padding-left: 2%">
            {!! $apotti_info['apotti_description'] !!}
        </td>
    </tr>
    <tr>
        <td class="annual-plan-title">জড়িত অর্থ (টাকা)</td>
        <td style="width: 60%;padding-left: 2%">
            {{enTobn($apotti_info['total_jorito_ortho_poriman'])}}
        </td>
    </tr>
    <tr>
        <td class="annual-plan-title">অনিষ্পন্ন জড়িত অর্থ (টাকা)</td>
        <td style="width: 60%;padding-left: 2%">
            {{enTobn($apotti_info['total_onishponno_jorito_ortho_poriman'])}}
        </td>
    </tr>
    <tr>
        <td class="annual-plan-title">অনিয়মের কারণ</td>
        <td style="width: 60%;padding-left: 2%">
            {{$apotti_info['irregularity_cause']}}
        </td>
    </tr>
    <tr>
        <td class="annual-plan-title">অডিটি প্রতিষ্ঠানের জবাব</td>
        <td style="width: 60%;padding-left: 2%">
            {{$apotti_info['response_of_rpu']}}
        </td>
    </tr>
    <tr>
        <td class="annual-plan-title">নিরীক্ষা মন্তব্য</td>
        <td style="width: 60%;padding-left: 2%">
            {{$apotti_info['audit_conclusion']}}
        </td>
    </tr>
    <tr>
        <td class="annual-plan-title">নিরীক্ষার সুপারিশ</td>
        <td style="width: 60%;padding-left: 2%">
            {{$apotti_info['audit_recommendation']}}
        </td>
    </tr>
</table>

@if($apotti_info['is_combined'])
    <br>
    <h4>একীভূত আপত্তি সমূহ</h4>
    <table class="table table-striped">
        <thead class="thead-light">
            <tr>
                <th width="5%">অনুচ্ছেদ নং</th>
                <th width="30%">ইউনিট</th>
                <th width="15%">শিরোনাম</th>
                <th width="15%">জড়িত অর্থ (টাকা) </th>
                <th width="15%">অনিষ্পন্ন জড়িত অর্থ (টাকা)</th>
                <th width="15%">কার্যক্রম</th>
            </tr>
        </thead>
        <tbody>
        @foreach($apotti_info['apotti_items'] as $apotti_item)
            <tr class="milestone_row">
                <td>
                    {{$apotti_item['onucched_no']}}
                </td>
                <td>
                    {{$apotti_item['cost_center_name_en']}}
                </td>
                <td>
                    {{$apotti_item['memo_title_bn']}}
                </td>
                <td>
                    {{enTobn($apotti_item['jorito_ortho_poriman'])}}
                </td>
                <td>
                    {{enTobn($apotti_item['onishponno_jorito_ortho_poriman'])}}
                </td>
                <td>
                    <button class="mr-3 btn btn-sm btn-outline-danger btn-square" title="বিস্তারিত দেখুন"
                            data-apotti-item-id="{{$apotti_item['id']}}"
                            data-is-combined="{{$apotti_info['is_combined']}}"
                            onclick="Apotti_Container.unMergeOnucched($(this))">
                        <i class="fad fa-trash"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
