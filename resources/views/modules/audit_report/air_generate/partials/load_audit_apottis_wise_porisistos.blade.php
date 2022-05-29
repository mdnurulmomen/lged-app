@php $serial_number = 1; @endphp
@foreach($apotti_items as $apotti_item)
    @if(!empty($apotti_item['porisishtos']))
        @foreach($apotti_item['porisishtos'] as $porisishto)
            <div style="height: 100%;page-break-after: always;">
                <span>পরিশিষ্ট নং-{{enTobn($serial_number)}}</span><br>
                <span>অনুচ্ছেদ নং-{{enTobn($apotti_item['onucched_no'])}}</span>
                <div class="bangla-font" style="font-family:Nikosh,serif !important;text-align:justify;margin-top: 5px">
                    {!! $porisishto['details'] !!}
                </div>
            </div>
            @php $serial_number++; @endphp
        @endforeach
    @endif
@endforeach
