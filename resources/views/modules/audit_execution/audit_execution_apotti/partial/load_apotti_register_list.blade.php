<table class="mb-14" width="100%" border="1">
    <thead class="thead-light">
    <tr class="bg-light-primary">
        <th colspan="16" class="text-left">
            মোট আপত্তিঃ {{enTobn($apotti_list['total'])}} <br>
            মোট জড়িত অর্থ (টাকা): {{enTobn(currency_format($total_jorito_ortho_poriman))}}
            ({{ltrim(numberConvertToBnWord($total_jorito_ortho_poriman))}} টাকা মাত্র)
        </th>
    </tr>
    <tr class="bg-light-primary">
        <th width="3%">ক্রম</th>
        <th width="5%">মন্ত্রণালয়</th>
        <th width="5%">এনটিটি/সংস্থা</th>
        <th width="5%">অর্থ বছর</th>
        <th width="5%">নিরীক্ষা বছর</th>
        <th width="5%">এআইআর এর নাম</th>
        <th width="5%">অনুচ্ছেদ নম্বর</th>
        <th width="17%">আপত্তির শিরোনাম</th>
        <th width="5%">জড়িত টাকা (টাকা)</th>
        <th width="5%">নিরীক্ষার ধরন</th>
        <th width="5%">এআইআর ইস্যুর তারিখ</th>
        <th width="5%">তাগিদ পত্র ইস্যুর তারিখ</th>
        <th width="5%">ডিও লেটার ইস্যুর তারিখ</th>
        <th width="5%">সর্বশেষ জবাব প্রার্থীর তারিখ</th>
        <th width="5%">স্ট্যাটাস রিভিউ তারিখ</th>
        <th width="5%">কার্যক্রম</th>
    </tr>
    </thead>

    <tbody>
    @forelse($apotti_list['data'] as $apotti)
        <tr>
            <td class="text-center">{{enTobn($loop->iteration)}}</td>
            <td class="text-left">
                {{$apotti['ministry_name_bn']}}
            </td>
            <td class="text-left">
                {{$apotti['parent_office_name_bn']}}
            </td>
            <td>{{ enTobn($apotti['fiscal_year']['start']) }}  - {{enTobn($apotti['fiscal_year']['end'])}}</td>
            <td></td>
            <td></td>
            <td class="text-left">
                {{enTobn($apotti['onucched_no'])}}
{{--                @if(count($apotti['apotti_items']) > 1)--}}
{{--                    <span class="badge badge-info text-uppercase m-1 p-1 ">--}}
{{--                     {{enTobn(count($apotti['apotti_items'])) }} টি--}}
{{--                        আপত্তি একীভূত</span>--}}
{{--                @endif--}}
            </td>

            <td class="text-left">
                {{$apotti['memo_title_bn']}}
                <br>
{{--                @if(!empty($apotti['apotti_status']))--}}
{{--                    <span class="text-primary">--}}
{{--                        (আপত্তিটি {{strtoupper($apotti['apotti_status'][0]['apotti_type'])}} করার জন্য অনুরোধ করা হল)--}}
{{--                    </span>--}}
{{--                @endif--}}
            </td>
            <td class="text-right">
                <span>{{enTobn(currency_format($apotti['jorito_ortho_poriman']))}}</span>
            </td>
            <td></td>
            <td class="text-left">{{formatDate($apotti['air_issue_date'],'bn')}}</td>
            <td></td>
            <td></td>
            <td></td>

            <td class="text-left">
                {{formatDate($apotti['status_review_date'],'bn')}} <br>
{{--                {{$apotti['latest_movement'] == null?'': $apotti['latest_movement']['receiver_employee_name_bn'].' কাছে প্রেরণ করা হয়েছে ('.$apotti['latest_movement']['status'].')'}}--}}
            </td>

            <td>
{{--                <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-icon-primary list-btn-toggle"--}}
{{--                        title="বিস্তারিত দেখুন"--}}
{{--                        data-apotti-id="{{$apotti['id']}}"--}}
{{--                        onclick="Apotti_Register_Container.showApotti($(this))">--}}
{{--                    <i class="fad fa-eye"></i>--}}
{{--                </button>--}}

{{--                @if($apotti['latest_movement'] ==  null)--}}
{{--                    <button class="mr-1 btn btn-icon btn-square btn-sm btn-light  btn-icon-primary list-btn-toggle"--}}
{{--                            title="সম্পাদনা করুন"--}}
{{--                            data-apotti-id="{{$apotti['id']}}"--}}
{{--                            onclick="Apotti_Register_Container.loadApotiEdit($(this))">--}}
{{--                        <i class="fad fa-pencil"></i>--}}
{{--                    </button>--}}
{{--                @endif--}}

{{--                @if($apotti['latest_movement'] ==  null || $apotti['latest_movement']['status'] != 'approved')--}}
{{--                    <button data-apotti-id="{{$apotti['id']}}"--}}
{{--                            onclick="Apotti_Register_Container.loadApprovalAuthority($(this))" title="প্রাপক বাছাই করুন"--}}
{{--                            class="mr-1 btn btn-icon btn-square btn-sm btn-light  btn-icon-primary list-btn-toggle">--}}
{{--                        <i class="fad fa-share-square"></i>--}}
{{--                    </button>--}}
{{--                @endif--}}
            </td>
        </tr>
    @empty
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td colspan="16" class="datatable-cell text-center"><span>Nothing Found</span></td>
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
                   onclick="Apotti_Register_Container.paginate($(this))" data-page={{ $prev_page }}>
                    <i class="fa fa-angle-left"></i>
                </a>
            </li>
            @if ($last_page <= 5)
                @for ($i = 1; $i <= $apotti_list['last_page']; $i++)
                    <li class="page-item {{ $apotti_list['current_page'] == $i ? 'active' : '' }}">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                           href="javascript:;" onclick="Apotti_Register_Container.paginate($(this))"
                           data-page="{{ $i }}">{{ $i }}</a>
                    </li>
                @endfor
            @else
                @if ($current_page < 5)
                    @for ($i = 1; $i < 6; $i++)
                        <li class="page-item {{ $apotti_list['current_page'] == $i ? 'active' : '' }}">
                            <a class="page-link" data-current-page="{{ $current_page }}"
                               href="javascript:;" onclick="Apotti_Register_Container.paginate($(this))"
                               data-page="{{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                           href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                           href="javascript:;" onclick="Apotti_Register_Container.paginate($(this))"
                           data-page="{{ $last_page - 1 }}">{{ $last_page - 1 }}</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                           href="javascript:;" onclick="Apotti_Register_Container.paginate($(this))"
                           data-page="{{ $last_page }}">{{ $last_page }}</a>
                    </li>
                @elseif ($current_page >= 5 && $current_page < $last_page - 5)
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                           href="javascript:;" onclick="Apotti_Register_Container.paginate($(this))"
                           data-page="1">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                           href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                    </li>
                    @for ($i = $current_page - 4; $i <= $current_page + 4; $i++)
                        <li class="page-item {{ $apotti_list['current_page'] == $i ? 'active' : '' }}">
                            <a class="page-link" data-current-page="{{ $current_page }}"
                               href="javascript:;" onclick="Apotti_Register_Container.paginate($(this))"
                               data-page="{{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                           href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                           href="javascript:;" onclick="Apotti_Register_Container.paginate($(this))"
                           data-page="{{ $last_page }}">{{ $last_page }}</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                           href="javascript:;" onclick="Apotti_Register_Container.paginate($(this))"
                           data-page="1">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                           href="javascript:;" onclick="Apotti_Register_Container.paginate($(this))"
                           data-page="2">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" data-current-page="{{ $current_page }}"
                           href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                    </li>
                    @for ($i = $current_page - 4; $i <= $last_page; $i++)
                        <li class="page-item {{ $apotti_list['current_page'] == $i ? 'active' : '' }}">
                            <a class="page-link" data-current-page="{{ $current_page }}"
                               href="javascript:;" onclick="Apotti_Register_Container.paginate($(this))"
                               data-page="{{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                @endif
            @endif
            <li class="page-item">
                <a class="page-link" href="javascript:;"
                   onclick="Apotti_Register_Container.paginate($(this))" data-page="{{ $next_page }}">
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
