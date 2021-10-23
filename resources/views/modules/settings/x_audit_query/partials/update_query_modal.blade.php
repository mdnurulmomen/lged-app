<form id="audit_query_form_update">
    <div class="form-row pt-4">
        <div class="col-md-12">
            <select name="cost_center_type_id" id="cost_center_type_id" class="form-control select-select2">
                <option value="">Select Cost Center Type</option>
                @foreach($cost_center_types as $key => $type)
                    <option @if($type['id'] = $audit_query_cost_center_type) selected
                            @endif value="{{$type['id']}}">{{$type['name_bn']}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-row pt-4">
        <div class="col-md-12">
            <textarea id="query_title_bn" placeholder="Query Title Bangla" class="form-control" type="text"
                      name="query_title_bn">{{$audit_query_title_bn}}</textarea>
        </div>
    </div>
    <div class="form-row pt-4">
        <div class="col-md-12">
            <textarea id="query_title_en" placeholder="Query Title Bangla" class="form-control" type="text"
                      name="query_title_en">{{$audit_query_title_en}}</textarea>
        </div>
    </div>
    <input type="hidden" name="audit_query_id" id="audit_query_id" value="{{$audit_query_id}}">
    <div class="form-row pt-4">
        <button type="button" class="btn btn-primary btn_update_audit_query pt-4 ml-1">Save</button>
    </div>
</form>

<script>
    $('.btn_update_audit_query').click(function () {
        url = '{{route('settings.audit-query.update', ['audit_query' => $audit_query_id])}}';
        var data = $('#audit_query_form_update').serialize();
        ;
        ajaxCallAsyncCallbackAPI(url, data, 'PUT', function (resp) {
            if (resp.status === 'error') {
                toastr.error('no');
                console.log(resp.data)
            } else {
                toastr.success(resp.data);
            }
        });
    });
</script>
