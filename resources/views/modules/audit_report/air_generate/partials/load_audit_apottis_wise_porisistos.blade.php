@foreach($porisishtos as $porisishto)
    <div class="pdf-screen bangla-font" style="height: 100%;page-break-before: always;">
        <div class="bangla-font" style="font-family:Nikosh,serif !important;text-align:justify;margin-top: 5px">
            {!! $porisishto['details'] !!}
        </div>
    </div>
@endforeach
