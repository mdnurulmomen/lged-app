
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
                       title="আরপিইউতে প্রেরণ করুন" href="javascript:;">
                        <i class="fa fa-link mr-1"></i> একীভূত করুন
                    </a>
                </div>
                <div class="float-right">
                    <a id="re-arrange-btn" class="btn btn-sm btn-light-primary btn-square mr-1"
                       onclick="Apotti_Container.reArrangeOnucched($(this))"
                       title="আরপিইউতে প্রেরণ করুন" href="javascript:;">
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
        <th class="datatable-cell datatable-cell-sort text-center">
            <span class="input-group-text bg-transparent border-0 inbox_checkbox" data-toggle="popover">
                <label id="selectAllLabel" class="checkbox" for="selectAll">
                    <input type="checkbox" id="selectAll">
                    <span></span>
                 </label>
            </span>
        </th>

        <th class="datatable-cell datatable-cell-sort text-center">
            অনুচ্ছেদ নম্বর
        </th>

        <th class="datatable-cell datatable-cell-sort text-center">
            আপত্তির শিরোনাম
        </th>

        <th class="datatable-cell datatable-cell-sort text-center">
            জড়িত অর্থ (টাকা)
        </th>

{{--        <th class="datatable-cell datatable-cell-sort text-center">--}}
{{--            অনিষ্পন্ন জড়িত অর্থ (টাকা)--}}
{{--        </th>--}}

        <th class="datatable-cell datatable-cell-sort text-center">
            কার্যক্রম
        </th>
    </tr>
    </thead>

    <tbody>
    @forelse($apotti_list['data'] as $apotti)
        <tr class="text-center">
            <td>
                <span class="input-group-text bg-transparent border-0">
                      <label class="checkbox">
                          <input
                                 type="checkbox"
                                 data-sequence="{{$apotti['apotti_sequence']}}"
                                 value="{{$apotti['id']}}"
                                 class="select-apotti">
                            <span></span>
                      </label>
                </span>
                <input class="apotti_sequence" data-apotti-id="{{$apotti['id']}}" type="hidden" value="{{$apotti['apotti_sequence']}}">
            </td>
            <td>
                {{enTobn($apotti['onucched_no'])}}

                @if(count($apotti['apotti_items']) > 1)
                    <span class="badge badge-info text-uppercase m-1 p-1 ">
                     {{enTobn(count($apotti['apotti_items'])) }} টি
                        আপত্তি একীভূত</span>
                @endif
            </td>
            <td>
                <span>{{$apotti['apotti_title']}}</span>
            </td>
            <td>
                <span>{{enTobn(currency_format($apotti['total_jorito_ortho_poriman']))}}</span>
            </td>
{{--            <td>--}}
{{--                <span>{{enTobn(currency_format($apotti['total_onishponno_jorito_ortho_poriman']))}}</span>--}}
{{--            </td>--}}
            <td>
                <button class="mr-3 btn btn-sm btn-outline-primary btn-square" title="বিস্তারিত দেখুন"
                        data-apotti-id="{{$apotti['id']}}"
                        onclick="Apotti_Container.showApotti($(this))">
                    <i class="fad fa-eye"></i>বিস্তারিত
                </button>
                <button class="mr-3 btn btn-sm btn-outline-warning btn-square" title="সম্পাদনা করুন"
                        data-apotti-id="{{$apotti['id']}}"
                        onclick="Apotti_Container.editApotti($(this))">
                    <i class="fad fa-pencil"></i>সম্পাদনা
                </button>
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
</script>
