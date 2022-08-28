<div class="row mt-3">
    @forelse($apottis as $apotti)
        <div class="col-md-12">
            <label>
                <input name="apottis[]" type="checkbox" value="{{$apotti['id']}}">
                <span class="pl-2">{{$apotti['apotti_title']}}</span>
            </label>
        </div>
    @empty
    @endforelse
</div>




