<style>
    .jFiler-theme-default .jFiler-input{
        width: 329px!important;
    }
</style>
<link rel="stylesheet" href="{{asset('assets/css/mFiler-font.css')}}" referrerpolicy="origin">
<link rel="stylesheet" href="{{asset('assets/css/mFiler.css')}}" referrerpolicy="origin">


<form class="mb-4" id="report_create_form" enctype="multipart/form-data" autocomplete="off">
    <div class="card sna-card-border">
        <div class="row">
            <div class="col-md-8">
                <div class="d-flex justify-content-start">
                    <h5 class="mt-5"></h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex justify-content-end">
                    <a
                        class="btn btn-sm btn-warning btn_back btn-square mr-3">
                        <i class="fad fa-arrow-alt-left"></i> {{___('generic.back')}}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card sna-card-border mt-3 mb-15">
        <div class="mr-3 form-group row">
            <div class="col-md-2">
                <label for="audit_report_name" class="col-form-label">অডিট রিপোর্টের নাম:</label>
            </div>
            <div class="col-md-8">
                <input class="form-control" id="audit_report_name" name="audit_report_name" type="text">
            </div>
        </div>

        <div class="mr-3 form-group row">
            <div class="col-md-2">
                <label for="ortho_bochor" class="col-form-label">অর্থ-বছর:</label>
            </div>
            <div class="col-md-8">
                <input class="form-control" id="ortho_bochor" name="ortho_bochor" type="text">
            </div>
        </div>

        <div class="mr-3 form-group row">
            <div class="col-md-2">
                <label for="year_from" class="col-form-label">বছরের থেকে:</label>
            </div>
            <div class="col-md-8">
                <input class="year-picker form-control" id="year_from" name="year_from" type="text" autocomplete="off">
            </div>
        </div>

        <div class="mr-3 form-group row">
            <div class="col-md-2">
                <label for="year_to" class="col-form-label">বছরের পর্যন্ত:</label>
            </div>
            <div class="col-md-8">
                <input class="form-control year-picker" id="year_to" name="year_to" type="text" autocomplete="off">
            </div>
        </div>

        <div class="mr-3 form-group row">
            <div class="col-md-2">
                <label for="directorate_id" class="col-form-label">অডিট ডিরেক্টরেট সমূহ:</label>
            </div>
            <div class="col-md-4">
                <select class="form-select select-select2" id="directorate_id" name="directorate_id">
                    @foreach($directorates as $directorate)
                        <option value="{{$directorate['office_id']}}">{{$directorate['office_name_bn']}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mr-3 form-group row">
            <div class="col-md-2">
                <label for="ministry_id" class="col-form-label">মন্ত্রণালয়/বিভাগ:</label>
            </div>
            <div class="col-md-4">
                <select class="form-select select-select2" id="ministry_id" name="ministry_id">
                    <option value="">সবগুলো</option>
                </select>
            </div>
        </div>

        <div class="mr-3 form-group row">
            <div class="col-md-2">
                <label for="entity_id" class="col-form-label">এনটিটি:</label>
            </div>
            <div class="col-md-4">
                <select class="form-select select-select2" id="entity_id" name="entity_id">
                    <option value="">সবগুলো</option>
                </select>
            </div>
        </div>

        <div class="mr-3 form-group row">
            <div class="col-md-2">
                <label for="is_alochito" class="col-form-label">আলোচিত কি না?:</label>
            </div>
            <div class="col-md-4">
                <select class="form-select select-select2" id="is_alochito" name="is_alochito">
                    <option value="0">না</option>
                    <option value="1">হা</option>
                </select>
            </div>
        </div>

        <div class="mr-3 form-group row">
            <div class="col-md-2">
                <label class="col-form-label">কভার-পেজ:</label>
            </div>
            <div class="col-md-10">
                <input name="cover_page[]" type="file" class="mFilerInit form-control rounded-0">
            </div>
        </div>

        <div class="mr-3 form-group row">
            <div class="col-md-2">
                <label class="col-form-label">আপত্তি সমূহ:</label>
            </div>
            <div class="col-md-10">
                <input name="apottis[]" type="file" class="mFilerInit form-control rounded-0" multiple>
            </div>
        </div>

        <div class="mr-3 row">
            <div class="col-md-2">
                <a id="archive_report_submit" class="btn btn-primary btn-sm btn-bold btn-square"
                   href="javascript:;">
                    <i class="far fa-save mr-1"></i> {{___('generic.save')}}
                </a>
            </div>
        </div>
    </div>
</form>

<script src="{{asset('assets/js/mFiler.js')}}" type="text/javascript"></script>
<script>
    $(function () {
        directorate_id = $('#directorate_id').val();
        Archive_Apotti_Create_Container.loadDirectorateWiseMinistry(directorate_id);
    });

    //entity
    $('#ministry_id').change(function() {
        ministry_id = $('#ministry_id').val();
        Archive_Apotti_Common_Container.loadMinistryWiseEntity(ministry_id);
    });

    $(document).ready(function () {
        $('.mFilerInit').filer({
            showThumbs: true,
            addMore: true,
            allowDuplicates: false
        });

    });

    $('.btn_back').click(function (){
        backToList()
    })

    function backToList(){
        $('.apotti-validate a').click();
    }

    Archive_Apotti_Create_Container = {
        loadDirectorateWiseMinistry: function (directorate_id,ministry_id='') {
            let url = '{{route('audit.execution.archive-apotti.load-directorate-wise-ministry')}}';
            let data = {directorate_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data);
                    } else {
                        $('#ministry_id').html(response);
                        if (ministry_id != ""){
                            $("#ministry_id").val(ministry_id).trigger('change');
                        }
                    }
                }
            );
        },

        loadMinistryWiseEntity: function (ministry_id) {
            let url = '{{route('audit.execution.archive-apotti.load-ministry-wise-entity')}}';
            let data = {ministry_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data);
                    } else {
                        $('#entity_id').html(response);
                    }
                }
            );
        },
    }


    //for submit form
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#archive_report_submit').on('click', function (e) {
            e.preventDefault();

            from_data = new FormData(document.getElementById("report_create_form"));

            directorate_name = $("#directorate_id option:selected").text();
            from_data.append('directorate_name', directorate_name);

            ministry_name = $("#ministry_id option:selected").text();
            from_data.append('ministry_name', ministry_name);

            entity_name = $("#entity_id option:selected").text();
            from_data.append('entity_name', entity_name);

            $("#archive_report_submit").text('Loading....');

            elem = $(this);
            elem.prop('disabled', true);

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            $.ajax({
                data: from_data,
                url: '{{route('audit.execution.archive-apotti-report.store')}}',
                type: "POST",
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (responseData) {
                    KTApp.unblock('#kt_content');
                    $("#archive_report_submit").hide();
                    if (responseData.status === 'success') {
                        toastr.success(responseData.data);
                        $('.btn_back').click();
                    } else {
                        elem.prop('disabled', false);
                        if (responseData.statusCode === '422') {
                            var errors = responseData.msg;
                            $.each(errors, function (k, v) {
                                if (v !== '') {
                                    toastr.error(v);
                                }
                            });
                        } else {
                            toastr.error(responseData.data);
                        }
                    }
                },
                error: function (data) {
                    KTApp.unblock('#kt_content');
                    elem.prop('disabled', false)
                    if (data.responseJSON.errors) {
                        $.each(data.responseJSON.errors, function (k, v) {
                            if (isArray(v)) {
                                $.each(v, function (n, m) {
                                    toastr.error(m)
                                    console.log(m, n, v);
                                })
                            } else {
                                if (v !== '') {
                                    toastr.error(v);
                                }
                            }
                        });
                    }
                }
            });
        });
    });
</script>
