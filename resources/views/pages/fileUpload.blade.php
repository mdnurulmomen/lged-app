@extends('sideMenuLayout')
@section('content')
<div class="row m-0 page-title-wrapper d-md-flex align-items-md-center">
    <div class="col-md-6">
        <div class="title py-2">
            <h4 class="mb-0 font-weight-bold"><i class="fas fa-list mr-3"></i>ফাইল আপলোড</h4>
        </div>
    </div>
</div>
<div class="px-3 pt-3">
    <div class="card rounded-0 mt-5">
        <h5 class="rounded-0 card-header bg-light py-3 px-5">
            সংযুক্তিসমূহ
        </h5>
        <div class="card-body p-5">
            <div class="dak_file_viewer">
                <div class="p-5">
                    <div class="row">
                    <div class="col-md-12">
                        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                        <div class="fileupload-buttonbar">
                            <!-- The fileinput-button span is used to style the file input field as button -->
                            <div class="custom-file fileinput-button input-square" data-toggle="popover" data-content="সর্বোচ্চ ফাইল সাইজ ২৫ মেগাবাইট" data-original-title="" title="">
                                <input type="file" class="custom-file-input" name="files[]" style="visibility:hidden;" multiple="" id="customFile">
                                <label class="custom-file-label rounded-0" for="customFile">ফাইল নির্বাচন</label>
                            </div>
                            <span class="fileupload-process"></span>
                            <!-- The global progress state -->
                            <div class="fileupload-progress fade">
                                <!-- The global progress bar -->
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                <div class="progress-bar progress-bar-success" style="width: 0%;"></div>
                                </div>
                                <!-- The extended global progress state -->
                                <div class="progress-extended">&nbsp;</div>
                            </div>
                        </div>
                        <!-- The table listing the files available for upload/download -->
                    </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm custom-table">
                            <thead class="thead-light">
                                <tr>
                                    <th class="py-1" style="text-align: center; width: 100px;">মূলপত্র</th>
                                    <th class="py-1 " style="width: 200px;">
                                        <div class="pl-2">সংযুক্তি প্রিভিউ</div>
                                    </th>
                                    <th class="py-1">
                                        <div class="pl-2">সংযুক্তি</div>
                                    </th>
                                    <th class="py-1" style="width: 100px;">
                                        <div class="pl-2">কার্যক্রম</div>
                                        <div class="pl-2"></div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="files">
                                <tr class="template-download">
                                    <td class="align-middle text-center ">
                                        <input type="radio" data-type="application/pdf" name="" class="dak_form_mulpotro attachment-mulpotro">
                                    </td>
                                
                                    <td class="align-middle text-center">
                                        <span class="preview">
                                            
                                                <a data-fancybox-type="iframe" class="fancybox-button" rel="fancybox-button" target="_blank" href="#" title="meraj_hossain_CV.pdf" download="meraj_hossain_CV.pdf" data-gallery=""><i class="fas fa-2x fa-file-pdf"></i></a>
                                            
                                        </span>
                                    </td>
                                    <td>
                                        <div class="font-13 pl-2 kt-label-font-color-3 name">
                                        
                                            <input type="hidden" class="attachment-file-info">
                                            <input style="width:100%" type="text"  value="meraj_hossain_CV.pdf" class="attachment-user-file-name">
                                        
                                            <br>
                                            <span class="size"><small>5,990.80 KB</small></span>
                                        </div>
                                        
                                    </td>
                                    <td class="align-middle text-center">
                                        
                                            
                                                <button data-type="application/pdf" data-toggle="confirmation" data-title="আপনি কি নিশ্চিতভাবে সংযুক্তি টি মুছে ফেলতে চান?" type="button" class="btn btn-danger remove-attachment btn-square" data-url="/nothi-next/daak/attachment/remove" data-name="Dak_2021_65_05_2116215346351619686159.pdf" data-token="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJleHAiOjE2MjE1NTI2MzUsImlhdCI6MTYyMTUzNDAzNSwianRpIjoiTVRZeU1UVXpOREF6TlE9PSIsImlzcyI6Imh0dHA6XC9cL25vdGhpYnMudGFwcHdhcmUuY29tXC8iLCJuYmYiOjE2MjE1MzQwMzUsImRhdGEiOnsiZmlsZSI6IkRha18yMDIxXzY1XzA1XzIxMTYyMTUzNDYzNTE2MTk2ODYxNTkucGRmIiwiaWQiOjEyMn19.QeQAQ15HowmwVJd4hoKbscjSP29jBU_6Gd8602Og7FOo7qNgf9A1-xJoYjxbk65Njy6iDwfieTnRl6fn9aaoZA">
                                                    <i class="fad fa-trash-alt"></i>
                                                </button>
                                                <button type="button" data-type="file.attachment_type" data-base64="" class="d-none btn btn-primary mullpotro-ocr mullpotro-ocr-btn btn-square">
                                                    <i class="fas fa-circle-notch"></i>
                                                    <span>OCR ব্যবহার করুন</span>
                                                </button>
                                            
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection