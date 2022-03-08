<x-title-wrapper>Outcome Indicator</x-title-wrapper>

<div class="card sna-card-border mt-3" style="margin-bottom:15px;">
    <div class="d-flex justify-content-end">
        <button class="btn btn-info btn-sm btn-bold btn-square mr-2" onclick="loadPage('{{ route('audit.plan.strategy.indicator.outcomes')}}')">
            <i class="far fa-info mr-1"></i> Details View
        </button>

        <a class="btn btn-success btn-sm btn-bold btn-square btn_create_indicator_outcome"
           href="javascript:;">
            <i class="far fa-plus mr-1"></i> Add Outcome Indicator
        </a>
    </div>
</div>

<div class="card sna-card-border mt-3" style="margin-bottom:30px;">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-light">
            <tr>
                <th class="align-middle">Indicator</th>
                <th>Frequency of Measurement</th>
                <th>Data source</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($indecators['data'] as $indecator)
                <tr>
                    <td><span>{{ $indecator['name_en'] }}</span></td>
                    <td><span>{{ $indecator['frequency_en'] }}</span></td>
                    <td><span>{{ $indecator['datasource_en'] }}</span></td>
                    <td>
                        <div class="btn-group">
                            <a href="javascript:;" onclick="loadPage('{{ route('audit.plan.strategy.indicator.outcome.show', $indecator['id'])}}')" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_view_audit_annual_activity">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="javascript:;" onclick="loadPage('{{ route('audit.plan.strategy.indicator.outcome.edit', $indecator['id'])}}')" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="javascript:;" data-url="" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-danger btn_edit_audit_annual_activity">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <td colspan="4" class="text-center"><span>No data found.</span></td>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
      $('.btn_create_indicator_outcome').click(function () {
        url = '{{route('audit.plan.strategy.indicator.outcome.create')}}';

        data = {}
        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
            $('#kt_content').html(response);
        })
    });

    function loadPage(url){
        data = {};
        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
            $('#kt_content').html(response);
        })
    }

</script>
