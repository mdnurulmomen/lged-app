<form id="risk_rating_form_update">
    <div class="form-row">
        <input type="hidden" id="id" value="{{ $id }}">
        <div class="col-md-12 form-group">
            <label for="factor">Factor:</label>
            <select class="form-control" id="x_risk_factor_id">
                <option>Select rating:</option>
                @foreach ($riskFactors as $riskFactor)
                    <option 
                        value="{{ $riskFactor['id'] }}" 
                        @if ($riskFactor['id'] == $x_risk_factor_id) selected @endif
                    >
                        {{ $riskFactor['title_en'] }}
                    </option>
                @endforeach
              </select>
        </div>
        <div class="col-md-12 form-group">
            <label for="email">Value:</label>
            <input placeholder="Rating Value" class="form-control" id="rating_value" value="{{ $rating_value }}">
        </div>
        <div class="col-md-12 form-group">
            <label for="email">Title (Bangla):</label>
            <textarea placeholder="Query Title Bangla" class="form-control" type="text" id="title_bn">{{ $title_bn }}</textarea>
        </div>
        <div class="col-md-12 form-group">
            <label for="email">Title (English):</label>
            <textarea placeholder="Query Title English" class="form-control" type="text" id="title_en">{{ $title_en }}</textarea>
        </div>
        <div class="col-md-12 pt-4">
            <button type="button" class="btn btn-primary btn_update_risk_rating pt-4 ml-1">Update</button>
        </div>
    </div>
</form>

<script>
    $('.btn_update_risk_rating').click(function () {
        url = "{{ route('settings.risk-ratings.update', $id) }}";

        // console.log(url);
        
        // var data = $('#risk_rating_form_update').serialize();

        data = {
            id : $('#id').val(),
            title_bn : $('#title_bn').val(),
            title_en : $('#title_en').val(),
            rating_value : $('#rating_value').val(),
            x_risk_factor_id : $('#x_risk_factor_id').val(),
        };

        ajaxCallAsyncCallbackAPI(url, data, 'PUT', function (response) {
            if (response.status === 'success') {
                loadData();
                toastr.success(response.data);
                $('.ki-close').click();
                $('.x_risk_rating a').click();
            } else {
                toastr.error(response.data.message)
                if (response.data.errors) {
                    $.each(response.data.errors, function (k, v) {
                        if (isArray(v)) {
                            $.each(v, function (n, m) {
                                toastr.error(m)
                            })
                        } else {
                            if (v !== '') {
                                toastr.error(v);
                            }
                        }
                    });
                }
                
                // console.log(response.data)
            }
        });
    });
</script>
