<ul id="tree2" class="tree">
    @foreach($tree as $key => $activitiy)
        <li>
            <div class="d-flex align-item-center">
                <div class="mr-5">{{ $activitiy['activity_no'] }} - {{ $activitiy['title_en'] }}</div>
                @if(!count($activitiy['children']))
                <div class="btn-group mr-5" role="group" aria-label="First group">
                    <a href="#table_{{$activitiy['id']}}" class="btn btn-outline-primary btn-icon  btn-sqaure"><i
                            class="fas fa-eye"></i></a>
                </div>
                @endif
            </div>
            @if(count($activitiy['children']))
                @include('modules.audit_plan.operational.operational_plan.partials.manageChild',
                ['childs' => $activitiy['children']])
            @endif
        </li>
    @endforeach
</ul>

{{-- <ul id="tree2" class="tree">
    @foreach ($tree as $key => $activitiy)
    <li>
        <ul> 
            <li>
                <div class="d-flex align-item-center">
                    <div class="mr-5">{{ $key+1 }}</div>
                </div>
                <ul>
                    <li>
                        <div class="d-flex align-item-center">
                            <div class="mr-5">{{ $activitiy['title_en'] }}</div>
                            <div class="btn-group mr-5" role="group" aria-label="First group">
                                <a href="#table1_1" class="btn btn-outline-primary btn-icon  btn-sqaure"><i
                                        class="fas fa-eye"></i></a>
                            </div>
                        </div>
                    </li>
                    @if(count($activitiy['children']))
                    <li>
                        <div class="d-flex align-item-center">
                            <div class="mr-5">{{ $activitiy['activity_no'] }}</div>
                        </div>
                        @foreach ($activitiy['children'] as $children)
                        <ul>
                            <li>
                                <div class="d-flex align-item-center">
                                    <div class="mr-5">{{ $children['title_en'] }}</div>
                                    <div class="btn-group mr-5" role="group" aria-label="First group">
                                        <a href="#table_1_2_1" class="btn btn-outline-primary btn-icon  btn-sqaure"><i
                                                class="fas fa-eye"></i></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        @endforeach
                    </li>
                    @endif
                </ul>
            </li>
        </ul>
    </li>
    @endforeach
</ul> --}}