@props(['icon' => '', 'name' =>'', 'count' => ''])
<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
    <a href="javascript:;" class="menu-link menu-toggle">
        <i class="{{$icon}} menu-icon">
            <span></span>
        </i>
        <span class="menu-text">{{$name}}</span>
        @if($count)
            <span class="menu-label">
                <span class="label label-rounded label-primary">{{$count}}</span>
            </span>
        @endif
        <i class="menu-arrow"></i>
    </a>
    <div class="menu-submenu">
        <i class="menu-arrow"></i>
        <ul class="menu-subnav">
            {{$slot}}
        </ul>
    </div>
</li>
