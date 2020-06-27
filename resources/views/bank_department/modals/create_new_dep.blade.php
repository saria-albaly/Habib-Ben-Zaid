<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">إنشاء قسم جديد</h4>
</div>
<div class="modal-body">
  	<form action="{{ url('BankDepartment') }}" method="POST" id="create_dep_form_id">
  		@csrf
	    <div class="form-group" style="margin-top: 1%;">
	        <label>اسم القسم</label>*
	        <input type="text" name="department_name" id="department_name" class="form-control">
	    </div>
	    <div class="form-group" style="margin-top: 1%;">
	        <label>توصيف القسم أو إضافة ملاحظة </label>
	        <textarea name="department_description" id="department_description"  class="form-control"></textarea>
	    </div>

	    <div class="form-group">
	        <label>اختر المستخدمين المرتبطين بهذا القسم </label>
	        <select class="form-control select2" multiple="multiple" data-placeholder="Select a User"
	                style="width: 100%;" name="users[]">
	          	@isset($users)
			      @foreach ($users as $user)
	          		<option value="{{$user->id}}" > {{ $user->name }} </option>
			      @endforeach
			    @endisset 
	        </select>
	      </div>

	    <input type="submit" name="submit" class="btn-primary" value="حفظ">
  	</form>
</div>  
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">إغلاق</button>
</div>
