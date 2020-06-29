<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">إضافة حلقة</h4>
</div>
<div class="modal-body">
  	<form action="{{ url('courses') }}" method="POST" enctype="multipart/form-data" id="create_doc_form_id">
  		@csrf
	    <div class="form-group" style="margin-top: 1%;">
	        <label>الاسم</label>*
	        <input type="text" class="form-control" id="class_name" name="class_name" />
	    </div>
	    <div class="form-group" style="margin-top: 1%;">
	        <label>اختر الأستاذ المسؤول عن الحلقة</label><br>
	        <select class="form-control select2" name="teacher_id" id="teacher_id" style="width: 100%;border-radius:0px">
				@isset($teachers)
			      @foreach ($teachers as $teacher)
	          		<option value="{{$teacher->id}}" > {{ $teacher->teacher_name }} </option>
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
