<style type="text/css">
	.select2-selection__choice{
		background-color:#00c0ef !important;
	}
</style>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">بيانات الدور</h4>
</div>
<div class="modal-body">
  	<form action="{{ url('roles/'.$role->id) }}" method="POST" id="create_role_form_id">
  		@csrf
  		<input type="hidden" name="_method" value="PUT">
	    <div class="form-group" style="margin-top: 1%;">
	        <label>اسم الدور</label>*
	        <input type="text" name="name" id="name" class="form-control" value="{{$role->name}}" <?php if(isset($disabled)) echo "disabled"; ?>>
	    </div>
	    <div class="form-group" style="margin-top: 1%;">
	        <label> توصيف الدور</label>
	        <textarea name="description" id="description"  class="form-control" <?php if(isset($disabled)) echo "disabled"; ?>>{{$role->description}}</textarea>
	    </div>
	    <div class="form-group">
	        <label>الصلاحيات</label>
	        <select class="form-control select2" multiple="multiple" data-placeholder="Select a State"
	                style="width: 100%;" name="permissions[]" <?php if(isset($disabled)) echo "disabled"; ?>>
	          	@isset($permissions)
			      @foreach ($permissions as $permission)
	          		<option value="{{$permission->id}}" <?php if(in_array($permission->id, $role_permissions)) echo "selected";?>> {{ $permission->name }} </option>
			      @endforeach  
			    @endisset 
	        </select>
	      </div>
	      <div class="form-group" style="display: none">
	        <label>أقسام البنك المرتبطة بالدور </label>
	       	<label class="help-block">
              <input type="checkbox" class="flat-green" id="same_dep" name="same_dep" <?php if($role->same_dep == true) echo "checked";?>>
	          تنفيذ الصلاحيات من أجل جميع الوثائق التابعة لنفس القسم
	        </label>
	        <select class="form-control select2" multiple="multiple" data-placeholder="Select a State"
	                style="width: 100%;" name="bank_department[]">
	          	@isset($departments)
			      @foreach ($departments as $dep)
	          		<option value="{{$dep->id}}" <?php if(in_array($dep->id, $role_bank_dep)) echo "selected";?>> {{ $dep->department_name }} </option>
			      @endforeach
			    @endisset 
	        </select>
	      </div>
	      @if(!isset($disabled))
	    	<input type="submit" name="submit" class="btn-primary" value="حفظ">
	      @endisset
  	</form>
</div>  

<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">إغلاق</button>
</div>