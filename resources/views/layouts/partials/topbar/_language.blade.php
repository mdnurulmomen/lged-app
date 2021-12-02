<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
    <div class="btn btn-clean btn-dropdown btn-lg mr-1 p-2">
        @if(app()->getLocale() == 'bn')
            <span class="navi-text">বাংলা</span>
        @else
            <span class="navi-text">ইংরেজি</span>
        @endif
    </div>
</div>
<div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
    <ul class="navi navi-hover py-4">
        <li class="navi-item active">
            <a href="{{url('locale/bn')}}" class="navi-link">
                <span class="navi-text">বাংলা</span>
            </a>
        </li>
        <li class="navi-item">
            <a href="{{url('locale/en')}}" class="navi-link">
                <span class="navi-text">ইংরেজি</span>
            </a>
        </li>
    </ul>
</div>
