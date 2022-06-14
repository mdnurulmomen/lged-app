{{--<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-end mt-4">
            <button onclick="Preview_AIR_Container.generatePDF()"
                    title="Download"
                    class="btn btn-danger btn-sm btn-bold btn-square">
                <i class="far fa-file-pdf"></i> Download
            </button>
        </div>
    </div>
</div>--}}

<div id="writing-screen-wrapper" style="font-family:nikoshpdf,serif !important;">
    <div class="pdf-screen bangla-font" style="height: 100%">
        {!! $cover['content'] !!}
    </div>

    <div class="pdf-screen bangla-font" style="height: 100%">
        @foreach($airReports as $report)
            <div class="plan_content bangla-font">
                {!! $report['content'] !!}
            </div>
        @endforeach
    </div>
</div>

<script>
    var Preview_AIR_Container = {
        generatePDF: function () {
            air_id = $("#airId").val();
            air_description = templateArray;
            scope = 'generate';
            data = {scope,air_id,air_description};

            url = '{{route('audit.report.air.download')}}';

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
                    link.download = "qac1_report_"+new Date().toDateString().replace(/ /g,"_")+".pdf";
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

