<form class="card" id="apoitti_decision_form" autocomplete="off">
    <input type="hidden" name="apotti_id" value="{{$apotti_id}}">
    <div class="m-5">
        <div class="row mt-2">
            <div class="col-md-12">
                <label>কমিটির সিদ্ধান্ত</label>
                <div class="appendDecision">
                    <div class="row">
                        <div class="col-md-10">
                            <textarea class="form-control float-left" name="pac_decision[]"
                                  placeholder="কমিটির সিদ্ধান্ত"></textarea>
                        </div>
                        <div class="col-md-2">
                            <span title="যোগ করুন"
                              class="btn btn-outline-primary btn-sm btn-square add_decision">
                                <i class="fal fa-plus"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <label>সংস্থা/প্রতিষ্ঠান ও মন্ত্রণালয়/বিভাগের প্রতিবেদন</label>
                <textarea class="form-control float-left" name="rp_report"
                          placeholder="সংস্থা/প্রতিষ্ঠান ও মন্ত্রণালয়/বিভাগের প্রতিবেদন"></textarea>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <label>সিএজি মন্তব্য</label>
                <textarea class="form-control float-left" name="cag_comment"
                          placeholder="সিএজি মন্তব্য"></textarea>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <label>অবস্থা</label>
                <select class="form-control" id="apotti_status" name="apotti_status">
                    <option value="0">অবস্থা বাছাই করুন</option>
                    <option value="1">নিস্পন্ন</option>
                    <option value="2">অনিস্পন্ন</option>
                    <option value="3">আংশিক নিস্পন্ন</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>সিদ্ধান্ত বাস্তবায়নের শেষ তারিখ</label>
                <input type="text" class="form-control date" name="decision_last_date">
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <label>অনুশাসন অনুসরণকারী অফিস</label>
                <input type="text" class="form-control" name="follower_office">
            </div>
        </div>
    </div>
</form>

<div class="row mt-2">
    <div class="col-md-12">
        <button class="btn btn-sm btn-square btn-outline-primary float-right"
                onclick="Pac_MeetingMinutes_Container.submitPacMeetingDecision($(this))">
            <i class="fa fa-save"></i> সিদ্ধান্ত দিন
        </button>
    </div>
</div>

<script>
    $('.add_decision').on('click', function () {
        $('.appendDecision').append(
            `<div class="row mt-2">
                        <div class="col-md-10">
                            <textarea class="form-control float-left" name="pac_decision[]"
                                  placeholder="কমিটির সিদ্ধান্ত"></textarea>
                        </div>
                        <div class="col-md-2">
                            <span title="যোগ করুন"
                              class="btn btn-outline-danger btn-sm btn-square remove_decison">
                                <i class="fal fa-minus"></i>
                            </span>
                        </div>
                    </div>`
        );

        $('.appendDecision').on('click', '.remove_decison', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });
    });
</script>
