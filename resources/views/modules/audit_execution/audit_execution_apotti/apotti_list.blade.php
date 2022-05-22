
<style type="text/css">
    .selected
    {
        background-color: #666;
        color: #fff;
    }</style>

<div class="table-search-header-wrapper mb-4 pt-3 pb-3 shadow-sm">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-md-12">
                <div class="float-right">
                    <a class="btn btn-sm btn-light-primary btn-square mr-1"
                       onclick="Apotti_Container.mergeOnucched()"
                       title="একীভূত করুন" href="javascript:;">
                        <i class="fa fa-link mr-1"></i> একীভূত করুন
                    </a>
                </div>
                <div class="float-right">
                    <a id="re-arrange-btn" class="btn btn-sm btn-light-primary btn-square mr-1"
                       onclick="Apotti_Container.reArrangeOnucched($(this))"
                       title="পুনর্বিন্যাস করুন" href="javascript:;">
                        <i class="fa fa-repeat mr-1"></i> পুনর্বিন্যাস করুন
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<table class="table table-hover" id="tblLocations">
    <thead class="thead-light">
    <tr class="bg-hover-warning">
        <th width="5%" class="datatable-cell datatable-cell-sort text-center">
            <input type="checkbox" id="selectAll">
        </th>

        <th width="10%" class="datatable-cell datatable-cell-sort text-left">
            অনুচ্ছেদ নং
        </th>

        <th width="55%" class="datatable-cell datatable-cell-sort text-left">
            শিরোনাম
        </th>

        <th width="10%" class="datatable-cell datatable-cell-sort text-right">
            জড়িত অর্থ (টাকা)
        </th>

        <th width="20%" class="datatable-cell datatable-cell-sort text-center">
            কার্যক্রম
        </th>
    </tr>
    </thead>

    <tbody>
    @forelse($apotti_list['data'] as $apotti)
        <tr class="text-center">
            <td>
                <input
                    type="checkbox"
                    {{$apotti['air_generate_type'] == 'preliminary'?'disabled':''}}
                    data-sequence="{{$apotti['apotti_sequence']}}"
                    data-onucched-no="{{$apotti['onucched_no']}}"
                    value="{{$apotti['id']}}"
                    class="select-apotti">

                <input class="apotti_sequence" data-apotti-id="{{$apotti['id']}}" type="hidden" value="{{$apotti['apotti_sequence']}}">
            </td>
            <td class="text-left">

                <input data-id="{{$apotti['id']}}" data-real-val="{{$apotti['onucched_no']}}" id="apptti_{{$apotti['id']}}" class="bijoy-bangla onucched_no" type="text" style="width: 25px;" value="{{$apotti['onucched_no']}}">

                @if(count($apotti['apotti_items']) > 1)
                    <span class="badge badge-info text-uppercase m-1 p-1 ">
                     {{enTobn(count($apotti['apotti_items'])) }} টি
                        আপত্তি একীভূত</span>
                @endif
            </td>
            <td class="text-left">
                {{$apotti['apotti_title']}}
            </td>
            <td class="text-right">
                <span>{{enTobn(number_format($apotti['total_jorito_ortho_poriman'],0))}}</span>
            </td>

            <td>
                <button class="mr-3 btn btn-sm btn-outline-primary btn-square" title="বিস্তারিত দেখুন"
                        data-apotti-id="{{$apotti['id']}}"
                        onclick="Apotti_Container.showApotti($(this))">
                    <i class="fad fa-eye"></i>বিস্তারিত
                </button>

                @if($apotti['air_generate_type'] != 'preliminary')
                    <button class="mr-3 btn btn-sm btn-outline-warning btn-square" title="সম্পাদনা করুন"
                            data-apotti-id="{{$apotti['id']}}"
                            onclick="Apotti_Container.editApotti($(this))">
                        <i class="fad fa-pencil"></i>সম্পাদনা
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
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{asset('assets/js/jquery-sortable.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $("#tblLocations").sortable({
            items: 'tbody tr',
            cursor: 'pointer',
            dropOnEmpty: false,
            start: function (e, ui) {
                ui.item.addClass("selected");
            },
            stop: function (e, ui) {
                ui.item.removeClass("selected");
                $('#re-arrange-btn').attr('data-is-rearranged','1');
                $('.apotti_sequence').each(function (i, v) {
                    i = ++i;
                    $(this).val(i)
                });
            }
        });
    });
</script>
<script>

    //select all checkboxes
    $("#selectAll").change(function(){
        var status = this.checked;
        $('.select-apotti').each(function(){
            if (!$(this).is(':disabled')) {
                this.checked = status;
            }
        });
    });

    $('.select-apotti').change(function(){
        if(this.checked == false){
            $("#selectAll")[0].checked = false;
        }

        if ($('.select-apotti:checked').length == $('.select-apotti').length ){
            $("#selectAll")[0].checked = true;
            $("#selectAll")[0].addClass('checkbox-disabled');
        }
    });

    $(".onucched_no").on('blur',function(){

        onucched_no = $(this).val();
        change_id = $(this).attr('data-id');
        real_val = $(this).attr('data-real-val');

        var maximum = 0;
        $('.onucched_no').each(function() {
            var value = $(this).val();
            maximum = (value > maximum) ? value : maximum;
        });

        if(onucched_no > maximum){
            toastr.warning(onucched_no + 'No is not exist');
            $(this).val(real_val)
            return;
        }


        $('.onucched_no').each(function(){
            id = $(this).attr('data-id');
            if(onucched_no == $(this).val()){
                if(change_id != id){
                    $('#apptti_'+id).val(real_val);
                    $('#apptti_'+id).attr('data-real-val', real_val);
                }
            }
        });
    });
</script>
