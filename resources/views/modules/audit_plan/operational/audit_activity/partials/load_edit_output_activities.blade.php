<div class="form-group row">
        <label for="activity_no" class="col-3 col-form-label">Activity No</label>
        <div class="col-9">
            <input placeholder="Activity No" class="form-control" type="text" value="{{ $activity_info['data']['activity_no'] }}"
                id="activity_no" name="activity_no"/>
        </div>
    </div>
    <div class="form-group row">
        <label for="title_en" class="col-3 col-form-label">Title English</label>
        <div class="col-9">
            <input placeholder="Title English" class="form-control" type="text" value="{{ $activity_info['data']['title_en'] }}"
                id="title_en" name="title_en"/>
        </div>
    </div>
    <div class="form-group row">
        <label for="title_bn" class="col-3 col-form-label">Title Bangla</label>
        <div class="col-9">
            <input placeholder="Title Bangla" class="form-control" type="text" value="{{ $activity_info['data']['title_bn'] }}"
                id="title_bn" name="title_bn"/>
        </div>
    </div>

    <div class="form-group row">
        <label for="activity_type" class="col-3 col-form-label">Activity Type</label>
        <div class="col-9">
            <select name="activity_type" id="activity_type" class="form-control select-select2">
                <option value="planning" @if(isset($activity_info['data']['activity_type']) && $activity_info['data']['activity_type'] =='planning') selected @endif>Planning</option>
                <option value="financial" @if(isset($activity_info['data']['activity_type']) && $activity_info['data']['activity_type'] =='financial') selected @endif>Financial</option>
                <option value="compliance" @if(isset($activity_info['data']['activity_type']) && $activity_info['data']['activity_type'] =='compliance') selected @endif>Compliance</option>
                <option value="performance" @if(isset($activity_info['data']['activity_type']) && $activity_info['data']['activity_type'] =='performance') selected @endif>Performance</option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="activity_parent_id" class="col-3 col-form-label">Activity Parent</label>
        <div class="col-9">
            <select name="activity_parent_id" id="activity_parent_id" class="form-control select-select2">
                <option value="">Choose Activity Parent</option>
                @foreach ($activity_lists['data']['data'] as $outcome)
                    @foreach ($outcome['plan_output'] as $output)
                        @foreach ($output['activities'] as $activity)
                             <option value="{{$activity['id']}}" @if($activity_info['data']['activity_parent_id'] == $activity['id']) selected @endif>{{$activity['title_en']}}</option>
                        @endforeach
                    @endforeach
                @endforeach


            </select>
        </div>
    </div>
    <input type="hidden" value="{{ $activity_info['data']['duration_id'] }}"  id="duration_id" name="duration_id"/>
