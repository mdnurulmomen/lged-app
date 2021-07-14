<script>
    arrows = {
        leftArrow: '<i class="la la-angle-left"></i>',
        rightArrow: '<i class="la la-angle-right"></i>'
    }

    $('.year-format').datepicker({
        todayHighlight: true,
        orientation: "bottom left",
        templates: arrows,
        format: "yyyy",
        weekStart: 1,
        keyboardNavigation: false,
        viewMode: "years",
        minViewMode: "years"
    });

    $('.date').datepicker({
        todayHighlight: true,
        orientation: "bottom left",
        templates: arrows,
        format: "dd-mm-yyyy",
    });

    function submitModalData(url, data, method, modal_id) {
        ajaxCallAsyncCallbackAPI(url, data, method, function (response) {
            if (response.status === 'success') {
                toastr.success('Success')
                $('#' + modal_id).modal('hide');
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
                console.log(data)
            }
        })
    }

    function emptyModalData(modal_id) {
        $('#' + modal_id + ' :input').val('')
        $('#' + modal_id + ' select').val('').trigger('change')
        $('#' + modal_id + ' input[type=checkbox]').prop('checked', false);
    }

</script>
