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
                        dayGridMonth: {buttonText: 'Month'},
                        timeGridWeek: {buttonText: 'Week'},
                        timeGridDay: {buttonText: 'Day'},
                        listWeek: {buttonText: 'List'}
                    },
                    hiddenDays: [5, 6],
                    defaultView: 'dayGridMonth',
                    defaultDate: TODAY,

                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    navLinks: true,
                    events: [
                            @foreach($calendar_data as $team)
                                @if($team['child'])
                                    @foreach($team['child'] as $sub_team)
                                        @if($sub_team['team_schedules'])
                                        @php
                                            $schedules = json_decode($sub_team['team_schedules'],true);
                                        @endphp
                                        @foreach($schedules as $schedule)

                                            {
                                                title: '{{$sub_team['team_name']}}  (উপদল নেতা : {{$sub_team['leader_name_bn']}}) - {{$schedule['cost_center_name_bn']}}',
                                                start: '{{$schedule['team_member_start_date']}}',
                                                end: '{{$schedule['team_member_end_date']}}',
                                                description: '{{$schedule['cost_center_name_bn']}}',
                                                team_id: '{{$sub_team['id']}}',
                                                team_name: '{{$sub_team['team_name']}}',
                                                team_members: '{{$sub_team['team_members']}}',
                                                team_schedules: '{{$sub_team['team_schedules']}}',
                                                audit_start_end_year: '{{$sub_team['audit_year_start']}} - {{$sub_team['audit_year_end']}}',
                                                className: "fc-event-waring fc-event-solid-primary"

                                            },
                                        @endforeach
                                        @endif
                                    @endforeach
                                @else
                                    @if($team['team_schedules'])
                                        @php
                                            $schedules = json_decode($team['team_schedules'],true);
                                        @endphp
                                        @foreach($schedules as $schedule)

                                            {
                                                title: '{{$team['team_name']}}  (উপদল নেতা : {{$team['leader_name_bn']}}) - {{$schedule['cost_center_name_bn']}}',
                                                start: '{{$schedule['team_member_start_date']}}',
                                                end: '{{$schedule['team_member_end_date']}}',
                                                description: '{{$schedule['cost_center_name_bn']}}',
                                                team_id: '{{$team['id']}}',
                                                team_name: '{{$team['team_name']}}',
                                                team_members: '{{$team['team_members']}}',
                                                team_schedules: '{{$team['team_schedules']}}',
                                                audit_start_end_year: '{{$team['audit_year_start']}} - {{$team['audit_year_end']}}',
                                                className: "fc-event-waring fc-event-solid-primary"

                                            },
                                        @endforeach
                                    @endif
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
                        team_id = event.event.extendedProps.team_id;

                        team_members_jsn = event.event.extendedProps.team_members;
                        team_schedule_jsn = event.event.extendedProps.team_schedules;

                        team_members = JSON.parse(team_members_jsn.replace(/&quot;/g, '"'));
                        team_schedules = JSON.parse(team_schedule_jsn.replace(/&quot;/g, '"'));

                        // console.log(team_schedules);

                        var html = '<h4 class="text-center"> সদস্য তালিকা </h4>'

                        html += `<table class="table table-bordered" id='table'>
                                <tr>
                                    <th>নাম</th>
                                    <th>পদবী</th>
                                    <th>নিরীক্ষা দলের অবস্থান</th>
                                    <th>মোবাইল নং</th>
                                </tr>`;

                        $.each(team_members.teamLeader, function (key, value) {
                            html += '<tr>';
                            html += '<td>' + value.officer_name_bn + '</td>';

                            html += '<td>' + value.designation_bn + '</td>';

                            html += '<td>' + value.team_member_role_bn + '</td>';

                            html += '<td>' + enTobn(value.officer_mobile) + '</td>';

                            html += '</tr>';
                        });

                        if (team_members.subTeamLeader) {

                            $.each(team_members.subTeamLeader, function (key, value) {
                                html += '<tr>';
                                html += '<td>' + value.officer_name_bn + '</td>';

                                html += '<td>' + value.designation_bn + '</td>';

                                html += '<td>' + value.team_member_role_bn + '</td>';

                                html += '<td>' + enTobn(value.officer_mobile) + '</td>';

                                html += '</tr>';
                            });

                        }

                        if (team_members.member) {
                            $.each(team_members.member, function (key, value) {
                                html += '<tr>';
                                html += '<td>' + value.officer_name_bn + '</td>';

                                html += '<td>' + value.designation_bn + '</td>';

                                html += '<td>' + value.team_member_role_bn + '</td>';

                                html += '<td>' + enTobn(value.officer_mobile) + '</td>';

                                html += '</tr>';
                            });

                        }


                        html += `</table>`;

                        html += '</br>';

                        html += `<table class="table table-bordered" id='table'>
                                <tr>
                                    <th>শাখার নাম</th>
                                    <th>নিরীক্ষা বছর</th>
                                    <th>নিরীক্ষা সময়কাল</th>
                                    <th>মোট কর্ম দিবস</th>
                                </tr>`;

                        $.each(team_schedules, function (key, data) {
                            html += '<tr>';
                            html += '<td>' + data.cost_center_name_bn + '</td>';

                            html += '<td>' + enTobn(event.event.extendedProps.audit_start_end_year) + '</td>';

                            html += '<td>' + enTobn(DmyFormat(data.team_member_start_date,'/')) + '-<br>'  +  enTobn(DmyFormat(data.team_member_end_date,'/')) +'</td>';

                            html += '<td>' + enTobn(data.activity_man_days) + '</td>';

                            html += '</tr>';
                        });

                        html += `</table>`;

                        quick_panel = $("#kt_quick_panel");
                        quick_panel.addClass('offcanvas-on');
                        quick_panel.css('opacity', 1);
                        quick_panel.css('width', '500px');
                        $('.offcanvas-footer').hide();
                        quick_panel.removeClass('d-none');
                        $("html").addClass("side-panel-overlay");

                        $('.offcanvas-title').html(event.event.extendedProps.team_name);
                        $('.offcanvas-wrapper').html(html);

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



