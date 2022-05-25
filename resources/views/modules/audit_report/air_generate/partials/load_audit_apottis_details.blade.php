@foreach($apottis as $apotti)
    <div class="pdf-screen bangla-font" style="height: 100%;">
        <span class="bangla-font" style="font-family:Nikosh,serif !important;">
            <strong>অনুচ্ছেদ নং-</strong>
            {{enTobn($apotti['onucched_no'])}}
        </span>
        <br>
        <span class="bangla-font" style="font-family:Nikosh,serif !important;">
            <strong>শিরোনামঃ</strong>
            {{$apotti['apotti_title']}}
        </span>
        <br>
        <div class="bangla-font" style="font-family:Nikosh,serif !important;text-align:justify;">
            <strong>বিবরণঃ</strong>
            {!! $apotti['apotti_description'] !!}
        </div>
        <span class="bangla-font" style="font-family:Nikosh,serif !important;">
            <strong>অনিয়মের কারণঃ</strong>
            {{$apotti['irregularity_cause']}}
        </span>
        <br>
        <span class="bangla-font" style="font-family:Nikosh,serif !important;">
            <strong>অডিটি প্রতিষ্ঠানের জবাবঃ</strong>
            {{$apotti['response_of_rpu']}}
        </span>
        <br>
        <span class="bangla-font" style="font-family:Nikosh,serif !important;">
            <strong>নিরীক্ষা মন্তব্যঃ</strong>
            {{$apotti['audit_conclusion']}}
        </span>
        <br>
        <span class="bangla-font" style="font-family:Nikosh,serif !important;">
            <strong>নিরীক্ষার সুপারিশঃ</strong>
            {{$apotti['audit_recommendation']}}
        </span>
    </div>
@endforeach
