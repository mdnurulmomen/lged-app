<div class="row m-0 page-title-wrapper d-md-flex align-items-md-center">
    <div class="col-md-6">
        <div class="title py-2">
            <h4 class="mb-0 font-weight-bold">
                <a href="">
                    <i title="Back To Memo List" class="fad fa-backward mr-3"></i>
                </a>
                Create Memo
            </h4>
        </div>
    </div>
    <div class="col-md-6 text-right">
        <button class="btn btn-sm btn-square btn-primary btn-hover-success"
                onclick="">Save <i class="fas fa-save"></i>
        </button>
    </div>
</div>

<div class="row">
    <div class="col-md-7 pr-0">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="height: calc(100vh - 145px);padding: 10px;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">
                                        কভার পেজ
                                    </label>
                                    <input name="file" type="file" class="form-control rounded-0"
                                           accept="image/*" multiple>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">
                                        টপ পেজ
                                    </label>
                                    <input name="file" type="file" class="form-control rounded-0"
                                           accept="image/*" multiple>
                                </div>
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">
                                        মূল আপত্তি সংযুক্তি
                                    </label>
                                    <input name="file" type="file" class="form-control rounded-0"
                                           accept="image/*" multiple>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">
                                        পরিশিষ্ট সংযুক্তি
                                    </label>
                                    <input name="file" type="file" class="form-control rounded-0"
                                           accept="image/*" multiple>
                                </div>
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">
                                        প্রামানক সংযুক্তি
                                    </label>
                                    <input name="file" type="file" class="form-control rounded-0"
                                           accept="image/*" multiple>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">
                                        আপত্তির অন্যান্য সংযুক্তি
                                    </label>
                                    <input name="file" type="file" class="form-control rounded-0"
                                           accept="image/*" multiple>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5 pr-8">
        <div class="card">
            <input class="form-control mb-1" placeholder="অনুচ্ছেদ নং" type="text">

            <textarea class="form-control mb-1" placeholder="আপত্তি শিরোনাম লিখুন" cols="30"
                      rows="3">সম্মানী ভাতা  বিলের উপর আয়কর বাবদ ১৭,৫৯২/ টাকা কর্তন করা হয় নাই।</textarea>

            <input class="form-control mb-1" pattern="[0-9\.]*"
                   placeholder="জড়িত অর্থ (টাকা)" type="text">

            <hr class="m-0 mt-1">

            <input class="form-control" placeholder="পৌরসভা/সিটি কর্পোরেশন/অন্যান্য" type="text">

            <input class="form-control mb-1 mt-1" placeholder="নিরিক্ষিত অর্থ-বছর" type="text">

            <select class="form-control">
                <option value="">আপত্তি অনিয়মের ধরন</option>
                <option value="1">আত্মসাত, চুরি, প্রতারণা ও জালিয়াতিমূলক</option>
                <option value="2" selected="selected">সরকারের আর্থিক ক্ষতি</option>
                <option value="3">বিধি ও পদ্ধতিগত অনিয়ম</option>
                <option value="4">বিশেষ ধরনের আপত্তি</option>
            </select>

            <select class="form-control">
                <option value="">আপত্তি অনিয়মের সাব-ধরন</option>
                <option value="26" selected="selected">ভ্যাট-আইটিসহ সরকারি প্রাপ্য আদায় না করা</option>
                <option value="27">কম আদায় করা</option><option value="28">আদায় করা সত্ত্বেও কোষাগারে জমা না করা</option><option value="29">বাজার দর অপেক্ষা উচ্চমূল্যে ক্রয় কার্য সম্পাদন</option><option value="30">রেসপন্সিভ সর্বনিম্ন দরদাতার স্থলে উচ্চ দরদাতার নিকট থেকে কার্য/পণ্য/সেবা ক্রয়</option><option value="31">প্রকল্প শেষে অব্যয়িত অর্থ ফেরত না দেওয়া</option><option value="32">ভুল বেতন নির্ধারণীর মাধ্যমে অতিরিক্ত বেতন উত্তোলন</option><option value="33">প্রাপ্যতাবিহীন ভাতা উত্তোলন</option><option value="34">জাতীয় অন্যান্য সরকারী অর্থের ক্ষতি সংক্রান্ত আপত্তি।</option></select>
            <hr class="m-0 mt-1">

            <select class="form-control">
                <option value="">আপত্তির ধরন</option>
                <option value="এসএফআই">এসএফআই</option>
                <option value="নন-এসএফআই" selected="selected">নন-এসএফআই</option>
                <option value="ড্রাফ্ট প্যারা">ড্রাফ্ট প্যারা</option>
                <option value="পাণ্ডুলিপি">পাণ্ডুলিপি</option>
            </select>

            <select class="form-control">
                <option value="">নিরীক্ষার ধরন</option>
                <option value="কমপ্লায়েন্স অডিট" selected="selected">কমপ্লায়েন্স অডিট</option>
                <option value="পারফরমেন্স অডিট">পারফরমেন্স অডিট</option>
                <option value="ফাইন্যান্সিয়াল অডিট">ফাইন্যান্সিয়াল অডিট</option>
                <option value="বার্ষিক অডিট">বার্ষিক অডিট</option>
                <option value="বিশেষ অডিট">বিশেষ অডিট</option>
                <option value="ইস্যুভিত্তিক অডিট">ইস্যুভিত্তিক অডিট</option>
            </select>

            <select class="form-control">
                <option value="">আপত্তির অবস্থা</option>
                <option value="নিস্পন্ন">১. নিস্পন্ন</option>
                <option value="অনিস্পন্ন" selected="selected">২. অনিস্পন্ন</option>
                <option value="আংশিক নিস্পন্ন">৩. আংশিক নিস্পন্ন</option>
            </select>
        </div>
    </div>
</div>

<script>
    // set the dropzone container id
    var id = '.kt_dropzone';

    //  set the preview element template
    var previewNode = $(id + " .dropzone-item");
    previewNode.id = "";
    var previewTemplate = previewNode.parent('.dropzone-items').html();
    previewNode.remove();

    var myDropzone4 = new Dropzone(id, { // Make the whole body a dropzone
        url: "https://keenthemes.com/scripts/void.php", // Set the url for your upload script location
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        maxFilesize: 1, // Max filesize in MB
        autoQueue: false, // Make sure the files aren't queued until manually added
        previewsContainer: id + " .dropzone-items", // Define the container to display the previews
        clickable: id + " .dropzone-select" // Define the element that should be used as click trigger to select files.
    });

    myDropzone4.on("addedfile", function(file) {
        // Hookup the start button
        file.previewElement.querySelector(id + " .dropzone-start").onclick = function() { myDropzone4.enqueueFile(file); };
        $(document).find( id + ' .dropzone-item').css('display', '');
        $( id + " .dropzone-upload, " + id + " .dropzone-remove-all").css('display', 'inline-block');
    });

    // Update the total progress bar
    myDropzone4.on("totaluploadprogress", function(progress) {
        $(this).find( id + " .progress-bar").css('width', progress + "%");
    });

    myDropzone4.on("sending", function(file) {
        // Show the total progress bar when upload starts
        $( id + " .progress-bar").css('opacity', '1');
        // And disable the start button
        file.previewElement.querySelector(id + " .dropzone-start").setAttribute("disabled", "disabled");
    });

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone4.on("complete", function(progress) {
        var thisProgressBar = id + " .dz-complete";
        setTimeout(function(){
            $( thisProgressBar + " .progress-bar, " + thisProgressBar + " .progress, " + thisProgressBar + " .dropzone-start").css('opacity', '0');
        }, 300)

    });

    // Setup the buttons for all transfers
    document.querySelector( id + " .dropzone-upload").onclick = function() {
        myDropzone4.enqueueFiles(myDropzone4.getFilesWithStatus(Dropzone.ADDED));
    };

    // Setup the button for remove all files
    document.querySelector(id + " .dropzone-remove-all").onclick = function() {
        $( id + " .dropzone-upload, " + id + " .dropzone-remove-all").css('display', 'none');
        myDropzone4.removeAllFiles(true);
    };

    // On all files completed upload
    myDropzone4.on("queuecomplete", function(progress){
        $( id + " .dropzone-upload").css('display', 'none');
    });

    // On all files removed
    myDropzone4.on("removedfile", function(file){
        if(myDropzone4.files.length < 1){
            $( id + " .dropzone-upload, " + id + " .dropzone-remove-all").css('display', 'none');
        }
    });
</script>
