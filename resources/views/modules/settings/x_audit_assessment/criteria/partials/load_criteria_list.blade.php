<!--begin::Table-->
<table class="table table-bordered" width="100%">
        <thead class="thead-light">
        <tr>
            <th width="20%" class="text-left">Category</th>
            <th width="30%" class="text-left">Name En</th>
            <th width="30%" class="text-left">Name Bn</th>
            <th width="20%" class="text-left" width="10%">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($criteriaList as $criteria)
            <tr>
                <td>{{$criteria['category_title_bn']}}</td>
                <td>{{$criteria['name_en']}}</td>
                <td>{{$criteria['name_bn']}}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        <button title="হালনাগাদ করুন" class="btn btn-icon btn-square btn-sm btn-light
                        btn-hover-icon-danger btn-icon-primary"
                        data-criteria-id="{{$criteria['id']}}"
                        onclick="Criteria_Container.edit($(this))">
                            <i class="fad fa-edit"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
<!--end::Table-->

