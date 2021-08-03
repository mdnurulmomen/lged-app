@props(['href' => '', 'class' => 'btn btn-info', 'id' => ''])
<a href="javascript:;"
   id="{{$id}}"
   class="font-weight-bolder font-size-sm mr-3 {{$class}}"
   data-url="{{$href}}">
    {{$slot}}
</a>
onclick="Audit_Activities_Container.showAnnualActivity($(this))
