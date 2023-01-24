<x-title-wrapper>Units</x-title-wrapper>
<div class="card sna-card-border">
    <div class="col-12">
        <table id="project_table" class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Sl.</th>
                    <th>Unit Name</th>
                </tr>
            </thead>
            <tbody>

                @foreach($allMasterUnits as $unit)
                <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                        {{ $unit['name_en'] }}
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

