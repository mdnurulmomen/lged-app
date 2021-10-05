<!--begin::Table-->
<div class="row">
    <div class="col-md-12">
        <div class="offcanvas-wrapper mb-5 scroll-pull scroll"
             data-scroll="true" data-wheel-propagation="true"
             data-height="500">
            <div class="daak_movement_viewer" style="">
                <div class="timeline timeline-3">
                    <div class="timeline-items">
                        @foreach($annual_plan_movement_list as $annual_plan_movement)
                            <div class="timeline-item">
                                <div class="timeline-media">
                                    <i class="fad fa-user"></i>
                                </div>
                                <div class="timeline-content rounded-0">
                                    <div class="d-flex align-items-center justify-content-between mb-3 pr-2">
                                        <p class="text-dark-75 font-weight-bold">
                                            অনুমোদনকারী
                                        </p>
                                        <span
                                            class="text-muted ml-2">{{formatDateTime($annual_plan_movement['created_at'],'bn')}}</span>
                                    </div>
                                    <div class="daak_sender_info table-responsive">
                                        <table cellpadding="0"
                                               class="table table-borderless table-sm mb-0 tbl-left vline-top">
                                            <tbody>
                                            <tr>
                                                <td class="text-left" width="80">
                                                    <div class=" font-weight-bold">প্রাপক</div>
                                                </td>
                                                <td>:</td>
                                                <td>
                                                    <p class="mb-0">
                                                    <span class="main_recipient">
                                                        <span>{{$annual_plan_movement['receiver_name_bn']}}</span>
                                                        <small>({{$annual_plan_movement['receiver_designation_bn']}})</small>
                                                    </span>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-left" width="80">
                                                    <div class=" font-weight-bold">প্রেরক</div>
                                                </td>
                                                <td>:</td>
                                                <td>
                                                    <p class="mb-0"><span class="sender">
        <span class="sender_name">{{$annual_plan_movement['sender_name_bn']}}</span>
        <small>({{$annual_plan_movement['sender_designation_bn']}})</small>
        </span>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-left" width="80">
                                                    <div class=" font-weight-bold">মন্তব্য</div>
                                                </td>
                                                <td>:</td>
                                                <td>
                                                    <p class="mb-0">
                                                        <span class="sender">
        <span class="sender_name">{{$annual_plan_movement['comments']}}</span>
        </span>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-left" width="80">
                                                    <div class=" font-weight-bold">স্ট্যাটাস</div>
                                                </td>
                                                <td>:</td>
                                                <td>
                                                    <p class="mb-0">
                                                        <span class="sender">
                                                            <span class="sender_name badge badge-info m-1 p-1">{{$annual_plan_movement['status']}}</span>
                                                        </span>
                                                    </p>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <style>
            .timeline.timeline-3 .timeline-items {
                margin: 0;
                padding: 0
            }

            .timeline.timeline-3 .timeline-items .timeline-item {
                margin-left: 25px;
                border-left: 2px solid #ecf0f3;
                padding: 0 0 20px 50px;
                position: relative
            }

            .timeline.timeline-3 .timeline-items .timeline-item .timeline-media {
                position: absolute;
                top: 0;
                left: -26px;
                border: 2px solid #ecf0f3;
                border-radius: 100%;
                width: 50px;
                height: 50px;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                justify-content: center;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                background-color: #fff;
                line-height: 0
            }

            .timeline.timeline-3 .timeline-items .timeline-item .timeline-media i {
                font-size: 1.4rem
            }

            .timeline.timeline-3 .timeline-items .timeline-item .timeline-media .svg-icon svg {
                height: 24px;
                width: 24px
            }

            .timeline.timeline-3 .timeline-items .timeline-item .timeline-media img {
                max-width: 48px;
                max-height: 48px;
                border-radius: 100%
            }

            .timeline.timeline-3 .timeline-items .timeline-item .timeline-content {
                border-radius: .85rem;
                position: relative;
                background-color: #f3f6f9;
                padding: .75rem 1.5rem
            }

            .timeline.timeline-3 .timeline-items .timeline-item .timeline-content:before {
                position: absolute;
                content: '';
                width: 0;
                height: 0;
                top: 10px;
                left: -25px;
                border-right: solid 10px #f3f6f9;
                border-bottom: solid 17px transparent;
                border-left: solid 17px transparent;
                border-top: solid 17px transparent
            }

            .timeline.timeline-3 .timeline-items .timeline-item:last-child {
                border-left-color: transparent;
                padding-bottom: 0
            }
        </style>
    </div>
</div>
<!--end::Table-->

