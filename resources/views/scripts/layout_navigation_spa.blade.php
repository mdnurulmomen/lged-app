<script>
    $('#kt_aside_menu .menu-nav .menu-link').click(function () {
        let url = $(this).data('url')
        if (url.length < 1) {
            url = $(this).attr('href');
        }
        $.ajax({
            async: true,
            type: "GET",
            url: url,
            dataType: 'html',
            cache: false,
            success: function (data, textStatus) {
                $('#kt_content').html();
                $('#kt_content').html(data);
            },
            error: function (data) {
                console.log(data)
                if (data.status === 404) {
                    toastr.error(data.statusText);
                }
            },
        });

        return false;
    })
    ;
</script>
