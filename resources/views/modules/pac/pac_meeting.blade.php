<x-title-wrapper>Pac Meeting List</x-title-wrapper>
<div class="card sna-card-border d-flex flex-wrap flex-row">
    <div class="col-xl-12 text-right">
        <button type="button"
                onclick="Pac_Container.createPacMeeting()"
                class="font-weight-bolder font-size-sm mr-3 btn btn-success btn-sm btn-bold btn-square">
            <i class="far fa-plus mr-1"></i> Create New
        </button>
    </div>
</div>
<div class="card sna-card-border mt-2">
    <div id="load_pac_meeting_list">
        <div class="d-flex align-items-center">
            <div class="spinner-grow text-warning mr-3" role="status">
                <span class="sr-only"></span>
            </div>
            <div>
                loading.....
            </div>
        </div>
    </div>
</div>



<script>
    $(function () {
        Pac_Container.loadPacList();
    });
    var Pac_Container = {
        loadPacList: function (page = 1, per_page = 10) {
            let url = '{{route('pac.pac-meeting-list')}}';
            let data = {page, per_page};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#load_pac_meeting_list').html(response);
                }
            });
        },

        createPacMeeting: function () {
            let url = '{{route('pac.pac-meeting-create')}}';
            let data = {};
            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#kt_content').html(response);
                }
            });
        },

        showPacMeeting: function (elem) {
            pac_meeting_id =  elem.data('pac-meeting-id');
            let url = '{{route('pac.pac-meeting-show')}}';
            let data = {pac_meeting_id};
            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $(".offcanvas-title").text('বৈঠক আহ্বান');
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

        showPacMeetingMinutes: function (elem) {
            pac_meeting_id =  elem.data('pac-meeting-id');
            let url = '{{route('pac.pac-meeting-minutes')}}';
            let data = {pac_meeting_id};
            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#kt_content').html(response);
                }
            });
        },
        sentToPac: function (elem) {
            pac_meeting_id =  elem.data('pac-meeting-id');
            swal.fire({
                title: 'আপনি কি প্রেরণ করতে চান?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'হ্যাঁ',
                cancelButtonText: 'না'
            }).then(function(result) {
                if (result.value) {
                    let url = '{{route('pac.sent-to-pac')}}';
                    let data = {pac_meeting_id};
                    KTApp.block('#kt_content', {
                        opacity: 0.1,
                        state: 'primary' // a bootstrap color
                    });
                    ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                        KTApp.unblock('#kt_content');
                        if (response.status === 'error') {
                            toastr.error(response.data)
                        } else {
                            toastr.success(response)
                        }
                    });
                }
            });


        },
    };
</script>
