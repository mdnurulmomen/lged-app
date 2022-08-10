<x-title-wrapper>তালিকা</x-title-wrapper>
<div class="card sna-card-border d-flex flex-wrap flex-row">
    <div class="col-xl-12">
        <div class="row mt-2 mb-2">
            <div class="col-md-3">
                <select class="form-select select-select2" id="directorate_filter">
                    @if(count($directorates) > 1)
                        <option value="all"> অধিদপ্তর বাছাই করুন</option>
                    @endif
                    @foreach($directorates as $directorate)
                        <option data-directorate-en="{{$directorate['office_name_en']}}" value="{{$directorate['office_id']}}">{{$directorate['office_name_bn']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select select-select2" id="fiscal_year_id">
                    @foreach($fiscal_years as $fiscal_year)
                        <option
                            value="{{$fiscal_year['id']}}" {{$fiscal_year['is_current'] == 1?'selected':''}}>{{enTobn($fiscal_year['description'])}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select select-select2" id="ministry_id">
                    <option value="">মন্ত্রণালয় বাছাই করুন</option>
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select select-select2" id="entity_id">
                    <option value="">এনটিটি বাছাই করুন</option>
                </select>
            </div>
        </div>

        <div class="row mt-2 mb-2">
            <div class="col-md-3">
                <select class="form-select select-select2" id="memo_type">
                    <option value="">ক্যাটাগরি বাছাই করুন</option>
                    <option value="sfi"> এসএফআই </option>
                    <option value="non-sfi">নন-এসএফআই</option>
                </select>
            </div>

            <div class="col-md-6">
                <input type="text" id="memo_title_bn" class="form-control" placeholder="শিরোনাম লিখুন...">
            </div>

            <div class="col-md-3">
                <button onclick="Rpu_Apotti_Container.loadRpuApottiItem()" class="mt-2 btn btn-sm btn-primary btn-square" type="button">
                    <i class="fad fa-search"></i> অনুসন্ধান
                </button>
            </div>
        </div>
    </div>
</div>

<div class="card sna-card-border mt-2 mb-15">
    <div id="load_rpu_apotti_item">
        <div class="alert alert-custom alert-light-primary fade show mb-5" role="alert">
            <div class="alert-icon">
                <i class="flaticon-warning"></i>
            </div>
            <div class="alert-text">অনুসন্ধান করুন</div>
        </div>
    </div>
</div>


<script>

    $(function () {
        Rpu_Apotti_Container.loadDirectorateWiseMinstry();
        Rpu_Apotti_Container.loadRpuApottiItem();
    });

    $('#ministry_id').change(function (){
        Rpu_Apotti_Container.loadMinistryWiseEntity();
    });

    $('#directorate_filter').change(function (){
        Rpu_Apotti_Container.loadDirectorateWiseMinstry();
    });


    var Rpu_Apotti_Container = {
        loadDirectorateWiseMinstry: function () {
            directorate_id = $('#directorate_filter').val();
            let url = '{{route('mis_and_dashboard.directorate_wise_ministry')}}';
            let data = {directorate_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#ministry_id').html(response);
                    }
                }
            );
        },

        loadMinistryWiseEntity: function () {
            directorate_id = $('#directorate_filter').val();
            ministry_id = $('#ministry_id').val();
            let url = '{{route('rpu-apotti.get-ministry-wise-entity-select')}}';
            let data = {directorate_id,ministry_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#entity_id').html(response);
                    }
                }
            );
        },

        loadRpuApottiItem: function (){
            directorate_id = $('#directorate_filter').val();
            fiscal_year_id = $('#fiscal_year_id').val();
            ministry_id = $('#ministry_id').val();
            entity_id = $('#entity_id').val();
            memo_type = $('#memo_type').val();
            memo_title_bn = $('#memo_title_bn').val();

            let url = '{{route('rpu-apotti.get-rpu-apotti-item')}}';
            let data = {directorate_id,fiscal_year_id,ministry_id,entity_id,memo_type,memo_title_bn};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    KTApp.unblock('#kt_wrapper');
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#load_rpu_apotti_item').html(response);
                    }
                }
            );
        },

        loadApottiResponseForm: function (elem){
            directorate_id = $('#directorate_filter').val();
            apotti_item_id = elem.data('apotti-item-id');
            apotti_title_bn = elem.data('apotti-title-bn');

            let url = '{{route('rpu-apotti.get-rpu-apotti-response-form')}}';
            let data = {directorate_id,apotti_item_id,apotti_title_bn};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $(".offcanvas-title").text('জবাব');
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

        rpuResponseSubmit: function (){
            data = $('#apoitti_response_form').serializeArray();
            let url = '{{route('rpu-apotti.rpu-response-submit')}}';

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    KTApp.unblock('#kt_wrapper');
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        toastr.success(response.data)
                        $('#kt_quick_panel_close').click();
                        memo_type = $('#memo_type').val();
                        $('#memo_type').val(memo_type).trigger('change');

                    }
                }
            );
        },

        sendToDirectorateForm: function (){
            apottis = [];
            $(".select-apotti").each(function (i, value) {
                if ($(this).is(':checked') && !$(this).is(':disabled')) {
                    apottis.push($(this).val());
                }
            });

            if (apottis.length == 0) {
                toastr.warning('Please Select Apotti');
                return;
            }

            directorate_id = $('#directorate_filter').val();
            data = {directorate_id,apottis}
            let url = '{{route('rpu-apotti.rpu-broad-sheet-form')}}';

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $(".offcanvas-title").text('জবাব');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '50%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
                }
            );
        },

        rpuBroadSheetSubmit: function (){
            data = $('#broad_sheet_form').serializeArray();
            let url = '{{route('rpu-apotti.rpu-broad-sheet-submit')}}';

            memo_type = $('#memo_type').val();

            sender_type = memo_type == 'sfi' ? 'ministry' : 'entity';

            directorate_id = $('#directorate_filter').val();
            directorate_en = $('#directorate_filter').find(':selected').data('directorate-en');
            directorate_bn = $('#directorate_filter').find(':selected').text();

            ministry_id = $('#ministry_id').val();
            ministry_en = $('#ministry_id').find(':selected').data('ministry-en');
            ministry_bn = $('#ministry_id').find(':selected').text();

            entity_id = $('#entity_id').val();
            entity_en = $('#entity_id').find(':selected').data('entity-en');
            entity_bn = $('#entity_id').find(':selected').text();

            data.push({name: "directorate_id", value: directorate_id});
            data.push({name: "directorate_en", value: directorate_en});
            data.push({name: "directorate_bn", value: directorate_bn});

            data.push({name: "ministry_id", value: ministry_id});
            data.push({name: "ministry_en", value: ministry_en});
            data.push({name: "ministry_bn", value: ministry_bn});

            data.push({name: "entity_id", value: entity_id});
            data.push({name: "entity_en", value: entity_en});
            data.push({name: "entity_bn", value: entity_bn});

            data.push({name: "memo_type", value: memo_type});
            data.push({name: "sender_type", value: sender_type});

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    KTApp.unblock('#kt_wrapper');
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        toastr.success(response.data)
                        $('#kt_quick_panel_close').click();

                    }
                }
            );
        },
    };
</script>
