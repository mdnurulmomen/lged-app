<div class="topbar">
    <div class="topbar-item ">
        {{--        <div class="top-left-menus-icon py-2" data-toggle="modal" data-target="#top-right-menus-modal">--}}
        {{--            <i class="fa fa-th py-2" aria-hidden="true" data-placement="bottom" data-toggle="popover"--}}
        {{--               data-content="Site list"></i>--}}
        {{--        </div>--}}
        {!! $wizardData !!}
    </div>
    <div class="topbar-item">
        <button id="voice2text" type="button" role="button" class="py-2 fr-command fr-btn bg-transparent border-0" data-cmd="voice2text"
                data-toggle="popover" data-content="স্পিচ টু টেক্সট" data-placement="bottom" data-original-title=""
                title=""><i class="fa startListening fa-microphone-slash" aria-hidden="true" style=""></i></button>
    </div>
    <div class="topbar-item">
        <button id="task_manager_btn" type="button" role="button" class="py-2 bg-transparent border-0" data-toggle="popover" data-content="{{___('generic.task_manager')}}" data-placement="bottom" data-original-title="" title="">
            <i class="fa fa-tasks" aria-hidden="true" style=""></i>
        </button>
    </div>

    {{--    <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px" aria-expanded="true">--}}
    {{--        <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">--}}
    {{--            <img class="h-20px w-20px" src="{{ asset('assets/images/bd_flag.png') }}" alt="">--}}
    {{--        </div>--}}
    {{--    </div>--}}

    <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
        <!--begin::Nav-->
        <ul class="navi navi-hover py-4">
            <!--begin::Item-->
            <li class="navi-item">
                <a href="#" class="navi-link">
                    <span class="navi-text">Bangla</span>
                </a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="navi-item active">
                <a href="#" class="navi-link">
                    <span class="navi-text">English</span>
                </a>
            </li>
            <!--end::Item-->


        </ul>
        <!--end::Nav-->
    </div>

    <div class="dropdown">
        @include('layouts.partials.topbar._profile')
    </div>
</div>
