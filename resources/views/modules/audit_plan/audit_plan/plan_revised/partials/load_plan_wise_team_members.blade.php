<div>
    <table width="100%" border="1">
        <thead>
        <tr>
            <th style="text-align: center" width="6%">ক্রমিক নং</th>
            <th style="text-align: center" width="49%">নাম</th>
            <th style="text-align: center" width="45%">সংশোধিত</th>
        </tr>
        </thead>
        <tbody>
        @foreach($team_members as $member)
            <tr>
                <td style="text-align: center">{{enTobn($loop->iteration)}}</td>
                <td style="text-align: left">জনাব {{$member['team_member_name_bn']}},{{$member['team_member_designation_bn']}}</td>
                <td style="text-align: left"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
