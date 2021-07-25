<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-bordered" width="100%">
            <thead>
            <tr>
                <th>Desk</th>
                <th>Employee designation</th>
                <th>Role</th>
            </tr>
            </thead>
            <tbody>
            @forelse($histories as $history)
                <tr>
                    <td class="vertical-middle">
                        {{$history['unit_name_en']}}
                    </td>
                    <td class="vertical-middle">
                        {{ $history['employee_designation_en'] }}
                    </td>
                    <td class="vertical-middle">
                        {{ $history['officer_type'] }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="vertical-middle" colspan="3">
                        No Data Found
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>