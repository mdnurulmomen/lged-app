<div class="row" style="position: sticky;top: 0;background: white;">
    <div class="col-lg-12 mt-2">
        <button
            type="button"
            data-id="1"
            class="add_recommendation float-right font-weight-bolder font-size-sm mb-3 btn btn-success btn-sm btn-bold btn-square btn_create_audit_query">
            <i class="far fa-plus mr-1"></i> Add Recommendation
        </button>
    </div>
</div>

<div class="row recommendation_form" style="display: none">
    <div class="col-md-12">
        <form id="add_recommendation_form">
            <input type="hidden" id="memo_id" name="memo_id" value="{{$memo_id}}">
            <div class="col-lg-12 mt-2">
                <textarea placeholder="Enter Recommendation" class="form-control"
                          name="audit_recommendation"></textarea>
            </div>
            <div class="col-lg-12 mt-2">
                <button
                    type="button"
                    data-id="1"
                    class="float-right font-weight-bolder font-size-sm mb-3 btn btn-danger btn-sm btn-bold btn-square btn_close">
                   Close
                </button>

                <button
                    type="button"
                    data-id="1"
                    class="float-right font-weight-bolder font-size-sm mb-3 ml-2 btn btn-success btn-sm btn-bold btn-square btn_create_recommendation">
                   Save
                </button>
            </div>
        </form>
    </div>
</div>

<table class="table table-striped mt-2">
    <thead class="thead-light">
    <tr class="datatable-row" style="left: 0px; ">
        <th class="datatable-cell datatable-cell-sort">
            No
        </th>
        <th class="datatable-cell datatable-cell-sort">
            Recommendation
        </th>
    </tr>
    </thead>
    <tbody style="" class="datatable-body">
    @forelse($recommendation_list as $recommendation)
        <tr data-row="{{$loop->iteration}}" class="datatable-row" style="left: 0px;">
            <td class="datatable-cell"><span>{{$loop->iteration}}</span></td>
            <td class="datatable-cell">
                {{$recommendation['audit_recommendation']}}
            </td>
        </tr>
    @empty
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td colspan="4" class="datatable-cell text-center"><span>Nothing Found</span></td>
        </tr>
    @endforelse
    </tbody>
</table>
<script>

    $('.btn_create_recommendation').click(function () {
        memo_id = $('#memo_id').val();
        url = '{{route('audit.execution.memo.audit-memo-recommendation-store')}}';
        data = $('#add_recommendation_form').serialize();
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
            if (resp.status === 'error') {
                toastr.error(resp.data);
            } else {
                toastr.success(resp.data);
                Memo_List_Container.recommendationMemo(memo_id)
            }
        });
    });

    $('.add_recommendation').click(function () {
        $('.recommendation_form').show();
    });

    $('.btn_close').click(function (){
       $('.recommendation_form').hide();
    });
</script>
