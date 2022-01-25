
<div class="col-md-12">
    <div class="d-flex justify-content-end mt-4">
        <button title="ডাউনলোড করুন" data-memo-id="{{$memoInfo['id']}}"
                onclick="Show_Memo_Container.memoPDFDownload($(this))"
                class="btn btn-info btn-sm btn-bold btn-square">
            <i class="far fa-download"></i> ডাউনলোড
        </button>
    </div>
</div>

<div class="col-lg-12 p-0 mt-3">
    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;font-weight: bold">অডিট মেমো নং-{{enTobn($memoInfo['onucched_no'])}}</div>

    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;font-weight: bold">
        শিরোনামঃ {{$memoInfo['memo_title_bn']}}
    </div>

    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;text-align: justify;margin-top: 10px">
        <span style="font-weight: bold">বিবরণঃ</span>
        {!! $memoInfo['memo_description_bn'] !!}
    </div>

    {{--<div class="bangla-font" style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
        <span style="font-weight: bold">অনিয়মের কারণঃ</span> {{$memoInfo['irregularity_cause']}}
    </div>--}}

    @if($memoInfo['response_of_rpu'])
        <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
            <span style="font-weight: bold">অডিটি প্রতিষ্ঠানের জবাবঃ</span> {{$memoInfo['response_of_rpu']}}
        </div>
    @endif

    @if($memoInfo['audit_conclusion'])
    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
        <span style="font-weight: bold">নিরীক্ষা মন্তব্যঃ</span> {{$memoInfo['audit_conclusion']}}
    </div>
    @endif

    @if($memoInfo['audit_recommendation'])
    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
        <span style="font-weight: bold">নিরীক্ষার সুপারিশঃ</span>
        {{$memoInfo['audit_recommendation']}}
    </div>
    @endif

    <br>
    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;width: 100%;margin-top: 50px;">
        <div style="float: left;width: 50%;text-align: center">
            {{--<img src="{{asset('assets/images/user_signature.png')}}" style="width: 150px!important;height: 70px!important;">--}}
            {{--<img src="{{$memoInfo['rpu_acceptor_signature'] != NULL?$memoInfo['rpu_acceptor_signature'] : '' }}"
                 style="width: 150px!important;height: 70px!important;">--}}
            <h6>অডিট ইউনিট/কস্ট সেন্টার</h6>
            নামঃ {{$memoInfo['rpu_acceptor_officer_name_bn']}} <br>
            পদবিঃ {{$memoInfo['rpu_acceptor_designation_name_bn']}}
        </div>
        <div style="text-align: center;float:right;width: 50%">
            <h6>ইস্যুকারী</h6>
            নামঃ {{$memoInfo['sender_officer_name_bn']}} <br>
            পদবিঃ {{$memoInfo['sender_designation_bn']}} <br>
            দলনেতাঃ  <br>
            উপদলনেতাঃ
        </div>
    </div>
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
