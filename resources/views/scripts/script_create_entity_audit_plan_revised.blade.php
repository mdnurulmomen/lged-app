<script>
    $("#add").click(function () {
        var treeList = $("a");
        console.log('treeList', treeList);
    });

    var auditPaperList = [];
    var activePdf = '';
    var templateArray = {!! $content !!};

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
        if (value.id === '0') {
            cover = $("#pdfContent_content_0_1").html();
            value.content = cover;
        }
    });


    function setCoverInformation() {
        $('.top_audit_directorate_name_field').html("{{$cover_info['directorate_name']}}")
        $('.bottom_audit_directorate_name_field').html("{{$cover_info['directorate_name']}}")
        $('.responsible_party_name_field').html("{{$cover_info['party_name']}}")
        $('.financial_year_field').html("{{$cover_info['fiscal_year']}}")
    }

    function checkIdAndSetContent(content) {
        templateArray.map(function (value, index) {
            if (value.id === activePdf) {
                value.content = content;
                $("#pdfContent_" + value.content_id).html(content);
            }
        });
    }

    $('.summernote').summernote({
        height: 600,
        fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'SolaimanLipi'],
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
        ],
        callbacks: {
            onChange: function (contents, templateArray) {
                if ($("#createPlanJsTree").jstree("get_selected").length === '0') {
                } else {
                    checkIdAndSetContent(contents);
                }
            }
        }
    });

    Split(['#split-0', '#split-1', '#split-2'], {
        minSize: 150,
        snapOffset: 10,
        gutterSize: 5,
    });

</script>
