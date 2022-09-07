<option value="">সবগুলো (ALL)</option>
@foreach ($project_list as $project)
    <option data-name-en="{{ $project['project_name_en'] }}" data-name-bn="{{ $project['project_name_bn'] }}"
            value="{{ $project['project_id'] }}">{{ $project['project_name_en'] }}</option>
@endforeach
