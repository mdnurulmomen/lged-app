{{-- @if($scope_editable == 0) {{--&& $current_office_id != 1 && $approval_status != 'approved'--}}

{{-- @endif --}}
{{-- <div class="row mb-3">
    <div class="col-md-12">
        <div class="d-flex justify-content-end">
            <button onclick="Audit_Plan_Container.loadAuditPlanBookEditable($(this))"
                title="প্ল্যান-{{enTobn($psr_plan_id)}} বিস্তারিত দেখুন"
                data-audit-plan-id="{{$psr_plan_id}}"

                class="btn btn-primary btn-sm btn-bold btn-square">
                <i class="fad fa-edit text-dark-100 mr-2"></i> হালনাগাদ করুন
            </button>
        </div>
    </div>
</div> --}}

<iframe src="{{asset('public/psrs/'.$fileName)}}" width="100%" height="100%"></iframe>

<div id="writing-screen-wrapper" style="font-family:nikoshpdf,serif !important;">
  cover page
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[0]['content'] !!}
    </div>

   index page
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[1]['content'] !!}
    </div>

   strategic form part 01
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[3]['content'] !!}
    </div>

   strategic form part 02
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[4]['content'] !!}
    </div>

   strategic form part 03
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[5]['content'] !!}
    </div>

   audit plan form 1 (part-01)
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $plans[6]['content'] !!}
        {!! $plans[7]['content'] !!}
        {!! $plans[8]['content'] !!}
        {!! $plans[9]['content'] !!}
        {!! $plans[10]['content'] !!}
    </div>
</div>

<script>
    var Preview_Audit_Plan_Container = {
        generatePDF: function () {
            plan = templateArray;
            scope = 'generate';
            data = {plan,scope};

            url = '{{route('audit.plan.annual.psr.psrview')}}';

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

