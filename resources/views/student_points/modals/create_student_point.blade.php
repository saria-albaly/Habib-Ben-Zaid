<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">إضافة فصل جديد</h4>
</div>
<div class="modal-body">
  	<form action="{{ url('semesters') }}" method="POST" enctype="multipart/form-data" id="create_doc_form_id">
  		@csrf
	    <div class="form-group" style="margin-top: 1%;">
	        <label>اسم الفصل</label>*
	        <input type="text" class="form-control" id="semester_name" name="semester_name" />
	    </div>
<!-- 	    <div class="form-group" style="margin-top: 1%;">
	        <input type="checkbox" name="is_active" id="is_active" >
	        <label>تفعيل التسجيل لهذ الفصل</label>
	    </div> -->
	    <input type="submit" name="submit" class="btn-primary" value="حفظ">
  	</form>
</div>  
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">إغلاق</button>
</div>
