<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">إنشاء وثيقة جديدة</h4>
</div>
<div class="modal-body">
  	<form action="{{ url('document/'.$document->id) }}" method="POST" id="edit_doc_form_id">
  		@csrf
  		<input type="hidden" name="_method" value="PUT">
  		<div class="form-group" style="margin-top: 1%;">
	        <label>اختر القسم التابع للوثيقة</label><br>
	        <select class="form-control select2" name="bank_dep_id" id="bank_dep_id" style="width: 100%;border-radius:0px">
				@isset($bank_deps)
			      @foreach ($bank_deps as $bank_dep)
	          		<option value="{{$bank_dep->id}}" <?php if($document->bnk_dep_id == $bank_dep->id ) echo "selected";?> > {{ $bank_dep->department_name }} </option>
			      @endforeach  
			    @endisset 
	        </select>
	    </div>
	    <div class="form-group" style="margin-top: 1%;">
	        <label>اسم الوثيقة</label>*
	        <input type="text" name="document_name" id="document_name" class="form-control" value="{{ $document->document_name }}">
	    </div>
	    <div class="form-group" style="margin-top: 1%;">
	        <label>توصيف الوثيقة </label>
	        <textarea name="document_desc" id="document_desc"  class="form-control">{{ $document->document_desc }}</textarea>
	    </div>
	    <div class="form-group" style="margin-top: 1%;">
	        <label>معلومات أخرى</label>*
	        <div class="row" style="margin-top: 1%;">
	        	<div class="col-md-4 pull-right">
		        	<label>تاريخ الإصدار</label>
		        	<input type="date" name="document_publishing_date" id="document_publishing_date" class="form-control" value="{{$document->publishing_date}}">
		        </div>
		        <div class="col-md-4">
		        	<label>رقم الوثيقة</label>
		        	<div class="row">
		        		<div class="col-md-7 pull-right">
		        			<input type="text" name="doc_num_prefix" id="doc_num_prefix" class="form-control" placeholder="QP-ITD" value="{{$document->doc_num_prefix}}">
		        		</div>
		        		<div class="col-md-1 pull-right" style="text-align: center;">
		        			<label>-</label>
		        		</div>
		        		<div class="col-md-4">
		        			<input type="number" name="doc_num" id="doc_num" class="form-control" value="{{$document->doc_num}}" min='0'>
		        		</div>
		        	</div>
		        </div>
		        <div class="col-md-4">
		        	<label>رقم الاصدار</label>
		        	<input type="number" name="doc_v" id="doc_v" class="form-control" value="{{$document->doc_v}}" min='0'>
		        </div>	
	        </div>
	        <div class="row" style="margin-top: 1%;">
	        	<div class="col-md-2 pull-right">
	        		<label>يتم زيادة رقم إصدار الوثيقة بعد قبول </label>
	        	</div>
	        	<div class="col-md-2 pull-right">
		        	<input type="number" name="document_inc_value" id="document_inc_value" class="form-control" value="{{$document->document_inc_value}}" min='1'>
	        	</div>
	        	<div class="col-md-4 pull-right">
	        		 <label>عملية تعديل</label>
	        	</div>
	        </div>
	    </div>
	    <input type="submit" name="submit" class="btn-primary" value="حفظ">
  	</form>
</div>  
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">إغلاق</button>
</div>
