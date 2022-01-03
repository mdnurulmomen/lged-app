<div class="col-md-12">
    <div class="d-flex justify-content-end">
        <button title="ডাউনলোড করুন" data-memo-id="{{$memo_info['id']}}"
                onclick="Show_Memo_Container.memoPDFDownload($(this))"
                class="btn btn-info btn-sm btn-bold btn-square">
            <i class="far fa-download"></i> ডাউনলোড
        </button>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-12">
        <table class="table table-bordered">
            <tr>
                <td width="20%"><b>শিরোনাম</b></td>
                <td width="80%">{{$memo_info['memo_title_bn']}}</td>
            </tr>
            <tr>
                <td width="20%"><b>বিবরণ</b></td>
                <td width="80%">{!! $memo_info['memo_description_bn']  !!}</td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <table class="table table-bordered">
            <tr>
                <td width="50%"><b>মেমো নং</b></td>
                <td width="50%">{{enTobn($memo_info['onucched_no'])}}</td>
            </tr>
            <tr>
                <td width="50%"><b>জড়িত অর্থ (টাকা)</b></td>
                <td width="50%">{{enTobn(number_format($memo_info['jorito_ortho_poriman'],0))}}</td>
            </tr>
            <tr>
                <td width="50%"><b>আপত্তি অনিয়মের ধরন</b></td>
                <td width="50%">{{$memo_info['memo_irregularity_type_name']}}</td>
            </tr>
            <tr>
                <td width="50%"><b>আপত্তি অনিয়মের সাব ধরন</b></td>
                <td width="50%">{{$memo_info['memo_irregularity_sub_type_name']}}</td>
            </tr>
            <tr>
                <td width="50%"><b>আপত্তির অবস্থা</b></td>
                <td width="50%">{{$memo_info['memo_status_name']}}</td>
            </tr>
        </table>
    </div>

    <div class="col-md-6">
        <table class="table table-bordered">
            <tr>
                <td width="50%"><b>তারিখ</b></td>
                <td width="50%">{{enTobn(date('d/m/Y',strtotime($memo_info['created_at'])))}}</td>
            </tr>
             <tr>
                <td width="50%"><b>অনিষ্পন্ন জড়িত অর্থ (টাকা)</b></td>
                <td width="50%">{{enTobn(number_format($memo_info['onishponno_jorito_ortho_poriman'],0))}}</td>
            </tr>
            <tr>
                <td width="50%"><b>নিরীক্ষা বছর</b></td>
                <td width="50%">{{enTobn($memo_info['audit_year_start'])}} - {{enTobn($memo_info['audit_year_end'])}}</td>
            </tr>
            <tr>
                <td width="50%"><b>নিরীক্ষার ধরন</b></td>
                <td width="50%">{{$memo_info['audit_type']}}</td>
            </tr>
            <tr>
                <td width="50%"><b>আপত্তির ধরন</b></td>
                <td width="50%">{{$memo_info['memo_type_name']}}</td>
            </tr>

        </table>
    </div>
</div>

@if(!empty($memo_info['ac_memo_attachments']))
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <tr>
                <th>ফাইলের ধরন</th>
                <th>ফাইলের নাম</th>
                <th>কার্যক্রম</th>
            </tr>
            @foreach($memo_info['ac_memo_attachments'] as $attachment)
                <tr>
                    <td>{{$attachment['attachment_type']}}</td>
                    <td>{{$attachment['user_define_name']}}</td>
                    <td>
                        <a title="ডাউনলোড করুন" class="text-primary" href="{{$attachment['attachment_path']}}">
                            <i class="fa fa-download"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endif


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
