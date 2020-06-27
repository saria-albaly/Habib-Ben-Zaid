<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">إنشاء وثيقة جديدة</h4>
</div>
<div class="modal-body">
  	<form action="{{ url('document') }}" method="POST" enctype="multipart/form-data" id="create_doc_form_id">
  		@csrf
  		<div class="form-group" style="margin-top: 1%;">
	        <label>اختر القسم التابع للوثيقة</label><br>
	        <select class="form-control select2" name="bank_dep_id" id="bank_dep_id" style="width: 100%;border-radius:0px">
				@isset($bank_deps)
			      @foreach ($bank_deps as $bank_dep)
	          		<option value="{{$bank_dep->id}}" > {{ $bank_dep->department_name }} </option>
			      @endforeach  
			    @endisset 
	        </select>
	    </div>
	    <div class="form-group" style="margin-top: 1%;">
	        <label>اسم الوثيقة</label>*
	        <input type="text" name="document_name" id="document_name" class="form-control">
	    </div>
	    <div class="form-group" style="margin-top: 1%;">
	        <label>توصيف الوثيقة </label>
	        <textarea name="document_desc" id="document_desc"  class="form-control"></textarea>
	    </div>
	    <div class="form-group" style="margin-top: 1%;">
	        <label>معلومات أخرى</label>*
	        <div class="row" style="margin-top: 1%;">
	        	<div class="col-md-4 pull-right">
		        	<label>تاريخ الإصدار</label>
		        	<input type="date" name="document_publishing_date" id="document_publishing_date" class="form-control">
		        </div>
		        <div class="col-md-4">
		        	<label>رقم الوثيقة</label>
		        	<div class="row">
		        		<div class="col-md-7 pull-right">
		        			<input type="text" name="doc_num_prefix" id="doc_num_prefix" class="form-control" placeholder="QP-ITD">
		        		</div>
		        		<div class="col-md-1 pull-right" style="text-align: center;">
		        			<label>-</label>
		        		</div>
		        		<div class="col-md-4">
		        			<input type="number" name="doc_num" id="doc_num" class="form-control" value="1" min='0'>
		        		</div>
		        	</div>
		        </div>
		        <div class="col-md-4">
		        	<label>رقم الاصدار</label>
		        	<input type="number" name="doc_v" id="doc_v" class="form-control" value="1" min='0'>
		        </div>	
	        </div>
	        <div class="row" style="margin-top: 1%;">
	        	<div class="col-md-2 pull-right">
	        		<label>يتم زيادة رقم إصدار الوثيقة بعد قبول </label>
	        	</div>
	        	<div class="col-md-2 pull-right">
		        	<input type="number" name="document_inc_value" id="document_inc_value" class="form-control" value="10" min='1'>
	        	</div>
	        	<div class="col-md-4 pull-right">
	        		 <label>عملية تعديل</label>
	        	</div>
	        </div>
	    </div>
	   	<div class="form-group" style="margin-top: 1%;">
	        <label>اختر نوع الوثيقة</label>*
	        <select class="form-control" name="doc_type_id" id="doc_type_id" onchange="document_type_changed();">
	        	<option value="-1" > اختر نوع الوثيقة </option>
				@isset($document_types)
			      @foreach ($document_types as $doc_type)
	          		<option value="{{$doc_type->id}}" > {{ $doc_type->doc_type_name }} </option>
			      @endforeach  
			    @endisset 
	        </select>
	    </div>
	    <div class="form-group" id="web_editor_note" style="display: none;">
	    	<label class="help-block">
              <input type="checkbox" class="flat-green" id="allow_file_upload_flag" name="allow_file_upload_flag" onclick="upload_document_flag();">
	          رفع ملف word ليتم فرز الملف إلى فقرات 
	        </label>
	    </div>
	    <div class="row" id="file_uploads" style="display: none">
		    <div class="form-group" style="margin-top: 1%;margin-right: 1%;">
	          <label for="exampleInputFile">قم برفع الملف</label>
	          <input type="file" id="uploadedFile" accept="" name="file">
	          <p class="help-block" id="help_notes"></p>
	        </div>
	    </div>
	    <input type="submit" name="submit" class="btn-primary" value="حفظ">
  	</form>
</div>  
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">إغلاق</button>
</div>
