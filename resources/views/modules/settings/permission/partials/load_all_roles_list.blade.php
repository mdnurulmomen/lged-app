<div class="form-group">
    <label for="role_id">Select Role</label>
    <select name="role_id" id="role_id" class="select-select2">
        @foreach($roles as $role)
            <option value="{{$role['id']}}">{{$role['role_name_en']}}</option>
        @endforeach
    </select>
</div>
