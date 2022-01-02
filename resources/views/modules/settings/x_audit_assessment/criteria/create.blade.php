<form autocomplete="off" id="criteria_create_form">
    <div class="row">
        <div class="col-md-12">
            <label class="col-form-label">ক্যাটাগরি<span class="text-danger">*</span></label>
            <select class="form-control select-select2" name="category_id">
                <option value="0">বাছাই করুন</option>
                @foreach($categories as $category)
                    <option value="{{$category['id']}}">{{$category['name_bn']}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name_en">Name En<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="name_en" name="name_en"
                       placeholder="Enter name en">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name_bn">Name Bn<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="name_bn" name="name_bn"
                       placeholder="Enter name bn">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="role_name_bn">Weight<span class="text-danger">*</span></label>
        <input class="form-control" type="text" id="weight" name="weight"
               placeholder="Enter weight">
    </div>

    <div class="d-flex justify-content-end">
        <a href="javascript:;" role="button" onclick="Criteria_Container.storeCriteria()"
           class="btn btn-primary btn-sm btn-square btn-forward">
            <i class="fa fa-save"></i>
            Save
        </a>
    </div>
</form>
