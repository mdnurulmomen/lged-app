<x-title-wrapper-return>অডিট কোয়েরি শিটের তালিকা ({{$cost_center_name_bn}})</x-title-wrapper-return>

<div class="col-md-12">
    <div class="d-flex justify-content-end">
        <a
            onclick="Audit_Query_Container.backToQuerySchedule($(this))"
            class="btn btn-sm btn-outline-warning btn_back btn-square mr-3">
            <i class="fad fa-arrow-alt-left"></i> ফেরত যান
        </a>
        <a class="btn btn-primary btn-sm btn-bold btn-square"
           onclick="Audit_Query_Container.addQuery($(this))"
           href="javascript:;">
            <i class="far fa-plus mr-1"></i> কোয়েরি শিট যোগ করুন
        </a>
    </div>
</div>

<div class="px-3" id="load_query_list"></div>
<script>

    $(function () {
        KTApp.block('#kt_content', {
            opacity: 0.1,
            state: 'primary' // a bootstrap color
        });
        schedule_id = '{{$schedule_id}}';
        cost_center_id ='{{$cost_center_id}}';
        url = '{{route('audit.execution.query.load-list')}}';
        data = { cost_center_id,schedule_id};
        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            KTApp.unblock('#kt_content');
            if (response.status === 'error') {
                toastr.warning(response.data)
            } else {
                $('#load_query_list').html(response);
            }
        })
    })

    var Audit_Query_Container = {
        addQuery: function (elem) {
            schedule_id = '{{$schedule_id}}';
            cost_center_id = '{{$cost_center_id}}';
            cost_center_name_bn = '{{$cost_center_name_bn}}';
            cost_center_name_en = '{{$cost_center_name_bn}}';
            data = {schedule_id,cost_center_id,cost_center_name_bn,cost_center_name_en};
            url = '{{route('audit.execution.query.create')}}';
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#kt_content').html(response)
                }
            });
        },
        backToQuerySchedule:function (){
            $('.audit_query_schedule_menu a').click();
        }
    }
</script>
