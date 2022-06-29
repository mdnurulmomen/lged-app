<table class="table table-bordered" width="100%">
    <thead class="thead-light">
    <tr class="bg-light">
        <td style="text-align: center" width="30%">আপত্তির অনুচ্ছেদ ও আপত্তির শিরোনাম</td>
        <td style="text-align: center" width="20%">নিরীক্ষিত প্রতিষ্ঠানের জবাব</td>
        <td style="text-align: left" width="20%">সংস্থার নির্বাহী প্রধানের জবাব</td>
        <td style="text-align: left" width="20%">মন্ত্রণালয়/বিভাগ/অন্যান্য এর জবাব</td>
        <td style="text-align: left" width="20%">অধিদপ্তরের মন্তব্য</td>
        <td style="text-align: left" width="10%">আপত্তির অবস্থা</td>
        <td style="text-align: center" width="20%">
            কার্যক্রম
        </td>
    </tr>
    </thead>
    <tbody>
    @foreach($apottiInfo['apotti_items'] as $apotti_item)
        <tr>
            <td style="text-align: justify;">
                        <span style="padding:5px; margin-bottom: 5px">
                            <b>অডিট আপত্তি অনুচ্ছেদ নম্বর - {{enTobn($apotti_item['onucched_no'])}} </b>
                            <br> {{$apotti_item['memo_title_bn']}}
                        </span>
            </td>

            <td style="text-align: left;vertical-align: top;"></td>

            <td style="text-align: left;vertical-align: top;"></td>
            <td style="text-align: left;vertical-align: top;"></td>
            <td style="text-align: left;vertical-align: top;"></td>

            <td style="text-align: left;vertical-align: top;">
                    @if($apotti_item['memo_status'] == 1)
                        নিস্পন্ন
                    @elseif($apotti_item['memo_status'] == 2)
                        অনিস্পন্ন
                    @elseif($apotti_item['memo_status'] == 3)
                        আংশিক নিস্পন্ন
                    @endif
            </td>
            <td>
                <button class="mr-1 btn btn-sm btn-primary btn-square btn_apotti_decision" title="সিদ্ধান্ত"
                        data-apotti-item-id="{{$apotti_item['id']}}"
                        onclick="CagAndDirectorateDecision_Container.cagAndDirectoreateApottiDecisionForm($(this))">
                    সিদ্ধান্ত
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
