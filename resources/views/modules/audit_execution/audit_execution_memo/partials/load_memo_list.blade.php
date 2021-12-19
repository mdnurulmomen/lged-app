@if(!empty($memo_list['data']))
    <div class="search-all position-relative">
        <div class="row">
            <div class="col align-self-start">
                <div class="input-group-append">
                    <button class="btn btn-icon btn-light-info btn-square advanced_button" type="button"><i
                            class="fa fa-caret-down"></i>
                    </button>
                    <input type="text" placeholder="{{___('generic.placeholders.search')}}" class="form-control rounded-0">
                    <button data-toggle="tooltip" data-placement="left" title="{{___('generic.buttons.title.search')}}"
                            class="btn btn-icon btn-light-success btn-square" type="button">
                        <i class="fad fa-search"></i>
                    </button>
                    <button data-toggle="tooltip" data-placement="left" title="{{___('generic.buttons.title.reset')}}"
                            class="btn btn-icon btn-light-danger btn-square" id="reset_btn" type="reset">
                        <i class="fad fa-recycle"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="toolbar flex-wrap justify-content-between shadow-sm p-0 d-flex border-bottom">
        <div class="d-flex">
            <div id="daak_group_action_panel">
                <div class="d-flex flex-wrap">
                    <div class="btn-group">
                   <span class="input-group-text bg-transparent border-0 inbox_checkbox" data-toggle="popover">
                       <label id="selectAllLabel" class="checkbox" for="selectAll">
                       <input type="checkbox" id="selectAll">
                       <span></span>
                   </label>
                   </span>
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
                            <div class="dropdown-menu " style="max-height: 406px; overflow: hidden; min-height: 118px;">
                                <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1"
                                     aria-activedescendant="bs-select-1-0"
                                     style="max-height: 406px; overflow-y: auto; min-height: 118px;">
                                    <ul class="dropdown-menu inner show" role="presentation"
                                        style="margin-top: 0px; margin-bottom: 0px;">
                                        <li class="selected active"><a role="option"
                                                                       class="dropdown-item active selected"
                                                                       id="bs-select-1-0" tabindex="0" aria-setsize="5"
                                                                       aria-posinset="1" aria-selected="true"><span
                                                    class="text">সকল</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button id="btn-daak-toolbar-reset" class="btn btn-icon mx-1" type="button" data-toggle="tooltip"
                            title="{{___('generic.buttons.title.reset')}}">
                        <span class="fas fa-recycle text-warning"></span>
                    </button>
                    <button id="btn-daak-toolbar-refresh" class="btn btn-icon mx-1" type="button" data-toggle="tooltip"
                            title="{{___('generic.buttons.title.refresh')}}">
                        <span class="fa fa-sync text-info"></span>
                    </button>
                    <div id="personal_folder_selected_name" class="p-2 d-none">
                    </div>
                </div>
            </div>
        </div>
        <div id="daak_pagination_panel" class="float-right d-flex align-items-center" style="vertical-align:middle;">
                <span class="mr-2"><span id="daak_item_length_start">১</span> - <span id="daak_item_length_end">৫</span> সর্বমোট: <span
                        id="daak_item_total_record">৫</span></span>
            <div class="btn-group">
                <button class="btn-list-prev btn btn-icon btn-secondary btn-square" disabled="disabled" type="button"><i
                        class="fad fa-chevron-left" data-toggle="popover"
                        data-original-title="" title="পূর্ববর্তী"></i></button>
                <button class="btn-list-next btn btn-icon btn-secondary btn-square" type="button" disabled="disabled"><i
                        class="fad fa-chevron-right" data-toggle="popover" data-original-title=""
                        title="পরবর্তী"></i></button>
            </div>
        </div>
    </div>

    {{--list view--}}
    <div>
        <ul class="list-group list-group-flush">
            @foreach($memo_list['data'] as $memo)
                <li class="list-group-item pl-0 py-2 border-bottom">
                    <div class="d-flex justify-content-between align-items-start">
                       <span class="input-group-text bg-transparent border-0">
                          <label class="checkbox {{$memo['has_sent_to_rpu'] == 1?'checkbox-disabled':''}}">
                              <input type="checkbox"  data-cost-center-id="{{$memo['cost_center_id']}}"
                                     {{$memo['has_sent_to_rpu'] == 1?'checked disabled':''}}
                                     value="{{$memo['id']}}" class="select-memo">
                                <span></span>
                          </label>
                       </span>
                        <div class="pr-2 flex-fill cursor-pointer position-relative">
                            <div class="row d-md-flex flex-wrap align-items-start justify-content-md-between">
                                <!--begin::Title-->
                                <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3 col-md-8">
                                    <div class="d-flex align-items-center flex-wrap  font-size-1-2">
                                        <span class="mr-1 ">{{___('generic.list_views.conducting.memo.memo_no')}}: </span>
                                        <a href="javascript:void(0)" class="text-dark text-hover-primary font-size-h5">
                                            {{enTobn($memo['onucched_no'])}}
                                        </a>
                                    </div>
                                    <div class="subject-wrapper font-weight-normal">
                                        <span class="mr-2 font-size-1-1">{{___('generic.list_views.conducting.memo.audit_title')}}:</span>
                                        <span class="description text-info text-wrap font-size-14">{{$memo['memo_title_bn']}}</span>
                                    </div>
                                    <div class="font-weight-normal">
                                        <span class="mr-2 font-size-1-1">{{___('generic.list_views.conducting.memo.memo_irregularity_type')}}:</span>
                                        <span class="font-size-14">
                                            {{$memo['memo_irregularity_type_name']}}
                                        </span>
                                        <span class="label label-outline-warning label-pill label-inline">
                                            {{$memo['memo_type_name']}}
                                        </span>
                                    </div>
                                    <div class=" subject-wrapper font-weight-normal">
                                        <span class="mr-2 font-size-1-1">{{___('generic.list_views.conducting.memo.jorito_ortho')}}:</span>
                                        <span class="text-info font-size-14">
                                            {{enTobn(number_format($memo['jorito_ortho_poriman'],0))}}
                                        </span>
                                    </div>
                                    {{--<div class="font-weight-normal">
                                        <span class="mr-2 font-size-1-1">{{___('generic.list_views.conducting.memo.onishponno_jorito_ortho')}}:</span>
                                        <span class="text-danger font-size-14">
                                           {{enTobn(number_format($memo['onishponno_jorito_ortho_poriman'],0))}}
                                        </span>
                                    </div>--}}
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
                                                    @if(count($memo['ac_memo_attachments']) >0)
                                                        <button class="btn-attachment btn btn-outline-warning btn-sm" type="button"
                                                                data-memo-id="{{$memo['id']}}"
                                                                data-memo-title-bn="{{$memo['memo_title_bn']}}"
                                                                onclick="Memo_List_Container.showMemoAttachment($(this))">
                                                            <i class="fal fa-link" style="font-size:11px"></i>
                                                            <span class="text-danger">{{enTobn(count($memo['ac_memo_attachments']))}}</span>
                                                        </button>
                                                    @endif
                                                    <div class="text-dark-75 ml-3 rdate" cspas="date">{{formatDateTime($memo['created_at'],'bn')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="action-group d-flex justify-content-end position-absolute action-group-wrapper">
                                            <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                                title="{{___('generic.buttons.title.details')}}" data-memo-id="{{$memo['id']}}"
                                                    onclick="Memo_List_Container.showMemo($(this))">
                                                <i class="fad fa-eye"></i>
                                            </button>

                                            <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                                    title="{{___('generic.buttons.title.edit')}}" data-memo-id="{{$memo['id']}}"
                                                    onclick="Memo_List_Container.editMemo($(this))">
                                                <i class="fad fa-edit"></i>
                                            </button>

                                            <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary
                                            list-btn-toggle"
                                                    title="{{___('generic.buttons.title.history')}}" data-memo-id="{{$memo['id']}}"
                                                    onclick="Memo_List_Container.memoLog($(this))">
                                                <i class="fad fa-repeat-alt"></i>
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
    </div>

    <script>
        $(function (){
            $('.select-memo').each(function(){
                if(this.checked == false){
                    $("#selectAll")[0].checked = false;
                }
                if ($('.select-memo:checked').length == $('.select-memo').length ){
                    $("#selectAll")[0].checked = true;
                    $("#selectAll")[0].disabled = true;
                    $("#selectAll")[0].addClass('checkbox-disabled');
                }
            });
        })

        //select all checkboxes
        $("#selectAll").change(function(){
            var status = this.checked;
            $('.select-memo').each(function(){
                if (!$(this).is(':disabled')) {
                    this.checked = status;
                }
            });
        });

        $('.select-memo').change(function(){
            if(this.checked == false){
                $("#selectAll")[0].checked = false;
            }

            if ($('.select-memo:checked').length == $('.select-memo').length ){
                $("#selectAll")[0].checked = true;
                $("#selectAll")[0].addClass('checkbox-disabled');
            }
        });
    </script>

@else
    <div class="alert alert-custom alert-light-primary fade show mb-5" role="alert">
        <div class="alert-icon">
            <i class="flaticon-warning"></i>
        </div>
        <div class="alert-text">{{___('generic.no_data_found')}}</div>
    </div>
@endif
