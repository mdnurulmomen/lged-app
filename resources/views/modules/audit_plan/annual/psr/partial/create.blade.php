<form id="pser_form" autocomplete="off">
<div class="form-row ml-4 mt-2">
{{--        <p class="col-md-12 mb-1">সাবজেক্ট ম্যাটার :</p><br>--}}
    <div class="col-md-12">
            <label for="subject_matter">মেইন টপিক<span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="subject_matter" name="subject_matter">
        </div>
    <div class="col-md-12">
            <label for="sub_subject_matter">সাব টপিক<span class="text-danger">*</span></label>
            <div class="sub_subject_matter_div">
                <div>
                    <div class="input-group">
                        <input class="form-control sub_subject_matter" type="text" id="sub_subject_matter" name="sub_subject_matter">
                        <button type="button"  class="mt-1 ml-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-primary btn-icon-primary add_sub_topic
                                                    list-btn-toggle"><i class="fad fa-plus-circle"></i></button>
                    </div>
                </div>
            </div>
        </div>
    <div class="col-md-12">
        <label for="audit_objective">অডিট অবজেকটিভ<span class="text-danger">*</span></label>
        <input class="form-control d-none" type="text" id="audit_objective" name="audit_objective">
        <table id="objectiveTable" class="table table-striped">
            <thead class="thead-light">
            <tr>
                <th width="5%">ক্রঃ নং</th>
                <th width="30%">Sub Objective</th>
                <th width="15%">Line Of Enquire</th>
                <th width="15%">Critaria</th>
                <th width="15%">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>
                    <input
                        class="form-control"
                        type="text"
                        value="">
                </td>
                <td>
                    <input
                        class="form-control"
                        type="text"
                        value="">
                </td>
                <td class="pl-0 pr-0">
                    <input type="text"
                           class="form-control"
                           value="">
                </td>
                <td class="pl-0 pr-0">
                    <button type="button"  class="mt-1 ml-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-primary btn-icon-primary add_objective_row
                                                    list-btn-toggle"><i class="fad fa-plus-circle"></i></button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <button type="button" class="btn btn-success btn-sm btn-bold btn-square"
            onclick="Psr_Container.submitPsr()">
        <i class="far fa-save mr-1"></i> সংরক্ষণ করুন
    </button>
</div>
</form>
<script>
    $('.add_sub_topic').on('click', function (){
        $( ".sub_subject_matter_div").append( ' <div><div class="input-group mt-2"><input class="form-control sub_subject_matter" type="text" id="sub_subject_matter" name="sub_subject_matter"><button type="button"  class="mt-1 ml-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-danger remove_sub_topic list-btn-toggle"><i class="fad fa-minus-circle"></i></button></div></div>' );

        $('.sub_subject_matter_div').on('click', '.remove_sub_topic', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });
    });

    rowCount = 1;
    $('.add_objective_row').on('click', function (){
        rowCount ++;
        $('#objectiveTable > tbody').append(`<tr>
                                <td>${rowCount}</td>
                                <td>
                                    <input
                                           class="form-control"
                                           type="text"
                                           value="">
                                </td>
                                <td>
                                    <input
                                           class="form-control"
                                           type="text"
                                           value="">
                                </td>
                                <td class="pl-0 pr-0">
                                    <input type="text"
                                           class="form-control"
                                           value="">
                                </td>
                                <td class="pl-0 pr-0">
                                    <button type="button"  class="mt-1 ml-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-danger remove_objective_row
                                                    list-btn-toggle"><i class="fad fa-minus-circle"></i></button>
                                </td>
                            </tr>`);

        $('.remove_objective_row').on('click', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });
    });
</script>
