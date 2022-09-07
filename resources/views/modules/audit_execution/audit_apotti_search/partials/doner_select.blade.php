<option value="">ডোনার বাছাই করুন</option>
@foreach ($doner_list as $doner)
    <option data-name-en="{{ $doner['name_en'] }}" data-name-bn="{{ $doner['name_bn'] }}"
            value="{{ $doner['id'] }}">{{ $doner['name_bn'] }}</option>
@endforeach
