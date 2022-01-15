@foreach($apottis as $apotti)
    <div class="pdf-screen bangla-font" style="height: 100%">
        <div style="font-weight: bold">
            অনুচ্ছেদ নং-{{enTobn($apotti['onucched_no'])}}
        </div>

        @if(isset($qac_type))
            @if($apotti['apotti_type'] == 'sfi')
                @php $apotti_type = 'এসএফআই'; @endphp
            @elseif($apotti['apotti_type'] == 'non-sfi')
                @php $apotti_type = 'নন-এসএফআই'; @endphp
            @else
                @php $apotti_type = ''; @endphp
            @endif
            <div style="font-weight: bold">
                আপত্তির ধরনঃ {{$apotti_type}}
            </div>
        @endif

        <div style="font-weight: bold">
            শিরোনামঃ {{$apotti['apotti_title']}}
        </div>

        <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;text-align:justify;margin-top: 10px">
            <span style="font-weight: bold">বিবরণঃ</span>
            {!! $apotti['apotti_description'] !!}
        </div>

        <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
            <span style="font-weight: bold">অনিয়মের কারণঃ</span>
            {{$apotti['irregularity_cause']}}
        </div>

        <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
            <span style="font-weight: bold">অডিটি প্রতিষ্ঠানের জবাবঃ</span>
            {{$apotti['response_of_rpu']}}
        </div>

        <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
            <span style="font-weight: bold">নিরীক্ষা মন্তব্যঃ</span>
            {{$apotti['audit_conclusion']}}
        </div>

        <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
            <span style="font-weight: bold">নিরীক্ষার সুপারিশঃ</span>
            {{$apotti['audit_recommendation']}}
        </div>
    </div>
    <br>
@endforeach
