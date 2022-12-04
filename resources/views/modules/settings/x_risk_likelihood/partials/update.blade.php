<form id="risk_likelihood_form_update">
    <div class="form-row">
        <input type="hidden" id="id" value="{{ $id }}">
        <div class="col-md-12 form-group">
            <label for="email">Title (Bangla):</label>
            <textarea placeholder="Query Title Bangla" class="form-control" type="text" id="title_bn">{{ $title_bn }}</textarea>
        </div>
        <div class="col-md-12 form-group">
            <label for="email">Title (English):</label>
            <textarea placeholder="Query Title English" class="form-control" type="text" id="title_en">{{ $title_en }}</textarea>
        </div>
        <div class="col-md-12 form-group">
            <label for="email">Value:</label>
            <input placeholder="Likelihood Value" class="form-control" type="number" id="likelihood_value" value="{{ $likelihood_value }}">
        </div>
        <div class="col-md-12 form-group">
            <label for="description">Description (Bangla):</label>
            <textarea placeholder="Query Description Bangla" class="form-control" type="text" id="description_bn">{{ $description_bn }}</textarea>
        </div>
        <div class="col-md-12 form-group">
            <label for="description">Description (English):</label>
            <textarea placeholder="Query Description English" class="form-control" type="text" id="description_en">{{ $description_en }}</textarea>
        </div>
        <div class="col-md-12 form-group">
            <label for="description">Comment (Bangla):</label>
            <textarea placeholder="Query Comment Bangla" class="form-control" type="text" id="comment_en">{{ $comment_en }}</textarea>
        </div>
        <div class="col-md-12 form-group">
            <label for="description">Comment (English):</label>
            <textarea placeholder="Query Comment English" class="form-control" type="text" id="commnet_bn">{{ $commnet_bn }}</textarea>
        </div>
        <div class="col-md-12 pt-4">
            <button type="button" class="btn btn-primary btn_update_risk_likelihood pt-4 ml-1">Update</button>
        </div>
    </div>
</form>

<script>
    $('.btn_update_risk_likelihood').click(function () {
        url = "{{ route('settings.risk-likelihoods.update', $id) }}";

        data = {
            id : $('#id').val(),
            title_bn : $('#title_bn').val(),
            title_en : $('#title_en').val(),
            likelihood_value : $('#likelihood_value').val(),
            description_bn : $('#description_bn').val(),
            description_en : $('#description_en').val(),
            comment_en : $('#comment_en').val(),
            commnet_bn : $('#commnet_bn').val(),
        };

        ajaxCallAsyncCallbackAPI(url, data, 'PUT', function (response) {
            if (response.status === 'success') {
                loadData();
                toastr.success(response.data);
                $('.ki-close').click();
                $('.x_risk_likelihood a').click();
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
