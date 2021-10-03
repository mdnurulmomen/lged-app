@foreach ($directorates as $key => $directorate)
    @if ($directorate['responsibles'])
        <div>
            <h3>{{ $directorate['activity_no'] }}</h3>
        </div>
        <div id="table_{{$directorate['id']}}">
            <div class="table-responsive">
                <table class="table  table-striped">
                    <thead class="bg-primary">
                    <tr>
                        <th class="text-light">Serial Number</th>
                        <th class="text-light">Audit Directorates</th>
                        <th class="text-light">Assigned Staff</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($directorate['responsibles'] as $key => $res)
                        <tr>
                            <td>{{$loop->iteration}}.</td>
                            <td>{{$res['office_name_en']}}</td>
                            <td>
                                <div class="operational_assigned_staffs" data-activity-id=""
                                onclick="loadActivityWiseTeam($(this))">
                                    <strong>{{$res['assigned_staffs']}}</strong>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

@endforeach


<script>
    function loadActivityWiseTeam(element) {
        url = '{{route('audit.plan.operational.plan.load-activity-wise-team')}}';
        data = {};
        KTApp.block('#kt_content', {
            opacity: 0.1,
            state: 'primary' // a bootstrap color
        });

        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            KTApp.unblock('#kt_content');
            if (response.status === 'error') {
                toastr.error('No data found');
            } else {
                $(".offcanvas-title").text('');
                quick_panel = $("#kt_quick_panel");
                quick_panel.addClass('offcanvas-on');
                quick_panel.css('opacity', 1);
                quick_panel.css('width', '40%');
                quick_panel.removeClass('d-none');
                $("html").addClass("side-panel-overlay");
                $(".offcanvas-wrapper").html(response);
            }
        });
    }
</script>
