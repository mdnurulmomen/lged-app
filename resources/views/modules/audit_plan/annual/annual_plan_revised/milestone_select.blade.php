{{--<option value="">মাইলস্টোন বাছাই করুন</option>--}}
{{--@foreach($all_milestone as $milestone)--}}
{{--    <option value="{{$milestone['id']}}">{{$milestone['title_bn']}} </option>--}}
{{--@endforeach--}}

<table class="table table-striped">
    <thead class="thead-light">
    <tr>
        <th width="5%">ক্রঃ নং</th>
        <th width="30%">মাইলস্টোন</th>
        <th width="15%">নির্ধারিত তারিখ</th>
        <th width="15%">শুরুর তারিখ</th>
        <th width="15%">শেষের তারিখ</th>
    </tr>
    </thead>
    <tbody>
    @foreach($all_milestone as $milestone)
        <tr class="milestone_row">
            <td>{{enTobn($loop->iteration)}}</td>
            <td>
                {{$milestone['title_bn']}}
                <input name="milestone_id" class="milestone_id" type="hidden" value="{{$milestone['id']}}">
            </td>
            <td>
                {{formatDate($milestone['milestone_calendar']['target_date'],'bn','/')}}
                <input name="milestone_target_date" class="milestone_target_date" type="hidden" value="{{$milestone['milestone_calendar']['target_date']}}">
            </td>
            <td>
                <input type="text" name="start_date" class="form-control milestone_start_date date" placeholder="শুরুর তারিখ">
            </td>
            <td>
                <input type="text" name="end_date" class="form-control milestone_end_date date" placeholder="শেষের তারিখ">
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
