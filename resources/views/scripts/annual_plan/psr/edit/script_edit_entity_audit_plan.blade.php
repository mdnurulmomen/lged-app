<script>
    $(function (){
        progress(1800, 1800, $('#progressBar'));
    });

    function progress(timeleft, timetotal, $element) {
        var progressBarWidth = timeleft * $element.width() / timetotal;
        // $element.find('div').animate({ width: progressBarWidth }, 500).html(' ৩০ মিনিটের মধ্যে সংরক্ষণ বাটনে ক্লিক করুন ('+Math.floor(timeleft/60) + ":"+ timeleft%60+')');
        $element.find('div').html(' ৩০ মিনিটের মধ্যে সংরক্ষণ বাটনে ক্লিক করুন ('+Math.floor(timeleft/60) + ":"+ timeleft%60+')');
        if(timeleft > 0) {
            setTimeout(function() {
                progress(timeleft - 1, timetotal, $element);
            }, 1000);
        }
    }

    var auditPaperList = [];
    var activePdf = '';
    var templateArray = {!! $content !!};

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
        templateArray.map(function (value, index) {
            if (value.id === activePdf) {
                content = value.content;
                $("#pdfContent_" + value.content_id).html(content);
                tinymce.get("kt-tinymce-1").setContent(content);
            }
        });
    });


    for (let i = 0; i < templateArray.length; i++) {
        var arrayData = {
            "id": templateArray[i].id,
            "title": templateArray[i].text,
            "content": templateArray[i].content
        }
        auditPaperList.push(arrayData);

        dataHtml = '<div class="pdf-screen">' +
            '<div id="pdfContent_' + templateArray[i].content_id + '">' + templateArray[i].content + '</div>' +
            '</div>';
        $("#writing-screen-wrapper").append(dataHtml);
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
        font_formats: "Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Oswald=oswald; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Times New Roman=times new roman,times; Verdana=verdana,geneva; Solaimanlipi=solaimanlipi; AdorshoLipi=adorshoLipi",
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
