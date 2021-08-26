<div class="row">
    <div class="col-md-{{ $view_grid }}">
        <div class="form-group">
            <label for="ministry_id">মন্ত্রণালয়/বিভাগ</label>
            <select id="ministry_id" class="form-control rounded-0 select-select2"
                    name="ministry_id">
                <option value="" selected="selected">--বাছাই করুন--</option>
                @foreach($ministries as $ministry)
                    <option data-ministry-en="{{$ministry['name_eng']}}" data-ministry-bn="{{$ministry['name_bng']}}"
                            value="{{$ministry['id']}}">{{$ministry['name_eng']}}</option>
                @endforeach
            </select>
            <input type="hidden" id="ministry_name_en" value="">
            <input type="hidden" id="ministry_name_bn" value="">
        </div>
    </div>
    <div id="custom_layer_div" style="" class="col-md-{{ $view_grid }}">
        <div class="form-group">
            <label for="office_layer_id">কাস্টম লেয়ার </label>
            <select id="office_layer_id" class="form-control rounded-0 select-select2"
                    name="office_layer_id">
                <option value="0">--বাছাই করুন--</option>

            </select>
        </div>
    </div>
</div>

<script>

    $("select#ministry_id").change(function () {
        ministry_id = $(this).val();
        ministry_name_en = $(this).find(':selected').data('ministry-en')
        ministry_name_bn = $(this).find(':selected').data('ministry-bn')
        $('#ministry_name_en').val(ministry_name_en)
        $('#ministry_name_bn').val(ministry_name_bn)
        loadLayer(ministry_id);
        $('#office_layer_id').show();
    });

    function loadLayer(ministry_id) {
        var url = '{{route('rpu.office-layer.all')}}';
        var data = {ministry_id};
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
            response.map((layer) => {
                layers = `<option value="${layer.id}">${layer.layer_name_bng}</option>`;
                $("#office_layer_id").append(layers);
            })

        });
    }
</script>
