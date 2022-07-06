<table class="table table-bordered" width="100%">
    <thead class="thead-light">
    <tr>
        <th colspan="{{count($columns)+1}}" class="text-left">
            মোট আপত্তিঃ {{enTobn($apotti_list['total'])}} <br>
            মোট জড়িত অর্থ (টাকা): {{enTobn(currency_format($total_jorito_ortho_poriman))}}
            ({{ltrim(numberConvertToBnWord($total_jorito_ortho_poriman))}} টাকা মাত্র)
        </th>
    </tr>
    <tr class="bg-hover-warning">
        @if(in_array('sl_no',$columns))
            <th class="text-center" width="5%">ক্রমিক নং</th>
        @endif

        @if(in_array('id_no',$columns))
           <th class="text-center" width="5%">আইডি</th>
        @endif

        @if(in_array('audit_unit',$columns))
           <th class="text-center" width="5%">অডিট ইউনিট</th>
        @endif

        @if(in_array('fiscal_year',$columns))
            <th class="text-center" width="10%">অর্থবছর</th>
        @endif

        @if(in_array('audit_year',$columns))
            <th class="text-center" width="10%">নিরীক্ষা বছর</th>
        @endif

        @if(in_array('onucched_no',$columns))
           <th class="text-center" width="5%">অনুচ্ছেদ নম্বর</th>
        @endif

        @if(in_array('apotti_title',$columns))
           <th class="text-center" width="20%">আপত্তির শিরোনাম</th>
        @endif

        @if(in_array('jorito_ortho',$columns))
           <th class="text-center" width="10%">জড়িত অর্থ (টাকা)</th>
        @endif

        @if(in_array('audit_type',$columns))
           <th class="text-center" width="10%">নিরীক্ষার ধরন</th>
        @endif

        @if(in_array('memo_irregularity_type',$columns))
           <th class="text-center" width="10%">অনিয়মের ধরন</th>
        @endif

        @if(in_array('apotti_current_status',$columns))
            <th class="text-center" width="10%">আপত্তির বর্তমান অবস্থা</th>
        @endif

        @if(in_array('apotti_type',$columns))
            <th class="text-center" width="10%">আপত্তির ধরন</th>
        @endif
            <th class="text-center" width="5%">কার্যক্রম</th>
    </tr>
    </thead>

    <tbody>
    @forelse($apotti_list['data'] as $apotti)
        <tr>
            @if(in_array('sl_no',$columns))
                <td class="text-center">{{enTobn(($apotti_list['current_page']-1)*10+$loop->iteration)}}</td>
            @endif

            @if(in_array('id_no',$columns))
               <td class="text-center">{{enTobn($apotti['id'])}}</td>
            @endif

            @if(in_array('audit_unit',$columns))
               <td class="text-left">{{$apotti['cost_center_name_bn']}}</td>
            @endif

            @if(in_array('fiscal_year',$columns))
                <td class="text-left">{{$apotti['fiscal_year']?enTobn($apotti['fiscal_year']['start']).'-'.enTobn($apotti['fiscal_year']['end']):'---'}}</td>
            @endif

            @if(in_array('audit_year',$columns))
                <td class="text-left" width="10%">{{enTobn($apotti['audit_year_start'])}}-{{enTobn($apotti['audit_year_end'])}}</td>
            @endif

            @if(in_array('onucched_no',$columns))
                <td class="text-center" width="5%">
                    {{enTobn($apotti['onucched_no'])}}
                </td>
            @endif

            @if(in_array('apotti_title',$columns))
                <td class="text-left" width="20%">
                    {{$apotti['memo_title_bn']}}
                </td>
            @endif

            @if(in_array('jorito_ortho',$columns))
                <td class="text-right" width="10%">
                    {{enTobn(currency_format($apotti['jorito_ortho_poriman']))}}
                </td>
            @endif

            @if(in_array('audit_type',$columns))
                <td class="text-left" width="10%">
                    @if($apotti['audit_type'] == 'compliance')
                        কমপ্লায়েন্স অডিট
                    @endif
                </td>
            @endif

            @if(in_array('memo_irregularity_type',$columns))
                <td class="text-left" width="10%">{{$apotti['memo_irregularity_type_name']}}</td>
            @endif

            @if(in_array('apotti_current_status',$columns))
                <td class="text-left" width="5%">{{$apotti['memo_status_name']}}</td>
            @endif

            @if(in_array('apotti_type',$columns))
                <td class="text-left" width="10%">
                    @if($apotti['memo_type'] == 'sfi')
                        এসএফআই
                    @elseif($apotti['memo_type'] == 'non-sfi')
                        নন-এসএফআই
                    @endif
                </td>
            @endif
                <td>
                    <button class="tap-button mr-1 btn btn-sm btn-outline-primary btn-square"
                            title="বিস্তারিত দেখুন"
                            data-apotti-id="{{$apotti['apotti_id']}}"
                            onclick="Observations_Report_Container.showApotti($(this))"
                    >
                        <i class="fad fa-eye"></i>
                    </button>
                </td>
        </tr>
    @empty
        <tr>
            <td colspan="{{count($columns)}}" class="text-center"><span>Nothing Found</span></td>
        </tr>
    @endforelse
    </tbody>
</table>

<div class="pagination_ui">
    <div class="pagination">
        @php
            $current_page = $apotti_list['current_page'];
            $last_page = $apotti_list['last_page'];
            $prev_page = $apotti_list['current_page'] - 1 < 1 ? 1 : $apotti_list['current_page'] - 1;
            $next_page = $apotti_list['current_page'] + 1 > $apotti_list['last_page'] ? $apotti_list['last_page'] : $apotti_list['current_page'] + 1;
        @endphp
        <ul>
            <li class="page-item">
                <a class="page-link" href="javascript:;"
                   onclick="Observations_Report_Container.paginate($(this))" data-page={{ $prev_page }}>
                    <i class="fa fa-angle-left"></i>
                </a>
            </li>
            @if ($last_page <= 5)
                @for ($i = 1; $i <= $apotti_list['last_page']; $i++)
                    <li class="page-item {{ $apotti_list['current_page'] == $i ? 'active' : '' }}">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                            href="javascript:;" onclick="Observations_Report_Container.paginate($(this))"
                           data-page="{{ $i }}">{{ $i }}</a>
                    </li>
                @endfor
            @else
                @if ($current_page < 5)
                    @for ($i = 1; $i < 6; $i++)
                        <li class="page-item {{ $apotti_list['current_page'] == $i ? 'active' : '' }}">
                            <a class="page-link" data-current-page="{{ $current_page }}"
                                href="javascript:;" onclick="Observations_Report_Container.paginate($(this))"
                               data-page="{{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                            href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                            href="javascript:;" onclick="Observations_Report_Container.paginate($(this))"
                           data-page="{{ $last_page - 1 }}">{{ $last_page - 1 }}</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                            href="javascript:;" onclick="Observations_Report_Container.paginate($(this))"
                           data-page="{{ $last_page }}">{{ $last_page }}</a>
                    </li>
                @elseif ($current_page >= 5 && $current_page < $last_page - 5)
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                            href="javascript:;" onclick="Observations_Report_Container.paginate($(this))"
                           data-page="1">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                            href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                    </li>
                    @for ($i = $current_page - 4; $i <= $current_page + 4; $i++)
                        <li class="page-item {{ $apotti_list['current_page'] == $i ? 'active' : '' }}">
                            <a class="page-link" data-current-page="{{ $current_page }}"
                                href="javascript:;" onclick="Observations_Report_Container.paginate($(this))"
                               data-page="{{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                            href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                            href="javascript:;" onclick="Observations_Report_Container.paginate($(this))"
                           data-page="{{ $last_page }}">{{ $last_page }}</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                            href="javascript:;" onclick="Observations_Report_Container.paginate($(this))"
                           data-page="1">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                            href="javascript:;" onclick="Observations_Report_Container.paginate($(this))"
                           data-page="2">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                            href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                    </li>
                    @for ($i = $current_page - 4; $i <= $last_page; $i++)
                        <li class="page-item {{ $apotti_list['current_page'] == $i ? 'active' : '' }}">
                            <a class="page-link" data-current-page="{{ $current_page }}"
                                href="javascript:;" onclick="Observations_Report_Container.paginate($(this))"
                               data-page="{{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                @endif
            @endif
            <li class="page-item">
                <a class="page-link" href="javascript:;"
                   onclick="Observations_Report_Container.paginate($(this))" data-page="{{ $next_page }}">
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        </ul>
    </div>
</div>




