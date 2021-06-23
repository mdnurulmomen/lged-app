@extends('fullWidthLayout')
@section('content')
<div class="d-flex flex-row">
    <!--begin::Aside-->
    @include('pages.profile.profileMenu')
    <!--end::Aside-->
    <!--begin::Content-->
    <div class="flex-row-fluid">
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="row m-0 page-title-wrapper d-md-flex align-items-md-center">
                <div class="col-md-6">
                    <div class="title py-2">
                        <h4 class="mb-0 font-weight-bold solaimanLipi"><i class="fas fa-list mr-3"></i>{{ __('নিটন মোহাম্মদ কামরুজ্জামান (২০০০০০০০২৭৩৯) কর্ম ইতিহাস')}}</h4>
                    </div>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form">
                <!--begin::Body-->
                <div class="card-body p-3 mt-5" id="kt_profile_scroll">
                    <div class="col-md-8 px-0">
                        <div class="timeline timeline-3 custom-timeline">
                            <div class="timeline-items mb-5" id="permitted_designations">
                                <div class="timeline-item  " id="right_3">
                                    <div class="timeline-media">
                                       <i class="fas fa-chair text-primary"></i>
                                    </div>
                                    <div class="timeline-content rounded-0 p-0" data-layer_index="3" id="permitted_level_3">
                                       <div class="p-3 pb-0 d-flex align-items-center justify-content-start">
                                          <h4 class="layer_text text-dark-75 text-hover-primary font-weight-bold mb-0 solaimanLipi mr-3">{{__('সময়কাল: ০১/০১/২০১৩  - বর্তমান ')}}</h4>
                                          <button type="button" class="btn btn-square btn-xs badge alert-warning transaction_day_layer" data-container="#kt_modal_6 > div.modal-dialog > div" title="" data-toggle="popover" data-placement="top" data-html="true" data-content="<input type='text' name='nothi_authority_users_tree_search' id='nothi_authority_users_tree_search' class='form-control'><br/><a href='javascript:;' class='btn btn-primary btn-sm font-weight-bold btn-square' data-placeholder='transaction_day_right_3' onclick='PERMISSION.setTransactionDay(this)'>সেট করুন</a>" data-original-title="কার্যদিবস ঠিক করুন">
                                            <i class="far fa-time"></i>
                                            <span id="transaction_day_right_3">
                                            </span>{{ __('৮ বছর ৪ মাস') }}</button>
                                        </div>
                                       <div class="option_selected_data px-2">
                                          <ul class="listed_items rounded-0 list-group">
                                             <li class="list-group-item overflow-hidden p-3 mb-3 border-left-0 border-right-0">
                                                <div data-layer="3" class="p-0 mb-0 permitted_designation">
                                                   <span class="ml-2 mr-2 font-size-h6">{{__('পদবি : ')}}</span>
                                                   <span class="font-size-h6">{{ __('চীফ টেকনোলজি এ‍্যাডভাইজর')}}</span>
                                                </div>
                                                <div data-layer="3" class="p-0 mb-0 permitted_designation">
                                                    <span class="ml-2 mr-2 font-size-h6">{{__('শাখা : ')}}</span>
                                                    <span class="font-size-h6">{{ __('ম‍্যানেজমেন্ট')}}</span>
                                                 </div>
                                                 <div data-layer="3" class="p-0 mb-0 permitted_designation">
                                                    <span class="ml-2 mr-2 font-size-h6">{{__('অফিস : ')}}</span>
                                                    <span class="font-size-h6">{{ __('ট‍্যাপওয়‍্যার সলিউশনস লিমিটেড')}}</span>
                                                 </div>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                            </div>
                            <div class="timeline-items mb-5" id="permitted_designations">
                                <div class="timeline-item  " id="right_3">
                                    <div class="timeline-media">
                                       <i class="fas fa-chair text-primary"></i>
                                    </div>
                                    <div class="timeline-content rounded-0 p-0" data-layer_index="3" id="permitted_level_3">
                                       <div class="p-3 pb-0 d-flex align-items-center justify-content-start">
                                          <h4 class="layer_text text-dark-75 text-hover-primary font-weight-bold mb-0 solaimanLipi mr-3">{{__('সময়কাল: ০১/০৩/২০১০ - ৩১/১২/২০১২')}}</h4>
                                          <button type="button" class="btn btn-square btn-xs badge alert-warning transaction_day_layer" data-container="#kt_modal_6 > div.modal-dialog > div" title="" data-toggle="popover" data-placement="top" data-html="true" data-content="<input type='text' name='nothi_authority_users_tree_search' id='nothi_authority_users_tree_search' class='form-control'><br/><a href='javascript:;' class='btn btn-primary btn-sm font-weight-bold btn-square' data-placeholder='transaction_day_right_3' onclick='PERMISSION.setTransactionDay(this)'>সেট করুন</a>" data-original-title="কার্যদিবস ঠিক করুন">
                                            <i class="far fa-time"></i>
                                            <span id="transaction_day_right_3">
                                            </span>{{ __('২ বছর ৯ মাস') }}</button>
                                        </div>
                                       <div class="option_selected_data px-2">
                                          <ul class="listed_items rounded-0 list-group">
                                             <li class="list-group-item overflow-hidden p-3 mb-3 border-left-0 border-right-0">
                                                <div data-layer="3" class="p-0 mb-0 permitted_designation">
                                                   <span class="ml-2 mr-2 font-size-h6">{{__('পদবি : ')}}</span>
                                                   <span class="font-size-h6">{{ __('প্রধান নির্বাহী কর্মকর্তা')}}</span>
                                                </div>
                                                <div data-layer="3" class="p-0 mb-0 permitted_designation">
                                                    <span class="ml-2 mr-2 font-size-h6">{{__('শাখা : ')}}</span>
                                                    <span class="font-size-h6">{{ __('ম‍্যানেজমেন্ট')}}</span>
                                                 </div>
                                                 <div data-layer="3" class="p-0 mb-0 permitted_designation">
                                                    <span class="ml-2 mr-2 font-size-h6">{{__('অফিস : ')}}</span>
                                                    <span class="font-size-h6">{{ __('ডকুমেন্টা লিমিটেড')}}</span>
                                                 </div>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                            </div>
                            <div class="timeline-items mb-5" id="permitted_designations">
                                <div class="timeline-item  " id="right_3">
                                    <div class="timeline-media">
                                       <i class="fas fa-chair text-primary"></i>
                                    </div>
                                    <div class="timeline-content rounded-0 p-0" data-layer_index="3" id="permitted_level_3">
                                       <div class="p-3 pb-0 d-flex align-items-center justify-content-start">
                                          <h4 class="layer_text text-dark-75 text-hover-primary font-weight-bold mb-0 solaimanLipi mr-3">{{__('সময়কাল: ০১/০৯/২০০৪ - ২৮/০২/২০১০')}}</h4>
                                          <button type="button" class="btn btn-square btn-xs badge alert-warning transaction_day_layer" data-container="#kt_modal_6 > div.modal-dialog > div" title="" data-toggle="popover" data-placement="top" data-html="true" data-content="<input type='text' name='nothi_authority_users_tree_search' id='nothi_authority_users_tree_search' class='form-control'><br/><a href='javascript:;' class='btn btn-primary btn-sm font-weight-bold btn-square' data-placeholder='transaction_day_right_3' onclick='PERMISSION.setTransactionDay(this)'>সেট করুন</a>" data-original-title="কার্যদিবস ঠিক করুন">
                                            <i class="far fa-time"></i>
                                            <span id="transaction_day_right_3">
                                            </span>{{ __('৫ বছর ৫ মাস') }}</button>
                                        </div>
                                       <div class="option_selected_data px-2">
                                          <ul class="listed_items rounded-0 list-group">
                                             <li class="list-group-item overflow-hidden p-3 mb-3 border-left-0 border-right-0">
                                                <div data-layer="3" class="p-0 mb-0 permitted_designation">
                                                   <span class="ml-2 mr-2 font-size-h6">{{__('পদবি : ')}}</span>
                                                   <span class="font-size-h6">{{ __('প্রধান নির্বাহী কর্মকর্তা')}}</span>
                                                </div>
                                                <div data-layer="3" class="p-0 mb-0 permitted_designation">
                                                    <span class="ml-2 mr-2 font-size-h6">{{__('শাখা : ')}}</span>
                                                    <span class="font-size-h6">{{ __('অফশোর ডেভেলাপমেন্ট সেন্টার')}}</span>
                                                 </div>
                                                 <div data-layer="3" class="p-0 mb-0 permitted_designation">
                                                    <span class="ml-2 mr-2 font-size-h6">{{__('অফিস : ')}}</span>
                                                    <span class="font-size-h6">{{ __('ভিজ‍ুয়‍্যাল ম‍্যাজিক কর্পোরেশন লিমিটেড')}}</span>
                                                 </div>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Body-->
            </form>
            <!--end::Form-->
        </div>
    </div>
    <!--end::Content-->
</div>
@endsection