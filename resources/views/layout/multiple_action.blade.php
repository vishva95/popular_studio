@push('styles')

<link rel="stylesheet" href="{{ asset('assets/plugins/custom/jquery-ui/jquery-ui.bundle.css') }}" />

@endpush

@if(count($action))
<div class="kt-portlet__foot kt-portlet__foot--lg">

    <!-- <form action="#" method="POST"> -->

    <div class="row">

        <div class="col-sm-2">

            <div class="form-group">

                <select name="action" id="action" class="action form-control">

                    <option value="">Select</option>

                    @foreach ($action as $key => $value)

                    <option value="{{ $key }}">{{$value }}</option>

                    @endforeach

                </select>

            </div>

        </div>

    </div>

    <div class="col-sm-3">

        <button type="button" class="btn btn-primary mr-2" id="multiple-action">Apply</button>

    </div>

    <!-- </form> -->

</div>
@endif

<input type="hidden" name="status_url" id="status_url" value="{{ route('home.change-multiple-status') }}" />
<input type="hidden" name="delete_url" id="delete_url" value="{{ route('home.delete-multiple') }}" />
@if(isset($folder_name))
<input type="hidden" name="folder_name" id="folder_name" value="{{ $folder_name }}" />
@endif


@if(isset($folder_name))
<input type="hidden" name="table_name" id="table_name" value="{{ $table_name }}" />
@endif

@push('scripts')

@if(isset($is_orderby) && $is_orderby == 'yes')

<!-- <link rel="stylesheet" href="/assets/js/jquery-ui/jquery-ui-1.10.3.custom.min.css" /> -->

<!-- <script type="text/javascript" src="{{ asset('assets/plugins/custom/jquery-ui/jquery-ui.bundle.css') }}"></script> -->

<script type="text/javascript" src="{{ asset('assets/plugins/custom/jquery-ui/jquery-ui.bundle.js') }}"></script>

<script type="text/javascript">
    
    $(document).on("click", "#multiple-action", function() {

        if ($('#action').val() == "") {

            alert("Please select an action");

            return false;

        } else {

            if ($('.allcheckbox:checked').length > 0) {

                var ids = [];

                $('.allcheckbox').each(function() {

                    if ($(this).is(':checked')) {

                        ids.push($(this).val());

                    }

                });

                var rowparam = $('#action').val().split('-');

                if ($('#action').val() == "delete") {
                    if (confirm("Are you sure ?")) {
                        $("#multiple-action").addClass('disabled');
                        DeleteMultiple(ids);
                    }

                }
                //  else if($('#action').val() == "discount"){
                //     if (confirm("Are you sure ?")) {
                //         $("#multiple-action").addClass('disabled');
                //         // DiscountMultiple(ids);
                //     }
                    
                // } 
                else if (rowparam[0] == "change") {

                    var params = '';

                    params = rowparam[2];

                    var field = rowparam[1];

                    $("#multiple-action").addClass('disabled');

                    ChangeMultiple(ids, field, params);

                }

            } else {

                alert("Select any checkbox");

            }

        }

    });



    $("#selectall").on('click', function() { // bulk checked

        var status = this.checked;

        $(".allcheckbox").each(function() {

            $(this).prop("checked", status);

        });

    });



    $(document).on("click", ".delete-record", function() {

        if (confirm("Are you sure ?")) {

            var parent = $(this);

            parent.addClass('disabled');

            parent.html('<i class="fa fa-spinner fa-spin"></i>');

            var ids = [];

            ids.push($(this).data('id'));

            DeleteMultiple(ids);

        }

        return false;

    });

   

    function DeleteMultiple(ids) {

        var table = $('#table_name').val();

        var newurl = '';

        var folder_name = $('#folder_name').val();

        if (folder_name == '') {

            newurl = 'table_name=' + table + '&id=' + ids;

        } else {

            newurl = 'table_name=' + table + '&id=' + ids + '&folder_name=' + folder_name;

        }



        $.ajax({

            type: 'GET',

            url: $('#delete_url').val(),

            data: newurl,

            dataType: 'json',

            success: function(data) {

                if (data.status == 'Success') {

                    $(ids).each(function() {

                        $('#row-' + this).remove();

                    });
                    toastr["success"](data.message, "Success");
                    alert(data.message);
                    location.reload();

                } else {
                    toastr["error"](data.message, "Error");
                    $('.delete-record').removeClass('disabled');

                    $('.delete-record').html('<i style="color: white;" class="la la-trash"></i >');

                }

                $("#multiple-action").removeClass('disabled');

            }

        });

    }

    $(document).on("change", ".change_status", function() {
        var parent = $(this);
        var ids = [];
        var idrow = this.id.split('-');
        ids.push(idrow[1]);
        var params = '';
        var rowparam = parent.attr('href').split('-');
        if (rowparam[1] == '1') {
            params = '0';
        } else {
            params = '1';
        }

        var field = rowparam[0];
        ChangeMultiple(ids, field, params);
        return false;
    });


    function ChangeMultiple(ids, field, params) {

        var table = $('#table_name').val();

        $(ids).each(function() {

            $('#' + field + '-' + this).addClass('disabled');

            $('#' + field + '-' + this).html('<i class="fa fa-spinner fa-spin"></i>');

        });

        $.ajax({

            type: 'GET',

            url: "{{route('home.change-multiple-status')}}",

            data: 'id=' + ids + '&table_name=' + table + '&field=' + field + '&param=' + params,

            dataType: 'json',


            success: function(data) {
                if (data.status == 'Success') {
                    toastr["success"](data.message, "Success");
                    $(ids).each(function() {
                        if (params == '1') {
                            $('#' + field + '-' + this).attr('href', field + '-1');
                        } else {
                            $('#' + field + '-' + this).attr('href', field + '-0');
                        }
                        $('#' + field + '-' + this).removeClass('disabled');
                        $("#multiple-action").removeClass('disabled');

                    });
                    location.reload();
                } else {
                    toastr["error"](data.message, "Error");
                }
            }

        });

    }
</script>

@endif

@endpush