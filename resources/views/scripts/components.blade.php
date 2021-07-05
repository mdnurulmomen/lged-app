<script>
    function returnToBack(elem) {
        let url = elem.data('url')
        let container = elem.data('container')
        ajaxCallAsyncCallback(url, {}, 'html', 'GET', function (response) {
            $(`${container}`).html(response)
        })
    }
</script>
