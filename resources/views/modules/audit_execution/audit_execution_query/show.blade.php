@if($scopeAuthority == 0)
    <div class="col-md-12">
        <div class="d-flex justify-content-end mt-4">
            <button onclick="Show_Query_Container.queryDownload()"
                    class="btn btn-danger btn-sm btn-bold btn-square">
                <i class="far fa-file-pdf"></i>
            </button>
        </div>
    </div>
@endif

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
                <th width="65%">কোয়েরি</th>
                @if($scopeAuthority == 0) <th width="20%"></th> @endif
            </tr>
            </thead>
            <tbody>
            @foreach($auditQueryInfo['query_items'] as $item)
                <tr id="row_query_item_{{$item['id']}}">
                    <th class="text-center">{{enTobn($loop->iteration)}}</th>
                    <td>
                        {{$item['item_title_bn']}}

                        @if($item['status'] =="pending")
                            @php $badgeStyle ='warning'; @endphp
                        @elseif($item['status'] =="submitted")
                            @php $badgeStyle ='primary'; @endphp
                        @else
                            @php $badgeStyle ='success'; @endphp
                        @endif
                        <span class="query_receive_status badge badge-{{$badgeStyle}} text-uppercase m-1 p-1 ">
                            {{$item['status']}}
                        </span>
                    </td>

                    @if($scopeAuthority == 0)
                        <td>
                            @if($item['status'] == 'submitted')
                                <button title="রিসিভ করুন" class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                                        data-ac-query-item-id="{{$item['id']}}"
                                        data-ac-query-id="{{$item['ac_query_id']}}"
                                        onclick="Show_Query_Container.receivedQuery($(this))">
                                    <i class="fad fa-check-circle"></i>
                                </button>
                            @endif

                            @if($item['status'] != 'pending')
                                <button title="কমেন্ট দেখুন" class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                                        data-ac-query-item-id="{{$item['id']}}"
                                        data-ac-query-item-comment="{{$item['comment']}}"
                                        onclick="Show_Query_Container.showQueryComment($(this))">
                                    <i class="fal fa-eye"></i>
                                </button>
                            @endif
                        </td>
                    @endif
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

        showQueryComment: function (elem) {
            $('.query_comment_row').remove();
            item_id = elem.data('ac-query-item-id');
            comment = elem.data('ac-query-item-comment');
            $("#row_query_item_"+item_id).after(`<span class="query_comment_row">${comment}</span>`);
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
