<select id="r_air_id" class="form-control rounded-0">
    <option value="">--Select--</option>
    @foreach($report_list as $report)
        <option value="{{$report['id']}}">
            {{$report['report_name']}}
        </option>
    @endforeach
</select>
