<x-modal id="create_audit_calendar_modal" title="Create Annual Audit Calendar" size='lg'
         url="{{route('audit.plan.operational.calendars.store')}}">

    <form autocomplete="off" id="create_audit_calendar_form">
        <div class="form-group row">
            <div class="col-3">
                <label for="fiscal_year_select">Choose Fiscal Year</label>
            </div>
            <div class="col-9">
                <select name="fiscal_year_id" id="fiscal_year_select" class="select-select2">
                    @foreach($years as $year)
                        <option value="{{$year['fiscal_year_id']}}">{{$year['description']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

</x-modal>

<script>
    $('#btn_create_audit_calendar_modal_save').click(function () {
        OP_Audit_Calendar_Container.storeAnnualCalendar($(this));
    });
</script>
