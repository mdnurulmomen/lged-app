<x-modal id="forward_audit_calendar_modal" title="Forward" size='xl'>
    <div class="row">
        <div class="col-md-6">
            <div class="tree-demo rounded-0 office_organogram_tree jstree-init jstree-1 jstree-default">
                <ul>
                    <li>
                        Office
                        <ul>
                            @foreach($officer_lists as $key => $officer_list)
                                @foreach($officer_list['units'] as $unit)
                                    <li data-jstree='{ "opened" : true }'>
                                        {{$unit['unit_name_eng']}}
                                        <ul>
                                            @foreach($unit['designations'] as $designation)
                                                <li data-designation-id="{{$designation['designation_id']}}"
                                                    data-jstree='{ "icon" : "{{!empty($designation['employee_info']) ? "fas": "fal"}} fa-user text-warning" }'>
                                                    {{!empty($designation['employee_info']) ? $designation['employee_info']['name_eng'] : ''}}
                                                    <small>{{$designation['designation_eng']}}</small>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>

        </div>


        <div class="col-md-6">
            <div class="datatable datatable-default datatable-bordered datatable-loaded border">
                <table class="datatable-bordered datatable-head-custom datatable-table" id=""
                       style="display: block;">
                    <thead class="datatable-head">
                    <tr class="datatable-row" style="left: 0px;">
                        <th style="width: 2%" class="datatable-cell datatable-cell-sort">#</th>
                        <th style="width: 38%" class="datatable-cell datatable-cell-sort">Name
                        </th>
                        <th style="width: 60%" class="datatable-cell datatable-cell-sort">
                            Designation
                        </th>
                    </tr>
                    </thead>
                    <tbody style="" class="datatable-body">
                    <tr data-row="0" class="datatable-row" style="left: 0px;">
                        <td style="width: 2%" class="datatable-cell">
                            <button type="button" data-designation-id="16345"
                                    class="btn btn-icon btn-outline-danger btn-xs border-0 mr-2"><i
                                    class="fal fa-trash-alt"></i></button>
                        </td>
                        <td style="width: 38%" class="datatable-cell">Officer</td>
                        <td style="width: 60%" class="datatable-cell">Deputy Director</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-3 d-none">
                <form class="form-row">
                    <div class="col-md-2">Date</div>
                    <div class="col-md-10">
                        <div class="input-daterange input-group" id="kt_datepicker_5">
                            <input type="text" class="form-control" name="start">
                            <div class="input-group-append">
															<span class="input-group-text">
																<i class="la la-ellipsis-h"></i>
															</span>
                            </div>
                            <input type="text" class="form-control" name="end">
                        </div>
                    </div>
                    <div class="col-md-2 mt-2">Budget</div>
                    <div class="col-md-10 mt-2"><input type="text" class="form-control"/></div>
                </form>
            </div>
        </div>
    </div>
</x-modal>

<script>
    $('.jstree-init').jstree({
        "core": {
            "themes": {
                "responsive": false
            }
        },
        "types": {
            "default": {
                "icon": "fal fa-folder"
            },
            "person": {
                "icon": "fal fa-file "
            }
        },
        "plugins": ["types", "checkbox", "wholerow"]
    });

    // handle link clicks in tree nodes(support target="_blank" as well)
    $('.jstree-init').on('select_node.jstree', function (e, data) {
        var link = $('#' + data.selected).find('a');
        if (link.attr("href") != "#" && link.attr("href") != "javascript:;" && link.attr("href") != "") {
            if (link.attr("target") == "_blank") {
                link.attr("href").target = "_blank";
            }
            document.location.href = link.attr("href");
            return false;
        }
    });
</script>
