<?php
    $family = App\Models\GradeFamily::get();
    
    $field_name = DB::table($table_name)->where('id',$id)->value($field_name);
    $url = route($route.'.update', ['id' => $id]);
    $family_id = 0;
    $remark = null;
    $option = null;
    if($route === 'grade')
    {

        $family_id = DB::table($table_name)->where('id',$id)->value('grade_family_id');
        $option = '<option value="">Select</option>';
        foreach($family as $fam) 
        {
            $select = '';
            if($fam->id == $family_id)
            {
                $select = 'selected';
            }
            $option .= '<option value="'.$fam->id.'" '.$select.'>'.$fam->family_name.'</option>';
        }
        $remark =  DB::table($table_name)->where('id',$id)->value('grade_remark');
    }
?>
<a style="background: transparent;" onclick="getEditData('{{$url}}','{{$field_name}}','{{$family_id}}','{{$remark}}','{{$option}}')" title="Edit details" class="btn btn-sm btn-clean btn-icon btn-icon-md">
    <i style="color: green;" class="la la-edit"></i>
</a>

<button style="background: transparent;" title="Delete" data-id="{{$id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md delete-record">
    <i style="color: red;" class="la la-trash">
    </i>
</button>

<script type="text/javascript">
    function getEditData(url,field_name,family_id,remark,option)
    {
        $('#edit_modal').modal('show');
        $('#edit_field').val('');
        $('#edit_field').val(field_name);
        $('#edit_form').attr('action','');
        $('#edit_form').attr('action',url);
        if(family_id != 0)
        {
            $('#remark').val('');
            $('#remark').val(remark);
            $('#families').html('');
            $('#families').html(option);
        }

    }
</script>