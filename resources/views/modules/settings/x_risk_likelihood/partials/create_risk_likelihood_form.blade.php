<form id="risk_likelihood_form">
    <div class="form-row">
        <div class="col-md-12 form-group">
            <label for="email">Title (Bangla):</label>
            <textarea placeholder="Query Title Bangla" class="form-control" type="text" id="title_bn"></textarea>
        </div>
        <div class="col-md-12 form-group">
            <label for="email">Title (English):</label>
            <textarea placeholder="Query Title English" class="form-control" type="text" id="title_en"></textarea>
        </div>
        <div class="col-md-12 form-group">
            <label for="email">Value:</label>
            <input placeholder="Likelihood Value" class="form-control" type="number" id="likelihood_value">
        </div>
        <div class="col-md-12 form-group">
            <label for="description">Description (Bangla):</label>
            <textarea placeholder="Query Description Bangla" class="form-control" type="text" id="description_bn"></textarea>
        </div>
        <div class="col-md-12 form-group">
            <label for="description">Description (English):</label>
            <textarea placeholder="Query Description English" class="form-control" type="text" id="description_en"></textarea>
        </div>
        <div class="col-md-12 form-group">
            <label for="description">Comment (Bangla):</label>
            <textarea placeholder="Query Comment Bangla" class="form-control" type="text" id="comment_en"></textarea>
        </div>
        <div class="col-md-12 form-group">
            <label for="description">Comment (English):</label>
            <textarea placeholder="Query Comment English" class="form-control" type="text" id="commnet_bn"></textarea>
        </div>
        <div class="col-md-12 pt-4">
            <button type="button" id="btn_risk_likelihood_modal_save" class="btn btn-primary ml-auto">Save</button>
        </div>
    </div>
</form>

<script>
    $('#btn_risk_likelihood_modal_save').click(function () {
        url = "{{ route('settings.risk-likelihoods.store') }}";
        method = 'POST';
        
        // data = $('#risk_likelihood_form').serialize();

        data = {
            title_bn : $('#title_bn').val(),
            title_en : $('#title_en').val(),
            likelihood_value : $('#likelihood_value').val(),
            description_bn : $('#description_bn').val(),
            description_en : $('#description_en').val(),
            comment_en : $('#comment_en').val(),
            commnet_bn : $('#commnet_bn').val(),
        };
        
        // console.log(data);

        ajaxCallAsyncCallbackAPI(url, data, method, function (response) {
            if (response.status === 'success') {
                loadData();
                toastr.success('Success');
                $('.btn-quick-panel-close').click();
            } else {
                // toastr.error(response.data.message)
                if (response.errors.length) {
                    $.each(response.errors, function (k, v) {
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
            }
        })
    });
</script>

