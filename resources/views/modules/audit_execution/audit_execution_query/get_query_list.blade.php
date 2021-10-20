<div class="col-lg-12 mt-2">
    <button
        type="button"
        data-id="1"
        class="float-right font-weight-bolder font-size-sm mb-3 btn btn-success btn-sm btn-bold btn-square btn_create_audit_query">
        <i class="far fa-plus mr-1"></i> Add Query
    </button>
    <button
        type="button"
        class="float-right font-weight-bolder font-size-sm mr-2 btn btn-success btn-sm btn-bold btn-square sendQuery">
        <i class="far fa-paper-plane mr-1"></i> Send
    </button>
</div>

<table class="table table-striped mt-2">
    <thead class="thead-light">
    <tr class="datatable-row" style="left: 0px; ">
        <th class="datatable-cell datatable-cell-sort text-center">
            Select
        </th>
        <th class="datatable-cell datatable-cell-sort text-center">
            Query
        </th>
        <th class="datatable-cell datatable-cell-sort text-center">
            Action
        </th>
    </tr>
    </thead>
    <tbody style="" class="datatable-body">
    @forelse($audit_query_list as $query)
        <tr data-row="{{$loop->iteration}}" class="datatable-row" style="left: 0px;">
            <td class="datatable-cell text-center"><span><input @if($query['audit_query']) checked disabled @endif class="selectQuery"
                                                                data-query-bn="{{$query['query_title_bn']}}"
                                                                data-query-en="{{$query['query_title_en']}}"
                                                                data-query-id="{{$query['id']}}"
                                                                value="{{$query['id']}}"
                                                                name="select_query"
                                                                type="checkbox"></span></td>
            <td class="datatable-cell"><span>{{$query['query_title_bn']}}</span></td>
            <td class="datatable-cell text-center">
                @if($query['audit_query'])
                    @if($query['audit_query']['is_query_document_received'])
                        <button
                            type="button"
                            class="float-right font-weight-bolder font-size-sm ml-2 btn btn-bg-secondary disabled btn-sm btn-bold btn-square">
                            Received
                        </button>
                    @else
                        <button
                            onclick="Audit_Query_Container.receivedQuery('{{$query['id']}}')"
                            type="button"
                            class="float-right font-weight-bolder font-size-sm ml-2 btn btn-success btn-sm btn-bold btn-square receivedQuery">
                            Receive
                        </button>
                    @endif
                @endif
            </td>
        </tr>
    @empty
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td colspan="4" class="datatable-cell text-center"><span>Nothing Found</span></td>
        </tr>
    @endforelse
    </tbody>
</table>
@include('modules.settings.x_audit_query.partials.query_modal')

<script>

    $('.sendQuery').click(function () {
        Audit_Query_Container.sendQuery($(this));
    });
</script>
