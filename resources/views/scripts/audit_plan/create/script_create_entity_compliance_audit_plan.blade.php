<script>
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
        "plugins": ["search", "types"]
    }).bind("select_node.jstree", function (e, data) {
        if (data.node.children.length > 0) {
            $('#createPlanJsTree').jstree(true).deselect_node(data.node);
            $('#createPlanJsTree').jstree(true).toggle_node(data.node);
        }
        activePdf = data.node.id;
        setCoverInformation();
        templateArray.map(function (value, index) {
            if (value.id === activePdf) {
                content = value.content;
                $("#pdfContent_" + value.content_id).html(content);
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
            '<div id="pdfContent_' + templateArray[i].content_id + '">' + templateArray[i].content + '</div>' +
            '</div>';
        setCoverInformation();
        $("#writing-screen-wrapper").append(dataHtml);
    }

    function setJsonContentFromPlan() {
        templateArray.map(function (value, index) {
            cover = $("#pdfContent_" + value.content_id).html();
            value.content = cover;
        });
    }

    setJsonContentFromPlan();


    function setCoverInformation() {
        $('.directorate_address_top').html("{!! $cover_info['directorate_address_top'] !!}");
        $('.directorate_address_footer').html("{{$cover_info['directorate_address_footer']}}");
        $('.directorate_website').html("{{$cover_info['directorate_website']}}");
        $('.directorate_name').html("{{$cover_info['directorate_name']}}");
        $('.created_by').html("{!! $cover_info['created_by'] !!}");
        $('.project_name').html("{{$cover_info['project_name_bn']}}");
        $('.entity_name').html("{{$cover_info['entity_name']}}");
        $('.entity_office_type').html("{{$cover_info['entity_office_type']}}");
        $('.audit_fiscal_year').html("{{$cover_info['fiscal_year']}}");
        $('.thematic_issue').text("{{$cover_info['annual_plan_type']}}");
        $('.audit_subject_matter').text("{{$cover_info['audit_subject_matter']}}");

        if (!isEmpty(parentOfficeOtherDataJSON)) {
            parentOfficeOtherDataJSON.map((content) => {
                if (content.content_id == 'content_1') {
                    $('.entity_short_description').html(content.content)
                }
                if (content.content_id == 'content_1_1') {
                    $('.board_of_directors').html(content.content)
                }
                if (content.content_id == 'content_1_2') {
                    $('.organizational_structure').html(content.content)
                }
                if (content.content_id == 'content_1_3') {
                    $('.organization_manpower_summary').html(content.content)
                }
                if (content.content_id == 'content_2') {
                    $('.entity_important_features').html(content.content)
                }
                if (content.content_id == 'content_2_1') {
                    $('.mission').html(content.content)
                }
                if (content.content_id == 'content_2_2') {
                    $('.vision').html(content.content)
                }
                if (content.content_id == 'content_2_3') {
                    $('.financial_statements').html(content.content)
                }
                if (content.content_id == 'content_3') {
                    $('.revenue_expenditure').html(content.content)
                }
                if (content.content_id == 'content_4') {
                    $('.capital_expenditure').html(content.content)
                }

            });
        }
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

    tinymce.init({
        selector: '.kt-tinymce-1',
        menubar: false,
        min_height: 600,
        height: 600,
        max_height: 640,
        branding: false,
        content_style: "body {font-family: solaimanlipi;font-size: 13pt;}",
        fontsize_formats: "8pt 10pt 12pt 13pt 14pt 18pt 24pt 36pt",
        font_formats: "Arial=arial,helvetica,sans-serif; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Impact=impact,chicago; Oswald=oswald; Symbol=symbol; Times New Roman=times new roman,times; Verdana=verdana,geneva; Shonar Bangla=shonar bangla; Nikosh=nikosh; Nikosh Ban=NikoshBAN; Nikosh Light Ban=NikoshLightBAN; Kalpurush=kalpurush; Solaimanlipi=solaimanlipi; AdorshoLipi=adorshoLipi;",
        /*toolbar: ['styleselect fontselect fontsizeselect | blockquote subscript superscript',
            'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify | table',
            'bullist numlist | outdent indent | advlist | autolink | lists charmap | print preview |  code'],*/
        toolbar: ['styleselect fontselect fontsizeselect | blockquote subscript superscript | undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify ',
            'table | bullist numlist | outdent indent | advlist | autolink | lists charmap | print preview |  code'],
        plugins: 'advlist paste autolink link image lists charmap print preview code table',
        context_menu: 'link image table',
        setup: function (editor) {
            editor.on('init change blur', function (e) {
                checkIdAndSetContentTinyMce(e)
            });
        },
    });

    Split(['#split-0', '#split-1'], {
        minSize: 150,
        snapOffset: 10,
        gutterSize: 5,
    });
</script>
