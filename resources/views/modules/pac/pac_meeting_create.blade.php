<form id="pac_meeting_create_form" enctype="multipart/form-data" autocomplete="off">
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
                       class="btn btn-success btn-sm btn-bold btn-square"
                       onclick="CreatMeeting_Container.submitPacMeeting($(this))">
                        <i class="far fa-save mr-1"></i> {{___('generic.save')}}
                    </a>
                </div>
            </div>
        </div>
    </div>


    <div class="row mt-2">
        <div class="col-md-6">
            <div class="card sna-card-border">
                <ul class="nav nav-tabs custom-tabs mb-0" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="calender" data-toggle="tab"
                           aria-controls="tree" href="#office_member_tab">
                            <span class="nav-text">সিএজি/অধিদপ্তর সদস্য</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="select_cost_centers" class="nav-link rounded-0" data-toggle="tab"
                           href="#pac_member_tab">
                            <span class="nav-text">পি এ সি সদস্য</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="milestone_tab" class="nav-link rounded-0" data-toggle="tab"
                           href="#ministry_member_tab">
                            <span class="nav-text">মন্ত্রণালয় এর সদস্য</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="milestone_tab" class="nav-link rounded-0" data-toggle="tab"
                           href="#final_report_tab">
                            <span class="nav-text">রিপোর্ট</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="rp_office_tab">
                    <div class="tab-pane fade border border-top-0 p-3 active show" id="office_member_tab"
                         role="tabpanel"
                         aria-labelledby="calender-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="form-control select-select2" id="office">
                                    <option value="">--অফিস বাছাই করুন--</option>
                                    @foreach($offices as $office)
                                        <option
                                            value="{{$office['id']}}">{{$office['office_name_bng']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 other_officers_list_area">
                                <input id="other_officer_search" type="text" class="form-control mb-1"
                                       placeholder="অফিসার খুঁজুন">
                                <div class="rounded-0  office_organogram_tree_div"
                                     style="overflow-y: scroll; height: 60vh">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane border border-top-0 p-3 fade" id="pac_member_tab"
                         role="tabpanel" aria-labelledby="activity-tab">
                        <h5 class="text-primary"><u>পি এ সি সদস্য তালিকাঃ</u></h5>
                        <div class="col-md-12 load_pac_member_list"></div>
                    </div>

                    <div class="tab-pane border border-top-0 p-3 fade" id="ministry_member_tab"
                         role="tabpanel" aria-labelledby="activity-tab">
                        <h5 class="text-primary"><u>মন্ত্রণালয় এর সদস্য তালিকাঃ</u></h5>
                        <div class="col-md-12 ministry_member_list">
                            <table id="ministry_member_table" class="table table-bordered" width="100%">
                                <thead>
                                <tr>
                                    <th width="25%">নাম</th>
                                    <th width="25%">পদবী</th>
                                    <th width="25%">ইমেইল</th>
                                    <th width="25%">মোবাইল</th>
                                    <th width="5%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input class="form-control" style="height: 35px !important;" type="text"  /></td>
                                    <td><input type="text" class="form-control" style="height: 35px !important;"></td>
                                    <td><input type="text" class="form-control" style="height: 35px !important;"></td>
                                    <td><input type="text"  class="form-control" style="height: 35px !important;"></td>
                                    <td><span id="add_member" style="font-size: 25px;color: #82ae46" class="nav-icon far fa-plus-square"></span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane border border-top-0 p-3 fade" id="final_report_tab"
                         role="tabpanel" aria-labelledby="activity-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <select class="form-control select-select2" id="directorate_id">
                                    <option value="">--অধিদপ্তর বাছাই করুন--</option>
                                    @foreach($offices as $office)
                                        <option
                                            value="{{$office['id']}}">{{$office['office_name_bng']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="form-control select-select2" name="final_report" id="final_report">
                                    <option value="">ফাইনাল রিপোর্ট বাছাই করুন</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="apotti_list"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card sna-card-border p-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="col-form-label">বৈঠক নং<span class="text-danger">*</span></label>
                            <input class="form-control mb-1" name="meeting_no" placeholder="বৈঠক নং">
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label">সংসদ নং</label>
                            <input class="form-control mb-1" name="parliament_no" placeholder="সংসদ নং">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="col-form-label">বৈঠক তারিখ<span class="text-danger">*</span></label>
                            <input class="form-control mb-1 date" name="meeting_date" placeholder="বৈঠক নং">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="col-form-label">আলোচ্য সূচী<span class="text-danger">*</span></label>
                            <textarea class="form-control mb-1" name="meeting_subject" placeholder="আলোচ্য সূচী" cols="30"
                                      rows="2"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="col-form-label">বৈঠক স্থান<span class="text-danger">*</span></label>
                            <textarea class="form-control mb-1" name="meeting_place" placeholder="বৈঠক স্থান" cols="30"
                                      rows="2"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="col-form-label">সংযুক্তি</label>
                            <input name="porisishtos" type="file" class="mFilerInit form-control rounded-0" multiple>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card sna-card-border mt-2">
                <div class="card-body p-4">
                    <div class="pl-4 selected_rp_offices">
                        <h5 class="text-primary"><u>সিএজি সদস্য তালিকাঃ</u></h5>
                        <ul class="select_member p-0"></ul>
                    </div>
                </div>
            </div>

            <div class="card sna-card-border mt-2">
                <div class="card-body p-4">
                    <div class="pl-4 selected_rp_offices">
                        <h5 class="text-primary"><u>পি এ সি সদস্য তালিকাঃ</u></h5>
                        <ul class="select_pac_member p-0"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>

<script>

    row_count = 1;
    $('#add_member').click(function () {
        row_count++
        $('#ministry_member_table > tbody:last').append(`
        <tr>
        <td><input class="form-control" style="height: 35px !important;" type="text"  /></td>
        <td><input class="form-control" style="height: 35px !important;" type="text" /></td>
        <td><input type="text" value="" id="description"  class="form-control" style="height: 35px !important;"></td>
        <td><input class="form-control" style="height: 35px !important;" type="text"  /></td>
        <td><span style="font-size: 25px;color:red" class="nav-icon far fa-minus-square delete_row"></span></td>
        </tr>`
        );
        $(".delete_row").click(function(event) {
            $(this).parent().parent().remove();
        });
    });

    $("select#office").change(function () {
        CreatMeeting_Container.loadOfficeMember();
    });

    $("select#directorate_id").change(function () {
        CreatMeeting_Container.loadFinalReport();
    });

    $("select#final_report").change(function () {
        CreatMeeting_Container.loadFinalReportWiseApotti();
    });

    $(function () {
        CreatMeeting_Container.loadPacList();
    });
    var CreatMeeting_Container = {


        loadOfficeMember: function () {
            office_id = $('#office').val();
            office_type = '';
            KTApp.block('.office_organogram_tree_div', {
                overlayColor: '#000',
                opacity: 0.1,
                state: 'danger',
                message: 'Loading...'
            });
            url = '{{route('pac.load-office-member-list')}}';
            data = {office_id, office_type};
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('.office_organogram_tree_div');
                if (response.status === 'error') {
                    toastr.error('Internal Serve Error');
                } else {
                    $('.office_organogram_tree_div').html(response);
                }
            })
        },

        loadFinalReport: function () {
            office_id = $('#directorate_id').val();
            url = '{{route('pac.load-pac-final-report')}}';
            data = {office_id};
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('.office_organogram_tree_div');
                if (response.status === 'error') {
                    toastr.error('Internal Serve Error');
                } else {
                    $('#final_report').html(response);
                }
            })
        },

        loadFinalReportWiseApotti: function () {
            office_id = $('#directorate_id').val();
            air_id = $('#final_report').val();
            url = '{{route('pac.load-air-wise-apotti')}}';
            data = {office_id,air_id};
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('.office_organogram_tree_div');
                if (response.status === 'error') {
                    toastr.error('Internal Serve Error');
                } else {
                    $('.apotti_list').html(response);
                }
            })
        },

        loadPacList: function () {
            user_role_id = 12;

            KTApp.block('.load_pac_member_list', {
                overlayColor: '#000',
                opacity: 0.1,
                state: 'danger',
                message: 'Loading...'
            });
            url = '{{route('pac.load-pac-member-list')}}';

            data = {user_role_id};

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('.load_pac_member_list');
                if (response.status === 'error') {
                    toastr.error('Internal Serve Error');
                } else {
                    $('.load_pac_member_list').html(response);
                }
            })
        },

        submitPacMeeting: function () {
            url = '{{route('pac.pac-meeting-store')}}';
            data = $('#pac_meeting_create_form').serializeArray();

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
            data.push({name: "office_member_info", value: member_info});

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {

                if (response.status === 'error') {
                    toastr.error('Internal Serve Error');
                } else {
                    toastr.success(response.data);
                }
            })
        },
    };
</script>

