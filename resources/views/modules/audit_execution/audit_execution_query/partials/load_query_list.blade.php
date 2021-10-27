
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
        <tr id="row_{{$query['id']}}" data-row="{{$loop->iteration}}" class="datatable-row" style="left: 0px;">
            <td class="datatable-cell text-center">
                <span>
                    <input @if($query['audit_query'] && $query['audit_query']['status']!='removed') checked disabled @endif class="selectQuery"
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
                @if($query['audit_query'] && $query['audit_query']['status'] != 'removed')
                    <span class="badge badge-info text-uppercase m-1 p-1 ">
                        {{$query['audit_query']['status']}}
                    </span>
                @endif
            </td>
            <td class="datatable-cell">
                @if($query['audit_query'] && $query['audit_query']['status'] != 'removed')
                    @if($query['audit_query']['is_query_document_received'] == 0)
                        <button onclick="Audit_Query_Container.receivedQuery('{{$query['id']}}')"
                            type="button" title="receive"
                            class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-primary btn-icon-primary receivedQuery">
                            <i class="fas fa-check-double"></i>
                        </button>

                        <button data-ac-query-id="{{$query['audit_query']['id']}}"
                                data-query-title-bn="{{$query['query_title_bn']}}"
                                onclick="Audit_Query_Container.rejectQuery($(this))"
                                type="button" title="remove"
                                class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-danger">
                            <i class="fas fa-trash"></i>
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
