<table class="table table-bordered" width="100%">
    <thead class="thead-light">
        <tr>
            <th>Area</th>
            <th>Category</th>
            <th>Control Objective</th>
            <th>Test Procedure</th>
            <th>Notes</th>
            <th>Done By</th>
            <th>W/P Ref.</th>
        </tr>
    </thead>

    <tbody>
    @forelse($sectorAreaPrograms as $sectorAreaProgram)
        <tr id="row_{{$sectorAreaProgram['id']}}" data-row="{{$loop->iteration}}">
            <td rowspan="{{ count($sectorAreaProgram['procedures']) }}"> 
                {{ ucfirst($sectorAreaProgram['area_index']) }} 
                
                <a href="javascript:;"
                   data-id="{{$sectorAreaProgram['id']}}" 
                   data-area-index="{{$sectorAreaProgram['area_index']}}"
                   data-category="{{$sectorAreaProgram['category']}}" 
                   data-control-objective="{{$sectorAreaProgram['control_objective']}}" 
                   data-audit-area-id="{{$sectorAreaProgram['audit_area_id']}}" 
                   data-procedures='@json($sectorAreaProgram['procedures'])' 

                   class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_risk_rating">
                    <i class="fas fa-edit"></i>
                </a>
                
                <a href="javascript:;"
                   data-id="{{$sectorAreaProgram['id']}}"
                   data-url="{{ route('audit.plan.programs.destroy', $sectorAreaProgram['id']) }}"
                   class="btn btn-icon btn-outline-danger btn-xs border-0 mr-2 delete_risk_rating">
                    <i class="fal fa-trash-alt"></i>
                </a>
            </td>
            <td rowspan="{{ count($sectorAreaProgram['procedures']) }}"> {{ ucfirst($sectorAreaProgram['category']) }} </td>
            <td rowspan="{{ count($sectorAreaProgram['procedures']) }}"> {{ ucfirst($sectorAreaProgram['control_objective']) }} </td>
            
            @foreach ($sectorAreaProgram['procedures'] as $sectorAreaProgramProcedure)
                <td>{{ ucfirst($sectorAreaProgramProcedure['test_procedure']) }}</td>
                <td>{{ ucfirst($sectorAreaProgramProcedure['note']) }}</td>
                <td>{{ ucfirst($sectorAreaProgramProcedure['done_by']) }}</td>
                <td>{{ ucfirst($sectorAreaProgramProcedure['reference']) }}</td>
                </tr><tr>
            @endforeach
    @empty
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td colspan="7" class="datatable-cell text-center"><span>Nothing Found</span></td>
        </tr>
    @endforelse
    </tbody>
</table>

<script>
    $('.btn_edit_risk_rating').click(function () {

        loaderStart('Please wait...');

        id = $(this).data('id');
        area_index =$(this).data('area-index');
        category = $(this).data('category');
        control_objective = $(this).data('control-objective');
        audit_area_id = $(this).data('audit-area-id');
        procedures = $(this).data('procedures');

        // console.log(procedures);

        url = "{{ route('audit.plan.programs.edit') }}";
        var data = {id,category,area_index,control_objective,audit_area_id,procedures};
        
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
            loaderStop();
            if (resp.status === 'error') {
                toastr.error('no');
                console.log(resp.data)
            } else {
                // $('#id').val(id);
                // $('#title_bn').text(title_bn);
                // $('#title_en').text(title_en);
                // $('#rating_value').val(rating_value);
                // $('#x_risk_factor_id').val(x_risk_factor_id);
                $('#kt_content').html(resp);
            }
        });
    });

    $(".delete_risk_rating").click(function () {

         id = $(this).data('id');
         url = $(this).data('url');

        swal.fire({
            title: 'আপনি কি তথ্যটি মুছে ফেলতে চান?',
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'হ্যাঁ',
            cancelButtonText: 'না'
        }).then(function (result) {
            if (result.value) {
                ajaxCallAsyncCallbackAPI(url, {}, 'delete', function (resp) {
                    if (resp.status === 'error') {
                        toastr.error('no');
                        console.log(resp.data)
                    } else {
                        toastr.success('Delete Successfully');
                        $('#row_' + id).remove();
                    }
                });

            }
        });
    });
</script>
