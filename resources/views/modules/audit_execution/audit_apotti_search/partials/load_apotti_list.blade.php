<table class="table table-bordered" width="100%">
    <thead class="thead-light">
    <tr>
        <th colspan="11" class="text-left">
            মোট আপত্তিঃ {{enTobn($apotti_list['total'])}} <br>
            মোট জড়িত অর্থ (টাকা): {{enTobn(currency_format($total_jorito_ortho_poriman))}}
            {{--({{ltrim(numberConvertToBnWord($total_jorito_ortho_poriman))}} টাকা মাত্র)--}}
        </th>
    </tr>
    <tr class="bg-hover-warning">
        <th class="text-center" width="5%">ক্রম</th>
        <th class="text-center" width="5%">আইডি</th>
        <th class="text-center" width="10%">ফাইল নং</th>
        <th class="text-center" width="5%">অনুচ্ছেদ নম্বর</th>
        <th class="text-center" width="20%">আপত্তির শিরোনাম</th>
        <th class="text-center" width="10%">জড়িত অর্থ (টাকা)</th>
        <th class="text-center" width="10%">প্রকল্প</th>
        <th class="text-center" width="20%">নিরীক্ষিত প্রতিষ্ঠান</th>
        <th class="text-center" width="10%">অর্থবছর</th>
        <th class="text-center" width="10%">আপত্তির ধরন</th>
        <th class="text-center" width="5%">কার্যক্রম</th>
    </tr>
    </thead>

    <tbody>
    @forelse($apotti_list['data'] as $apotti)
        <tr>
            <td class="text-center">{{enTobn(($apotti_list['current_page']-1)*10+$loop->iteration)}}</td>
            <td class="text-center">{{enTobn($apotti['id'])}}</td>
            <td class="text-left">{{$apotti['file_token_no']}}</td>
            <td class="text-center">{{enTobn($apotti['onucched_no'])}}</td>
            <td class="text-left">{{$apotti['memo_title_bn']}}</td>
            <td class="text-right">
                <span>{{enTobn(currency_format($apotti['jorito_ortho_poriman']))}}</span>
            </td>
            <td class="text-left text-justify">
                <span>{{$apotti['project_name_bn']}}</span>
            </td>
            <td class="text-left">
                মন্ত্রণালয়/বিভাগঃ {{$apotti['ministry_name_bn']}} <br>
                এনটিটিঃ {{$apotti['parent_office_name_bn']}}
            </td>
            <td class="text-left">{{$apotti['fiscal_year']?enTobn($apotti['fiscal_year']['start']).'-'.enTobn($apotti['fiscal_year']['end']):'---'}}</td>
            <td class="text-left">
                @if($apotti['memo_type'] == 'sfi')
                    এসএফআই
                @elseif($apotti['memo_type'] == 'non-sfi')
                    নন-এসএফআই
                @endif
            </td>
            <td>
                <button class="tap-button mr-1 btn btn-sm btn-outline-primary btn-square"
                        title="বিস্তারিত দেখুন"
                        data-apotti-id="{{$apotti['apotti_id']}}"
                        onclick="Archive_Apotti_Container.showApotti($(this))">
                    <i class="fad fa-eye"></i>
                </button>
                <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-icon-primary list-btn-toggle"
                        title="হালনাগাদ করুন"
                        data-apotti-item-id="{{$apotti['id']}}"
                        onclick="Archive_Apotti_Container.loadApottiEditForm($(this))">
                    <i class="fad fa-edit"></i>
                </button>

            </td>
        </tr>
    @empty
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td colspan="10" class="datatable-cell text-center"><span>Nothing Found</span></td>
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
                   onclick="Archive_Apotti_Container.paginate($(this))" data-page={{ $prev_page }}>
                    <i class="fa fa-angle-left"></i>
                </a>
            </li>
            @if ($last_page <= 5)
                @for ($i = 1; $i <= $apotti_list['last_page']; $i++)
                    <li class="page-item {{ $apotti_list['current_page'] == $i ? 'active' : '' }}">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                           href="javascript:;" onclick="Archive_Apotti_Container.paginate($(this))"
                           data-page="{{ $i }}">{{ $i }}</a>
                    </li>
                @endfor
            @else
                @if ($current_page < 5)
                    @for ($i = 1; $i < 6; $i++)
                        <li class="page-item {{ $apotti_list['current_page'] == $i ? 'active' : '' }}">
                            <a class="page-link" data-current-page="{{ $current_page }}"
                               href="javascript:;" onclick="Archive_Apotti_Container.paginate($(this))"
                               data-page="{{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                           href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                           href="javascript:;" onclick="Archive_Apotti_Container.paginate($(this))"
                           data-page="{{ $last_page - 1 }}">{{ $last_page - 1 }}</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                           href="javascript:;" onclick="Archive_Apotti_Container.paginate($(this))"
                           data-page="{{ $last_page }}">{{ $last_page }}</a>
                    </li>
                @elseif ($current_page >= 5 && $current_page < $last_page - 5)
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                           href="javascript:;" onclick="Archive_Apotti_Container.paginate($(this))"
                           data-page="1">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                           href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                    </li>
                    @for ($i = $current_page - 4; $i <= $current_page + 4; $i++)
                        <li class="page-item {{ $apotti_list['current_page'] == $i ? 'active' : '' }}">
                            <a class="page-link" data-current-page="{{ $current_page }}"
                               href="javascript:;" onclick="Archive_Apotti_Container.paginate($(this))"
                               data-page="{{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                           href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                           href="javascript:;" onclick="Archive_Apotti_Container.paginate($(this))"
                           data-page="{{ $last_page }}">{{ $last_page }}</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                           href="javascript:;" onclick="Archive_Apotti_Container.paginate($(this))"
                           data-page="1">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                           href="javascript:;" onclick="Archive_Apotti_Container.paginate($(this))"
                           data-page="2">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                           href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                    </li>
                    @for ($i = $current_page - 4; $i <= $last_page; $i++)
                        <li class="page-item {{ $apotti_list['current_page'] == $i ? 'active' : '' }}">
                            <a class="page-link" data-current-page="{{ $current_page }}"
                               href="javascript:;" onclick="Archive_Apotti_Container.paginate($(this))"
                               data-page="{{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                @endif
            @endif
            <li class="page-item">
                <a class="page-link" href="javascript:;"
                   onclick="Archive_Apotti_Container.paginate($(this))" data-page="{{ $next_page }}">
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        </ul>
    </div>
</div>




