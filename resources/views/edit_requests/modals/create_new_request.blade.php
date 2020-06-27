<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">إنشاء طلب تعديل </h4>
</div>
<div class="modal-body">
  	<form action="{{ url('DocumentEditRequest') }}" method="POST" id="create_edit_req_form_id">
  		@csrf
  		<input type="hidden" name="document_type" value="{{$document_type}}">
	    <div class="form-group" style="margin-top: 1%;">
	        <label>اسم الوثيقة</label>*
	        <input type="text" name="document_name" id="document_name" class="form-control" value="{{$documentFile->document_name}}" readonly="readonly">
	        <input type="hidden" name="document_id" id="document_id" class="form-control" value="{{$documentFile->id}}" >
	        <input type="hidden" name="document_type_id" id="document_type_id" class="form-control" value="{{$documentFile->doc_type_id}}" >
	    </div>
	    <div class="form-group" style="margin-top: 1%;">
	        <label>اسم الطلب</label>*
	        <input type="text" name="edit_request_name" id="edit_request_name" class="form-control" >
	    </div>
	    <div class="form-group" style="margin-top: 1%;">
	        <label>سبب التعديل</label>*
	        <textarea name="edit_request_reason" id="edit_request_reason"  class="form-control"></textarea>
	    </div>
	    @if($documentFile->doc_type_id == 5)
	    	<div class="form-group">
	            <label for="section_position">اختر الفقرة المراد تعديلها* </label>
	            <select class="form-control select2" style="width: 100%;" name="section_id" id='section_id'>
	              @isset($documentFile->document_sections)
	                @foreach ($documentFile->document_sections as $doc_sec)
	                    <option value="{{ $doc_sec->id }}" >{{ $doc_sec->section_order_id.' - '.strip_tags($doc_sec->section_title) }}</option>
	                @endforeach  
	              @endisset
	            </select>
	        </div>
		@endif
		    <div class="form-group" style="margin-top: 1%;">
		        <label>أماكن التعديل</label>*
		        <textarea name="edit_request_details" id="edit_request_details"  class="form-control"></textarea>
		    </div>
	    <input type="button" class="btn-primary" onclick="submitEditRequest()" value="حفظ">
  	</form>
</div>  
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">إغلاق</button>
</div>

