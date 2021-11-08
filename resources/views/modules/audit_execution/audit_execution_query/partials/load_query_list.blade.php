<!--begin::Table-->
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th width="10%" class="text-center">ক্রমিক নং</th>
            <th width="25%" class="text-left">স্মারক নং</th>
            <th width="15%" class="text-center">স্মারক তারিখ</th>
            <th width="40%" class="text-left">বিষয়</th>
            <th width="10%" class="text-left">কার্যক্রম</th>
        </tr>
        </thead>
        <tbody>
        @forelse($audit_query_list as $query)
        <tr>
            <td class="text-center">{{enTobn($loop->iteration)}}</td>
            <td>
                {{$query['memorandum_no']}}
                <span class="badge badge-info text-uppercase m-1 p-1 ">
                    {{$query['status']}}
                </span>
            </td>
            <td class="text-center">{{enTobn($query['memorandum_date'])}}</td>
            <td class="text-left">{{$query['subject']}}</td>
            <td class="text-left">
                <div class="btn-group btn-group-sm" role="group">
                    @if($query['has_sent_to_rpu'] == 0)
                        <button title="হালনাগাদ করুন" class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                                data-ac-query-id="{{$query['id']}}" onclick="Audit_Query_List_Container.editQuery($(this))">
                            <i class="fad fa-edit"></i>
                        </button>
                    @endif

                    <button title="দেখুন" class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                    data-ac-query-id="{{$query['id']}}" onclick="Audit_Query_List_Container.viewQuery($(this))">
                        <i class="fad fa-eye"></i>
                    </button>

                    @if($query['has_sent_to_rpu'] == 0)
                        <button title="প্রেরণ করুন" class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                                data-ac-query-id="{{$query['id']}}" data-cost-center-id="{{$query['cost_center_id']}}" onclick="Audit_Query_List_Container.sendQueryToRpu($(this))">
                            <i class="fa fa-paper-plane"></i>
                        </button>
                    @endif

                </div>
            </td>
        </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center"><span>কোন কোয়েরি পাওয়া যায়নি</span></td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<script>
    var Audit_Query_List_Container = {
        editQuery: function (elem) {
            ac_query_id = elem.data('ac-query-id');
            data = {ac_query_id};
            url = '{{route('audit.execution.query.edit')}}';

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#kt_content').html(response)
                }
            });
        },

        viewQuery: function (elem) {
            ac_query_id = elem.data('ac-query-id');
            data = {ac_query_id};
            url = '{{route('audit.execution.query.view')}}';

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('কোয়েরি শিটের বিস্তারিত');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '40%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        sendQueryToRpu: function (elem) {
            ac_query_id = elem.data('ac-query-id');
            data = {ac_query_id};
            url = '{{route('audit.execution.query.send-to-rpu')}}';

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    toastr.success(response.data)

                    KTApp.block('#kt_content', {
                        opacity: 0.1,
                        state: 'primary' // a bootstrap color
                    });
                    cost_center_id = elem.data('cost-center-id');
                    url = '{{route('audit.execution.query.load-list')}}';
                    data = { cost_center_id};
                    ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                        KTApp.unblock('#kt_content');
                        if (response.status === 'error') {
                            toastr.warning(response.data)
                        } else {
                            $('#load_query_list').html(response);
                        }
                    })
                }
            })
        },
    }
</script>


