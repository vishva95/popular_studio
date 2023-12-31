@extends('main')

@section('content')

<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<br>
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">
			<div class="kt-portlet__head kt-portlet__head--lg" style="overflow: auto !important;">
				<div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="fa fa-user" aria-hidden="true"></i>
					</span>
					<h3 class="kt-portlet__head-title">
						User
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<div class="kt-portlet__head-wrapper">
						<div class="kt-portlet__head-actions">
							<a href="{{route('user.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
								<i class="la la-plus"></i>
								Add User
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="kt-portlet__body">
				<div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4">
					<table class="table table-striped table-bordered table-hover table-checkable datatable" id="datatable_rows">
						@csrf
						<thead>
							<tr>
								<th>Name</th>
								<th>Role</th>
								<th>Email</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>

			@include('layout.multiple_action', array(



			'table_name' => 'users',



			'is_orderby'=>'yes',



			'folder_name'=>'',



			'action' => array()



			))
		</div>
	</div>
</div>
@stop

@push('scripts')



<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>


<script>

	$(document).ready(function() {

		$('#datatable_rows').DataTable({

			processing: true,
			serverSide: true,
			"dom": '<"top"if>rt<"bottom"lp><"clear">',
			searchable: true,

			scrollX: true,

			order: [0,false],

			ajax: "{{ route('user.index') }}",

			columns: [
			
			{
				orderable: true,

				searchable: true,

				"data": "first_name"

			},

			{
				orderable: true,

				searchable: true,

				"data": "role"

			},

			{
				orderable: true,

				searchable: true,

				"data": "email"

			},
			{
				orderable: true,

				searchable: true,

				"data": "singlecheckbox"

			},

			{

				orderable: false,

				searchable: false,

				data: 'action',

			},

			]

		});
	});
</script>

@endpush