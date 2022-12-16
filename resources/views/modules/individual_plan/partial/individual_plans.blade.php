<!-- The Modal -->
<div class="modal fade" id="individualPlanModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Individual Planning of <b>{{ $data['sector_name'] }}</b> for
                    <b>{{ $data['plan_year'] }}</b></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <input type="hidden" name="id" value="{{ isset($individualPlans) ? $individualPlans['id'] : 0 }}">

                <div class="form-group">
                    <label for="exampleInputEmail1">Scopes</label>
                    <textarea class="form-control" name="scope" rows="3">{{ isset($individualPlans) ? $individualPlans['scope'] :'' }}</textarea>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Objectives</label>
                    <textarea class="form-control" name="objective" rows="3">{{ isset($individualPlans) ? $individualPlans['objective'] : '' }}</textarea>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger submit-button btn-sm ml-auto save-button">Submit</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
        $(".save-button").on('click', function(event){
            loaderStart('Please wait...');
        
            let id = $("input[name=id]").val();
            let scope = $("textarea[name=scope]").val();
            let objective = $("textarea[name=objective]").val();

            let individualPlan = {id, scope, objective};
        
            url = "{{route('audit.plan.individual.store-individual-plan')}}";
        
            ajaxCallAsyncCallbackAPI(url, individualPlan, 'POST', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    toastr.success(response.data);
                    backToList();
                }
            });
        });
    });
</script>