<x-title-wrapper-return url="{{route('audit.plan.operational.plan.all')}}">Operational Plan View
</x-title-wrapper-return>

<div class="mt-4 px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="tree-view-wrapper-scroll" id="operational_activity_tree">
                                @include('modules.audit_plan.operational.operational_plan.partials.load_operational_activity_tree')
                            </div>
                        </div>
                        <div class="col-md-8" id="operational_activity_table">
                            @include('modules.audit_plan.operational.operational_plan.partials.load_operational_activity_table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>
