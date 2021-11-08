
<div class="col-md-12">
    <div class="d-flex justify-content-end mt-4">
        <button onclick="Show_Query_Container.queryDownload()"
                class="btn btn-danger btn-sm btn-bold btn-square">
            <i class="far fa-file-pdf"></i>
        </button>
    </div>
</div>

<div class="col-lg-12 p-0 mt-3">
{{--    {{dd($auditQueryInfo)}}--}}
    <div class="table-responsive">
        <table class="table" width="100%">
            <tbody>
            <tr>
                <th>স্মারক নং</th>
                <td>{{$auditQueryInfo['memorandum_no']}}</td>
                <th>স্মারক তারিখ</th>
                <td>{{enTobn($auditQueryInfo['memorandum_date'])}}</td>
            </tr>

            <tr>
                <th>বিষয়</th>
                <td colspan="3">{{$auditQueryInfo['subject']}}</td>
            </tr>

            <tr>
                <th>বিস্তারিত</th>
                <td colspan="3">{{$auditQueryInfo['description']}}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-5 table-responsive">
        <table class="table table-bordered" width="100%">
            <thead>
            <tr>
                <th class="text-center" colspan="2">কোয়েরিসমূহ</th>
            </tr>
            <tr>
                <th width="15%">ক্রমিক নং</th>
                <th width="85%">কোয়েরি</th>
            </tr>
            </thead>
            <tbody>
            @foreach($auditQueryInfo['query_items'] as $item)
                <tr>
                    <th class="text-center">{{enTobn($loop->iteration)}}</th>
                    <td>{{$item['item_title_bn']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    var Show_Query_Container={
        receivedQuery: function (query_id) {
            cost_center_id = $('#cost_center_id').val();
            cost_center_name_en = $('#cost_center_name_en').val();
            cost_center_name_bn = $('#cost_center_name_bn').val();

            url = '{{route('audit.execution.received-audit-query')}}';
            data = {query_id, cost_center_id, cost_center_name_bn, cost_center_name_en};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.warning(response.data)
                } else {
                    $('#cost_center_type').trigger('change');
                    toastr.success(response.data)
                }
            })
        },

        queryDownload: function (elem) {
            ac_query_id = '{{$auditQueryInfo['id']}}';
            data = {ac_query_id};
            url = '{{route('audit.execution.query.download')}}';

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
                    link.download = "audit_query.pdf";
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
