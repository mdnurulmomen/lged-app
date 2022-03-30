<script>
    var PAC_Worksheet_Report_Container = {
        storePacWorksheetReport: function (elem) {
            url = '{{route('pac.meeting-worksheet-report.store')}}';
            pac_meeting_id = '{{$pac_meeting_id}}';
            pac_meeting_worksheet_id = elem.data('pac-meeting-worksheet-id');
            worksheet_description = JSON.stringify(templateArray);
            data = {pac_meeting_id,pac_meeting_worksheet_id,worksheet_description};

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {
                    elem.data('pac-meeting-worksheet-id',response.data.pac_meeting_worksheet_id);
                    $("#pacMeetingWorksheetId").val(response.data.pac_meeting_worksheet_id);
                    toastr.success('বৈঠকের কার্যপত্র সফলভাবে সংরক্ষণ করা হয়েছে');
                } else {
                    toastr.error('Not Saved');
                    console.log(response);
                }
            })
        },

        previewPacWorksheetReport: function () {
            //$('.pac_worksheet_save').click();
            worksheet_description = templateArray;
            scope = 'preview';
            data = {scope,worksheet_description};
            url = '{{route('pac.meeting-worksheet-report.preview')}}';

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('বৈঠকের কার্যপত্র');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '70%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },
    }

</script>
