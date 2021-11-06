<!--begin::Table-->
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th width="5%">
                <input type="checkbox" id="selectAll">
            </th>
            <th width="5%" class="text-center">ক্রমিক নং</th>
            <th width="7%" class="text-center">অনুচ্ছেদ নং</th>
            <th width="10%" class="text-center">আপত্তির শিরোনাম</th>
            <th width="10%" class="text-center">আপত্তি অনিয়মের ধরন</th>
            <th width="10%" class="text-center">জড়িত অর্থ (টাকা)</th>
            <th width="10%" class="text-center">অনিষ্পন্ন জড়িত অর্থ (টাকা)</th>
            <th width="10%" class="text-center">নিরীক্ষিত প্রতিষ্ঠান</th>
            <th width="10%" class="text-center">নিরীক্ষিত ধরন</th>
            <th width="10%" class="text-center">নিরীক্ষা বছর</th>
            <th width="10%" class="text-center">আপত্তির ধরন</th>
            <th width="10%" class="text-center">কার্যক্রম</th>
        </tr>
        </thead>
        <tbody>
        @foreach($memo_list['data'] as $memo)
            <tr>
                <td><input type="checkbox"  data-cost-center-id="{{$memo['cost_center_id']}}"
                           {{$memo['has_sent_to_rpu'] == 1?'checked disabled':''}}
                           value="{{$memo['id']}}" class="select-memo"></td>
                <td>{{enTobn($loop->iteration)}}</td>
                <td>{{$memo['onucched_no']}}</td>
                <td>{{$memo['memo_title_bn']}}</td>
                <td>{{$memo['memo_irregularity_type_name']}}</td>
                <td class="text-right">{{enTobn(number_format($memo['jorito_ortho_poriman'],0))}}</td>
                <td class="text-right">{{enTobn(number_format($memo['onishponno_jorito_ortho_poriman'],0))}}</td>
                <td>{{$memo['cost_center_name_bn']}}</td>
                <td>{{$memo['audit_type']}}</td>
                <td>{{enTobn($memo['audit_year_start']).'-'.enTobn($memo['audit_year_end'])}}</td>
                <td>{{$memo['memo_type_name']}}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        <button title="দেখুন" class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                                data-memo-id="{{$memo['id']}}"
                                onclick="Memo_List_Container.showMemo($(this))">
                            <i class="fad fa-eye"></i>
                        </button>

{{--                        <button title="নিরীক্ষার সুপারিশ" class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"--}}
{{--                                data-memo-id="{{$memo['id']}}"--}}
{{--                                onclick="Memo_List_Container.recommendationMemo('{{$memo['id']}}')">--}}
{{--                            <i class="fas fa-file-import"></i>--}}
{{--                        </button>--}}

                        <button title="মেমো লগ" class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                                data-memo-id="{{$memo['id']}}"
                                onclick="Memo_List_Container.memoLog($(this))">
                            <i class="fa fa-history"></i>

                        </button>

                        <button title="সম্পাদন" class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                                data-memo-id="{{$memo['id']}}"
                                onclick="Memo_List_Container.editMemo($(this))">
                            <i class="fad fa-edit"></i>
                        </button>

                        {{--data-toggle="tooltip" data-placement="top" title="Edit"--}}

                        <button title="মুছে ফেলুন" class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-danger"
                                data-memo-id="{{$memo['id']}}"
                                onclick="">
                            <i class="fad fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!--end::Table-->

<script>
    /*$("#selectAll").click(function(){
        $(".select-memo").prop('checked', $(this).prop('checked'));
    });*/

    $(function (){
        $('.select-memo').each(function(){
            if(this.checked == false){
                $("#selectAll")[0].checked = false;
            }
            if ($('.select-memo:checked').length == $('.select-memo').length ){
                $("#selectAll")[0].checked = true;
                $("#selectAll")[0].disabled = true;
            }
        });
    })

    //select all checkboxes
    $("#selectAll").change(function(){
        var status = this.checked;
        $('.select-memo').each(function(){
            if (!$(this).is(':disabled')) {
                this.checked = status;
            }
        });
    });

    $('.select-memo').change(function(){
        if(this.checked == false){
            $("#selectAll")[0].checked = false;
        }

        if ($('.select-memo:checked').length == $('.select-memo').length ){
            $("#selectAll")[0].checked = true;
        }
    });
</script>
