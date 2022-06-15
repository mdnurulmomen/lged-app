<table class="table table-hover" width="100%">
    <thead class="thead-light">
    <tr class="bg-hover-warning">
        <th width="10%" class="text-center">
            অনুচ্ছেদ নং
        </th>

        <th width="40%" class="text-left">
            আপত্তির শিরোনাম
        </th>

        <th width="15%" class="text-right">
            জড়িত অর্থ (টাকা)
        </th>

        <th width="10%" class="text-left">
            আপত্তির ধরন
        </th>

        <th width="30%" class="text-left">
            কার্যক্রম
        </th>
    </tr>
    </thead>

    <tbody>
    @forelse($apotti_list['data'] as $apotti)
        <tr class="text-center">
            <td>
                {{enTobn($apotti['onucched_no'])}}

                @if(count($apotti['apotti_items']) > 1)
                    <span class="badge badge-info text-uppercase m-1 p-1 ">
                     {{enTobn(count($apotti['apotti_items'])) }} টি
                        আপত্তি একীভূত</span>
                @endif
            </td>
            <td class="text-left">
                <span>{{$apotti['apotti_title']}}</span>
            </td>
            <td class="text-right">
                <span>{{enTobn(currency_format($apotti['total_jorito_ortho_poriman']))}}</span>
            </td>
            <td class="text-left">
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
            <td class="text-left">
                <button class="btn btn-sm btn-outline-primary btn-square mr-1" title="QAC-01"
                        data-apotti-id="{{$apotti['id']}}"
                        data-qac-type="{{$qac_type}}"
                        onclick="Qac_Container.qacApotti($(this))">
                    QAC-01
                </button>
                <button class="mr-1 btn btn-sm btn-outline-primary btn-square" title="বিস্তারিত দেখুন"
                        data-apotti-id="{{$apotti['id']}}"
                        onclick="Qac_Container.showApotti($(this))">
                    <i class="fad fa-eye"></i>বিস্তারিত
                </button>
                <button class="mr-1 btn btn-sm btn-outline-warning btn-square" title="সম্পাদনা করুন"
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
