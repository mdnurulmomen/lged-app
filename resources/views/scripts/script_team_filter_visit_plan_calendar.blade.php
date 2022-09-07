<script>
    var KTCalendarBasic = function () {
        return {
            //main function to initiate the module
            init: function () {
                var todayDate = moment().startOf('day');
                var YM = todayDate.format('YYYY-MM');
                var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
                var TODAY = todayDate.format('YYYY-MM-DD');
                var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

                var calendarEl = document.getElementById('kt_calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list'],
                    themeSystem: 'bootstrap',

                    // customButtons: {
                    //     calendarListButton: {
                    //         text: 'Custom List',
                    //         click: function () {
                    //             directorate_id = $('#directorate_filter').val();
                    //             fiscal_year_id = $('#fiscal_year_id').val();
                    //             team_filter = $('#team_filter').val();
                    //             cost_center_id = $('#cost_center_filter').val();
                    //             Team_Calendar_Container.loadTeamCalendarScheduleList(directorate_id, fiscal_year_id, cost_center_id, team_filter);
                    //             // if (directorate_id !== 'all') {
                    //             //     if (team_filter || cost_center_id) {
                    //             //         Team_Calendar_Container.loadTeamCalendarScheduleList(directorate_id, fiscal_year_id, cost_center_id, team_filter);
                    //             //     } else {
                    //             //         Team_Calendar_Container.loadTeamCalendar(directorate_id, fiscal_year_id);
                    //             //     }
                    //             // } else {
                    //             //     toastr.info('Please select a directorate.')
                    //             // }
                    //         }
                    //     }
                    // },

                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,dayGridWeek,dayGridDay,listWeek,calendarListButton'
                    },

                    height: 800,
                    contentHeight: 780,
                    aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio
                    nowIndicator: true,
                    now: TODAY + 'T09:25:00', // just for demo
                    displayEventTime: false,
                    views: {
                        dayGridDay: {
                            buttonText: 'Day',
                            eventLimit: false,
                            displayEventTime: false,
                        },
                        dayGridWeek: {buttonText: 'Week'},
                        dayGridMonth: {buttonText: 'Month'},
                        listWeek: {
                            buttonText: 'List',
                            eventLimit: false,
                            displayEventTime: false,
                        }
                    },

                    hiddenDays: [5, 6],
                    defaultView: 'dayGridDay',
                    defaultDate: TODAY,

                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    navLinks: true,
                    events: [
                            @foreach($calendar_data as $team)
{{--                            @if($team['child'])--}}
{{--                            @foreach($team['child'] as $sub_team)--}}
{{--                            @if($sub_team['team_schedules'])--}}
{{--                            @php--}}
{{--                                if(isset($cost_center_id)){--}}
{{--                                    $schedules = json_decode($sub_team['team_schedules'],true);--}}

{{--                                    $schedules = array_filter($schedules, function ($var) use ($cost_center_id) {--}}
{{--                                             return ($var['cost_center_id'] == $cost_center_id);--}}
{{--                                        });--}}

{{--                                }else{--}}
{{--                                    $schedules = json_decode($sub_team['team_schedules'],true);--}}
{{--                                }--}}
{{--                            @endphp--}}

{{--                            @foreach($schedules as $schedule)--}}

{{--                        {--}}
{{--                            title: '{{$sub_team['team_name']}}  (দলনেতা : {{$sub_team['leader_name_bn']}}) - {{$schedule['schedule_type']=='schedule'?$schedule['cost_center_name_bn']:$schedule['activity_details']}}',--}}
{{--                            start: '{{$schedule['team_member_start_date']}}',--}}
{{--                            end: '{{$schedule['team_member_end_date']}}',--}}
{{--                            description: '{{$schedule['schedule_type']=='schedule'?$schedule['cost_center_name_bn']:$schedule['activity_details']}}',--}}
{{--                            team_id: '{{$sub_team['id']}}',--}}
{{--                            team_name: '{{$sub_team['team_name']}}',--}}
{{--                            team_members: '{{$sub_team['team_members']}}',--}}
{{--                            team_schedules: '{{$sub_team['team_schedules']}}',--}}
{{--                            audit_start_end_year: '{{$sub_team['audit_year_start']}} - {{$sub_team['audit_year_end']}}',--}}
{{--                            className: "fc-event-waring @if($sub_team['audit_plan_id'] == 0) fc-event-solid-success  @else fc-event-solid-primary @endif"--}}

{{--                        },--}}
{{--                            @endforeach--}}
{{--                            @endif--}}
{{--                            @endforeach--}}
{{--                            @endif--}}

                            @if($team['team_schedules'])
                            @php
                                if(isset($cost_center_id)){
                                    $schedules = json_decode($team['team_schedules'],true);
                                    $schedules = array_filter($schedules, function ($var) use ($cost_center_id){
                                             return ($var['cost_center_id'] == $cost_center_id);
                                        });
                                }else{
                                    $schedules = json_decode($team['team_schedules'],true);
                                }

                            @endphp
                            @foreach($schedules as $schedule)
                        {
                            title: '{{$team['team_name']}}  (দলনেতা : {{$team['leader_name_bn']}}) - {{$schedule['schedule_type']=='schedule'?$schedule['cost_center_name_bn']:$schedule['activity_details']}} {{$team['annual_plan']['project_id'] ? '(প্রজেক্ট : '.$team['annual_plan']['project_name_bn'].')' : '' }}',
                            start: '{{$schedule['team_member_start_date']}}',
                            end: '{{$schedule['team_member_end_date']}}',
                            description: '{{$schedule['schedule_type']=='schedule'?$schedule['cost_center_name_bn']:$schedule['activity_details']}}',
                            directorate_name: $("#directorate_filter option:selected").text(),
                            team_id: '{{$team['id']}}',
                            team_name: '{{$team['team_name']}}',
                            audit_start_end_year: '{{$team['audit_year_start']}} - {{$team['audit_year_end']}}',
                            className: "fc-event-waring @if($team['audit_plan_id'] == 0) fc-event-solid-success  @else fc-event-solid-primary @endif"

                        },
                        @endforeach
                        @endif
                        @endforeach
                    ],

                    eventRender: function (info) {
                        var element = $(info.el);
                        if (info.event.extendedProps && info.event.extendedProps.description) {
                            if (element.hasClass('fc-day-grid-event')) {
                                element.data('content', info.event.extendedProps.description);
                                element.data('placement', 'top');
                                KTApp.initPopover(element);
                            } else if (element.hasClass('fc-time-grid-event')) {
                                element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                            } else if (element.find('.fc-list-item-title').lenght !== 0) {
                                element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                            }
                        }
                    },

                    eventClick: function (event, jsEvent, view) {

                        KTApp.block('#kt_wrapper', {
                            opacity: 0.1,
                            state: 'primary' // a bootstrap color
                        });

                        directorate_id = $('#directorate_filter').val();
                        team_id = event.event.extendedProps.team_id;

                        url = '{{route('calendar.load-team-schedule')}}';

                        var data = {directorate_id,team_id};

                        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
                            KTApp.unblock('#kt_wrapper');

                            quick_panel = $("#kt_quick_panel");
                            $('.offcanvas-wrapper').html('');
                            quick_panel.addClass('offcanvas-on');
                            quick_panel.css('opacity', 1);
                            quick_panel.css('width', '40%');
                            $('.offcanvas-footer').hide();
                            quick_panel.removeClass('d-none');
                            $("html").addClass("side-panel-overlay");
                            $('.offcanvas-title').html(event.event.extendedProps.directorate_name+' &#8594; '+event.event.extendedProps.team_name);
                            $('.offcanvas-wrapper').html(resp);
                        });



                    },
                });

                calendar.render();
            }
        };

    }();


    jQuery(document).ready(function () {
        KTCalendarBasic.init();
    });
</script>



