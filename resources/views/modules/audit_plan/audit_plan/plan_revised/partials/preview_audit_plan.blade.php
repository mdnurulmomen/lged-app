@if($scope_editable == 1 && $current_office_id != 1) {{--&& $approval_status != 'approved'--}}
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                <button onclick="Audit_Plan_Container.loadAuditPlanBookEditable($(this))"
                    title="প্ল্যান-{{enTobn($audit_plan_id)}} বিস্তারিত দেখুন"
                    data-audit-plan-id="{{$audit_plan_id}}"
                    data-fiscal-year-id="{{$fiscal_year_id}}"
                    data-annual-plan-id="{{$annual_plan_id}}"
                    class="btn btn-primary btn-sm btn-bold btn-square">
                    <i class="fad fa-edit text-dark-100 mr-2"></i> হালনাগাদ করুন
                </button>
            </div>
        </div>
    </div>
@endif

<iframe src="{{asset('storage/individual_plan/'.$fileName)}}" width="100%" height="100%"></iframe>

{{--<div id="writing-screen-wrapper" style="font-family:nikoshpdf,serif !important;">
   --}}{{--cover page--}}{{--
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[0]['content'] !!}
    </div>

    --}}{{--index page--}}{{--
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[1]['content'] !!}
    </div>

    --}}{{--strategic form part 01--}}{{--
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[3]['content'] !!}
    </div>

    --}}{{--strategic form part 02--}}{{--
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[4]['content'] !!}
    </div>

    --}}{{--strategic form part 03--}}{{--
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[5]['content'] !!}
    </div>

    --}}{{--audit plan form 1 (part-01)--}}{{--
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[6]['content'] !!}
        {!! $plans[7]['content'] !!}
        {!! $plans[8]['content'] !!}
        {!! $plans[9]['content'] !!}
        {!! $plans[10]['content'] !!}
    </div>

    --}}{{--audit plan form 1 (part-02)--}}{{--
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[11]['content'] !!}
    </div>

    --}}{{--audit plan form 1 (part-03)--}}{{--
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[12]['content'] !!}
        {!! $plans[13]['content'] !!}
    </div>

    --}}{{--audit plan form 2 (part-01)--}}{{--
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[14]['content'] !!}
        {!! $plans[15]['content'] !!}
    </div>

    --}}{{--audit plan form 2 (part-01)--}}{{--
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[16]['content'] !!}
        {!! $plans[17]['content'] !!}
    </div>

    --}}{{--audit plan form 2 (part-02)--}}{{--
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[18]['content'] !!}
        {!! $plans[19]['content'] !!}
        {!! $plans[20]['content'] !!}
    </div>

    --}}{{--audit plan form 2 (part-02)--}}{{--
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[21]['content'] !!}
        {!! $plans[22]['content'] !!}
    </div>

    --}}{{--audit plan form 2 (part-03)--}}{{--
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[23]['content'] !!}
    </div>

    --}}{{--audit plan form 2 (part-04)--}}{{--
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[24]['content'] !!}
    </div>

    --}}{{--audit plan form 2 (part-05)--}}{{--
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[25]['content'] !!}
    </div>

    --}}{{--audit plan form 2 (part-06)--}}{{--
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[26]['content'] !!}
    </div>

    --}}{{--audit risk assessment page--}}{{--
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[27]['content'] !!}
    </div>

    --}}{{--materiality calculate page--}}{{--
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[29]['content'] !!}
    </div>

    --}}{{--audit schedule page--}}{{--
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[30]['content'] !!}
    </div>

    --}}{{--audit other details page--}}{{--
    @if(array_key_exists(31, $plans))
        <div class="pdf-screen bangla-font" style="height: 100%">
            {!! $plans[31]['content'] !!}
        </div>
    @endif
</div>--}}

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

