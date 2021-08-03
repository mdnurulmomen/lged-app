<x-title-wrapper-return area="#kt_content" title="Back To Lists"
                        url="{{route('audit.plan.operational.activity.all')}}">
    View Annual Audit Activities
</x-title-wrapper-return>


<ul id="tree2" class="tree mt-4">
    <li>
        <div class="d-flex align-item-center">
            <div class="mr-5"><i class="fad fa-books fa-2x text-primary text-hover-success"></i></div>
        </div>
        <ul>
            <li>
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
                                                            @if ($output['activities'])
                                                                <ul>
                                                                    @foreach ($output['activities'] as $activity)
                                                                        <li>
                                                                            <div class="d-flex align-item-center">
                                                                                <div
                                                                                    class="mr-5"><i
                                                                                        class="fad fa-bullseye-arrow text-success text-hover-warning mr-2"></i>{{ $activity['activity_no'] }}
                                                                                    : {{ $activity['title_en'] }}
                                                                                    {{--                                                                                    <div class="btn-group mr-5"--}}
                                                                                    {{--                                                                                         role="group"--}}
                                                                                    {{--                                                                                         aria-label="First group">--}}
                                                                                    {{--                                                                                        <button type="button"--}}
                                                                                    {{--                                                                                                data-fiscal-year-id="{{ $activity['fiscal_year_id'] }}"--}}
                                                                                    {{--                                                                                                data-activity-id="{{ $activity['id'] }}"--}}
                                                                                    {{--                                                                                                class="btn_add_milestone btn btn-outline-secondary btn-icon btn-square">--}}
                                                                                    {{--                                                                                            <i--}}
                                                                                    {{--                                                                                                class="fas fa-flag-checkered"></i>--}}
                                                                                    {{--                                                                                        </button>--}}
                                                                                    {{--                                                                                    </div>--}}
                                                                                    @forelse($activity['milestones'] as $milestones)
                                                                                        <ul>
                                                                                            <li>
                                                                                                <div
                                                                                                    class="d-flex align-item-center">
                                                                                                    <div class="mr-3"><i
                                                                                                            class="fad fa-flag text-info text-hover-primary mr-2"></i>{{ $milestones['title_en'] }}
                                                                                                    </div>
                                                                                                </div>
                                                                                            </li>
                                                                                        </ul>
                                                                                    @empty
                                                                                    @endforelse
                                                                                    @if(!empty($activity['children']))
                                                                                        @include('modules.audit_plan.operational.audit_activity.partials.view_annual_audit_activity_child',['children' => $activity['children']])
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
<div id="show_activity_milestone_area">

</div>
@include('scripts.script_audit_plan_operational_activity')
