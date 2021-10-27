<x-title-wrapper>Query Lists ({{$cost_center_name_bn}})</x-title-wrapper>

<div class="row pt-4" style="position:sticky;top:30px;background: white">
    <div class="col-md-8">
        <div class="d-flex justify-content-start">
            <input id="cost_center_id" type="hidden" value="{{$cost_center_id}}">
            <input id="cost_center_name_en" type="hidden" value="{{$cost_center_name_en}}">
            <input id="cost_center_name_bn" type="hidden" value="{{$cost_center_name_bn}}">
            <div class="col-md-4">
                <select id="cost_center_type" class="form-control">
                    <option value="">Select Cost Center Type</option>
                    @foreach($cost_center_types as $key => $cost_center)
                        <option value="{{$cost_center['id']}}">{{$cost_center['name_bn']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="d-flex justify-content-end">
            <div class="row" style="position: sticky;top: 0;background: white;">
                <div class="col-lg-12 mt-2">
                    <button type="button" onclick="Audit_Query_Container.addQuery($(this))"
                        class="float-right font-weight-bolder font-size-sm mb-3 btn btn-primary btn-sm
                        btn-bold btn-square">
                        <i class="far fa-plus mr-1"></i> Add Query
                    </button>
                    <button type="button" onclick="Audit_Query_Container.sendQuery()"
                        class="float-right font-weight-bolder font-size-sm mr-2 btn btn-success btn-sm
                        btn-bold btn-square">
                        <i class="far fa-paper-plane mr-1"></i> Send
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="load_query_list"></div>
<script>

    $(function () {
        cost_center_type_id = '{{$cost_center_type_id}}';
        if (cost_center_type_id) {
            $('#cost_center_type').val(cost_center_type_id).trigger('change')
        }
    })

    $('#cost_center_type').change(function () {
        KTApp.block('#kt_content', {
            opacity: 0.1,
            state: 'primary' // a bootstrap color
        });
        cost_center_id = $('#cost_center_id').val();
        cost_center_type_id = $(this).val();
        url = '{{route('audit.execution.load-audit-query')}}';
        data = {cost_center_type_id, cost_center_id};
        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            KTApp.unblock('#kt_content');
            if (response.status === 'error') {
                toastr.warning(response.data)
            } else {
                $('#load_query_list').html(response);
            }
        })
    });

    var Audit_Query_Container = {
        addQuery: function (elem) {

            cost_center_type_id = $("#cost_center_type").val();
            data = {cost_center_type_id};
            url = '{{route('audit.execution.load-query-create')}}';

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                    cost_center_type_id = '{{$cost_center_type_id}}';
                    $('#cost_center_type').val(cost_center_type_id).trigger('change');
                } else {
                    $(".offcanvas-title").text('Add Query'); //কোয়েরি যোগ করুন
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

        sendQuery: function () {
            cost_center_id = $('#cost_center_id').val();
            cost_center_name_en = $('#cost_center_name_en').val();
            cost_center_name_bn = $('#cost_center_name_bn').val();
            cost_center_type_id = $('#cost_center_type').val();
            queries = {};
            $(".selectQuery").each(function (i, value) {
                if ($(this).is(':checked') && !$(this).is(':disabled')) {
                    queries[$(this).val()] = {
                        query_id: $(this).attr('data-query-id'),
                        query_title_en: $(this).attr('data-query-en'),
                        query_title_bn: $(this).attr('data-query-bn'),
                    }
                }
            });

            console.log(queries);

            if (!queries) {
                toastr.warning('Please Select Query');
                return;
            }

            url = '{{route('audit.execution.send-audit-query')}}';
            data = {queries, cost_center_id, cost_center_type_id, cost_center_name_bn, cost_center_name_en};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#cost_center_type').trigger('change');
                    toastr.success(response.data)
                }
            })
        },

        receivedQuery: function (query_id) {
            cost_center_id = $('#cost_center_id').val();
            cost_center_name_en = $('#cost_center_name_en').val();
            cost_center_name_bn = $('#cost_center_name_bn').val();
            cost_center_type_id = $('#cost_center_type').val();

            url = '{{route('audit.execution.received-audit-query')}}';
            data = {query_id, cost_center_id, cost_center_type_id, cost_center_name_bn, cost_center_name_en};

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

        rejectQuery: function (elem) {
            ac_query_id = elem.data('ac-query-id');
            cost_center_type_id = '{{$cost_center_type_id}}';
            query_title_bn = elem.data('query-title-bn');
            url = '{{route('audit.execution.load-reject-query-form')}}';
            data = {ac_query_id,cost_center_type_id,query_title_bn};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('মন্তব্য করুন');
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
    }
</script>
