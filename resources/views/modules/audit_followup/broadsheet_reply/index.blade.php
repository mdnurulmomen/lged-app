{{--<x-title-wrapper>জবাব</x-title-wrapper>--}}

<div class="card sna-card-border d-flex flex-wrap flex-row">
    <div class="col-xl-12">
        <div class="row mt-2 mb-2">
            <div class="col-md-3">
                <select class="form-select select-select2" id="directorate_filter">
                    @if(count($directorates) > 1)
                        <option value="all"> অধিদপ্তর বাছাই করুন</option>
                    @endif
                    @foreach($directorates as $directorate)
                        <option value="{{$directorate['office_id']}}">{{$directorate['office_name_bn']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select select-select2" id="ministry_id">
                    <option value="">মন্ত্রণালয় বাছাই করুন</option>
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select select-select2" id="entity_id">
                    <option value="">এনটিটি/সংস্থা  বাছাই করুন</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="card sna-card-border mt-2 mb-15">
    <div id="load_apotti_item_list"></div>
</div>

<script>

    $('#directorate_filter').change(function () {
        Broadsheet_Container.loadBroadSheetList();
    });

    $('#ministry_id').change(function () {
        Broadsheet_Container.laodEntityList();
        Broadsheet_Container.loadBroadSheetList();
    });

    $('#entity_id').change(function () {
        Broadsheet_Container.loadBroadSheetList();
    });

    $(function (){
        office_id = $('#directorate_filter').val();
        if(office_id == 'all'){
            toastr.warning('অধিদপ্তর বাছাই করুন');
        }else{
            Broadsheet_Container.loadBroadSheetList();
            Broadsheet_Container.laodBraodsheetMinistry();
        }

    });

    var Broadsheet_Container = {
        loadBroadSheetList: function (page = 1, per_page = 10) {
            office_id = $('#directorate_filter').val();
            ministry_id = $('#ministry_id').val();
            entity_id = $('#entity_id').val();
            let url = '{{route('audit.followup.broadsheet.reply.get-broad-sheet-list')}}';
            let data = {page, per_page, office_id,ministry_id,entity_id};
            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#load_apotti_item_list').html(response);
                }
            });

        },

        laodBraodsheetMinistry: function () {
            office_id = $('#directorate_filter').val();
            let url = '{{route('audit.followup.broadsheet.reply.load-broad-sheet-ministry-select')}}';
            let data = {office_id};
            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#ministry_id').html(response);
                }
            });

        },

        laodEntityList: function () {
            office_id = $('#directorate_filter').val();
            ministry_id = $('#ministry_id').val();
            let url = '{{route('audit.followup.broadsheet.reply.load-broad-sheet-entity-select')}}';
            let data = {office_id,ministry_id};
            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#entity_id').html(response);
                }
            });

        },

        showMemo: function (element) {
            url = '{{route('audit.execution.memo.show')}}'
            memo_id = element.data('memo-id');
            data = {memo_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('মেমো');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '40%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        showMemoAttachment: function (element) {
            url = '{{route('audit.execution.memo.show-attachment')}}'
            memo_id = element.data('memo-id');
            memo_title_bn = element.data('memo-title-bn');
            data = {memo_id,memo_title_bn};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('সংযুক্তি সমূহ');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '40%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },
    };
</script>
