<x-title-wrapper>Audit Report Apotti Map</x-title-wrapper>

<div class="card sna-card-border d-flex flex-wrap flex-row">
    <form id="report_apotti_map_form">
        <div class="col-xl-12">
            <div class="row mt-2">
                <div class="col-md-12">
                    <label for="directorate_id" class="col-form-label">অডিট ডিরেক্টরেট সমূহ</label>
                    <select class="form-select select-select2" id="directorate_id" name="directorate_id" style="width: 100%">
                        @foreach($directorates as $directorate)
                            <option value="{{$directorate['office_id']}}">{{$directorate['office_name_bn']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <label for="r_air_id" class="col-form-label">Audit Report</label>
                    <select class="form-select select-select2" id="r_air_id" name="r_air_id" style="width: 100%">
                        <option value="">--Select--</option>
                    </select>
                </div>
            </div>

            <div class="mt-4" id="load_apotti_list"></div>

            <div class="mt-2 row">
                <div class="col-md-12">
                    <button onclick="Final_Report_Apotti_Map_Container.store()"
                            class="btn btn-sm btn-primary btn-square" type="button">
                        <i class="fad fa-save"></i> Save
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>


<script>
    $(function () {
        directorate_id = $('#directorate_id').val();
        Final_Report_Apotti_Map_Container.loadDirectorateWiseRAir(directorate_id);
        Final_Report_Apotti_Map_Container.loadApottiList(directorate_id);
    });

    var Final_Report_Apotti_Map_Container = {
        store: function () {
            let url = '{{route('audit.final-report.map-archive-final-report-apotti')}}';
            data = $('#report_apotti_map_form').serialize();

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'success') {
                    toastr.success('Successfully Added!');
                    $('.final-report-apotii-map').click();
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

        loadDirectorateWiseRAir: function (directorate_id) {
            let url = '{{route('audit.final-report.get-directorate-wise-final-report')}}';
            let data = {directorate_id};
            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.warning(response.data);
                } else {
                    $('#r_air_id').html(response);
                }
            });
        },

        loadApottiList: function (directorate_id) {
            let url = '{{route('audit.final-report.get-archive-final-report-apotti')}}';
            let data = {directorate_id};
            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.warning(response.data);
                } else {
                    $('#load_apotti_list').html(response);
                }
            });
        },
    };

    //directorate_id
    $('#directorate_id').change(function () {
        directorate_id = $('#directorate_id').val();
        Final_Report_Apotti_Map_Container.loadDirectorateWiseRAir(directorate_id);
        Final_Report_Apotti_Map_Container.loadApottiList(directorate_id);
    });
</script>
