<x-title-wrapper>Observations</x-title-wrapper>

<div class="col-md-12">
    <div class="d-flex justify-content-end">

        <a class="btn btn-info btn-sm btn-bold btn-square btn_search mr-1"
            href="javascript:;">
            <i class="far fa-search mr-1"></i>Search Observation
        </a>

        <a class="btn btn-success btn-sm btn-bold btn-square btn_create_observation"
            href="javascript:;">
            <i class="far fa-plus mr-1"></i>Add Observation
        </a>
    </div>
</div>

<div class="mt-4 px-4" id="search_box" style="display: none;">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom gutter-b">
                <div class="card-body row">
                    <form style="display: contents;" id="objection_search" method="post">
                        <div class="col-md-3">
                            <label for="ministry_id" class="col-form-label">Ministry</label>
                            <select class="form-control rounded-0 select-select2" id="ministry_id"
                                name="ministry_id" aria-hidden="true">
                                <option value="">Select</option>
                                <option value="1">পরিকল্পনা মন্ত্রণালয়</option>
                                <option value="2">পররাষ্ট্র মন্ত্রণালয়</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="division_id" class="col-form-label">Division</label>
                            <select class="form-control rounded-0 select-select2" id="division_id"
                                name="division_id" aria-hidden="true">
                                <option value="">Select</option>
                                <option value="1">Dhaka</option>
                                <option value="2">Chittagong</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="parent_office_id" class="col-form-label">Parent office</label>
                            <select class="form-control rounded-0 select-select2" id="parent_office_id"
                                name="parent_office_id" aria-hidden="true">
                                <option value="">Select</option>
                                <option value="1">Office 1</option>
                                <option value="2">Office 2</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="rp_office_id" class="col-form-label">RP office</label>
                            <select class="form-control rounded-0 select-select2" id="rp_office_id"
                                name="rp_office_id" aria-hidden="true">
                                <option value="">Select</option>
                                <option value="1">Office 1</option>
                                <option value="2">Office 2</option>
                            </select>
                        </div>


                        <div class="col-md-3">
                            <label for="directorate_id" class="col-form-label">Directorate</label>
                            <select class="form-control rounded-0 select-select2" id="directorate_id"
                                name="directorate_id" aria-hidden="true">
                                <option value="">Select</option>
                                <option value="1">Directorate 1</option>
                                <option value="2">Directorate 2</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="team_leader_id" class="col-form-label">Team leader</label>
                            <select class="form-control rounded-0 select-select2" id="team_leader_id"
                                name="team_leader_id" aria-hidden="true">
                                <option value="">Select</option>
                                <option value="1">Member 1</option>
                                <option value="2">Member 2</option>
                            </select>
                        </div>


                        <div class="col-md-3">
                            <label for="fiscal_year_id" class="col-form-label">Fiscal year</label>
                            <select class="form-control rounded-0 select-select2" id="fiscal_year_id"
                                name="fiscal_year_id" aria-hidden="true">
                                <option value="">Select</option>
                                @foreach($fiscal_years as $fiscal_year)
                                    <option value="{{$fiscal_year['id']}}">{{$fiscal_year['description']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="observation_type" class="col-form-label">Observation type</label>
                            <select class="form-control rounded-0 select-select2" id="observation_type"
                                name="observation_type" aria-hidden="true">
                                <option value="">Select type</option>
                                <option value="SFI">SFI</option>
                                <option value="NON-SFI">NON-SFI</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="col-form-label">Observation title
                                    :</label>
                                    <input type="text"  name="observation" class="form-control rounded-0" placeholder="" />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">Initiation date
                                    :</label>
                                    <input type="date"  name="initiation_date" class="form-control rounded-0" placeholder="" />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">Status
                                    :</label>
                                <select class="form-control rounded-0 select-select2" id="observation_type"
                                name="status" aria-hidden="true">
                                    <option value="">Select type</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    
                        <div class="col-sm-6 col-md-6 mt-2 ">
                            <label class="d-block" style="line-height: 1;">&nbsp;</label>
                            <button class="btn btn-md btn-info btnSearch" type="button" onclick="searchOb()"><i
                                    class="fa fa-search"></i> Search</button>

                            <button onclick="closeSearchBox()" type="button" class="btn btn-md btn-danger">
                                <i class="fa fa-sync"></i> Close
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="col-lg-12">
    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Body-->
        <div class="card-body" id="observation_data">
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th class="align-middle">Observation no</th>
                            <th>Ministry</th>
                            <th>Parent office</th>
                            <th>Observation title</th>
                            <th>Type</th>
                            <th>Initiation date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($observations['data'] as $observation)                        
                        <tr>
                            <td><span>{{ $observation['observation_no'] }}</span></td>
                            <td><span>{{ $observation['ministry_id'] }}</span></td>
                            <td><span>{{ $observation['parent_office_id'] }}</span></td>
                            <td><span>{{ $observation['observation_en'] }}</span></td>
                            <td><span>{{ $observation['observation_type'] }}</span></td>
                            <td><span>{{ $observation['initiation_date'] }}</span></td>
                            <td><span>{{ $observation['status'] }}</span></td>
                            <td>
                                <div class="btn-group">
                                    <a href="javascript:;" onclick="loadPage('{{ route('audit.followup.observation.show', $observation['id'])}}')" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_view_audit_annual_activity">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="javascript:;" onclick="loadPage('{{ route('audit.followup.observation.edit', $observation['id'])}}')" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:;" onclick="deleteObservation('{{ route('audit.followup.observation.delete', $observation['id'])}}')" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-danger btn_edit_audit_annual_activity">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <td colspan="9" class="text-center"><span>No data found.</span></td>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!--end::Table-->
        </div>
    </div>
    <!--end::Advance Table Widget 4-->
</div>
<script>
    $('.btn_create_observation').click(function () {
        url = '{{route('audit.followup.observation.create')}}';
        data = {}
        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
            $('#kt_content').html(response);
        })
    });

    $('.btn_search').click(function () {
        $('#search_box').show('show');
    });

    function closeSearchBox() {
        $('#search_box').hide('hide');
    }

    function deleteObservation(url) {
        Swal.fire({
            title: 'Are you sure ?',
            showCancelButton: true,
            confirmButtonText: `Delete`,
        }).then((result) => {
            if (result.isConfirmed) {
                ajaxCallAsyncCallbackAPI(url, {}, 'GET', function (response) {
                    if (response.status === 'error') {
                        toastr.error('Error');
                    } else {
                        Swal.fire('Deleted!', '', 'success');
                        loadPage('{{ route('audit.followup.observation.lists') }}');
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Canceled', '', 'info')
            }
        });
    }

    function loadPage(url){
        data = {};
        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
            $('#kt_content').html(response);
        })
    }

    function searchOb()
    {
        url = '{{route('audit.followup.observation.search')}}';
        ajaxCallAsyncCallbackAPI(url, $('#objection_search').serialize(), 'POST', function (response) {
            $('#observation_data').html(response);
        });
    };

</script>
    