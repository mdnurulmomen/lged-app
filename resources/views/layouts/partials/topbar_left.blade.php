<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
    <!--begin::Header Menu-->
    <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
        <!--begin::Header Nav-->
        <ul class="menu-nav">
            <li class="menu-item">
                <div class="dropdown">
                    <button
                        class="btn btn-outline-primary btn-square dropdown-toggle btn-sm width-120p text-left fixed-width-dropdown"
                        type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fad fa-ballot-check"></i> <span>Plan</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{route('audit.plan.strategy.index')}}">Strategic Plan</a>
                        <a class="dropdown-item" href="{{route('audit.plan.operational.index')}}">Operational Plan</a>
                        <a class="dropdown-item" href="{{route('audit.plan.annual.index')}}">Annual plan</a>
                        <a class="dropdown-item" href="{{route('audit.plan.audit.index')}}">Audit plan</a>
                    </div>
                </div>
            </li>
            <li class="menu-item">
                <a
                    href="{{route('audit.execution.query')}}"
                    class="btn btn-outline-danger btn-square btn-sm width-160p text-left"
                    type="button">
                    <i class="fal fa-network-wired"></i><span>Conducting</span>
                </a>

{{--                <button--}}
{{--                    class="btn btn-outline-danger btn-square dropdown-toggle btn-sm width-160p text-left fixed-width-dropdown"--}}
{{--                    type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                    <i class="fal fa-network-wired"></i><span>Conducting</span>--}}
{{--                </button>--}}
{{--                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
{{--                    <a class="dropdown-item" href="{{route('audit.execution.area')}}">Team Calendar</a>--}}
{{--                    <a class="dropdown-item" href="{{route('audit.execution.area')}}">Audit Area</a>--}}
{{--                    <a class="dropdown-item" href="{{route('audit.execution.query')}}">Audit Query</a>--}}
{{--                    <a class="dropdown-item" href="{{route('audit.execution.discussion')}}">Audit Discussion</a>--}}
{{--                    <a class="dropdown-item" href="{{route('audit.execution.review')}}">Review</a>--}}
{{--                </div>--}}
            </li>
            <li class="menu-item">
                <button
                    class="btn btn-outline-success btn-square dropdown-toggle btn-sm width-120p text-left fixed-width-dropdown"
                    type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-line-columns"></i><span>Prepare</span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{route('audit.preparation.sampling')}}">Sampling</a>
                    <a class="dropdown-item" href="{{route('audit.preparation.data_analysis')}}">Data Analysis</a>
                    <a class="dropdown-item" href="{{route('audit.preparation.activities')}}">Activities</a>
                </div>
            </li>
            <li class="menu-item">
                <button
                    class="btn btn-outline-warning btn-square dropdown-toggle btn-sm width-120p text-left fixed-width-dropdown"
                    type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fal fa-file-chart-line"></i><span>Report</span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{route('audit.report.draft_report')}}">Draft Report</a>
                    <a class="dropdown-item" href="{{route('audit.report.final_report')}}">Final Report</a>
                    <a class="dropdown-item" href="{{route('audit.report.qc')}}">QC</a>
                </div>
            </li>
            <li class="menu-item">
                <button
                    class="btn btn-outline-info btn-square dropdown-toggle btn-sm width-120p text-left fixed-width-dropdown"
                    type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fab fa-watchman-monitoring"></i><span>Follow-Up</span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{route('audit.followup.due_report')}}">Due Report</a>
                    <a class="dropdown-item" href="{{route('audit.followup.observation')}}">Observation</a>
                    <a class="dropdown-item" href="{{route('audit.followup.reminder')}}">Reminder</a>
                    <a class="dropdown-item" href="{{route('audit.followup.record')}}">Record</a>
                    <a class="dropdown-item" href="{{route('audit.followup.settlement_review')}}">Settlement Review</a>
                </div>
            </li>
        </ul>
        <!--end::Header Nav-->
        <div class="topbar d-none d-lg-flex">
            <!--begin::Quick Actions-->
            <div class="dropdown">
                <!--begin::Toggle-->
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="btn btn-icon btn-outline-dark btn-dropdown btn-sm btn-square ml-1">
                        <span class="svg-icon svg-icon-xl svg-icon-primary">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                 version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"/>
                                    <path
                                        d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                        fill="#000000" opacity="0.3"/>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </div>
                </div>
                <!--end::Toggle-->
                <!--begin::Dropdown-->
                <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                    <!--begin:Nav-->
                    <div class="row row-paddingless">
                        <!--begin:Item-->
                        <div class="col-4">
                            <a href="{{route('grievance_management')}}"
                               class="d-block py-10 px-5 text-center bg-hover-light border-right border-bottom">
                                <span class="svg-icon svg-icon-3x svg-icon-success">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Euro.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                         viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path
                                                d="M4.3618034,10.2763932 L4.8618034,9.2763932 C4.94649941,9.10700119 5.11963097,9 5.30901699,9 L15.190983,9 C15.4671254,9 15.690983,9.22385763 15.690983,9.5 C15.690983,9.57762255 15.6729105,9.65417908 15.6381966,9.7236068 L15.1381966,10.7236068 C15.0535006,10.8929988 14.880369,11 14.690983,11 L4.80901699,11 C4.53287462,11 4.30901699,10.7761424 4.30901699,10.5 C4.30901699,10.4223775 4.32708954,10.3458209 4.3618034,10.2763932 Z M14.6381966,13.7236068 L14.1381966,14.7236068 C14.0535006,14.8929988 13.880369,15 13.690983,15 L4.80901699,15 C4.53287462,15 4.30901699,14.7761424 4.30901699,14.5 C4.30901699,14.4223775 4.32708954,14.3458209 4.3618034,14.2763932 L4.8618034,13.2763932 C4.94649941,13.1070012 5.11963097,13 5.30901699,13 L14.190983,13 C14.4671254,13 14.690983,13.2238576 14.690983,13.5 C14.690983,13.5776225 14.6729105,13.6541791 14.6381966,13.7236068 Z"
                                                fill="#000000" opacity="0.3"/>
                                            <path
                                                d="M17.369,7.618 C16.976998,7.08599734 16.4660031,6.69750122 15.836,6.4525 C15.2059968,6.20749878 14.590003,6.085 13.988,6.085 C13.2179962,6.085 12.5180032,6.2249986 11.888,6.505 C11.2579969,6.7850014 10.7155023,7.16999755 10.2605,7.66 C9.80549773,8.15000245 9.45550123,8.72399671 9.2105,9.382 C8.96549878,10.0400033 8.843,10.7539961 8.843,11.524 C8.843,12.3360041 8.96199881,13.0779966 9.2,13.75 C9.43800119,14.4220034 9.7774978,14.9994976 10.2185,15.4825 C10.6595022,15.9655024 11.1879969,16.3399987 11.804,16.606 C12.4200031,16.8720013 13.1129962,17.005 13.883,17.005 C14.681004,17.005 15.3879969,16.8475016 16.004,16.5325 C16.6200031,16.2174984 17.1169981,15.8010026 17.495,15.283 L19.616,16.774 C18.9579967,17.6000041 18.1530048,18.2404977 17.201,18.6955 C16.2489952,19.1505023 15.1360064,19.378 13.862,19.378 C12.6999942,19.378 11.6325049,19.1855019 10.6595,18.8005 C9.68649514,18.4154981 8.8500035,17.8765035 8.15,17.1835 C7.4499965,16.4904965 6.90400196,15.6645048 6.512,14.7055 C6.11999804,13.7464952 5.924,12.6860058 5.924,11.524 C5.924,10.333994 6.13049794,9.25950479 6.5435,8.3005 C6.95650207,7.34149521 7.5234964,6.52600336 8.2445,5.854 C8.96550361,5.18199664 9.8159951,4.66400182 10.796,4.3 C11.7760049,3.93599818 12.8399943,3.754 13.988,3.754 C14.4640024,3.754 14.9609974,3.79949954 15.479,3.8905 C15.9970026,3.98150045 16.4939976,4.12149906 16.97,4.3105 C17.4460024,4.49950095 17.8939979,4.7339986 18.314,5.014 C18.7340021,5.2940014 19.0909985,5.62999804 19.385,6.022 L17.369,7.618 Z"
                                                fill="#000000"/>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Grievance Management</span>
                            </a>
                        </div>
                        <!--end:Item-->
                        <!--begin:Item-->
                        <div class="col-4">
                            <a href="{{route('communication_management')}}"
                               class="d-block py-10 px-5 text-center bg-hover-light border-right border-bottom">
                                <span class="svg-icon svg-icon-3x svg-icon-success">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-attachment.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                         viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path
                                                d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z"
                                                fill="#000000" opacity="0.3"/>
                                            <path
                                                d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z"
                                                fill="#000000"/>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Communication Management</span>
                            </a>
                        </div>
                        <!--end:Item-->
                        <!--begin:Item-->
                        <div class="col-4">
                            <a href="{{route('document_management')}}"
                               class="d-block py-10 px-5 text-center bg-hover-light border-bottom">
                                <span class="svg-icon svg-icon-3x svg-icon-success">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Box2.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                         viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path
                                                d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z"
                                                fill="#000000"/>
                                            <path
                                                d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z"
                                                fill="#000000" opacity="0.3"/>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Document Management System </span>
                            </a>
                        </div>
                        <!--end:Item-->
                        <!--begin:Item-->
                        <div class="col-4">
                            <a href="{{route('mis_and_dashboard.index')}}"
                               class="d-block py-10 px-5 text-center bg-hover-light border-right border-bottom">
                                <span class="svg-icon svg-icon-3x svg-icon-success">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                         viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                            <path
                                                d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                            <path
                                                d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                fill="#000000" fill-rule="nonzero"/>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">MIS <br/> and  Dashboard </span>
                            </a>
                        </div>
                        <!--end:Item-->
                        <!--begin:Item-->
                        <div class="col-4">
                            <a href="{{route('knowledge_management')}}"
                               class="d-block py-10 px-5 text-center bg-hover-light border-right border-bottom">
                                <span class="svg-icon svg-icon-3x svg-icon-success">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                         viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                            <path
                                                d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                            <path
                                                d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                fill="#000000" fill-rule="nonzero"/>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Knowledge Management System </span>
                            </a>
                        </div>
                        <!--end:Item-->
                        <!--begin:Item-->
                        <div class="col-4">
                            <a href="{{route('application_administration')}}"
                               class="d-block py-10 px-5 text-center bg-hover-light border-bottom">
                                <span class="svg-icon svg-icon-3x svg-icon-success">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                         viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                            <path
                                                d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                            <path
                                                d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                fill="#000000" fill-rule="nonzero"/>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Application Administration</span>
                            </a>
                        </div>
                        <!--end:Item-->
                        <!--begin:Item-->
                        <div class="col-4">
                            <a href="{{route('legacy_data_management')}}"
                               class=" d-block py-10 px-5 text-center bg-hover-light border-right border-bottom">
                            <span class="svg-icon svg-icon-3x svg-icon-success">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                         viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                            <path
                                                d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                            <path
                                                d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                fill="#000000" fill-rule="nonzero"/>
                                        </g>
                                    </svg>
                                <!--end::Svg Icon-->
                                </span>
                                <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Legacy Data Management</span>
                            </a>
                        </div>
                        <!--end:Item-->
                        <!--begin:Item-->
                        <div class="col-4">
                            <a href="{{route('auditee_employee_database')}}"
                               class="d-block py-10 px-5 text-center bg-hover-light border-right border-bottom">
                                <span class="svg-icon svg-icon-3x svg-icon-success">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                         viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                            <path
                                                d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                            <path
                                                d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                fill="#000000" fill-rule="nonzero"/>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Auditee Employee Database </span>
                            </a>
                        </div>
                        <!--end:Item-->
                        <!--begin:Item-->
                        <div class="col-4">
                            <a href="{{route('pac')}}"
                               class="d-block py-10 px-5 text-center bg-hover-light border-bottom">
                                <span class="svg-icon svg-icon-3x svg-icon-success">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                         viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                            <path
                                                d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                            <path
                                                d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                fill="#000000" fill-rule="nonzero"/>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">PAC <br/> module </span>
                            </a>
                        </div>
                        <!--end:Item-->
                        <!--begin:Item-->
                        <div class="col-4">
                            <a href="{{route('settings.index')}}"
                               class="d-block py-10 px-5 text-center bg-hover-light border-bottom">
                                <span class="svg-icon svg-icon-3x svg-icon-success">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <g id="Stockholm-icons-/-Shopping-/-Settings" stroke="none" stroke-width="1"
                                           fill="none" fill-rule="evenodd">
                                            <rect id="Bound" opacity="0.200000003" x="0" y="0" width="24"
                                                  height="24"></rect>
                                            <path
                                                d="M4.5,7 L9.5,7 C10.3284271,7 11,7.67157288 11,8.5 C11,9.32842712 10.3284271,10 9.5,10 L4.5,10 C3.67157288,10 3,9.32842712 3,8.5 C3,7.67157288 3.67157288,7 4.5,7 Z M13.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L13.5,18 C12.6715729,18 12,17.3284271 12,16.5 C12,15.6715729 12.6715729,15 13.5,15 Z"
                                                id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                                            <path
                                                d="M17,11 C15.3431458,11 14,9.65685425 14,8 C14,6.34314575 15.3431458,5 17,5 C18.6568542,5 20,6.34314575 20,8 C20,9.65685425 18.6568542,11 17,11 Z M6,19 C4.34314575,19 3,17.6568542 3,16 C3,14.3431458 4.34314575,13 6,13 C7.65685425,13 9,14.3431458 9,16 C9,17.6568542 7.65685425,19 6,19 Z"
                                                id="Combined-Shape" fill="#000000"></path>
                                        </g>
                                    </svg>
                                </span>
                                <span
                                    class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Settings </span>
                            </a>
                        </div>
                        <!--end:Item-->
                    </div>
                    <!--end:Nav-->
                </div>
                <!--end::Dropdown-->
            </div>
            <!--end::Quick Actions-->
        </div>
    </div>
    <!--end::Header Menu-->
</div>
