<select name="apotti_oniyomer_category_id" id="apotti_oniyomer_category_id" class="form-control rounded-0">
    <option value="">--বাছাই করুন--</option>
    @foreach($categories as $category)
        <option value="{{$category['id']}}">
            {{$category['name_bn']}}
        </option>
    @endforeach
</select>
