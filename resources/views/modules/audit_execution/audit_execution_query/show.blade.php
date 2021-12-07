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
                <th class="text-center" colspan="3">কোয়েরিসমূহ</th>
            </tr>
            <tr>
                <th width="15%">ক্রমিক নং</th>
                <th width="75%">কোয়েরি</th>
                <th width="10%"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($auditQueryInfo['query_items'] as $item)
                <tr>
                    <th class="text-center">{{enTobn($loop->iteration)}}</th>
                    <td>
                        {{$item['item_title_bn']}}
                        <span class="query_receive_status badge badge-{{$item['status'] =="pending"?'info':'success'}} text-uppercase m-1 p-1 ">
                            {{$item['status']}}
                        </span>
                    </td>
                    <td>
                        @if($scopeAuthority == 0 && $hasSentToRpu == 1 && $item['status'] == 'pending')
                            <button title="রিসিভ করুন" class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                                    data-ac-query-item-id="{{$item['id']}}"
                                    data-ac-query-id="{{$item['ac_query_id']}}"
                                    onclick="Show_Query_Container.receivedQuery($(this))">
                                <i class="fad fa-check-circle"></i>
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    var Show_Query_Container = {
        receivedQuery: function (elem) {
            ac_query_item_id = elem.data('ac-query-item-id');
            ac_query_id = elem.data('ac-query-id');

            url = '{{route('audit.execution.query.received')}}';
            data = {ac_query_item_id, ac_query_id};

            KTApp.block('#kt_quick_panel', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_quick_panel');
                if (response.status === 'error') {
                    toastr.warning(response.data)
                } else {
                    elem.parent().prev('td').find('.query_receive_status').text('Received').addClass('badge-success').removeClass('badge-info')
                    elem.remove();
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
