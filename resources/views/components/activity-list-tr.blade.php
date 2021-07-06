@props(['id' =>'', 'name' => '', 'budget'=>'', 'staff' => '', 'auditee' =>'' ])
<tr>
    <td class="vertical-middle">
        {{$id}}
    </td>
    <td class="vertical-middle">
        {{$name}}
    </td>
    <td class="vertical-middle">
        {{$budget}}
    </td>

    <td class="vertical-middle">
        {{$staff}}
    </td>

    <td class="vertical-middle">
        {{$auditee}}
    </td>

    <td class="vertical-middle">
        <button class="btn_annual_plan">Plan</button>
    </td>
</tr>
