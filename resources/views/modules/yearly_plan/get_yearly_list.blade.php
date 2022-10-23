<table class="table table-bordered" width="100%">
    <thead class="thead-light">
    <tr class="bg-hover-warning">
        <th width="7%" class="text-center">
            No
        </th>

        <th width="33%" class="text-left">
            Plan Year
        </th>

        <th width="33%" class="text-left">
            Action
        </th>
    </tr>
    </thead>

    <tbody>

    @foreach($yearly_plan_list as $plan)
        <tr class="text-center">
            <td class="text-center">
                {{$loop->iteration}}
            </td>
            <td class="text-left">
                {{$plan['strategic_plan_year']}}
            </td>
            <td class="text-left">
                <button class="mr-1 btn btn-sm btn-primary btn-square"
                        title="বিস্তারিত দেখুন"
                        data-annual-plan-id=""
                        onclick=""
                >
                    <i class="fad fa-eye"></i> বিস্তারিত
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
