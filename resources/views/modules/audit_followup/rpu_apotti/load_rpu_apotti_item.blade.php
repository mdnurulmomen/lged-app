<button class="mr-1 btn btn-sm btn-primary btn-square mb-5 float-right"
        onclick="Rpu_Apotti_Container.sendToDirectorateForm($(this))">
    <i class="fa fa-save"></i> অডিটি প্রতিষ্ঠানের জবাব সংরক্ষণ করুন
</button>

<table class="table table-bordered" width="100%">
    <thead class="thead-light">
    <tr class="bg-hover-warning">
        <th width="1%" class="text-center"></th>
        <th width="2%" class="text-center">
            ক্রম
        </th>

        <th width="15%" class="text-center">
            অনুচ্ছেদ সম্পর্কিত তথ্য
        </th>

        <th width="18%" class="text-center">
            কস্ট সেন্টার/ইউনিট
        </th>

        <th width="30%" class="text-left">
            শিরোনাম
        </th>

        <th width="25%" class="text-left">
            জবাব
        </th>

        <th width="10%" class="text-left">
            কার্যক্রম
        </th>
    </tr>
    </thead>

    <tbody>
    @if (!empty($apotti_item_list))
        @foreach($apotti_item_list as $apotti_item)
            <tr class="text-center">
                <td class="text-center">
                   <input {{$apotti_item['is_sent_amms'] == 1 ? 'checked disabled' : ''}} class="select-apotti" value="{{$apotti_item['apotti_item_id']}}" type="checkbox">
                </td>
                <td class="text-center">
                    {{--{{enTobn(($apotti_item_list['current_page']-1)*10+$loop->iteration)}}--}}
                    {{enTobn($loop->iteration)}}
                </td>
                <td class="text-left">
                    <span>অনুচ্ছেদ নম্বর: {{enTobn($apotti_item['onucched_no'])}}</span><br>
                    <span>অর্থ বছর: {{enTobn($apotti_item['fiscal_year'])}}</span><br>
                    <span>ক্যাটাগরি:

                        @if($apotti_item['memo_type'] == 'sfi')
                            এসএফআই
                        @elseif($apotti_item['memo_type'] == 'non-sfi')
                            নন-এসএফআই
                        @endif

                    </span><br>
                    <span>স্ট্যাটাস:
                        @if($apotti_item['memo_status'] == 1)
                            নিস্পন্ন
                        @elseif($apotti_item['memo_status'] == 2)
                            অনিস্পন্ন
                        @elseif($apotti_item['memo_status'] == 3)
                            আংশিক নিস্পন্ন
                        @endif
                    </span>
                </td>
                <td class="text-left">
                    <span>এনটিটি: {{$apotti_item['parent_office_name_bn']}}</span><br>
                    <span style="margin-top: 5px">কস্ট সেন্টার: {{$apotti_item['cost_center_name_bn']}}</span>
                </td>
                <td class="text-left">
                    {{$apotti_item['memo_title_bn']}}
                </td>
                <td class="text-left">
                    <span><strong>নিরীক্ষিত অফিসের জবাব:</strong>{{$apotti_item['unit_response']}}</span>
                    <br><span><strong>অধিদপ্তর/সংস্থার জবাব:</strong>{{$apotti_item['entity_response']}}</span>
                    <br><span><strong>মন্ত্রণালয়ের মন্তব্য:</strong> {{$apotti_item['ministry_response']}}</span>
                </td>
                <td class="text-left">
                    <button class="mr-1 btn btn-sm btn-primary btn-square"
                            title="বিস্তারিত দেখুন"
                            data-apotti-item-id="{{$apotti_item['apotti_item_id']}}"
                            data-apotti-title-bn="{{$apotti_item['memo_title_bn']}}"
                            onclick="Rpu_Apotti_Container.loadApottiResponseForm($(this))">
                        <i class="fad fa fa-comments"></i>
                    </button>
                </td>
            </tr>
        @endforeach

        {{--<tr>
            <td colspan="7">
                <div class="pagination_ui">
                    <div class="pagination">
                        @php
                            $current_page = $apotti_item_list['current_page'];
                            $last_page = $apotti_item_list['last_page'];
                            $prev_page = $apotti_item_list['current_page'] - 1 < 1 ? 1 : $apotti_item_list['current_page'] - 1;
                            $next_page = $apotti_item_list['current_page'] + 1 > $apotti_item_list['last_page'] ? $apotti_item_list['last_page'] : $apotti_item_list['current_page'] + 1;
                        @endphp
                        <ul>
                            <li class="page-item">
                                <a class="page-link" href="javascript:;"
                                   onclick="Rpu_Apotti_Container.paginate($(this))" data-page={{ $prev_page }}>
                                    <i class="fa fa-angle-left"></i>
                                </a>
                            </li>
                            @if ($last_page <= 5)
                                @for ($i = 1; $i <= $apotti_item_list['last_page']; $i++)
                                    <li class="page-item {{ $apotti_item_list['current_page'] == $i ? 'active' : '' }}">
                                        <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" onclick="Rpu_Apotti_Container.paginate($(this))"
                                           data-page="{{ $i }}">{{ $i }}</a>
                                    </li>
                                @endfor
                            @else
                                @if ($current_page < 5)
                                    @for ($i = 1; $i < 6; $i++)
                                        <li class="page-item {{ $apotti_item_list['current_page'] == $i ? 'active' : '' }}">
                                            <a class="page-link" data-current-page={{ $current_page }}
                                            href="javascript:;" onclick="Rpu_Apotti_Container.paginate($(this))"
                                               data-page="{{ $i }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li class="page-item">
                                        <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" onclick="Rpu_Apotti_Container.paginate($(this))"
                                           data-page="{{ $last_page - 1 }}">{{ $last_page - 1 }}</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" onclick="Rpu_Apotti_Container.paginate($(this))"
                                           data-page="{{ $last_page }}">{{ $last_page }}</a>
                                    </li>
                                @elseif ($current_page >= 5 && $current_page < $last_page - 5)
                                    <li class="page-item">
                                        <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" onclick="Rpu_Apotti_Container.paginate($(this))"
                                           data-page="1">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                                    </li>
                                    @for ($i = $current_page - 4; $i <= $current_page + 4; $i++)
                                        <li class="page-item {{ $apotti_item_list['current_page'] == $i ? 'active' : '' }}">
                                            <a class="page-link" data-current-page={{ $current_page }}
                                            href="javascript:;" onclick="Rpu_Apotti_Container.paginate($(this))"
                                               data-page="{{ $i }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li class="page-item">
                                        <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" onclick="Rpu_Apotti_Container.paginate($(this))"
                                           data-page="{{ $last_page }}">{{ $last_page }}</a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" onclick="Rpu_Apotti_Container.paginate($(this))"
                                           data-page="1">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" onclick="Rpu_Apotti_Container.paginate($(this))"
                                           data-page="2">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                                    </li>
                                    @for ($i = $current_page - 4; $i <= $last_page; $i++)
                                        <li class="page-item {{ $apotti_item_list['current_page'] == $i ? 'active' : '' }}">
                                            <a class="page-link" data-current-page={{ $current_page }}
                                            href="javascript:;" onclick="Rpu_Apotti_Container.paginate($(this))"
                                               data-page="{{ $i }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                @endif
                            @endif
                            <li class="page-item">
                                <a class="page-link" href="javascript:;"
                                   onclick="Rpu_Apotti_Container.paginate($(this))" data-page="{{ $next_page }}">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </td>
        </tr>--}}
    @else
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td colspan="7" class="datatable-cell text-center"><span>Nothing Found</span></td>
        </tr>
    @endif
    </tbody>
</table>
