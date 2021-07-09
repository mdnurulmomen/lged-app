<x-modal id="op_activity_modal" title="Create Operation Activity"
         url="{{route('settings.operational-plan.activity.store')}}" method="post">
    <form id="op_activity_form">
        <div class="form-group row">
            <label for="duration_id" class="col-3 col-form-label">Plan Duration</label>
            <div class="col-9">
                <select name="duration_id" id="duration_id" class="form-control select-select2">
                    <option value="">Choose Duration</option>
                    @forelse($plan_durations as $plan_duration)
                        <option value="{{$plan_duration['id']}}">{{$plan_duration['start_year']}}
                            - {{$plan_duration['end_year']}}</option>
                    @empty
                    @endforelse
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="outcome_id" class="col-3 col-form-label">Plan Outcome</label>
            <div class="col-9">
                <select name="outcome_id" id="outcome_id" class="form-control select-select2">
                    <option value="">Choose Outcome</option>
                    @forelse($plan_outcomes as $plan_outcome)
                        <option value="{{$plan_outcome['id']}}">{{$plan_outcome['outcome_no']}}</option>
                    @empty
                    @endforelse
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="output_id" class="col-3 col-form-label">Plan Output</label>
            <div class="col-9">
                <select name="output_id" id="output_id" class="form-control select-select2">
                    <option value="">Choose Output</option>
                    @forelse($plan_outputs as $plan_output)
                        <option value="{{$plan_output['id']}}">{{$plan_output['output_no']}}</option>
                    @empty
                    @endforelse
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="activity_parent_id" class="col-3 col-form-label">Parent Activity</label>
            <div class="col-9">
                <select name="activity_parent_id" id="activity_parent_id" class="form-control select-select2">
                    <option value="">Choose Parent Activity</option>
                    @forelse($op_activities as $op_activity)
                        <option value="{{$op_activity['id']}}">{{$op_activity['activity_no']}}</option>
                    @empty
                    @endforelse
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="activity_no" class="col-3 col-form-label">Activity No</label>
            <div class="col-9">
                <input placeholder="Activity No" class="form-control" type="text" value=""
                       id="activity_no" name="activity_no"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="title_en" class="col-3 col-form-label">Title English</label>
            <div class="col-9">
                <input placeholder="Title English" class="form-control" type="text" value=""
                       id="title_en" name="title_en"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="title_bn" class="col-3 col-form-label">Title Bangla</label>
            <div class="col-9">
                <input placeholder="Title Bangla" class="form-control" type="text" value=""
                       id="title_bn" name="title_bn"/>
            </div>
        </div>
    </form>
</x-modal>

<script>
    $('#btn_op_activity_modal_save').click(function () {
        url = $(this).data('url');
        data = $('#op_activity_form').serialize();
        method = $(this).data('method');
        submitModalData(url, data, method, 'op_activity_modal')
    });
</script>
