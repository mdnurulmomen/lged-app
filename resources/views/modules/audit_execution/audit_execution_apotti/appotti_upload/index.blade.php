<div class="apotti_upload_container" id="search-criteria">
    <div class="card">
        <div class="card-header">
            <h1 class="float-left">অনিষ্পন্ন আপত্তির তালিকা</h1>
            <a href="javascript:;" onclick="Apotti_Uploaded_Container.loadCreateApottiUploadForm()" class="btn btn-success float-right">আপত্তি আপলোড করুন</a>
        </div>
        <div class="card-body" id="search-criteria">
            <div class="row">
                <div class="form-group col-sm-12 col-md-3">
                    <label for="office_ministry_id" class="col-form-label">মন্ত্রণালয়/বিভাগ</label>
                    <select class="form-control" id="office_ministry_id" name="office_ministry_id" data-select2-id="office_ministry_id" tabindex="-1" aria-hidden="true">
                        <option value="" data-select2-id="2">সবগুলো</option>
                        <option value="12" data-select2-id="63">কৃষি মন্ত্রণালয়</option>
                        <option value="22" data-select2-id="64">পরিবেশ, বন ও জলবায়ু পরিবর্তন মন্ত্রণালয়</option>
                        <option value="33" data-select2-id="65">মৎস্য ও প্রাণিসম্পদ মন্ত্রণালয়</option>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-3">
                    <label for="office_department_id" class="col-form-label">ডিপার্টমেন্ট/সংস্থা</label>
                    <select class="form-control" id="office_department_id" name="office_department_id" data-select2-id="office_department_id" tabindex="-1" aria-hidden="true">
                        <option selected="selected" value="" data-select2-id="4">সবগুলো</option>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-3">
                    <label for="cost_center_id" class="col-form-label">ইউনিট/গ্রুপ</label>
                    <select class="form-control" id="cost_center_id" name="cost_center_id" data-select2-id="cost_center_id" tabindex="-1" aria-hidden="true">
                        <option selected="selected" value="" data-select2-id="6">সবগুলো</option>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-3">
                    <label for="cost_center_child_id" class="col-form-label">কস্ট সেন্টার/নিরীক্ষিত প্রতিষ্ঠান</label>
                    <select class="form-control" id="cost_center_child_id" name="cost_center_child_id" data-select2-id="cost_center_child_id" tabindex="-1" aria-hidden="true">
                        <option selected="selected" value="" data-select2-id="8">সবগুলো</option>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-3">
                    <label for="apotti_oniyomer_dhoron" class="col-form-label">অনিয়মের ধরন</label>
                    <select class="form-control" id="apotti_oniyomer_dhoron" name="apotti_oniyomer_dhoron" data-select2-id="apotti_oniyomer_dhoron" tabindex="-1" aria-hidden="true">
                        <option selected="selected" value="" data-select2-id="10">সবগুলো</option>
                        <option value="1" data-select2-id="27">আত্মসাত, চুরি, প্রতারণা ও জালিয়াতিমূলক</option>
                        <option value="2" data-select2-id="28">সরকারের আর্থিক ক্ষতি</option>
                        <option value="3" data-select2-id="29">বিধি ও পদ্ধতিগত অনিয়ম</option>
                        <option value="4" data-select2-id="30">বিশেষ ধরনের আপত্তি</option>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-4">
                    <label for="apotti_category_child_id" class="col-form-label">অনিয়মের সাব-ধরন</label>
                    <select class="form-control " id="apotti_category_child_id" name="apotti_category_child_id" data-select2-id="apotti_category_child_id" tabindex="-1" aria-hidden="true">
                        <option selected="selected" value="" data-select2-id="12">সবগুলো</option>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-3">
                    <label for="apottir_dhoron" class="col-form-label">আপত্তির ধরন</label>
                    <select class="form-control" id="apottir_dhoron" name="apottir_dhoron" data-select2-id="apottir_dhoron" tabindex="-1" aria-hidden="true">
                        <option selected="selected" value="" data-select2-id="16">সবগুলো</option>
                        <option value="এসএফআই" data-select2-id="43">এসএফআই</option>
                        <option value="নন-এসএফআই" data-select2-id="44">নন-এসএফআই</option>
                        <option value="ড্রাফ্ট প্যারা" data-select2-id="45">ড্রাফ্ট প্যারা</option>
                        <option value="পাণ্ডুলিপি" data-select2-id="46">পাণ্ডুলিপি</option>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-2">
                    <label for="year_start" class="col-form-label">অর্থবছর</label>
                    <div class="input-group">
                        <input class="form-control yearpicker" placeholder="শুরু" maxlength="4" id="year_start" name="year_start" type="text" value="" autocomplete="off" />
                        <input class="form-control yearpicker" placeholder="শেষ" maxlength="4" id="year_end" name="year_end" type="text" value="" autocomplete="off" />
                    </div>
                </div>
                <div class="form-group col-sm-12 col-md-2">
                    <label for="apotti_status" class="col-form-label">আপত্তির অবস্থা</label>
                    <select class="form-control" id="apotti_status" name="apotti_status" data-select2-id="apotti_status" tabindex="-1" aria-hidden="true">
                        <option selected="selected" value="" data-select2-id="18">সবগুলো</option>
                        <option value="অনিস্পন্ন" data-select2-id="49">অনিস্পন্ন</option>
                        <option value="আংশিক নিস্পন্ন" data-select2-id="50">আংশিক নিস্পন্ন</option>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-2">
                    <label for="nirikkha_dhoron" class="col-form-label">নিরীক্ষার ধরন</label>
                    <select class="form-control" id="nirikkha_dhoron" name="nirikkha_dhoron" data-select2-id="nirikkha_dhoron" tabindex="-1" aria-hidden="true">
                        <option selected="selected" value="" data-select2-id="20">সবগুলো</option>
                        <option value="কমপ্লায়েন্স অডিট" data-select2-id="53">কমপ্লায়েন্স অডিট</option>
                        <option value="পারফরমেন্স অডিট" data-select2-id="54">পারফরমেন্স অডিট</option>
                        <option value="ফাইন্যান্সিয়াল অডিট" data-select2-id="55">ফাইন্যান্সিয়াল অডিট</option>
                        <option value="বার্ষিক অডিট" data-select2-id="56">বার্ষিক অডিট</option>
                        <option value="বিশেষ অডিট" data-select2-id="57">বিশেষ অডিট</option>
                        <option value="ইস্যুভিত্তিক অডিট" data-select2-id="58">ইস্যুভিত্তিক অডিট</option>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-2">
                    <label for="nirikkha_dhoron" class="col-form-label">স্ট্যাটাস</label>
                    <select class="form-control" id="nirikkha_dhoron" name="nirikkha_dhoron" data-select2-id="nirikkha_dhoron" tabindex="-1" aria-hidden="true">
                        <option selected="selected" value="" data-select2-id="22">সবগুলো</option>
                        <option value="checked" data-select2-id="61">Checked</option>
                        <option value="checkOk" data-select2-id="62">Checked Ok</option>
                        <option value="checkDeclined" data-select2-id="63">Check Declined</option>
                        <option value="notChecked" data-select2-id="64">Not Checked</option>
                        <option value="approved" data-select2-id="65">Approved</option>
                        <option value="notApproved" data-select2-id="66">Not Approved</option>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-2">
                    <label for="numberOfRowsPerPage" class="col-form-label">তথ্য দেখাবে</label>
                    <select class="form-control" id="numberOfRowsPerPage" data-select2-id="numberOfRowsPerPage" tabindex="-1" aria-hidden="true">
                        <option value="5" data-select2-id="69">৫</option>
                        <option value="10" data-select2-id="70">১০</option>
                        <option value="20" selected="" data-select2-id="24">২০</option>
                        <option value="30" data-select2-id="71">৩০</option>
                        <option value="40" data-select2-id="72">৪০</option>
                        <option value="50" data-select2-id="73">৫০</option>
                        <option value="100" data-select2-id="74">১০০</option>
                    </select>
                </div>
                <div class="form-group col-sm-2 col-md-2">
                    <label class="d-block" style="line-height: 1;">&nbsp;</label>
                    <button class="btn btn-md btn-info btnSearch" type="submit" ><i class="fa fa-search"></i> সার্চ</button>
                </div>
                <div class="form-group col-sm-2 col-md-2">
                    <label class="d-block" style="line-height: 1;">&nbsp;</label>
                    <button class="btn btn-danger" type="reset"><i class="fa fa-sync"></i> রিসেট</button>

                </div>
            </div>
        </div>
    </div>
</div>

<br>
<br>
<br>
<br>
<br>
<script>
    var Apotti_Uploaded_Container = {
        loadCreateApottiUploadForm: function () {
            let url = '{{route('audit.execution.apotti.uploaded-apotti')}}';
            let data = {};
            ajaxCallAsyncCallbackAPI(url, data, 'get', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('.apotti_upload_container').html(response);
                    }
                }
            );
        },
    }
</script>
