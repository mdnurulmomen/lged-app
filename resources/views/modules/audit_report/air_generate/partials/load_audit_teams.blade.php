<div style="margin-top: 5px">
    <table width="100%" border="1">
        <thead>
        <tr>
            <th style="text-align: center" width="10%">ক্রমিক নং</th>
            <th style="text-align: center" width="40%">নাম</th>
            <th style="text-align: center" width="20%">পদবী</th>
            <th style="text-align: center" width="15%">নিরীক্ষা দলে অবস্থান</th>
            <th style="text-align: center" width="15%">মোবাইল নং</th>
        </tr>
        </thead>
        <tbody>
        @foreach($auditTeamMembers as $member)
            <tr>
                <td style="text-align: center">{{enTobn($loop->iteration)}}</td>
                <td style="text-align: left;margin-left: 5px">জনাব {{$member['team_member_name_bn']}}</td>
                <td style="text-align: center">{{$member['team_member_designation_bn']}}</td>
                <td style="text-align: center">{{$member['team_member_role_bn']}}</td>
                <td style="text-align: center">{{enTobn($member['mobile_no'])}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
