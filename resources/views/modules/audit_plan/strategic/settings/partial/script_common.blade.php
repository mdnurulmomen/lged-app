<script>
     $(document).ready(function() {
        $('.summernote').summernote();
        $('div.note-editable').height(150);
     });

    $('.btn_section_add').on('click', function () {
        toastr.success('নতুন সেকশন যোগ করা হয়েছে');

        $('#appendSection').append(
            `<fieldset class="scheduler-border">
                <legend class="scheduler-border">
                    Remove Section
                    <span style="color: red" class="fa fa-minus-circle btn_section_remove"></span>
                </legend>


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="input-label">Key<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="keys[]" placeholder="Enter key">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="info_section_data_bn" class="input-label">Value</label>
                            <textarea class="summernote form-control" name="values[]"></textarea>
                        </div>
                    </div>
                </div>

            </fieldset>`
        );

        $('#appendSection').on('click', '.btn_section_remove', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });

        $('.summernote').summernote();
        $('div.note-editable').height(150);
    });
</script>
