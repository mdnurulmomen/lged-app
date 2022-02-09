<div class="table-search-header-wrapper mb-4 pt-3 pb-3 shadow-sm">
    <div class="col-xl-12">
        <div class="row mt-2 mb-2">
            <div class="col-md-3">
                <select class="form-select select-select2" id="fiscal_year_id">
                    @foreach($fiscal_years as $fiscal_year)
                        <option
                            value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['end']?'selected':''}}>{{enTobn($fiscal_year['description'])}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select select-select2" id="activity_id">
                    <option value="">অ্যাক্টিভিটি বাছাই করুন</option>
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select select-select2" id="audit_plan_id">
                    <option value="">প্ল্যান বাছাই করুন</option>
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select select-select2" id="entity_id">
                    <option value="">এনটিটি/সংস্থা বাছাই করুন</option>
                </select>
            </div>
        </div>
        <div class="row mt-2 mb-2">
{{--            <div class="col-md-3">--}}
{{--                <select class="form-select select-select2" id="cost_center_filter">--}}
{{--                    <option value="">কস্ট সেন্টার/ইউনিট বাছাই করুন</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="col-md-3">--}}
{{--                <select class="form-select select-select2" id="team_filter">--}}
{{--                    <option value="">দল বাছাই করুন</option>--}}
{{--                </select>--}}
{{--            </div>--}}
            <div class="col-md-3">
                <button id="btn_filter" onclick="Apotti_Container.loadApottiList()" class="btn btn-sm btn-outline-primary btn-square" type="button">
                    <i class="fad fa-search"></i> অনুসন্ধান
                </button>
            </div>
        </div>
    </div>
</div>


<div class="card card-custom card-stretch">
    <div class="card-body p-0">
        <div id="load_apotti_list"></div>
    </div>
</div>


<script>
    $(function () {
        office_id = '{{$office_id}}';
        fiscal_year_id = $('#fiscal_year_id').val();
        team_filter = $('#team_filter').val();
        cost_center_id = $('#cost_center_filter').val();
        Apotti_Container.loadApottiList(fiscal_year_id);
        Apotti_Container.loadActivity(fiscal_year_id);

    });
    var Apotti_Container = {
        loadActivity: function (fiscal_year_id) {
            let url = '{{route('audit.plan.operational.activity.select')}}';
            let data = {fiscal_year_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#activity_id').html(response);
                    }
                }
            );
        },
        loadActivityWiseAuditPlan: function (fiscal_year_id,activity_id) {
            let url = '{{route('audit.plan.operational.activity.audit-plan')}}';
            let data = {fiscal_year_id,activity_id,office_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#audit_plan_id').html(response);
                    }
                }
            );
        },
        loadPlanWiseEntity: function (entity_list) {
            let url = '{{route('audit.execution.apotti.audit-plan-wise-entity-select')}}';
            let data = {entity_list};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#entity_id').html(response);
                    }
                }
            );
        },
        loadCostCenterList: function (directorate_id, fiscal_year_id, entity_id) {
            let url = '{{route('calendar.load-cost-center-directorate-fiscal-year-wise-select')}}';
            let data = {directorate_id, fiscal_year_id, entity_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#cost_center_filter').html(response);
                    }
                }
            );
        },

        loadTeamList: function (directorate_id, fiscal_year_id, cost_center_id) {
            let url = '{{route('calendar.load-teams-select')}}';
            let data = {directorate_id, fiscal_year_id, cost_center_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#team_filter').html(response);
                    }
                }
            );
        },

        loadApottiList: function () {
            fiscal_year_id = $('#fiscal_year_id').val();
            audit_plan_id = $('#audit_plan_id').val();
            entity_id = $('#entity_id').val();

            if(!entity_id){
               toastr.warning('Please Select Entity');
               return;
            }

            let url = '{{route('audit.execution.apotti.load-apotti-list')}}';
            let data = {fiscal_year_id,audit_plan_id,entity_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#load_apotti_list').html(response);
                    }
                }
            );
        },

        loadApottiItemInfo: function (apotti_item_id) {
            let url = '{{route('audit.execution.apotti.apotti-item-info')}}';
            let data = {apotti_item_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#apotti_item_info').html(response);
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

        editApotti: function (element){
            apotti_id = element.data('apotti-id');
            data = {apotti_id}
            let url = '{{route('audit.execution.apotti.edit-apotti')}}'
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $("#kt_content").html(response);
                }
            });
        },

        updateApotti:function (elem){
            data  = $('#onucched_marge_form').serializeArray();
            data.push({name: "apotti_description", value: tinymce.get("kt-tinymce-1").getContent()});

            apotti_id = elem.data('apotti-id');

            data.push({name: "apotti_id", value: apotti_id});

            let url = '{{route('audit.execution.apotti.update-apotti')}}';

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    toastr.success(response.data);
                    $('.apotti_menue a').trigger('click');
                }
            });
        },

        mergeOnucched:function (){
            if($('.select-apotti').filter(':checked').length < 2){
                toastr.warning('দয়া করে দুইয়ের অধিক আপত্তি বাছাই করুন');
                return;
            }
            swal.fire({
                title: 'আপনি কি একীভূত করতে চান?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'হ্যাঁ',
                cancelButtonText: 'না'
            }).then(function(result) {
                if (result.value) {
                    apottiId = {};
                    sequence = []
                     apotti = document.getElementsByClassName('select-apotti');
                     // sequence = $(apotti[0]).attr('data-sequence');


                    $('.select-apotti').each(function(i){
                        if(this.checked){
                            apottiId[i] = $(this).val();
                            // sequence = $(this).attr('data-sequence');
                            sequence.push($(this).attr('data-sequence'));
                        }
                    });
                    sequence = Math.min(...sequence);
                    data = {apottiId,sequence}
                    let url = '{{route('audit.execution.apotti.onucched-merge-form')}}'
                    ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                        if (response.status === 'error') {
                            toastr.error(response.data)
                        } else {
                            $("#kt_content").html(response);
                        }
                    });
                }
            });
        },

        mergeOnucchedSubmit:function (elem){
            data  = $('#onucched_marge_form').serializeArray();
            data.push({name: "apotti_description", value: tinymce.get("kt-tinymce-1").getContent()});

            apottiId = elem.data('apotti-ids');
            sequence = elem.data('sequence');

            data.push({name: "apottiId", value: JSON.stringify(apottiId)});
            data.push({name: "sequence", value: sequence});

            let url = '{{route('audit.execution.apotti.onucched-merge')}}'
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    toastr.success(response.data);
                    $('#kt_quick_panel_close').click();
                    // $('.apotti_menue a').trigger('click');
                }
            });
        },

        unMergeOnucched:function (elem){
            is_combined = elem.data('is-combined');
            if(!is_combined){
                toastr.warning('ইহা একটি বিচ্ছিন্ন অনুচ্ছেদ');
                return;
            }
            swal.fire({
                title: 'আপনি কি বিচ্ছিন্ন করতে চান?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'হ্যাঁ',
                cancelButtonText: 'না'
            }).then(function(result) {
                if (result.value) {
                    apotti_item_id = elem.data('apotti-item-id');
                    data  = {apotti_item_id}
                    let url = '{{route('audit.execution.apotti.onucched-unmerge')}}'
                    ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                        if (response.status === 'error') {
                            toastr.error(response.data);
                        } else {
                            toastr.success(response.data);
                            $('#kt_quick_panel_close').click();
                            $('.apotti_menue a').trigger('click');
                        }
                    });
                }
            });
        },

        reArrangeOnucched:function (elem){
            is_rearranged = elem.data('is-rearranged');
            if(!is_rearranged){
                toastr.warning('পুনঃবিন্যাস করে নিন');
                return;
            }
            swal.fire({
                title: 'আপনি কি পুনর্বিন্যাস করতে চান?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'হ্যাঁ',
                cancelButtonText: 'না'
            }).then(function(result) {
                if (result.value) {
                    apotti_sequence = {};
                    $('.apotti_sequence').each(function (){
                        apotti_sequence[$(this).attr('data-apotti-id')] = {
                            apotti_id: $(this).attr('data-apotti-id'),
                            apotti_sequence: $(this).val(),
                        }
                    });

                    data  = {apotti_sequence}

                    let url = '{{route('audit.execution.apotti.onucched-rearrange')}}'
                    ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                        if (response.status === 'error') {
                            toastr.error(response.data);
                        } else {
                            toastr.success(response.data);
                            $('#kt_quick_panel_close').click();
                            $('.apotti_menue a').trigger('click');
                        }
                    });
                }
            });
        },
    };

    $('#btn_filter').click(function () {
        directorate_id = $('#directorate_filter').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        team_filter = $('#team_filter').val();
        cost_center_id = $('#cost_center_filter').val();
        memo_irregularity_type = $('#memo_irregularity_type').val();
        memo_irregularity_sub_type = $('#memo_irregularity_sub_type').val();
        memo_type = $('#memo_type').val();
        memo_status = $('#memo_status').val();
        jorito_ortho_poriman = $('#jorito_ortho_poriman').val();
        audit_year_start = $('#audit_year_start').val();
        audit_year_end = $('#audit_year_end').val();
        if (directorate_id !== 'all') {
            Authority_Memo_Container.loadMemoList(directorate_id, fiscal_year_id, cost_center_id, team_filter, memo_irregularity_type, memo_irregularity_sub_type, memo_type, memo_status, jorito_ortho_poriman, audit_year_start,audit_year_end);
        } else {
            toastr.info('Please select a directorate.')
        }
    });

    $('#entity_filter').change(function () {
        entity_id = $('#entity_filter').val();
        directorate_id = $('#directorate_filter').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        Authority_Memo_Container.loadCostCenterList(directorate_id, fiscal_year_id, entity_id);
    });

    $('#cost_center_filter').change(function () {
        cost_center_id = $('#cost_center_filter').val();
        directorate_id = $('#directorate_filter').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        Authority_Memo_Container.loadTeamList(directorate_id, fiscal_year_id, cost_center_id);
    });

    $('#activity_id').change(function (){
        activity_id = $('#activity_id').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        Apotti_Container.loadActivityWiseAuditPlan(fiscal_year_id,activity_id);
    });

    $('#audit_plan_id').change(function (){
        entity_list = $(this).find(':selected').attr('data-entity-info');
        Apotti_Container.loadPlanWiseEntity(entity_list);
    });
</script>
