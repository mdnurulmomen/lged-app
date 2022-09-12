<script>
    var Archive_Apotti_Common_Container = {
        loadDirectorateWiseMinistry: function (directorate_id, ministry_id = '') {
            let url = '{{route('audit.execution.archive-apotti.load-directorate-wise-ministry')}}';
            let data = {directorate_id};
            $("#ministry_id").html('<option value="">Loading...</option>');
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data);
                    } else {
                        $('#ministry_id').html(response);
                        if (ministry_id != "") {
                            $("#ministry_id").val(ministry_id);
                        }
                    }
                }
            );
        },

        loadMinistryWiseEntity: function (ministry_id, entity_id = '') {
            let url = '{{route('audit.execution.archive-apotti.load-ministry-wise-entity')}}';
            let data = {ministry_id};
            console.log(entity_id)
            $("#entity_id").html('<option value="">Loading...</option>');
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data);
                    } else {
                        $('#entity_id').html(response);
                        if (entity_id != "") {
                            $("#entity_id").val(entity_id);
                        }
                    }
                }
            );
        },

        loadEntityWiseUnitGroupOffice: function (entity_id, parent_office_id = '') {
            let url = '{{route('audit.execution.archive-apotti.load-entity-wise-unit-group-office')}}';
            let data = {entity_id};
            $("#unit_group_office_id").html('<option value="">Loading...</option>');
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data);
                    } else {
                        $('#unit_group_office_id').html(response);
                        if (parent_office_id != "") {
                            $("#unit_group_office_id").val(parent_office_id);
                        }
                    }
                }
            );
        },

        loadEntityOrUnitGroupWiseCostCenter: function (parent_office_id, cost_center_id = '') {
            let url = '{{route('audit.execution.archive-apotti.load-entity-or-unit-group-wise-cost-center')}}';
            let data = {parent_office_id};
            $("#cost_center_id").html('<option value="">Loading...</option>');
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data);
                    } else {
                        $('#cost_center_id').html(response);
                        if (cost_center_id != "") {
                            $("#cost_center_id").val(cost_center_id);
                        }
                    }
                }
            );
        },

        loadOniyomerSubCategory: function (directorate_id, apotti_oniyomer_category_id, apotti_oniyomer_category_child_id = "") {
            let url = '{{route('audit.execution.archive-apotti.load-oniyomer-sub-category-list')}}';
            let data = {directorate_id, apotti_oniyomer_category_id};
            $("#apotti_oniyomer_category_child_id").html('<option value="">Loading...</option>');
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data);
                    } else {
                        $('#apotti_oniyomer_category_child_id').html(response);
                        if (apotti_oniyomer_category_child_id != "") {
                            $("#apotti_oniyomer_category_child_id").val(apotti_oniyomer_category_child_id).trigger('change');
                        }
                    }
                }
            );
        },
        loadAllProjects: function (directorate_id) {
            url = '{{route('rpu.rp-projects.all')}}';
            data = {directorate_id};
            $("#project_id").html('<option value="">Loading...</option>');
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    var projects = response;
                    console.log(projects)
                    $("#project_id").html('<option value="">All</option>');
                    $.each(response, function (key, project) {
                        option_value = `<option value="${project.id}" data-project-name-en="${project.name_en}" data-project-name-bn="${project.name_bn}">${project.name_bn}</option>`;
                        $('#project_id').append(option_value)
                    })
                }
            );
        },
    };
</script>
