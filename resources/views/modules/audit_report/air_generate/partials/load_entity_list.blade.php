
<div class="row">
    <div class="col-md-12">
        <select class="form-control" name="entity_id" id="entity_id">
            <option>--এন্টিটি বাছাই করুন--</option>
            @foreach($entity_info as $entity)
                <option
                    data-ministry-id="{{$entity['ministry_id']}}"
                    data-ministry-name-en="{{$entity['ministry_name_en']}}"
                    data-ministry-name-bn="{{$entity['ministry_name_bn']}}"
                    data-entity-name-en="{{$entity['entity_name_en']}}"
                    data-entity-name-bn="{{$entity['entity_name_bn']}}"
                    value="{{$entity['entity_id']}}">
                    {{$entity['entity_name_bn']}}
                </option>
            @endforeach
        </select>
    </div>
</div>


<div class="load_entity_wise_apotti"></div>

<script>
    $('#entity_id').change(function (){
        ministry_id = $(this).find(':selected').attr('data-ministry-id');
        ministry_name_bn = $(this).find(':selected').attr('data-ministry-name-bn');
        ministry_name_en = $(this).find(':selected').attr('data-ministry-name-en');

        entity_id = $(this).val();
        entity_name_bn = $(this).find(':selected').attr('data-entity-name-bn');
        entity_name_en = $(this).find(':selected').attr('data-entity-name-en');

        $('#ministry_id').val(ministry_id);
        $('#ministry_name_en').val(ministry_name_en);
        $('#ministry_name_bn').val(ministry_name_bn);

        $('#air_entity_id').val(entity_id);
        $('#entity_name_bn').val(entity_name_bn);
        $('#entity_name_en').val(entity_name_en);

        air_type = '{{$air_type}}';
        fiscal_year_id = '{{$fiscal_year_id}}';
        audit_plan_id = '{{$audit_plan_id}}';
        data = {air_id,air_type,fiscal_year_id,audit_plan_id,entity_id};
        url = '{{route('audit.report.air.get-audit-apotti-list')}}';

        KTApp.block('#kt_content', {
            opacity: 0.1,
            state: 'primary' // a bootstrap color
        });

        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            KTApp.unblock('#kt_content');
            if (response.status === 'error') {
                toastr.error('No data found');
            } else {
                $('.load_entity_wise_apotti').html(response);
            }
        });
        // AIR_Report_Create_Container.loadApottiList(fiscal_year_id,audit_plan_id,entity_id);
    });
</script>
