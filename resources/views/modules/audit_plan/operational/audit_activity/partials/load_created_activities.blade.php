<ul id="tree2" class="tree" data-output-id="{{$output_id}}">
    <li>
        <ul>
            <li>
                <div class="d-flex align-item-center">
                    <div class="mr-5">Activities</div>
                </div>
                <ul>
                @foreach ($activity_lists['data']['data'] as $outcome)
                    <li>
                        <div class="d-flex align-item-center">
                            <div class="mr-5">{{ $outcome['outcome_no'] }}
                                @if ($outcome['plan_output'])
                                <ul>
                                @foreach ($outcome['plan_output'] as $output)
                                    <li>
                                        <div class="d-flex align-item-center">
                                            <div class="mr-5">{{ $output['output_no'] }} : {{ $output['output_title_en'] }}
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
                                                            <div class="mr-5">{{ $activity['activity_no'] }} : {{ $activity['title_en'] }}
                                                                <div class="btn-group mr-5" role="group" aria-label="First group">
                                                                    <button data-activity-parent-id="{{$activity['id']}}"
                                                                            data-outcome-id="{{$activity['outcome_id']}}"
                                                                            data-output-id="{{$activity['output_id'] }}"
                                                                            data-fiscal-year-id="{{ $activity['fiscal_year_id'] }}"
                                                                            type="button" class="btn
                                                                        btn-outline-secondary btn-icon btn_create_activity btn-square">
                                                                        <i class="fas fa-plus"></i>
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
