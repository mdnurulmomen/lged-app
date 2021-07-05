<script>
    $('#kt_aside_menu .menu-nav .menu-link').click(function (event) {
        event.preventDefault();
        let menuItem = $(this)
        let url = menuItem.data('url')
        if (url.length < 1) {
            url = menuItem.attr('href');
        }
        $.ajax({
            async: true,
            type: "GET",
            url: url,
            dataType: 'html',
            cache: false,
            success: function (data, textStatus) {
                $('#kt_aside_menu .menu-nav').find('.menu-item-active').removeClass('menu-item-active')
                menuItem.parent().addClass('menu-item-active')
                $('#kt_content').html();
                $('#kt_content').html(data);
                menuItem = null;
            },
            error: function (data) {
                console.log(data)
                if (data.status === 404) {
                    toastr.error(data.statusText);
                }
            },
        });
    });
</script>
@include('scripts.components')
