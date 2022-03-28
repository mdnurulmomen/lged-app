<table class="table table-bordered" width="100%">
    <thead class="thead-light">
    <tr class="bg-hover-warning">
        <th width="5%">
            অনুচ্ছেদ নং
        </th>

        <th width="10%">
            মন্ত্রণালয়
        </th>

        <th width="10%">
            এনটিটি/সংস্থা
        </th>

        <th width="30%">
            শিরোনাম
        </th>

        <th width="10%">
            জড়িত অর্থ (টাকা)
        </th>

        <th width="10%">
            এআইআর ইস্যুর তারিখ
        </th>

        <th width="10%">
            স্ট্যাটাস রিভিউ তারিখ
        </th>

        <th width="20%">
            কার্যক্রম
        </th>
    </tr>
    </thead>

    <tbody>
    @forelse($apotti_list['data'] as $apotti)
        <tr>
            <td class="text-left">
                {{enTobn($apotti['onucched_no'])}}
                @if(count($apotti['apotti_items']) > 1)
                    <span class="badge badge-info text-uppercase m-1 p-1 ">
                     {{enTobn(count($apotti['apotti_items'])) }} টি
                        আপত্তি একীভূত</span>
                @endif
            </td>
            <td class="text-left">
                {{$apotti['ministry_name_bn']}}
            </td>
            <td class="text-left">
                {{$apotti['parent_office_name_bn']}}
            </td>
            <td class="text-left">
                {{$apotti['apotti_title']}}
                <br>
                @if(!empty($apotti['apotti_status']))
                    <span class="text-primary">
                        (আপত্তিটি {{strtoupper($apotti['apotti_status'][0]['apotti_type'])}} করার জন্য অনুরোধ করা হল)
                    </span>
                @endif
            </td>
            <td class="text-right">
                <span>{{enTobn(number_format($apotti['total_jorito_ortho_poriman'],0))}}</span>
            </td>

            <td class="text-left">
                {{formatDate($apotti['air_issue_date'],'bn')}}
            </td>

            <td class="text-left">
                <span class="{{$apotti['status_review_date'] == date('Y-m-d')?'badge badge-primary':''}}">
                    {{formatDate($apotti['status_review_date'],'bn')}}
                </span>

                {{$apotti['latest_movement'] == null?'': $apotti['latest_movement']['receiver_employee_name_bn'].' কাছে প্রেরণ করা হয়েছে ('.$apotti['latest_movement']['status'].')'}}
            </td>

            <td>
                <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-icon-primary list-btn-toggle"
                        title="বিস্তারিত দেখুন"
                        data-apotti-id="{{$apotti['id']}}"
                        onclick="Apotti_Register_Container.showApotti($(this))">
                    <i class="fad fa-eye"></i>
                </button>

                @if($apotti['latest_movement'] ==  null)
                    <button class="mr-1 btn btn-icon btn-square btn-sm btn-light  btn-icon-primary list-btn-toggle"
                            title="সম্পাদনা করুন"
                            data-apotti-id="{{$apotti['id']}}"
                            onclick="Apotti_Register_Container.loadApotiEdit($(this))">
                        <i class="fad fa-pencil"></i>
                    </button>
                @endif

                @if($apotti['latest_movement'] ==  null || $apotti['latest_movement']['status'] != 'approved')
                    <button data-apotti-id="{{$apotti['id']}}"
                            onclick="Apotti_Register_Container.loadApprovalAuthority($(this))" title="প্রাপক বাছাই করুন"
                            class="mr-1 btn btn-icon btn-square btn-sm btn-light  btn-icon-primary list-btn-toggle">
                        <i class="fad fa-share-square"></i>
                    </button>
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
