<ul>
    @foreach($childs as $child)
        <li>
            <div class="d-flex align-item-center">
                <div class="mr-5">{{ $child['activity_no'] }} - {{ $child['title_en'] }}</div>
                <div class="btn-group mr-5" role="group" aria-label="First group">
                    <a href="#table_{{$child['id']}}" class="btn btn-outline-primary btn-icon  btn-sqaure"><i
                            class="fas fa-eye"></i></a>
                </div>
            </div>
            @if(count($child['children']))
                @include('modules.audit_plan.operational.operational_plan.partials.manageChild',['childs' => $child['children']])
            @endif
        </li>
    @endforeach
</ul>