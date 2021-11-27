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
                <input name="milestone_target_date" class="milestone_target_date" type="hidden" value="{{formatDate($milestone['milestone_calendar']['target_date'],'en','/')}}">
            </td>
            <td class="pl-0 pr-0">
                <input type="text" data-target-date="{{formatDate($milestone['milestone_calendar']['target_date'],'en','/')}}" name="start_date" class="form-control milestone_start_date date" placeholder="শুরুর তারিখ">
            </td>
            <td class="pl-0 pr-0">
                <input type="text" data-target-date="{{formatDate($milestone['milestone_calendar']['target_date'],'en','/')}}" name="end_date" class="form-control milestone_end_date date" placeholder="শেষের তারিখ">
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    $('.milestone_start_date,.milestone_end_date').change(function (){
           target_date =  $(this).attr('data-target-date');
           target_date = formatDate(target_date);
           target_date = target_date.replaceAll('-', '/');

           date =  $(this).val();
           date = formatDate(date);
           date = date.replaceAll('-', '/');

           target_date = new Date(target_date);
           date = new Date(date);

           if (target_date < date) {
                toastr.warning('নির্ধারিত তারিখ '+ enTobn($(this).attr('data-target-date')));
                $(this).val('');
           }
    });
</script>
