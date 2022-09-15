<table class="table table-bordered" width="100%">
    <thead class="thead-light">
    <tr class="bg-hover-warning">
        <th width="7%" class="text-center">
            ক্রম
        </th>

        <th width="33%" class="text-left">
            টপিক
        </th>

        <th width="33%" class="text-left">
            কার্যক্রম
        </th>
    </tr>
    </thead>

    <tbody>
    @forelse($psr_approval_list as $topic)
        <tr class="text-center">
            <td class="text-center">
                {{$loop->iteration}}
            </td>
            <td class="text-left">
                {{$topic['annual_plan']['subject_matter']}}
            </td>
            <td class="text-left">
                <button class="mr-1 btn btn-sm btn-primary btn-square" title="বিস্তারিত দেখুন"
                        data-psr-plan-id="{{$topic['id']}}"
                        onclick="Approve_Psr_Reprot_List_Container.previewPSRPlan($(this))"
                >
                    <i class="fad fa-eye"></i> বিস্তারিত
                </button>

                @if($topic['status'] == 'pending')
                    <button class="mr-1 btn btn-sm btn-edit" title="অনুমোদন করুন"
                            data-annual-plan-psr-id="{{$topic['id']}}"
                            onclick="Approve_Psr_Reprot_List_Container.approvePsrReport($(this))">
                        <i style="color: white" class="fad fa-check"></i>
                        অনুমোদন করুন
                    </button>
                @else
                    অনুমোদিত
                @endif
            </td>
        </tr>
    @empty
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td colspan="4" class="datatable-cell text-center"><span>Nothing Found</span></td>
        </tr>
    @endforelse
    </tbody>
</table>
