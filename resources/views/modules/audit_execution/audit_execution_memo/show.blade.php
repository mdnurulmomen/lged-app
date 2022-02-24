<div class="col-md-12">
    <div class="d-flex justify-content-end mt-4">
        <button title="ডাউনলোড করুন" data-memo-id="{{$memoInfo['id']}}"
                onclick="Show_Memo_Container.memoPDFDownload($(this))"
                class="btn btn-info btn-sm btn-bold btn-square">
            <i class="far fa-download"></i> ডাউনলোড
        </button>
    </div>
</div>

<div class="bangla-font" style="height: 100%">
    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;text-align: center;color: black">
        মহাপরিচালকের কার্যালয়<br>
        {{$directorateName}} <br>
        {!! $directorateAddress !!}<br>
        <u>{{$directorateWebsite}}</u>
    </div>
{{--    <x-office-header-details />--}}
    <br>
    @if($memoInfo['memo_sharok_no'])
        <table class="bangla-font" width="100%">
            <tr>
                <td >স্মারক  নং - {{enTobn($memoInfo['memo_sharok_no'])}}</td>
                <td style="text-align: right">তারিখ: {{formatDate($memoInfo['memo_send_date'],'bn','/')}}</td>
            </tr>
        </table>
    @endif

    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;text-align: center;">
        <u>অডিট মেমো</u>
    </div>

    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;font-weight: bold">অডিট মেমো নং-{{enTobn($memoInfo['onucched_no'])}}</div>
    <br>
    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;font-weight: bold">
        <p style="font-weight: bold">শিরোনামঃ </p>
        {{$memoInfo['memo_title_bn']}}
    </div>

    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;text-align:justify;margin-top: 10px">
        <span style="font-weight: bold">বিবরণঃ</span>
        {!! $memoInfo['memo_description_bn'] !!}
    </div>

    @if($memoInfo['irregularity_cause'])
        <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
            <span style="font-weight: bold">অনিয়মের কারণঃ</span>
            {{$memoInfo['irregularity_cause']}}
        </div>
    @endif

    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
        <b>সংযুক্তিঃ পরিশিষ্ট</b>
    </div>

    @if($memoInfo['irregularity_cause'])
        <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
            <span style="font-weight: bold">অডিটি প্রতিষ্ঠানের জবাবঃ</span>
            {{$memoInfo['response_of_rpu']}}
        </div>
    @endif
    <br><br>
    <table width="100%" style="color: black">
        <tr>
            <td class="bangla-font" width="33%" style="text-align: left"></td>
            <td class="bangla-font" width="33%" style="text-align: left"></td>
            <td class="bangla-font" width="33%" style="text-align: center">
                @if($memoInfo['issued_by'] == 'sub_team_leader')
                    <p>({{$memoInfo['sub_team_leader_name']}})</p>
                    <p>{{$memoInfo['sub_team_leader_designation']}} ও উপদলনেতা</p>
                    <p>{{$directorateName}}</p>
                @else
                    <p>({{$memoInfo['team_leader_name']}})</p>
                    <p>{{$memoInfo['team_leader_designation']}} ও দলনেতা</p>
                    <p>{{$directorateName}}</p>
                @endif
            </td>
        </tr>
    </table>
    <table width="100%" style="color: black">
        <tr>
            <td class="bangla-font" width="33%" style="text-align: left">
                <br><br>
                <p style="margin: 0">{{$memoInfo['rpu_acceptor_designation_name_bn']}}</p>
                <p>{{$memoInfo['cost_center_name_bn']}}</p>
            </td>
            <td class="bangla-font" width="33%" style="text-align: left"></td>
            <td class="bangla-font" width="33%" style="text-align: center"></td>
        </tr>
    </table>
    <br>
    @if($memoInfo['memo_sharok_no'])
        <table class="bangla-font" width="100%" style="color: black">
            <tr>
                <td >স্মারক  নং - {{enTobn($memoInfo['memo_sharok_no'])}}</td>
                <td style="text-align: right">তারিখ: {{formatDate($memoInfo['memo_send_date'],'bn','/')}}</td>
            </tr>
        </table>
    @endif
    <br>
    @if($memoInfo['memo_cc'])
        <table class="bangla-font" width="100%" style="color: black">
            <tr>
                <td style="padding-bottom: 10px">সদয় অবগতি ও প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য:-</td>
            </tr>
            <tr>
                <td>
                    @if($memoInfo['memo_cc'])
                    {!! nl2br($memoInfo['memo_cc']) !!}
                    @endif

                </td>
            </tr>
        </table>
    @endif()
    <br>
    <table class="bangla-font" width="100%" style="color: black">
        <tr>
            <td width="33%"></td>
            <td width="33%"></td>
            <td width="34%" style="text-align: center">
                @if($memoInfo['issued_by'] == 'sub_team_leader')
                    <p>({{$memoInfo['sub_team_leader_name']}})</p>
                    <p>{{$memoInfo['sub_team_leader_designation']}} ও উপদলনেতা</p>
                    <p>{{$directorateName}}</p>
                @else
                    <p>({{$memoInfo['team_leader_name']}})</p>
                    <p>{{$memoInfo['team_leader_designation']}} ও দলনেতা</p>
                    <p>{{$directorateName}}</p>
                @endif
            </td>
        </tr>
    </table>
</div>


<script>
    var Show_Memo_Container={
        memoPDFDownload: function (elem) {
            url = '{{route('audit.execution.memo.download.pdf')}}';
            memo_id = elem.data('memo-id');
            data = {memo_id};

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (response) {
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "memo.pdf";
                    link.click();
                },
                error: function (blob) {
                    toastr.error('Failed to generate PDF.')
                    console.log(blob);
                }
            });
        },
    }
</script>
