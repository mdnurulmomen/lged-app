<div class="form-row pt-4" id="team_section_{{$count}}">
    <div class="col-md-4">
        <label for="designation">পদবি</label>
        <select class="form-control select-select2 designation_{{$count}}" name="designation[]">
            <option value="">--পদবি--</option>
            @foreach($designations as $designation)
                <option value="{{$designation['designation_eng']}}|{{$designation['designation_bng']}}">
                    {{$designation['designation_bng']}}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label for="responsibility">দায়িত্ব</label>
        <select class="form-control select-select2 responsibility_{{$count}}" name="responsibility">
            <option value="">--দায়িত্ব--</option>
            <option value="Team Leader|দলনেতা">দলনেতা</option>
            <option value="Sub Team Leader|উপদলনেতা">উপদলনেতা</option>
            <option value="Member|সদস্য">সদস্য</option>
        </select>
    </div>
    <div class="col-md-2">
        <label for="staff">জন</label>
        <input class="form-control staff_{{$count}}" type="number" name="staff">
    </div>
    <div class="col-md-2 mt-8">
        <button onclick="Annual_Plan_Container.removeTeamSection($(this))" class="btn btn-danger"><i
                class="fa fa-minus"></i></button>
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
