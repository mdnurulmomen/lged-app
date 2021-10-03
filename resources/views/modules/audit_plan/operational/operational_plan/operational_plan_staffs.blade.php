<div class="mt-4">
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="tree-view-wrapper-scroll" id="operational_activity_tree">
                        @include('modules.audit_plan.operational.operational_plan.partials.load_operational_activity_tree',
                        ['tree' => $ops['tree']]
                        )
                    </div>
                </div>
                <div class="col-md-8" id="operational_activity_table">
                    @include('modules.audit_plan.operational.operational_plan.partials.load_operational_activity_table',
                    ['directorates' => $ops['directorates']]
                    )
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>
