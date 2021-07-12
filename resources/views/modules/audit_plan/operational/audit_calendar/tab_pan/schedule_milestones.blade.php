<form>
    <div class="form-row">
        <div class="col-md-2 d-md-flex align-items-md-center">
            <p class="mb-0">Fiscal Year</p>
        </div>
        <div class="col-md-4 ">
            <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_schedule_milestone">
                <option value="">Choose Fiscal Year</option>
                @foreach($fiscal_years as $fiscal_year)
                    <option value="{{$fiscal_year['id']}}">{{$fiscal_year['description']}}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>

<div class="row mt-5" id="load_schedule_milestones">

</div>

<!-- audit_calendar_responsible_modal Modal-->
<x-modal id="audit_calendar_responsible_modal" title="Choose Responsible"
         url="{{route('settings.strategic-plan.outcome.store')}}" size="xl">
    <div class="row">
        <div class="col-md-7">
            <label for="select_responsible_office" class="form-label">Choose Responsible</label>
            <div class="form-group">
                <div class="checkbox-list">
                    @foreach($responsible_offices as $responsible_office)
                        <label class="checkbox responsible_office_check"
                               id="responsible_office_{{$responsible_office['id']}}">
                            <input type="checkbox" name="Checkboxes1">
                            <span></span>{{$responsible_office['office_name_en']}}
                            ({{$responsible_office['short_name_en']}})
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <form id="audit_calendar_responsible_form">
                <div class="form-group">
                    <label>Selected Responsible</label>
                    <div class="checkbox-list">

                    </div>
                </div>

                <input type="hidden" name="activity_id" class="activity_id" value="">
            </form>
        </div>
    </div>
</x-modal>

<script>
    $('#select_fiscal_year_schedule_milestone').change(function () {
        let fiscal_year_id = $('#select_fiscal_year_schedule_milestone').val();
        if (fiscal_year_id) {
            let url = '{{route('audit.plan.operational.calendar.milestone.load')}}';
            let data = {fiscal_year_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#load_schedule_milestones').html(response);
                }
            });
        } else {
            $('#load_schedule_milestones').html('');
        }
    });
</script>

@include('scripts.script_generic')
