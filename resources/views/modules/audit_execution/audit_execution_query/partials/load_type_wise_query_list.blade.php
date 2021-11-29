<table class="table table-striped mt-2">
    <tbody style="" class="datatable-body">
    @forelse($audit_query_list as $query)
        <tr id="row_{{$query['id']}}" data-row="{{$loop->iteration}}" class="datatable-row" style="left: 0px;">
            <td class="datatable-cell text-center">
                <button type="button" class="audit-query-item btn btn-icon btn-outline-success border-0 btn-xs mr-2"
                        data-query-title-bn="{{$query['query_title_bn']}}">
                    <i class="fa fa-plus"></i>
                </button>
                {{--<input type="checkbox" class="audit-query-item" data-query-title-bn="{{$query['query_title_bn']}}">--}}
            </td>
            <td class="datatable-cell">
               {{$query['query_title_bn']}}
            </td>
        </tr>
    @empty
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td colspan="2" class="datatable-cell text-center">Nothing Found</td>
        </tr>
    @endforelse
    </tbody>
</table>

<script>
    $(".audit-query-item").click(function() {
        query_title_bn = $(this).data('query-title-bn');
        Query_Create_Container.addQueryItem(query_title_bn);

        /*if($(this).is(":checked")) {
            query_title_bn = $(this).data('query-title-bn');
            Query_Create_Container.addQueryItem(query_title_bn);
        }*/
    });
</script>
