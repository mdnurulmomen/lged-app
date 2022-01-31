<x-title-wrapper>{{$qac_type == 'qac-1' ? 'QAC-1' : 'QAC-2'}} Committee</x-title-wrapper>
<input type="hidden" id="qac_type" value="{{$qac_type}}">
<div class="table-search-header-wrapper mb-4 pt-3 pb-3 shadow-sm">
    <div class="col-xl-12">
        <div class="row mt-2 mb-2">
            <div class="col-md-3">
                <select class="form-select select-select2" id="fiscal_year_id">
                    @foreach($fiscal_years as $fiscal_year)
                        <option
                            value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['end']?'selected':''}}>{{$fiscal_year['description']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

<div class="card card-custom card-stretch">
    <div class="card-body p-0">
        <div id="load_committee_list"></div>
    </div>
</div>


<script>
    $(function () {
        Qac_Committee_Container.loadCommittee();

    });

    var Qac_Committee_Container = {
        loadCommittee: function () {
            fiscal_year_id = $('#fiscal_year_id').val();
            qac_type = $('#qac_type').val();
            let url = '{{route('audit.qac.qac-committee-list')}}';
            let data = {fiscal_year_id,qac_type};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#load_committee_list').html(response);
                    }
                }
            );
        },
        createCommittee: function (element) {
            url = '{{route('audit.qac.create-qac-committee')}}'
            data = {};

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
                    quick_panel.css('width', '80%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        submitQacCommittee: function (elem) {

            fiscal_year_id = $('#fiscal_year_id').val();
            qac_type = $('#qac_type').val();

            url = '{{route('audit.qac.store-qac-committee')}}';

            data = $('#qac_committee_form').serializeArray();

            member_info = {}

            $(".selected_member").each(function () {
                member_data = JSON.parse($(this).val());

                member_info[member_data.officer_id] = {
                    officer_id: member_data.officer_id,
                    officer_bn: member_data.officer_bn,
                    officer_en: member_data.officer_en,
                    officer_unit_id: member_data.officer_unit_id,
                    officer_unit_bn: member_data.officer_unit_bn,
                    officer_unit_en: member_data.officer_unit_en,
                    officer_designation_grade: member_data.officer_designation_grade,
                    officer_designation_id: member_data.officer_designation_id,
                    officer_designation_bn: member_data.officer_designation_bn,
                    officer_designation_en: member_data.officer_designation_en,
                }
            });

            member_info = JSON.stringify(member_info);

            data.push({name: "member_info", value: member_info});
            data.push({name: "fiscal_year_id", value: fiscal_year_id});
            data.push({name: "qac_type", value: qac_type});

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {
                    toastr.success(response.data);
                    $('#kt_quick_panel_close').click();
                    Qac_Committee_Container.loadCommittee();
                } else {
                    if (response.statusCode === '422') {
                        var errors = response.msg;
                        $.each(errors, function (k, v) {
                            if (v !== '') {
                                toastr.error(v);
                            }
                        });
                    } else {
                        toastr.error(response.data.message);
                    }
                }
            })
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

        editApotti: function (element){
            apotti_id = element.data('apotti-id');
            data = {apotti_id};
            let url = '{{route('audit.execution.apotti.edit-apotti')}}'
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $("#kt_content").html(response);
                }
            });
        },
    };


</script>
