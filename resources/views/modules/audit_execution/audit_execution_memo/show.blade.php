
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
    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;font-weight: bold">মেমো নং-{{enTobn($memoInfo['onucched_no'])}}</div>

    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;font-weight: bold">
        শিরোনামঃ {{$memoInfo['memo_title_bn']}}
    </div>

    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;text-align: justify;margin-top: 10px">
        <span style="font-weight: bold">বিবরণঃ</span>
        {!! $memoInfo['memo_description_bn'] !!}
    </div>

    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
        <span style="font-weight: bold">নিরীক্ষিত প্রতিষ্ঠানের জবাবঃ</span> {{$memoInfo['response_of_rpu']}}
    </div>

    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
        <span style="font-weight: bold">নিরীক্ষা মন্তব্যঃ</span> {{$memoInfo['audit_conclusion']}}
    </div>

    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
        <span style="font-weight: bold">নিরীক্ষার সুপারিশঃ</span>
        {{$memoInfo['audit_recommendation']}}
    </div>

    <br>
    <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;width: 100%;margin-top: 50px;">
        <div style="float: left;width: 50%;text-align: center">
            <img src="{{$memoInfo['rpu_acceptor_signature'] != NULL?$memoInfo['rpu_acceptor_signature'] : '' }}"
                 style="width: 150px!important;height: 70px!important;">
            <h6>সংশ্লিষ্ট প্রতিষ্ঠান প্রধানের স্বাক্ষর ও তারিখ</h6>
            {{$memoInfo['rpu_acceptor_officer_name_bn']}} <br>
            {{$memoInfo['rpu_acceptor_designation_name_bn']}} <br>
            {{$memoInfo['rpu_acceptor_unit_name_bn']}}
        </div>
        <div style="text-align: center;float:right;width: 50%">
            <img src="" style="width: 150px!important;height: 70px!important;">
            <h6>দলপ্রধানের স্বাক্ষর ও তারিখ</h6>
            {{$memoInfo['sender_officer_name_bn']}} <br>
            {{$memoInfo['sender_designation_bn']}} <br>
            {{$memoInfo['sender_unit_name_bn']}}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
            <span style="font-weight: bold">পরিশিষ্ট</span>

            <div class="mt-3">
                @foreach($memoInfo['ac_memo_attachments'] as $attachment)
                    @if($attachment['attachment_type'] == 'porisishto')
                        <a title="ডাউনলোড করুন" href="{{$attachment['attachment_path']}}" target="_blank" class="btn btn-outline-primary btn-square mt-2">
                            <i class="fal fa-file"></i> {{$attachment['user_define_name']}}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
            <span style="font-weight: bold">প্রমানক</span>

            <div class="mt-3">
                @foreach($memoInfo['ac_memo_attachments'] as $attachment)
                    @if($attachment['attachment_type'] == 'pramanok')
                        <a href="{{$attachment['attachment_path']}}" target="_blank" class="btn btn-outline-primary btn-square mt-2">
                            <i class="fal fa-file"></i> {{$attachment['user_define_name']}}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
            <span style="font-weight: bold">মেমো</span>

            <div class="mt-3">
                @foreach($memoInfo['ac_memo_attachments'] as $attachment)
                    @if($attachment['attachment_type'] == 'memo')
                        <a href="{{$attachment['attachment_path']}}" target="_blank" class="btn btn-outline-primary btn-square mt-2">
                            <i class="fal fa-file"></i> {{$attachment['user_define_name']}}
                        </a>
                    @endif
                @endforeach
            </div>
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
