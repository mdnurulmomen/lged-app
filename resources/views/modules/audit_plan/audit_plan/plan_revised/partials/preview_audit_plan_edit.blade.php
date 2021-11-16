<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-end mt-4">
            <button onclick="Edit_Entity_Plan_Container.generatePDF()"
                    title="Download"
                    class="btn btn-danger btn-sm btn-bold btn-square">
                <i class="far fa-file-pdf"></i>
            </button>
        </div>
    </div>
</div>

<div id="writing-screen-wrapper" style="font-family:solaimanlipipdf,serif !important;">
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $cover['content'] !!}
    </div>

    <div class="pdf-screen bangla-font" style="height: 100%">
        @foreach($plans as $plan)
            <div class="plan_content bangla-font">
                {!! $plan['content'] !!}
            </div>
        @endforeach
    </div>

    <br>
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $formThree['content'] !!}
    </div>

    <br>
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $porishisto['content'] !!}
    </div>
</div>

