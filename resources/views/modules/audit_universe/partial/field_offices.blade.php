<x-title-wrapper>Field Offices</x-title-wrapper>
<div class="card sna-card-border">
    <div class="row">
        <div class="col-md-12">
                <div id="rp_auditee_offices" style="overflow-y: scroll; height: 60vh">
                    <ul>
                        @foreach($field_offices as $office)
                                <li data-jstree='{ "opened" : "true" }' >
                                    {{$office['office_name_eng']}}
                                    @if(count($office['child']) > 0)
                                    @include('modules.audit_plan.annual.annual_plan_revised.partials.load_rp_auditee_offices_child',
                                        [
                                            'field_offices' => $office['child']
                                        ])
                                    @endif
                                </li>
                        @endforeach
                    </ul>
                </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(`#rp_auditee_offices`).jstree({
            "core": {
                "themes": {
                    "responsive": true
                },
                "check_callback": true,
            },
            "types": {
                "default": {
                    "icon": "fal fa-building text-warning"
                }
            },
        });
    });
</script>
