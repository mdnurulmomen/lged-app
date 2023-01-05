<div class="form-row">
    @foreach ($allMemos as $memo)
    <div class="col-sm-12 form-group">
        <h5 class="text-center">
            Issue No. # {{ $memo['onucched_no'] }}
        </h5>

        <h5>Issue: {{ $memo['memo_title_bn'] }}</h5>
        <h5>Observation (Condition):  {{ $memo['memo_title_bn'] }}</h5>
        <h5>Criteria: </h5>
        <h5>Cause:</h5>
        <h5>Consequence / Impact:</h5>
        <h5>Recommendations:</h5>
        <h5>Risk Level: </h5>
        <h5>Management response:</h5>
        <h5>Auditor’s Comment:</h5>
        <h5>Action Taken: </h5>
        <h5>Responsible Person: </h5>
        <h5>Date to be implemented:</h5>
    </div>
    @endforeach

    <div class="col-sm-12 form-group text-right">
        <button 
            type="button" 
            class="btn btn-download btn-sm btn-bold btn-square ml-auto main-body-document">
            Download
        </button>
    </div>
</div>

<script>
    $('.main-body-document').click(function () {
        let audit_plan_id = "{{ $audit_plan_id }}";
        
        let data = {audit_plan_id};

        let url = "{{ route('audit.plan.main-body-document.download') }}";

        KTApp.block('#kt_wrapper', {
            opacity: 0.1,
            message: 'ডাউনলোড হচ্ছে অপেক্ষা করুন...',
            state: 'primary' // a bootstrap color
        });

        $.ajax({
            type: 'get',
            url: url,
            data: data,
            xhrFields: {
                responseType: 'blob'
            },
            success: function (response) {
                KTApp.unblock('#kt_wrapper');
                var blob = new Blob([response]);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "main-body-doc-report.pdf";
                link.click();
            },
            error: function (blob) {
                toastr.error('Failed to generate PDF.')
                console.log(blob);
            }
        });
        
    });
</script>
