<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">تعديل معلومات أستاذ</h4>
</div>
<div class="modal-body">
  	<form action="{{ url('teachers/'.$id) }}" method="POST" id="edit_teacher_form_id">
  		@csrf
  		<input type="hidden" name="_method" value="PUT">
  		<div class="form-group" style="margin-top: 1%;">
	        <label>الاسم</label>*
	        <input type="text" value="{{ $teacher_name }}" class="form-control" id="teacher_name" name="teacher_name" />
	    </div>
      <div class="form-group" style="margin-top: 1%;">
          <label>رقم الهاتف</label>*
          <input type="text" class="form-control" id="teacher_phone" name="teacher_phone" value="{{ $teacher_phone }}" />
      </div>
      <div class="form-group" style="margin-top: 1%;">
          <label>العنوان</label>*
          <input type="text" class="form-control" id="teacher_address" name="teacher_address" value="{{ $teacher_address }}" />
      </div>
	    <input type="submit" name="submit" class="btn-primary" value="حفظ">
  	</form>
</div>  
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">إغلاق</button>
</div>
