<form  id="individual_plan_form" autocomplete="off">
    <input type="hidden" value="{{$data['audit_plan_id']}}" name="id">
    <input type="hidden" value="{{$data['yearly_plan_location_id']}}" name="yearly_plan_location_id">
    <input type="hidden" value="0" name="yearly_plan_id">

        <div class="row mt-2">
            <div class="col-md-6">
                <label>Scopes</label>
                <textarea id="scope" class="form-control"
                          name="scope">{{$individualPlanInfo ? $individualPlanInfo['scope'] : ''}}</textarea>
            </div>
            <div class="col-md-6">
                <label>Objectives</label>
                <textarea id="objective" class="form-control"
                          name="objective">{{$individualPlanInfo ? $individualPlanInfo['objective'] : ''}}</textarea>
            </div>
        </div>
        <div class="row mt-2">
        <div class="col-md-12">
            <table id="milestone-table" class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th width="30%">Particulars</th>
                    <th width="30%">Start Date</th>
                    <th width="30%">End Date</th>
                    <th width="10%">Action</th>
                </tr>
                </thead>
                <tbody>
                @if($individualPlanInfo && $individualPlanInfo['milestones'])
                    @foreach($individualPlanInfo['milestones'] as $milestone)
                        <tr class="milestone_row">
                            <td>
                                <input  type="text" class="form-control milestone_bn" value="{{$milestone['milestone_bn']}}">
                            </td>
                            <td>
                                <input  type="text" class="form-control start_date date" value="{{formatDate($milestone['start_date'],'en','/')}}">
                            </td>
                            <td>
                                <input  type="text" class="form-control end_date date" value="{{formatDate($milestone['end_date'],'en','/')}}">
                            </td>
                            <td>
                                <div style="display: flex">
                                    <button type="button" title="Add"
                                            onclick=""
                                            class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2 add_row">
                                        <span class="fad fa-plus"></span>
                                    </button>

                                    <button type='button' title="Remove"
                                            data-row='row1'
                                            onclick=""
                                            class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2 delete_row'>
                                        <span class='fal fa-trash-alt'></span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
                <tr class="milestone_row">
                    <td>
                        <input  type="text" class="form-control milestone_bn" value="">
                    </td>
                    <td>
                        <input  type="text" class="form-control start_date date" value="">
                    </td>
                    <td>
                        <input  type="text" class="form-control end_date date" value="">
                    </td>
                    <td>
                        <div style="display: flex">
                            <button type="button" title="Add"
                                    onclick=""
                                    class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2 add_row">
                                <span class="fad fa-plus"></span>
                            </button>

                            <button type='button' title="Remove"
                                    data-row='row1'
                                    onclick=""
                                    class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2 delete_row'>
                                <span class='fal fa-trash-alt'></span>
                            </button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</form>

<button class="btn btn-sm btn-square btn-outline-primary float-right save-button">
    <i class="fa fa-save"></i> সংরক্ষণ
</button>

<script>
    $(".save-button").on('click', function(event){

        loaderStart('Please wait...');

        milestone_list = {};

        $('.milestone_row').each(function (j, w) {
            if($(this).find('.milestone_bn').val()){
                milestone_list[j] = {};
                milestone_list[j]['milestone_bn'] = $(this).find('.milestone_bn').val();
                milestone_list[j]['start_date'] = formatDate($(this).find('.start_date').val());
                milestone_list[j]['end_date'] = formatDate($(this).find('.end_date').val());
            }
        });


            let id = $("input[name=id]").val();
            let yearly_plan_id = $("input[name=yearly_plan_id]").val();
            let yearly_plan_location_id = $("input[name=yearly_plan_location_id]").val();
            let scope = $("textarea[name=scope]").val();
            let objective = $("textarea[name=objective]").val();

            let data = {id, scope, objective, yearly_plan_id, yearly_plan_location_id, milestone_list};

            url = "{{route('audit.plan.individual.store')}}";

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                loaderStop();
                if (response.status == 'error') {
                    toastr.error(response.data)
                } else {
                    toastr.success(response.data);
                    $('#kt_quick_panel_close').click();
                    $('#strategic_plan_year').trigger('change');
                }
            });
    });

    $("#milestone-table").on("click", ".add_row", function() {
        $('#milestone-table > tbody:last').append(
            `<tr class="milestone_row">
                    <td>
                        <input type="text" class="form-control milestone_bn" value="">
                    </td>
                    <td>
                        <input type="text" class="form-control start_date date" value="">
                    </td>
                    <td>
                        <input type="text" class="form-control end_date date" value="">
                    </td>
                    <td>
                        <div style="display: flex">
                            <button type="button" title="Add"
                                    class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2 add_row">
                                <span class="fad fa-plus"></span>
                            </button>

                            <button type='button' title="Remove"
                                    data-row='row1'
                                    class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2 delete_row'>
                                <span class='fal fa-trash-alt'></span>
                            </button>
                        </div>
                    </td>
                </tr>`
        );
        $("#milestone-table").on("click", ".delete_row", function() {
            $(this).closest("tr").remove();
        });
    });

    $("#milestone-table").on("click", ".delete_row", function() {
        $(this).closest("tr").remove();
    });
</script>
