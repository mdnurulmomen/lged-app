<x-title-wrapper>Annual Plan List</x-title-wrapper>

<div class="card sna-card-border d-flex flex-wrap flex-row">
    <div class="w-25 pr-2 pb-2">
        <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_annual_plan">
            <option value="">--সিলেক্ট--</option>
            @foreach($fiscal_years as $fiscal_year)
                <option
                    value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['end']?'selected':''}}>{{$fiscal_year['description']}}</option>
            @endforeach
        </select>
    </div>
    <div class="w-25 pr-2 pb-2">
        <select class="form-control select-select2" id="activity_id">
            <option value="">--সিলেক্ট--</option>
        </select>
    </div>
</div>

<div class="card sna-card-border mt-2">
    <div id="load_annual_plan_lists"></div>
</div>


@include('scripts.script_generic')
<script>
    $(function () {
        Annual_Plan_Container.loadFiscalYearWiseActivity();
        // Annual_Plan_Container.loadAnnualPlanList();

    });

    $('#select_fiscal_year_annual_plan').change(function () {
        Annual_Plan_Container.loadAnnualPlanList();
    });

    $('#activity_id').change(function () {
        Annual_Plan_Container.loadAnnualPlanList();
    });

    var Annual_Plan_Container = {
        loadAnnualActivityEventList: function (page = 1, per_page = 100) {
            fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
            fiscal_year = $('#select_fiscal_year_annual_plan').select2('data')[0].text;
            if (fiscal_year_id) {
                let url = '{{route('audit.plan.annual.plan.revised.list.all')}}';
                let data = {fiscal_year_id, fiscal_year};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data)
                    } else {
                        $('#load_annual_plan_lists').html(response);
                    }
                });
            } else {
                $('#load_annual_plan_lists').html('');
            }
        },

        movementHistory: function (element) {
            url = '{{route('audit.plan.annual.plan.revised.movement-history-annual-plan')}}';
            fiscal_year_id = element.data('fiscal-year-id');
            op_audit_calendar_event_id = element.data('op-audit-calendar-event-id');

            data = {fiscal_year_id, op_audit_calendar_event_id};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('গতিবিধি');
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

        loadAnnualPlanApprovalAuthority: function (element) {
            url = '{{route('audit.plan.annual.plan.revised.load-annual-plan-approval-authority')}}';
            fiscal_year_id = element.data('fiscal-year-id');
            annual_plan_main_id = element.data('annual-plan-main-id');
            activity_type = element.data('activity-type');
            op_audit_calendar_event_id = element.data('op-audit-calendar-event-id');

            data = {fiscal_year_id, op_audit_calendar_event_id, annual_plan_main_id, activity_type};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('অনুমোদনকারী বাছাই করুন');
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

        sendAnnualPlanSenderToReceiver: function () {
            url = '{{route('audit.plan.annual.plan.revised.send-annual-plan-sender-to-receiver')}}';
            data = $('#approval_authority_form').serialize();
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {
                    toastr.success('অনুমোদনের জন্য প্রেরিত হয়েছে');
                    $("#kt_quick_panel_close").click();
                    Annual_Plan_Container.loadAnnualPlanList();
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

        loadEntitySelection: function (elem) {
            schedule_id = elem.data('schedule-id');
            activity_id = elem.data('activity-id');
            milestone_id = elem.data('milestone-id');
            fiscal_year = elem.data('fiscal-year');
            fiscal_year_id = elem.data('fiscal-year-id');
            activity_title = elem.data('activity-title');
            op_audit_calendar_event_id = elem.data('op-event-id');
            data = {
                schedule_id,
                activity_id,
                milestone_id,
                fiscal_year,
                activity_title,
                fiscal_year_id,
                op_audit_calendar_event_id
            }
            let url = '{{route('audit.plan.annual.plan.revised.annual-entities-show')}}'
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#kt_content').html(response)
                }
            });
        },

        addPlanInfo: function (elem) {
            fiscal_year_id = elem.data('fiscal-year-id');
            annual_plan_main_id = elem.data('annual-plan-main-id');
            op_audit_calendar_event_id = elem.data('op-audit-calendar-event-id');
            data = {fiscal_year_id,annual_plan_main_id, op_audit_calendar_event_id}
            KTApp.block('#kt_content');
            let url = '{{route('audit.plan.annual.plan.list.show.revised.create_plan_info')}}'
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#kt_content').html(response)
                }
            });
        },

        editPlanInfo: function (elem) {
            annual_plan_id = elem.data('annual-plan-id');
            fiscal_year_id = elem.data('fiscal-year-id');
            op_audit_calendar_event_id = elem.data('op-audit-calendar-event-id');
            data = {annual_plan_id, fiscal_year_id, op_audit_calendar_event_id}
            KTApp.block('#kt_content');
            let url = '{{route('audit.plan.annual.plan.revised.edit_plan_info')}}'
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#kt_content').html(response)
                }
            });
        },

        showPlanInfo: function (elem) {
            annual_plan_id = elem.data('annual-plan-id');
            data = {annual_plan_id}
            KTApp.block('#kt_content');
            let url = '{{route('audit.plan.annual.plan.revised.show_plan_info')}}'
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $(".offcanvas-title").text('বিস্তারিত');
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

        deletePlan: function (elem) {
            swal.fire({
                title: 'আপনি কি তথ্যটি মুছে ফেলতে চান?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'হ্যাঁ',
                cancelButtonText: 'না'
            }).then(function(result) {
                if (result.value) {

                    annual_plan_id = elem.data('annual-plan-id');
                    data = {annual_plan_id}
                    KTApp.block('#kt_content');
                    let url = '{{route('audit.plan.annual.plan.revised.delete_annual_plan')}}'
                    ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                        KTApp.unblock('#kt_content');
                        if (response.status === 'error') {
                            toastr.error(response.data);
                        } else {
                            toastr.success(response.data);
                            $('.annual_plan_menu a').click();
                        }
                    });

                }
            });

        },

        loadActivityWiseMilestone: function (activity_id, milestone_id = 0) {
            data = {
                activity_id,
            }
            let url = '{{route('audit.plan.annual.plan.list.show.revised.activity-wise-milestone-select')}}'
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('.load_milestone').html(response);
                    // if(milestone_id){
                    //     $('#milestone_id').val(milestone_id);
                    // }
                }
            });
        },

        loadRPAuditeeOffices: function (ministry_id, layer_id) {
            let url = '{{route('audit.plan.annual.plan.list.show.rp-auditee-offices')}}'
            ministry_name_en = $('#ministry_name_en').val()
            ministry_name_bn = $('#ministry_name_bn').val()
            data = {ministry_id, layer_id, ministry_name_en, ministry_name_bn};
            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $('.rp_auditee_office_tree').html(response)
                }
            });
        },

        OldloadEntityChildOffices: function (ministry_id, layer_id, entity_id, entity_name_en, entity_name_bn) {
            parent_ministry_id = ministry_id;
            // parent_office_layer_id = layer_id;

            KTApp.block('.content');
            url = '{{route('audit.plan.annual.plan.list.show.rp-auditee-child-offices-list')}}';
            parent_office_id = entity_id;
            parent_office_en = entity_name_en;
            parent_office_bn = entity_name_bn;
            data = {
                parent_office_id, parent_office_en, parent_office_bn, parent_ministry_id, parent_office_layer_id
            };
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $('.rp_auditee_office_tree').html(response)
                    $('#select_cost_centers').removeClass('disabled')
                }
                KTApp.unblock('.content');
            });
        },

        loadEntityChildOffices: function (ministry_id, entity_id, entity_name_en, entity_name_bn) {
            parent_ministry_id = ministry_id;
            // parent_office_layer_id = layer_id;

            KTApp.block('.content');
            url = '{{route('audit.plan.annual.plan.list.show.rp-auditee-child-offices-list')}}';
            parent_office_id = entity_id;
            parent_office_en = entity_name_en;
            parent_office_bn = entity_name_bn;
            data = {
                parent_office_id, parent_office_en, parent_office_bn, parent_ministry_id
            };
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $('.rp_auditee_office_tree').html(response)
                    $('#select_cost_centers').removeClass('disabled')
                }
                KTApp.unblock('.content');
            });
        },

        loadRPChildOffices: function (node_id, target_tree = '#rp_auditee_offices') {
            KTApp.block(target_tree);
            url = '{{route('audit.plan.annual.plan.list.show.rp-auditee-child-offices')}}';
            parent_office_content = $('#' + node_id).attr('data-entity-info');
            parent_office_content = JSON.parse(parent_office_content);
            // parent_office_id = $('#' + node_id).attr('data-rp-auditee-entity-id');
            parent_office_id = $('#' + node_id).attr('data-office-id');
            parent_ministry_id = $('#parent_ministry_id').val();
            parent_office_layer_id = $('#' + node_id).attr('data-rp-auditee-layer-id');
            entity_id = $('#selected_entity').val();
            // alert(entity_id);
            data = {
                parent_office_id, parent_ministry_id, parent_office_layer_id
            };
            $('#' + node_id + ' ul').html('')
            $('#' + node_id + ' ul').remove()
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'success') {
                    offices = response.data;
                    $.each(offices, function (i, office) {
                        child_node_info = {
                            id: node_id + '_' + office.id,
                            li_attr: {
                                "data-rp-auditee-entity-id": parent_office_id,
                                "data-entity-info": JSON.stringify({
                                    office_id: office.id,
                                    office_name_en: office.office_name_en,
                                    office_name_bn: office.office_name_bn,
                                    entity_id: entity_id,
                                    child_count: office.child_count,
                                })
                            },
                            text: office.office_name_bn,
                        };

                        // if (office.has_child) {
                        //     child_node_info['children'] = [{'text': 'Child 1'}];
                        // }

                        $(`${target_tree}`).jstree().create_node(node_id, child_node_info, "last", function () {
                        });
                        child_node_info = {};
                    });
                    first_child_node = node_id.split("_")[0] + '_' + (parseInt(node_id.split("_")[1]) + 1);
                    $('#' + first_child_node).remove()
                    KTApp.unblock(target_tree);
                }
            });
        },

        loadRPParentAuditeeOffices: function (ministry_id, layer_id) {
            let url = '{{route('audit.plan.annual.plan.list.show.rp-auditee-offices')}}'
            ministry_name_en = $('#parent_ministry_name_en').val()
            ministry_name_bn = $('#parent_ministry_name_bn').val()
            data = {ministry_id, layer_id, ministry_name_en, ministry_name_bn, scope: 'parent_office'};
            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $('.rp_auditee_parent_office_tree').html(response)
                }
            });
        },

        loadRPParentAuditeeOfficesMinistryWise: function (ministry_id, office_category_type) {
            let url = '{{route('audit.plan.annual.plan.list.show.rp-auditee-offices-ministry-wise')}}'
            ministry_name_en = $('#parent_ministry_name_en').val()
            ministry_name_bn = $('#parent_ministry_name_bn').val()
            data = {ministry_id, ministry_name_en, ministry_name_bn, office_category_type, scope: 'parent_office'};
            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $('.rp_auditee_parent_office_tree').html(response)
                }
            });
        },

        addSelectedRPAuditeeList: function (entity_info, node_id, parent_rp_office = false) {
            let selected_auditee = {};
            let newRow = '';
            if ($('#selected_rp_auditee_' + entity_info.entity_id).length === 0) {
                if (parent_rp_office) {

                    ministry_id = $('#parent_ministry_id').val();
                    layer_id = $('#parent_office_layer_id').val();

                    if ($("#selected_entity").find('option[value="' + entity_info.entity_id + '"]').length === 0) {
                        $('#selected_entity').append('<option data-ministry-id="' + ministry_id + '" data-layer-id="' + layer_id + '" data-entity-name-en="' + entity_info.entity_name_en + '" value="' + entity_info.entity_id + '">' + entity_info.entity_name_bn + '</option>');
                    }

                    $('.parent_office').each(function () {
                        id = $(this).attr('id');
                        if (id == 'selected_rp_parent_auditee_' + entity_info.entity_id) {
                            return;
                        }
                    });

                    newRow = '<li class="parent_office" data-child-count="' + entity_info.child_count + '" data-entity-info="' + JSON.stringify(entity_info) + '" id="selected_rp_parent_auditee_' + entity_info.entity_id + '" style="border: 1px solid #ebf3f2;list-style: none;margin: 5px;padding-left: 4px;cursor: move;">' +
                        '<span id="btn_remove_auditee_' + entity_info.entity_id + '" data-auditee-id="' + entity_info.entity_id + '"  onclick="Annual_Plan_Container.removeSelectedEntity(' + entity_info.entity_id + ',' + node_id + ')" style="cursor:pointer;color:red;"><i class="fas fa-trash-alt text-danger pr-2"></i></span>' +
                        '<i class="fa fa-home pr-2"></i>' + entity_info.entity_name_bn + '<span class="ml-2 badge badge-info">এনটিটি</span>' +
                        '<input name="parent_office" class="selected_entity" id="selected_parent_entity_' + entity_info.entity_id + '" type="hidden" value=""/>' +
                        '</li>';
                    selected_rp_office = $(".selected_rp_offices");
                    selected_rp_office.append(newRow);

                    Annual_Plan_Container.selectedEntityTotalUnit();

                } else {
                    count = $('[id^=selected_rp_auditee_]').length
                    newRow = '<li class="entity_' + entity_info.entity_id + '" id="selected_rp_auditee_' + entity_info.office_id + '" style="border: 1px solid #ebf3f2;list-style: none;margin: 5px;padding-left: 4px;cursor: move;" draggable="true" ondragend="dragEnd()" ondragover="dragOver(event)" ondragstart="dragStart(event)">' +
                        '<span class="selected_entity_sr badge badge-white pl-1" >' + enTobn(count + 1) + '| </span>' +
                        '<span id="btn_remove_auditee_' + entity_info.office_id + '" data-auditee-id="' + entity_info.office_id + '"  onclick="Annual_Plan_Container.removeSelectedRPAuditee(' + entity_info.office_id + ')" style="cursor:pointer;color:red;"><i class="fas fa-trash-alt text-danger pr-2"></i></span>' +
                        '<i class="fa fa-home pr-2"></i>' + entity_info.office_name_en +
                        '<input name="selected_entity[]" class="selected_auditee" id="selected_entity_' + entity_info.office_id + '" type="hidden" value=""/>' +
                        '</li>';
                    $('#selected_rp_parent_auditee_' + entity_info.entity_id).after(newRow);
                }


                if (parent_rp_office) {
                    selected_entity = {
                        'entity_id': entity_info.entity_id,
                        'entity_name_en': entity_info.entity_name_en,
                        'entity_name_bn': entity_info.entity_name_bn,
                        'layer_id': $('#parent_office_layer_id').val(),
                        'ministry_id': $('#parent_ministry_id').val(),
                        'ministry_name_en': $('#parent_ministry_name_en').val(),
                        'ministry_name_bn': $('#parent_ministry_name_bn').val(),
                        'child_count': entity_info.child_count,
                    };
                    selected_rp_office = $(".selected_rp_offices");
                    selected_rp_office.find('#selected_parent_entity_' + entity_info.entity_id).val(JSON.stringify(selected_entity));
                } else {
                    selected_auditee = {
                        'entity_id': entity_info.entity_id,
                        'office_id': entity_info.office_id,
                        'office_name_en': entity_info.office_name_en,
                        'office_name_bn': entity_info.office_name_bn,
                    };
                    // console.log(selected_auditee);
                    selected_rp_office = $(".selected_rp_offices");
                    selected_rp_office.find('#selected_entity_' + entity_info.office_id).val(JSON.stringify(selected_auditee));
                }

            }
        },

        removeSelectedRPAuditee: function (entity_id) {
            $('#selected_rp_auditee_' + entity_id).remove();
            total_selected_unit_no = $('#total_selected_unit_no').val();
            total = total_selected_unit_no - 1;
            $('#total_selected_unit_no').val(total);
        },

        selectedEntityTotalUnit: function () {
            count = 0;

            $('.parent_office').each(function () {
                count += parseInt($(this).attr('data-child-count'));
            });

            $('#total_unit_no').val(count)
        },

        removeSelectedEntity: function (entity_id, node_id) {
            $('#selected_rp_parent_auditee_' + entity_id).remove();
            $('.entity_' + entity_id).remove();
            $("#selected_entity").find('option[value="' + entity_id + '"]').remove();
            Annual_Plan_Container.selectedEntityTotalUnit();

            if ($('#rp_auditee_parent_offices').jstree(true)) {
                $("#rp_auditee_parent_offices").jstree("uncheck_node", node_id);
            }
        },

        jsTreeInit: function (className) {
            $(`.${className}`).jstree({
                "check_callback": true,
                "core": {
                    "themes": {
                        "responsive": true
                    }
                },
                "types": {
                    "default": {
                        "icon": "fal fa-folder"
                    },
                    "person": {
                        "icon": "fal fa-file "
                    }
                },
                "plugins": ["types", "checkbox",]
            });
            $(`.${className}`).jstree("open_all");
        },

        submitToOCAG: function (elem) {
            url = '{{route('audit.plan.annual.plan.list.submit.revised.plan-to-ocag')}}';
            annual_plan_main_id = elem.data('annual-plan-main-id');
            fiscal_year_id = elem.data('fiscal-year-id');

            ajaxCallAsyncCallbackAPI(url, {fiscal_year_id,annual_plan_main_id}, 'post', function (response) {
                if (response.status === 'success') {
                    toastr.success(response.data);
                } else {
                    toastr.error(response.data)
                }
            })
        },

        addTeamSection: function (elem) {
            url = '{{route('audit.plan.annual.plan.revised.list.staff')}}';
            sec = $("[id^=team_section_]").last().attr("id");
            sec_count = 0;
            if (sec) {
                sec_count = parseInt(sec.split('_').pop())
            } else {
                sec_count = 0;
            }
            count = parseInt(sec_count) + 1;
            ajaxCallAsyncCallbackAPI(url, {count}, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('.team-section').append(response);
                }
            })
        },

        removeTeamSection: function (elem) {
            elem.parent().parent().remove();
        },

        submitAnnualPlan: function (elem) {
            url = '{{route('audit.plan.annual.plan.revised.store')}}';

            data = $('#annual_plan_form').serializeArray();

            entity_info = {}
            auditee = {}

            $(".selected_entity").each(function () {
                entity_data = JSON.parse($(this).val());
                entity_info[entity_data.entity_id] = {
                    entity_id: entity_data.entity_id,
                    entity_en: entity_data.entity_name_en,
                    entity_bn: entity_data.entity_name_bn,
                    ministry_id: entity_data.ministry_id,
                    ministry_name_en: entity_data.ministry_name_en,
                    ministry_name_bn: entity_data.ministry_name_bn,
                    layer_id: entity_data.layer_id,
                    entity_total_unit: entity_data.child_count,
                }

                $(".selected_auditee").each(function () {
                    temp = JSON.parse($(this).val());

                    if (typeof auditee[temp.entity_id] === 'undefined') {
                        auditee[temp.entity_id] = {};
                    }
                    if (entity_data.entity_id == temp.entity_id) {
                        if (typeof auditee[temp.entity_id][temp.office_id] === 'undefined') {
                            auditee[temp.entity_id][temp.office_id] = {};
                        }
                        auditee[temp.entity_id][temp.office_id] = temp;
                        if (typeof entity_info[auditee.entity_id] === 'undefined') {
                            entity_info[auditee.entity_id] = {};
                        }
                        if (entity_data.entity_id) {
                            entity_info[entity_data.entity_id]['nominated_offices'] = auditee[entity_data.entity_id];
                        }
                    }

                });

            });

            $s_key = 1;
            sub_subject_list = {};
            $(".sub_subject_matter_div input").each(function () {

                if ($(this).hasClass('sub_subject_matter')) {
                    if (!$(this).val()) {
                        toastr.warning('Select Sub Topic');
                        sub_subject_list = {};
                        return false;
                    }else{
                        if (typeof sub_subject_list[$s_key] === 'undefined') {
                            sub_subject_list[$s_key] = {};
                        }
                        sub_subject_list[$s_key]['sub_subject_matter'] = $(this).val();
                    }
                }
                $s_key++;
            });

            $o_key = 1;
            sub_objective_list = {};
            $(".sub_objective_row input").each(function () {
                row_id = $(this).closest('.sub_objective_row').attr('id');
                if ($(this).hasClass('sub_objective')) {
                    if (!$(this).val()) {
                        toastr.warning('Select Sub Objective');
                        sub_objective_list = {};
                        return false;
                    }else{
                        if (typeof sub_objective_list[$o_key] === 'undefined') {
                            sub_objective_list[$o_key] = {};
                        }
                        sub_objective_list[$o_key]['sub_objective'] = $(this).val();
                        sub_objective_list[$o_key]['line_of_enquires'] = {};

                        $("#"+row_id+ " .line_of_enquire_row input").each(function (j) {
                            if ($(this).hasClass('line_of_enquire')) {
                                if (!$(this).val()) {
                                    toastr.warning('Select Line Of Enquire');
                                    sub_objective_list = {};
                                    return false;
                                }

                                sub_objective_list[$o_key]['line_of_enquires'][j]= $(this).val();
                            }
                        });

                    }
                }
                $o_key++;
            });

            milestone_list = {};

            $(".milestone_row input").each(function () {
                if ($(this).hasClass('milestone_id')) {
                    milestone_id = $(this).val();
                    milestone_list[milestone_id] = {
                        activity_id: $('#activity_id').val(),
                        fiscal_year_id: $('#fiscal_year_id').val(),
                        milestone_id: milestone_id,
                    }
                }
                if ($(this).hasClass('milestone_target_date')) {
                    milestone_list[milestone_id]['milestone_target_date'] = formatDate($(this).val());
                }
                if ($(this).hasClass('milestone_start_date')) {
                    if (!$(this).val()) {
                        toastr.warning('Select start date');
                        milestone_list = {};
                        $('#milestone_tab').click();
                        return false;
                    }
                    milestone_list[milestone_id]['start_date'] = formatDate($(this).val());
                }
                if ($(this).hasClass('milestone_end_date')) {
                    if (!$(this).val()) {
                        toastr.warning('Select end date');
                        milestone_list = {};
                        return false;
                    }
                    milestone_list[milestone_id]['end_date'] = formatDate($(this).val());
                }
            });

            if(Object.keys(milestone_list).length === 0){
                return;
            }
            sub_subject_list = JSON.stringify(sub_subject_list);
            sub_objective_list = JSON.stringify(sub_objective_list);
            milestone_list = JSON.stringify(milestone_list);
            entity_list = JSON.stringify(entity_info);
            annual_plan_type = $('input[name="annual_plan_type"]:checked').val();
            // staff_list = {};
            //
            // $(".staff_row input, .staff_row select").each(function () {
            //     // alert(count);
            //     row_count = 0;
            //     if ($(this).hasClass('staff_number')) {
            //         row_count = $(this).attr('data-row-count');
            //         alert(row_count);
            //         staff_list[row_count] = {
            //             staff: $(this).val(),
            //         }
            //     }
            //     if ($(this).hasClass('staff_designation') && $(this).is("select")) {
            //         staff_list[row_count]['designation_bn'] = $(this).val();
            //         staff_list[row_count]['designation_en'] = $(this).find(':selected').attr('data-designation-en')
            //     }
            //     if ($(this).hasClass('staff_responsibility') && $(this).is("select")) {
            //         staff_list[row_count]['responsibility_bn'] = $(this).val();
            //         staff_list[row_count]['responsibility_en'] = $(this).find(':selected').attr('data-responsibility-en')
            //     }
            // });
            //
            // console.log(staff_list);sub_objective_list

            data.push({name: "sub_subject_list", value: sub_subject_list});
            data.push({name: "sub_objective_list", value: sub_objective_list});
            data.push({name: "audit_approach", value: $("input[name='audit_approach']:checked").val()});
            data.push({name: "activity_id", value: $('#activity_id').val()});
            data.push({name: "milestone_id", value: $('#milestone_id').val()});
            data.push({name: "milestone_list", value: milestone_list});
            data.push({name: "entity_list", value: entity_list});
            data.push({name: "annual_plan_type", value: annual_plan_type});
            data.push({name: "thematic_title", value: $('.thematic_title').val()});
            data.push({name: "office_type", value: $('#office_category_type_title_bn').val() ? $('#office_category_type_title_bn').val() : null});
            data.push({name: "office_type_en", value: $('#office_category_type_title_en').val() ? $('#office_category_type_title_en').val() : null});
            data.push({name: "office_type_id", value: $('#office_category_type_select').val() ? $('#office_category_type_select').val() : null});
            data.push({name: "subject_matter", value: $('#subject_matter').val() ? $('#subject_matter').val() : null});
            data.push({name: "vumika", value: $('#vumika').val() ? $('#vumika').val() : null});
            data.push({name: "audit_objective", value: $('#audit_objective').val() ? $('#audit_objective').val() : null});

            elem.prop('disabled', true)

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                elem.prop('disabled', false)
                if (response.status === 'success') {
                    toastr.success('Successfully Added!');
                    $('.annual_plan_menu a').click();
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

        printAnnualPlan: function (elem) {
            url = '{{route('audit.plan.annual.plan.revised.book')}}';
            fiscal_year_id = elem.data('fiscal-year-id');
            annual_plan_main_id = elem.data('annual-plan-main-id');
            activity_type = elem.data('activity-type');
            $.ajax({
                type: 'POST',
                url: url,
                data: {fiscal_year_id,annual_plan_main_id,activity_type},
                xhrFields: {
                    responseType: 'blob'
                },

                success: function (response) {
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "annual_plan.pdf";
                    link.click();
                },

                error: function (blob) {
                    toastr.error('Failed to generate PDF.')
                    console.log(blob);
                }

            });
        },
        loadFiscalYearWiseActivity: function () {
            fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
            fiscal_year = $('#select_fiscal_year_annual_plan').select2('data')[0].text;
            if (fiscal_year_id) {
                let url = '{{route('audit.plan.annual.plan.revised.fiscal-year-wise-activity-select')}}';
                let data = {fiscal_year_id, fiscal_year};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data)
                    } else {
                        $('#activity_id').html(response);
                        $("#activity_id").val($("#activity_id option:eq(1)").val()).trigger('change');
                        // alert(activity_id);
                        // $('#activity_id').val(7);
                        // Annual_Plan_Container.loadAnnualPlanList();
                    }
                });
            } else {
                $('#activity_id').html('');
            }
        },
        loadAnnualPlanList: function () {
            fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
            activity_id = $('#activity_id').val();
            fiscal_year = $('#select_fiscal_year_annual_plan').select2('data')[0].text;
            if (fiscal_year_id) {
                let url = '{{route('audit.plan.annual.plan.revised.annual-entities-show')}}';
                let data = {fiscal_year_id, fiscal_year, activity_id};
                KTApp.block('#kt_content', {
                    opacity: 0.1,
                    state: 'primary' // a bootstrap color
                });
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    KTApp.unblock('#kt_content');
                    if (response.status === 'error') {
                        toastr.error(response.data)
                    } else {
                        $('#load_annual_plan_lists').html(response);
                    }
                });
            } else {
                $('#load_annual_plan_lists').html('');
            }
        },

        loadAssessmentEntity: function (parent_ministry_id,office_category_type,activity_id) {
            url = '{{route('audit.plan.annual.load-assessment-entity')}}';
            data = {parent_ministry_id,office_category_type,activity_id};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $('.rp_auditee_parent_office_tree').html(response)
                }
            });
        },

        backToAnnualPlanList: function () {
            $('.annual_plan_menu a').click();
        },
    };
</script>
