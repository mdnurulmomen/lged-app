<div class="card sna-card-border mt-2 mb-14">
    @if (!empty($memo_list))
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
                                                        onclick="Apotti_Memo_Container.showMemoAttachment($(this))">
                                                        <i class="fal fa-paperclip" style="font-size:1.2rem"></i>
                                                        <span class="ml-1" style="color: #000">
                                                            {{ enTobn(count($memo['ac_memo_attachments'])) }}</span>
                                                    </button>
                                                @endif

                                                @if($memo['has_convert_to_apotti'] == 0)
                                                    <button
                                                        class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                                        title="অনুচ্ছেদে রুপান্তর করুন"
                                                        data-memo-id="{{ $memo['id'] }}"
                                                        onclick="Apotti_Memo_Container.editMemo($(this))">
                                                        <i class="fas fa-exchange"></i>
                                                    </button>
                                                @endif

                                                <button
                                                    class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                                    title="{{ ___('generic.buttons.title.details') }}"
                                                    data-memo-id="{{ $memo['id'] }}"
                                                    onclick="Apotti_Memo_Container.showMemo($(this))">
                                                    <i class="fa fa-eye"></i>
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
                                onclick="Apotti_Memo_Container.paginate($(this))" data-page={{ $prev_page }}>
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                        @if ($last_page <= 5)
                            @for ($i = 1; $i <= $memos['last_page']; $i++)
                                <li class="page-item {{ $memos['current_page'] == $i ? 'active' : '' }}">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" onclick="Apotti_Memo_Container.paginate($(this))"
                                        data-page="{{ $i }}">{{ $i }}</a>
                                </li>
                            @endfor
                        @else
                            @if ($current_page < 5)
                                @for ($i = 1; $i < 6; $i++)
                                    <li class="page-item {{ $memos['current_page'] == $i ? 'active' : '' }}">
                                        <a class="page-link" data-current-page={{ $current_page }}
                                            href="javascript:;" onclick="Apotti_Memo_Container.paginate($(this))"
                                            data-page="{{ $i }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" onclick="Apotti_Memo_Container.paginate($(this))"
                                        data-page="{{ $last_page - 1 }}">{{ $last_page - 1 }}</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" onclick="Apotti_Memo_Container.paginate($(this))"
                                        data-page="{{ $last_page }}">{{ $last_page }}</a>
                                </li>
                            @elseif ($current_page >= 5 && $current_page < $last_page - 5)
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" onclick="Apotti_Memo_Container.paginate($(this))"
                                        data-page="1">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                                </li>
                                @for ($i = $current_page - 4; $i <= $current_page + 4; $i++)
                                    <li class="page-item {{ $memos['current_page'] == $i ? 'active' : '' }}">
                                        <a class="page-link" data-current-page={{ $current_page }}
                                            href="javascript:;" onclick="Apotti_Memo_Container.paginate($(this))"
                                            data-page="{{ $i }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" onclick="Apotti_Memo_Container.paginate($(this))"
                                        data-page="{{ $last_page }}">{{ $last_page }}</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" onclick="Apotti_Memo_Container.paginate($(this))"
                                        data-page="1">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" onclick="Apotti_Memo_Container.paginate($(this))"
                                        data-page="2">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                        href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                                </li>
                                @for ($i = $current_page - 4; $i <= $last_page; $i++)
                                    <li class="page-item {{ $memos['current_page'] == $i ? 'active' : '' }}">
                                        <a class="page-link" data-current-page={{ $current_page }}
                                            href="javascript:;" onclick="Apotti_Memo_Container.paginate($(this))"
                                            data-page="{{ $i }}">{{ $i }}</a>
                                    </li>
                                @endfor
                            @endif
                        @endif
                        <li class="page-item">
                            <a class="page-link" href="javascript:;"
                                onclick="Apotti_Memo_Container.paginate($(this))" data-page="{{ $next_page }}">
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
