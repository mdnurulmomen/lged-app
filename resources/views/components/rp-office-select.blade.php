@php
    $html_ids = json_decode($html_ids, true);
    $h_ministry_id = Arr::has($html_ids, 'ministry') ? $html_ids['ministry'] : 'ministry_id';
    $h_ministry_name = Arr::has($html_ids, 'ministry_name') ? $html_ids['ministry_name'] : 'ministry_name';
    $h_controlling_office_layer_id = Arr::has($html_ids, 'controlling_office_layer') ? $html_ids['controlling_office_layer'] : 'controlling_office_layer_id';
    $h_office_unit_layer_id = Arr::has($html_ids, 'office_unit_layer') ? $html_ids['office_unit_layer'] : 'office_unit_layer_id';
    $h_cost_center_id = Arr::has($html_ids, 'cost_center') ? $html_ids['cost_center'] : 'cost_center_id';
    $h_cost_center_search_btn = Arr::has($html_ids, 'btn') ? $html_ids['cost_center'] : 'cost_center_search_btn';
@endphp
<div class="row">
    <div class="col-md-{{ $view_grid }}">
        <div class="form-group">
            <label for="{{$h_ministry_id}}">মন্ত্রণালয়/বিভাগ</label>
            <select id="{{$h_ministry_id}}" class="form-control rounded-0 select-select2"
                    name="{{$h_ministry_id}}">
                <option value="" selected="selected">--বাছাই করুন--</option>
                @foreach($ministries as $ministry)
                    <option data-ministry-en="{{$ministry['name_eng']}}" data-ministry-bn="{{$ministry['name_bng']}}"
                            value="{{$ministry['id']}}">{{$ministry['name_bng']}}</option>
                @endforeach
            </select>
            <input type="hidden" id="{{$h_ministry_name}}_en" value="">
            <input type="hidden" id="{{$h_ministry_name}}_bn" value="">
        </div>
    </div>
    <div id="controlling_office_layer_div" style="" class="col-md-{{ $view_grid }}">
        <div class="form-group">
            <label for="{{$h_controlling_office_layer_id}}">অফিস লেয়ার </label>
            <select id="{{$h_controlling_office_layer_id}}" class="form-control rounded-0 select-select2"
                    name="{{$h_controlling_office_layer_id}}">
                <option value="0">--বাছাই করুন--</option>
            </select>
        </div>
    </div>
    <div id="office_unit_layer_div" style="" class="col-md-{{ $view_grid }}">
        <div class="form-group">
            <label for="{{$h_office_unit_layer_id}}">অফিস লেয়ার </label>
            <select id="{{$h_office_unit_layer_id}}" class="form-control rounded-0 select-select2"
                    name="{{$h_office_unit_layer_id}}">
                <option value="0">--বাছাই করুন--</option>
            </select>
        </div>
    </div>

    <div id="search_div" style="" class="col-md-{{ $view_grid }}">
        <div class="form-group mb-0 mt-8">
            <button id="{{$h_cost_center_search_btn}}"
                    class="btn btn-outline-secondary justify-content-between d-flex btn-square card-toggle mr-2"
                    type="button">
                <span class="text-nowrap mr-2 text-center"><i class="fad fa-search"></i> খুঁজুন</span>
            </button>
        </div>
    </div>
</div>

<script>

    $("select#{{$h_ministry_id}}").change(function () {
        ministry_id = $(this).val();
        ministry_name_en = $(this).find(':selected').data('ministry-en')
        ministry_name_bn = $(this).find(':selected').data('ministry-bn')
        $('#{{$h_ministry_name}}_en').val(ministry_name_en)
        $('#{{$h_ministry_name}}_bn').val(ministry_name_bn)
        $("#{{$h_controlling_office_layer_id}}").html('');
        loadControllingOfficeLayer(ministry_id);
        $('#{{$h_controlling_office_layer_id}}').show();
    });

    function loadControllingOfficeLayer(ministry_id) {
        var url = '{{route('rpu.controlling-layer.all')}}';
        var data = {ministry_id};
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
            layers = `<option value="0" selected="selected">--বাছাই করুন--</option>`;
            $("#{{$h_controlling_office_layer_id}}").append(layers);
            response.map((layer) => {
                layers = `<option value="${layer.id}">${layer.layer_name_bn}</option>`;
                $("#{{$h_controlling_office_layer_id}}").append(layers);
            })
        });
    }

    $("select#{{$h_controlling_office_layer_id}}").change(function () {
        controlling_office_layer_id = $(this).val();
        ministry_id = $('#{{$h_ministry_id}}').val();
        $('#{{$h_office_unit_layer_id}}').html('');
        loadOfficeUnitLayer(ministry_id, controlling_office_layer_id);
        $('#{{$h_office_unit_layer_id}}').show();
    });

    function loadOfficeUnitLayer(ministry_id, controlling_office_layer_id) {
        $('#{{$h_office_unit_layer_id}}').html();
        var url = '{{route('rpu.office-unit-layer.all')}}';
        var data = {controlling_office_layer_id, ministry_id};
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
            layers = `<option value="0" selected="selected">--বাছাই করুন--</option>`;
            $("#{{$h_office_unit_layer_id}}").append(layers);
            response.map((layer) => {
                layers = `<option value="${layer.id}">${layer.layer_name_bn}</option>`;
                $("#{{$h_office_unit_layer_id}}").append(layers);
            })
        });
    }
</script>
