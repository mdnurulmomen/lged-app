<script>
    $('#kt_aside_menu .menu-nav .menu-link').click(function (event) {
        event.preventDefault();
        let menuItem = $(this)
        let url = menuItem.data('url')
        if (url.length < 1) {
            url = menuItem.attr('href');
        }
        KTApp.block('#kt_content', {
            opacity: 0.1,
            state: 'primary' // a bootstrap color
        });
        $.ajax({
            async: true,
            type: "GET",
            url: url,
            cache: false,
            success: function (data, textStatus) {
                KTApp.unblock('#kt_content');
                if (data.status === 'error') {
                    toastr.error(data.data.error);
                } else {
                    $('#kt_aside_menu .menu-nav').find('.menu-item-active').removeClass('menu-item-active')
                    menuItem.parent().addClass('menu-item-active')
                    $('#kt_content').html();
                    $('#kt_content').html(data);
                    menuItem = null;
                }
            },
            error: function (data) {
                KTApp.unblock('#kt_content');
                console.log(data)
                if (data.status === 404) {
                    toastr.error(data.statusText);
                }
            },
        });
    });
</script>
