
@if($only_office_name == 'true')
    <p>{{$office_name_en}}</p>
@else
    <div style="text-align: center">
        {{--মহাপরিচালকের কার্যালয় <br>--}}
        <b style="font-size: 20px">{{$office_name_en}}</b> <br>
        {!! nl2br($office_details['office_address']) !!}<br>
        <u>{{$office_details['office_web']}}</u>
    </div>
@endif
