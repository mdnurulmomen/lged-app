<div class="form-row pt-4 staff_row" id="team_section_{{$count}}">
    <div class="col-md-4">
        <label for="designation">পদবি</label>
        <select class="form-control select-select2 staff_designation designation_{{$count}}" name="designation[]">
            <option value="">--বাছাই করুন--</option>
            @foreach($designations as $designation)
                <option data-designation-en="{{$designation['designation_eng']}}" value="{{$designation['designation_eng']}}|{{$designation['designation_bng']}}">
                    {{$designation['designation_bng']}}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <label for="responsibility">দায়িত্ব</label>
        <select class="form-control select-select2 staff_responsibility responsibility_{{$count}}" name="responsibility">
            <option value="">--বাছাই করুন--</option>
            <option data-responsibility-en="Team Leader" value="Team Leader|দলনেতা">দলনেতা</option>
            <option data-responsibility-en="Sub Team Leader" value="Sub Team Leader|উপদলনেতা">উপদলনেতা</option>
            <option data-responsibility-en="Member" value="Member|সদস্য">সদস্য</option>
        </select>
    </div>
    <div class="col-md-3">
        <label for="staff">জন</label>
        <input class="form-control staff_number staff_{{$count}}" type="number" name="staff">
    </div>
    <div class="col-md-2 mt-9">
        <span title="যোগ করুন" onclick="Annual_Plan_Container.addTeamSection($(this))" class="btn btn-outline-primary btn-sm btn-square">
            <i class="fal fa-plus"></i>
        </span>
        <button title="মুছে ফেলুন" onclick="Annual_Plan_Container.removeTeamSection($(this))"
                class="btn btn-outline-danger btn-sm btn-danger btn-square">
            <i class="fal fa-minus"></i>
        </button>
    </div>
    <input type="hidden" name="staff_info[]" class="staff_info_{{$count}}" value="">
</div>

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
