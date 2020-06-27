<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">إنشاء وثيقة جديدة</h4>
</div>
<div class="modal-body">
  	<form action="{{ url('document') }}" method="POST" enctype="multipart/form-data" id="create_doc_form_id">
  		@csrf
	    <div class="row" id="file_uploads">
		    <div class="form-group" style="margin-top: 1%;margin-right: 1%;">
	          <label for="exampleInputFile">قم برفع الملف</label>
	          <input type="file" id="uploadedFile" accept="" name="file">
	          <p class="help-block" id="help_notes"></p>
	        </div>
	    </div>
	    <input type="submit" name="submit" class="btn-warning" value="رفع النسخة الجديدة">
  	</form>
</div>  
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">إغلاق</button>
</div>
