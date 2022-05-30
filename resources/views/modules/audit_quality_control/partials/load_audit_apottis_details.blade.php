@foreach($apottiStatusList as $apottiStatus)
    <div style="height:100%;page-break-after: always">
        <span class="bangla-font" style="font-family:Nikosh,serif !important;">
            <strong>অনুচ্ছেদ নং-</strong>
            {{enTobn($apottiStatus['apotti']['onucched_no'])}}
        </span>
        <br>
        <span class="bangla-font" style="font-family:Nikosh,serif !important;text-align: justify;">
            <strong>শিরোনামঃ</strong>
            {{$apottiStatus['apotti']['apotti_title']}}
        </span>
        <br>
        <div class="bangla-font" style="font-family:Nikosh,serif !important;text-align:justify;">
            <strong>বিবরণঃ</strong>
            {!! $apottiStatus['apotti']['apotti_description'] !!}
        </div>
        <span class="bangla-font" style="font-family:Nikosh,serif !important;text-align: justify;">
            <strong>অনিয়মের কারণঃ</strong>
            {{$apottiStatus['apotti']['irregularity_cause']}}
        </span>
        <br>
        <span class="bangla-font" style="font-family:Nikosh,serif !important;text-align: justify;">
            <strong>অডিটি প্রতিষ্ঠানের জবাবঃ</strong>
            {{$apottiStatus['apotti']['response_of_rpu']}}
        </span>
        <br>
        <span class="bangla-font" style="font-family:Nikosh,serif !important;text-align: justify;">
            <strong>নিরীক্ষা মন্তব্যঃ</strong>
             {{$apottiStatus['apotti']['audit_conclusion']}}
        </span>
        <br>
        <span class="bangla-font" style="font-family:Nikosh,serif !important;text-align: justify;">
            <strong>নিরীক্ষার সুপারিশঃ</strong>
            {{$apottiStatus['apotti']['audit_recommendation']}}
        </span>
    </div>
@endforeach

