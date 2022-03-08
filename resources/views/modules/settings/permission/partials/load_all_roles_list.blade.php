<div class="form-group row">
    <div class="col-md-4">
        <label for="role_id">Choose Role</label>
        <select name="role_id" id="role_id" class="select-select2">
            @foreach($roles as $role)
                <option value="{{$role['id']}}">{{$role['role_name_en']}}</option>
            @endforeach
        </select>
    </div>
</div>
