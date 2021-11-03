<!--begin::Table-->
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th width="5%" class="text-center">ক্রমিক নং</th>
            <th width="7%" class="text-center">অনুচ্ছেদ নং</th>
            <th width="10%" class="text-center">আপত্তির শিরোনাম</th>
            <th width="10%" class="text-center">আপত্তি অনিয়মের ধরন</th>
            <th width="10%" class="text-center">জড়িত অর্থ (টাকা)</th>
            <th width="10%" class="text-center">অনিষ্পন্ন জড়িত অর্থ (টাকা)</th>
            <th width="10%" class="text-center">নিরীক্ষিত প্রতিষ্ঠান</th>
            <th width="10%" class="text-center">নিরীক্ষিত ধরন</th>
            <th width="10%" class="text-center">অর্থবছর</th>
            <th width="10%" class="text-center">আপত্তির ধরন</th>
            <th width="10%" class="text-center">কার্যক্রম</th>
        </tr>
        </thead>
        <tbody>
        @foreach($memo_list['data'] as $memo)
            <tr>
                <td>{{enTobn($loop->iteration)}}</td>
                <td>{{$memo['onucched_no']}}</td>
                <td class="text-left">{{$memo['memo_title_bn']}}</td>
                <td class="text-left">{{$memo['memo_irregularity_type_name']}}</td>
                <td class="text-right">{{enTobn(number_format($memo['jorito_ortho_poriman'],0))}}</td>
                <td class="text-right">{{enTobn(number_format($memo['onishponno_jorito_ortho_poriman'],0))}}</td>
                <td>{{$memo['cost_center_name_bn']}}</td>
                <td>{{$memo['audit_type']}}</td>
                <td>{{enTobn($memo['audit_year_start']).'-'.enTobn($memo['audit_year_end'])}}</td>
                <td>{{$memo['memo_type_name']}}</td>
                <td class="text-left">
                    <div class="btn-group btn-group-sm" role="group">
                        <button title="ডাউনলোড করুন" class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                                data-memo-id="{{$memo['id']}}"
                                onclick="Team_Calendar_Container.showMemo($(this))">
                            <i class="fad fa-download"></i>
                        </button>
                        <button title="দেখুন" class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                                data-memo-id="{{$memo['id']}}"
                                onclick="Team_Calendar_Container.showMemoDetails($(this))">
                            <i class="fad fa-eye"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!--end::Table-->
