@php
if($route === 'campaign'  || $route === 'template' || $route === 'riskprofiling')
{
	$edit=route($route.'.edit', ['id' => $id]);
    if($route === 'campaign')
    {
        $mail = route($route.'.sendmail');
        $shows = route($route.'.show', ['id' => $id]);
        $log = route($route.'.log', ['id' => $id]);
    }
    if($route === 'riskprofiling')
    {
        $mail = route($route.'.sendmail');
    }
}
else
{
	$edit=route($route.'.edit', ['ID' => $ID]);
}
@endphp

@if($route === 'campaign' || $route === 'template' || $route === 'riskprofiling')
<input type="hidden" value="{{$id}}">
<a style="background: transparent;" href="{{ $edit }}" title="Edit" class="btn btn-sm btn-clean btn-icon btn-icon-md">
    <i style="color: green;" class="la la-edit"></i>
</a>
@if($route === 'campaign' || $route === 'riskprofiling')
<button style="background: transparent;" title="Delete" data-id="{{$id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md delete-record">
    <i style="color: red;" class="la la-trash">
    </i>
</button>
@endif
@if($route === 'riskprofiling')
<button style="background: transparent;" title="Send Risk Profiling & Suitablility Report" id="sendmail_{{$id}}" onclick="sendmail('{{$id}}')" class="btn btn-sm btn-clean btn-icon btn-icon-md sendmail">
    <i style="color: #0932A2;" class="fas fa-paper-plane">
    </i>
</button>
@endif
@else

<input type="hidden" value="{{$ID}}">


<a style="background: transparent;" href="{{ $edit }}" title="Edit" class="btn btn-sm btn-clean btn-icon btn-icon-md">

    <i style="color: green;" class="la la-edit"></i>

</a>
<button style="background: transparent;" title="Delete" data-id="{{$ID }}" class="btn btn-sm btn-clean btn-icon btn-icon-md delete-record">
    <i style="color: red;" class="la la-trash">
    </i>
</button>
@endif

@if($route === 'campaign')
<button style="background: transparent;"  title="Send Email" onclick="sendmail('{{$id}}')" id="sendmail_{{$id}}" class="btn btn-sm btn-clean btn-icon btn-icon-md sendmail">
    <i style="color: #0932A2;" class="fas fa-paper-plane"></i>
</button>

<a style="background: transparent;" title="Preview Mail" href="{{$shows}}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
    <i style="color: skyblue;" class="la la-eye"></i>
</a>

<a style="background: transparent;" href="{{ $log }}" title="Log view" class="btn btn-sm btn-clean btn-icon btn-icon-md">
    <i style="color: black;" class="fas fa-dot-circle"></i>
</a>
@endif
@if($route === 'campaign' || $route === 'riskprofiling')
<script type="text/javascript">

    function sendmail(id)
    {
        var parent = $('#sendmail_'+id);           

        parent.attr('disabled',true);

        parent.html('<i class="fa fa-spinner fa-spin"></i>');

        $.ajax({
            type: "POST",
            url: "{{ $mail }}",
            data: {
                '_token': $('input[name="_token"]').val(),
                'id': id
            },
            dataType:'json',
            cache: false,
            success: function (data)
            {

                toastr["success"]("Email sent successfully!", "Success");

                parent.attr('disabled',false);

                parent.html('<i style="color: #0932A2;" class="fas fa-paper-plane"></i >');
            }
        });
    }
</script>
@endif