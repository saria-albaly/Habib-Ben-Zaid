<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">بيانات الدور</h4>
</div>
<div class="modal-body">
  	<form action="{{ url('roles') }}" method="POST" id="create_role_form_id">
  		@csrf
	    <div class="form-group" style="margin-top: 1%;">
	        <label>اسم الدور</label>*
	        <input type="text" name="name" id="name" class="form-control">
	    </div>
	    <div class="form-group" style="margin-top: 1%;">
	        <label> توصيف الدور</label>
	        <textarea name="description" id="description"  class="form-control"></textarea>
	    </div>
	    <div class="form-group">
	        <label>الصلاحيات</label>
	        <select class="form-control select2" multiple="multiple" data-placeholder="Select a Permission"
	                style="width: 100%;" name="permissions[]">
	          	@isset($permissions)
			      @foreach ($permissions as $permission)
	          		<option value="{{$permission->id}}" > {{ $permission->name }} </option>
			      @endforeach  
			    @endisset 
	        </select>
	      </div>
	      <!-- <div class="form-group">
	        <label>أقسام البنك المرتبطة بالدور </label>
	       	<label class="help-block">
              <input type="checkbox" class="flat-green" id="same_dep" name="same_dep" >
	          تنفيذ الصلاحيات من أجل جميع الوثائق التابعة لنفس القسم
	        </label>
	        <select class="form-control select2" multiple="multiple" data-placeholder="Select a Department"
	                style="width: 100%;" name="bank_department[]">
	          	@isset($departments)
			      @foreach ($departments as $dep)
	          		<option value="{{$dep->id}}" > {{ $dep->department_name }} </option>
			      @endforeach
			    @endisset 
	        </select>
	      </div> -->
	    <input type="submit" name="submit" class="btn-primary" value="حفظ">
  	</form>
</div>  
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">إغلاق</button>
</div>