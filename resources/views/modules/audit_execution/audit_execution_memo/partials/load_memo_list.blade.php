<!--begin::Table-->
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th width="5%">
                <input type="checkbox" id="selectAll">
            </th>
            <th width="5%">ক্রমিক নং</th>
            <th width="7%">অনুচ্ছেদ নং</th>
            <th width="10%">আপত্তির শিরোনাম</th>
            <th width="10%">আপত্তি অনিয়মের ধরন</th>
            <th width="10%">জড়িত অর্থ (টাকা)</th>
            <th width="10%">অনিষ্পন্ন জড়িত অর্থ (টাকা)</th>
            <th width="10%">নিরীক্ষিত প্রতিষ্ঠান</th>
            <th width="10%">নিরীক্ষিত ধরন</th>
            <th width="10%">অর্থবছর</th>
            <th width="10%">আপত্তির ধরন</th>
            <th width="10%">সম্পাদন</th>
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
                <td>{{$memo['jorito_ortho_poriman']}}</td>
                <td>{{$memo['onishponno_jorito_ortho_poriman']}}</td>
                <td>{{$memo['cost_center_name_bn']}}</td>
                <td>{{$memo['audit_type']}}</td>
                <td>{{enTobn($memo['audit_year_start']).'-'.enTobn($memo['audit_year_end'])}}</td>
                <td>{{$memo['memo_type_name']}}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        <button class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                                data-memo-id="{{$memo['id']}}"
                                onclick="Memo_List_Container.editMemo($(this))">
                            <i class="fad fa-edit"></i>
                        </button>

                        {{--data-toggle="tooltip" data-placement="top" title="Edit"--}}

                        <button class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-danger"
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
        $('.select-memo').each(function(){ //iterate all listed checkbox items
            if(this.checked == false){ //if this item is unchecked
                $("#selectAll")[0].checked = false; //change "select all" checked status to false
            }
            //check "select all" if all checkbox items are checked
            if ($('.select-memo:checked').length == $('.select-memo').length ){
                $("#selectAll")[0].checked = true; //change "select all" checked status to true
                $("#selectAll")[0].disabled = true;
            }
        });
    })

    //select all checkboxes
    $("#selectAll").change(function(){  //"select all" change
        var status = this.checked; // "select all" checked status
        $('.select-memo').each(function(){ //iterate all listed checkbox items
            this.checked = status; //change ".checkbox" checked status
        });
    });

    $('.select-memo').change(function(){ //".checkbox" change
        //uncheck "select all", if one of the listed checkbox item is unchecked
        if(this.checked == false){ //if this item is unchecked
            $("#selectAll")[0].checked = false; //change "select all" checked status to false
        }

        //check "select all" if all checkbox items are checked
        if ($('.select-memo:checked').length == $('.select-memo').length ){
            $("#selectAll")[0].checked = true; //change "select all" checked status to true
        }
    });
</script>
