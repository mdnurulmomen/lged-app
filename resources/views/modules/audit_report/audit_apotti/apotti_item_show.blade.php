<table class="annual-plan-table" border="1">
    <tr>
        <td class="annual-plan-title"> অনুচ্ছেদ নং </td>
        <td style="width: 60%;padding-left: 2%">
            <p>{{$apotti_info['onucched_no']}}</p>
        </td>
    </tr>
    <tr>
        <td class="annual-plan-title"> আপত্তির শিরোনাম </td>
        <td style="width: 60%;padding-left: 2%">
            <p>{{$apotti_info['memo_title_bn']}}</p>
        </td>
    </tr>
    <tr>
        <td class="annual-plan-title">আপত্তির বিবরণ</td>
        <td style="width: 60%;padding-left: 2%">
            <p>{!! $apotti_info['memo_description_bn'] !!}</p>
        </td>
    </tr>
    <tr>
        <td class="annual-plan-title">জড়িত অর্থ (টাকা)</td>
        <td style="width: 60%;padding-left: 2%">
            <p>{{enTobn($apotti_info['jorito_ortho_poriman'])}}</p>
        </td>
    </tr>
    <tr>
        <td class="annual-plan-title">অনিষ্পন্ন জড়িত অর্থ (টাকা)</td>
        <td style="width: 60%;padding-left: 2%">
            <p>{{enTobn($apotti_info['onishponno_jorito_ortho_poriman'])}}</p>
        </td>
    </tr>
    <tr>
        <td class="annual-plan-title">অনিয়মের কারণ</td>
        <td style="width: 60%;padding-left: 2%">
            <p>{{$apotti_info['irregularity_cause']}}</p>
        </td>
    </tr>
    <tr>
        <td class="annual-plan-title">অডিট প্রতিষ্ঠানের জবাব</td>
        <td style="width: 60%;padding-left: 2%">
            <p>{{$apotti_info['response_of_rpu']}}</p>
        </td>
    </tr>
    <tr>
        <td class="annual-plan-title">নিরীক্ষা মন্তব্য</td>
        <td style="width: 60%;padding-left: 2%">
            <p>{{$apotti_info['audit_conclusion']}}</p>
        </td>
    </tr>
    <tr>
        <td class="annual-plan-title"> নিরীক্ষার সুপারিশ</td>
        <td style="width: 60%;padding-left: 2%">
            <p>{{$apotti_info['audit_recommendation']}}</p>
        </td>
    </tr>
</table>

