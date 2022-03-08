<x-title-wrapper>{{ucfirst($type)}} List</x-title-wrapper>
<div class="card sna-card-border d-flex flex-wrap flex-row">
    <div class="col-xl-12 text-right">
        <a class="btn btn-primary btn-sm btn-bold btn-square"
           href="javascript:;" onclick="Menu_Action_Container.loadMenuActionCreateForm()">
            <i class="far fa-plus mr-1"></i> Add {{ucfirst($type)}}
        </a>
    </div>
</div>

<div class="card sna-card-border mt-2">
    <div class="px-3" id="load_menu_action_list"></div>
</div>

@include('modules.settings.p_menu_action.partials._script_menu_action')

<script>
    $(function () {
        type = '{{$type}}';
        Menu_Action_Container.loadTypeWiseMenuActionList(type);
    });
</script>
