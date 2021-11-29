<!--begin::Table-->
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th width="20%" class="text-left">কস্ট সেন্টার</th>
            <th width="15%" class="text-left">স্মারক নং</th>
            <th width="10%" class="text-left">স্মারক তারিখ</th>
            <th width="30%" class="text-left">বিষয়</th>
            <th width="10%" class="text-center">সম্পাদন</th>
        </tr>
        </thead>
        <tbody>
        @foreach($audit_query_list as $query)
            <tr>
                <td>{{$query['cost_center_name_bn']}}</td>
                <td>{{$query['memorandum_no']}}</td>
                <td>{{$query['memorandum_date']}}</td>
                <td>{{$query['subject']}}</td>
                <td class="text-center">
                    <button title="দেখুন" class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                            data-ac-query-id="{{$query['id']}}"  data-has-sent-to-rpu="{{$query['has_sent_to_rpu']}}"
                            onclick="Audit_Query_List_Container.viewQuery($(this))">
                        <i class="fad fa-eye"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!--end::Table-->

<script>
    var Audit_Query_List_Container = {
        editQuery: function (elem) {
            ac_query_id = elem.data('ac-query-id');
            schedule_id = elem.data('schedule-id');
            data = {ac_query_id,schedule_id};
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
            has_sent_to_rpu = elem.data('has-sent-to-rpu');

            data = {ac_query_id,has_sent_to_rpu};
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

