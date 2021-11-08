<style>
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
        box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
</style>

<form id="query_add_form" autocomplete="off">
    <input type="hidden" name="schedule_id" value="{{$schedule_id}}">
    <div class="row p-4">
        <div class="col-md-8">
            <div class="d-flex justify-content-start">
                <h5 class="mt-5">{{$cost_center_name_bn}} (অর্থবছর : ২০২১-২০২২)</h5>
            </div>
        </div>

        <div class="col-md-4">
            <div class="d-flex justify-content-end">
                <a id="memo_submit" class="btn btn-success btn-sm btn-bold btn-square"
                   onclick="Query_Create_Container.saveAuditQuery()"
                   href="javascript:;">
                    <i class="far fa-save mr-1"></i> Save
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card-body pt-0 pb-3">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="memorandum_no">স্মারক নং <span class="text-danger">*</span></label>
                                        <input type="text" id="memorandum_no" name="memorandum_no" class="form-control" placeholder="স্মারক নং">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="memorandum_date">স্মারক তারিখ <span class="text-danger">*</span></label>
                                        <input type="text" id="memorandum_date" name="memorandum_date" class="date form-control" placeholder="স্মারক তারিখ">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rpu_office_head_details">বরাবর <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="rpu_office_head_details" name="rpu_office_head_details" cols="30" rows="2"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="subject">বিষয় <span class="text-danger">*</span></label>
                                <input type="text" id="subject" class="form-control" name="subject" placeholder="বিষয়">
                            </div>

                            <div class="form-group">
                                <label for="description">বিস্তারিত</label>
                                <textarea class="form-control" id="description" name="description" cols="30" rows="4"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset class="scheduler-border">
                                        <legend class="scheduler-border">
                                            কোয়েরিসমূহ
                                        </legend>
                                        <table width="100%" class="table table-bordered table-striped table-hover table-condensed table-sm" id="tblQueryList">
                                            <tbody>
                                            <tr>
                                                <td width="82%">
                                                    <input class="form-control" type="text" name="audit_query_items[]">
                                                </td>
                                                <td class="pt-2">
                                                    <button title="যোগ করুন" type='button' class='btn btn-outline-primary btn-sm btn-square'
                                                            onclick="Query_Create_Container.addQueryItem()">
                                                        <span class='fa fa-plus'></span>
                                                    </button>
                                                    <button title="মুছে ফেলুন" type='button' class='btn btn-outline-danger btn-sm btn-square'
                                                            onclick="Query_Create_Container.removeQueryItem($(this))">
                                                        <span class='fa fa-trash'></span>
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cc">অনুলিপি</label>
                                <textarea class="form-control" id="cc" name="cc" cols="30" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <label for="">কস্ট সেন্টার টাইপ</label>
                                    <select name="cost_center_type_id" id="cost_center_type" class="form-control">
                                        <option value="">---সিলেক্ট---</option>
                                        @foreach($cost_center_types as $key => $type)
                                            <option value="{{$type['id']}}">{{$type['name_bn']}}</option>
                                        @endforeach
                                    </select>
                                    <div id="load_type_wise_query_list"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $('#cost_center_type').change(function () {
        KTApp.block('#kt_content', {
            opacity: 0.1,
            state: 'primary' // a bootstrap color
        });
        cost_center_type_id = $(this).val();
        url = '{{route('audit.execution.load-type-wise-audit-query')}}';
        data = {cost_center_type_id};
        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            KTApp.unblock('#kt_content');
            if (response.status === 'error') {
                toastr.warning(response.data)
            } else {
                $('#load_type_wise_query_list').html(response);
            }
        })
    });


    var Query_Create_Container = {
        addQueryItem: function (value='') {
            queryItemHtml = `
            <tr>
                <td width="82%">
                    <input class="form-control" type="text" value="${value}" name="audit_query_items[]">
                </td>
                <td class="pt-2">
                    <button title="যোগ করুন" type='button' class='btn btn-outline-primary btn-sm btn-square'
                    onclick="Query_Create_Container.addQueryItem()">
                        <span class='fa fa-plus'></span>
                    </button>
                    <button title="মুছে ফেলুন" type='button' class='btn btn-outline-danger btn-sm btn-square'
                    onclick="Query_Create_Container.removeQueryItem($(this))">
                        <span class='fa fa-trash'></span>
                    </button>
                </td>
            </tr>
            `;

            $('#tblQueryList').append(queryItemHtml);
        },

        removeQueryItem: function (elem) {
            elem.closest("tr").remove();
        },

        saveAuditQuery: function () {
            url = '{{route('audit.execution.query.store')}}';
            data = $('#query_add_form').serialize();

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'success') {
                    toastr.success('Successfully Added!');
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
    };
</script>
