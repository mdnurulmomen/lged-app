<div class="header-menu-wrapper header-menu-wrapper-left align-items-center" id="kt_header_menu_wrapper">
    <!--begin::Header Menu-->
    <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
        <!--begin::Header Nav-->
        <ul class="menu-nav">
            @if($modules != null)
                @foreach($modules as $module)
                    @if(!empty($module['module_childrens']))
                        <li class="menu-item">
                            <div class="dropdown">
                                <button
                                    class="btn dropdown-toggle  text-center fixed-width-dropdown"
                                    type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span>{{$module['title_en']}}</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach($module['module_childrens'] as $child)
                                        @php
                                            $url = $child['link'];
                                        @endphp
                                        <a class="dropdown-item"
                                           href="{{url("$url")}}">{{$child['title_en']}}</a>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                    @else
                        <li class="menu-item">
                            @php
                                $url = $module['link'];
                            @endphp
                            <a
                                href="{{url("$url")}}"
                                class="btn text-center"
                                type="button">
                                <span>{{$module['title_en']}}</span>
                            </a>
                        </li>

                    @endif
                @endforeach
            @endif
            <li class="menu-item">
                <div type="button" class="top-left-menus-icon" data-toggle="modal" data-target="#top-left-menus-modal">
                    <i class="fa fa-bars py-2" aria-hidden="true" data-placement="bottom" data-toggle="popover" data-content="Menu list"></i>
                </div>
            </li>
        </ul>
        <!--end::Header Nav-->
    </div>
    <!--end::Header Menu-->
</div>
