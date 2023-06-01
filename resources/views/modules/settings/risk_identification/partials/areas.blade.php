<option value="" selected disabled>Please Select Parent Area</option>
@foreach ($allAreas as $area)
    <option value="{{ $area['id'] }}">{{ ucfirst($area['name_en']) }}</option>
@endforeach 