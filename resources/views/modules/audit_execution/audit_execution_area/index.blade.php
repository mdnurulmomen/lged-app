<x-title-wrapper>Audit Area</x-title-wrapper>
<div class="card sna-card-border d-flex flex-wrap flex-row">
    <div class="col-xl-6 text-left">
        <select id="project" class="form-control select-select2" onchange="Risk_Assessment_Item_Container.laodItemRiskAssessments('project', this.value)">
            <option value="" selected>Select Project</option>
            @foreach ($allProjects as $project)
                <option value="{{ $project['id'] }}">{{ $project['name_en'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-xl-6 text-right">
        <button type="button" class="font-weight-bolder font-size-sm mr-3 btn btn-primary btn-sm btn-bold btn-square btn_create_audit_area">
            <i class="far fa-plus mr-1"></i> Create Audit Area
        </button>
    </div>
</div>

<div class="card sna-card-border mt-2" style="margin-bottom: 1cm;">
    <div class="table-responsive load-table-data" data-href="{{ route('audit.execution.areas.list') }}">
    </div>
</div>

<script>
     $(function () {
        loadData();

        $('.btn_create_audit_area').click(function () {

            project_id = $('#project').val();
            url = "{{ route('audit.execution.areas.create') }}";

            data = {project_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error('Server Error');
                } else {
                    $(".offcanvas-title").text('Audit Area');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '50%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                    loadData();
                }
            });
        });
    });
    $('#project_id').change(function () {
        loadData();
    });
    function loadData() {
        url = $(".load-table-data").data('href');
        var sector_id = $('#project_id').find(":selected").val();
        var data = {sector_id};
        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (resp) {
            if (resp.status === 'error') {
                toastr.error('no');
                console.log(resp.data)
            } else {
                $(".load-table-data").html(resp);
            }
        });
    }
</script>

@include('scripts.script_generic')
