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
    
    <br>
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $auditSchedule['content'] !!}
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

