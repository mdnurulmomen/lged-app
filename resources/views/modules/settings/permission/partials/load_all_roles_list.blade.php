<div class="form-group row">
    <label for="role_id" class="col-sm-3 col-form-label">Choose Role</label>
    <div class="col-md-9">
        <select name="role_id" id="role_id" class="select-select2">
            @foreach($roles as $role)
                <option value="{{$role['id']}}">{{$role['role_name_en']}}</option>
            @endforeach
        </select>
    </div>
</div>
