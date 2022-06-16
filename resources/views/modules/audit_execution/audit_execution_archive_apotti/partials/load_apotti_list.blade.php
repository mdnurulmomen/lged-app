<table class="table table-bordered" width="100%">
    <thead class="thead-light">
    <tr class="bg-hover-warning">
        <th class="text-center" width="5%">ক্রমিক নং</th>
        <th class="text-center" width="5%">আইডি</th>
        <th class="text-center" width="5%">ফাইল নং</th>
        <th class="text-center" width="10%">অনুচ্ছেদ নং</th>
        <th class="text-center" width="15%">আপত্তির শিরোনাম</th>
        <th class="text-center" width="10%">আপত্তি অনিয়মের ক্যাটাগরি</th>
        <th class="text-center" width="10%">জড়িত অর্থ (টাকা)</th>
        <th class="text-center" width="10%">নিরীক্ষিত প্রতিষ্ঠান</th>
        <th class="text-center" width="10%">নিরীক্ষার ধরন</th>
        <th class="text-center" width="5%">অর্থবছর</th>
        <th class="text-center" width="10%">আপত্তির ধরন</th>
        <th class="text-center" width="5%">কার্যক্রম</th>
    </tr>
    </thead>

    <tbody>
    @forelse($apotti_list as $apotti)
        <tr>
            <td class="text-center">{{enTobn($loop->iteration)}}</td>
            <td class="text-left">{{enTobn($apotti['id'])}}</td>
            <td class="text-left">{{$apotti['file_token_no']}}</td>
            <td class="text-left">{{enTobn($apotti['onucched_no'])}}</td>
            <td class="text-left">{{$apotti['apotti_title']}}</td>
            <td class="text-left">
                {{empty($apotti['oniyomer_category'])?'':$apotti['oniyomer_category']['name_bn']}}
            </td>

            <td class="text-right">
                <span>{{enTobn(currency_format($apotti['jorito_ortho_poriman']))}}</span>
            </td>

            <td class="text-left">{{$apotti['cost_center_name_bn']}}</td>
            <td class="text-left">{{$apotti['nirikkha_dhoron']}}</td>
            <td class="text-left">{{enTobn($apotti['apotti_year'])}}</td>
            <td class="text-left">{{$apotti['apottir_dhoron']}}</td>

            <td>
                <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-icon-primary list-btn-toggle"
                        title="বিস্তারিত দেখুন"
                        onclick="Archive_Apotti_Container.loadApottiDetails({{$apotti['id']}})">
                    <i class="fad fa-eye"></i>
                </button>

                <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-icon-primary list-btn-toggle"
                        title="হালনাগাদ করুন"
                        data-apotti-id="{{$apotti['id']}}"
                        onclick="Archive_Apotti_Container.loadApottiEditForm($(this))">
                    <i class="fad fa-edit"></i>
                </button>

                <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-icon-primary list-btn-toggle"
                        title="Sync"
                        data-apotti-id="{{$apotti['id']}}"
                        onclick="Archive_Apotti_Container.syncArchiveApottiToAmms($(this))">
                    <i class="fa fa-paper-plane"></i>
                </button>
            </td>
        </tr>
    @empty
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td colspan="12" class="datatable-cell text-center"><span>Nothing Found</span></td>
        </tr>
    @endforelse
    </tbody>
</table>




