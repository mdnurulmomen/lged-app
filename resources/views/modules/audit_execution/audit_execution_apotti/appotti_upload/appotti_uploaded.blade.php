<div class="container-fluid" id="search-criteria" data-select2-id="59">
    <div class="row justify-content-center" data-select2-id="58">
        <div class="col-md-12" data-select2-id="57">
            <div class="card" data-select2-id="56">
                <div class="card-header">
                    <a href="javascript:;" onclick="Apotti_Uploaded_Container.loadCreateApottiUploadForm()"   class="btn btn-success float-left">আপত্তির তালিকা</a>
                </div>
                <div class="card-body container" data-select2-id="55">
                    <form method="POST" action="http://localhost:8005/apottis" accept-charset="UTF-8" id="apotti-form" enctype="multipart/form-data" data-select2-id="apotti-form">
                        <input name="_token" type="hidden" value="j7Mtjbm0YUFB59egPvxGvmaWMf4FbYPaeJv7lIxu" />
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
                            <div class="form-group col-2">
                                <label for="onucched_no" class="col-form-label">অনুচ্ছেদ নং</label>
                                <input class="form-control" id="onucched_no" name="onucched_no" type="text" />
                            </div>
                            <div class="form-group col-2">
                                <label for="apotti_year" class="col-form-label">আপত্তির অর্থবছর</label>

                                <input class="form-control" id="apotti_year" name="apotti_year" type="text" />
                            </div>

                            <div class="form-group col-3" data-select2-id="80">
                                <label for="nirikkha_dhoron" class="col-form-label">নিরীক্ষার ধরন</label>
                                <select class="form-control" id="nirikkha_dhoron" name="nirikkha_dhoron" data-select2-id="nirikkha_dhoron" tabindex="-1" aria-hidden="true">
                                    <option selected="selected" value="" data-select2-id="14">নিরিক্ষার ধরন</option>
                                    <option value="কমপ্লায়েন্স অডিট" data-select2-id="35">কমপ্লায়েন্স অডিট</option>
                                    <option value="পারফরমেন্স অডিট" data-select2-id="36">পারফরমেন্স অডিট</option>
                                    <option value="ফাইন্যান্সিয়াল অডিট" data-select2-id="37">ফাইন্যান্সিয়াল অডিট</option>
                                    <option value="বার্ষিক অডিট" data-select2-id="38">বার্ষিক অডিট</option>
                                    <option value="বিশেষ অডিট" data-select2-id="39">বিশেষ অডিট</option>
                                    <option value="ইস্যুভিত্তিক অডিট" data-select2-id="40">ইস্যুভিত্তিক অডিট</option>
                                </select>
                            </div>
                            <div class="form-group col-2" data-select2-id="77">
                                <label for="apottir_dhoron" class="col-form-label">আপত্তির ধরন</label>
                                <select class="form-control" id="apottir_dhoron" name="apottir_dhoron" data-select2-id="apottir_dhoron" tabindex="-1" aria-hidden="true">
                                    <option selected="selected" value="" data-select2-id="16">আপত্তির ধরন</option>
                                    <option value="এসএফআই" data-select2-id="43">এসএফআই</option>
                                    <option value="নন-এসএফআই" data-select2-id="44">নন-এসএফআই</option>
                                    <option value="ড্রাফ্ট প্যারা" data-select2-id="45">ড্রাফ্ট প্যারা</option>
                                    <option value="পাণ্ডুলিপি" data-select2-id="46">পাণ্ডুলিপি</option>
                                </select>
                            </div>
                            <div class="form-group col-2 d-none">
                                <label for="apotti_status" class="col-form-label">আপত্তির বর্তমান অবস্থা</label>
                                <select class="form-control" id="apotti_status" name="apotti_status" data-select2-id="apotti_status" tabindex="-1" aria-hidden="true">
                                    <option value="" data-select2-id="49">আপত্তির বর্তমান অবস্থা</option>
                                    <option value="অনিস্পন্ন" selected="selected" data-select2-id="18">অনিস্পন্ন</option>
                                    <option value="আংশিক নিস্পন্ন" data-select2-id="50">আংশিক নিস্পন্ন</option>
                                </select>
                            </div>
                            <div class="form-group col-2">
                                <label for="jorito_ortho_poriman" class="col-form-label">জড়িত অর্থ (টাকা) </label>
                                <input class="form-control" id="Jorito Ortho Poriman" name="jorito_ortho_poriman" type="text" />
                            </div>
                            <div class="form-group col-2">
                                <label for="file_no" class="col-form-label">ফাইল নং</label>
                                <input class="form-control" id="file_no" pattern="[A-Za-z0-9-_\s]{2,}" title="ইংরেজীতে লিখুন" name="file_no" type="text" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="apotti_title" class="col-form-label">আপত্তির শিরনাম:</label>

                                <input class="form-control" id="apotti_title" name="apotti_title" type="text" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="inputEmail4">
                                    <span class="pr-2"><i class="fas fa-paperclip"></i></span>কভার-পেজ
                                </label>
                                <div class="form-row">
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <div class="input file"><label for="cover_page"></label><input type="file" name="cover_page" class="custom-file-input" id="cover_page" /></div>
                                            <label class="custom-file-label" for="cover_page">ফাইল বাছাই করুন</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-50 preview"></div>
                            </div>
                            <div class="form-group col-6">
                                <label for="inputEmail4">
                                    <span class="pr-2"><i class="fas fa-paperclip"></i></span>টপ-পেজ
                                </label>
                                <div class="form-row">
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <div class="input file"><label for="top_page"></label><input type="file" name="top_page" class="custom-file-input" id="top_page" /></div>
                                            <label class="custom-file-label" for="top_page">ফাইল বাছাই করুন</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-50 preview"></div>
                            </div>
                        </div>

                        <hr />

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="inputEmail4">
                                    <span class="pr-2"><i class="fas fa-paperclip"></i></span> মূল আপত্তি সংযুক্তি
                                </label>
                                <div class="form-row">
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <div class="input file"><label for="apotti-attachment"></label><input type="file" name="apotti_attachment[]" multiple="multiple" class="custom-file-input" id="apotti-attachment" /></div>
                                            <label class="custom-file-label" for="apotti-attachment">ফাইল বাছাই করুন</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-50 preview"></div>
                            </div>

                            <div class="form-group col-6">
                                <label for="inputEmail4">
                                    <span class="pr-2"><i class="fas fa-paperclip"></i></span> পরিশিষ্ট সংযুক্তি
                                </label>
                                <div class="form-row">
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <div class="input file">
                                                <label for="apotti-attachment-porisishto"></label><input type="file" name="apotti_attachment_porisisto[]" multiple="multiple" class="custom-file-input" id="apotti-attachment-porisishto" />
                                            </div>
                                            <label class="custom-file-label" for="apotti-attachment-porisishto">ফাইল বাছাই করুন</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-50 preview"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="inputEmail4">
                                    <span class="pr-2"><i class="fas fa-paperclip"></i></span>প্রামানক সংযুক্তি
                                </label>
                                <div class="form-row">
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <div class="input file">
                                                <label for="apotti-attachment-pramanok"></label><input type="file" name="apotti_attachment_pramanok[]" multiple="multiple" class="custom-file-input" id="apotti-attachment-pramanok" />
                                            </div>
                                            <label class="custom-file-label" for="apotti-attachment-pramanok">ফাইল বাছাই করুন</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-50 preview"></div>
                            </div>

                            <div class="form-group col-6">
                                <label for="inputEmail4">
                                    <span class="pr-2"><i class="fas fa-paperclip"></i></span>আপত্তির অন্যান্য সংযুক্তি
                                </label>
                                <div class="form-row">
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <div class="input file">
                                                <label for="apotti-attachment-other"></label><input type="file" name="apotti_attachment_other[]" multiple="multiple" class="custom-file-input" id="apotti-attachment-other" />
                                            </div>
                                            <label class="custom-file-label" for="apotti-attachment-other">ফাইল বাছাই করুন</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-50 preview"></div>
                            </div>
                        </div>

                        <div class="d-none">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="apottir_bornona" class="col-form-label">Apottir Bornonan:</label>

                                    <input type="hidden" name="apottir_bornona" id="apottir_bornona" />
                                    <div class="ql-toolbar ql-snow">
                                            <span class="ql-formats">
                                                <span class="ql-font ql-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-0">
                                                        <svg viewBox="0 0 18 18">
                                                            <polygon class="ql-stroke" points="7 11 9 13 11 11 7 11"></polygon>
                                                            <polygon class="ql-stroke" points="7 7 9 5 11 7 7 7"></polygon>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-0">
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-selected"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="serif"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="monospace"></span>
                                                    </span>
                                                </span>
                                                <select class="ql-font" style="display: none;">
                                                    <option selected="selected"></option>
                                                    <option value="serif"></option>
                                                    <option value="monospace"></option>
                                                </select>
                                                <span class="ql-size ql-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-1">
                                                        <svg viewBox="0 0 18 18">
                                                            <polygon class="ql-stroke" points="7 11 9 13 11 11 7 11"></polygon>
                                                            <polygon class="ql-stroke" points="7 7 9 5 11 7 7 7"></polygon>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-1">
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="small"></span><span tabindex="0" role="button" class="ql-picker-item ql-selected"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="large"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="huge"></span>
                                                    </span>
                                                </span>
                                                <select class="ql-size" style="display: none;">
                                                    <option value="small"></option>
                                                    <option selected="selected"></option>
                                                    <option value="large"></option>
                                                    <option value="huge"></option>
                                                </select>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-bold">
                                                    <svg viewBox="0 0 18 18">
                                                        <path class="ql-stroke" d="M5,4H9.5A2.5,2.5,0,0,1,12,6.5v0A2.5,2.5,0,0,1,9.5,9H5A0,0,0,0,1,5,9V4A0,0,0,0,1,5,4Z"></path>
                                                        <path class="ql-stroke" d="M5,9h5.5A2.5,2.5,0,0,1,13,11.5v0A2.5,2.5,0,0,1,10.5,14H5a0,0,0,0,1,0,0V9A0,0,0,0,1,5,9Z"></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-italic">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="7" x2="13" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="5" x2="11" y1="14" y2="14"></line>
                                                        <line class="ql-stroke" x1="8" x2="10" y1="14" y2="4"></line>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-underline">
                                                    <svg viewBox="0 0 18 18">
                                                        <path class="ql-stroke" d="M5,3V9a4.012,4.012,0,0,0,4,4H9a4.012,4.012,0,0,0,4-4V3"></path>
                                                        <rect class="ql-fill" height="1" rx="0.5" ry="0.5" width="12" x="3" y="15"></rect>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-strike">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke ql-thin" x1="15.5" x2="2.5" y1="8.5" y2="9.5"></line>
                                                        <path
                                                            class="ql-fill"
                                                            d="M9.007,8C6.542,7.791,6,7.519,6,6.5,6,5.792,7.283,5,9,5c1.571,0,2.765.679,2.969,1.309a1,1,0,0,0,1.9-.617C13.356,4.106,11.354,3,9,3,6.2,3,4,4.538,4,6.5a3.2,3.2,0,0,0,.5,1.843Z"
                                                        ></path>
                                                        <path
                                                            class="ql-fill"
                                                            d="M8.984,10C11.457,10.208,12,10.479,12,11.5c0,0.708-1.283,1.5-3,1.5-1.571,0-2.765-.679-2.969-1.309a1,1,0,1,0-1.9.617C4.644,13.894,6.646,15,9,15c2.8,0,5-1.538,5-3.5a3.2,3.2,0,0,0-.5-1.843Z"
                                                        ></path>
                                                    </svg>
                                                </button>
                                            </span>
                                        <span class="ql-formats">
                                                <span class="ql-color ql-picker ql-color-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-2">
                                                        <svg viewBox="0 0 18 18">
                                                            <line class="ql-color-label ql-stroke ql-transparent" x1="3" x2="15" y1="15" y2="15"></line>
                                                            <polyline class="ql-stroke" points="5.5 11 9 3 12.5 11"></polyline>
                                                            <line class="ql-stroke" x1="11.63" x2="6.38" y1="9" y2="9"></line>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-2">
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-selected ql-primary"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#e60000" style="background-color: rgb(230, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#ff9900" style="background-color: rgb(255, 153, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#ffff00" style="background-color: rgb(255, 255, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#008a00" style="background-color: rgb(0, 138, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#0066cc" style="background-color: rgb(0, 102, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#9933ff" style="background-color: rgb(153, 51, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffffff" style="background-color: rgb(255, 255, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#facccc" style="background-color: rgb(250, 204, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffebcc" style="background-color: rgb(255, 235, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffffcc" style="background-color: rgb(255, 255, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#cce8cc" style="background-color: rgb(204, 232, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#cce0f5" style="background-color: rgb(204, 224, 245);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ebd6ff" style="background-color: rgb(235, 214, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#bbbbbb" style="background-color: rgb(187, 187, 187);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#f06666" style="background-color: rgb(240, 102, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffc266" style="background-color: rgb(255, 194, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffff66" style="background-color: rgb(255, 255, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#66b966" style="background-color: rgb(102, 185, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#66a3e0" style="background-color: rgb(102, 163, 224);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#c285ff" style="background-color: rgb(194, 133, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#888888" style="background-color: rgb(136, 136, 136);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#a10000" style="background-color: rgb(161, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#b26b00" style="background-color: rgb(178, 107, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#b2b200" style="background-color: rgb(178, 178, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#006100" style="background-color: rgb(0, 97, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#0047b2" style="background-color: rgb(0, 71, 178);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#6b24b2" style="background-color: rgb(107, 36, 178);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#444444" style="background-color: rgb(68, 68, 68);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#5c0000" style="background-color: rgb(92, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#663d00" style="background-color: rgb(102, 61, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#666600" style="background-color: rgb(102, 102, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#003700" style="background-color: rgb(0, 55, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#002966" style="background-color: rgb(0, 41, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#3d1466" style="background-color: rgb(61, 20, 102);"></span>
                                                    </span>
                                                </span>
                                                <select class="ql-color" style="display: none;">
                                                    <option selected="selected"></option>
                                                    <option value="#e60000"></option>
                                                    <option value="#ff9900"></option>
                                                    <option value="#ffff00"></option>
                                                    <option value="#008a00"></option>
                                                    <option value="#0066cc"></option>
                                                    <option value="#9933ff"></option>
                                                    <option value="#ffffff"></option>
                                                    <option value="#facccc"></option>
                                                    <option value="#ffebcc"></option>
                                                    <option value="#ffffcc"></option>
                                                    <option value="#cce8cc"></option>
                                                    <option value="#cce0f5"></option>
                                                    <option value="#ebd6ff"></option>
                                                    <option value="#bbbbbb"></option>
                                                    <option value="#f06666"></option>
                                                    <option value="#ffc266"></option>
                                                    <option value="#ffff66"></option>
                                                    <option value="#66b966"></option>
                                                    <option value="#66a3e0"></option>
                                                    <option value="#c285ff"></option>
                                                    <option value="#888888"></option>
                                                    <option value="#a10000"></option>
                                                    <option value="#b26b00"></option>
                                                    <option value="#b2b200"></option>
                                                    <option value="#006100"></option>
                                                    <option value="#0047b2"></option>
                                                    <option value="#6b24b2"></option>
                                                    <option value="#444444"></option>
                                                    <option value="#5c0000"></option>
                                                    <option value="#663d00"></option>
                                                    <option value="#666600"></option>
                                                    <option value="#003700"></option>
                                                    <option value="#002966"></option>
                                                    <option value="#3d1466"></option>
                                                </select>
                                                <span class="ql-background ql-picker ql-color-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-3">
                                                        <svg viewBox="0 0 18 18">
                                                            <g class="ql-fill ql-color-label">
                                                                <polygon points="6 6.868 6 6 5 6 5 7 5.942 7 6 6.868"></polygon>
                                                                <rect height="1" width="1" x="4" y="4"></rect>
                                                                <polygon points="6.817 5 6 5 6 6 6.38 6 6.817 5"></polygon>
                                                                <rect height="1" width="1" x="2" y="6"></rect>
                                                                <rect height="1" width="1" x="3" y="5"></rect>
                                                                <rect height="1" width="1" x="4" y="7"></rect>
                                                                <polygon points="4 11.439 4 11 3 11 3 12 3.755 12 4 11.439"></polygon>
                                                                <rect height="1" width="1" x="2" y="12"></rect>
                                                                <rect height="1" width="1" x="2" y="9"></rect>
                                                                <rect height="1" width="1" x="2" y="15"></rect>
                                                                <polygon points="4.63 10 4 10 4 11 4.192 11 4.63 10"></polygon>
                                                                <rect height="1" width="1" x="3" y="8"></rect>
                                                                <path d="M10.832,4.2L11,4.582V4H10.708A1.948,1.948,0,0,1,10.832,4.2Z"></path>
                                                                <path d="M7,4.582L7.168,4.2A1.929,1.929,0,0,1,7.292,4H7V4.582Z"></path>
                                                                <path d="M8,13H7.683l-0.351.8a1.933,1.933,0,0,1-.124.2H8V13Z"></path>
                                                                <rect height="1" width="1" x="12" y="2"></rect>
                                                                <rect height="1" width="1" x="11" y="3"></rect>
                                                                <path d="M9,3H8V3.282A1.985,1.985,0,0,1,9,3Z"></path>
                                                                <rect height="1" width="1" x="2" y="3"></rect>
                                                                <rect height="1" width="1" x="6" y="2"></rect>
                                                                <rect height="1" width="1" x="3" y="2"></rect>
                                                                <rect height="1" width="1" x="5" y="3"></rect>
                                                                <rect height="1" width="1" x="9" y="2"></rect>
                                                                <rect height="1" width="1" x="15" y="14"></rect>
                                                                <polygon points="13.447 10.174 13.469 10.225 13.472 10.232 13.808 11 14 11 14 10 13.37 10 13.447 10.174"></polygon>
                                                                <rect height="1" width="1" x="13" y="7"></rect>
                                                                <rect height="1" width="1" x="15" y="5"></rect>
                                                                <rect height="1" width="1" x="14" y="6"></rect>
                                                                <rect height="1" width="1" x="15" y="8"></rect>
                                                                <rect height="1" width="1" x="14" y="9"></rect>
                                                                <path d="M3.775,14H3v1H4V14.314A1.97,1.97,0,0,1,3.775,14Z"></path>
                                                                <rect height="1" width="1" x="14" y="3"></rect>
                                                                <polygon points="12 6.868 12 6 11.62 6 12 6.868"></polygon>
                                                                <rect height="1" width="1" x="15" y="2"></rect>
                                                                <rect height="1" width="1" x="12" y="5"></rect>
                                                                <rect height="1" width="1" x="13" y="4"></rect>
                                                                <polygon points="12.933 9 13 9 13 8 12.495 8 12.933 9"></polygon>
                                                                <rect height="1" width="1" x="9" y="14"></rect>
                                                                <rect height="1" width="1" x="8" y="15"></rect>
                                                                <path d="M6,14.926V15H7V14.316A1.993,1.993,0,0,1,6,14.926Z"></path>
                                                                <rect height="1" width="1" x="5" y="15"></rect>
                                                                <path d="M10.668,13.8L10.317,13H10v1h0.792A1.947,1.947,0,0,1,10.668,13.8Z"></path>
                                                                <rect height="1" width="1" x="11" y="15"></rect>
                                                                <path d="M14.332,12.2a1.99,1.99,0,0,1,.166.8H15V12H14.245Z"></path>
                                                                <rect height="1" width="1" x="14" y="15"></rect>
                                                                <rect height="1" width="1" x="15" y="11"></rect>
                                                            </g>
                                                            <polyline class="ql-stroke" points="5.5 13 9 5 12.5 13"></polyline>
                                                            <line class="ql-stroke" x1="11.63" x2="6.38" y1="11" y2="11"></line>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-3">
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#000000" style="background-color: rgb(0, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#e60000" style="background-color: rgb(230, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#ff9900" style="background-color: rgb(255, 153, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#ffff00" style="background-color: rgb(255, 255, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#008a00" style="background-color: rgb(0, 138, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#0066cc" style="background-color: rgb(0, 102, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#9933ff" style="background-color: rgb(153, 51, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-selected"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#facccc" style="background-color: rgb(250, 204, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffebcc" style="background-color: rgb(255, 235, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffffcc" style="background-color: rgb(255, 255, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#cce8cc" style="background-color: rgb(204, 232, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#cce0f5" style="background-color: rgb(204, 224, 245);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ebd6ff" style="background-color: rgb(235, 214, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#bbbbbb" style="background-color: rgb(187, 187, 187);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#f06666" style="background-color: rgb(240, 102, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffc266" style="background-color: rgb(255, 194, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffff66" style="background-color: rgb(255, 255, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#66b966" style="background-color: rgb(102, 185, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#66a3e0" style="background-color: rgb(102, 163, 224);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#c285ff" style="background-color: rgb(194, 133, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#888888" style="background-color: rgb(136, 136, 136);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#a10000" style="background-color: rgb(161, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#b26b00" style="background-color: rgb(178, 107, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#b2b200" style="background-color: rgb(178, 178, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#006100" style="background-color: rgb(0, 97, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#0047b2" style="background-color: rgb(0, 71, 178);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#6b24b2" style="background-color: rgb(107, 36, 178);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#444444" style="background-color: rgb(68, 68, 68);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#5c0000" style="background-color: rgb(92, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#663d00" style="background-color: rgb(102, 61, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#666600" style="background-color: rgb(102, 102, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#003700" style="background-color: rgb(0, 55, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#002966" style="background-color: rgb(0, 41, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#3d1466" style="background-color: rgb(61, 20, 102);"></span>
                                                    </span>
                                                </span>
                                                <select class="ql-background" style="display: none;">
                                                    <option value="#000000"></option>
                                                    <option value="#e60000"></option>
                                                    <option value="#ff9900"></option>
                                                    <option value="#ffff00"></option>
                                                    <option value="#008a00"></option>
                                                    <option value="#0066cc"></option>
                                                    <option value="#9933ff"></option>
                                                    <option selected="selected"></option>
                                                    <option value="#facccc"></option>
                                                    <option value="#ffebcc"></option>
                                                    <option value="#ffffcc"></option>
                                                    <option value="#cce8cc"></option>
                                                    <option value="#cce0f5"></option>
                                                    <option value="#ebd6ff"></option>
                                                    <option value="#bbbbbb"></option>
                                                    <option value="#f06666"></option>
                                                    <option value="#ffc266"></option>
                                                    <option value="#ffff66"></option>
                                                    <option value="#66b966"></option>
                                                    <option value="#66a3e0"></option>
                                                    <option value="#c285ff"></option>
                                                    <option value="#888888"></option>
                                                    <option value="#a10000"></option>
                                                    <option value="#b26b00"></option>
                                                    <option value="#b2b200"></option>
                                                    <option value="#006100"></option>
                                                    <option value="#0047b2"></option>
                                                    <option value="#6b24b2"></option>
                                                    <option value="#444444"></option>
                                                    <option value="#5c0000"></option>
                                                    <option value="#663d00"></option>
                                                    <option value="#666600"></option>
                                                    <option value="#003700"></option>
                                                    <option value="#002966"></option>
                                                    <option value="#3d1466"></option>
                                                </select>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-script" value="super">
                                                    <svg viewBox="0 0 18 18">
                                                        <path
                                                            class="ql-fill"
                                                            d="M15.5,7H13.861a4.015,4.015,0,0,0,1.914-2.975,1.8,1.8,0,0,0-1.6-1.751A1.922,1.922,0,0,0,12.021,3.7a0.5,0.5,0,1,0,.957.291,0.917,0.917,0,0,1,1.053-.725,0.81,0.81,0,0,1,.744.762c0,1.077-1.164,1.925-1.934,2.486A1.423,1.423,0,0,0,12,7.5a0.5,0.5,0,0,0,.5.5h3A0.5,0.5,0,0,0,15.5,7Z"
                                                        ></path>
                                                        <path
                                                            class="ql-fill"
                                                            d="M9.651,5.241a1,1,0,0,0-1.41.108L6,7.964,3.759,5.349a1,1,0,1,0-1.519,1.3L4.683,9.5,2.241,12.35a1,1,0,1,0,1.519,1.3L6,11.036,8.241,13.65a1,1,0,0,0,1.519-1.3L7.317,9.5,9.759,6.651A1,1,0,0,0,9.651,5.241Z"
                                                        ></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-script" value="sub">
                                                    <svg viewBox="0 0 18 18">
                                                        <path
                                                            class="ql-fill"
                                                            d="M15.5,15H13.861a3.858,3.858,0,0,0,1.914-2.975,1.8,1.8,0,0,0-1.6-1.751A1.921,1.921,0,0,0,12.021,11.7a0.50013,0.50013,0,1,0,.957.291h0a0.914,0.914,0,0,1,1.053-.725,0.81,0.81,0,0,1,.744.762c0,1.076-1.16971,1.86982-1.93971,2.43082A1.45639,1.45639,0,0,0,12,15.5a0.5,0.5,0,0,0,.5.5h3A0.5,0.5,0,0,0,15.5,15Z"
                                                        ></path>
                                                        <path
                                                            class="ql-fill"
                                                            d="M9.65,5.241a1,1,0,0,0-1.409.108L6,7.964,3.759,5.349A1,1,0,0,0,2.192,6.59178Q2.21541,6.6213,2.241,6.649L4.684,9.5,2.241,12.35A1,1,0,0,0,3.71,13.70722q0.02557-.02768.049-0.05722L6,11.036,8.241,13.65a1,1,0,1,0,1.567-1.24277Q9.78459,12.3777,9.759,12.35L7.316,9.5,9.759,6.651A1,1,0,0,0,9.65,5.241Z"
                                                        ></path>
                                                    </svg>
                                                </button>
                                            </span>
                                        <span class="ql-formats">
                                                <span class="ql-header ql-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-4">
                                                        <svg viewBox="0 0 18 18">
                                                            <polygon class="ql-stroke" points="7 11 9 13 11 11 7 11"></polygon>
                                                            <polygon class="ql-stroke" points="7 7 9 5 11 7 7 7"></polygon>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-4">
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-selected"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="1"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="2"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="3"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="4"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="5"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="6"></span>
                                                    </span>
                                                </span>
                                                <select class="ql-header" style="display: none;">
                                                    <option selected="selected"></option>
                                                    <option value="1"></option>
                                                    <option value="2"></option>
                                                    <option value="3"></option>
                                                    <option value="4"></option>
                                                    <option value="5"></option>
                                                    <option value="6"></option>
                                                </select>
                                                <button type="button" class="ql-blockquote">
                                                    <svg viewBox="0 0 18 18">
                                                        <rect class="ql-fill ql-stroke" height="3" width="3" x="4" y="5"></rect>
                                                        <rect class="ql-fill ql-stroke" height="3" width="3" x="11" y="5"></rect>
                                                        <path class="ql-even ql-fill ql-stroke" d="M7,8c0,4.031-3,5-3,5"></path>
                                                        <path class="ql-even ql-fill ql-stroke" d="M14,8c0,4.031-3,5-3,5"></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-code-block">
                                                    <svg viewBox="0 0 18 18">
                                                        <polyline class="ql-even ql-stroke" points="5 7 3 9 5 11"></polyline>
                                                        <polyline class="ql-even ql-stroke" points="13 7 15 9 13 11"></polyline>
                                                        <line class="ql-stroke" x1="10" x2="8" y1="5" y2="13"></line>
                                                    </svg>
                                                </button>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-list" value="ordered">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="7" x2="15" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="7" x2="15" y1="9" y2="9"></line>
                                                        <line class="ql-stroke" x1="7" x2="15" y1="14" y2="14"></line>
                                                        <line class="ql-stroke ql-thin" x1="2.5" x2="4.5" y1="5.5" y2="5.5"></line>
                                                        <path class="ql-fill" d="M3.5,6A0.5,0.5,0,0,1,3,5.5V3.085l-0.276.138A0.5,0.5,0,0,1,2.053,3c-0.124-.247-0.023-0.324.224-0.447l1-.5A0.5,0.5,0,0,1,4,2.5v3A0.5,0.5,0,0,1,3.5,6Z"></path>
                                                        <path class="ql-stroke ql-thin" d="M4.5,10.5h-2c0-.234,1.85-1.076,1.85-2.234A0.959,0.959,0,0,0,2.5,8.156"></path>
                                                        <path class="ql-stroke ql-thin" d="M2.5,14.846a0.959,0.959,0,0,0,1.85-.109A0.7,0.7,0,0,0,3.75,14a0.688,0.688,0,0,0,.6-0.736,0.959,0.959,0,0,0-1.85-.109"></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-list" value="bullet">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="6" x2="15" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="6" x2="15" y1="9" y2="9"></line>
                                                        <line class="ql-stroke" x1="6" x2="15" y1="14" y2="14"></line>
                                                        <line class="ql-stroke" x1="3" x2="3" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="3" x2="3" y1="9" y2="9"></line>
                                                        <line class="ql-stroke" x1="3" x2="3" y1="14" y2="14"></line>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-indent" value="-1">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="3" x2="15" y1="14" y2="14"></line>
                                                        <line class="ql-stroke" x1="3" x2="15" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="9" x2="15" y1="9" y2="9"></line>
                                                        <polyline class="ql-stroke" points="5 7 5 11 3 9 5 7"></polyline>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-indent" value="+1">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="3" x2="15" y1="14" y2="14"></line>
                                                        <line class="ql-stroke" x1="3" x2="15" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="9" x2="15" y1="9" y2="9"></line>
                                                        <polyline class="ql-fill ql-stroke" points="3 7 3 11 5 9 3 7"></polyline>
                                                    </svg>
                                                </button>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-direction">
                                                    <svg viewBox="0 0 18 18">
                                                        <polygon class="ql-stroke ql-fill" points="3 11 5 9 3 7 3 11"></polygon>
                                                        <line class="ql-stroke ql-fill" x1="15" x2="11" y1="4" y2="4"></line>
                                                        <path class="ql-fill" d="M11,3a3,3,0,0,0,0,6h1V3H11Z"></path>
                                                        <rect class="ql-fill" height="11" width="1" x="11" y="4"></rect>
                                                        <rect class="ql-fill" height="11" width="1" x="13" y="4"></rect>
                                                    </svg>
                                                    <svg viewBox="0 0 18 18">
                                                        <polygon class="ql-stroke ql-fill" points="15 12 13 10 15 8 15 12"></polygon>
                                                        <line class="ql-stroke ql-fill" x1="9" x2="5" y1="4" y2="4"></line>
                                                        <path class="ql-fill" d="M5,3A3,3,0,0,0,5,9H6V3H5Z"></path>
                                                        <rect class="ql-fill" height="11" width="1" x="5" y="4"></rect>
                                                        <rect class="ql-fill" height="11" width="1" x="7" y="4"></rect>
                                                    </svg>
                                                </button>
                                                <span class="ql-align ql-picker ql-icon-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-5">
                                                        <svg viewBox="0 0 18 18">
                                                            <line class="ql-stroke" x1="3" x2="15" y1="9" y2="9"></line>
                                                            <line class="ql-stroke" x1="3" x2="13" y1="14" y2="14"></line>
                                                            <line class="ql-stroke" x1="3" x2="9" y1="4" y2="4"></line>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-5">
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-selected">
                                                            <svg viewBox="0 0 18 18">
                                                                <line class="ql-stroke" x1="3" x2="15" y1="9" y2="9"></line>
                                                                <line class="ql-stroke" x1="3" x2="13" y1="14" y2="14"></line>
                                                                <line class="ql-stroke" x1="3" x2="9" y1="4" y2="4"></line>
                                                            </svg>
                                                        </span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="center">
                                                            <svg viewBox="0 0 18 18">
                                                                <line class="ql-stroke" x1="15" x2="3" y1="9" y2="9"></line>
                                                                <line class="ql-stroke" x1="14" x2="4" y1="14" y2="14"></line>
                                                                <line class="ql-stroke" x1="12" x2="6" y1="4" y2="4"></line>
                                                            </svg>
                                                        </span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="right">
                                                            <svg viewBox="0 0 18 18">
                                                                <line class="ql-stroke" x1="15" x2="3" y1="9" y2="9"></line>
                                                                <line class="ql-stroke" x1="15" x2="5" y1="14" y2="14"></line>
                                                                <line class="ql-stroke" x1="15" x2="9" y1="4" y2="4"></line>
                                                            </svg>
                                                        </span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="justify">
                                                            <svg viewBox="0 0 18 18">
                                                                <line class="ql-stroke" x1="15" x2="3" y1="9" y2="9"></line>
                                                                <line class="ql-stroke" x1="15" x2="3" y1="14" y2="14"></line>
                                                                <line class="ql-stroke" x1="15" x2="3" y1="4" y2="4"></line>
                                                            </svg>
                                                        </span>
                                                    </span>
                                                </span>
                                                <select class="ql-align" style="display: none;">
                                                    <option selected="selected"></option>
                                                    <option value="center"></option>
                                                    <option value="right"></option>
                                                    <option value="justify"></option>
                                                </select>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-link">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="7" x2="11" y1="7" y2="11"></line>
                                                        <path class="ql-even ql-stroke" d="M8.9,4.577a3.476,3.476,0,0,1,.36,4.679A3.476,3.476,0,0,1,4.577,8.9C3.185,7.5,2.035,6.4,4.217,4.217S7.5,3.185,8.9,4.577Z"></path>
                                                        <path class="ql-even ql-stroke" d="M13.423,9.1a3.476,3.476,0,0,0-4.679-.36,3.476,3.476,0,0,0,.36,4.679c1.392,1.392,2.5,2.542,4.679.36S14.815,10.5,13.423,9.1Z"></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-image">
                                                    <svg viewBox="0 0 18 18">
                                                        <rect class="ql-stroke" height="10" width="12" x="3" y="4"></rect>
                                                        <circle class="ql-fill" cx="6" cy="7" r="1"></circle>
                                                        <polyline class="ql-even ql-fill" points="5 12 5 11 7 9 8 10 11 7 13 9 13 12 5 12"></polyline>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-video">
                                                    <svg viewBox="0 0 18 18">
                                                        <rect class="ql-stroke" height="12" width="12" x="3" y="3"></rect>
                                                        <rect class="ql-fill" height="12" width="1" x="5" y="3"></rect>
                                                        <rect class="ql-fill" height="12" width="1" x="12" y="3"></rect>
                                                        <rect class="ql-fill" height="2" width="8" x="5" y="8"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="3" y="5"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="3" y="7"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="3" y="10"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="3" y="12"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="12" y="5"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="12" y="7"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="12" y="10"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="12" y="12"></rect>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-formula">
                                                    <svg viewBox="0 0 18 18">
                                                        <path
                                                            class="ql-fill"
                                                            d="M11.759,2.482a2.561,2.561,0,0,0-3.53.607A7.656,7.656,0,0,0,6.8,6.2C6.109,9.188,5.275,14.677,4.15,14.927a1.545,1.545,0,0,0-1.3-.933A0.922,0.922,0,0,0,2,15.036S1.954,16,4.119,16s3.091-2.691,3.7-5.553c0.177-.826.36-1.726,0.554-2.6L8.775,6.2c0.381-1.421.807-2.521,1.306-2.676a1.014,1.014,0,0,0,1.02.56A0.966,0.966,0,0,0,11.759,2.482Z"
                                                        ></path>
                                                        <rect class="ql-fill" height="1.6" rx="0.8" ry="0.8" width="5" x="5.15" y="6.2"></rect>
                                                        <path
                                                            class="ql-fill"
                                                            d="M13.663,12.027a1.662,1.662,0,0,1,.266-0.276q0.193,0.069.456,0.138a2.1,2.1,0,0,0,.535.069,1.075,1.075,0,0,0,.767-0.3,1.044,1.044,0,0,0,.314-0.8,0.84,0.84,0,0,0-.238-0.619,0.8,0.8,0,0,0-.594-0.239,1.154,1.154,0,0,0-.781.3,4.607,4.607,0,0,0-.781,1q-0.091.15-.218,0.346l-0.246.38c-0.068-.288-0.137-0.582-0.212-0.885-0.459-1.847-2.494-.984-2.941-0.8-0.482.2-.353,0.647-0.094,0.529a0.869,0.869,0,0,1,1.281.585c0.217,0.751.377,1.436,0.527,2.038a5.688,5.688,0,0,1-.362.467,2.69,2.69,0,0,1-.264.271q-0.221-.08-0.471-0.147a2.029,2.029,0,0,0-.522-0.066,1.079,1.079,0,0,0-.768.3A1.058,1.058,0,0,0,9,15.131a0.82,0.82,0,0,0,.832.852,1.134,1.134,0,0,0,.787-0.3,5.11,5.11,0,0,0,.776-0.993q0.141-.219.215-0.34c0.046-.076.122-0.194,0.223-0.346a2.786,2.786,0,0,0,.918,1.726,2.582,2.582,0,0,0,2.376-.185c0.317-.181.212-0.565,0-0.494A0.807,0.807,0,0,1,14.176,15a5.159,5.159,0,0,1-.913-2.446l0,0Q13.487,12.24,13.663,12.027Z"
                                                        ></path>
                                                    </svg>
                                                </button>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-clean">
                                                    <svg class="" viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="5" x2="13" y1="3" y2="3"></line>
                                                        <line class="ql-stroke" x1="6" x2="9.35" y1="12" y2="3"></line>
                                                        <line class="ql-stroke" x1="11" x2="15" y1="11" y2="15"></line>
                                                        <line class="ql-stroke" x1="15" x2="11" y1="11" y2="15"></line>
                                                        <rect class="ql-fill" height="1" rx="0.5" ry="0.5" width="7" x="2" y="14"></rect>
                                                    </svg>
                                                </button>
                                            </span>
                                    </div>
                                    <div class="apottir_bornona ql-container ql-snow" id="snow-editor" style="height: 150px;">
                                        <div class="ql-editor ql-blank" data-gramm="false" contenteditable="true">
                                            <p><br /></p>
                                        </div>
                                        <div class="ql-clipboard" tabindex="-1" contenteditable="true"></div>
                                        <div class="ql-tooltip ql-hidden">
                                            <a class="ql-preview" target="_blank" href="about:blank"></a><input type="text" data-formula="e=mc^2" data-link="https://quilljs.com" data-video="Embed URL" /><a class="ql-action"></a>
                                            <a class="ql-remove"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="audit_protistaner_jobab" class="col-form-label">Audit Protistaner Jobab:</label>

                                    <input type="hidden" name="audit_protistaner_jobab" id="audit_protistaner_jobab" />
                                    <div class="ql-toolbar ql-snow">
                                            <span class="ql-formats">
                                                <span class="ql-font ql-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-6">
                                                        <svg viewBox="0 0 18 18">
                                                            <polygon class="ql-stroke" points="7 11 9 13 11 11 7 11"></polygon>
                                                            <polygon class="ql-stroke" points="7 7 9 5 11 7 7 7"></polygon>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-6">
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-selected"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="serif"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="monospace"></span>
                                                    </span>
                                                </span>
                                                <select class="ql-font" style="display: none;">
                                                    <option selected="selected"></option>
                                                    <option value="serif"></option>
                                                    <option value="monospace"></option>
                                                </select>
                                                <span class="ql-size ql-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-7">
                                                        <svg viewBox="0 0 18 18">
                                                            <polygon class="ql-stroke" points="7 11 9 13 11 11 7 11"></polygon>
                                                            <polygon class="ql-stroke" points="7 7 9 5 11 7 7 7"></polygon>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-7">
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="small"></span><span tabindex="0" role="button" class="ql-picker-item ql-selected"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="large"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="huge"></span>
                                                    </span>
                                                </span>
                                                <select class="ql-size" style="display: none;">
                                                    <option value="small"></option>
                                                    <option selected="selected"></option>
                                                    <option value="large"></option>
                                                    <option value="huge"></option>
                                                </select>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-bold">
                                                    <svg viewBox="0 0 18 18">
                                                        <path class="ql-stroke" d="M5,4H9.5A2.5,2.5,0,0,1,12,6.5v0A2.5,2.5,0,0,1,9.5,9H5A0,0,0,0,1,5,9V4A0,0,0,0,1,5,4Z"></path>
                                                        <path class="ql-stroke" d="M5,9h5.5A2.5,2.5,0,0,1,13,11.5v0A2.5,2.5,0,0,1,10.5,14H5a0,0,0,0,1,0,0V9A0,0,0,0,1,5,9Z"></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-italic">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="7" x2="13" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="5" x2="11" y1="14" y2="14"></line>
                                                        <line class="ql-stroke" x1="8" x2="10" y1="14" y2="4"></line>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-underline">
                                                    <svg viewBox="0 0 18 18">
                                                        <path class="ql-stroke" d="M5,3V9a4.012,4.012,0,0,0,4,4H9a4.012,4.012,0,0,0,4-4V3"></path>
                                                        <rect class="ql-fill" height="1" rx="0.5" ry="0.5" width="12" x="3" y="15"></rect>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-strike">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke ql-thin" x1="15.5" x2="2.5" y1="8.5" y2="9.5"></line>
                                                        <path
                                                            class="ql-fill"
                                                            d="M9.007,8C6.542,7.791,6,7.519,6,6.5,6,5.792,7.283,5,9,5c1.571,0,2.765.679,2.969,1.309a1,1,0,0,0,1.9-.617C13.356,4.106,11.354,3,9,3,6.2,3,4,4.538,4,6.5a3.2,3.2,0,0,0,.5,1.843Z"
                                                        ></path>
                                                        <path
                                                            class="ql-fill"
                                                            d="M8.984,10C11.457,10.208,12,10.479,12,11.5c0,0.708-1.283,1.5-3,1.5-1.571,0-2.765-.679-2.969-1.309a1,1,0,1,0-1.9.617C4.644,13.894,6.646,15,9,15c2.8,0,5-1.538,5-3.5a3.2,3.2,0,0,0-.5-1.843Z"
                                                        ></path>
                                                    </svg>
                                                </button>
                                            </span>
                                        <span class="ql-formats">
                                                <span class="ql-color ql-picker ql-color-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-8">
                                                        <svg viewBox="0 0 18 18">
                                                            <line class="ql-color-label ql-stroke ql-transparent" x1="3" x2="15" y1="15" y2="15"></line>
                                                            <polyline class="ql-stroke" points="5.5 11 9 3 12.5 11"></polyline>
                                                            <line class="ql-stroke" x1="11.63" x2="6.38" y1="9" y2="9"></line>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-8">
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-selected ql-primary"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#e60000" style="background-color: rgb(230, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#ff9900" style="background-color: rgb(255, 153, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#ffff00" style="background-color: rgb(255, 255, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#008a00" style="background-color: rgb(0, 138, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#0066cc" style="background-color: rgb(0, 102, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#9933ff" style="background-color: rgb(153, 51, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffffff" style="background-color: rgb(255, 255, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#facccc" style="background-color: rgb(250, 204, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffebcc" style="background-color: rgb(255, 235, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffffcc" style="background-color: rgb(255, 255, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#cce8cc" style="background-color: rgb(204, 232, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#cce0f5" style="background-color: rgb(204, 224, 245);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ebd6ff" style="background-color: rgb(235, 214, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#bbbbbb" style="background-color: rgb(187, 187, 187);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#f06666" style="background-color: rgb(240, 102, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffc266" style="background-color: rgb(255, 194, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffff66" style="background-color: rgb(255, 255, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#66b966" style="background-color: rgb(102, 185, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#66a3e0" style="background-color: rgb(102, 163, 224);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#c285ff" style="background-color: rgb(194, 133, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#888888" style="background-color: rgb(136, 136, 136);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#a10000" style="background-color: rgb(161, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#b26b00" style="background-color: rgb(178, 107, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#b2b200" style="background-color: rgb(178, 178, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#006100" style="background-color: rgb(0, 97, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#0047b2" style="background-color: rgb(0, 71, 178);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#6b24b2" style="background-color: rgb(107, 36, 178);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#444444" style="background-color: rgb(68, 68, 68);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#5c0000" style="background-color: rgb(92, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#663d00" style="background-color: rgb(102, 61, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#666600" style="background-color: rgb(102, 102, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#003700" style="background-color: rgb(0, 55, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#002966" style="background-color: rgb(0, 41, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#3d1466" style="background-color: rgb(61, 20, 102);"></span>
                                                    </span>
                                                </span>
                                                <select class="ql-color" style="display: none;">
                                                    <option selected="selected"></option>
                                                    <option value="#e60000"></option>
                                                    <option value="#ff9900"></option>
                                                    <option value="#ffff00"></option>
                                                    <option value="#008a00"></option>
                                                    <option value="#0066cc"></option>
                                                    <option value="#9933ff"></option>
                                                    <option value="#ffffff"></option>
                                                    <option value="#facccc"></option>
                                                    <option value="#ffebcc"></option>
                                                    <option value="#ffffcc"></option>
                                                    <option value="#cce8cc"></option>
                                                    <option value="#cce0f5"></option>
                                                    <option value="#ebd6ff"></option>
                                                    <option value="#bbbbbb"></option>
                                                    <option value="#f06666"></option>
                                                    <option value="#ffc266"></option>
                                                    <option value="#ffff66"></option>
                                                    <option value="#66b966"></option>
                                                    <option value="#66a3e0"></option>
                                                    <option value="#c285ff"></option>
                                                    <option value="#888888"></option>
                                                    <option value="#a10000"></option>
                                                    <option value="#b26b00"></option>
                                                    <option value="#b2b200"></option>
                                                    <option value="#006100"></option>
                                                    <option value="#0047b2"></option>
                                                    <option value="#6b24b2"></option>
                                                    <option value="#444444"></option>
                                                    <option value="#5c0000"></option>
                                                    <option value="#663d00"></option>
                                                    <option value="#666600"></option>
                                                    <option value="#003700"></option>
                                                    <option value="#002966"></option>
                                                    <option value="#3d1466"></option>
                                                </select>
                                                <span class="ql-background ql-picker ql-color-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-9">
                                                        <svg viewBox="0 0 18 18">
                                                            <g class="ql-fill ql-color-label">
                                                                <polygon points="6 6.868 6 6 5 6 5 7 5.942 7 6 6.868"></polygon>
                                                                <rect height="1" width="1" x="4" y="4"></rect>
                                                                <polygon points="6.817 5 6 5 6 6 6.38 6 6.817 5"></polygon>
                                                                <rect height="1" width="1" x="2" y="6"></rect>
                                                                <rect height="1" width="1" x="3" y="5"></rect>
                                                                <rect height="1" width="1" x="4" y="7"></rect>
                                                                <polygon points="4 11.439 4 11 3 11 3 12 3.755 12 4 11.439"></polygon>
                                                                <rect height="1" width="1" x="2" y="12"></rect>
                                                                <rect height="1" width="1" x="2" y="9"></rect>
                                                                <rect height="1" width="1" x="2" y="15"></rect>
                                                                <polygon points="4.63 10 4 10 4 11 4.192 11 4.63 10"></polygon>
                                                                <rect height="1" width="1" x="3" y="8"></rect>
                                                                <path d="M10.832,4.2L11,4.582V4H10.708A1.948,1.948,0,0,1,10.832,4.2Z"></path>
                                                                <path d="M7,4.582L7.168,4.2A1.929,1.929,0,0,1,7.292,4H7V4.582Z"></path>
                                                                <path d="M8,13H7.683l-0.351.8a1.933,1.933,0,0,1-.124.2H8V13Z"></path>
                                                                <rect height="1" width="1" x="12" y="2"></rect>
                                                                <rect height="1" width="1" x="11" y="3"></rect>
                                                                <path d="M9,3H8V3.282A1.985,1.985,0,0,1,9,3Z"></path>
                                                                <rect height="1" width="1" x="2" y="3"></rect>
                                                                <rect height="1" width="1" x="6" y="2"></rect>
                                                                <rect height="1" width="1" x="3" y="2"></rect>
                                                                <rect height="1" width="1" x="5" y="3"></rect>
                                                                <rect height="1" width="1" x="9" y="2"></rect>
                                                                <rect height="1" width="1" x="15" y="14"></rect>
                                                                <polygon points="13.447 10.174 13.469 10.225 13.472 10.232 13.808 11 14 11 14 10 13.37 10 13.447 10.174"></polygon>
                                                                <rect height="1" width="1" x="13" y="7"></rect>
                                                                <rect height="1" width="1" x="15" y="5"></rect>
                                                                <rect height="1" width="1" x="14" y="6"></rect>
                                                                <rect height="1" width="1" x="15" y="8"></rect>
                                                                <rect height="1" width="1" x="14" y="9"></rect>
                                                                <path d="M3.775,14H3v1H4V14.314A1.97,1.97,0,0,1,3.775,14Z"></path>
                                                                <rect height="1" width="1" x="14" y="3"></rect>
                                                                <polygon points="12 6.868 12 6 11.62 6 12 6.868"></polygon>
                                                                <rect height="1" width="1" x="15" y="2"></rect>
                                                                <rect height="1" width="1" x="12" y="5"></rect>
                                                                <rect height="1" width="1" x="13" y="4"></rect>
                                                                <polygon points="12.933 9 13 9 13 8 12.495 8 12.933 9"></polygon>
                                                                <rect height="1" width="1" x="9" y="14"></rect>
                                                                <rect height="1" width="1" x="8" y="15"></rect>
                                                                <path d="M6,14.926V15H7V14.316A1.993,1.993,0,0,1,6,14.926Z"></path>
                                                                <rect height="1" width="1" x="5" y="15"></rect>
                                                                <path d="M10.668,13.8L10.317,13H10v1h0.792A1.947,1.947,0,0,1,10.668,13.8Z"></path>
                                                                <rect height="1" width="1" x="11" y="15"></rect>
                                                                <path d="M14.332,12.2a1.99,1.99,0,0,1,.166.8H15V12H14.245Z"></path>
                                                                <rect height="1" width="1" x="14" y="15"></rect>
                                                                <rect height="1" width="1" x="15" y="11"></rect>
                                                            </g>
                                                            <polyline class="ql-stroke" points="5.5 13 9 5 12.5 13"></polyline>
                                                            <line class="ql-stroke" x1="11.63" x2="6.38" y1="11" y2="11"></line>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-9">
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#000000" style="background-color: rgb(0, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#e60000" style="background-color: rgb(230, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#ff9900" style="background-color: rgb(255, 153, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#ffff00" style="background-color: rgb(255, 255, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#008a00" style="background-color: rgb(0, 138, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#0066cc" style="background-color: rgb(0, 102, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#9933ff" style="background-color: rgb(153, 51, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-selected"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#facccc" style="background-color: rgb(250, 204, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffebcc" style="background-color: rgb(255, 235, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffffcc" style="background-color: rgb(255, 255, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#cce8cc" style="background-color: rgb(204, 232, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#cce0f5" style="background-color: rgb(204, 224, 245);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ebd6ff" style="background-color: rgb(235, 214, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#bbbbbb" style="background-color: rgb(187, 187, 187);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#f06666" style="background-color: rgb(240, 102, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffc266" style="background-color: rgb(255, 194, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffff66" style="background-color: rgb(255, 255, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#66b966" style="background-color: rgb(102, 185, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#66a3e0" style="background-color: rgb(102, 163, 224);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#c285ff" style="background-color: rgb(194, 133, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#888888" style="background-color: rgb(136, 136, 136);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#a10000" style="background-color: rgb(161, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#b26b00" style="background-color: rgb(178, 107, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#b2b200" style="background-color: rgb(178, 178, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#006100" style="background-color: rgb(0, 97, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#0047b2" style="background-color: rgb(0, 71, 178);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#6b24b2" style="background-color: rgb(107, 36, 178);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#444444" style="background-color: rgb(68, 68, 68);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#5c0000" style="background-color: rgb(92, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#663d00" style="background-color: rgb(102, 61, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#666600" style="background-color: rgb(102, 102, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#003700" style="background-color: rgb(0, 55, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#002966" style="background-color: rgb(0, 41, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#3d1466" style="background-color: rgb(61, 20, 102);"></span>
                                                    </span>
                                                </span>
                                                <select class="ql-background" style="display: none;">
                                                    <option value="#000000"></option>
                                                    <option value="#e60000"></option>
                                                    <option value="#ff9900"></option>
                                                    <option value="#ffff00"></option>
                                                    <option value="#008a00"></option>
                                                    <option value="#0066cc"></option>
                                                    <option value="#9933ff"></option>
                                                    <option selected="selected"></option>
                                                    <option value="#facccc"></option>
                                                    <option value="#ffebcc"></option>
                                                    <option value="#ffffcc"></option>
                                                    <option value="#cce8cc"></option>
                                                    <option value="#cce0f5"></option>
                                                    <option value="#ebd6ff"></option>
                                                    <option value="#bbbbbb"></option>
                                                    <option value="#f06666"></option>
                                                    <option value="#ffc266"></option>
                                                    <option value="#ffff66"></option>
                                                    <option value="#66b966"></option>
                                                    <option value="#66a3e0"></option>
                                                    <option value="#c285ff"></option>
                                                    <option value="#888888"></option>
                                                    <option value="#a10000"></option>
                                                    <option value="#b26b00"></option>
                                                    <option value="#b2b200"></option>
                                                    <option value="#006100"></option>
                                                    <option value="#0047b2"></option>
                                                    <option value="#6b24b2"></option>
                                                    <option value="#444444"></option>
                                                    <option value="#5c0000"></option>
                                                    <option value="#663d00"></option>
                                                    <option value="#666600"></option>
                                                    <option value="#003700"></option>
                                                    <option value="#002966"></option>
                                                    <option value="#3d1466"></option>
                                                </select>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-script" value="super">
                                                    <svg viewBox="0 0 18 18">
                                                        <path
                                                            class="ql-fill"
                                                            d="M15.5,7H13.861a4.015,4.015,0,0,0,1.914-2.975,1.8,1.8,0,0,0-1.6-1.751A1.922,1.922,0,0,0,12.021,3.7a0.5,0.5,0,1,0,.957.291,0.917,0.917,0,0,1,1.053-.725,0.81,0.81,0,0,1,.744.762c0,1.077-1.164,1.925-1.934,2.486A1.423,1.423,0,0,0,12,7.5a0.5,0.5,0,0,0,.5.5h3A0.5,0.5,0,0,0,15.5,7Z"
                                                        ></path>
                                                        <path
                                                            class="ql-fill"
                                                            d="M9.651,5.241a1,1,0,0,0-1.41.108L6,7.964,3.759,5.349a1,1,0,1,0-1.519,1.3L4.683,9.5,2.241,12.35a1,1,0,1,0,1.519,1.3L6,11.036,8.241,13.65a1,1,0,0,0,1.519-1.3L7.317,9.5,9.759,6.651A1,1,0,0,0,9.651,5.241Z"
                                                        ></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-script" value="sub">
                                                    <svg viewBox="0 0 18 18">
                                                        <path
                                                            class="ql-fill"
                                                            d="M15.5,15H13.861a3.858,3.858,0,0,0,1.914-2.975,1.8,1.8,0,0,0-1.6-1.751A1.921,1.921,0,0,0,12.021,11.7a0.50013,0.50013,0,1,0,.957.291h0a0.914,0.914,0,0,1,1.053-.725,0.81,0.81,0,0,1,.744.762c0,1.076-1.16971,1.86982-1.93971,2.43082A1.45639,1.45639,0,0,0,12,15.5a0.5,0.5,0,0,0,.5.5h3A0.5,0.5,0,0,0,15.5,15Z"
                                                        ></path>
                                                        <path
                                                            class="ql-fill"
                                                            d="M9.65,5.241a1,1,0,0,0-1.409.108L6,7.964,3.759,5.349A1,1,0,0,0,2.192,6.59178Q2.21541,6.6213,2.241,6.649L4.684,9.5,2.241,12.35A1,1,0,0,0,3.71,13.70722q0.02557-.02768.049-0.05722L6,11.036,8.241,13.65a1,1,0,1,0,1.567-1.24277Q9.78459,12.3777,9.759,12.35L7.316,9.5,9.759,6.651A1,1,0,0,0,9.65,5.241Z"
                                                        ></path>
                                                    </svg>
                                                </button>
                                            </span>
                                        <span class="ql-formats">
                                                <span class="ql-header ql-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-10">
                                                        <svg viewBox="0 0 18 18">
                                                            <polygon class="ql-stroke" points="7 11 9 13 11 11 7 11"></polygon>
                                                            <polygon class="ql-stroke" points="7 7 9 5 11 7 7 7"></polygon>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-10">
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-selected"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="1"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="2"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="3"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="4"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="5"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="6"></span>
                                                    </span>
                                                </span>
                                                <select class="ql-header" style="display: none;">
                                                    <option selected="selected"></option>
                                                    <option value="1"></option>
                                                    <option value="2"></option>
                                                    <option value="3"></option>
                                                    <option value="4"></option>
                                                    <option value="5"></option>
                                                    <option value="6"></option>
                                                </select>
                                                <button type="button" class="ql-blockquote">
                                                    <svg viewBox="0 0 18 18">
                                                        <rect class="ql-fill ql-stroke" height="3" width="3" x="4" y="5"></rect>
                                                        <rect class="ql-fill ql-stroke" height="3" width="3" x="11" y="5"></rect>
                                                        <path class="ql-even ql-fill ql-stroke" d="M7,8c0,4.031-3,5-3,5"></path>
                                                        <path class="ql-even ql-fill ql-stroke" d="M14,8c0,4.031-3,5-3,5"></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-code-block">
                                                    <svg viewBox="0 0 18 18">
                                                        <polyline class="ql-even ql-stroke" points="5 7 3 9 5 11"></polyline>
                                                        <polyline class="ql-even ql-stroke" points="13 7 15 9 13 11"></polyline>
                                                        <line class="ql-stroke" x1="10" x2="8" y1="5" y2="13"></line>
                                                    </svg>
                                                </button>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-list" value="ordered">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="7" x2="15" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="7" x2="15" y1="9" y2="9"></line>
                                                        <line class="ql-stroke" x1="7" x2="15" y1="14" y2="14"></line>
                                                        <line class="ql-stroke ql-thin" x1="2.5" x2="4.5" y1="5.5" y2="5.5"></line>
                                                        <path class="ql-fill" d="M3.5,6A0.5,0.5,0,0,1,3,5.5V3.085l-0.276.138A0.5,0.5,0,0,1,2.053,3c-0.124-.247-0.023-0.324.224-0.447l1-.5A0.5,0.5,0,0,1,4,2.5v3A0.5,0.5,0,0,1,3.5,6Z"></path>
                                                        <path class="ql-stroke ql-thin" d="M4.5,10.5h-2c0-.234,1.85-1.076,1.85-2.234A0.959,0.959,0,0,0,2.5,8.156"></path>
                                                        <path class="ql-stroke ql-thin" d="M2.5,14.846a0.959,0.959,0,0,0,1.85-.109A0.7,0.7,0,0,0,3.75,14a0.688,0.688,0,0,0,.6-0.736,0.959,0.959,0,0,0-1.85-.109"></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-list" value="bullet">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="6" x2="15" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="6" x2="15" y1="9" y2="9"></line>
                                                        <line class="ql-stroke" x1="6" x2="15" y1="14" y2="14"></line>
                                                        <line class="ql-stroke" x1="3" x2="3" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="3" x2="3" y1="9" y2="9"></line>
                                                        <line class="ql-stroke" x1="3" x2="3" y1="14" y2="14"></line>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-indent" value="-1">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="3" x2="15" y1="14" y2="14"></line>
                                                        <line class="ql-stroke" x1="3" x2="15" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="9" x2="15" y1="9" y2="9"></line>
                                                        <polyline class="ql-stroke" points="5 7 5 11 3 9 5 7"></polyline>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-indent" value="+1">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="3" x2="15" y1="14" y2="14"></line>
                                                        <line class="ql-stroke" x1="3" x2="15" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="9" x2="15" y1="9" y2="9"></line>
                                                        <polyline class="ql-fill ql-stroke" points="3 7 3 11 5 9 3 7"></polyline>
                                                    </svg>
                                                </button>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-direction">
                                                    <svg viewBox="0 0 18 18">
                                                        <polygon class="ql-stroke ql-fill" points="3 11 5 9 3 7 3 11"></polygon>
                                                        <line class="ql-stroke ql-fill" x1="15" x2="11" y1="4" y2="4"></line>
                                                        <path class="ql-fill" d="M11,3a3,3,0,0,0,0,6h1V3H11Z"></path>
                                                        <rect class="ql-fill" height="11" width="1" x="11" y="4"></rect>
                                                        <rect class="ql-fill" height="11" width="1" x="13" y="4"></rect>
                                                    </svg>
                                                    <svg viewBox="0 0 18 18">
                                                        <polygon class="ql-stroke ql-fill" points="15 12 13 10 15 8 15 12"></polygon>
                                                        <line class="ql-stroke ql-fill" x1="9" x2="5" y1="4" y2="4"></line>
                                                        <path class="ql-fill" d="M5,3A3,3,0,0,0,5,9H6V3H5Z"></path>
                                                        <rect class="ql-fill" height="11" width="1" x="5" y="4"></rect>
                                                        <rect class="ql-fill" height="11" width="1" x="7" y="4"></rect>
                                                    </svg>
                                                </button>
                                                <span class="ql-align ql-picker ql-icon-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-11">
                                                        <svg viewBox="0 0 18 18">
                                                            <line class="ql-stroke" x1="3" x2="15" y1="9" y2="9"></line>
                                                            <line class="ql-stroke" x1="3" x2="13" y1="14" y2="14"></line>
                                                            <line class="ql-stroke" x1="3" x2="9" y1="4" y2="4"></line>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-11">
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-selected">
                                                            <svg viewBox="0 0 18 18">
                                                                <line class="ql-stroke" x1="3" x2="15" y1="9" y2="9"></line>
                                                                <line class="ql-stroke" x1="3" x2="13" y1="14" y2="14"></line>
                                                                <line class="ql-stroke" x1="3" x2="9" y1="4" y2="4"></line>
                                                            </svg>
                                                        </span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="center">
                                                            <svg viewBox="0 0 18 18">
                                                                <line class="ql-stroke" x1="15" x2="3" y1="9" y2="9"></line>
                                                                <line class="ql-stroke" x1="14" x2="4" y1="14" y2="14"></line>
                                                                <line class="ql-stroke" x1="12" x2="6" y1="4" y2="4"></line>
                                                            </svg>
                                                        </span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="right">
                                                            <svg viewBox="0 0 18 18">
                                                                <line class="ql-stroke" x1="15" x2="3" y1="9" y2="9"></line>
                                                                <line class="ql-stroke" x1="15" x2="5" y1="14" y2="14"></line>
                                                                <line class="ql-stroke" x1="15" x2="9" y1="4" y2="4"></line>
                                                            </svg>
                                                        </span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="justify">
                                                            <svg viewBox="0 0 18 18">
                                                                <line class="ql-stroke" x1="15" x2="3" y1="9" y2="9"></line>
                                                                <line class="ql-stroke" x1="15" x2="3" y1="14" y2="14"></line>
                                                                <line class="ql-stroke" x1="15" x2="3" y1="4" y2="4"></line>
                                                            </svg>
                                                        </span>
                                                    </span>
                                                </span>
                                                <select class="ql-align" style="display: none;">
                                                    <option selected="selected"></option>
                                                    <option value="center"></option>
                                                    <option value="right"></option>
                                                    <option value="justify"></option>
                                                </select>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-link">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="7" x2="11" y1="7" y2="11"></line>
                                                        <path class="ql-even ql-stroke" d="M8.9,4.577a3.476,3.476,0,0,1,.36,4.679A3.476,3.476,0,0,1,4.577,8.9C3.185,7.5,2.035,6.4,4.217,4.217S7.5,3.185,8.9,4.577Z"></path>
                                                        <path class="ql-even ql-stroke" d="M13.423,9.1a3.476,3.476,0,0,0-4.679-.36,3.476,3.476,0,0,0,.36,4.679c1.392,1.392,2.5,2.542,4.679.36S14.815,10.5,13.423,9.1Z"></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-image">
                                                    <svg viewBox="0 0 18 18">
                                                        <rect class="ql-stroke" height="10" width="12" x="3" y="4"></rect>
                                                        <circle class="ql-fill" cx="6" cy="7" r="1"></circle>
                                                        <polyline class="ql-even ql-fill" points="5 12 5 11 7 9 8 10 11 7 13 9 13 12 5 12"></polyline>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-video">
                                                    <svg viewBox="0 0 18 18">
                                                        <rect class="ql-stroke" height="12" width="12" x="3" y="3"></rect>
                                                        <rect class="ql-fill" height="12" width="1" x="5" y="3"></rect>
                                                        <rect class="ql-fill" height="12" width="1" x="12" y="3"></rect>
                                                        <rect class="ql-fill" height="2" width="8" x="5" y="8"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="3" y="5"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="3" y="7"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="3" y="10"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="3" y="12"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="12" y="5"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="12" y="7"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="12" y="10"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="12" y="12"></rect>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-formula">
                                                    <svg viewBox="0 0 18 18">
                                                        <path
                                                            class="ql-fill"
                                                            d="M11.759,2.482a2.561,2.561,0,0,0-3.53.607A7.656,7.656,0,0,0,6.8,6.2C6.109,9.188,5.275,14.677,4.15,14.927a1.545,1.545,0,0,0-1.3-.933A0.922,0.922,0,0,0,2,15.036S1.954,16,4.119,16s3.091-2.691,3.7-5.553c0.177-.826.36-1.726,0.554-2.6L8.775,6.2c0.381-1.421.807-2.521,1.306-2.676a1.014,1.014,0,0,0,1.02.56A0.966,0.966,0,0,0,11.759,2.482Z"
                                                        ></path>
                                                        <rect class="ql-fill" height="1.6" rx="0.8" ry="0.8" width="5" x="5.15" y="6.2"></rect>
                                                        <path
                                                            class="ql-fill"
                                                            d="M13.663,12.027a1.662,1.662,0,0,1,.266-0.276q0.193,0.069.456,0.138a2.1,2.1,0,0,0,.535.069,1.075,1.075,0,0,0,.767-0.3,1.044,1.044,0,0,0,.314-0.8,0.84,0.84,0,0,0-.238-0.619,0.8,0.8,0,0,0-.594-0.239,1.154,1.154,0,0,0-.781.3,4.607,4.607,0,0,0-.781,1q-0.091.15-.218,0.346l-0.246.38c-0.068-.288-0.137-0.582-0.212-0.885-0.459-1.847-2.494-.984-2.941-0.8-0.482.2-.353,0.647-0.094,0.529a0.869,0.869,0,0,1,1.281.585c0.217,0.751.377,1.436,0.527,2.038a5.688,5.688,0,0,1-.362.467,2.69,2.69,0,0,1-.264.271q-0.221-.08-0.471-0.147a2.029,2.029,0,0,0-.522-0.066,1.079,1.079,0,0,0-.768.3A1.058,1.058,0,0,0,9,15.131a0.82,0.82,0,0,0,.832.852,1.134,1.134,0,0,0,.787-0.3,5.11,5.11,0,0,0,.776-0.993q0.141-.219.215-0.34c0.046-.076.122-0.194,0.223-0.346a2.786,2.786,0,0,0,.918,1.726,2.582,2.582,0,0,0,2.376-.185c0.317-.181.212-0.565,0-0.494A0.807,0.807,0,0,1,14.176,15a5.159,5.159,0,0,1-.913-2.446l0,0Q13.487,12.24,13.663,12.027Z"
                                                        ></path>
                                                    </svg>
                                                </button>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-clean">
                                                    <svg class="" viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="5" x2="13" y1="3" y2="3"></line>
                                                        <line class="ql-stroke" x1="6" x2="9.35" y1="12" y2="3"></line>
                                                        <line class="ql-stroke" x1="11" x2="15" y1="11" y2="15"></line>
                                                        <line class="ql-stroke" x1="15" x2="11" y1="11" y2="15"></line>
                                                        <rect class="ql-fill" height="1" rx="0.5" ry="0.5" width="7" x="2" y="14"></rect>
                                                    </svg>
                                                </button>
                                            </span>
                                    </div>
                                    <div class="audit_protistaner_jobab ql-container ql-snow" id="snow-editor2">
                                        <div class="ql-editor ql-blank" data-gramm="false" contenteditable="true">
                                            <p><br /></p>
                                        </div>
                                        <div class="ql-clipboard" tabindex="-1" contenteditable="true"></div>
                                        <div class="ql-tooltip ql-hidden">
                                            <a class="ql-preview" target="_blank" href="about:blank"></a><input type="text" data-formula="e=mc^2" data-link="https://quilljs.com" data-video="Embed URL" /><a class="ql-action"></a>
                                            <a class="ql-remove"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="nirikka_montobbo" class="col-form-label">Nirikka Montobbo:</label>

                                    <input type="hidden" name="nirikka_montobbo" id="nirikka_montobbo" />
                                    <div class="ql-toolbar ql-snow">
                                            <span class="ql-formats">
                                                <span class="ql-font ql-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-12">
                                                        <svg viewBox="0 0 18 18">
                                                            <polygon class="ql-stroke" points="7 11 9 13 11 11 7 11"></polygon>
                                                            <polygon class="ql-stroke" points="7 7 9 5 11 7 7 7"></polygon>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-12">
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-selected"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="serif"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="monospace"></span>
                                                    </span>
                                                </span>
                                                <select class="ql-font" style="display: none;">
                                                    <option selected="selected"></option>
                                                    <option value="serif"></option>
                                                    <option value="monospace"></option>
                                                </select>
                                                <span class="ql-size ql-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-13">
                                                        <svg viewBox="0 0 18 18">
                                                            <polygon class="ql-stroke" points="7 11 9 13 11 11 7 11"></polygon>
                                                            <polygon class="ql-stroke" points="7 7 9 5 11 7 7 7"></polygon>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-13">
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="small"></span><span tabindex="0" role="button" class="ql-picker-item ql-selected"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="large"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="huge"></span>
                                                    </span>
                                                </span>
                                                <select class="ql-size" style="display: none;">
                                                    <option value="small"></option>
                                                    <option selected="selected"></option>
                                                    <option value="large"></option>
                                                    <option value="huge"></option>
                                                </select>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-bold">
                                                    <svg viewBox="0 0 18 18">
                                                        <path class="ql-stroke" d="M5,4H9.5A2.5,2.5,0,0,1,12,6.5v0A2.5,2.5,0,0,1,9.5,9H5A0,0,0,0,1,5,9V4A0,0,0,0,1,5,4Z"></path>
                                                        <path class="ql-stroke" d="M5,9h5.5A2.5,2.5,0,0,1,13,11.5v0A2.5,2.5,0,0,1,10.5,14H5a0,0,0,0,1,0,0V9A0,0,0,0,1,5,9Z"></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-italic">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="7" x2="13" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="5" x2="11" y1="14" y2="14"></line>
                                                        <line class="ql-stroke" x1="8" x2="10" y1="14" y2="4"></line>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-underline">
                                                    <svg viewBox="0 0 18 18">
                                                        <path class="ql-stroke" d="M5,3V9a4.012,4.012,0,0,0,4,4H9a4.012,4.012,0,0,0,4-4V3"></path>
                                                        <rect class="ql-fill" height="1" rx="0.5" ry="0.5" width="12" x="3" y="15"></rect>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-strike">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke ql-thin" x1="15.5" x2="2.5" y1="8.5" y2="9.5"></line>
                                                        <path
                                                            class="ql-fill"
                                                            d="M9.007,8C6.542,7.791,6,7.519,6,6.5,6,5.792,7.283,5,9,5c1.571,0,2.765.679,2.969,1.309a1,1,0,0,0,1.9-.617C13.356,4.106,11.354,3,9,3,6.2,3,4,4.538,4,6.5a3.2,3.2,0,0,0,.5,1.843Z"
                                                        ></path>
                                                        <path
                                                            class="ql-fill"
                                                            d="M8.984,10C11.457,10.208,12,10.479,12,11.5c0,0.708-1.283,1.5-3,1.5-1.571,0-2.765-.679-2.969-1.309a1,1,0,1,0-1.9.617C4.644,13.894,6.646,15,9,15c2.8,0,5-1.538,5-3.5a3.2,3.2,0,0,0-.5-1.843Z"
                                                        ></path>
                                                    </svg>
                                                </button>
                                            </span>
                                        <span class="ql-formats">
                                                <span class="ql-color ql-picker ql-color-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-14">
                                                        <svg viewBox="0 0 18 18">
                                                            <line class="ql-color-label ql-stroke ql-transparent" x1="3" x2="15" y1="15" y2="15"></line>
                                                            <polyline class="ql-stroke" points="5.5 11 9 3 12.5 11"></polyline>
                                                            <line class="ql-stroke" x1="11.63" x2="6.38" y1="9" y2="9"></line>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-14">
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-selected ql-primary"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#e60000" style="background-color: rgb(230, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#ff9900" style="background-color: rgb(255, 153, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#ffff00" style="background-color: rgb(255, 255, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#008a00" style="background-color: rgb(0, 138, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#0066cc" style="background-color: rgb(0, 102, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#9933ff" style="background-color: rgb(153, 51, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffffff" style="background-color: rgb(255, 255, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#facccc" style="background-color: rgb(250, 204, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffebcc" style="background-color: rgb(255, 235, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffffcc" style="background-color: rgb(255, 255, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#cce8cc" style="background-color: rgb(204, 232, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#cce0f5" style="background-color: rgb(204, 224, 245);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ebd6ff" style="background-color: rgb(235, 214, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#bbbbbb" style="background-color: rgb(187, 187, 187);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#f06666" style="background-color: rgb(240, 102, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffc266" style="background-color: rgb(255, 194, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffff66" style="background-color: rgb(255, 255, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#66b966" style="background-color: rgb(102, 185, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#66a3e0" style="background-color: rgb(102, 163, 224);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#c285ff" style="background-color: rgb(194, 133, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#888888" style="background-color: rgb(136, 136, 136);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#a10000" style="background-color: rgb(161, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#b26b00" style="background-color: rgb(178, 107, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#b2b200" style="background-color: rgb(178, 178, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#006100" style="background-color: rgb(0, 97, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#0047b2" style="background-color: rgb(0, 71, 178);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#6b24b2" style="background-color: rgb(107, 36, 178);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#444444" style="background-color: rgb(68, 68, 68);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#5c0000" style="background-color: rgb(92, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#663d00" style="background-color: rgb(102, 61, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#666600" style="background-color: rgb(102, 102, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#003700" style="background-color: rgb(0, 55, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#002966" style="background-color: rgb(0, 41, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#3d1466" style="background-color: rgb(61, 20, 102);"></span>
                                                    </span>
                                                </span>
                                                <select class="ql-color" style="display: none;">
                                                    <option selected="selected"></option>
                                                    <option value="#e60000"></option>
                                                    <option value="#ff9900"></option>
                                                    <option value="#ffff00"></option>
                                                    <option value="#008a00"></option>
                                                    <option value="#0066cc"></option>
                                                    <option value="#9933ff"></option>
                                                    <option value="#ffffff"></option>
                                                    <option value="#facccc"></option>
                                                    <option value="#ffebcc"></option>
                                                    <option value="#ffffcc"></option>
                                                    <option value="#cce8cc"></option>
                                                    <option value="#cce0f5"></option>
                                                    <option value="#ebd6ff"></option>
                                                    <option value="#bbbbbb"></option>
                                                    <option value="#f06666"></option>
                                                    <option value="#ffc266"></option>
                                                    <option value="#ffff66"></option>
                                                    <option value="#66b966"></option>
                                                    <option value="#66a3e0"></option>
                                                    <option value="#c285ff"></option>
                                                    <option value="#888888"></option>
                                                    <option value="#a10000"></option>
                                                    <option value="#b26b00"></option>
                                                    <option value="#b2b200"></option>
                                                    <option value="#006100"></option>
                                                    <option value="#0047b2"></option>
                                                    <option value="#6b24b2"></option>
                                                    <option value="#444444"></option>
                                                    <option value="#5c0000"></option>
                                                    <option value="#663d00"></option>
                                                    <option value="#666600"></option>
                                                    <option value="#003700"></option>
                                                    <option value="#002966"></option>
                                                    <option value="#3d1466"></option>
                                                </select>
                                                <span class="ql-background ql-picker ql-color-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-15">
                                                        <svg viewBox="0 0 18 18">
                                                            <g class="ql-fill ql-color-label">
                                                                <polygon points="6 6.868 6 6 5 6 5 7 5.942 7 6 6.868"></polygon>
                                                                <rect height="1" width="1" x="4" y="4"></rect>
                                                                <polygon points="6.817 5 6 5 6 6 6.38 6 6.817 5"></polygon>
                                                                <rect height="1" width="1" x="2" y="6"></rect>
                                                                <rect height="1" width="1" x="3" y="5"></rect>
                                                                <rect height="1" width="1" x="4" y="7"></rect>
                                                                <polygon points="4 11.439 4 11 3 11 3 12 3.755 12 4 11.439"></polygon>
                                                                <rect height="1" width="1" x="2" y="12"></rect>
                                                                <rect height="1" width="1" x="2" y="9"></rect>
                                                                <rect height="1" width="1" x="2" y="15"></rect>
                                                                <polygon points="4.63 10 4 10 4 11 4.192 11 4.63 10"></polygon>
                                                                <rect height="1" width="1" x="3" y="8"></rect>
                                                                <path d="M10.832,4.2L11,4.582V4H10.708A1.948,1.948,0,0,1,10.832,4.2Z"></path>
                                                                <path d="M7,4.582L7.168,4.2A1.929,1.929,0,0,1,7.292,4H7V4.582Z"></path>
                                                                <path d="M8,13H7.683l-0.351.8a1.933,1.933,0,0,1-.124.2H8V13Z"></path>
                                                                <rect height="1" width="1" x="12" y="2"></rect>
                                                                <rect height="1" width="1" x="11" y="3"></rect>
                                                                <path d="M9,3H8V3.282A1.985,1.985,0,0,1,9,3Z"></path>
                                                                <rect height="1" width="1" x="2" y="3"></rect>
                                                                <rect height="1" width="1" x="6" y="2"></rect>
                                                                <rect height="1" width="1" x="3" y="2"></rect>
                                                                <rect height="1" width="1" x="5" y="3"></rect>
                                                                <rect height="1" width="1" x="9" y="2"></rect>
                                                                <rect height="1" width="1" x="15" y="14"></rect>
                                                                <polygon points="13.447 10.174 13.469 10.225 13.472 10.232 13.808 11 14 11 14 10 13.37 10 13.447 10.174"></polygon>
                                                                <rect height="1" width="1" x="13" y="7"></rect>
                                                                <rect height="1" width="1" x="15" y="5"></rect>
                                                                <rect height="1" width="1" x="14" y="6"></rect>
                                                                <rect height="1" width="1" x="15" y="8"></rect>
                                                                <rect height="1" width="1" x="14" y="9"></rect>
                                                                <path d="M3.775,14H3v1H4V14.314A1.97,1.97,0,0,1,3.775,14Z"></path>
                                                                <rect height="1" width="1" x="14" y="3"></rect>
                                                                <polygon points="12 6.868 12 6 11.62 6 12 6.868"></polygon>
                                                                <rect height="1" width="1" x="15" y="2"></rect>
                                                                <rect height="1" width="1" x="12" y="5"></rect>
                                                                <rect height="1" width="1" x="13" y="4"></rect>
                                                                <polygon points="12.933 9 13 9 13 8 12.495 8 12.933 9"></polygon>
                                                                <rect height="1" width="1" x="9" y="14"></rect>
                                                                <rect height="1" width="1" x="8" y="15"></rect>
                                                                <path d="M6,14.926V15H7V14.316A1.993,1.993,0,0,1,6,14.926Z"></path>
                                                                <rect height="1" width="1" x="5" y="15"></rect>
                                                                <path d="M10.668,13.8L10.317,13H10v1h0.792A1.947,1.947,0,0,1,10.668,13.8Z"></path>
                                                                <rect height="1" width="1" x="11" y="15"></rect>
                                                                <path d="M14.332,12.2a1.99,1.99,0,0,1,.166.8H15V12H14.245Z"></path>
                                                                <rect height="1" width="1" x="14" y="15"></rect>
                                                                <rect height="1" width="1" x="15" y="11"></rect>
                                                            </g>
                                                            <polyline class="ql-stroke" points="5.5 13 9 5 12.5 13"></polyline>
                                                            <line class="ql-stroke" x1="11.63" x2="6.38" y1="11" y2="11"></line>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-15">
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#000000" style="background-color: rgb(0, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#e60000" style="background-color: rgb(230, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#ff9900" style="background-color: rgb(255, 153, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#ffff00" style="background-color: rgb(255, 255, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#008a00" style="background-color: rgb(0, 138, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#0066cc" style="background-color: rgb(0, 102, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#9933ff" style="background-color: rgb(153, 51, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-selected"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#facccc" style="background-color: rgb(250, 204, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffebcc" style="background-color: rgb(255, 235, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffffcc" style="background-color: rgb(255, 255, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#cce8cc" style="background-color: rgb(204, 232, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#cce0f5" style="background-color: rgb(204, 224, 245);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ebd6ff" style="background-color: rgb(235, 214, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#bbbbbb" style="background-color: rgb(187, 187, 187);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#f06666" style="background-color: rgb(240, 102, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffc266" style="background-color: rgb(255, 194, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffff66" style="background-color: rgb(255, 255, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#66b966" style="background-color: rgb(102, 185, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#66a3e0" style="background-color: rgb(102, 163, 224);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#c285ff" style="background-color: rgb(194, 133, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#888888" style="background-color: rgb(136, 136, 136);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#a10000" style="background-color: rgb(161, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#b26b00" style="background-color: rgb(178, 107, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#b2b200" style="background-color: rgb(178, 178, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#006100" style="background-color: rgb(0, 97, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#0047b2" style="background-color: rgb(0, 71, 178);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#6b24b2" style="background-color: rgb(107, 36, 178);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#444444" style="background-color: rgb(68, 68, 68);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#5c0000" style="background-color: rgb(92, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#663d00" style="background-color: rgb(102, 61, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#666600" style="background-color: rgb(102, 102, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#003700" style="background-color: rgb(0, 55, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#002966" style="background-color: rgb(0, 41, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#3d1466" style="background-color: rgb(61, 20, 102);"></span>
                                                    </span>
                                                </span>
                                                <select class="ql-background" style="display: none;">
                                                    <option value="#000000"></option>
                                                    <option value="#e60000"></option>
                                                    <option value="#ff9900"></option>
                                                    <option value="#ffff00"></option>
                                                    <option value="#008a00"></option>
                                                    <option value="#0066cc"></option>
                                                    <option value="#9933ff"></option>
                                                    <option selected="selected"></option>
                                                    <option value="#facccc"></option>
                                                    <option value="#ffebcc"></option>
                                                    <option value="#ffffcc"></option>
                                                    <option value="#cce8cc"></option>
                                                    <option value="#cce0f5"></option>
                                                    <option value="#ebd6ff"></option>
                                                    <option value="#bbbbbb"></option>
                                                    <option value="#f06666"></option>
                                                    <option value="#ffc266"></option>
                                                    <option value="#ffff66"></option>
                                                    <option value="#66b966"></option>
                                                    <option value="#66a3e0"></option>
                                                    <option value="#c285ff"></option>
                                                    <option value="#888888"></option>
                                                    <option value="#a10000"></option>
                                                    <option value="#b26b00"></option>
                                                    <option value="#b2b200"></option>
                                                    <option value="#006100"></option>
                                                    <option value="#0047b2"></option>
                                                    <option value="#6b24b2"></option>
                                                    <option value="#444444"></option>
                                                    <option value="#5c0000"></option>
                                                    <option value="#663d00"></option>
                                                    <option value="#666600"></option>
                                                    <option value="#003700"></option>
                                                    <option value="#002966"></option>
                                                    <option value="#3d1466"></option>
                                                </select>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-script" value="super">
                                                    <svg viewBox="0 0 18 18">
                                                        <path
                                                            class="ql-fill"
                                                            d="M15.5,7H13.861a4.015,4.015,0,0,0,1.914-2.975,1.8,1.8,0,0,0-1.6-1.751A1.922,1.922,0,0,0,12.021,3.7a0.5,0.5,0,1,0,.957.291,0.917,0.917,0,0,1,1.053-.725,0.81,0.81,0,0,1,.744.762c0,1.077-1.164,1.925-1.934,2.486A1.423,1.423,0,0,0,12,7.5a0.5,0.5,0,0,0,.5.5h3A0.5,0.5,0,0,0,15.5,7Z"
                                                        ></path>
                                                        <path
                                                            class="ql-fill"
                                                            d="M9.651,5.241a1,1,0,0,0-1.41.108L6,7.964,3.759,5.349a1,1,0,1,0-1.519,1.3L4.683,9.5,2.241,12.35a1,1,0,1,0,1.519,1.3L6,11.036,8.241,13.65a1,1,0,0,0,1.519-1.3L7.317,9.5,9.759,6.651A1,1,0,0,0,9.651,5.241Z"
                                                        ></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-script" value="sub">
                                                    <svg viewBox="0 0 18 18">
                                                        <path
                                                            class="ql-fill"
                                                            d="M15.5,15H13.861a3.858,3.858,0,0,0,1.914-2.975,1.8,1.8,0,0,0-1.6-1.751A1.921,1.921,0,0,0,12.021,11.7a0.50013,0.50013,0,1,0,.957.291h0a0.914,0.914,0,0,1,1.053-.725,0.81,0.81,0,0,1,.744.762c0,1.076-1.16971,1.86982-1.93971,2.43082A1.45639,1.45639,0,0,0,12,15.5a0.5,0.5,0,0,0,.5.5h3A0.5,0.5,0,0,0,15.5,15Z"
                                                        ></path>
                                                        <path
                                                            class="ql-fill"
                                                            d="M9.65,5.241a1,1,0,0,0-1.409.108L6,7.964,3.759,5.349A1,1,0,0,0,2.192,6.59178Q2.21541,6.6213,2.241,6.649L4.684,9.5,2.241,12.35A1,1,0,0,0,3.71,13.70722q0.02557-.02768.049-0.05722L6,11.036,8.241,13.65a1,1,0,1,0,1.567-1.24277Q9.78459,12.3777,9.759,12.35L7.316,9.5,9.759,6.651A1,1,0,0,0,9.65,5.241Z"
                                                        ></path>
                                                    </svg>
                                                </button>
                                            </span>
                                        <span class="ql-formats">
                                                <span class="ql-header ql-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-16">
                                                        <svg viewBox="0 0 18 18">
                                                            <polygon class="ql-stroke" points="7 11 9 13 11 11 7 11"></polygon>
                                                            <polygon class="ql-stroke" points="7 7 9 5 11 7 7 7"></polygon>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-16">
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-selected"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="1"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="2"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="3"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="4"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="5"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="6"></span>
                                                    </span>
                                                </span>
                                                <select class="ql-header" style="display: none;">
                                                    <option selected="selected"></option>
                                                    <option value="1"></option>
                                                    <option value="2"></option>
                                                    <option value="3"></option>
                                                    <option value="4"></option>
                                                    <option value="5"></option>
                                                    <option value="6"></option>
                                                </select>
                                                <button type="button" class="ql-blockquote">
                                                    <svg viewBox="0 0 18 18">
                                                        <rect class="ql-fill ql-stroke" height="3" width="3" x="4" y="5"></rect>
                                                        <rect class="ql-fill ql-stroke" height="3" width="3" x="11" y="5"></rect>
                                                        <path class="ql-even ql-fill ql-stroke" d="M7,8c0,4.031-3,5-3,5"></path>
                                                        <path class="ql-even ql-fill ql-stroke" d="M14,8c0,4.031-3,5-3,5"></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-code-block">
                                                    <svg viewBox="0 0 18 18">
                                                        <polyline class="ql-even ql-stroke" points="5 7 3 9 5 11"></polyline>
                                                        <polyline class="ql-even ql-stroke" points="13 7 15 9 13 11"></polyline>
                                                        <line class="ql-stroke" x1="10" x2="8" y1="5" y2="13"></line>
                                                    </svg>
                                                </button>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-list" value="ordered">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="7" x2="15" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="7" x2="15" y1="9" y2="9"></line>
                                                        <line class="ql-stroke" x1="7" x2="15" y1="14" y2="14"></line>
                                                        <line class="ql-stroke ql-thin" x1="2.5" x2="4.5" y1="5.5" y2="5.5"></line>
                                                        <path class="ql-fill" d="M3.5,6A0.5,0.5,0,0,1,3,5.5V3.085l-0.276.138A0.5,0.5,0,0,1,2.053,3c-0.124-.247-0.023-0.324.224-0.447l1-.5A0.5,0.5,0,0,1,4,2.5v3A0.5,0.5,0,0,1,3.5,6Z"></path>
                                                        <path class="ql-stroke ql-thin" d="M4.5,10.5h-2c0-.234,1.85-1.076,1.85-2.234A0.959,0.959,0,0,0,2.5,8.156"></path>
                                                        <path class="ql-stroke ql-thin" d="M2.5,14.846a0.959,0.959,0,0,0,1.85-.109A0.7,0.7,0,0,0,3.75,14a0.688,0.688,0,0,0,.6-0.736,0.959,0.959,0,0,0-1.85-.109"></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-list" value="bullet">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="6" x2="15" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="6" x2="15" y1="9" y2="9"></line>
                                                        <line class="ql-stroke" x1="6" x2="15" y1="14" y2="14"></line>
                                                        <line class="ql-stroke" x1="3" x2="3" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="3" x2="3" y1="9" y2="9"></line>
                                                        <line class="ql-stroke" x1="3" x2="3" y1="14" y2="14"></line>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-indent" value="-1">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="3" x2="15" y1="14" y2="14"></line>
                                                        <line class="ql-stroke" x1="3" x2="15" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="9" x2="15" y1="9" y2="9"></line>
                                                        <polyline class="ql-stroke" points="5 7 5 11 3 9 5 7"></polyline>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-indent" value="+1">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="3" x2="15" y1="14" y2="14"></line>
                                                        <line class="ql-stroke" x1="3" x2="15" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="9" x2="15" y1="9" y2="9"></line>
                                                        <polyline class="ql-fill ql-stroke" points="3 7 3 11 5 9 3 7"></polyline>
                                                    </svg>
                                                </button>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-direction">
                                                    <svg viewBox="0 0 18 18">
                                                        <polygon class="ql-stroke ql-fill" points="3 11 5 9 3 7 3 11"></polygon>
                                                        <line class="ql-stroke ql-fill" x1="15" x2="11" y1="4" y2="4"></line>
                                                        <path class="ql-fill" d="M11,3a3,3,0,0,0,0,6h1V3H11Z"></path>
                                                        <rect class="ql-fill" height="11" width="1" x="11" y="4"></rect>
                                                        <rect class="ql-fill" height="11" width="1" x="13" y="4"></rect>
                                                    </svg>
                                                    <svg viewBox="0 0 18 18">
                                                        <polygon class="ql-stroke ql-fill" points="15 12 13 10 15 8 15 12"></polygon>
                                                        <line class="ql-stroke ql-fill" x1="9" x2="5" y1="4" y2="4"></line>
                                                        <path class="ql-fill" d="M5,3A3,3,0,0,0,5,9H6V3H5Z"></path>
                                                        <rect class="ql-fill" height="11" width="1" x="5" y="4"></rect>
                                                        <rect class="ql-fill" height="11" width="1" x="7" y="4"></rect>
                                                    </svg>
                                                </button>
                                                <span class="ql-align ql-picker ql-icon-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-17">
                                                        <svg viewBox="0 0 18 18">
                                                            <line class="ql-stroke" x1="3" x2="15" y1="9" y2="9"></line>
                                                            <line class="ql-stroke" x1="3" x2="13" y1="14" y2="14"></line>
                                                            <line class="ql-stroke" x1="3" x2="9" y1="4" y2="4"></line>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-17">
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-selected">
                                                            <svg viewBox="0 0 18 18">
                                                                <line class="ql-stroke" x1="3" x2="15" y1="9" y2="9"></line>
                                                                <line class="ql-stroke" x1="3" x2="13" y1="14" y2="14"></line>
                                                                <line class="ql-stroke" x1="3" x2="9" y1="4" y2="4"></line>
                                                            </svg>
                                                        </span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="center">
                                                            <svg viewBox="0 0 18 18">
                                                                <line class="ql-stroke" x1="15" x2="3" y1="9" y2="9"></line>
                                                                <line class="ql-stroke" x1="14" x2="4" y1="14" y2="14"></line>
                                                                <line class="ql-stroke" x1="12" x2="6" y1="4" y2="4"></line>
                                                            </svg>
                                                        </span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="right">
                                                            <svg viewBox="0 0 18 18">
                                                                <line class="ql-stroke" x1="15" x2="3" y1="9" y2="9"></line>
                                                                <line class="ql-stroke" x1="15" x2="5" y1="14" y2="14"></line>
                                                                <line class="ql-stroke" x1="15" x2="9" y1="4" y2="4"></line>
                                                            </svg>
                                                        </span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="justify">
                                                            <svg viewBox="0 0 18 18">
                                                                <line class="ql-stroke" x1="15" x2="3" y1="9" y2="9"></line>
                                                                <line class="ql-stroke" x1="15" x2="3" y1="14" y2="14"></line>
                                                                <line class="ql-stroke" x1="15" x2="3" y1="4" y2="4"></line>
                                                            </svg>
                                                        </span>
                                                    </span>
                                                </span>
                                                <select class="ql-align" style="display: none;">
                                                    <option selected="selected"></option>
                                                    <option value="center"></option>
                                                    <option value="right"></option>
                                                    <option value="justify"></option>
                                                </select>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-link">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="7" x2="11" y1="7" y2="11"></line>
                                                        <path class="ql-even ql-stroke" d="M8.9,4.577a3.476,3.476,0,0,1,.36,4.679A3.476,3.476,0,0,1,4.577,8.9C3.185,7.5,2.035,6.4,4.217,4.217S7.5,3.185,8.9,4.577Z"></path>
                                                        <path class="ql-even ql-stroke" d="M13.423,9.1a3.476,3.476,0,0,0-4.679-.36,3.476,3.476,0,0,0,.36,4.679c1.392,1.392,2.5,2.542,4.679.36S14.815,10.5,13.423,9.1Z"></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-image">
                                                    <svg viewBox="0 0 18 18">
                                                        <rect class="ql-stroke" height="10" width="12" x="3" y="4"></rect>
                                                        <circle class="ql-fill" cx="6" cy="7" r="1"></circle>
                                                        <polyline class="ql-even ql-fill" points="5 12 5 11 7 9 8 10 11 7 13 9 13 12 5 12"></polyline>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-video">
                                                    <svg viewBox="0 0 18 18">
                                                        <rect class="ql-stroke" height="12" width="12" x="3" y="3"></rect>
                                                        <rect class="ql-fill" height="12" width="1" x="5" y="3"></rect>
                                                        <rect class="ql-fill" height="12" width="1" x="12" y="3"></rect>
                                                        <rect class="ql-fill" height="2" width="8" x="5" y="8"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="3" y="5"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="3" y="7"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="3" y="10"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="3" y="12"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="12" y="5"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="12" y="7"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="12" y="10"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="12" y="12"></rect>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-formula">
                                                    <svg viewBox="0 0 18 18">
                                                        <path
                                                            class="ql-fill"
                                                            d="M11.759,2.482a2.561,2.561,0,0,0-3.53.607A7.656,7.656,0,0,0,6.8,6.2C6.109,9.188,5.275,14.677,4.15,14.927a1.545,1.545,0,0,0-1.3-.933A0.922,0.922,0,0,0,2,15.036S1.954,16,4.119,16s3.091-2.691,3.7-5.553c0.177-.826.36-1.726,0.554-2.6L8.775,6.2c0.381-1.421.807-2.521,1.306-2.676a1.014,1.014,0,0,0,1.02.56A0.966,0.966,0,0,0,11.759,2.482Z"
                                                        ></path>
                                                        <rect class="ql-fill" height="1.6" rx="0.8" ry="0.8" width="5" x="5.15" y="6.2"></rect>
                                                        <path
                                                            class="ql-fill"
                                                            d="M13.663,12.027a1.662,1.662,0,0,1,.266-0.276q0.193,0.069.456,0.138a2.1,2.1,0,0,0,.535.069,1.075,1.075,0,0,0,.767-0.3,1.044,1.044,0,0,0,.314-0.8,0.84,0.84,0,0,0-.238-0.619,0.8,0.8,0,0,0-.594-0.239,1.154,1.154,0,0,0-.781.3,4.607,4.607,0,0,0-.781,1q-0.091.15-.218,0.346l-0.246.38c-0.068-.288-0.137-0.582-0.212-0.885-0.459-1.847-2.494-.984-2.941-0.8-0.482.2-.353,0.647-0.094,0.529a0.869,0.869,0,0,1,1.281.585c0.217,0.751.377,1.436,0.527,2.038a5.688,5.688,0,0,1-.362.467,2.69,2.69,0,0,1-.264.271q-0.221-.08-0.471-0.147a2.029,2.029,0,0,0-.522-0.066,1.079,1.079,0,0,0-.768.3A1.058,1.058,0,0,0,9,15.131a0.82,0.82,0,0,0,.832.852,1.134,1.134,0,0,0,.787-0.3,5.11,5.11,0,0,0,.776-0.993q0.141-.219.215-0.34c0.046-.076.122-0.194,0.223-0.346a2.786,2.786,0,0,0,.918,1.726,2.582,2.582,0,0,0,2.376-.185c0.317-.181.212-0.565,0-0.494A0.807,0.807,0,0,1,14.176,15a5.159,5.159,0,0,1-.913-2.446l0,0Q13.487,12.24,13.663,12.027Z"
                                                        ></path>
                                                    </svg>
                                                </button>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-clean">
                                                    <svg class="" viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="5" x2="13" y1="3" y2="3"></line>
                                                        <line class="ql-stroke" x1="6" x2="9.35" y1="12" y2="3"></line>
                                                        <line class="ql-stroke" x1="11" x2="15" y1="11" y2="15"></line>
                                                        <line class="ql-stroke" x1="15" x2="11" y1="11" y2="15"></line>
                                                        <rect class="ql-fill" height="1" rx="0.5" ry="0.5" width="7" x="2" y="14"></rect>
                                                    </svg>
                                                </button>
                                            </span>
                                    </div>
                                    <div class="nirikka_montobbo ql-container ql-snow" id="snow-editor3">
                                        <div class="ql-editor ql-blank" data-gramm="false" contenteditable="true">
                                            <p><br /></p>
                                        </div>
                                        <div class="ql-clipboard" tabindex="-1" contenteditable="true"></div>
                                        <div class="ql-tooltip ql-hidden">
                                            <a class="ql-preview" target="_blank" href="about:blank"></a><input type="text" data-formula="e=mc^2" data-link="https://quilljs.com" data-video="Embed URL" /><a class="ql-action"></a>
                                            <a class="ql-remove"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="nirikka_suparish" class="col-form-label">Nirikka Suparish:</label>

                                    <input type="hidden" name="nirikka_suparish" id="nirikka_suparish" />
                                    <div class="ql-toolbar ql-snow">
                                            <span class="ql-formats">
                                                <span class="ql-font ql-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-18">
                                                        <svg viewBox="0 0 18 18">
                                                            <polygon class="ql-stroke" points="7 11 9 13 11 11 7 11"></polygon>
                                                            <polygon class="ql-stroke" points="7 7 9 5 11 7 7 7"></polygon>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-18">
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-selected"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="serif"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="monospace"></span>
                                                    </span>
                                                </span>
                                                <select class="ql-font" style="display: none;">
                                                    <option selected="selected"></option>
                                                    <option value="serif"></option>
                                                    <option value="monospace"></option>
                                                </select>
                                                <span class="ql-size ql-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-19">
                                                        <svg viewBox="0 0 18 18">
                                                            <polygon class="ql-stroke" points="7 11 9 13 11 11 7 11"></polygon>
                                                            <polygon class="ql-stroke" points="7 7 9 5 11 7 7 7"></polygon>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-19">
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="small"></span><span tabindex="0" role="button" class="ql-picker-item ql-selected"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="large"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="huge"></span>
                                                    </span>
                                                </span>
                                                <select class="ql-size" style="display: none;">
                                                    <option value="small"></option>
                                                    <option selected="selected"></option>
                                                    <option value="large"></option>
                                                    <option value="huge"></option>
                                                </select>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-bold">
                                                    <svg viewBox="0 0 18 18">
                                                        <path class="ql-stroke" d="M5,4H9.5A2.5,2.5,0,0,1,12,6.5v0A2.5,2.5,0,0,1,9.5,9H5A0,0,0,0,1,5,9V4A0,0,0,0,1,5,4Z"></path>
                                                        <path class="ql-stroke" d="M5,9h5.5A2.5,2.5,0,0,1,13,11.5v0A2.5,2.5,0,0,1,10.5,14H5a0,0,0,0,1,0,0V9A0,0,0,0,1,5,9Z"></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-italic">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="7" x2="13" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="5" x2="11" y1="14" y2="14"></line>
                                                        <line class="ql-stroke" x1="8" x2="10" y1="14" y2="4"></line>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-underline">
                                                    <svg viewBox="0 0 18 18">
                                                        <path class="ql-stroke" d="M5,3V9a4.012,4.012,0,0,0,4,4H9a4.012,4.012,0,0,0,4-4V3"></path>
                                                        <rect class="ql-fill" height="1" rx="0.5" ry="0.5" width="12" x="3" y="15"></rect>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-strike">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke ql-thin" x1="15.5" x2="2.5" y1="8.5" y2="9.5"></line>
                                                        <path
                                                            class="ql-fill"
                                                            d="M9.007,8C6.542,7.791,6,7.519,6,6.5,6,5.792,7.283,5,9,5c1.571,0,2.765.679,2.969,1.309a1,1,0,0,0,1.9-.617C13.356,4.106,11.354,3,9,3,6.2,3,4,4.538,4,6.5a3.2,3.2,0,0,0,.5,1.843Z"
                                                        ></path>
                                                        <path
                                                            class="ql-fill"
                                                            d="M8.984,10C11.457,10.208,12,10.479,12,11.5c0,0.708-1.283,1.5-3,1.5-1.571,0-2.765-.679-2.969-1.309a1,1,0,1,0-1.9.617C4.644,13.894,6.646,15,9,15c2.8,0,5-1.538,5-3.5a3.2,3.2,0,0,0-.5-1.843Z"
                                                        ></path>
                                                    </svg>
                                                </button>
                                            </span>
                                        <span class="ql-formats">
                                                <span class="ql-color ql-picker ql-color-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-20">
                                                        <svg viewBox="0 0 18 18">
                                                            <line class="ql-color-label ql-stroke ql-transparent" x1="3" x2="15" y1="15" y2="15"></line>
                                                            <polyline class="ql-stroke" points="5.5 11 9 3 12.5 11"></polyline>
                                                            <line class="ql-stroke" x1="11.63" x2="6.38" y1="9" y2="9"></line>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-20">
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-selected ql-primary"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#e60000" style="background-color: rgb(230, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#ff9900" style="background-color: rgb(255, 153, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#ffff00" style="background-color: rgb(255, 255, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#008a00" style="background-color: rgb(0, 138, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#0066cc" style="background-color: rgb(0, 102, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#9933ff" style="background-color: rgb(153, 51, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffffff" style="background-color: rgb(255, 255, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#facccc" style="background-color: rgb(250, 204, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffebcc" style="background-color: rgb(255, 235, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffffcc" style="background-color: rgb(255, 255, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#cce8cc" style="background-color: rgb(204, 232, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#cce0f5" style="background-color: rgb(204, 224, 245);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ebd6ff" style="background-color: rgb(235, 214, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#bbbbbb" style="background-color: rgb(187, 187, 187);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#f06666" style="background-color: rgb(240, 102, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffc266" style="background-color: rgb(255, 194, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffff66" style="background-color: rgb(255, 255, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#66b966" style="background-color: rgb(102, 185, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#66a3e0" style="background-color: rgb(102, 163, 224);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#c285ff" style="background-color: rgb(194, 133, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#888888" style="background-color: rgb(136, 136, 136);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#a10000" style="background-color: rgb(161, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#b26b00" style="background-color: rgb(178, 107, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#b2b200" style="background-color: rgb(178, 178, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#006100" style="background-color: rgb(0, 97, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#0047b2" style="background-color: rgb(0, 71, 178);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#6b24b2" style="background-color: rgb(107, 36, 178);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#444444" style="background-color: rgb(68, 68, 68);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#5c0000" style="background-color: rgb(92, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#663d00" style="background-color: rgb(102, 61, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#666600" style="background-color: rgb(102, 102, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#003700" style="background-color: rgb(0, 55, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#002966" style="background-color: rgb(0, 41, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#3d1466" style="background-color: rgb(61, 20, 102);"></span>
                                                    </span>
                                                </span>
                                                <select class="ql-color" style="display: none;">
                                                    <option selected="selected"></option>
                                                    <option value="#e60000"></option>
                                                    <option value="#ff9900"></option>
                                                    <option value="#ffff00"></option>
                                                    <option value="#008a00"></option>
                                                    <option value="#0066cc"></option>
                                                    <option value="#9933ff"></option>
                                                    <option value="#ffffff"></option>
                                                    <option value="#facccc"></option>
                                                    <option value="#ffebcc"></option>
                                                    <option value="#ffffcc"></option>
                                                    <option value="#cce8cc"></option>
                                                    <option value="#cce0f5"></option>
                                                    <option value="#ebd6ff"></option>
                                                    <option value="#bbbbbb"></option>
                                                    <option value="#f06666"></option>
                                                    <option value="#ffc266"></option>
                                                    <option value="#ffff66"></option>
                                                    <option value="#66b966"></option>
                                                    <option value="#66a3e0"></option>
                                                    <option value="#c285ff"></option>
                                                    <option value="#888888"></option>
                                                    <option value="#a10000"></option>
                                                    <option value="#b26b00"></option>
                                                    <option value="#b2b200"></option>
                                                    <option value="#006100"></option>
                                                    <option value="#0047b2"></option>
                                                    <option value="#6b24b2"></option>
                                                    <option value="#444444"></option>
                                                    <option value="#5c0000"></option>
                                                    <option value="#663d00"></option>
                                                    <option value="#666600"></option>
                                                    <option value="#003700"></option>
                                                    <option value="#002966"></option>
                                                    <option value="#3d1466"></option>
                                                </select>
                                                <span class="ql-background ql-picker ql-color-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-21">
                                                        <svg viewBox="0 0 18 18">
                                                            <g class="ql-fill ql-color-label">
                                                                <polygon points="6 6.868 6 6 5 6 5 7 5.942 7 6 6.868"></polygon>
                                                                <rect height="1" width="1" x="4" y="4"></rect>
                                                                <polygon points="6.817 5 6 5 6 6 6.38 6 6.817 5"></polygon>
                                                                <rect height="1" width="1" x="2" y="6"></rect>
                                                                <rect height="1" width="1" x="3" y="5"></rect>
                                                                <rect height="1" width="1" x="4" y="7"></rect>
                                                                <polygon points="4 11.439 4 11 3 11 3 12 3.755 12 4 11.439"></polygon>
                                                                <rect height="1" width="1" x="2" y="12"></rect>
                                                                <rect height="1" width="1" x="2" y="9"></rect>
                                                                <rect height="1" width="1" x="2" y="15"></rect>
                                                                <polygon points="4.63 10 4 10 4 11 4.192 11 4.63 10"></polygon>
                                                                <rect height="1" width="1" x="3" y="8"></rect>
                                                                <path d="M10.832,4.2L11,4.582V4H10.708A1.948,1.948,0,0,1,10.832,4.2Z"></path>
                                                                <path d="M7,4.582L7.168,4.2A1.929,1.929,0,0,1,7.292,4H7V4.582Z"></path>
                                                                <path d="M8,13H7.683l-0.351.8a1.933,1.933,0,0,1-.124.2H8V13Z"></path>
                                                                <rect height="1" width="1" x="12" y="2"></rect>
                                                                <rect height="1" width="1" x="11" y="3"></rect>
                                                                <path d="M9,3H8V3.282A1.985,1.985,0,0,1,9,3Z"></path>
                                                                <rect height="1" width="1" x="2" y="3"></rect>
                                                                <rect height="1" width="1" x="6" y="2"></rect>
                                                                <rect height="1" width="1" x="3" y="2"></rect>
                                                                <rect height="1" width="1" x="5" y="3"></rect>
                                                                <rect height="1" width="1" x="9" y="2"></rect>
                                                                <rect height="1" width="1" x="15" y="14"></rect>
                                                                <polygon points="13.447 10.174 13.469 10.225 13.472 10.232 13.808 11 14 11 14 10 13.37 10 13.447 10.174"></polygon>
                                                                <rect height="1" width="1" x="13" y="7"></rect>
                                                                <rect height="1" width="1" x="15" y="5"></rect>
                                                                <rect height="1" width="1" x="14" y="6"></rect>
                                                                <rect height="1" width="1" x="15" y="8"></rect>
                                                                <rect height="1" width="1" x="14" y="9"></rect>
                                                                <path d="M3.775,14H3v1H4V14.314A1.97,1.97,0,0,1,3.775,14Z"></path>
                                                                <rect height="1" width="1" x="14" y="3"></rect>
                                                                <polygon points="12 6.868 12 6 11.62 6 12 6.868"></polygon>
                                                                <rect height="1" width="1" x="15" y="2"></rect>
                                                                <rect height="1" width="1" x="12" y="5"></rect>
                                                                <rect height="1" width="1" x="13" y="4"></rect>
                                                                <polygon points="12.933 9 13 9 13 8 12.495 8 12.933 9"></polygon>
                                                                <rect height="1" width="1" x="9" y="14"></rect>
                                                                <rect height="1" width="1" x="8" y="15"></rect>
                                                                <path d="M6,14.926V15H7V14.316A1.993,1.993,0,0,1,6,14.926Z"></path>
                                                                <rect height="1" width="1" x="5" y="15"></rect>
                                                                <path d="M10.668,13.8L10.317,13H10v1h0.792A1.947,1.947,0,0,1,10.668,13.8Z"></path>
                                                                <rect height="1" width="1" x="11" y="15"></rect>
                                                                <path d="M14.332,12.2a1.99,1.99,0,0,1,.166.8H15V12H14.245Z"></path>
                                                                <rect height="1" width="1" x="14" y="15"></rect>
                                                                <rect height="1" width="1" x="15" y="11"></rect>
                                                            </g>
                                                            <polyline class="ql-stroke" points="5.5 13 9 5 12.5 13"></polyline>
                                                            <line class="ql-stroke" x1="11.63" x2="6.38" y1="11" y2="11"></line>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-21">
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#000000" style="background-color: rgb(0, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#e60000" style="background-color: rgb(230, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#ff9900" style="background-color: rgb(255, 153, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#ffff00" style="background-color: rgb(255, 255, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#008a00" style="background-color: rgb(0, 138, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#0066cc" style="background-color: rgb(0, 102, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#9933ff" style="background-color: rgb(153, 51, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-selected"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#facccc" style="background-color: rgb(250, 204, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffebcc" style="background-color: rgb(255, 235, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffffcc" style="background-color: rgb(255, 255, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#cce8cc" style="background-color: rgb(204, 232, 204);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#cce0f5" style="background-color: rgb(204, 224, 245);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ebd6ff" style="background-color: rgb(235, 214, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#bbbbbb" style="background-color: rgb(187, 187, 187);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#f06666" style="background-color: rgb(240, 102, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffc266" style="background-color: rgb(255, 194, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#ffff66" style="background-color: rgb(255, 255, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#66b966" style="background-color: rgb(102, 185, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#66a3e0" style="background-color: rgb(102, 163, 224);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#c285ff" style="background-color: rgb(194, 133, 255);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#888888" style="background-color: rgb(136, 136, 136);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#a10000" style="background-color: rgb(161, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#b26b00" style="background-color: rgb(178, 107, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#b2b200" style="background-color: rgb(178, 178, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#006100" style="background-color: rgb(0, 97, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#0047b2" style="background-color: rgb(0, 71, 178);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#6b24b2" style="background-color: rgb(107, 36, 178);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#444444" style="background-color: rgb(68, 68, 68);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#5c0000" style="background-color: rgb(92, 0, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#663d00" style="background-color: rgb(102, 61, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#666600" style="background-color: rgb(102, 102, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#003700" style="background-color: rgb(0, 55, 0);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#002966" style="background-color: rgb(0, 41, 102);"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="#3d1466" style="background-color: rgb(61, 20, 102);"></span>
                                                    </span>
                                                </span>
                                                <select class="ql-background" style="display: none;">
                                                    <option value="#000000"></option>
                                                    <option value="#e60000"></option>
                                                    <option value="#ff9900"></option>
                                                    <option value="#ffff00"></option>
                                                    <option value="#008a00"></option>
                                                    <option value="#0066cc"></option>
                                                    <option value="#9933ff"></option>
                                                    <option selected="selected"></option>
                                                    <option value="#facccc"></option>
                                                    <option value="#ffebcc"></option>
                                                    <option value="#ffffcc"></option>
                                                    <option value="#cce8cc"></option>
                                                    <option value="#cce0f5"></option>
                                                    <option value="#ebd6ff"></option>
                                                    <option value="#bbbbbb"></option>
                                                    <option value="#f06666"></option>
                                                    <option value="#ffc266"></option>
                                                    <option value="#ffff66"></option>
                                                    <option value="#66b966"></option>
                                                    <option value="#66a3e0"></option>
                                                    <option value="#c285ff"></option>
                                                    <option value="#888888"></option>
                                                    <option value="#a10000"></option>
                                                    <option value="#b26b00"></option>
                                                    <option value="#b2b200"></option>
                                                    <option value="#006100"></option>
                                                    <option value="#0047b2"></option>
                                                    <option value="#6b24b2"></option>
                                                    <option value="#444444"></option>
                                                    <option value="#5c0000"></option>
                                                    <option value="#663d00"></option>
                                                    <option value="#666600"></option>
                                                    <option value="#003700"></option>
                                                    <option value="#002966"></option>
                                                    <option value="#3d1466"></option>
                                                </select>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-script" value="super">
                                                    <svg viewBox="0 0 18 18">
                                                        <path
                                                            class="ql-fill"
                                                            d="M15.5,7H13.861a4.015,4.015,0,0,0,1.914-2.975,1.8,1.8,0,0,0-1.6-1.751A1.922,1.922,0,0,0,12.021,3.7a0.5,0.5,0,1,0,.957.291,0.917,0.917,0,0,1,1.053-.725,0.81,0.81,0,0,1,.744.762c0,1.077-1.164,1.925-1.934,2.486A1.423,1.423,0,0,0,12,7.5a0.5,0.5,0,0,0,.5.5h3A0.5,0.5,0,0,0,15.5,7Z"
                                                        ></path>
                                                        <path
                                                            class="ql-fill"
                                                            d="M9.651,5.241a1,1,0,0,0-1.41.108L6,7.964,3.759,5.349a1,1,0,1,0-1.519,1.3L4.683,9.5,2.241,12.35a1,1,0,1,0,1.519,1.3L6,11.036,8.241,13.65a1,1,0,0,0,1.519-1.3L7.317,9.5,9.759,6.651A1,1,0,0,0,9.651,5.241Z"
                                                        ></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-script" value="sub">
                                                    <svg viewBox="0 0 18 18">
                                                        <path
                                                            class="ql-fill"
                                                            d="M15.5,15H13.861a3.858,3.858,0,0,0,1.914-2.975,1.8,1.8,0,0,0-1.6-1.751A1.921,1.921,0,0,0,12.021,11.7a0.50013,0.50013,0,1,0,.957.291h0a0.914,0.914,0,0,1,1.053-.725,0.81,0.81,0,0,1,.744.762c0,1.076-1.16971,1.86982-1.93971,2.43082A1.45639,1.45639,0,0,0,12,15.5a0.5,0.5,0,0,0,.5.5h3A0.5,0.5,0,0,0,15.5,15Z"
                                                        ></path>
                                                        <path
                                                            class="ql-fill"
                                                            d="M9.65,5.241a1,1,0,0,0-1.409.108L6,7.964,3.759,5.349A1,1,0,0,0,2.192,6.59178Q2.21541,6.6213,2.241,6.649L4.684,9.5,2.241,12.35A1,1,0,0,0,3.71,13.70722q0.02557-.02768.049-0.05722L6,11.036,8.241,13.65a1,1,0,1,0,1.567-1.24277Q9.78459,12.3777,9.759,12.35L7.316,9.5,9.759,6.651A1,1,0,0,0,9.65,5.241Z"
                                                        ></path>
                                                    </svg>
                                                </button>
                                            </span>
                                        <span class="ql-formats">
                                                <span class="ql-header ql-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-22">
                                                        <svg viewBox="0 0 18 18">
                                                            <polygon class="ql-stroke" points="7 11 9 13 11 11 7 11"></polygon>
                                                            <polygon class="ql-stroke" points="7 7 9 5 11 7 7 7"></polygon>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-22">
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-selected"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="1"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="2"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="3"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="4"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="5"></span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="6"></span>
                                                    </span>
                                                </span>
                                                <select class="ql-header" style="display: none;">
                                                    <option selected="selected"></option>
                                                    <option value="1"></option>
                                                    <option value="2"></option>
                                                    <option value="3"></option>
                                                    <option value="4"></option>
                                                    <option value="5"></option>
                                                    <option value="6"></option>
                                                </select>
                                                <button type="button" class="ql-blockquote">
                                                    <svg viewBox="0 0 18 18">
                                                        <rect class="ql-fill ql-stroke" height="3" width="3" x="4" y="5"></rect>
                                                        <rect class="ql-fill ql-stroke" height="3" width="3" x="11" y="5"></rect>
                                                        <path class="ql-even ql-fill ql-stroke" d="M7,8c0,4.031-3,5-3,5"></path>
                                                        <path class="ql-even ql-fill ql-stroke" d="M14,8c0,4.031-3,5-3,5"></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-code-block">
                                                    <svg viewBox="0 0 18 18">
                                                        <polyline class="ql-even ql-stroke" points="5 7 3 9 5 11"></polyline>
                                                        <polyline class="ql-even ql-stroke" points="13 7 15 9 13 11"></polyline>
                                                        <line class="ql-stroke" x1="10" x2="8" y1="5" y2="13"></line>
                                                    </svg>
                                                </button>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-list" value="ordered">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="7" x2="15" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="7" x2="15" y1="9" y2="9"></line>
                                                        <line class="ql-stroke" x1="7" x2="15" y1="14" y2="14"></line>
                                                        <line class="ql-stroke ql-thin" x1="2.5" x2="4.5" y1="5.5" y2="5.5"></line>
                                                        <path class="ql-fill" d="M3.5,6A0.5,0.5,0,0,1,3,5.5V3.085l-0.276.138A0.5,0.5,0,0,1,2.053,3c-0.124-.247-0.023-0.324.224-0.447l1-.5A0.5,0.5,0,0,1,4,2.5v3A0.5,0.5,0,0,1,3.5,6Z"></path>
                                                        <path class="ql-stroke ql-thin" d="M4.5,10.5h-2c0-.234,1.85-1.076,1.85-2.234A0.959,0.959,0,0,0,2.5,8.156"></path>
                                                        <path class="ql-stroke ql-thin" d="M2.5,14.846a0.959,0.959,0,0,0,1.85-.109A0.7,0.7,0,0,0,3.75,14a0.688,0.688,0,0,0,.6-0.736,0.959,0.959,0,0,0-1.85-.109"></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-list" value="bullet">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="6" x2="15" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="6" x2="15" y1="9" y2="9"></line>
                                                        <line class="ql-stroke" x1="6" x2="15" y1="14" y2="14"></line>
                                                        <line class="ql-stroke" x1="3" x2="3" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="3" x2="3" y1="9" y2="9"></line>
                                                        <line class="ql-stroke" x1="3" x2="3" y1="14" y2="14"></line>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-indent" value="-1">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="3" x2="15" y1="14" y2="14"></line>
                                                        <line class="ql-stroke" x1="3" x2="15" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="9" x2="15" y1="9" y2="9"></line>
                                                        <polyline class="ql-stroke" points="5 7 5 11 3 9 5 7"></polyline>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-indent" value="+1">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="3" x2="15" y1="14" y2="14"></line>
                                                        <line class="ql-stroke" x1="3" x2="15" y1="4" y2="4"></line>
                                                        <line class="ql-stroke" x1="9" x2="15" y1="9" y2="9"></line>
                                                        <polyline class="ql-fill ql-stroke" points="3 7 3 11 5 9 3 7"></polyline>
                                                    </svg>
                                                </button>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-direction">
                                                    <svg viewBox="0 0 18 18">
                                                        <polygon class="ql-stroke ql-fill" points="3 11 5 9 3 7 3 11"></polygon>
                                                        <line class="ql-stroke ql-fill" x1="15" x2="11" y1="4" y2="4"></line>
                                                        <path class="ql-fill" d="M11,3a3,3,0,0,0,0,6h1V3H11Z"></path>
                                                        <rect class="ql-fill" height="11" width="1" x="11" y="4"></rect>
                                                        <rect class="ql-fill" height="11" width="1" x="13" y="4"></rect>
                                                    </svg>
                                                    <svg viewBox="0 0 18 18">
                                                        <polygon class="ql-stroke ql-fill" points="15 12 13 10 15 8 15 12"></polygon>
                                                        <line class="ql-stroke ql-fill" x1="9" x2="5" y1="4" y2="4"></line>
                                                        <path class="ql-fill" d="M5,3A3,3,0,0,0,5,9H6V3H5Z"></path>
                                                        <rect class="ql-fill" height="11" width="1" x="5" y="4"></rect>
                                                        <rect class="ql-fill" height="11" width="1" x="7" y="4"></rect>
                                                    </svg>
                                                </button>
                                                <span class="ql-align ql-picker ql-icon-picker">
                                                    <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-23">
                                                        <svg viewBox="0 0 18 18">
                                                            <line class="ql-stroke" x1="3" x2="15" y1="9" y2="9"></line>
                                                            <line class="ql-stroke" x1="3" x2="13" y1="14" y2="14"></line>
                                                            <line class="ql-stroke" x1="3" x2="9" y1="4" y2="4"></line>
                                                        </svg>
                                                    </span>
                                                    <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-23">
                                                        <span tabindex="0" role="button" class="ql-picker-item ql-selected">
                                                            <svg viewBox="0 0 18 18">
                                                                <line class="ql-stroke" x1="3" x2="15" y1="9" y2="9"></line>
                                                                <line class="ql-stroke" x1="3" x2="13" y1="14" y2="14"></line>
                                                                <line class="ql-stroke" x1="3" x2="9" y1="4" y2="4"></line>
                                                            </svg>
                                                        </span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="center">
                                                            <svg viewBox="0 0 18 18">
                                                                <line class="ql-stroke" x1="15" x2="3" y1="9" y2="9"></line>
                                                                <line class="ql-stroke" x1="14" x2="4" y1="14" y2="14"></line>
                                                                <line class="ql-stroke" x1="12" x2="6" y1="4" y2="4"></line>
                                                            </svg>
                                                        </span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="right">
                                                            <svg viewBox="0 0 18 18">
                                                                <line class="ql-stroke" x1="15" x2="3" y1="9" y2="9"></line>
                                                                <line class="ql-stroke" x1="15" x2="5" y1="14" y2="14"></line>
                                                                <line class="ql-stroke" x1="15" x2="9" y1="4" y2="4"></line>
                                                            </svg>
                                                        </span>
                                                        <span tabindex="0" role="button" class="ql-picker-item" data-value="justify">
                                                            <svg viewBox="0 0 18 18">
                                                                <line class="ql-stroke" x1="15" x2="3" y1="9" y2="9"></line>
                                                                <line class="ql-stroke" x1="15" x2="3" y1="14" y2="14"></line>
                                                                <line class="ql-stroke" x1="15" x2="3" y1="4" y2="4"></line>
                                                            </svg>
                                                        </span>
                                                    </span>
                                                </span>
                                                <select class="ql-align" style="display: none;">
                                                    <option selected="selected"></option>
                                                    <option value="center"></option>
                                                    <option value="right"></option>
                                                    <option value="justify"></option>
                                                </select>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-link">
                                                    <svg viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="7" x2="11" y1="7" y2="11"></line>
                                                        <path class="ql-even ql-stroke" d="M8.9,4.577a3.476,3.476,0,0,1,.36,4.679A3.476,3.476,0,0,1,4.577,8.9C3.185,7.5,2.035,6.4,4.217,4.217S7.5,3.185,8.9,4.577Z"></path>
                                                        <path class="ql-even ql-stroke" d="M13.423,9.1a3.476,3.476,0,0,0-4.679-.36,3.476,3.476,0,0,0,.36,4.679c1.392,1.392,2.5,2.542,4.679.36S14.815,10.5,13.423,9.1Z"></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-image">
                                                    <svg viewBox="0 0 18 18">
                                                        <rect class="ql-stroke" height="10" width="12" x="3" y="4"></rect>
                                                        <circle class="ql-fill" cx="6" cy="7" r="1"></circle>
                                                        <polyline class="ql-even ql-fill" points="5 12 5 11 7 9 8 10 11 7 13 9 13 12 5 12"></polyline>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-video">
                                                    <svg viewBox="0 0 18 18">
                                                        <rect class="ql-stroke" height="12" width="12" x="3" y="3"></rect>
                                                        <rect class="ql-fill" height="12" width="1" x="5" y="3"></rect>
                                                        <rect class="ql-fill" height="12" width="1" x="12" y="3"></rect>
                                                        <rect class="ql-fill" height="2" width="8" x="5" y="8"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="3" y="5"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="3" y="7"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="3" y="10"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="3" y="12"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="12" y="5"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="12" y="7"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="12" y="10"></rect>
                                                        <rect class="ql-fill" height="1" width="3" x="12" y="12"></rect>
                                                    </svg>
                                                </button>
                                                <button type="button" class="ql-formula">
                                                    <svg viewBox="0 0 18 18">
                                                        <path
                                                            class="ql-fill"
                                                            d="M11.759,2.482a2.561,2.561,0,0,0-3.53.607A7.656,7.656,0,0,0,6.8,6.2C6.109,9.188,5.275,14.677,4.15,14.927a1.545,1.545,0,0,0-1.3-.933A0.922,0.922,0,0,0,2,15.036S1.954,16,4.119,16s3.091-2.691,3.7-5.553c0.177-.826.36-1.726,0.554-2.6L8.775,6.2c0.381-1.421.807-2.521,1.306-2.676a1.014,1.014,0,0,0,1.02.56A0.966,0.966,0,0,0,11.759,2.482Z"
                                                        ></path>
                                                        <rect class="ql-fill" height="1.6" rx="0.8" ry="0.8" width="5" x="5.15" y="6.2"></rect>
                                                        <path
                                                            class="ql-fill"
                                                            d="M13.663,12.027a1.662,1.662,0,0,1,.266-0.276q0.193,0.069.456,0.138a2.1,2.1,0,0,0,.535.069,1.075,1.075,0,0,0,.767-0.3,1.044,1.044,0,0,0,.314-0.8,0.84,0.84,0,0,0-.238-0.619,0.8,0.8,0,0,0-.594-0.239,1.154,1.154,0,0,0-.781.3,4.607,4.607,0,0,0-.781,1q-0.091.15-.218,0.346l-0.246.38c-0.068-.288-0.137-0.582-0.212-0.885-0.459-1.847-2.494-.984-2.941-0.8-0.482.2-.353,0.647-0.094,0.529a0.869,0.869,0,0,1,1.281.585c0.217,0.751.377,1.436,0.527,2.038a5.688,5.688,0,0,1-.362.467,2.69,2.69,0,0,1-.264.271q-0.221-.08-0.471-0.147a2.029,2.029,0,0,0-.522-0.066,1.079,1.079,0,0,0-.768.3A1.058,1.058,0,0,0,9,15.131a0.82,0.82,0,0,0,.832.852,1.134,1.134,0,0,0,.787-0.3,5.11,5.11,0,0,0,.776-0.993q0.141-.219.215-0.34c0.046-.076.122-0.194,0.223-0.346a2.786,2.786,0,0,0,.918,1.726,2.582,2.582,0,0,0,2.376-.185c0.317-.181.212-0.565,0-0.494A0.807,0.807,0,0,1,14.176,15a5.159,5.159,0,0,1-.913-2.446l0,0Q13.487,12.24,13.663,12.027Z"
                                                        ></path>
                                                    </svg>
                                                </button>
                                            </span>
                                        <span class="ql-formats">
                                                <button type="button" class="ql-clean">
                                                    <svg class="" viewBox="0 0 18 18">
                                                        <line class="ql-stroke" x1="5" x2="13" y1="3" y2="3"></line>
                                                        <line class="ql-stroke" x1="6" x2="9.35" y1="12" y2="3"></line>
                                                        <line class="ql-stroke" x1="11" x2="15" y1="11" y2="15"></line>
                                                        <line class="ql-stroke" x1="15" x2="11" y1="11" y2="15"></line>
                                                        <rect class="ql-fill" height="1" rx="0.5" ry="0.5" width="7" x="2" y="14"></rect>
                                                    </svg>
                                                </button>
                                            </span>
                                    </div>
                                    <div class="nirikka_suparish ql-container ql-snow" id="snow-editor4">
                                        <div class="ql-editor ql-blank" data-gramm="false" contenteditable="true">
                                            <p><br /></p>
                                        </div>
                                        <div class="ql-clipboard" tabindex="-1" contenteditable="true"></div>
                                        <div class="ql-tooltip ql-hidden">
                                            <a class="ql-preview" target="_blank" href="about:blank"></a><input type="text" data-formula="e=mc^2" data-link="https://quilljs.com" data-video="Embed URL" /><a class="ql-action"></a>
                                            <a class="ql-remove"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    আপলোড করুন
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var Apotti_Uploaded_Container = {
        loadCreateApottiUploadForm: function () {
            let url = '{{route('audit.execution.apotti.apotti-uplaod')}}';
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
