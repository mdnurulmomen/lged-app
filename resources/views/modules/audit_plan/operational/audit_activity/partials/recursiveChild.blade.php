<ul>
    @foreach ($children as $child)
        <li>
            <div class="d-flex align-item-center">
                <div class="mr-5"><i
                        class="fad fa-bullseye-arrow text-success text-hover-warning mr-2"></i>{{ $child['activity_no'] }}
                    : {{ $child['title_en'] }}
                    <div class="btn-group mr-5" role="group" aria-label="First group">
                        <button data-activity-parent-id="{{$child['id']}}"
                                data-outcome-id="{{$child['outcome_id']}}"
                                data-output-id="{{$child['output_id'] }}"
                                data-fiscal-year-id="{{ $child['fiscal_year_id'] }}"
                                type="button" class="btn
                        btn-outline-secondary btn-icon btn_create_activity btn-square">
                            <i class="fas fa-plus"></i>
                        </button>

                        <button data-activity-parent-id="{{$child['id']}}"
                                data-activity-id="{{ $child['id'] }}"
                                data-outcome-id="{{$child['outcome_id']}}"
                                data-output-id="{{$child['output_id'] }}"
                                data-fiscal-year-id="{{ $child['fiscal_year_id'] }}"
                                type="button" class="btn
                        btn-outline-secondary btn-icon btn_edit_activity btn-square">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button"
                                data-outcome-id="{{ $child['outcome_id'] }}"
                                data-output-id="{{ $child['output_id'] }}"
                                data-fiscal-year-id="{{ $child['fiscal_year_id'] }}"
                                data-activity-id="{{ $child['id'] }}"
                                class="btn_add_milestone btn btn-outline-secondary btn-icon btn-square"><i
                                class="fas fa-flag-checkered"></i>
                        </button>
                    </div>
                    @if(count($child['children']))
                        @include('modules.audit_plan.operational.audit_activity.partials.recursiveChild',['children' => $child['children']])
                    @endif
                </div>
            </div>
        </li>
    @endforeach
</ul>
