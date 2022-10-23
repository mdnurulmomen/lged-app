<option value="">সবগুলো</option>
@foreach ($all_function as $function)
    <option data-name-en="{{ $function['name_en'] }}" data-name-bn="{{ $function['name_en'] }}"
            value="{{ $function['id'] }}">{{ $function['name_bn'] }}</option>
@endforeach
