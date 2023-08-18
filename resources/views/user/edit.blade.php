@php $edit = $data['edit']; @endphp
<div class="kt-portlet__body">
	<div class="row">
		<div class="form-group col-sm-3">
			<label>First Name</label>
			<input type="text" name="name" value="{{$edit->first_name}}" class="form-control" required>
		</div>
        <div class="form-group col-sm-3">
            <label>Last Name</label>
            <input type="text" name="name" value="{{$edit->last_name}}" class="form-control">
        </div>
		<div class="form-group col-sm-3">
			<label>Email</label>
			<input type="text" name="email" value="{{$edit->email}}" class="form-control" required>
		</div>
        <div class="form-group col-sm-3">
            <label>Number</label>
            <input type="text" name="number" value="{{$edit->number}}" class="form-control" >
        </div>
		<div class="form-group col-sm-3">
			<label>Role</label>
			<select class="form-control" required name="role">
				<option value="">Select</option>
				<option value="1" @if($edit->role == 1) selected @endif>Admin</option>
				<option value="2" @if($edit->role == 2) selected @endif>Employee</option>
			</select>
		</div>
		<div class="form-group col-sm-3">
			<label>Password</label>
			<input type="text" value="{{$edit->show_password}}" class="form-control" readonly >
		</div>
		<div class="form-group col-sm-3">
			<label>Change Password</label>
			<input type="text" name="password" class="form-control">
			<span>Enter only if you want to change your password</span>
		</div>
	</div>
</div>
