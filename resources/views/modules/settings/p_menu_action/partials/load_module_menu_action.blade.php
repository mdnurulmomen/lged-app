<!--begin::Table-->
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th class="text-left">Name En</th>
            <th class="text-left">Name Bn</th>

            @if($type != 'action')
                <th class="text-left">Parent</th>
            @endif

            @if($type == 'menu')
                <th class="text-left">Module</th>
            @endif

            @if($type == 'action')
                <th class="text-left">Menu</th>
            @endif

            <th class="text-center">Display Order</th>
            <th class="text-left">Class</th>
            <th class="text-left">Icon</th>
            <th class="text-left">Link</th>
            <th  class="text-left" width="10%">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($menuActionList['data'] as $menuAction)
            <tr>
                <td>{{$menuAction['title_en']}}</td>
                <td>{{$menuAction['title_bn']}}</td>

                @if($type != 'action')
                    <td>{{$menuAction['parent']['title_bn']??''}}</td>
                @endif

                @if($type == 'menu')
                    <td>{{$menuAction['menu_module']['title_bn']??''}}</td>
                @endif

                @if($type == 'action')
                    <td>{{$menuAction['action_menu']['title_bn']??''}}</td>
                @endif

                <td class="text-center">{{$menuAction['display_order']}}</td>
                <td>{{$menuAction['class']}}</td>
                <td>{{$menuAction['icon']}}</td>
                <td>{{$menuAction['link']}}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        <button title="হালনাগাদ করুন" class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                                data-type='{{$type}}'
                                data-menu-action-id="{{$menuAction['id']}}"
                                onclick="Menu_Action_Container.loadMenuActionEditForm($(this))">
                            <i class="fad fa-edit"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!--end::Table-->

