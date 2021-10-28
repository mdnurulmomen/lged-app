
<div class="col-md-12">
    <div class="d-flex justify-content-end mt-4">
        <button data-memo-id="{{$memoInfo['id']}}"
                onclick="Show_Memo_Container.memoPDFDownload($(this))"
                class="btn btn-danger btn-sm btn-bold btn-square">
            <i class="far fa-file-pdf"></i>
        </button>
    </div>
</div>

<div class="col-lg-12 p-0 mt-3">
    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;text-align: center">
        অডিট কমপ্লেক্স (৮ম ও ৯ম তলা) <br>
        সেগুনবাগিচা, ঢাকা -১০০০।
    </div>

    <br>
    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;text-align: center;">
        <u>অডিট মেমো</u>
    </div>
    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;font-weight: bold">অনুচ্ছেদ নং-{{enTobn($memoInfo['onucched_no'])}}</div>
    {{--<div class="bangla-font" style="font-family:SolaimanLipi,serif !important;">
        জিজ্ঞাসাপত্র নং-{{enTobn($memoInfo['onucched_no'])}}
    </div>--}}
    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;font-weight: bold">
        শিরোনামঃ {{$memoInfo['memo_title_bn']}}
    </div>

    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;text-align: justify;margin-top: 10px">
        <span style="font-weight: bold">বিবরণঃ</span>
        {!! $memoInfo['memo_description_bn'] !!}
    </div>

    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
        <span style="font-weight: bold">স্থানীয় অফিসের জবাবঃ</span> {{$memoInfo['response_of_rpu']}}
    </div>

    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
        <span style="font-weight: bold">নিরীক্ষার মন্তব্যঃ</span> {{$memoInfo['audit_conclusion']}}
    </div>

    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
        <span style="font-weight: bold">নিরীক্ষার সুপারিশঃ</span>
        {{$memoInfo['audit_recommendation']}}
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
