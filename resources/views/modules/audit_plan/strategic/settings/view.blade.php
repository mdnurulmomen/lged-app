<x-title-wrapper>HTML View</x-title-wrapper>

<form id="itemDetailsForm" method="post">
    @csrf
    <div class="card h-100 border-0 w-100">
        {{--<div class="card-header px-3 py-0 bg-white">
            <div class="d-flex justify-content-between" id="view_potro_topbar">
                <div class="d-flex align-items-center">
                    <a id="btn-back-to-nothi" href="" class="btn-potrojari-back btn btn-sm btn-outline-warning btn-square">
                        <i class="fa fa-long-arrow-alt-left"></i> Back</a>
                    <div class="view_nothi_title ml-3 text-violate font-weight-1"></div>
                </div>
                <div class="btn-group potro_action_btn">
                    <button type="submit" class="btn btn-warning btn-sm btn-square btn-draft-save"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>--}}
        <div class="card-body p-0 overflow-hidden border-0 khoshra_loader">
            <div class="d-flex overflow-hidden">
                <div id="khoshra_left" class="note-templates px-3 overflow-auto">
                    <div class="kt-grid__item kt-app__toggle kt-app__aside" id="kt_user_profile_aside">
                        <!--begin:: Widgets/Applications/User/Profile1-->
                        <div class="kt-portlet kt-portlet--height-fluid-">
                            <div class="kt-portlet__body kt-portlet__body--fit-y">
                                <br>
                                <!--Begin:: App Aside-->
                                <div class="kt-grid__item kt-app__toggle kt-app__aside" id="kt_user_profile_aside">
                                    <!--begin::Widget -->
                                    <div class="kt-widget kt-widget--user-profile-1">
                                        <div class="kt-widget__body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="fiscal_year">Fiscal Year</label>
                                                        <select id="fiscal_year" class="form-control rounded-0 select-select2"
                                                                name="fiscal_year">
                                                            <option value="" selected="selected">--Select--</option>
                                                            @foreach($plan_durations as $plan_duration)
                                                                <option value="{{'FY '.$plan_duration['start_year'].' - '.'FY '.$plan_duration['end_year']}}">
                                                                    {{'FY '.$plan_duration['start_year'].' - '.'FY '.$plan_duration['end_year']}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="rp_auditee_office_tree"><div class="row">
                                                    <div class="col-md-12">
                                                        <div class="tree-demo rounded-0 rp_auditee_offices jstree-init jstree-1 jstree-default jstree jstree-default-responsive jstree-checkbox-selection" style="overflow-y: scroll; height: 60vh" role="tree" aria-multiselectable="true" tabindex="0" aria-activedescendant="j1_1" aria-busy="false"><ul class="jstree-container-ul jstree-children" role="group"><li role="treeitem" data-rp-auditee-entity-id="1" data-entity-info="{&quot;entity_id&quot;:1,&quot;entity_name_en&quot;:&quot;Ministry of Social Welfare&quot;,&quot;entity_name_bn&quot;:&quot;\u09b8\u09ae\u09be\u099c\u0995\u09b2\u09cd\u09af\u09be\u09a3 \u09ae\u09a8\u09cd\u09a4\u09cd\u09b0\u09a3\u09be\u09b2\u09df&quot;,&quot;ministry_id&quot;:&quot;1&quot;,&quot;ministry_name_en&quot;:&quot;Ministry of Social Welfare&quot;,&quot;ministry_name_bn&quot;:&quot;\u09b8\u09ae\u09be\u099c\u0995\u09b2\u09cd\u09af\u09be\u09a3 \u09ae\u09a8\u09cd\u09a4\u09cd\u09b0\u09a3\u09be\u09b2\u09df&quot;}" data-jstree="{ &quot;opened&quot; : true }" aria-selected="false" aria-level="1" aria-labelledby="j1_1_anchor" aria-expanded="true" id="j1_1" class="jstree-node  jstree-open"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" id="j1_1_anchor"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon fal fa-folder jstree-themeicon-custom" role="presentation"></i>
                                                                        Introduction
                                                                    </a>
                                                                    <ul role="group" class="jstree-children">
                                                                        <li role="treeitem" data-rp-auditee-entity-id="2" data-entity-info="{&quot;entity_id&quot;:2,&quot;entity_name_en&quot;:&quot;Social Directorate&quot;,&quot;entity_name_bn&quot;:&quot;\u09b8\u09ae\u09be\u099c\u09b8\u09c7\u09ac\u09be \u0985\u09a7\u09bf\u09a6\u09ab\u09a4\u09b0&quot;,&quot;ministry_id&quot;:&quot;1&quot;,&quot;ministry_name_en&quot;:&quot;Ministry of Social Welfare&quot;,&quot;ministry_name_bn&quot;:&quot;\u09b8\u09ae\u09be\u099c\u0995\u09b2\u09cd\u09af\u09be\u09a3 \u09ae\u09a8\u09cd\u09a4\u09cd\u09b0\u09a3\u09be\u09b2\u09df&quot;}" data-jstree="{ &quot;opened&quot; : true }" aria-selected="false" aria-level="2" aria-labelledby="j1_2_anchor" aria-expanded="true" id="j1_2" class="jstree-node  jstree-open"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" id="j1_2_anchor"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon fal fa-folder jstree-themeicon-custom" role="presentation"></i>
                                                                                Sub 01
                                                                            </a>
                                                                            <ul role="group" class="jstree-children"><li role="treeitem" data-rp-auditee-entity-id="3" data-entity-info="{&quot;entity_id&quot;:3,&quot;entity_name_en&quot;:&quot;Social Directorate,Feni&quot;,&quot;entity_name_bn&quot;:&quot;\u099c\u09c7\u09b2\u09be \u09b8\u09ae\u09be\u099c\u09b8\u09c7\u09ac\u09be \u0995\u09be\u09b0\u09cd\u09af\u09be\u09b2\u09df,\u09ab\u09c7\u09a8\u09c0&quot;,&quot;ministry_id&quot;:&quot;1&quot;,&quot;ministry_name_en&quot;:&quot;Ministry of Social Welfare&quot;,&quot;ministry_name_bn&quot;:&quot;\u09b8\u09ae\u09be\u099c\u0995\u09b2\u09cd\u09af\u09be\u09a3 \u09ae\u09a8\u09cd\u09a4\u09cd\u09b0\u09a3\u09be\u09b2\u09df&quot;}" data-jstree="{ &quot;opened&quot; : true }" aria-selected="false" aria-level="3" aria-labelledby="j1_3_anchor" aria-expanded="true" id="j1_3" class="jstree-node  jstree-open"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" id="j1_3_anchor"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon fal fa-folder jstree-themeicon-custom" role="presentation"></i>
                                                                                        Sub Sub 01
                                                                                    </a>
                                                                                </li>
                                                                                <li role="treeitem" data-rp-auditee-entity-id="5" data-entity-info="{&quot;entity_id&quot;:5,&quot;entity_name_en&quot;:&quot;district drictorate,comilla&quot;,&quot;entity_name_bn&quot;:&quot;\u099c\u09c7\u09b2\u09be \u09b8\u09ae\u09be\u099c\u09b8\u09c7\u09ac\u09be \u0995\u09be\u09b0\u09cd\u09af\u09be\u09b2\u09df,\u0995\u09c1\u09ae\u09bf\u09b2\u09cd\u09b2\u09be&quot;,&quot;ministry_id&quot;:&quot;1&quot;,&quot;ministry_name_en&quot;:&quot;Ministry of Social Welfare&quot;,&quot;ministry_name_bn&quot;:&quot;\u09b8\u09ae\u09be\u099c\u0995\u09b2\u09cd\u09af\u09be\u09a3 \u09ae\u09a8\u09cd\u09a4\u09cd\u09b0\u09a3\u09be\u09b2\u09df&quot;}" data-jstree="{ &quot;opened&quot; : true }" aria-selected="false" aria-level="3" aria-labelledby="j1_5_anchor" id="j1_5" class="jstree-node  jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" id="j1_5_anchor"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon fal fa-folder jstree-themeicon-custom" role="presentation"></i>
                                                                                        Sub Sub 02
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                        <li role="treeitem" data-rp-auditee-entity-id="7" data-entity-info="{&quot;entity_id&quot;:7,&quot;entity_name_en&quot;:&quot;new office&quot;,&quot;entity_name_bn&quot;:&quot;new office&quot;,&quot;ministry_id&quot;:&quot;1&quot;,&quot;ministry_name_en&quot;:&quot;Ministry of Social Welfare&quot;,&quot;ministry_name_bn&quot;:&quot;\u09b8\u09ae\u09be\u099c\u0995\u09b2\u09cd\u09af\u09be\u09a3 \u09ae\u09a8\u09cd\u09a4\u09cd\u09b0\u09a3\u09be\u09b2\u09df&quot;}" data-jstree="{ &quot;opened&quot; : true }" aria-selected="false" aria-level="2" aria-labelledby="j1_8_anchor" id="j1_8" class="jstree-node  jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" id="j1_8_anchor"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon fal fa-folder jstree-themeicon-custom" role="presentation"></i>
                                                                                Mission & Vision
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Widget -->
                                </div>
                            </div>
                        </div>
                        <!--end:: Widgets/Applications/User/Profile1-->
                    </div>
                </div>

                <div id="khoshra_main" class="position-relative" style="height: 77vh;">
                    <div class="card overflow-hidden h-100 border-0">
                        <div class="card-body d-flex p-0 flex-fill overflow-hidden">
                            <div id="khoshra_potro" class="overflow-auto">
                                <div class="card h-100 overflow-hidden border-0 ">
                                    <div class="card-body h-100 overflow-hidden p-0 ">
                                        <div class="kt-wizard-v2__form item_details">
                                            <textarea class="summernote form-control" name="item_details[]" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="khoshra_right">
                    <div style="overflow-y: scroll; height:460px;padding:15px">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('.summernote').summernote();
        $('div.note-editable').height(400);
    });

    if ($('#khoshra_left, #khoshra_main,#khoshra_right').length) {
        var noteTopBottom = Split(['#khoshra_left', '#khoshra_main','#khoshra_right'], {
            sizes: [25,47,28],
            direction: 'horizontal',
        });
    }
</script>
