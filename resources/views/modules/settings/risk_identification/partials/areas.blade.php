<option value="" selected disabled>Please select an area</option>
@foreach ($allAreas as $area)
    <option value="{{ $area['id'] }}">{{ ucfirst($area['name_en']) }}</option>
@endforeach 