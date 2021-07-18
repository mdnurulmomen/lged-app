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
                            <td>{{$key+1}}.</td>
                            <td>{{$res['office_name_en']}}</td>
                            <td>0</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

@endforeach