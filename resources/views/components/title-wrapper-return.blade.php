@props(['icon' => 'fad fa-backward', 'class' => '', 'title' => 'Back To List', 'url' => '', 'area' => '#kt_content'])
<div class="row m-0 page-title-wrapper d-md-flex align-items-md-center">
    <div class="col-md-6">
        <div class="title py-2">
            <h4 class="mb-0 font-weight-bold {{$class}}">
                <i title="{{$title}}" data-url="{{$url}}" data-container="{{$area}}"
                   class="fad fa-backward mr-3 return_to_previous" onclick="returnToBack($(this))"></i>
                {{$slot}}
            </h4>
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
