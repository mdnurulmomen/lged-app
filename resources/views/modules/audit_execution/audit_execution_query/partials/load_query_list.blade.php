
<table class="table table-striped mt-2">
    <thead class="thead-light">
    <tr class="datatable-row" style="left: 0px; width: 100%">
        <th width="5%" class="datatable-cell datatable-cell-sort text-center">
            Select
        </th>
        <th width="75%"  class="datatable-cell datatable-cell-sort">
            Query
        </th>
        <th width="20%"  class="datatable-cell datatable-cell-sort">
            Action
        </th>
    </tr>
    </thead>
    <tbody style="" class="datatable-body">
    @forelse($audit_query_list as $query)
        <tr data-row="{{$loop->iteration}}" class="datatable-row" style="left: 0px;">
            <td class="datatable-cell text-center">
                <span>
                    <input @if($query['audit_query'] && $query['audit_query']['status']!='rejected') checked disabled @endif class="selectQuery"
                        data-query-bn="{{$query['query_title_bn']}}"
                        data-query-en="{{$query['query_title_en']}}"
                        data-query-id="{{$query['id']}}"
                        value="{{$query['id']}}"
                        name="select_query"
                        type="checkbox">
                </span>
            </td>
            <td class="datatable-cell">
                <span>{{$query['query_title_bn']}}</span>
                @if($query['audit_query'])
                    <span data-toggle="tooltip" data-placement="top" title="{{$query['audit_query']['comment']}}" class="badge {{$query['audit_query']['status']=='rejected'?'badge-danger':'badge-info' }}
                        text-uppercase m-1 p-1 ">{{$query['audit_query']['status']}}</span>
                @endif
            </td>
            <td class="datatable-cell">
                @if($query['audit_query'] && $query['audit_query']['status']!='rejected')
                    @if($query['audit_query']['is_query_document_received'])
                        <button
                            type="button"
                            class="font-weight-bolder font-size-sm ml-2 btn btn-bg-secondary disabled btn-sm btn-bold btn-square">
                            Received
                        </button>
                    @else
                        <button
                            onclick="Audit_Query_Container.receivedQuery('{{$query['id']}}')"
                            type="button"
                            class="font-weight-bolder font-size-sm ml-2 btn btn-success btn-sm btn-bold btn-square receivedQuery">
                            Receive
                        </button>
                    @endif

                    <button
                        data-ac-query-id="{{$query['audit_query']['id']}}"
                        data-query-title-bn="{{$query['query_title_bn']}}"
                        onclick="Audit_Query_Container.rejectQuery($(this))"
                        type="button"
                        class="font-weight-bolder font-size-sm ml-2 btn btn-danger btn-sm btn-bold btn-square receivedQuery">
                        Reject
                    </button>
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
