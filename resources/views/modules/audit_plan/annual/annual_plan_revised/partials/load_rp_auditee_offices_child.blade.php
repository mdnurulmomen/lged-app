<ul>
    @foreach($field_offices as $office)
        <li data-jstree='{ "opened" : true }'>
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


<script>
    $(document).ready(function () {
        $(`#rp_auditee_parent_offices`).jstree({
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
