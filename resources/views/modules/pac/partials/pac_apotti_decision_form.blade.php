<style>
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
        box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
</style>

<form class="card" id="apoitti_decision_form" autocomplete="off">
    <input type="hidden" name="apotti_id" value="{{$apotti_id}}">
    <div class="m-5">
        <div class="row mt-2">
            <div class="col-md-12">
                <div id="appendDecision" class="appendDecision">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">
                            কমিটির সিদ্ধান্ত
                            <a class="btn btn-sm btn-square btn-outline-primary add_decision float-right"
                            ><i class="fa fa-plus"></i> নতুন যোগ করুন
                            </a>
                        </legend>

                        <div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>কমিটির সিদ্ধান্ত</label>
                                    <textarea class="form-control float-left" name="pac_decision[]"
                                                  placeholder="কমিটির সিদ্ধান্ত"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>সিদ্ধান্ত বাস্তবায়নের শেষ তারিখ</label>
                                    <input type="text" class="form-control date" name="decision_last_date[]">
                                </div>
                                <div class="col-md-6">
                                    <label>অনুশাসন অনুসরণকারী অফিস</label>
                                    <input type="text" class="form-control" name="follower_office[]">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>

{{--        <div class="row mt-2">--}}
{{--            <div class="col-md-12">--}}
{{--                <label>সংস্থা/প্রতিষ্ঠান ও মন্ত্রণালয়/বিভাগের প্রতিবেদন</label>--}}
{{--                <textarea class="form-control float-left" name="rp_report"--}}
{{--                          placeholder="সংস্থা/প্রতিষ্ঠান ও মন্ত্রণালয়/বিভাগের প্রতিবেদন"></textarea>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="row mt-2">--}}
{{--            <div class="col-md-12">--}}
{{--                <label>সিএজি মন্তব্য</label>--}}
{{--                <textarea class="form-control float-left" name="cag_comment"--}}
{{--                          placeholder="সিএজি মন্তব্য"></textarea>--}}
{{--            </div>--}}
{{--        </div>--}}

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
        </div>
    </div>
</form>

<div class="row mt-2">
    <div class="col-md-12">
        <button class="btn btn-sm btn-square btn-primary float-right"
                onclick="Pac_MeetingMinutes_Container.submitPacMeetingDecision($(this))">
            <i class="fa fa-save"></i> সিদ্ধান্ত দিন
        </button>
    </div>
</div>

<script>
    $('.add_decision').on('click', function () {
        $('.appendDecision').append(
            `<fieldset class="scheduler-border">
                        <legend class="scheduler-border">
                            কমিটির সিদ্ধান্ত
                            <button type="button" class="mt-1 ml-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-danger list-btn-toggle remove_decison">
                                <i class="fad fa-minus-circle"></i>
                            </button>
                        </legend>

                        <div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>কমিটির সিদ্ধান্ত</label>
                                    <textarea class="form-control float-left" name="pac_decision[]"
                                                  placeholder="কমিটির সিদ্ধান্ত"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>সিদ্ধান্ত বাস্তবায়নের শেষ তারিখ</label>
                                    <input type="text" class="form-control date" name="decision_last_date[]">
                                </div>
                                <div class="col-md-6">
                                    <label>অনুশাসন অনুসরণকারী অফিস</label>
                                    <input type="text" class="form-control" name="follower_office[]">
                                </div>
                            </div>
                        </div>
                    </fieldset>`
        );

        $('.appendDecision').on('click', '.remove_decison', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });
    });
</script>
