<option value="">All Projects</option>
@foreach ($all_project as $project)
    <option data-name-en="{{ $project['name_en'] }}" data-name-bn="{{ $project['name_bn'] }}"
            value="{{ $project['id'] }}">{{ $project['name_en'] }} ({{ $project['risk_score_key'] ? ucfirst($project['risk_score_key']) : '--' }})</option>
@endforeach
