@props(['icon' => 'fad fa-chevron-left', 'class' => '', 'title' => 'Back To List', 'url' => '', 'area' => '#kt_content'])

<div class="row m-0 page-title-wrapper d-md-flex align-items-md-center">
    <div class="col-md-12">
        <div class="title">
            <span class="btn btn-icon btn-secondary btn-square float-left {{$class}}" data-container="{{$area}}" type="button">
                <i title="{{$title}}" class="{{$icon}}" onclick="returnToBack($(this))"></i>
            </span>
            <span>{{$slot}}</span>
        </div>
    </div>
</div>
<script>
    function returnToBack(elem) {
        var url = elem.data('url')
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
