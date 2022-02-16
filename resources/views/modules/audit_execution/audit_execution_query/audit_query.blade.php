<x-title-wrapper>অডিট কোয়েরি শিটের তালিকা</x-title-wrapper>


<div class="table-search-header-wrapper mb-4 pt-3 pb-3 shadow-sm">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-md-7">
                <h4 class="mt-3">
                    {{$cost_center_name_bn}}
                </h4>
            </div>
            <div class="col-md-5">
                <div class="d-flex justify-content-md-end">
                    <a href="javascript:;" title="ফেরত যান"
                       onclick="Audit_Query_Container.backToQuerySchedule($(this))"
                       class="btn btn-sm btn-light-warning btn_back btn-square mr-1">
                        <i class="fad fa-arrow-alt-left"></i> ফেরত যান
                    </a>

                    <a class="btn btn-sm btn-light-success btn_back btn-square"
                       onclick="Audit_Query_Container.addQuery($(this))"
                       title="মেমো তৈরি করুন"
                       href="javascript:;">
                        <i class="fa fa-plus mr-1"></i> কোয়েরি শিট
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card card-custom card-stretch">
    <div class="card-body p-0">
        <div id="load_query_list"></div>
    </div>
</div>

<script>

    $(function () {
        KTApp.block('#kt_content', {
            opacity: 0.1,
            state: 'primary' // a bootstrap color
        });
        schedule_id = '{{$schedule_id}}';
        entity_id ='{{$entity_id}}';
        cost_center_id ='{{$cost_center_id}}';
        url = '{{route('audit.execution.query.load-list')}}';
        data = {entity_id,cost_center_id,schedule_id};
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
