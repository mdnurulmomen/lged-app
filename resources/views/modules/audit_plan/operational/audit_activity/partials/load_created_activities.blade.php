<ul id="tree2" class="tree" data-output-id="{{$output_id}}">
    <li>
        <ul>
            <li>
                <div class="d-flex align-item-center">
                    <div class="mr-5">Activities
                        {{--                        <button data-output-id="{{$output_id}}"--}}
                        {{--                                data-fiscal-year-id="{{$fiscal_year_id}}" data-outcome-id="{{$outcome_id}}"--}}
                        {{--                                data-activity-parent-id="0" type="button" class="btn--}}
                        {{--                                    btn-outline-secondary btn-icon btn_create_activity btn-square">--}}
                        {{--                            <i class="fas fa-plus"></i>--}}
                        {{--                        </button>--}}
                    </div>
                </div>
                {!! loadActivityTreeByOutput($activity_lists['data']) !!}
            </li>
        </ul>
    </li>
</ul>


<script>
    $('.btn_create_activity').on('click', function () {
        emptyModalData('op_activity_modal');
        outcome_id = $(this).data('outcome-id');
        fiscal_year_id = $(this).data('fiscal-year-id');
        output_id = $(this).data('output-id');

        if (!fiscal_year_id) {
            toastr.error('Please Choose Fiscal Year');
        } else if (!outcome_id) {
            toastr.error('Please Choose Outcome');
        } else if (!output_id) {
            toastr.error('Please Choose Output');
        } else {
            $('.fiscal_year_id').val(fiscal_year_id);
            $('.outcome_id').val(outcome_id);
            $('.output_id').val(output_id);
            $('.activity_parent_id').val($(this).data('activity-parent-id'));
            $('#op_activity_modal').modal('show');
        }
    });

    $('.btn_add_milestone').on('click', function () {
        emptyModalData('op_activity_milestone_modal');
        outcome_id = $(this).data('outcome-id');
        fiscal_year_id = $(this).data('fiscal-year-id');
        output_id = $(this).data('output-id');
        $('.fiscal_year_id').val(fiscal_year_id);
        $('.outcome_id').val(outcome_id);
        $('.output_id').val(output_id);
        $('.activity_id').val($(this).data('activity-id'));
        $('#op_activity_milestone_modal').modal('show');
    });
</script>
