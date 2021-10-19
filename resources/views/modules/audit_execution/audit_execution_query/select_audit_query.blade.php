<div class="row">
    <input id="cost_center_id" type="hidden" value="{{$cost_center_id}}">
    <input id="cost_center_name_en" type="hidden" value="{{$cost_center_name_en}}">
    <input id="cost_center_name_bn" type="hidden" value="{{$cost_center_name_bn}}">
    <div class="col-md-4">
        <select id="cost_center_type" class="form-control">
            <option value="">Select Institution Type </option>
            @foreach($cost_center_types as $key => $cost_center)
                <option value="{{$cost_center['id']}}">{{$cost_center['name_bn']}}</option>
            @endforeach
        </select>
    </div>
</div>

<div id="queryList"></div>
@include('modules.settings.x_audit_query.partials.query_modal')
<script>
    $('#cost_center_type').change(function () {
        cost_center_type_id = $(this).val();
        url = '{{route('audit.execution.cost-center-type-wise-query')}}';
        data = {cost_center_type_id};
        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            if (response.status === 'error') {
                toastr.warning(response.data)
            } else {
                $('#queryList').html(response);
            }
        })
    });
</script>
