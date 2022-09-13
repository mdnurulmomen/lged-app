<option value="">সবগুলো (ALL)</option>
@foreach ($doner_list as $doner)
    <option data-name-en="{{ $doner['name_en'] }}" data-name-bn="{{ $doner['name_bn'] }}"
            value="{{ $doner['id'] }}">{{ $doner['name_bn'] }}</option>
@endforeach
