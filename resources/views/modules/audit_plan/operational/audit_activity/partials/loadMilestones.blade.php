<ul>
    @foreach ($milestones as $milestone)
        <li>
            <div class="d-flex align-item-center">
                <div class="mr-5"><i
                    class="fas fa-flag-checkered text-danger text-hover-warning mr-2"></i>{{ $milestone['title_en'] }}
                    <div class="btn-group mr-5" role="group" aria-label="First group">
                        <button data-milestone-id="{{ $milestone['id'] }}"
                                data-activity-id="{{$milestone['activity_id']}}"
                                data-outcome-id="{{$milestone['outcome_id']}}"
                                data-output-id="{{$milestone['output_id'] }}"
                                data-fiscal-year-id="{{ $milestone['fiscal_year_id'] }}"
                                type="button" class="btn
                        btn-outline-secondary btn-icon btn_edit_activity_milestone btn-square">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>
                    @if($children)
                        @include('modules.audit_plan.operational.audit_activity.partials.recursiveChild',['children' => $children])
                    @endif
                </div>
            </div>
        </li>
    @endforeach
</ul>
