<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">إضافة سنة جديدة</h4>
</div>
<div class="modal-body">
  	<form action="{{ url('years') }}" method="POST" enctype="multipart/form-data" id="create_doc_form_id">
  		@csrf
	    <div class="form-group" style="margin-top: 1%;">
	        <label>السنة</label>*
	        <input type="number" min="2010" max="2099" step="1" value="{{ date('Y') }}" class="form-control" id="year_name" name="year_name" />
	    </div>
<!-- 	    <div class="form-group" style="margin-top: 1%;">
	        <input type="checkbox" name="is_active" id="is_active" >
	        <label>تفعيل التسجيل لهذه السنة</label>
	    </div> -->
	    <input type="submit" name="submit" class="btn-primary" value="حفظ">
  	</form>
</div>  
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">إغلاق</button>
</div>
