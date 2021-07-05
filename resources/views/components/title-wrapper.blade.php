@props(['icon' => 'fas fa-list', 'class' => ''])
<div class="row m-0 page-title-wrapper d-md-flex align-items-md-center">
    <div class="col-md-6">
        <div class="title py-2">
            <h4 class="mb-0 font-weight-bold {{$class}}"><i class="{{$icon}} mr-3"></i>{{$slot}}</h4>
        </div>
    </div>
</div>
