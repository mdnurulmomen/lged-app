<x-title-wrapper>মন্ত্রণালয় ভিত্তিক অনিষ্পন্ন আপত্তি</x-title-wrapper>
<div class="card sna-card-border mt-3" style="margin-bottom:15px;">
    <div class="row">
        <div class="col-md-3">
            <select class="form-select select-select2" id="directorate_filter">
                @if(count($directorates) > 1)
                    <option value="">অধিদপ্তর বাছাই করুন</option>
                @endif
                @foreach($directorates as $directorate)
                    <option value="{{$directorate['office_id']}}">{{$directorate['office_name_bn']}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>


<div class="card sna-card-border load-directorate-wise-ministry mb-15"></div>

<script>
    $(function () {
        load_Directorate_Wise_Ministry_Report_Container.loadDirectoratewiseMinistryReport();
    });

    $('#directorate_filter').change(function () {
        load_Directorate_Wise_Ministry_Report_Container.loadDirectoratewiseMinistryReport();
    });

    var load_Directorate_Wise_Ministry_Report_Container = {
        loadDirectoratewiseMinistryReport: function () {

            let office_id = $('#directorate_filter').val();

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            let url = '{{route('audit.report.observations.get-directorate-wise-ministry-total-observation')}}';
            let data = {office_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('.load-directorate-wise-ministry').html(response);
                }
            });
        },
        loadDirectoratewiseMinistryReportExport: function () {

            let office_id = $('#directorate_filter').val();

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            let url = '{{route('audit.report.observations.get-directorate-wise-ministry-total-observation-export')}}';
            let data = {office_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('.load-directorate-wise-ministry').html(response);
                }
            });
        },

    }
</script>

