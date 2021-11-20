<x-title-wrapper>{{ucfirst($type)}} List</x-title-wrapper>

<div class="col-md-12">
    <div class="d-flex justify-content-end">
        <a class="btn btn-primary btn-sm btn-bold btn-square"
           href="javascript:;" onclick="Menu_Action_Container.loadMenuActionCreateForm()">
            <i class="far fa-plus mr-1"></i> Add {{ucfirst($type)}}
        </a>
    </div>
</div>

<div class="px-3" id="load_menu_action_list"></div>

@include('modules.settings.p_menu_action.partials._script_menu_action')

<script>
    $(function () {
        type = '{{$type}}';
        Menu_Action_Container.loadTypeWiseMenuActionList(type);
    });
</script>
