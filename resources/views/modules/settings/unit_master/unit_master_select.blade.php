<option value="">সবগুলো</option>
@foreach ($all_unit_master as $unit)
    <option data-name-en="{{ $unit['name_en'] }}" data-name-bn="{{ $unit['name_en'] }}"
            value="{{ $unit['id'] }}">{{ $unit['name_bn'] }}</option>
@endforeach
