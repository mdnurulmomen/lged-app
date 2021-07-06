<x-title-wrapper>Staff Calendar</x-title-wrapper>
<div class="row">
    <div class="col-md-12">
        <div id="kt_calendar"></div>
    </div>
</div>

@include('scripts.script_operational_calendar', ['data' => $data])
