<div class="form-group" id="strategic_output_area">
    <label for="select_strategic_output" class="col-form-label">Strategic Output</label>
    <select name="strategic_output" id="select_strategic_output" class="form-control rounded-0 select-select2">
        <option value="">Select Output</option>
        @foreach($outputs as $output)
            <option value="{{$output['id']}}"
                    data-output-no="{{$output['output_no']}}">{{$output['output_no']}}</option>
        @endforeach
    </select>
</div>
<div class="mt-3">
    @foreach($outputs as $output)
        <p id="output_remarks_area_{{$output['id']}}" class="d-none">{{$output['remarks']}}</p>
    @endforeach
</div>


<script>
    $('#select_strategic_output').on('change', function () {
        outcome_id = $('#select_strategic_outcome').val();
        output_id = $(this).val();

        $("[id^=output_remarks_area_]").addClass('d-none')
        $(`#output_remarks_area_${output_id}`).removeClass('d-none')
    })
</script>
