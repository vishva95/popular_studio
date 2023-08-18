<?php
    $edit = route($route.'.edit', ['id' => $id]);
?>
<a style="background: transparent;" href="{{$edit}}"  title="Edit details" class="btn btn-sm btn-clean btn-icon btn-icon-md">
    <i style="color: blue;" class="la la-edit"></i>
</a>

<button style="background: transparent;" title="Delete" data-id="{{$id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md delete-record">
    <i style="color: red;" class="la la-trash">
    </i>
</button>

