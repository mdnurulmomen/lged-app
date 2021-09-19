<script>
    $("#add").click(function () {
        var treeList = $("a");
        console.log('treeList', treeList);
    });

    var auditPaperList = [];
    var activePdf = '';
    var templateArray = {!! $content !!};

    var parentOfficeOtherDataJSON = {!! $parent_office_content !!};

    setCoverInformation();

    $('#createPlanJsTree').jstree({
        "core": {
            "check_callback": true,
            'data': templateArray
        },
        "types": {
            "default": {
                "icon": "fal fa-edit"
            },
        },
        "plugins": ["dnd", "search", "types"]
    }).bind("select_node.jstree", function (e, data) {
        if (data.node.children.length > 0) {
            $('.summernote').summernote('disable');
            $('#createPlanJsTree').jstree(true).deselect_node(data.node);
            $('#createPlanJsTree').jstree(true).toggle_node(data.node);
        }
        activePdf = data.node.id;
        setCoverInformation();
        templateArray.map(function (value, index) {
            if (value.id === activePdf) {
                content = value.content;
                $('.summernote').summernote('enable');
                $("#pdfContent_" + value.content_id).html(content);
                $('.note-editable').html(content);
                tinymce.get("kt-tinymce-1").setContent(content);
            }
        });
        setCoverInformation();
    });


    for (let i = 0; i < templateArray.length; i++) {
        var arrayData = {
            "id": templateArray[i].id,
            "title": templateArray[i].text,
            "content": templateArray[i].content
        }
        auditPaperList.push(arrayData);

        var dataHtml = '<div class="pdf-screen">' +
            // '<p class="pageTileNumber">' + 'Audit Plan Form for Compliance Audit' + '</p>' +
            '<div id="pdfContent_' + templateArray[i].content_id + '">' + templateArray[i].content + '</div>' +
            '</div>';
        setCoverInformation();
        $("#writing-screen-wrapper").append(dataHtml);
    }

    templateArray.map(function (value, index) {
        cover = $("#pdfContent_" + value.content_id).html();
        value.content = cover;
    });


    function setCoverInformation() {
        $('.top_audit_directorate_name_field').html("{{$cover_info['directorate_name']}}")
        $('.bottom_audit_directorate_name_field').html("{{$cover_info['directorate_name']}}")
        $('.responsible_party_name_field').html("{{$cover_info['party_name']}}")
        $('.financial_year_field').html("{{$cover_info['fiscal_year']}}")

        parentOfficeOtherDataJSON.map((content) => {
            if (content.content_id === 'content_1') {
                $('.entity_short_description').html(content.content)
            }
            if (content.content_id === 'content_1_1') {
                $('.board_of_directors').html(content.content)
            }
            if (content.content_id === 'content_1_2') {
                $('.organizational_structure').html(content.content)
            }
            if (content.content_id === 'content_1_3') {
                $('.organization_manpower_summary').html(content.content)
            }
            if (content.content_id === 'content_2') {
                $('.entity_important_features').html(content.content)
            }
            if (content.content_id === 'content_2_1') {
                $('.mission').html(content.content)
            }
            if (content.content_id === 'content_2_2') {
                $('.vision').html(content.content)
            }
            if (content.content_id === 'content_2_3') {
                $('.financial_statements').html(content.content)
            }
            if (content.content_id === 'content_3') {
                $('.revenue_expenditure').html(content.content)
            }
            if (content.content_id === 'content_4') {
                $('.capital_expenditure').html(content.content)
            }

        });
    }

    function checkIdAndSetContentTinyMce(e) {
        templateArray.map(function (value, index) {
            if (value.id === activePdf) {
                content = tinymce.get("kt-tinymce-1").getContent();
                value.content = content;
                $("#pdfContent_" + value.content_id).html(content);
            }
        });
    }

    function checkIdAndSetContent(content) {
        templateArray.map(function (value, index) {
            if (value.id === activePdf) {
                value.content = content;
                $("#pdfContent_" + value.content_id).html(content);
            }
        });
    }

    var addTeamLeaderInAuditPlan = function (context) {
        ui = $.summernote.ui;

        // create button
        var button = ui.button({
            contents: '<i class="fad fa-users"/>',
            tooltip: 'Office Employee',
            click: function () {
                //context.invoke('editor.insertText', 'Team ');
                //$('#officeEmployeeModal').modal('show');
                showTeamCreateModal();
            }
        });
        return button.render();   // return button as jquery object
    }

    var addAuditTeamMemberAuditPlan = function (context) {
        ui = $.summernote.ui;

        // create button
        var button = ui.button({
            contents: '<i class="fad fa-users"/>',
            tooltip: 'Audit Team',
            click: function () {
                //showTeamCreateModal();
            }
        });
        return button.render();   // return button as jquery object
    }

    var addAuditScheduleCalendarAuditPlan = function (context) {
        ui = $.summernote.ui;

        // create button
        var scheduleButton = ui.button({
            contents: '<i class="fad fa-calendar"/>',
            tooltip: 'Audit Schedule',
            click: function () {
                showAuditScheduleModal();
            }
        });
        return scheduleButton.render();   // return button as jquery object
    }

    $('.summernote').summernote({
        height: 600,
        fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'SolaimanLipi'],
        toolbar: [
            ['custommenu', ['addTeamLeader', 'addAuditTeamMember', 'addAuditScheduleCalendar']],
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
        ],
        buttons: {
            addTeamLeader: addTeamLeaderInAuditPlan,
            addAuditTeamMember: addAuditTeamMemberAuditPlan,
            addAuditScheduleCalendar: addAuditScheduleCalendarAuditPlan
        },
        callbacks: {
            onChange: function (contents, templateArray) {
                if ($("#createPlanJsTree").jstree("get_selected").length === '0') {
                } else {
                    checkIdAndSetContent(contents);
                }
            }
        }
    });

    tinymce.init({
        selector: '.kt-tinymce-1',
        menubar: false,
        min_height: 600,
        height: 600,
        max_height: 640,
        branding: false,
        toolbar: ['styleselect fontselect fontsizeselect | blockquote subscript superscript',
            'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify | table',
            'bullist numlist | outdent indent | advlist | autolink | lists charmap | print preview |  code'],
        plugins: 'advlist autolink link image lists charmap print preview code table',
        context_menu: 'link image table',
        setup: function (editor) {
            editor.on('init change blur', function (e) {
                checkIdAndSetContentTinyMce(e)
            });
        },
    });

    Split(['#split-0', '#split-1', '#split-2'], {
        minSize: 150,
        snapOffset: 10,
        gutterSize: 5,
    });

    /*function showTeamCreateModal(office_id = 1) {
        url = '{{route('audit.plan.audit.editor.load-office-employee-modal')}}';
        data = {office_id};
        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            if (response.status === 'error') {
                toastr.error('No data found');
            } else {
                $(".load-office-wise-employee").html(response)
                $('#officeEmployeeModal').modal('show');
            }
        })
    }*/

    function showAuditScheduleModal(office_id = 1) {
        url = '{{route('audit.plan.audit.editor.load-audit-schedule-modal')}}';
        annual_plan_id = '{{$annual_plan_id}}';
        activity_id = '{{$activity_id}}';
        fiscal_year_id = '{{$fiscal_year_id}}';

        data = {office_id, annual_plan_id, activity_id, fiscal_year_id};
        annual_plan_id = '{{$annual_plan_id}}';
        activity_id = '{{$activity_id}}';
        fiscal_year_id = '{{$fiscal_year_id}}';

        data = {office_id, annual_plan_id, activity_id, fiscal_year_id};
        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            if (response.status === 'error') {
                toastr.error('No data found');
            } else {
                $(".load-audit-schedule").html(response)
                $('#auditScheduleModal').modal('show');
            }
        })
    }

</script>
