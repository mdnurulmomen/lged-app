<!--begin::Table-->
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th width="5%" class="text-left">মেমো নং</th>
            <th width="20%" class="text-left">আপত্তির শিরোনাম</th>
            <th width="10%" class="text-left">আপত্তি অনিয়মের ধরন</th>
            <th width="5%" class="text-center">জড়িত অর্থ (টাকা)</th>
            <th width="5%" class="text-center">অনিষ্পন্ন জড়িত অর্থ (টাকা)</th>
            <th width="15%" class="text-left">নিরীক্ষিত প্রতিষ্ঠান</th>
            <th width="10%" class="text-left">নিরীক্ষিত ধরন</th>
            <th width="10%" class="text-left">অর্থবছর</th>
            <th width="10%" class="text-left">আপত্তির ধরন</th>
            <th width="10%" class="text-left">কার্যক্রম</th>
        </tr>
        </thead>
        <tbody>
        @foreach($memo_list['data'] as $memo)
            <tr>
                <td>{{enTobn($memo['onucched_no'])}}</td>
                <td>{{$memo['memo_title_bn']}}</td>
                <td>{{$memo['memo_irregularity_type_name']}}</td>
                <td>{{enTobn(number_format($memo['jorito_ortho_poriman'],0))}}</td>
                <td>{{enTobn(number_format($memo['onishponno_jorito_ortho_poriman'],0))}}</td>
                <td>{{$memo['cost_center_name_bn']}}</td>
                <td>{{$memo['audit_type']}}</td>
                <td>{{enTobn($memo['audit_year_start']).'-'.enTobn($memo['audit_year_end'])}}</td>
                <td>{{$memo['memo_type_name']}}</td>
                <td>
                    <div class="d-md-flex mr-2">
                        <button title="ডাউনলোড করুন" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                                type="button" data-memo-id="{{$memo['id']}}" onclick="Team_Calendar_Container.showMemo($(this))">
                            <i class="fad fa-download pr-1"></i>
                        </button>
                        <button title="দেখুন" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                                data-memo-id="{{$memo['id']}}"
                                onclick="Team_Calendar_Container.showMemoDetails($(this))">
                            <i class="fad fa-eye"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!--end::Table-->
