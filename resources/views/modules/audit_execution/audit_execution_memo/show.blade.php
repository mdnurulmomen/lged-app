
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
        গণপ্রজাতন্ত্রী বাংলাদেশ সরকার<br>
        {{$directorateName}} <br>
        {!! $directorateAddress !!}
    </div>
    <br>

    @if($memoInfo['memo_sharok_no'])
        <table class="bangla-font" width="100%">
            <tr>
                <td >স্মারক  নং - {{enTobn($memoInfo['memo_sharok_no'])}}</td>
                <td style="text-align: right">তারিখ: {{enTobn($memoInfo['memo_send_date'])}}</td>
            </tr>
        </table>
    @endif

    <table style="margin-top: 10px" class="bangla-font" width="100%" style="color: black">
        <tr>
            <td style="text-align: center"><u><b>অডিট মেমো</b></u></td>
        </tr>
    </table>

    <table class="bangla-font table table-bordered" style="width: 100%;margin-top: 10px;padding: 5px;color: black"
    >
        <tr class="bangla-font">
            <td style="padding: 10px" width="10%">মেমো নং</td>
            <td style="padding: 10px" width="70%">বর্ণনা</td>
            <td style="padding: 10px" width="20%">জড়িত অর্থ (টাকা)</td>
        </tr>
        <tr class="bangla-font">
            <td valign="top" style="padding: 10px">{{enTobn($memoInfo['onucched_no'])}}</td>
            <td style="padding: 10px;text-align: justify">
                <p>শিরোনামঃ</p>
                <br>
                <p style="text-align: justify">{{$memoInfo['memo_title_bn']}}</p>
                <br>
                <p style="margin-bottom: 20px;">বিবরণঃ</p>
                <br>
                {!! $memoInfo['memo_description_bn'] !!}
            </td>
            <td valign="top" style="padding: 10px;text-align: right">
                {{enTobn(number_format($memoInfo['jorito_ortho_poriman']))}}
            </td>
        </tr>
    </table>

    <table class="bangla-font table table-bordered" style="width: 100%;margin-top: 10px;padding: 5px;color: black">
        <tr>
            <td style="padding: 10px">
                <p>অনিয়মের কারণঃ </p>
                <br>
                <span>{{$memoInfo['irregularity_cause']}}</span></td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="bangla-font"><b>সংযুক্তিঃ পরিশিষ্ট</b></td>
        </tr>
    </table>
    <br>
    <table class="bangla-font table table-bordered" style="width: 100%;margin-top: 10px;padding: 5px;color: black">
        <tr>
            <td style="padding: 10px">
                <p>অডিটি প্রতিষ্ঠানের জবাবঃ</p>
                <br>
                <span>{{$memoInfo['response_of_rpu']}}</span></td>
        </tr>
    </table>
    <br><br>
    <table width="100%" style="color: black">
        <tr>
            <td class="bangla-font" width="50%" style="text-align: center">
                <p>{{$memoInfo['rpu_acceptor_designation_name_bn']}}</p>
{{--                <p>পূর্বাচল লিংক রোডের উভয় পাশে</p>--}}
                <p>{{$memoInfo['cost_center_name_bn']}}</p>
            </td>
            <td class="bangla-font" width="50%" style="text-align: center">
                <p>({{$memoInfo['team_leader_name']}})</p>
                <p>{{$memoInfo['team_leader_designation']}} ও  দলনেতা</p>
                <p>পূর্ত অডিট অধিদপ্তর</p>

            </td>
        </tr>
    </table>
    <br>
    @if($memoInfo['memo_sharok_no'])
        <table class="bangla-font" width="100%" style="color: black">
            <tr>
                <td >স্মারক  নং - {{enTobn($memoInfo['memo_sharok_no'])}}</td>
                <td style="text-align: right">তারিখ: {{enTobn($memoInfo['memo_send_date'])}}</td>
            </tr>
        </table>
    @endif
    <br>
    @if($memoInfo['memo_cc'])
        <table class="bangla-font" width="100%" style="color: black">
            <tr>
                <td style="padding-left: 10px;padding-bottom: 10px">সদয় অবগতি ও প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য:-</td>
            </tr>
            <tr>
                <td>
                    @if($memoInfo['memo_cc'])
                        {{$memoInfo['memo_cc']}}
                    @endif

                </td>
            </tr>
        </table>
    @endif();
    <br>
    <table class="bangla-font" width="100%" style="color: black">
        <tr>
            <td width="33%"></td>
            <td width="33%"></td>
            <td width="34%" style="text-align: center">
                <p>({{$memoInfo['team_leader_name']}})</p>
                <p>{{$memoInfo['team_leader_designation']}}  ও দলনেতা</p>
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
