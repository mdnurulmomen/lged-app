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
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#kt_content').html(response);
                }
            });
        },
    };
</script>
