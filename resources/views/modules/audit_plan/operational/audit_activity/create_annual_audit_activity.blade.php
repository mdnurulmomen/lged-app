<x-title-wrapper-return area="#kt_content" title="Back To Lists"
                        url="{{route('audit.plan.operational.activity.all')}}">
    Create Annual Audit Activities
</x-title-wrapper-return>
<div class="mt-4 px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="select_fiscal_year" class="col-form-label">Fiscal Year :</label>
                                <select class="form-control rounded-0 select-select2" id="select_fiscal_year"
                                        name="fiscal_year_id">
                                    <option value="">Choose Fiscal Year</option>
                                    @foreach($fiscal_years as $fiscal_year)
                                        <option value="{{$fiscal_year['id']}}">{{$fiscal_year['description']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="select_strategic_outcome" class="col-form-label">Strategic Outcome
                                    :</label>
                                <select class="form-control rounded-0 select-select2" id="select_strategic_outcome"
                                        name="strategic_outcome">
                                    <option value="">Choose Outcome</option>
                                    @foreach($strategic_outcomes as $strategic_outcome)
                                        <option
                                            value="{{$strategic_outcome['id']}}">{{$strategic_outcome['outcome_no']}}</option>
                                    @endforeach
                                </select>
                                <div class="mt-3">
                                    <p id="outcome_remarks_area"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" id="strategic_output_area">
                            <div class="form-group" id="strategic_output_area">
                                <label for="select_strategic_output" class="col-form-label">Strategic Output</label>
                                <select name="strategic_output" id="select_strategic_output"
                                        class="form-control rounded-0 select-select2">
                                    <option value="">Select Output</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <p id="output_remarks_area" class="d-none"></p>
                            </div>
                        </div>
                        <div class="col-md-2 mt-md-12">
                            <button class="btn btn-icon btn-light-success btn-square mr-2 search_activities"
                                    onclick="Audit_Activities_Container.createAnnualActivityAreaData()"
                                    type="button"><i class="fad fa-search"></i></button>
                            <button class="btn btn-icon btn-light-danger btn-square mr-2 reset_strategic_area"
                                    onclick="Audit_Activities_Container.resetStrategicSearchFields()"
                                    type="reset"><i
                                    class="fad fa-recycle"></i></button>
                        </div>
                    </div>
                    <div class="row" id="">
                        <div class="col-md-12">
                            <h3>Create Activities</h3>
                            <hr>
                            <div class="create_activity_area">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-modal id="op_activity_modal" title="Create Operation Activity"
         url="{{route('audit.plan.operational.activity.store')}}" method="post">
    <form id="op_activity_form">
        <div class="form-group row">
            <label for="activity_no" class="col-3 col-form-label">Activity No</label>
            <div class="col-9">
                <input placeholder="Activity No" class="form-control" type="text" value=""
                       id="activity_no" name="activity_no"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="title_en" class="col-3 col-form-label">Title English</label>
            <div class="col-9">
                <input placeholder="Title English" class="form-control" type="text" value=""
                       id="title_en" name="title_en"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="title_bn" class="col-3 col-form-label">Title Bangla</label>
            <div class="col-9">
                <input placeholder="Title Bangla" class="form-control" type="text" value=""
                       id="title_bn" name="title_bn"/>
            </div>
        </div>

        <div class="form-group row">
            <label for="activity_type" class="col-3 col-form-label">Activity Type</label>
            <div class="col-9">
                <select name="activity_type" id="activity_type" class="form-control select-select2">
                    <option value="planning" selected>Planning</option>
                    <option value="financial">Financial</option>
                    <option value="compliance">Compliance</option>
                    <option value="performance">Performance</option>
                </select>
            </div>
        </div>

        <input type="hidden" name="output_id" class="output_id" value="">
        <input type="hidden" name="outcome_id" class="outcome_id" value="">
        <input type="hidden" name="fiscal_year_id" class="fiscal_year_id" value="">
        <input type="hidden" name="activity_parent_id" class="activity_parent_id" value="">
    </form>
</x-modal>

<x-modal id="op_activity_edit_modal" title="Edit Operation Activity"
         url="{{route('audit.plan.operational.activity.update')}}" method="post">
    <form id="op_activity_edit_form">
        <div class="edit_activity_area">

        </div>


        <input type="hidden" name="output_id" class="output_id" value="">
        <input type="hidden" name="outcome_id" class="outcome_id" value="">
        <input type="hidden" name="fiscal_year_id" class="fiscal_year_id" value="">
        <input type="hidden" name="activity_id" class="activity_id" value="">
    </form>
</x-modal>

<x-modal id="op_activity_milestone_edit_modal" title="Edit Operation Activity Milestone"
         url="{{route('audit.plan.operational.activity.milestone.update')}}" method="post">
    <form id="op_activity_milestone_edit_form">
        <div class="edit_activity_milestone_area">

        </div>
        <input type="hidden" name="activity_id" class="activity_id" value="">
        <input type="hidden" name="output_id" class="output_id" value="">
        <input type="hidden" name="outcome_id" class="outcome_id" value="">
        <input type="hidden" name="fiscal_year_id" class="fiscal_year_id" value="">
        <input type="hidden" name="milestone_id" class="milestone_id" value="">
    </form>
</x-modal>

<x-modal id="op_activity_milestone_modal" title="Create Operation Activity Milestone"
         url="{{route('audit.plan.operational.activity.milestone.store')}}" method="post" size="lg">
    <form id="op_activity_milestone_form">
        <div class="form-group" id="milestone_add_area">
            <div class="form-group row">
                <label for="title_en" class="col-3 col-form-label">Title English</label>
                <div class="col-9">
                    <input placeholder="Title English" class="form-control" type="text" value=""
                           id="title_en" name="title_en"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="title_bn" class="col-3 col-form-label">Title Bangla</label>
                <div class="col-9">
                    <input placeholder="Title Bangla" class="form-control" type="text" value=""
                           id="title_bn" name="title_bn"/>
                </div>
            </div>
        </div>

        <input type="hidden" name="output_id" class="output_id" value="">
        <input type="hidden" name="outcome_id" class="outcome_id" value="">
        <input type="hidden" name="fiscal_year_id" class="fiscal_year_id" value="">
        <input type="hidden" name="activity_id" class="activity_id" value="">
    </form>
</x-modal>


<script>
    $('#btn_op_activity_modal_save').click(function () {
        url = $(this).data('url');
        data = $('#op_activity_form').serialize();
        method = $(this).data('method');
        submitModalData(url, data, method, 'op_activity_modal')
        $('.search_activities').click();
    });
    $('#btn_op_activity_edit_modal_save').click(function () {
        url = $(this).data('url');
        data = $('#op_activity_edit_form').serialize();
        method = $(this).data('method');
        submitModalData(url, data, method, 'op_activity_edit_modal');
        $('.search_activities').click();

    });
    $('#btn_op_activity_milestone_edit_modal_save').click(function () {
        url = $(this).data('url');
        data = $('#op_activity_milestone_edit_form').serialize();
        method = $(this).data('method');
        submitModalData(url, data, method, 'op_activity_milestone_edit_modal');
        $('.search_activities').click();

    });
</script>


@include('scripts.script_audit_plan_operational_activity')
{{--@include('scripts.script_generic')--}}
