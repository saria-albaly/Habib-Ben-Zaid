<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">إضافة نشاط جديد</h4>
</div>
<div class="modal-body">
  	<form action="{{ url('activities') }}" method="POST" enctype="multipart/form-data" id="create_activity_form_id">
  		@csrf
	    <div class="form-group" style="margin-top: 1%;">
	        <label>اسم النشاط</label>*
	        <input type="text" class="form-control" id="activity_name" name="activity_name" />
	    </div>
	    <input type="submit" name="submit" class="btn-primary" value="حفظ">
  	</form>
</div>  
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">إغلاق</button>
</div>
