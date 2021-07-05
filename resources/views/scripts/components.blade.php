<script>
    function returnToBack(elem) {
        let url = elem.data('url')
        if (url) {
            let container = elem.data('container')
            ajaxCallAsyncCallback(url, {}, 'html', 'GET', function (response) {
                $(`${container}`).html(response)
            })
        } else {
            toastr.error('URL not found!');
        }
    }
</script>
