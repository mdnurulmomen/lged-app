<x-title-wrapper>অডিট কোয়েরি শিটের তালিকা</x-title-wrapper>

<div class="card sna-card-border d-flex flex-wrap flex-row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-md-7">
                <h4 class="mt-3">
                    {{$cost_center_name_bn}} <br>
                    @if(!empty($project_name_bn))
                        প্রজেক্টঃ {{$project_name_bn}}
                    @endif
                </h4>
            </div>
            <div class="col-md-5">
                <div class="d-flex justify-content-md-end">
                    <a href="javascript:;" title="ফেরত যান"
                       onclick="Audit_Query_Container.backToQuerySchedule($(this))"
                       class="btn btn-sm btn-warning btn_back btn-square mr-1 text-black">
                        <i class="fad fa-arrow-alt-left"></i> ফেরত যান
                    </a>

                    <a class="btn btn-sm btn-primary btn-square"
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

<div class="card sna-card-border mt-2 mb-14">
    <div id="load_query_list"></div>
</div>

<script>

    $(function () {
        KTApp.block('#kt_wrapper', {
            opacity: 0.1,
            state: 'primary' // a bootstrap color
        });
        audit_plan_id = '{{$audit_plan_id}}';
        schedule_id = '{{$schedule_id}}';
        entity_id ='{{$entity_id}}';
        cost_center_id ='{{$cost_center_id}}';
        url = '{{route('audit.execution.query.load-list')}}';
        data = {audit_plan_id,schedule_id,entity_id,cost_center_id};
        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            KTApp.unblock('#kt_wrapper');
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
            audit_plan_id = '{{$audit_plan_id}}';
            entity_id = '{{$entity_id}}';
            cost_center_id = '{{$cost_center_id}}';
            cost_center_name_bn = '{{$cost_center_name_bn}}';
            cost_center_name_en = '{{$cost_center_name_bn}}';
            data = {schedule_id,audit_plan_id,entity_id,cost_center_id,cost_center_name_bn,cost_center_name_en};
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
