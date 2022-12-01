@foreach ($allAreas as $area)
    <option value="{{ $area['id'] }}">{{ $area['name_en'] }}</option>
@endforeach 