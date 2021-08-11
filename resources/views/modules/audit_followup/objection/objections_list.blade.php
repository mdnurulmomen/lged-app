<x-title-wrapper>Output Indicator</x-title-wrapper>


<div class="content-page" style="padding: 0 15px 15px 15px;">

    <!-- content -->
    <br>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="float-left">আপত্তির তালিকা</h1>
                        <a class="btn btn-success float-right btn_create_objection_list"
                            href="javascript:;">আপত্তি আপলোড করুন</a>
                        <button class="btn btn-primary float-right mr-1" onclick="plainViewReportShow()">আপত্তির
                            তালিকা</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" id="directorate" value="5">

                            <div class="" hidden="">
                                <select name="directorate_id" class="form-control rounded-0 select-select2"
                                    id="directorate_id" data-select2-id="directorate_id" tabindex="-1"
                                    aria-hidden="true">
                                    <option value="5" data-select2-id="2"></option>
                                </select>
                            </div>


                            <div class="col-sm-12 col-md-3">
                                <label for="office_ministry_id" class="col-form-label">মন্ত্রণালয়/বিভাগ</label>
                                <select class="form-control rounded-0 select-select2" id="office_ministry_id"
                                    name="office_ministry_id" data-select2-id="office_ministry_id" tabindex="-1"
                                    aria-hidden="true">
                                    <option value="" data-select2-id="28">সবগুলো</option>
                                    <option value="88" data-select2-id="132">অর্থ বিভাগ</option>
                                    <option value="88" data-select2-id="136">অর্থ বিভাগ</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <label for="office_department_id" class="col-form-label">ডিপার্টমেন্ট/নিয়ন্ত্রণকারী
                                    অফিস</label>
                                <select class="form-control rounded-0 select-select2" id="office_department_id"
                                    name="office_department_id" data-select2-id="office_department_id" tabindex="-1"
                                    aria-hidden="true">
                                    <option value="" data-select2-id="148">সবগুলো</option>
                                    <option value="79" data-select2-id="149">সচিবালয়</option>
                                    <option value="81" data-select2-id="150">সিজিএ</option>
                                    <option value="82" data-select2-id="151">বাংলাদেশ ব্যাংক (নগদ সহায়তা)</option>
                                    <option value="151" data-select2-id="152">এক্সট্রা বাজেটারী অর্গানাইজেশন (ইবিও)
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <label for="cost_center_id" class="col-form-label">ইউনিট/গ্রুপ</label>
                                <select class="form-control rounded-0 select-select2" id="cost_center_id"
                                    name="cost_center_id" data-select2-id="cost_center_id" tabindex="-1"
                                    aria-hidden="true">
                                    <option value="" data-select2-id="240">সবগুলো</option>
                                    <option value="1408" data-select2-id="241">মার্কেন্টাইল ব্যাংক লিমিটেড</option>
                                    <option value="789" data-select2-id="242">সচিবালয় অফিস</option>

                                </select>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <label for="cost_center_child_id" class="col-form-label">কস্ট সেন্টার/নিরীক্ষিত
                                    প্রতিষ্ঠান</label>
                                <select class="form-control rounded-0 select-select2" id="cost_center_child_id"
                                    name="cost_center_child_id" data-select2-id="cost_center_child_id" tabindex="-1"
                                    aria-hidden="true">
                                    <option value="" data-select2-id="310">সবগুলো</option>
                                    <option value="124">ডিসিএ - বরিশাল</option>
                                    <option value="125">ডিসিএ - চট্টগ্রাম</option>
                                    <option value="126">ডিসিএ - খুলনা</option>
                                    <option value="127">ডিসিএ - রাজশাহী</option>
                                </select>
                            </div>

                            <div class="col-sm-12 col-md-3">
                                <label for="apotti_oniyomer_dhoron" class="col-form-label">অনিয়মের ধরন</label>
                                <select class="form-control rounded-0 select-select2" id="apotti_oniyomer_dhoron"
                                    name="apotti_oniyomer_dhoron" data-select2-id="apotti_oniyomer_dhoron" tabindex="-1"
                                    aria-hidden="true">
                                    <option value="" data-select2-id="37">সবগুলো</option>
                                    <option value="1" data-select2-id="38">আত্মসাত, চুরি, প্রতারণা ও জালিয়াতিমূলক
                                    </option>
                                    <option value="2" selected="selected" data-select2-id="12">সরকারের আর্থিক ক্ষতি
                                    </option>
                                    <option value="3" data-select2-id="39">বিধি ও পদ্ধতিগত অনিয়ম</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <label for="apotti_category_child_id" class="col-form-label">অনিয়মের সাব-ধরন</label>
                                <select class="form-control rounded-0 select-select2" id="apotti_category_child_id"
                                    name="apotti_category_child_id" data-select2-id="apotti_category_child_id"
                                    tabindex="-1" aria-hidden="true">
                                    <option selected="selected" value="" data-select2-id="14">সবগুলো</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <label for="apottir_dhoron" class="col-form-label">আপত্তির ধরন</label>
                                <select class="form-control rounded-0 select-select2" id="apottir_dhoron"
                                    name="apottir_dhoron" data-select2-id="apottir_dhoron" tabindex="-1"
                                    aria-hidden="true">
                                    <option selected="selected" value="" data-select2-id="16">সবগুলো</option>
                                    <option value="অগ্রিম" data-select2-id="45">১. SFI</option>
                                    <option value="সাধারণ" data-select2-id="46">২. Non-SFI</option>
                                    <option value="ড্রাফ্ট প্যারা" data-select2-id="47">৩. ড্রাফ্ট প্যারা</option>
                                    <option value="পাণ্ডুলিপি" data-select2-id="48">৪. পাণ্ডুলিপি</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <label for="apotti_year" class="col-form-label">আপত্তি বছর</label>
                                <select class="form-control rounded-0 select-select2" id="apotti_year"
                                    name="apotti_year" data-select2-id="apotti_year" tabindex="-1" aria-hidden="true">
                                    <option value="" data-select2-id="313">সবগুলো</option>
                                    <option value="২০০৬-২০১০">২০০৬-২০১০</option>
                                    <option value="২০০৬-২০১৫">২০০৬-২০১৫</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <label for="apotti_status" class="col-form-label">আপত্তির অবস্থা</label>
                                <select class="form-control rounded-0 select-select2" id="apotti_status"
                                    name="apotti_status" data-select2-id="apotti_status" tabindex="-1"
                                    aria-hidden="true">
                                    <option selected="selected" value="" data-select2-id="20">সবগুলো</option>
                                    <option value="নিস্পন্ন" data-select2-id="111">১. নিস্পন্ন</option>
                                    <option value="অনিস্পন্ন" data-select2-id="112">২. অনিস্পন্ন</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <label for="jorito_ortho_poriman" class="col-form-label">জড়িত অর্থ (টাকা) </label>
                                <input class="form-control" id="jorito_ortho_poriman" placeholder="জড়িত অর্থ (টাকা) "
                                    name="jorito_ortho_poriman" type="text">
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <label for="apotti_title" class="col-form-label">আপত্তির শিরোনাম</label>
                                <input class="form-control" id="apotti_title" placeholder="আপত্তির শিরোনাম"
                                    name="apotti_title" type="text">
                            </div>

                            <div class="col-sm-12 col-md-2">
                                <label for="file_name" class="col-form-label">ফাইল নং</label>
                                <input class="form-control" id="file_name" placeholder="ফাইল নং" name="file_name"
                                    type="text">
                            </div>

                            <div class="col-sm-12 col-md-2">
                                <label for="status" class="col-form-label ">স্ট্যাটাস</label>
                                <select class="form-control rounded-0 select-select2" id="status" name="status"
                                    data-select2-id="status" tabindex="-1" aria-hidden="true" style="display: none;">
                                    <option selected="selected" value="" data-select2-id="22">সবগুলো</option>
                                    <option value="checked" data-select2-id="116">Checked</option>
                                    <option value="checkOk" data-select2-id="117">Checked Ok</option>
                                    <option value="checkDeclined" data-select2-id="118">Check Declined</option>
                                    <option value="notChecked" data-select2-id="119">Not Checked</option>
                                    <option value="approved" data-select2-id="120">Approved</option>
                                    <option value="notApproved" data-select2-id="121">Not Approved</option>
                                </select>
                            </div>

                            <div class="col-sm-12  col-md-2 ">
                                <label for="numberOfRowsPerPage" class="col-form-label">তথ্য দেখাবে</label>
                                <select class="form-control rounded-0 select-select2" id="numberOfRowsPerPage"
                                    data-select2-id="numberOfRowsPerPage" tabindex="-1" aria-hidden="true">
                                    <option value="5" data-select2-id="124">৫</option>
                                    <option value="10" data-select2-id="125">১০</option>
                                    <option value="20" selected="" data-select2-id="24">২০</option>
                                    <option value="30" data-select2-id="126">৩০</option>
                                    <option value="40" data-select2-id="127">৪০</option>
                                    <option value="50" data-select2-id="128">৫০</option>
                                    <option value="100" data-select2-id="129">১০০</option>
                                </select>
                            </div>
                            <div class="col-sm-2 col-md-2 mt-2 ">
                                <label class="d-block" style="line-height: 1;">&nbsp;</label>
                                <button class="btn btn-md btn-info btnSearch" onclick="index()"><i
                                        class="fa fa-search"></i> সার্চ</button>

                                <button onclick="clearAllFilters()" class="btn btn-md btn-danger">
                                    <i class="fa fa-sync"></i> রিসেট
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive table-sm mt-3" id="tableDiv" style="position: relative; zoom: 1;">
                            <table class="table" id="summeryData">
                                <thead>
                                    <tr>
                                        <th>মোট: ২৮১২</th>
                                        <th class="d-none">ডাটা এন্ট্রি: ২৮১২</th>
                                        <th class="d-none">ডাটা চেক: ২৮১২</th>
                                        <th class="d-none">ডাটা অনুমোদন: ২৮১২</th>
                                        <th>মোট জড়িত অর্থ (টাকা) : ৬,০৬,০৬,২৯,৯৬,৩৪,৩৪২</th>
                                        <th>নিষ্পন্ন জড়িত অর্থ (টাকা) : ০</th>
                                        <th>অনিষ্পন্ন জড়িত অর্থ (টাকা) : ৬,০৬,০৬,২৯,৯৬,৩৪,৩৪২</th>
                                    </tr>
                                </thead>
                            </table>

                            <table id="tech-companies-1" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">ক্রমিক নং</th>

                                        <th class="text-center">আইডি</th>
                                        <th class="text-center">ফাইল নং</th>

                                        <th class="text-center">অনুচ্ছেদ নং</th>
                                        <th class="text-center">আপত্তির শিরোনাম</th>
                                        <th class="text-center">আপত্তি অনিয়মের ধরন</th>

                                        <th class="text-center">জড়িত অর্থ (টাকা) </th>
                                        <th class="text-center">নিরীক্ষিত প্রতিষ্ঠান</th>
                                        <th class="text-center">নিরীক্ষার ধরন</th>
                                        <th class="text-center">আপত্তি বছর</th>
                                        <th class="text-center">কার্যক্রম</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyItems">
                                    <tr class="bg text-white" style="background-color:rgb(66, 126, 61) !important;">
                                        <th>১</th>

                                        <th class="text-right">২৭৪৪১</th>
                                        <th>FA1-10001</th>

                                        <th>৪</th>
                                        <th>অনিয়মিত ভাবে আনুতোষিক বাবদ 267431 টাকা এবং 33648 টাকা সর্বমোট 301079 টাকা
                                            আদায় যোগ্য</th>
                                        <th>
                                            সরকারের আর্থিক ক্ষতি
                                        </th>

                                        <th class="text-right">৩,০১,০৭৯</th>
                                        <th>ডিসিএ - ঢাকা</th>
                                        <th>নিয়মানুগ নিরীক্ষা</th>
                                        <th>২০১৪-২০১৬</th>
                                        <th class="text-center">
                                            <div class="btn-group">
                                                <a class="btn mr-1 btn-primary btn-sm" title="Follow Up"
                                                    href="https://audit-archive.tappware.com/apottis/followup/27441"><i
                                                        class="fa fa-file-import" aria-hidden="true"></i></a>

                                                <a href="https://audit-archive.tappware.com/apottis/27441"
                                                    target="_blank" title="Show Details">
                                                    <button class="btn mr-1 btn-success btn-sm"><i class="fa fa-eye"
                                                            aria-hidden="true"></i></button>
                                                </a>
                                                <a href="https://audit-archive.tappware.com/apottis/27441/edit"
                                                    target="_blank" title="Edit">
                                                    <button class="btn mr-1 btn-warning btn-sm"><i class="fa fa-pen"
                                                            aria-hidden="true"></i></button>
                                                </a>

                                            </div>
                                        </th>
                                    </tr>
                                    <tr class="bg text-white" style="background-color:rgb(66, 126, 61) !important;">
                                        <th>২</th>

                                        <th class="text-right">২৭৪৪৪</th>
                                        <th>FA1-10001</th>

                                        <th>৭</th>
                                        <th>অনিয়মিত ভাবে আনুতোষিক বাবদ ৬২২৪৪ টাকা এবং পেনশন বাবদ ৬৭০৩ টাকা সর্বমোট ৬৮৯৪৭
                                            টাকা আদায় যোগ্য।</th>
                                        <th>
                                            সরকারের আর্থিক ক্ষতি
                                        </th>

                                        <th class="text-right">৬৮,৯৪৭</th>
                                        <th>ডিসিএ - ঢাকা</th>
                                        <th>নিয়মানুগ নিরীক্ষা</th>
                                        <th>২০১৪-২০১৬</th>
                                        <th class="text-center">
                                            <div class="btn-group">
                                                <a class="btn mr-1 btn-primary btn-sm" title="Follow Up"
                                                    href="https://audit-archive.tappware.com/apottis/followup/27444"><i
                                                        class="fa fa-file-import" aria-hidden="true"></i></a>

                                                <a href="https://audit-archive.tappware.com/apottis/27444"
                                                    target="_blank" title="Show Details">
                                                    <button class="btn mr-1 btn-success btn-sm"><i class="fa fa-eye"
                                                            aria-hidden="true"></i></button>
                                                </a>
                                                <a href="https://audit-archive.tappware.com/apottis/27444/edit"
                                                    target="_blank" title="Edit">
                                                    <button class="btn mr-1 btn-warning btn-sm"><i class="fa fa-pen"
                                                            aria-hidden="true"></i></button>
                                                </a>

                                            </div>
                                        </th>
                                    </tr>

                                    <tr class="bg text-white" style="background-color:rgb(66, 126, 61) !important;">
                                        <th>২০</th>

                                        <th class="text-right">২৭৫৫৫</th>
                                        <th>FA1-10011</th>

                                        <th>৫</th>
                                        <th>প্রশিক্ষণে খাবার বিল বাবদ 15000 টাকা অতিরিক্ত পরিশোধ এবং আয়কর বাবদ 4225 টাকা
                                            অনাদায়ী।</th>
                                        <th>
                                            সরকারের আর্থিক ক্ষতি
                                        </th>

                                        <th class="text-right">১৫,০০০</th>
                                        <th>ডিসিএ - ঢাকা</th>
                                        <th>নিয়মানুগ নিরীক্ষা</th>
                                        <th>২০১৫-২০১৬</th>
                                        <th class="text-center">
                                            <div class="btn-group">
                                                <a class="btn mr-1 btn-primary btn-sm" title="Follow Up"
                                                    href="https://audit-archive.tappware.com/apottis/followup/27555"><i
                                                        class="fa fa-file-import" aria-hidden="true"></i></a>

                                                <a href="https://audit-archive.tappware.com/apottis/27555"
                                                    target="_blank" title="Show Details">
                                                    <button class="btn mr-1 btn-success btn-sm"><i class="fa fa-eye"
                                                            aria-hidden="true"></i></button>
                                                </a>
                                                <a href="https://audit-archive.tappware.com/apottis/27555/edit"
                                                    target="_blank" title="Edit">
                                                    <button class="btn mr-1 btn-warning btn-sm"><i class="fa fa-pen"
                                                            aria-hidden="true"></i></button>
                                                </a>

                                            </div>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                            <nav>
                                <ul class="pagination">

                                    <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                                        <span class="page-link" aria-hidden="true">‹</span>
                                    </li>





                                    <li class="page-item active" aria-current="page"><span class="page-link">১</span>
                                    </li>
                                    <li class="page-item"><a class="page-link"
                                            href="https://audit-archive.tappware.com/get-apottis?page=2">২</a></li>
                                    <li class="page-item"><a class="page-link"
                                            href="https://audit-archive.tappware.com/get-apottis?page=3">৩</a></li>
                                    <li class="page-item"><a class="page-link"
                                            href="https://audit-archive.tappware.com/get-apottis?page=4">৪</a></li>
                                    <li class="page-item"><a class="page-link"
                                            href="https://audit-archive.tappware.com/get-apottis?page=5">৫</a></li>
                                    <li class="page-item"><a class="page-link"
                                            href="https://audit-archive.tappware.com/get-apottis?page=6">৬</a></li>

                                    <li class="page-item disabled" aria-disabled="true"><span
                                            class="page-link">...</span></li>





                                    <li class="page-item"><a class="page-link"
                                            href="https://audit-archive.tappware.com/get-apottis?page=140">১৪০</a></li>
                                    <li class="page-item"><a class="page-link"
                                            href="https://audit-archive.tappware.com/get-apottis?page=141">১৪১</a></li>


                                    <li class="page-item">
                                        <a class="page-link"
                                            href="https://audit-archive.tappware.com/get-apottis?page=2" rel="next"
                                            aria-label="Next »">›</a>
                                    </li>
                                </ul>
                            </nav>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->

    <!-- end Footer -->

</div>
<script>
    $(document).ready(function () {
    $.each($('.pagination .page-link'), function (k, v) {
        $(v).text(translateNumber($(v).text()));
    })
    })
    $('.btn_create_objection_list').click(function () {
        url = '{{route('audit.followup.objection.create')}}';

        data = {}
        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
            $('#kt_content').html(response);
        })
    });
</script>
