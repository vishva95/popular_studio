@php
if(isset($type)) {
$edit=route($route.'.edit', ['id' => $id, 'type'=>$type]);
} else {
$edit=route($route.'.edit', ['id' => $id]);
}   
// echo "ASdas";
// exit;
@endphp
<a style="background: green;" href="{{ $edit }}" title="Edit details" class="btn btn-sm btn-clean btn-icon btn-icon-md">

    <i style="color: white;" class="la la-edit"></i>

</a>