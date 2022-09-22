<form class="mb-14" id="query_update_form" autocomplete="off">
    <input type="hidden" name="ac_query_id" value="{{$auditQueryInfo['id']}}">

    <div class="card sna-card-border">
        <div class="row">
            <div class="col-md-8">
                <div class="d-flex justify-content-start">
                    <h5 class="mt-5">{{$auditQueryInfo['cost_center_name_bn']}} (অর্থবছর : ২০২১-২০২২)</h5>
                </div>
            </div>

            <div class="col-md-4">
                <div class="d-flex justify-content-end">
                    <a
                        onclick="Audit_Query_Schedule_Container.query($(this))"
                        data-schedule-id="{{$schedule_id}}"
                        data-team-id="{{$team_id}}"
                        data-audit-plan-id="{{$audit_plan_id}}"
                        data-entity-id="{{$entity_id}}"
                        data-cost-center-id="{{$auditQueryInfo['cost_center_id']}}"
                        data-cost-center-name-en="{{$auditQueryInfo['cost_center_name_en']}}"
                        data-cost-center-name-bn="{{$auditQueryInfo['cost_center_name_bn']}}"
                        data-project-name-bn="{{$project_name_bn}}"
                        class="btn btn-sm btn-warning btn_back btn-square mr-3">
                        <i class="fad fa-arrow-alt-left"></i> ফেরত যান
                    </a>
                    <a id="memo_submit" class="btn btn-primary btn-sm btn-bold btn-square"
                       onclick="Query_Create_Container.updateAuditQuery()"
                       href="javascript:;">
                        <i class="far fa-save mr-1"></i> Update
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-7">
            <div class="card sna-card-border">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="memorandum_no">স্মারক নং <span class="text-danger">*</span></label>
                            <input type="text" id="memorandum_no" name="memorandum_no"
                                   value="{{$auditQueryInfo['memorandum_no']}}" class="form-control"
                                   placeholder="স্মারক নং">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="memorandum_date">স্মারক তারিখ <span class="text-danger">*</span></label>
                            <input type="text" id="memorandum_date" name="memorandum_date"
                                   value="{{$auditQueryInfo['memorandum_date']}}" class="date form-control"
                                   placeholder="স্মারক তারিখ">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="rpu_office_head_details">বরাবর <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="rpu_office_head_details" name="rpu_office_head_details"
                              cols="30" rows="2">{{$auditQueryInfo['rpu_office_head_details']}}</textarea>
                </div>

                <div class="form-group">
                    <label for="subject">বিষয় <span class="text-danger">*</span></label>
                    <input type="text" id="subject" class="form-control" name="subject"
                           value="{{$auditQueryInfo['subject']}}" placeholder="বিষয়">
                </div>

                <div class="form-group">
                    <label for="suthro">সূত্র</label>
                    <input type="text" id="suthro" class="form-control" name="suthro" placeholder="সূত্র" value="{{$auditQueryInfo['suthro']}}">
                </div>

                <div class="form-group">
                    <label for="description">বিস্তারিত</label>
                    <textarea class="form-control" id="description" name="description" cols="30"
                              rows="4">{{$auditQueryInfo['description']}}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">
                                কোয়েরিসমূহ
                            </legend>
                            <table width="100%"
                                   class="table table-bordered table-striped table-hover table-condensed table-sm"
                                   id="tblQueryList">
                                <tbody>
                                @foreach($auditQueryInfo['query_items'] as $item)
                                    <tr>
                                        <td width="5%"><span style="font-size: 16px" class="m-3">{{enTobn($loop->iteration)}}</span></td>
                                        <td width="77%">
                                            <textarea class="form-control audit_query_item" name="audit_query_items[]" cols="30"
                                                      rows="1">{{$item['item_title_bn']}}</textarea>
                                        </td>
                                        <td class="pt-2">
                                            <button title="যোগ করুন" type='button'
                                                    class='btn btn-outline-primary btn-sm btn-square'
                                                    onclick="Query_Create_Container.addQueryItem()">
                                                <span class='fa fa-plus'></span>
                                            </button>
                                            <button title="মুছে ফেলুন" type='button'
                                                    class='btn btn-outline-danger btn-sm btn-square'
                                                    onclick="Query_Create_Container.removeQueryItem($(this))">
                                                <span class='fa fa-trash'></span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td width="5%"><span style="font-size: 16px" class="m-3">{{enTobn(count($auditQueryInfo['query_items'])+1)}}</span></td>
                                    <td width="77%">
                                        <textarea class="form-control audit_query_item" name="audit_query_items[]" cols="30"
                                                  rows="1"></textarea>
                                    </td>
                                    <td class="pt-2">
                                        <button title="যোগ করুন" type='button'
                                                class='btn btn-outline-primary btn-sm btn-square'
                                                onclick="Query_Create_Container.addQueryItem()">
                                            <span class='fa fa-plus'></span>
                                        </button>
                                        <button title="মুছে ফেলুন" type='button'
                                                class='btn btn-outline-danger btn-sm btn-square'
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
                    <textarea class="form-control" id="cc" name="cc" cols="30" rows="4">{{$auditQueryInfo['cc']}}</textarea>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card sna-card-border px-3 mb-2">
                <div class="row">
                    <div class="col-md-12">
                        <label class="col-form-label text-primary bold mr-3">ইস্যুকারীঃ</label>
                        <input type="radio" class="mr-1" name="issued_by"  value="team_leader" {{$auditQueryInfo['issued_by'] == 'team_leader' ? 'checked':''}}><span class="mr-3">দলনেতা</span>
                        <input type="radio" class="mr-1" name="issued_by"  value="sub_team_leader" {{$auditQueryInfo['issued_by'] == 'sub_team_leader' ? 'checked':''}}><span class="mr-3">উপদলনেতা</span>

                        <br>
                        <label class="col-form-label">দলনেতা</label>
                        @foreach(json_decode($get_team['team_members'],true) as $key => $team)
                            @if($key == 'teamLeader')
                                @foreach($team as $teamLeader)
                                    <input type="text" class="form-control mb-1" placeholder="দলনেতা" readonly
                                           value="{{$teamLeader['officer_name_bn'].' ('.$teamLeader['designation_bn'].')'}}">
                                    <input type="hidden" name="team_leader_name" value="{{$teamLeader['officer_name_bn']}}">
                                    <input type="hidden" name="team_leader_designation" value="{{$teamLeader['designation_bn']}}">
                                @endforeach
                            @endif
                        @endforeach

                        <label class="col-form-label">উপদলনেতা</label>
                        @foreach(json_decode($get_team['team_members'],true) as $key => $team)
                            @if($key == 'subTeamLeader')
                                @foreach($team as $subTeamLeader)
                                    <input type="text" class="form-control mb-1" placeholder="উপদলনেতা" readonly
                                           value="{{$subTeamLeader['officer_name_bn'].' ('.$subTeamLeader['designation_bn'].')'}}">
                                    <input type="hidden" name="sub_team_leader_name"
                                           value="{{$subTeamLeader['officer_name_bn']}}">
                                    <input type="hidden" name="sub_team_leader_designation"
                                           value="{{$subTeamLeader['designation_bn']}}">
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label for="responsible_person_details">দায়িত্বপ্রাপ্ত কর্মকর্তা</label>
                    <textarea class="form-control" id="responsible_person_details" name="responsible_person_details" cols="30" rows="4">{{$auditQueryInfo['responsible_person_details']}}</textarea>
                </div>
            </div>

            <div class="card sna-card-border">
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
</form>

<script>
    $('#cost_center_type').change(function () {
        KTApp.block('#kt_wrapper', {
            opacity: 0.1,
            state: 'primary' // a bootstrap color
        });
        cost_center_type_id = $(this).val();
        url = '{{route('audit.execution.load-type-wise-audit-query')}}';
        data = {cost_center_type_id};
        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            KTApp.unblock('#kt_wrapper');
            if (response.status === 'error') {
                toastr.warning(response.data)
            } else {
                $('#load_type_wise_query_list').html(response);
            }
        })
    });


    var Query_Create_Container = {
        addQueryItem: function (value='') {
            item_length = enTobn($(".audit_query_item").length+1);
            queryItemHtml = `
            <tr>
                <td width="5%"><span style="font-size: 16px" class="m-3">${item_length}</span></td>
                <td width="77%">
                    <textarea class="form-control audit_query_item" name="audit_query_items[]" cols="30" rows="1">${value}</textarea>
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

        updateAuditQuery: function () {
            url = '{{route('audit.execution.query.update')}}';
            data = $('#query_update_form').serialize();

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'success') {
                    toastr.success('Successfully Added!');
                    $('.btn_back').click();
                } else {
                    toastr.error(response.data.message);
                }
            },function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.responseJSON.errors) {
                    $.each(response.responseJSON.errors, function (k, v) {
                        if (isArray(v)) {
                            $.each(v, function (n, m) {
                                toastr.error(m);
                            })
                        } else {
                            if (v !== '') {
                                toastr.error(v);
                            }
                        }
                    });
                }
            })
        },
    };
</script>
