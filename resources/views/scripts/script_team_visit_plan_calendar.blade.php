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

                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    },

                    height: 800,
                    contentHeight: 780,
                    aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                    nowIndicator: true,
                    now: TODAY + 'T09:25:00', // just for demo

                    views: {
                        dayGridMonth: {buttonText: 'month'},
                        timeGridWeek: {buttonText: 'week'},
                        timeGridDay: {buttonText: 'day'}
                    },

                    defaultView: 'dayGridMonth',
                    defaultDate: TODAY,

                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    navLinks: true,
                    events: [
                            @foreach($calendar_data as $datum)
                            @foreach($datum['child'] as $team)
                            @php
                                $schedules = json_decode($team['team_schedules'],true);
                            @endphp
                            @foreach($schedules as $schedule)

                        {

                            title: '{{$team['team_name']}}  (উপদল নেতা : {{$team['leader_name_bn']}}) (কজ সেন্টার: {{$schedule['cost_center_name_bn']}})',
                            start: '{{$schedule['team_member_start_date']}}',
                            end: '{{$schedule['team_member_end_date']}}',
                            description: '',
                            team_id: '{{$team['id']}}',
                            team_name: '{{$team['team_name']}}',
                            team_members: '{{$team['team_members']}}',
                            team_schedules: '{{$team['team_schedules']}}',
                            className: "fc-event-waring fc-event-solid-primary"

                        },
                        @endforeach
                        @endforeach
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
                    eventClick:  function(event, jsEvent, view) {
                        team_id = event.event.extendedProps.team_id;

                         team_members_jsn = event.event.extendedProps.team_members;
                         team_schedule_jsn = event.event.extendedProps.team_schedules;

                         team_members = JSON.parse(team_members_jsn.replace(/&quot;/g,'"'));
                         team_schedules = JSON.parse(team_schedule_jsn.replace(/&quot;/g,'"'));

                         // console.log(team_schedules);

                        var html = '<h4 class="text-center"> সদস্য তালিকা </h4>'

                         html += `<table class="table table-bordered" id='table'>
                                <tr>
                                    <th>নাম</th>
                                    <th>পদবী</th>
                                    <th>নিরীক্ষা দলের অবস্থান</th>
                                    <th>মোবাইল নং</th>
                                </tr>`;

                          $.each(team_members.member, function (key, value) {
                              html += '<tr>';
                              html += '<td>' + value.officer_name_en + '</td>';

                              html += '<td>' + value.designation_bn + '</td>';

                              html += '<td>' + value.team_member_role_bn + '</td>';

                              html += '<td>' + value.officer_mobile + '</td>';

                              html += '</tr>';
                          });

                          html +=`</table>`;

                          // html +='</br>';
                          //
                          //  html += `<table class="table table-bordered" id='table'>
                          //       <tr>
                          //           <th>শাখার নাম</th>
                          //           <th>নিরীক্ষা বছর</th>
                          //           <th>নিরীক্ষা সময়কাল</th>
                          //           <th>মোট কর্ম দিবস</th>
                          //       </tr>`;
                          //  var index = 0;
                          //  var year = 2021;
                          // $.each(team_schedules.index, function (key, data) {
                          //     html += '<tr>';
                          //     html += '<td>' + data.cost_center_name_bn + '</td>';
                          //
                          //     html += '<td>' + data.team_member_start_date + '</td>';
                          //
                          //     html += '<td>' + data.team_member_start_date + '</td>';
                          //
                          //     html += '<td>' + data.activity_man_days + '</td>';
                          //
                          //     html += '</tr>';
                          // });
                          //
                          // html +=`</table>`;

                        quick_panel = $("#kt_quick_panel");
                        quick_panel.addClass('offcanvas-on');
                        quick_panel.css('opacity', 1);
                        quick_panel.css('width', '500px');
                        $('.offcanvas-footer').hide();
                        $("html").addClass("side-panel-overlay");

                        $('.offcanvas-title').html(event.event.extendedProps.team_name);
                        $('.offcanvas-wrapper').html(html);


                        // team_members.member.forEach(function (o) {
                        //     console.log(o.officer_name_bn);
                        // });


                        {{--url = '{{route('audit.plan.audit.revised.plan.get-team-info')}}';--}}
                        {{--data = {team_id};--}}
                        {{--ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {--}}
                        {{--    if (response.status === 'success') {--}}
                        {{--        quick_panel = $("#kt_quick_panel");--}}
                        {{--        quick_panel.addClass('offcanvas-on');--}}
                        {{--        quick_panel.css('opacity', 1);--}}
                        {{--        $("html").addClass("side-panel-overlay");--}}
                        {{--    } else {--}}
                        {{--        toastr.error(response.data);--}}
                        {{--        console.log(response)--}}
                        {{--    }--}}
                        {{--})--}}

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

