<tr class="strategic_row {{$row_type}}_row_{{$strategic_year}}">
    <td>
        @if($row_type == 'project')
            <select data-strategic-year="{{$strategic_year}}" data-id="{{$row_count}}" class="form-control project_id_{{$strategic_year}} project-select select-select2">
                <option selected value="">select project</option>
                @foreach($all_project as $project)
                    <option value="{{$project['id']}}" data-project-name-en="{{$project['name_en']}}">{{$project['name_bn']}}</option>
                @endforeach
            </select>
        @elseif($row_type == 'function')
            <select data-strategic-year="{{$strategic_year}}" class="form-control function_id_{{$strategic_year}} select-select2">
                <option selected value="">select function</option>
                @foreach($all_function as $function)
                    <option value="{{$function['id']}}" data-function-name-en="{{$function['name_bn']}}">{{$function['name_bn']}}</option>
                @endforeach
            </select>
        @endif
    </td>
    <td>
        <select id="location_{{$strategic_year}}_{{$row_count}}" class="form-control location_id_{{$strategic_year}} select-select2">
            <option selected value="">select location</option>
            @if($row_type = 'function')
                <option data-parent-office-id="1"
                        data-parent-office-name-en="sdfasdf"
                        data-parent-office-name-bn="asdfasd"
                        data-office-name-en="cost center 1"
                        data-office-name-bn="cost center 1"
                        value="1">cost center</option>
            @endif
        </select>
    </td>
    <td>
        <input type="text" class="form-control location_no_{{$strategic_year}}">
    </td>
    <td>
        <textarea style="height: 40px;" class="form-control comment_{{$strategic_year}}"></textarea>
    </td>
    <td>
        <div style="display: flex">
            <button type="button" title="ট্রানজিট"
                    onclick="Plan_Common_Container.addLocationRow('{{$strategic_year}}','{{$row_type}}')"
                    class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2">
                <span class="fad fa-plus"></span>
            </button>

            <button type='button' title="বাদ দিন"
                    data-row='row1'
                    onclick="Plan_Common_Container.removeLocationRow('{{$strategic_year}}','{{$row_type}}')"
                    class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2'>
                <span class='fal fa-trash-alt'></span>
            </button>
        </div>
    </td>
</tr>

<script>
    $('.project-select').change(function (){
        row_no =  $(this).attr('data-id');
        project_id =  $(this).val();
        strategic_year =  $(this).attr('data-strategic-year');
        Plan_Common_Container.loadCostCenterProjectMap(project_id,row_no,strategic_year);
    });
</script>
