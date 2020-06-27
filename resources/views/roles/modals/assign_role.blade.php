<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">تحديد دور وصلاحيات المستخدم</h4>
</div>
<div class="modal-body">
  	<form action="{{ url('users/assign_role') }}" method="POST">
  		@csrf
  		<input type="hidden" name="user_id" value="{{$user_id}}">
  		<div class="row" style="margin-top: 1%;">
  			<div class="col-md-6">
  				<label for="email">البريد الالكتروني</label><br>
  				<input type="text" value="{{$user->email}}" disabled="ture" id="email" style="width: 100%;">
  			</div>
  			<div class="col-md-6">
  				<label for="name">اسم المستخدم</label><br>
  				<input type="text" value="{{$user->name}}" disabled="ture" id="name" style="width: 100%;">
  			</div>
  		</div>
  		<div class="row" style="margin-top: 1%;">
  			<div class="col-md-12">
  				<label style="margin-bottom: 1%;">الأقسام التابع لها</label><br>
  				<div class="row">
	  				@isset($user->bank_department)
	  					@foreach ($user->bank_department as $dep)
	  						<div class="col-md-3 pull-right" style="margin-bottom: 1%;" >
	  							<input type="text" value="{{$dep->department_name}}" disabled="ture" id="name" style="width: 100%;">
	  						</div>
	  					@endforeach
	  				@endisset
  				</div>
  			</div>
  		</div>
	    <div class="form-group" style="margin-top: 1%;">
	        <label>اسم الدور</label>*
	        <select class="form-control select2" data-placeholder="Select a Role" style="width: 100%;" name="role_id">
	          	@isset($roles)
			      @foreach ($roles as $role)
	          		<option value="{{$role->id}}" <?php if($user->role_id == $role->id) echo "selected"; ?>> {{ $role->name }} </option>
			      @endforeach  
			    @endisset 
	        </select>
	    </div>
	    <input type="submit" name="submit" class="btn-primary" value="إسناد الصلاحية">
  	</form>
</div>  
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">إغلاق</button>
</div>