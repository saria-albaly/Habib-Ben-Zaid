<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">إضافة طالب جديد</h4>
</div>
<div class="modal-body">
  	<form action="{{ url('student') }}" method="POST" enctype="multipart/form-data" id="create_student_form_id">
  		@csrf
	    <div class="form-group" style="margin-top: 1%;">
	        <label>اسم الطالب</label>*
	        <input type="text" class="form-control" id="student_name" name="student_name" />
	    </div>
	    <div class="form-group" style="margin-top: 1%;">
	        <label>اسم الأب</label>*
	        <input type="text" class="form-control" id="father_name" name="father_name" />
	    </div>
	    <div class="form-group" style="margin-top: 1%;">
	        <label>الهاتف</label>*
	        <input type="text" class="form-control" id="phone" name="phone" />
	    </div>
	   	<div class="form-group" style="margin-top: 1%;">
	        <label>العنوان</label>*
	        <input type="text" class="form-control" id="address" name="address" />
	    </div>
	   	<div class="form-group" style="margin-top: 1%;">
	        <label>الموهبة</label>
	        <input type="text" class="form-control" id="talents" name="talents" />
	    </div>
	   	<div class="form-group" style="margin-top: 1%;">
	        <label>عدد الإخوة</label>
	        <input type="text" class="form-control" id="brothers" name="brothers" />
	    </div>
	    <div class="form-group" style="margin-top: 1%;">
	        <label>الحلقة</label><br>
	        <select class="form-control select2" name="course_id" id="course_id" style="width: 100%;border-radius:0px">
				@isset($courses)
			      @foreach ($courses as $course)
	          		<option value="{{$course->id}}" > {{ $course->class_name }} </option>
			      @endforeach  
			    @endisset 
	        </select>
	    </div>
	   	<div class="row" id="file_uploads">
		    <div class="form-group" style="margin-top: 1%;margin-right: 1%;">
	          <label for="exampleInputFile">صورة الطالب</label>
	          <input type="file" id="uploadedFile" accept=".tif,.jpg,.gif,.png,.jpeg" name="file">
	        </div>
	    </div>
	    <input type="submit" name="submit" class="btn-primary" value="حفظ">
  	</form>
</div>  
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">إغلاق</button>
</div>