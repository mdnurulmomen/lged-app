<tr class="form-row pt-4 staff_row" id="team_section_{{$count}}">
    <td width="35%">
        <input type="hidden" name="staff_info[]" class="staff_info_{{$count}}" value="">
        <select class="form-control select-select2 staff_designation designation_{{$count}}" name="designation[]">
            <option value="">--বাছাই করুন--</option>
            @foreach($designations as $designation)
                <option data-designation-en="{{$designation['designation_eng']}}" value="{{$designation['designation_eng']}}|{{$designation['designation_bng']}}">
                    {{$designation['designation_bng']}}
                </option>
            @endforeach
        </select>
    </td>
    <td width="35%">
        <select class="form-control select-select2 staff_responsibility responsibility_{{$count}}" name="responsibility">
            <option value="">--বাছাই করুন--</option>
            <option data-responsibility-en="Team Leader" value="Team Leader|দলনেতা">দলনেতা</option>
            <option data-responsibility-en="Sub Team Leader" value="Sub Team Leader|উপদলনেতা">উপদলনেতা</option>
            <option data-responsibility-en="Member" value="Member|সদস্য">সদস্য</option>
        </select>
    </td>
    <td width="20%">
        <input class="form-control staff_number staff_{{$count}}" type="number" name="staff">
    </td>
    <td width="10%">
        <button title="মুছে ফেলুন" type='button'
                class='btn btn-outline-danger btn-sm btn-square'
                onclick="Annual_Plan_Container.removeTeamSection($(this))">
            <span class='fa fa-trash'></span>
        </button>
    </td>
</tr>


<script>

    $('.designation_{{$count}}').on('change', function () {
        designation = $(this).val();
        responsibility = $(".responsibility_{{$count}}").val();
        staff = parseInt($('.staff_{{$count}}').val());
        staff = isNaN(staff) ? 0 : staff;
        val = designation + '_' + responsibility + '_' + staff;
        $('.staff_info_{{$count}}').val(val)
    })

    $('.responsibility_{{$count}}').on('change', function () {
        designation = $(".designation_{{$count}}").val();
        responsibility = $(this).val();
        staff = parseInt($('.staff_{{$count}}').val());
        staff = isNaN(staff) ? 0 : staff;
        val = designation + '_' + responsibility + '_' + staff;
        $('.staff_info_{{$count}}').val(val)
    })

    $('.staff_{{$count}}').on('change', function () {
        designation = $(".designation_{{$count}}").val();
        responsibility = $(".responsibility_{{$count}}").val();
        staff = parseInt($(this).val());
        staff = isNaN(staff) ? 0 : staff;
        val = designation + '_' + responsibility + '_' + staff;
        $('.staff_info_{{$count}}').val(val)
    })

</script>
