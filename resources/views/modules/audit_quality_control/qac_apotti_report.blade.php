<div class="row ml-2 mb-3">
    <div class="col-md-12">
{{--        <a data-qac-type="{{$qac_type}}"--}}
{{--           data-air-report-id="{{$responseData['rAirInfo']['r_air_child']['id']}}"--}}
{{--           onclick="QAC_Apotti_List_Container.createQacReport($(this))"--}}
{{--           class="text-right mr-1 btn btn-sm btn-outline-primary btn-square" href="javascript:;">--}}
{{--            <i class="far fa-download"></i>  Download--}}
{{--        </a>--}}
        QAC-1 সভার কার্যবিবরণী
    </div>
</div>

<div class="row">
    <table class="table table-hover ml-10" width="100%">
    <thead class="thead-light">
    <tr class="bg-hover-warning">
{{--        <th width="7%" class="text-center">--}}
{{--             নং--}}
{{--        </th>--}}

        <th width="20%" class="text-left">
            আপত্তির শিরোনাম
        </th>

        <th width="5%" class="text-right">
            জড়িত অর্থ (টাকা)
        </th>

        <th width="5%" class="text-left">
            আপত্তির সাথে পরিশিষ্ট মিল আছে কিনা ?
        </th>

        <th width="5%" class="text-left">
            বিধি-বিধান উল্লেখ আছে কিনা ?
        </th>

        <th width="5%" class="text-left">
            আপত্তিতে কোন অসম্পূর্ণতা আছে কিনা ?
        </th>

        <th width="5%" class="text-left">
            আপত্তি রিস্ক অ্যানালাইসিস এরমধ্যে উত্থাপন করা হয়েছে কিনা ?
        </th>

        <th width="5%" class="text-left">
            ব্রডশিট জবাব পাওয়া গিয়েছে কিনা ?
        </th>

        <th width="5%" class="text-left">
            মন্তব্য
        </th>
    </tr>
    </thead>

    <tbody>
    @php $total_amount = 0; @endphp
    @foreach($responseData['apottiList'] as $apotti)
        @foreach($apotti['apotti_map_data']['apotti_status'] as $apotti_status)
                <tr class="text-center">
                    <td class="text-left">
                        <span>{{$apotti['apotti_map_data']['apotti_title']}}</span>
                    </td>
                    <td class="text-right">
                        @php
                          $total_amount += $apotti['apotti_map_data']['total_jorito_ortho_poriman'];
                        @endphp
                        <span>{{enTobn(number_format($apotti['apotti_map_data']['total_jorito_ortho_poriman'],0))}}/-</span>
                    </td>
                    <td class="text-left">
                        @if($apotti['apotti_map_data']['is_delete'] == 1)
                            প্রত্যাহার
                        @elseif($apotti['apotti_map_data']['final_status'] == 'draft')
                            প্রস্তাবিত খসড়া
                        @elseif($apotti['apotti_map_data']['final_status'] == 'approved')
                            চূড়ান্ত খসড়া
                        @elseif($apotti['apotti_map_data']['apotti_type'] == 'sfi')
                            এসএফআই
                        @elseif($apotti['apotti_map_data']['apotti_type'] == 'non-sfi')
                            নন-এসএফআই
                        @endif
                    </td>
                    <td class="text-left">
                        {{$apotti_status['is_same_porishisto'] ? 'হ্যাঁ' : 'না'}}
                    </td>
                    <td class="text-left">
                        {{$apotti_status['is_rules_and_regulation'] ? 'হ্যাঁ' : 'না'}}
                    </td>
                    <td class="text-left">
                        {{$apotti_status['is_imperfection'] ? 'হ্যাঁ' : 'না'}}
                    </td>
                    <td class="text-left">
                        {{$apotti_status['is_broadsheet_response'] ? 'হ্যাঁ' : 'না'}}
                    </td>
                    <td class="text-left">
                        {{$apotti_status['comment']}}
                    </td>
                </tr>
        @endforeach
    @endforeach
    <tr>
        <td class="text-right" colspan="1">সর্বমোট পরিমাণ</td>
        <td class="text-right">{{enTobn(number_format($total_amount))}}/-</td>
        <td colspan="6">{{numberConvertToBnWord($total_amount)}}</td>
    </tr>
{{--    @empty--}}
{{--        <tr data-row="0" class="datatable-row" style="left: 0px;">--}}
{{--            <td colspan="4" class="datatable-cell text-center"><span>Nothing Found</span></td>--}}
{{--        </tr>--}}
{{--    @endforelse--}}
    </tbody>
</table>
</div>

<div class="row">
    <div class="col-md-4">

    </div>
    <div class="col-md-4">

    </div>
    <div class="col-md-4">

    </div>
</div>

