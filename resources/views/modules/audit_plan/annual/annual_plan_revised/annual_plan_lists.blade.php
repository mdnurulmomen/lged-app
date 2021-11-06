<x-title-wrapper>Annual Plan List</x-title-wrapper>
<form class="pl-4 pt-4">
    <div class="form-row">
        <div class="col-md-4 ">
            <label>Select Fiscal Year For Annual Planning</label>
            <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_annual_plan">
                <option value="">Choose Fiscal Year</option>
                @foreach($fiscal_years as $fiscal_year)
                    <option
                        value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['start']?'selected':''}}>{{$fiscal_year['description']}}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>

<div class="px-3 py-3" id="load_annual_plan_lists"></div>

@include('scripts.script_generic')
<script>
    $(function () {
        Annual_Plan_Container.loadAnnualPlanList();
    });

    $('#select_fiscal_year_annual_plan').change(function () {
        Annual_Plan_Container.loadAnnualPlanList();
    });

    var Annual_Plan_Container = {
        loadAnnualPlanList: function () {
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
            schedule_id = elem.data('schedule-id');
            activity_id = elem.data('activity-id');
            milestone_id = elem.data('milestone-id');
            fiscal_year_id = elem.data('fiscal-year-id');
            activity_title = elem.data('activity-title');
            op_audit_calendar_event_id = elem.data('op-audit-calendar-event-id');
            data = {schedule_id, activity_id, milestone_id, activity_title, fiscal_year_id, op_audit_calendar_event_id}
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

        loadEntityChildOffices: function (entity_id) {
            KTApp.block('.content');
            url = '{{route('audit.plan.annual.plan.list.show.rp-auditee-child-offices-list')}}';
            parent_office_id = entity_id;
            data = {
                parent_office_id,
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
            parent_office_id = $('#' + node_id).attr('data-rp-auditee-entity-id');
            data = {
                parent_office_id,
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
                                "data-rp-auditee-entity-id": office.id,
                                "data-entity-info": JSON.stringify({
                                    entity_id: office.id,
                                    entity_name_en: office.office_name_en,
                                    entity_name_bn: office.office_name_bn,
                                })
                            },
                            text: office.office_name_bn,
                        };

                        if (office.has_child) {
                            child_node_info['children'] = [{'text': 'Child 1'}];
                        }

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

        addSelectedRPAuditeeList: function (entity_info, parent_rp_office = false) {
            let controlling_office = {};
            let ministry_info = {};
            let selected_auditee = {};
            let newRow = '';

            if ($('#selected_rp_auditee_' + entity_info.entity_id).length === 0) {
                if (parent_rp_office) {
                    if ($('.parent_office').length > 0) {
                        // $('.parent_office').remove()
                        $('.selected_rp_offices li').remove()
                    }
                    newRow = '<li class="parent_office" id="selected_rp_parent_auditee_' + entity_info.entity_id + '" style="border: 1px solid #ebf3f2;list-style: none;margin: 5px;padding-left: 4px;cursor: move;">' +
                        '<span class="badge badge-white" >&nbsp</span>' +
                        '<i class="fa fa-home pr-2"></i>' + entity_info.entity_name_bn + '<span class="ml-2 badge badge-info">ইউনিট/গ্রুপ</span>' +
                        '<input name="parent_office" class="selected_entity" id="selected_parent_entity_' + entity_info.entity_id + '" type="hidden" value=""/>' +
                        '<input name="controlling_office" class="controlling_office" id="controlling_office" type="hidden" value=""/>' +
                        '<input name="ministry_info" class="ministry_info" id="ministry_info" type="hidden" value=""/>' +
                        '</li>';
                    Annual_Plan_Container.loadEntityChildOffices(entity_info.entity_id)
                } else {
                    count = $('[id^=selected_rp_auditee_]').length
                    newRow = '<li id="selected_rp_auditee_' + entity_info.entity_id + '" style="border: 1px solid #ebf3f2;list-style: none;margin: 5px;padding-left: 4px;cursor: move;" draggable="true" ondragend="dragEnd()" ondragover="dragOver(event)" ondragstart="dragStart(event)">' +
                        '<span class="selected_entity_sr badge badge-white pl-1" >' + enTobn(count + 1) + '| </span>' +
                        '<span id="btn_remove_auditee_' + entity_info.entity_id + '" data-auditee-id="' + entity_info.entity_id + '"  onclick="Annual_Plan_Container.removeSelectedRPAuditee(' + entity_info.entity_id + ')" style="cursor:pointer;color:red;"><i class="fas fa-trash-alt text-danger pr-2"></i></span>' +
                        '<i class="fa fa-home pr-2"></i>' + entity_info.entity_name_en +
                        '<input name="selected_entity[]" class="selected_entity" id="selected_entity_' + entity_info.entity_id + '" type="hidden" value=""/>' +
                        '</li>';
                }
                selected_rp_office = $(".selected_rp_offices");
                selected_rp_office.append(newRow);

                if (parent_rp_office) {
                    controlling_office = {
                        'controlling_office_id': entity_info.controlling_office_id,
                        'controlling_office_name_en': entity_info.controlling_office_name_en,
                        'controlling_office_name_bn': entity_info.controlling_office_name_bn,
                    };
                    ministry_info = {
                        'ministry_id': $('#parent_ministry_id').val(),
                        'ministry_name_en': $('#parent_ministry_name_en').val(),
                        'ministry_name_bn': $('#parent_ministry_name_bn').val(),
                    };
                    selected_auditee = {
                        'parent_office_id': entity_info.entity_id,
                        'parent_office_name_en': entity_info.entity_name_en,
                        'parent_office_name_bn': entity_info.entity_name_bn,
                        'office_type': entity_info.office_type,
                    };
                    selected_rp_office.find('#controlling_office').val(JSON.stringify(controlling_office));
                    selected_rp_office.find('#ministry_info').val(JSON.stringify(ministry_info));
                    selected_rp_office.find('#selected_parent_entity_' + entity_info.entity_id).val(JSON.stringify(selected_auditee));
                } else {
                    selected_auditee = {
                        'office_id': entity_info.entity_id,
                        'office_name_en': entity_info.entity_name_en,
                        'office_name_bn': entity_info.entity_name_bn,
                    };
                    selected_rp_office.find('#selected_entity_' + entity_info.entity_id).val(JSON.stringify(selected_auditee));
                }

            }
        },

        removeSelectedRPAuditee: function (entity_id) {
            $('#selected_rp_auditee_' + entity_id).remove();
        },

        removeSelectedRPParentAuditee: function (entity_id) {
            $('#selected_rp_parent_auditee_' + entity_id).remove();
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
            fiscal_year_id = elem.data('fiscal-year-id');

            ajaxCallAsyncCallbackAPI(url, {fiscal_year_id}, 'post', function (response) {
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
            data = $('#annual_plan_form').serialize();
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
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

        printAnnualPlan: function (elem) {
            url = '{{route('audit.plan.annual.plan.revised.book')}}';
            fiscal_year_id = elem.data('fiscal-year-id');
            $.ajax({
                type: 'POST',
                url: url,
                data: {fiscal_year_id},
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
    };
</script>
