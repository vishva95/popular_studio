@php

if(isset($type)) {

$edit=route($route.'.show', ['id' => $id, 'type'=>$type]);

} else {

$edit=route($route.'.show', ['id' => $id]);

}

@endphp
<a style="background: skyblue;" href="{{ $edit }}" title="View details" class="btn btn-sm btn-clean btn-icon btn-icon-md">



    <i style="color: white;" class="la la-eye"></i>



</a>
<button style="background: red;" title="Delete" data-id="{{$id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md delete-record">



    <i style="color: white;" class="la la-trash">



    </i>



</button>