<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-end mt-4">
            <button onclick="Preview_Audit_Plan_Container.generatePDF()"
                    title="Download"
                    class="btn btn-danger btn-sm btn-bold btn-square">
                <i class="far fa-file-pdf"></i>
            </button>
        </div>
    </div>
</div>

<div id="writing-screen-wrapper" style="font-family:solaimanlipipdf,serif !important;">
   {{--cover page--}}
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[0]['content'] !!}
    </div>

    {{--index page--}}
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[1]['content'] !!}
    </div>

    {{--strategic form part 01--}}
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[3]['content'] !!}
    </div>

    {{--strategic form part 02--}}
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[4]['content'] !!}
    </div>

    {{--strategic form part 03--}}
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[5]['content'] !!}
    </div>

    {{--audit plan form 1 (part-01)--}}
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[6]['content'] !!}
        {!! $plans[7]['content'] !!}
        {!! $plans[8]['content'] !!}
        {!! $plans[9]['content'] !!}
        {!! $plans[10]['content'] !!}
    </div>

    {{--audit plan form 1 (part-02)--}}
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[11]['content'] !!}
    </div>

    {{--audit plan form 1 (part-03)--}}
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[12]['content'] !!}
        {!! $plans[13]['content'] !!}
    </div>

    {{--audit plan form 2 (part-01)--}}
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[14]['content'] !!}
        {!! $plans[15]['content'] !!}
    </div>

    {{--audit plan form 2 (part-01)--}}
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[16]['content'] !!}
        {!! $plans[17]['content'] !!}
    </div>

    {{--audit plan form 2 (part-02)--}}
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[18]['content'] !!}
        {!! $plans[19]['content'] !!}
        {!! $plans[20]['content'] !!}
    </div>

    {{--audit plan form 2 (part-02)--}}
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[21]['content'] !!}
        {!! $plans[22]['content'] !!}
    </div>

    {{--audit plan form 2 (part-03)--}}
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[23]['content'] !!}
    </div>

    {{--audit plan form 2 (part-04)--}}
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[24]['content'] !!}
    </div>

    {{--audit plan form 2 (part-05)--}}
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[25]['content'] !!}
    </div>

    {{--audit plan form 2 (part-06)--}}
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[26]['content'] !!}
    </div>

    {{--audit risk assessment page--}}
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[27]['content'] !!}
    </div>

    {{--materiality calculate page--}}
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[29]['content'] !!}
    </div>

    {{--audit schedule page--}}
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[30]['content'] !!}
    </div>

    {{--audit other details page--}}
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[31]['content'] !!}
    </div>
</div>

<script>
    var Preview_Audit_Plan_Container = {
        generatePDF: function () {
            plan = templateArray;
            scope = 'generate';
            data = {plan,scope};

            url = '{{route('audit.plan.audit.revised.plan.book-audit-plan')}}';

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (response) {
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "audit_plan_"+new Date().toDateString().replace(/ /g,"_")+".pdf";
                    link.click();
                },
                error: function (blob) {
                    toastr.error('Failed to generate PDF.')
                    console.log(blob);
                }
            });
        },
    }
</script>

