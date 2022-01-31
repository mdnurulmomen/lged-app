<div class="row mt-5">
    <div class="col-md-12">
        <h4>সদস্য</h4>
        <table class="table table-striped">
            <thead class="thead-light">
            <tr>
                <th width="10%">ক্রঃ নং</th>
                <th width="30%">নাম</th>
                <th width="15%">পদবী</th>
                <th width="15%">শাখা</th>
            </tr>
            </thead>
            <tbody>
            @foreach($member_list as $member)
                <tr class="milestone_row">
                    <td>{{enTobn($loop->iteration)}}</td>
                    <td>
                        {{$member['officer_bn']}}
                    </td>
                    <td>
                        {{$member['officer_designation_bn']}}
                    </td>
                    <td>
                        {{$member['officer_unit_bn']}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
