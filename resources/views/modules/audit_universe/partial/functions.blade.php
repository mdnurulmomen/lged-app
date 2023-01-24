<x-title-wrapper>Functions</x-title-wrapper>
<div class="card sna-card-border">
    <div class="col-12">
        <table id="project_table" class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Sl.</th>
                    <th>Function Name</th>
                </tr>
            </thead>
            <tbody>

                @foreach($allFunctions as $function)
                <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                        {{ $function['name_en'] }}
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

