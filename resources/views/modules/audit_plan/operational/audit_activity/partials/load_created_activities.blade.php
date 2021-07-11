<ul id="tree2" class="tree" data-output-id="{{$output_id}}">
    <li>
        <ul>
            <li>
                <div class="d-flex align-item-center">
                    <div class="mr-5">Activities
                        <button data-output-id="{{$output_id}}"
                                data-fiscal-year-id="" data-outcome-id="{{$outcome_id}}"
                                data-activity-parent-id="0" type="button" class="btn
                                    btn-outline-secondary btn-icon btn_create_activity btn-square">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                {!! loadActivityTreeByOutput($activity_lists['data']) !!}
            </li>
        </ul>
    </li>
</ul>


<script>
    $('.btn_create_activity').on('click', function () {
        outcome_id = $('#select_strategic_outcome').val();
        fiscal_year_id = $('#select_fiscal_year').val();
        output_id = $('#select_strategic_output').val();

        if (!fiscal_year_id) {
            toastr.error('Please Choose Fiscal Year Id');
        } else {
            $('#activity_parent_id').val($(this).data('activity-parent-id'));
            $('#op_activity_modal').modal('show');
        }
    });
</script>
