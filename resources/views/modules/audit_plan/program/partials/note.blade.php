<div class="form-group">
    <label for="note">Note : </label>
    <textarea id="note" class="form-control" name="note" rows="3"></textarea>
</div>

<div class="row">
    <div class="col-sm-6 form-group">
        <label for="done-by">Done By : </label>
        <select class="form-select select-select2" id="team_member_officer_id" name="team_member_officer_id">
            <option value="">-- Select --</option>
            @foreach($team_members as $member)
            <option value="{{json_encode($member)}}">{{$member['team_member_name_bn']}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-6 form-group">
        <label for="done-by">W/P Reference : </label>
        <select class="form-select select-select2" id="workpaper_id" name="workpaper_id">
            <option value="">-- Select --</option>
            @foreach($working_plan_list as $workpaper)
            <option value="{{$workpaper['id']}}">{{$workpaper['title_en']}}</option>
            @endforeach
        </select>
    </div>
</div>

<button class="btn btn-sm btn-square btn-primary mr-2" data-id={{$id}} onclick='Audit_Program_Container.edit($(this))'
    id="note_submit" style="float: right;">
    <i class="fa fa-save"></i> Save
</button>
