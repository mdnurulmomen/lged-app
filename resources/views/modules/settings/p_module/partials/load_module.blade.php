<!--begin::Table-->
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th class="text-left">Module En</th>
            <th class="text-left">Module Bn</th>
            <th class="text-left">Parent Module</th>
            <th class="text-left">Display Order</th>
            <th class="text-left">Module Class</th>
            <th class="text-left">Module Icon</th>
            <th class="text-left">Module Controller</th>
            <th class="text-left">Module Method</th>
            <th class="text-left">Module Link</th>
            <th class="text-left">Other Module</th>
            <th  class="text-left" width="10%">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($allModule['data'] as $module)
            <tr>
                <td>{{$module['module_name_en']}}</td>
                <td>{{$module['module_name_bn']}}</td>
                <td>{{$module['parent']['module_name_en']??''}}</td>
                <td>{{$module['display_order']}}</td>
                <td>{{$module['module_class']}}</td>
                <td>{{$module['module_icon']}}</td>
                <td>{{$module['module_controller']}}</td>
                <td>{{$module['module_method']}}</td>
                <td>{{$module['module_link']}}</td>
                <td>{{$module['is_other_module'] == 1?'Yes':'No'}}</td>
                <td>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!--end::Table-->

