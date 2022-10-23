<option value="">সবগুলো</option>
@foreach ($all_project as $project)
    <option data-name-en="{{ $project['name_en'] }}" data-name-bn="{{ $project['name_en'] }}"
            value="{{ $project['id'] }}">{{ $project['name_bn'] }}</option>
@endforeach
