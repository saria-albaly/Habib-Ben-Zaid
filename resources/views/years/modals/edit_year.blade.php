<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">تعديل معلومات السنة</h4>
</div>
<div class="modal-body">
  	<form action="{{ url('years/'.$id) }}" method="POST" id="edit_year_form_id">
  		@csrf
  		<input type="hidden" name="_method" value="PUT">
  		<div class="form-group" style="margin-top: 1%;">
	        <label>السنة</label>*
	        <input type="number" min="2010" max="2099" step="1" value="{{ $year_name }}" class="form-control" id="year_name" name="year_name" />
	    </div>
<!-- 	    <div class="form-group" style="margin-top: 1%;">
	        <input type="checkbox" name="is_active" id="is_active" <?php if($is_active == true ) echo "checked"; ?> >
	        <label>تفعيل التسجيل لهذه السنة</label>
	    </div> -->
	    <input type="submit" name="submit" class="btn-primary" value="حفظ">
  	</form>
</div>  
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">إغلاق</button>
</div>
