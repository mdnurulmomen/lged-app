<div class="row">
    <div class="col-sm-12">
        <h5>SUMMARY OF AUDIT FINDINGS WITH RECOMMENDATION</h5>
    </div>

    <div class="col-sm-12 form-group">
        <table class="table table-bordered" width="100%">
            <thead>
                <tr style="background-color: #FAD02C">
                    <th>Fin. #</th>
                    <th>Issue</th>
                    <th>Recommendations</th>
                    <th>Risk Rating</th>
                </tr>
            </thead>
        
            <tbody>
                @foreach ($allMemos as $memo)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $memo['memo_title_bn'] }}</td>
                    <td>{{ $memo['recommendation'] }}</td>
                    <td>{{ $memo['risk_level'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-sm-12 form-group text-right">
        <button 
            type="button" 
            class="btn btn-download btn-sm btn-bold btn-square ml-auto summery_download">
            Download
        </button>
    </div>
</div>

<script>
    $('.summery_download').click(function () {
        let audit_plan_id = "{{ $audit_plan_id }}";
        
        let data = {audit_plan_id};

        let url = "{{ route('audit.plan.summery-reports.download') }}";

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
                link.download = "sumery-report.pdf";
                link.click();
            },
            error: function (blob) {
                toastr.error('Failed to generate PDF.')
                console.log(blob);
            }
        });
        
    });
</script>
