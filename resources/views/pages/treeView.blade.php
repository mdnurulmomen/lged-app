@extends('sideMenuLayout')
@section('content')
<div class="row m-0 page-title-wrapper d-md-flex align-items-md-center">
    <div class="col-md-6">
        <div class="title py-2">
            <h4 class="mb-0 font-weight-bold"><i class="fas fa-list mr-3"></i>ট্রি ভিউ</h4>
        </div>
    </div>
</div>
<div class="px-3">
    <div class="row">
        <div class="col-md-4">
            <div class="sticky bg-white pt-5 z-index-1">
                <div class="form-group custom-form-group mr-3 mb-0" id="ownOfficeFilter__designation">
                    <div class="input text"><input type="text" name="designation_structure_tree_search" id="owndesignation_structure_tree_search" class="form-control rounded-0" placeholder="প্রাপক খুঁজুন"></div>    </div>
                <div class="card-body px-2 py-3">
                    <p class="own_designation_panel_search_result text-primary" style="display: none;">আপনি মোট<span> (0) </span>জন খুজে পেয়েছেন </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="rounded-0 office_organogram_tree jstree jstree-1 jstree-default" id="own_office_organogram_tree" role="tree" aria-multiselectable="true" tabindex="0" aria-activedescendant="ofc_org_designation_21940" aria-busy="false">
                <ul class="jstree-container-ul jstree-children" role="group">
                    <li role="treeitem" aria-selected="false" aria-level="1" aria-labelledby="ofc_org_unit_6707_anchor" aria-expanded="true" id="ofc_org_unit_6707" class="jstree-node  ofc_org_unit jstree-open">
                        <i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor " href="#" tabindex="-1" id="ofc_org_unit_6707_anchor" aria-disabled="true"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon" role="presentation"></i>
                        কমিউনিকেশন ও পার্টনারশীপ, শাখা কোডঃ 0 (১১)
                    </li>
                    <li role="treeitem" aria-selected="false" aria-level="1" aria-labelledby="ofc_org_unit_6691_anchor" aria-expanded="true" id="ofc_org_unit_6691" class="jstree-node  ofc_org_unit jstree-open">
                        <i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor " href="#" tabindex="-1" id="ofc_org_unit_6691_anchor" aria-disabled="true"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon" role="presentation"></i>
                        প্রকল্প পরিচালকের দপ্তর, শাখা কোডঃ 0 (৪)                                    </a>
                        <ul role="group" class="jstree-children">
                            <li role="treeitem" name="demo_1" aria-selected="false" aria-level="2" aria-labelledby="ofc_org_designation_16345_anchor" id="ofc_org_designation_16345" class="jstree-node ofc_org_designation jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor  " href="#" tabindex="-1" id="ofc_org_designation_16345_anchor" aria-disabled="true"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon" role="presentation"></i><span class="mr-2">
                            ড. মোঃ আব্দুল মান্নান                                </span><small data-toggle="popover" data-content="প্রকল্প পরিচালক, প্রকল্প পরিচালকের দপ্তর">প্রকল্প পরিচালক</small></a>
                            </li>
                            <li role="treeitem"  name="demo_1" aria-selected="false" aria-level="2" aria-labelledby="ofc_org_designation_216681_anchor" id="ofc_org_designation_216681" class="jstree-node ofc_org_designation jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor  " href="#" tabindex="-1" id="ofc_org_designation_216681_anchor" aria-disabled="true"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon" role="presentation"></i><span class="mr-2">
                            মু. ইকরামুল ইসলাম                                </span><small data-toggle="popover" data-content="জুনিয়র কনসালটেন্ট-টেকনিক্যাল, প্রকল্প পরিচালকের দপ্তর">জুনিয়র কনসালটেন্ট-টেকনিক্যাল</small></a>
                            </li>
                            <li role="treeitem" name="demo_1" data-jstree="{&quot;disabled&quot; : true }" aria-selected="false" aria-level="2" aria-labelledby="ofc_org_designation_307920_anchor" aria-disabled="true" id="ofc_org_designation_307920" class="jstree-node ofc_org_designation jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor " href="#" tabindex="-1" id="ofc_org_designation_307920_anchor"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon" role="presentation"></i><span class="mr-2">
                            শূন্যপদ                                </span><small data-toggle="popover" data-content="পলিসি এক্সপা  , প্রকল্প পরিচালকের দপ্তর">পলিসি এক্সপা  </small></a>
                            </li>
                            <li role="treeitem" name="demo_1" aria-selected="false" aria-level="2" aria-labelledby="ofc_org_designation_396626_anchor" id="ofc_org_designation_396626" class="jstree-node ofc_org_designation jstree-leaf jstree-last"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor  " href="#" tabindex="-1" id="ofc_org_designation_396626_anchor" aria-disabled="true"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon" role="presentation"></i><span class="mr-2">
                            এ টি এম আল ফাত্তাহ                                 </span><small data-toggle="popover" data-content="ইনোভেশন এক্সপার্ট, প্রকল্প পরিচালকের দপ্তর">ইনোভেশন এক্সপার্ট</small></a>
                            </li>
                        </ul>
                    </li>
                    <li role="treeitem" aria-selected="false" aria-level="1" aria-labelledby="ofc_org_unit_6699_anchor" aria-expanded="true" id="ofc_org_unit_6699" class="jstree-node  ofc_org_unit jstree-open">
                        <i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor " href="#" tabindex="-1" id="ofc_org_unit_6699_anchor" aria-disabled="true"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon" role="presentation"></i>
                        ক্যাপাসিটি ডেভেলপমেন্ট, শাখা কোডঃ 0 (৭)                                    </a>
                        <ul role="group" class="jstree-children">
                            <li role="treeitem" name="demo_1" aria-selected="false" aria-level="2" aria-labelledby="ofc_org_designation_220379_anchor" id="ofc_org_designation_220379" class="jstree-node ofc_org_designation jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor  " href="#" tabindex="-1" id="ofc_org_designation_220379_anchor" aria-disabled="true"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon" role="presentation"></i><span class="mr-2">
                            আনীর চৌধুরী                                </span><small data-toggle="popover" data-content="পলিসি অ্যাডভাইজর, ক্যাপাসিটি ডেভেলপমেন্ট">পলিসি অ্যাডভাইজর</small></a>
                            </li>
                            <li role="treeitem" name="demo_1" data-jstree="{&quot;disabled&quot; : true }" aria-selected="false" aria-level="2" aria-labelledby="ofc_org_designation_16349_anchor" aria-disabled="true" id="ofc_org_designation_16349" class="jstree-node ofc_org_designation jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor  " href="#" tabindex="-1" id="ofc_org_designation_16349_anchor"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon" role="presentation"></i><span class="mr-2">
                            শূন্যপদ                                </span><small data-toggle="popover" data-content="ক্যাপাসিটি ডেভেলপমেন্ট স্পেশালিস্ট, ক্যাপাসিটি ডেভেলপমেন্ট">ক্যাপাসিটি ডেভেলপমেন্ট স্পেশালিস্ট</small></a>
                            </li>
                            <li role="treeitem" name="demo_1" aria-selected="false" aria-level="2" aria-labelledby="ofc_org_designation_22420_anchor" id="ofc_org_designation_22420" class="jstree-node ofc_org_designation jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" id="ofc_org_designation_22420_anchor"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon" role="presentation"></i><span class="mr-2">
                            মোঃ মামুনুর রশিদ ভুইঞা                                </span><small data-toggle="popover" data-content="ক্যাপাসিটি ডেভেলপমেন্ট স্পেশালিস্ট, ক্যাপাসিটি ডেভেলপমেন্ট">ক্যাপাসিটি ডেভেলপমেন্ট স্পেশালিস্ট</small></a>
                            </li>
                            <li role="treeitem" name="demo_1" aria-selected="false" aria-level="2" aria-labelledby="ofc_org_designation_21926_anchor" id="ofc_org_designation_21926" class="jstree-node ofc_org_designation jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" id="ofc_org_designation_21926_anchor"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon" role="presentation"></i><span class="mr-2">
                            মোঃ মিজানুর রহমান                                </span><small data-toggle="popover" data-content="ডোমেন স্পেশালিস্ট (ইনোভেশ ট্রেনিং), ক্যাপাসিটি ডেভেলপমেন্ট">ডোমেন স্পেশালিস্ট (ইনোভেশ ট্রেনিং)</small></a>
                            </li>
                            <li role="treeitem" name="demo_1" aria-selected="false" aria-level="2" aria-labelledby="ofc_org_designation_22421_anchor" id="ofc_org_designation_22421" class="jstree-node ofc_org_designation jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" id="ofc_org_designation_22421_anchor"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon" role="presentation"></i><span class="mr-2">
                            অশোক কুমার বিশ্বাস                                </span><small data-toggle="popover" data-content="ক্যাাপাসিটি ডেভেলপমেন্ট এ্যাসিসটেন্ট, ক্যাপাসিটি ডেভেলপমেন্ট">ক্যাাপাসিটি ডেভেলপমেন্ট এ্যাসিসটেন্ট</small></a>
                            </li>
                            <li role="treeitem" name="demo_1" aria-selected="false" aria-level="2" aria-labelledby="ofc_org_designation_21928_anchor" id="ofc_org_designation_21928" class="jstree-node ofc_org_designation jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor  " href="#" tabindex="-1" id="ofc_org_designation_21928_anchor" aria-disabled="true"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon" role="presentation"></i><span class="mr-2">
                            মোঃ মাহবুবুর রহমান                                </span><small data-toggle="popover" data-content="ক্যাপাসিটি বিল্ডিং এসোসিয়েট, ক্যাপাসিটি ডেভেলপমেন্ট">ক্যাপাসিটি বিল্ডিং এসোসিয়েট</small></a>
                            </li>
                            <li role="treeitem" name="demo_1" aria-selected="false" aria-level="2" aria-labelledby="ofc_org_designation_21929_anchor" id="ofc_org_designation_21929" class="jstree-node ofc_org_designation jstree-leaf jstree-last"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor  " href="#" tabindex="-1" id="ofc_org_designation_21929_anchor" aria-disabled="true"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon" role="presentation"></i><span class="mr-2">
                            মোঃ শোহেদুল ইসলাম                                </span><small data-toggle="popover" data-content="ক্যাাপাসিটি ডেভেলপমেন্ট এ্যাসিসটেন্ট, ক্যাপাসিটি ডেভেলপমেন্ট">ক্যাাপাসিটি ডেভেলপমেন্ট এ্যাসিসটেন্ট</small></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection