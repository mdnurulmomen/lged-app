<x-title-wrapper>Projects</x-title-wrapper>
 <div class="card sna-card-border">
     <div class="col-12">
         <table id="project_table" class="table table-bordered">
             <thead class="thead-light">
                 <tr>
                     <th>Sl.</th>
                     <th>Project Name</th>
                     <th>Short Name</th>
                     <th>Sector</th>
                     <th>Project Type</th>
                     <th>Founded By</th>
                 </tr>
             </thead>
             <tbody>

                 @foreach($all_projects as $project)
                 <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        {{ $project['name_en'] }}
                    </td>
                    <td> {{ $project['short_name'] }}</td>
                    <td> {{ $project['sector'] }}</td>
                    <td> {{ $project['project_type'] }}</td>
                    <td> {{ $project['founded_by'] }}</td>
                 </tr>
                 @endforeach
             </tbody>
         </table>
     </div>
 </div>

