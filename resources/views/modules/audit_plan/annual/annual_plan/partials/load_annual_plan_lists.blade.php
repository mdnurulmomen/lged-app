<table class="table table-bordered">
    <thead>
    <tr>
        <th>Activity ID</th>
        <th>Activity Name</th>
        <th>Budget</th>
        <th style="">Assigned Staff</th>
        <th style="">Auditee</th>
        <th style="">Plan</th>
    </tr>
    </thead>
    <tbody>

    <x-activity-list-tr id="Activity 1.1" name="Preparation of Annual Audit Plan" budget="" staff="200" auditee=""/>

    <x-activity-list-tr id="Activity 1.2" name="Financial Audit on Budgetary Central Government" budget="" staff="25"
                        auditee=""/>

    <x-activity-list-tr id="Activity 1.2.1" name="Financial Audit on Extra Budgetary Organisations" budget=""
                        staff="182" auditee=""/>

    <x-activity-list-tr id="Activity 1.2.2" name="Financial Audit on Extra Budgetary Organisations" budget=""
                        staff="182" auditee=""/>

    </tbody>
</table>

<script>
    $('.btn_annual_plan').click(function () {
        let url = '{{route('audit.plan.annual.plan.list.entity.selection.show')}}'
        ajaxCallAsyncCallback(url, {}, 'html', 'post', function (response) {
            $('#kt_content').html(response)
        });
    });
</script>
