<x-title-wrapper>{{$apotti_type == 'sfi' ? 'SFI Register' : 'Non SFI Register'}}</x-title-wrapper>
<div class="card sna-card-border">
    <div class="col-xl-12">
        <div class="row mt-2 mb-2">
            <div class="col-md-3">
                <select class="form-select select-select2" id="directorate_id">
                    @if(count($directorates) > 1)
                        <option value="all">Select Directorate</option>
                    @endif
                    @foreach($directorates as $directorate)
                        <option value="{{$directorate['office_id']}}">{{$directorate['office_name_bn']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select select-select2" id="fiscal_year_id">
                    @foreach($fiscal_years as $fiscal_year)
                        <option
                            value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['end']?'selected':''}}>{{enTobn($fiscal_year['description'])}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <input autocomplete="off" type="text" id="start_date" class="date form-control" placeholder="রিভিউ শুরুর তারিখ">
            </div>

            <div class="col-md-3">
                <input autocomplete="off" type="text" id="end_date" class="date form-control" placeholder="রিভিউ শেষের তারিখ">
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <button id="btn_filter" class="btn btn-sm btn-primary btn-square" type="button">
                    <i class="fad fa-search"></i> অনুসন্ধান
                </button>
            </div>
        </div>
    </div>
</div>


<div class="card sna-card-border mt-2">
    <div id="load_apotti_list">
        <div class="d-flex align-items-center">
            <div class="spinner-grow text-warning mr-3" role="status">
                <span class="sr-only"></span>
            </div>
            <div>
                loading.....
            </div>
        </div>
    </div>
</div>


<script>
    $(function () {
        Apotti_Register_Container.loadApottiList();
    });

    var Apotti_Register_Container = {
        loadApottiList: function () {

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            directorate_id = $('#directorate_id').val();
            fiscal_year_id = $('#fiscal_year_id').val();
            apotti_type = '{{$apotti_type}}';
            start_date = $('#start_date').val();
            end_date = $('#end_date').val();

            let url = '{{route('audit.execution.apotti.load-apotti-register-list')}}';
            let data = {directorate_id,fiscal_year_id,apotti_type,start_date,end_date};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    KTApp.unblock('#kt_content');
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#load_apotti_list').html(response);
                    }
                }
            );
        },

        showApotti: function (element) {
            url = '{{route('audit.execution.apotti.onucched-show')}}'
            apotti_id = element.data('apotti-id');
            data = {apotti_id};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('বিস্তারিত');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '60%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        loadApotiEdit: function (element) {
            url = '{{route('audit.execution.apotti.edit-register')}}'
            apotti_id = element.data('apotti-id');
            data = {apotti_id};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '50%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        updateApotti: function (elem) {
            url = '{{route('audit.execution.apotti.register.update')}}';
            apotti_id = elem.data('apotti-id');
            apotti_type = $("#apotti_type").val();
            comments = $("#comments").val();
            data = {apotti_id,apotti_type,comments};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'success') {
                    toastr.success('{{___('generic.sent_successfully')}}');
                    $('#kt_quick_panel_close').click();
                }
                else {
                    toastr.error(response.data.message);
                }
            })
        },

        loadApprovalAuthority: function (elem) {
            url = '{{route('audit.execution.apotti.register.get-approval-authority')}}';
            apotti_id = elem.data('apotti-id');
            data = {apotti_id};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('');
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

        storeApprovalAuthority: function () {
            url = '{{route('audit.execution.apotti.register.store-approval-authority')}}';
            data = $('#approval_authority_form').serializeArray();
            //data.push({name: "office_id", value: office_id});

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'success') {
                    toastr.success('{{___('generic.sent_successfully')}}');
                    $('#kt_quick_panel_close').click();
                    $(".load_approval_authority").hide();
                    Apotti_Register_Container.loadApottiList();
                }
                else {
                    toastr.error(response.data.message);
                }
            })
        },
    };

    $('#btn_filter').click(function () {
        directorate_id = $('#directorate_id').val();
        if (directorate_id !== 'all') {
            Apotti_Register_Container.loadApottiList();
        } else {
            toastr.info('Please select a directorate.')
        }
    });
</script>
