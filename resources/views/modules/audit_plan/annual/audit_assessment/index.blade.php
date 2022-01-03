<x-title-wrapper>Auditability Assessment</x-title-wrapper>

<div class="row mt-3 px-3">
    <div class="col-md-12">
        <select class="form-control select-select2" id="fiscal_year_id">
            <option value="">--সিলেক্ট--</option>
            @foreach($fiscal_years as $fiscal_year)
                <option
                    value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['start']?'selected':''}}>{{$fiscal_year['description']}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="px-3 pt-4" id="load_assessment_list"></div>


<script>
    $(function () {
        let fiscal_year_id = $("#fiscal_year_id").val();
        Assessment_Score_Container.list(fiscal_year_id);
    });

    $("#fiscal_year_id").change(function () {
        let fiscal_year_id = this.value;
        Assessment_Score_Container.list(fiscal_year_id);
    });

    var Assessment_Score_Container = {
        list: function (fiscal_year_id) {
            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            url = '{{route('audit.plan.annual.audit-assessment.list')}}';
            data = {fiscal_year_id};
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.warning(response.data)
                } else {
                    $('#load_assessment_list').html(response);
                }
            })
        }
    }
</script>
