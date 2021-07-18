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
         url="{{route('audit.plan.operational.calendar.responsible.create')}}" size="xl">
    <div class="row">
        <div class="col-md-7">
            <label for="select_responsible_office" class="form-label">Choose Responsible</label>
            <div class="form-group">
                <div class="checkbox-list">
                    @foreach($responsible_offices as $responsible_office)
                        <label class="checkbox"
                               id="responsible_office_{{$responsible_office['id']}}">
                            <input class="responsible_office_check"
                                   data-office_name="{{$responsible_office['office_name_en']}}"
                                   data-office-id="{{$responsible_office['office_id']}}"
                                   data-id="{{$responsible_office['id']}}" type="checkbox" name="responsible_office">
                            <span></span>{{$responsible_office['office_name_en']}}
                            ({{$responsible_office['short_name_en']}})
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <form autocomplete="off" id="audit_calendar_responsible_form">
                <div class="form-group">
                    <label>Selected Responsible</label>
                    <table id="checked_office_list">
                        <tbody></tbody>
                    </table>
                </div>
                <input type="hidden" name="activity_id" class="activity_id" value="">
            </form>
        </div>
    </div>
</x-modal>

<!-- audit_calendar_remarks_modal Modal-->
<x-modal id="audit_calendar_remarks_modal" title="Choose Responsible"
         url="{{route('audit.plan.operational.calendar.comment.update')}}" size="xl">
    <form autocomplete="off" id="audit_calendar_remarks_form">
        <div class="form-group">
            <div class="form-group row">
                <label for="comment_en" class="col-3 col-form-label">Comment English</label>
                <textarea class="col-9 form-control" placeholder="Comment English" type="text" value=""
                          id="comment_en" name="comment_en"></textarea>
            </div>
            <div class="form-group row">
                <label for="comment_bn" class="col-3 col-form-label">Comment Bangla</label>
                <textarea class="col-9 form-control" placeholder="Comment Bangla" type="text" value=""
                          id="comment_bn" name="comment_bn"></textarea>
            </div>
        </div>
        <input type="hidden" name="activity_id" class="activity_id" value="">
    </form>
</x-modal>

<script>
    $(document).ready(function () {
        fiscal_year_id = '{{$fiscal_year_id}}';
        $('#select_fiscal_year_schedule_milestone').val(fiscal_year_id).trigger('change')
    });

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

    $('.responsible_office_check').click(function () {
        var select_office = $(this).data('office_name');
        var select_responsible_office_id = $(this).data('id');

        if ($(this).prop("checked") === true) {
            $('#checked_office_list > tbody:last').append('' +
                '<tr id="row_office_id' + select_responsible_office_id + '">' +
                '<input type="hidden" name="selected_office_ids[]" value="' + select_responsible_office_id + '">' +
                '<td><i class="fas fa-building mr-2 text-primary" ></i>' + select_office + '</td>' +
                '</tr>' + '');
        } else if ($(this).prop("checked") === false) {
            $('#row_office_id' + select_responsible_office_id).remove();
        }
    });

    $('#btn_audit_calendar_responsible_modal_save').click(function () {
        offices = $('#checked_office_list').html()
        activity_id = $('#audit_calendar_responsible_form .activity_id').val()
        data = $('#audit_calendar_responsible_form').serialize();
        url = $(this).data('url');
        method = $(this).data('method');
        submit = submitModalData(url, data, method, 'audit_calendar_responsible_modal')
        $('#added_responsible_area_' + activity_id).html(offices);
    });

    $('#btn_audit_calendar_remarks_modal_save').click(function () {
        activity_id = $('#audit_calendar_remarks_form .activity_id').val()
        comment_en = $('#audit_calendar_remarks_form #comment_en').val()
        data = $('#audit_calendar_remarks_form').serialize();
        url = $(this).data('url');
        method = $(this).data('method');
        submitModalData(url, data, method, 'audit_calendar_remarks_modal')
        $('#added_comment_area_' + activity_id).html(comment_en);
    });

</script>

@include('scripts.script_generic')
