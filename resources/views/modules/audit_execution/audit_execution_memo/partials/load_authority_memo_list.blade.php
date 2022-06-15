<style>
    .pagination_ui {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
    }

    .pagination ul {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        padding: 8px;
    }

    .pagination ul li {
        color: rgba(76, 120, 234, 0.85);
        list-style: none;
        line-height: 45px;
        text-align: center;
        font-size: 18px;
        font-weight: 500;
        cursor: pointer;
        user-select: none;
        transition: all 0.3s ease;
    }

    .pagination ul li.numb {
        list-style: none;
        height: 45px;
        width: 45px;
        margin: 0 3px;
        line-height: 45px;
        border-radius: 50%;
    }

    .pagination ul li.numb.first {
        margin: 0px 3px 0 -5px;
    }

    .pagination ul li.numb.last {
        margin: 0px -5px 0 3px;
    }

    .pagination ul li.dots {
        font-size: 22px;
        cursor: default;
    }

    .pagination ul li.btn {
        padding: 0 20px;
        border-radius: 50px;
    }

    .pagination li.active,
    .pagination ul li.numb:hover,
    .pagination ul li:first-child:hover,
    .pagination ul li:last-child:hover {
        color: #fff;
        background: rgba(76, 120, 234, 0.85);
    }

</style>

<div class="card sna-card-border mt-2 mb-14">
    @if (!empty($memo_list))
        <div class="toolbar flex-wrap justify-content-between shadow-sm pl-1 d-flex border-bottom">
            <div class="d-flex">
                <div id="daak_group_action_panel">
                    <div class="d-flex flex-wrap">
                        <div class="btn-group">
                            <div class="dropdown bootstrap-select form-control">
                                <button type="button" tabindex="-1" class="btn dropdown-toggle btn-light border-0"
                                    data-toggle="dropdown" role="combobox" aria-owns="bs-select-1"
                                    aria-haspopup="listbox" aria-expanded="false" data-id="daak_status_selectpicker"
                                    title="সকল">
                                    <div class="filter-option">
                                        <div class="filter-option-inner">
                                            <div class="filter-option-inner-inner">সকল</div>
                                        </div>
                                    </div>
                                </button>
                                <div class="dropdown-menu "
                                    style="max-height: 406px; overflow: hidden; min-height: 118px;">
                                    <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1"
                                        aria-activedescendant="bs-select-1-0"
                                        style="max-height: 406px; overflow-y: auto; min-height: 118px;">
                                        <ul class="dropdown-menu inner show" role="presentation"
                                            style="margin-top: 0px; margin-bottom: 0px;">
                                            <li class="selected active"><a role="option"
                                                    class="dropdown-item active selected" id="bs-select-1-0"
                                                    tabindex="0" aria-setsize="5" aria-posinset="1"
                                                    aria-selected="true"><span class="text">সকল</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <button id="btn-daak-toolbar-reset" class="btn btn-icon mx-1" type="button" data-toggle="tooltip" --}}
                        {{-- title="{{___('generic.buttons.title.reset')}}"> --}}
                        {{-- <span class="fas fa-recycle text-warning"></span> --}}
                        {{-- </button> --}}
                        {{-- <button id="btn-daak-toolbar-refresh" class="btn btn-icon mx-1" type="button" data-toggle="tooltip" --}}
                        {{-- title="{{___('generic.buttons.title.refresh')}}"> --}}
                        {{-- <span class="fa fa-sync text-info"></span> --}}
                        {{-- </button> --}}

                    </div>
                </div>
            </div>
            <div id="daak_pagination_panel" class="float-right d-flex align-items-center"
                style="vertical-align:middle;">
                <span class="mr-2"><span id="daak_item_length_start">১</span> - <span
                        id="daak_item_length_end">{{ enTobn(count($memo_list)) }}</span> সর্বমোট: <span
                        id="daak_item_total_record">{{ enTobn($memos['total']) }}</span></span>
                <div class="btn-group">
                    <button class="btn-list-prev btn btn-icon btn-secondary btn-square" disabled="disabled"
                        type="button"><i class="fad fa-chevron-left" data-toggle="popover" data-original-title=""
                            title="পূর্ববর্তী"></i></button>
                    <button class="btn-list-next btn btn-icon btn-secondary btn-square" type="button"
                        disabled="disabled"><i class="fad fa-chevron-right" data-toggle="popover" data-original-title=""
                            title="পরবর্তী"></i></button>
                </div>
            </div>
        </div>

        {{-- list view --}}
        <div>
            <ul class="list-group list-group-flush">
                @foreach ($memo_list as $memo)
                    <li class="list-group-item py-2 border-bottom">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="pr-2 flex-fill cursor-pointer position-relative">
                                <div class="row d-md-flex flex-wrap align-items-start justify-content-md-between">
                                    <!--begin::Title-->
                                    <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3 col-md-8">
                                        {{-- <div class="d-flex align-items-center flex-wrap  font-size-1-2"> --}}
                                        {{-- <span class="mr-1 ">{{___('generic.sr_no')}}</span> --}}
                                        {{-- <a href="javascript:void(0)" class="text-dark text-hover-primary font-size-h5"> --}}
                                        {{-- {{enTobn($loop->iteration)}} --}}
                                        {{-- </a> --}}
                                        {{-- </div> --}}
                                        <div class="d-flex align-items-center flex-wrap  font-size-1-2">
                                            <span class="mr-1 ">মেমো নংঃ</span>
                                            <a href="javascript:void(0)"
                                                class="text-dark text-hover-primary font-size-h5">
                                                {{ enTobn($memo['onucched_no']) }}
                                            </a>
                                        </div>
                                        <div class="font-weight-normal">
                                            <span class="mr-2 font-size-1-1">কস্ট সেন্টারঃ</span>
                                            <span class="font-size-14">
                                                {{ $memo['cost_center_name_bn'] }}
                                            </span>
                                            <span title="এনটিটি"
                                                class="label label-outline-primary label-pill label-inline">
                                                {{ $memo['parent_office_name_bn'] }}
                                            </span>
                                        </div>
                                        <div class="subject-wrapper font-weight-normal">
                                            <span class="mr-2 font-size-1-1">শিরোনামঃ</span>
                                            <span
                                                class="description text-wrap font-size-14">{{ $memo['memo_title_bn'] }}</span>
                                        </div>

                                        @if ($memo['memo_irregularity_type_name'] != 'N/A')
                                            <div class="font-weight-normal">
                                                <span class="mr-2 font-size-1-1">আপত্তি অনিয়মের ধরনঃ</span>
                                                <span class="font-size-14">
                                                    {{ $memo['memo_irregularity_type_name'] }}
                                                </span>
                                                {{-- <span class="label label-outline-danger label-pill label-inline">
                                                    {{$memo['memo_type_name']}}
                                                </span> --}}
                                            </div>
                                        @endif

                                        <div class=" subject-wrapper font-weight-normal">
                                            <span class="mr-2 font-size-1-1">জড়িত অর্থঃ</span>
                                            <span class="text-info font-size-14">
                                                {{ enTobn(currency_format($memo['jorito_ortho_poriman'])) }}
                                            </span>
                                        </div>
                                        <div class="font-weight-normal d-none predict-wrapper">
                                            <span class="predict-label text-success "></span>
                                        </div>
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Info-->
                                    <div class="d-flex align-items-center justify-content-md-end py-lg-0 py-2 col-md-4">
                                        <div class="d-block">
                                            <div
                                                class="d-md-flex flex-wrap mb-2 align-items-center justify-content-md-end text-nowrap">
                                                <div class="ml-3  d-flex align-items-center text-primary">
                                                    <i class="flaticon2-copy mr-2 text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-md-end">
                                                <div class="mb-2 mt-3 soongukto-wrapper">
                                                    <div class="d-flex justify-content-end align-items-center">
                                                        <div class="text-dark-75 ml-3 rdate" cspas="date">মেমো তারিখ :
                                                            {{ formatDate($memo['memo_date'], 'bn') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="action-group d-flex justify-content-end position-absolute action-group-wrapper">
                                                @if (count($memo['ac_memo_attachments']) > 0)
                                                    <button title="সংযুক্তি"
                                                        class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                                        style="width: 45px" type="button"
                                                        data-memo-id="{{ $memo['id'] }}"
                                                        data-memo-title-bn="{{ $memo['memo_title_bn'] }}"
                                                        onclick="Authority_Memo_Container.showMemoAttachment($(this))">
                                                        <i class="fal fa-paperclip" style="font-size:1.2rem"></i>
                                                        <span class="ml-1" style="color: #000">
                                                            {{ enTobn(count($memo['ac_memo_attachments'])) }}</span>
                                                    </button>
                                                @endif
                                                <button
                                                    class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                                    title="{{ ___('generic.buttons.title.details') }}"
                                                    data-memo-id="{{ $memo['id'] }}"
                                                    onclick="Authority_Memo_Container.showMemo($(this))">
                                                    <i class="fa fa-eye"></i>
                                                </button>

                                                <button
                                                    class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary
                                                list-btn-toggle"
                                                    title="{{ ___('generic.buttons.title.history') }}"
                                                    data-memo-id="{{ $memo['id'] }}"
                                                    onclick="Authority_Memo_Container.memoLog($(this))">
                                                    <i class="fas fa-repeat-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="pagination_ui">
                <div class="pagination">
                    @php
                        $current_page = $memos['current_page'];
                        $last_page = $memos['last_page'];
                        $prev_page = $memos['current_page'] - 1 < 1 ? 1 : $memos['current_page'] - 1;
                        $next_page = $memos['current_page'] + 1 > $memos['last_page'] ? $memos['last_page'] : $memos['current_page'] + 1;
                    @endphp
                    <ul>
                        <li class="page-item">
                            <a class="page-link" href="javascript:;"
                                onclick="Authority_Memo_Container.paginate($(this))" data-page={{ $prev_page }}>
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                        @if ($last_page <= 5)
                            @for ($i = 1; $i <= $memos['last_page']; $i++)
                                <li class="page-item {{ $memos['current_page'] == $i ? 'active' : '' }}">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" onclick="Authority_Memo_Container.paginate($(this))"
                                        data-page="{{ $i }}">{{ $i }}</a>
                                </li>
                            @endfor
                        @else
                            @if ($current_page < 5)
                                @for ($i = 1; $i < 6; $i++)
                                    <li class="page-item {{ $memos['current_page'] == $i ? 'active' : '' }}">
                                        <a class="page-link" data-current-page={{ $current_page }}
                                            href="javascript:;" onclick="Authority_Memo_Container.paginate($(this))"
                                            data-page="{{ $i }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" onclick="Authority_Memo_Container.paginate($(this))"
                                        data-page="{{ $last_page - 1 }}">{{ $last_page - 1 }}</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" onclick="Authority_Memo_Container.paginate($(this))"
                                        data-page="{{ $last_page }}">{{ $last_page }}</a>
                                </li>
                            @elseif ($current_page >= 5 && $current_page < $last_page - 5)
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" onclick="Authority_Memo_Container.paginate($(this))"
                                        data-page="1">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                                </li>
                                @for ($i = $current_page - 4; $i <= $current_page + 4; $i++)
                                    <li class="page-item {{ $memos['current_page'] == $i ? 'active' : '' }}">
                                        <a class="page-link" data-current-page={{ $current_page }}
                                            href="javascript:;" onclick="Authority_Memo_Container.paginate($(this))"
                                            data-page="{{ $i }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" onclick="Authority_Memo_Container.paginate($(this))"
                                        data-page="{{ $last_page }}">{{ $last_page }}</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" onclick="Authority_Memo_Container.paginate($(this))"
                                        data-page="1">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" onclick="Authority_Memo_Container.paginate($(this))"
                                        data-page="2">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                                </li>
                                @for ($i = $current_page - 4; $i <= $last_page; $i++)
                                    <li class="page-item {{ $memos['current_page'] == $i ? 'active' : '' }}">
                                        <a class="page-link" data-current-page={{ $current_page }}
                                            href="javascript:;" onclick="Authority_Memo_Container.paginate($(this))"
                                            data-page="{{ $i }}">{{ $i }}</a>
                                    </li>
                                @endfor
                            @endif
                        @endif
                        <li class="page-item">
                            <a class="page-link" href="javascript:;"
                                onclick="Authority_Memo_Container.paginate($(this))" data-page="{{ $next_page }}">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    @else
        <div class="alert alert-custom alert-light-primary fade show mb-5" role="alert">
            <div class="alert-icon">
                <i class="flaticon-warning"></i>
            </div>
            <div class="alert-text">{{ ___('generic.no_data_found') }}</div>
        </div>
    @endif
</div>
