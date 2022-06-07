@foreach($apottiStatusList as $apottiStatus)
    <div class="pdf-screen bangla-font" style="height: 100%">
        <div style="font-weight: bold">
            অনুচ্ছেদ নং-{{enTobn($apottiStatus['apotti']['onucched_no'])}}
        </div>

        <div style="font-weight: bold">
            শিরোনামঃ {{$apottiStatus['apotti']['apotti_title']}}
        </div>

        <div class="bangla-font" style="font-family:Nikosh,serif !important;text-align:justify;margin-top: 10px">
            <strong>বিবরণঃ</strong>
            <div style="margin-top: -1em;">
                {!! $apottiStatus['apotti']['apotti_description'] !!}
            </div>
        </div>

        <div class="bangla-font" style="font-family:Nikosh,serif !important;margin-top: 10px">
            <span style="font-weight: bold">অনিয়মের কারণঃ</span>
            {{$apottiStatus['apotti']['irregularity_cause']}}
        </div>

        <div class="bangla-font" style="font-family:Nikosh,serif !important;margin-top: 10px">
            <span style="font-weight: bold">অডিটি প্রতিষ্ঠানের জবাবঃ</span>
            {{$apottiStatus['apotti']['response_of_rpu']}}
        </div>

        <div class="bangla-font" style="font-family:Nikosh,serif !important;margin-top: 10px">
            <span style="font-weight: bold">নিরীক্ষা মন্তব্যঃ</span>
            {{$apottiStatus['apotti']['audit_conclusion']}}
        </div>

        <div class="bangla-font" style="font-family:Nikosh,serif !important;margin-top: 10px">
            <span style="font-weight: bold">নিরীক্ষার সুপারিশঃ</span>
            {{$apottiStatus['apotti']['audit_recommendation']}}
        </div>
    </div>
@endforeach
