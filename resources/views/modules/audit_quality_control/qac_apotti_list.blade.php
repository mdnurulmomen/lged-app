<table class="table table-hover" id="">
    <thead class="thead-light">
    <tr class="bg-hover-warning">
{{--        <th class="datatable-cell datatable-cell-sort text-center">--}}
{{--            <span class="input-group-text bg-transparent border-0 inbox_checkbox" data-toggle="popover">--}}
{{--                <label id="selectAllLabel" class="checkbox" for="selectAll">--}}
{{--                    <input type="checkbox" id="selectAll">--}}
{{--                    <span></span>--}}
{{--                 </label>--}}
{{--            </span>--}}
{{--        </th>--}}

        <th class="datatable-cell datatable-cell-sort text-center">
            অনুচ্ছেদ নং
        </th>

        <th class="datatable-cell datatable-cell-sort text-center">
            আপত্তির শিরোনাম
        </th>

        <th class="datatable-cell datatable-cell-sort text-center">
            জড়িত অর্থ (টাকা)
        </th>

        <th class="datatable-cell datatable-cell-sort text-center">
            আপত্তির ধরন
        </th>

        <th class="datatable-cell datatable-cell-sort text-center">
            কার্যক্রম
        </th>
    </tr>
    </thead>

    <tbody>
    @forelse($apotti_list['data'] as $apotti)
        <tr class="text-center">
{{--            <td>--}}
{{--                <span class="input-group-text bg-transparent border-0">--}}
{{--                      <label class="checkbox">--}}
{{--                          <input type="checkbox"--}}
{{--                                 value="{{$apotti['id']}}" class="select-apotti">--}}
{{--                            <span></span>--}}
{{--                      </label>--}}
{{--                </span>--}}
{{--                <input class="apotti_sequence" data-apotti-id="{{$apotti['id']}}" type="hidden" value="{{$apotti['apotti_sequence']}}">--}}
{{--            </td>--}}
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
                <span>{{enTobn(number_format($apotti['total_jorito_ortho_poriman'],0))}}</span>
            </td>
            <td>
                    @php $apotti_type = ''; @endphp
                    @foreach($apotti['apotti_status'] as $apotti_status)
                        @if($apotti_status['qac_type'] == $qac_type)
                           @php
                               $apotti_type = $apotti_status['apotti_type'];
                           @endphp
                        @endif
                    @endforeach
                    {{$apotti_type}}
            </td>
            <td>
                <button class="mr-3 btn btn-sm btn-outline-info btn-square" title="QAC"
                        data-apotti-id="{{$apotti['id']}}"
                        data-qac-type="{{$qac_type}}"
                        onclick="Qac_Container.qacApotti($(this))">
                    QAC
                </button>
                <button class="mr-3 btn btn-sm btn-outline-primary btn-square" title="বিস্তারিত দেখুন"
                        data-apotti-id="{{$apotti['id']}}"
                        onclick="Qac_Container.showApotti($(this))">
                    <i class="fad fa-eye"></i>বিস্তারিত
                </button>
                <button class="mr-3 btn btn-sm btn-outline-warning btn-square" title="সম্পাদনা করুন"
                        data-apotti-id="{{$apotti['id']}}"
                        onclick="Qac_Container.editApotti($(this))">
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
