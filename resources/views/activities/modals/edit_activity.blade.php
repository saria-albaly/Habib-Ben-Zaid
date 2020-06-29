<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">تعديل معلومات النشاط</h4>
</div>
<div class="modal-body">
  	<form action="{{ url('activities/'.$id) }}" method="POST" id="edit_activity_form_id">
  		@csrf
  		<input type="hidden" name="_method" value="PUT">
  		<div class="form-group" style="margin-top: 1%;">
	        <label>اسم النشاط</label>*
	        <input type="text" value="{{ $activity_name }}" class="form-control" id="activity_name" name="activity_name" />
	    </div>
	    <input type="submit" name="submit" class="btn-primary" value="حفظ">
  	</form>
</div>  
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">إغلاق</button>
</div>
