<!-- Office Modal -->
<div class="modal fade custom-modal" id="officeOrderGenerateCCModal" tabindex="-1" role="dialog"
     aria-labelledby="officeOrderGenerateCCModal"
     aria-hidden="true"
     data-backdrop="static"
>
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="officeOrderGenerateCCModal">অফিস আদেশ অনুলিপি</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <ul class="nav nav-tabs custom-tab-header mb-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active rounded-0" data-toggle="tab" href="#set_own_office">
                                    <span class="nav-text"><i
                                            class="fad fa-briefcase mr-2 text-primary"></i>নিজ অফিস</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#set_other_office" aria-controls="profile">
                                    <span class="nav-text"> <i class="fad fa-building mr-2 text-primary"></i>অন্যান্য অফিস</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content" id="plan_office_tab">
                            <div class="tab-pane border border-top-0 p-3 fade show active" id="set_own_office"
                                 role="tabpanel"
                                 aria-labelledby="own-tab">
                                <div class="row">
                                    <div class="col-md-12 officers_list_area">
                                        <input id="officer_search" type="text" class="form-control mb-1"
                                               placeholder="অফিসার খুঁজুন">
                                        <div class="rounded-0  office_organogram_tree_div"
                                             style="overflow-y: scroll; height: 60vh">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade border border-top-0 p-3" id="set_other_office" role="tabpanel"
                                 aria-labelledby="other_office-tab">

                                <div class="row">
                                    <div class="col-md-12">
                                        <select class="form-control select-select2" id="other_office"></select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 other_officers_list_area">
                                        <input id="other_officer_search" type="text" class="form-control mb-1"
                                               placeholder="অফিসার খুঁজুন">
                                        <div class="rounded-0  other_office_organogram_tree_div"
                                             style="overflow-y: scroll; height: 60vh">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8" style="overflow: auto;height: 70vh;">
                        <div class="kt-portlet" style="margin-bottom:0;">
                            <div class="card card-custom gutter-b w-100">
                                <div class="card-body p-0">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="actions text-right mt-3 permission_action_btn">
                            <button type="button" class="btn btn-sm btn-primary btn-square">
                                <i class="fad fa-cloud"></i>সংরক্ষণ
                                করুন
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary btn-square"
                                    id="dismissTeamModal" onclick="$('.ki-close').click()"><i
                                    class="fad fa-window-close"></i>বন্ধ করুন
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

