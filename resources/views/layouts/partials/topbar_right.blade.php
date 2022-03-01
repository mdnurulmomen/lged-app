<div class="topbar">
    <div class="topbar-item ">
        <div class="top-left-menus-icon py-2" data-toggle="modal" data-target="#top-right-menus-modal">
            <i class="fa fa-th py-2" aria-hidden="true" data-placement="bottom" data-toggle="popover"
                data-content="Site list"></i>
        </div>

    </div>
    <div class="topbar-item">
        <button id="voice2text" type="button" role="button" class="py-2 fr-command fr-btn" data-cmd="voice2text"
            data-toggle="popover" data-content="স্পিচ টু টেক্সট" data-placement="bottom" data-original-title=""
            title=""><i class="fa startListening fa-microphone-slash" aria-hidden="true" style=""></i></button>
    </div>
    <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px" aria-expanded="true">
        <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
            <img class="h-20px w-20px"
            src="{{ asset('assets/images/bd_flag.png') }}" alt="">
        </div>
    </div>

    <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
        <!--begin::Nav-->
        <ul class="navi navi-hover py-4">
            <!--begin::Item-->
            <li class="navi-item">
                <a href="#" class="navi-link">
                    <span class="symbol symbol-20 mr-3">
                        <img src="{{ asset('assets/images/bd_flag.png') }}" alt="">
                    </span>
                    <span class="navi-text">Bangla</span>
                </a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="navi-item active">
                <a href="#" class="navi-link">
                    <span class="symbol symbol-20 mr-3">
                        <img src="{{ asset('assets/images/usa_flag.png') }}" alt="">
                    </span>
                    <span class="navi-text">English</span>
                </a>
            </li>
            <!--end::Item-->
       
          
          
        </ul>
        <!--end::Nav-->
    </div>






    <div class="topbar-item">
        <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
            id="kt_quick_user_toggle">

            <div class="top-right-username" >
                    <div class="profile-name" >Abul Kalam Azad</div>
                    <div class="profile-designation">Assistant director</div>
            </div>

            <!-- <span class="top-right-username">Abul Kalam Azad</span> -->

            <span class="symbol symbol-lg-35 symbol-25">
                <img src="{{ asset('assets/images/pp.png') }}" alt="">
            </span>
           
            
           
        </div>
    </div>







    
</div>
