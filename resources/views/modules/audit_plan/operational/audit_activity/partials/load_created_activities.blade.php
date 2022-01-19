<ul id="tree2" class="tree" data-output-id="{{$output_id}}">
    <li>
        <ul>
            <li>
                <div class="d-flex align-item-center">
                    <div class="mr-5"><i class="fad fa-books fa-2x text-primary text-hover-success"></i></div>
                </div>
                <ul>
                    @foreach ($activity_lists['data']['data'] as $outcome)
                        <li>
                            <div class="d-flex align-item-center">
                                <div class="mr-5"><i
                                        class="fad fa-book-spells text-primary text-hover-warning"></i>{{ $outcome['outcome_no'] }}
                                    @if ($outcome['plan_output'])
                                        <ul>
                                            @foreach ($outcome['plan_output'] as $output)
                                                <li>
                                                    <div class="d-flex align-item-center">
                                                        <div class="mr-5"><i
                                                                class="fad fa-book-open text-danger text-hover-success mr-2"></i>{{ $output['output_no'] }}
                                                            : {{ $output['output_title_en'] }}
                                                            <button data-output-id="{{ $output['id'] }}"
                                                                    data-fiscal-year-id="{{$activity_lists['data']['fiscal_year_id']}}"
                                                                    data-outcome-id="{{$outcome['id']}}"
                                                                    data-activity-parent-id="0" type="button" class="btn
                                                        btn-outline-secondary btn-icon btn_create_activity btn-square">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                            @if ($output['activities'])
                                                                <ul>
                                                                    @foreach ($output['activities'] as $activity)
                                                                        <li>
                                                                            <div class="d-flex align-item-center">
                                                                                <div class="mr-5"><i
                                                                                        class="fad fa-bullseye-arrow text-success text-hover-warning mr-2"></i>{{ $activity['activity_no'] }}
                                                                                    : {{ $activity['title_en'] }}
                                                                                    <div class="btn-group mr-5"
                                                                                         role="group"
                                                                                         aria-label="First group">
                                                                                        <button
                                                                                            data-activity-parent-id="{{$activity['id']}}"
                                                                                            data-outcome-id="{{$activity['outcome_id']}}"
                                                                                            data-output-id="{{$activity['output_id'] }}"
                                                                                            data-fiscal-year-id="{{ $activity['fiscal_year_id'] }}"
                                                                                            type="button" class="btn
                                                                        btn-outline-secondary btn-icon btn_create_activity btn-square">
                                                                                            <i class="fas fa-plus"></i>
                                                                                        </button>
                                                                                        <button
                                                                                            data-activity-parent-id="{{$activity['id']}}"
                                                                                            data-activity-id="{{ $activity['id'] }}"
                                                                                            data-outcome-id="{{$activity['outcome_id']}}"
                                                                                            data-output-id="{{$activity['output_id'] }}"
                                                                                            data-fiscal-year-id="{{ $activity['fiscal_year_id'] }}"
                                                                                            type="button" class="btn
                                                                        btn-outline-secondary btn-icon btn_edit_activity btn-square">
                                                                                            <i class="fas fa-edit"></i>
                                                                                        </button>

                                                                                        <button type="button"
                                                                            data-outcome-id="{{ $activity['outcome_id'] }}"
                                                                            data-output-id="{{ $activity['output_id'] }}"
                                                                            data-fiscal-year-id="{{ $activity['fiscal_year_id'] }}"
                                                                            data-activity-id="{{ $activity['id'] }}"
                                                                            class="btn_add_milestone btn btn-outline-secondary btn-icon btn-square"><i
                                                                            class="fas fa-flag-checkered"></i></button>
                                                                </div>
                                                                @if(!empty($activity['children']))
                                                                    @include('modules.audit_plan.operational.audit_activity.partials.recursiveChild',['children' => $activity['children']])
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                            @endforeach
                                </ul>
                                @endif
                            </div>
                        </div>
                    </li>
                @endforeach
                </ul>
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

    $('.btn_edit_activity').on('click', function () {
        emptyModalData('op_activity_edit_modal');
        outcome_id = $(this).data('outcome-id');
        fiscal_year_id = $(this).data('fiscal-year-id');
        output_id = $(this).data('output-id');
        activity_id = $(this).data('activity-id');

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
            $('.activity_id').val(activity_id);
            $('#op_activity_edit_modal').modal('show');

            if(activity_id){
                url = '{{route('audit.plan.operational.activity.edit.output.load')}}';

                data = {activity_id, outcome_id, fiscal_year_id, output_id}
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    $('.edit_activity_area').html(response)
                })
            }


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
