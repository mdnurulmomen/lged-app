@props(['from'=>'','to'=>'','total'=>'', 'appLocale' => 'bn', 'extraClass' => '', 'targetClass'=>'paginated-items-list-view', 'callbackFunc'=>''])
@php
    $from= $appLocale=='en'?:enTobn($from);
    $to=$appLocale=='en'?:enTobn($to);
    $total=$appLocale=='en'?:enTobn($total);
@endphp

<div id="pagination_panel" class="float-right d-flex align-items-center" style="vertical-align:middle;">
    <span class="mr-2"><span id="pag_item_length_from">{{$from}}</span> - <span id="pag_item_length_to">{{$to}}</span> সর্বমোট: <span id="pag_item_total">{{$total}}</span></span>
    <div class="btn-group">
        <button class="btn-list-prev btn btn-icon btn-secondary btn-square" {{$from <=1? " disabled " : ''}} type="button">
            <i class="fad fa-chevron-left" data-toggle="popover" data-content="পূর্ববর্তী" data-original-title="" title=""></i></button>
        <button class="btn-list-next btn btn-icon btn-secondary btn-square" type="button" {{$to >= $total? "disabled" : ''}}>
            <i class="fad fa-chevron-right" data-toggle="popover" data-content="পরবর্তী" data-original-title="" title=""></i>
        </button>
    </div>
</div>

<script>

</script>
