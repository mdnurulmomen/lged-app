<option>প্রকল্প বাছাই করুন</option>
@foreach ($project_list as $project)
    <option data-name-en="{{ $project['name_en'] }}" data-name-bn="{{ $project['name_bn'] }}"
            value="{{ $project['id'] }}">{{ $project['name_bn'] }}</option>
@endforeach
