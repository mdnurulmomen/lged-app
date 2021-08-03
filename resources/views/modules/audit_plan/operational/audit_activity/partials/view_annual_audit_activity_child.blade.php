<ul>
    @foreach ($children as $child)
        <li>
            <div class="d-flex align-item-center">
                <div class="mr-5"><i
                        class="fad fa-bullseye-arrow text-success text-hover-warning mr-2"></i>{{ $child['activity_no'] }}
                    : {{ $child['title_en'] }}
                    {{--                    <div class="btn-group mr-5" role="group" aria-label="First group">--}}
                    {{--                        <button type="button"--}}
                    {{--                                data-fiscal-year-id="{{ $child['fiscal_year_id'] }}"--}}
                    {{--                                data-activity-id="{{ $child['id'] }}"--}}
                    {{--                                class="btn_add_milestone btn btn-outline-secondary btn-icon btn-square"><i--}}
                    {{--                                class="fas fa-flag-checkered"></i>--}}
                    {{--                        </button>--}}
                    {{--                    </div>--}}
                    @forelse($child['milestones'] as $milestones)
                        <ul>
                            <li>
                                <div class="d-flex align-item-center">
                                    <div class="mr-3"><i
                                            class="fad fa-flag text-info text-hover-primary mr-2"></i>{{ $milestones['title_en'] }}
                                    </div>
                                </div>
                            </li>
                        </ul>
                    @empty
                    @endforelse
                    @if(count($child['children']))
                        @include('modules.audit_plan.operational.audit_activity.partials.view_annual_audit_activity_child',['children' => $child['children']])
                    @endif
                </div>
            </div>
        </li>
    @endforeach
</ul>
