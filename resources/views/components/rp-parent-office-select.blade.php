<div class="row">
    <div class="col-md-{{ $view_grid }}">
        <div class="form-group">
            <label for="parent_ministry_id">মন্ত্রণালয়/বিভাগ</label>
            <select id="parent_ministry_id" class="form-control rounded-0 select-select2"
                    name="parent_ministry_id">
                <option value="" selected="selected">--{{___('generic.choose')}}--</option>
                @foreach($ministries as $ministry)
                    <option data-ministry-en="{{$ministry['name_eng']}}" data-ministry-bn="{{$ministry['name_bng']}}"
                            value="{{$ministry['id']}}">{{$ministry['name_bng']}}</option>
                @endforeach
            </select>
            <input type="hidden" id="parent_ministry_name_en" value="">
            <input type="hidden" id="parent_ministry_name_bn" value="">
        </div>
    </div>
    <div id="office_category_type_area" style="" class="col-md-{{ $view_grid }}">
        <div class="form-group">
            <label for="office_category_type_select">এনটিটি/প্রতিষ্ঠানের ক্যাটাগরি</label>
            <select id="office_category_type_select" class="form-control rounded-0 select-select2"
                    name="office_category_type">
                {{--                                <option value="0" selected="selected">--{{___('generic.choose')}}--</option>--}}
                <option value="0">সকল ক্যাটাগরি</option>
                @foreach($category_types as $category_type)
                    <option data-category-type-en="{{$category_type['category_title_en']}}" data-category-type-bn="{{$category_type['category_title_bn']}}"
                            value="{{$category_type['id']}}">{{$category_type['category_title_bn']}}</option>
                @endforeach
            </select>
            <input type="hidden" id="office_category_type_title_en" value="">
            <input type="hidden" id="office_category_type_title_bn" value="">
        </div>
    </div>
    {{--    <div id="custom_layer_div" style="" class="col-md-{{ $view_grid }}">--}}
    {{--        <div class="form-group">--}}
    {{--            <label for="parent_office_layer_id">এনটিটি/প্রতিষ্ঠান এর ধরন</label>--}}
    {{--            <select id="parent_office_layer_id" class="form-control rounded-0 select-select2"--}}
    {{--                    name="parent_office_layer_id">--}}
    {{--                <option value="0">--বাছাই করুন--</option>--}}
    {{--            </select>--}}
    {{--        </div>--}}
    {{--    </div>--}}
</div>

{{--<div class="row">--}}
{{--    <div class="col-md-{{ $view_grid }}">--}}
{{--        <div class="form-group">--}}
{{--            <label for="fiscal_year_id">Audit Due Year</label>--}}
{{--            <select id="fiscal_year_id" class="form-control rounded-0 select-select2"--}}
{{--                    name="fiscal_year_id">--}}
{{--                <option value="" selected="selected">--বাছাই করুন--</option>--}}
{{--                @foreach($fiscal_years as $fiscal_year)--}}
{{--                    <option--}}
{{--                        value="{{$fiscal_year['start']}}" {{now()->year == $fiscal_year['end']?'selected':''}}>{{$fiscal_year['description']}}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--        <div id="custom_layer_div" style="" class="col-md-{{ $view_grid }}">--}}
{{--            <div class="form-group">--}}
{{--                <label for="parent_office_layer_id">অফিস লেয়ার </label>--}}
{{--                <select id="parent_office_layer_id" class="form-control rounded-0 select-select2"--}}
{{--                        name="parent_office_layer_id">--}}
{{--                    <option value="0">--বাছাই করুন--</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--</div>--}}

<script>

    $("select#parent_ministry_id").change(function () {
        $('.rp_auditee_office_tree').html('');
        $('.rp_auditee_parent_office_tree').html('');
        parent_ministry_id = $(this).val();
        parent_ministry_name_en = $(this).find(':selected').data('ministry-en')
        parent_ministry_name_bn = $(this).find(':selected').data('ministry-bn')
        console.log(parent_ministry_name_bn)
        $('#parent_ministry_name_en').val(parent_ministry_name_en)
        $('#parent_ministry_name_bn').val(parent_ministry_name_bn)
        // $("#parent_office_layer_id").html('');
        // loadParentLayer(parent_ministry_id);
        // loadEntities(parent_ministry_id);
        // $('#parent_office_layer_id').show();
    });

    $("select#office_category_type_select").change(function () {
        $('.rp_auditee_office_tree').html('');
        $('.rp_auditee_parent_office_tree').html('');
        office_type_id = $(this).val();
        console.log(office_type_id)
        if (office_type_id > 0) {
            office_type_name_en = $(this).find(':selected').data('category-type-en')
            office_type = $(this).find(':selected').data('category-type-bn')
            console.log(office_type)
            console.log(office_type_name_en)
            $('#office_category_type_title_en').val(office_type_name_en)
            $('#office_category_type_title_bn').val(office_type)
            $('#office_category_type_select').val(office_type_id)
        } else {
            $('#office_category_type_title_en').val('')
            $('#office_category_type_title_bn').val('')
            $('#office_category_type_select').val('')
        }
    });


    function loadEntities(parent_ministry_id) {
        var url = '{{route('rpu.office-layer.all')}}';
        var data = {parent_ministry_id};
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
            console.log(response)
            layers = `<option value="0" selected="selected">--বাছাই করুন--</option>`;
            $("#parent_office_layer_id").append(layers);
            response.map((layer) => {
                layers = `<option value="${layer.id}">${layer.layer_name_bng}</option>`;
                $("#parent_office_layer_id").append(layers);
            })

        });
    }

    function loadParentLayer(parent_ministry_id) {
        var url = '{{route('rpu.office-layer.all')}}';
        var data = {parent_ministry_id};
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
            console.log(response)
            layers = `<option value="0" selected="selected">--বাছাই করুন--</option>`;
            $("#parent_office_layer_id").append(layers);
            response.map((layer) => {
                layers = `<option value="${layer.id}">${layer.layer_name_bng}</option>`;
                $("#parent_office_layer_id").append(layers);
            })

        });
    }
</script>
