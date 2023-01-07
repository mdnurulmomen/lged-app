<div class="form-row">
    @foreach ($allMemos as $memo)
    <div class="col-sm-12 form-group">
        <h5 class="form-group text-center">
            Issue No. # {{ ucfirst($memo['onucched_no']) }}
        </h5>

        <h5 class="form-group">Issue: {{ ucfirst($memo['memo_title_bn']) }}</h5>
        <h5 class="form-group">Observation (Condition): {!! $memo['audit_observation'] !!} </h5>
        <h5 class="form-group">Criteria: {{ $memo['criteria'] }}</h5>
        <h5 class="form-group">
            Cause:
            @foreach(json_decode($memo['cause']) as $cause)
                {{ ucfirst($cause) . ", " }}
            @endforeach
        </h5>
        <h5 class="form-group">Consequence / Impact: {{ ucfirst($memo['impact']) }}</h5>
        <h5 class="form-group">Recommendations: {{ ucfirst($memo['recommendation']) }}</h5>
        <h5 class="form-group">Risk Level: {{ ucfirst($memo['risk_level']) }}</h5>
        <h5 class="form-group">Management response: {{ ucfirst($memo['m_response']) }}</h5>
        <h5 class="form-group">Auditor’s Comment: {{ ucfirst($memo['comment']) }}</h5>
        <h5 class="form-group">Action Taken: {{ ucfirst($memo['action_taken']) }}</h5>
        <h5 class="form-group">Responsible Person: {{ ucfirst($memo['responsible_person']) }}</h5>
        <h5 class="form-group">Date to be implemented: {{ ucfirst($memo['date_to_be_implemented']) }}</h5>
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
