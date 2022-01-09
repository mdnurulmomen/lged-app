<form autocomplete="off" id="criteria_update_form">
    <input type="hidden" name="criteria_id" value="{{$criteria['id']}}">
    <div class="row">
        <div class="col-md-12">
            <label class="col-form-label">ক্যাটাগরি<span class="text-danger">*</span></label>
            <select class="form-control select-select2" name="category_id" id="category_id">
                <option value="0">বাছাই করুন</option>
                @foreach($categories as $category)
                    <option data-category-title-en="{{$category['category_title_en']}}"
                            data-category-title-bn="{{$category['category_title_bn']}}"
                            {{$criteria['category_id'] == $category['id']?'selected':''}}
                            value="{{$category['id']}}">
                        {{$category['category_title_bn']}}
                    </option>
                @endforeach
            </select>

            <input type="hidden" name="category_title_en" id="category_title_en">
            <input type="hidden" name="category_title_bn" id="category_title_bn">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name_en">Name En<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="name_en" name="name_en"
                       value="{{$criteria['name_en']}}"
                       placeholder="Enter name en">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name_bn">Name Bn<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="name_bn" name="name_bn"
                       value="{{$criteria['name_bn']}}"
                       placeholder="Enter name bn">
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <a href="javascript:;" role="button" onclick="Criteria_Container.updateCriteria()"
           class="btn btn-primary btn-sm btn-square btn-forward">
            <i class="fa fa-save"></i>
            Update
        </a>
    </div>
</form>
