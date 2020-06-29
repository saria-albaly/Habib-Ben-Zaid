<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">إضافة فصل جديد</h4>
</div>
<div class="modal-body">
  	<form action="{{ url('semesters/instance') }}" method="POST" enctype="multipart/form-data" id="create_doc_form_id">
  		@csrf
	    <div class="form-group" style="margin-top: 1%;">
	        <label>السنة</label><br>
	        <select class="form-control select2" name="year_id" id="year_id" style="width: 100%;border-radius:0px">
				@isset($years)
			      @foreach ($years as $year)
	          		<option value="{{$year->id}}" > {{ $year->year_name }} </option>
			      @endforeach  
			    @endisset 
	        </select>
	    </div>
	   	<div class="form-group" style="margin-top: 1%;">
	        <label>الفصل</label><br>
	        <select class="form-control select2" name="semester_id" id="semester_id" style="width: 100%;border-radius:0px">
				@isset($semesters)
			      @foreach ($semesters as $semester)
	          		<option value="{{$semester->id}}" > {{ $semester->semester_name }} </option>
			      @endforeach  
			    @endisset 
	        </select>
	    </div>
  		<div class="form-group" style="margin-top: 1%;">
	        <label>تاريخ بدء الفصل</label>*
	        <input type="date" class="form-control" name="startdate" />
	    </div>
	    <div class="form-group" style="margin-top: 1%;">
	        <label>تاريخ نهاية الفصل</label>*
	        <input type="date" class="form-control" name="enddate" />
	    </div>
	    <div class="form-group" style="margin-top: 1%;">
	        <label>عدد جلسات الفصل</label>*
	        <input type="number" class="form-control" name="session_number" />
	    </div>
	    <div class="form-group" style="margin-top: 1%;">
	        <input type="checkbox" name="is_active" id="is_active" >
	        <label>تفعيل التسجيل لهذ الفصل</label>
	    </div>
	    <input type="submit" name="submit" class="btn-primary" value="حفظ">
  	</form>
</div>  
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">إغلاق</button>
</div>
