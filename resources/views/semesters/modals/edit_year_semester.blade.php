<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">تعديل معلومات الفصل</h4>
</div>
<div class="modal-body">
  	<form action="{{ url('semesters/instance/'.$id) }}?id={{$id}}" method="POST" id="edit_year_form_id">
  		@csrf
  		<input type="hidden" name="_method" value="PUT">
  		<div class="form-group" style="margin-top: 1%;">
          <label>السنة</label><br>
          <select class="form-control select2" name="year_id" id="year_id" style="width: 100%;border-radius:0px">
        @isset($years)
            @foreach ($years as $year)
                <option value="{{$year->id}}" <?php if($year_id == $year->id) echo "selected" ?>> {{ $year->year_name }} </option>
            @endforeach  
          @endisset 
          </select>
      </div>
      <div class="form-group" style="margin-top: 1%;">
          <label>الفصل</label><br>
          <select class="form-control select2" name="semester_id" id="semester_id" style="width: 100%;border-radius:0px">
        @isset($semesters)
            @foreach ($semesters as $semester)
                <option value="{{$semester->id}}" <?php if($semester_id == $semester->id) echo "selected" ?>> {{ $semester->semester_name }} </option>
            @endforeach  
          @endisset 
          </select>
      </div>
      <div class="form-group" style="margin-top: 1%;">
          <label>تاريخ بدء الفصل</label>*
          <input type="date" class="form-control" name="startdate" value="{{$startdate}}" />
      </div>
      <div class="form-group" style="margin-top: 1%;">
          <label>تاريخ نهاية الفصل</label>*
          <input type="date" class="form-control" name="enddate" value="{{$enddate}}"/>
      </div>
      <div class="form-group" style="margin-top: 1%;">
          <label>عدد جلسات الفصل</label>*
          <input type="number" class="form-control" name="session_number" value="{{$session_number}}"  />
      </div>
	    <div class="form-group" style="margin-top: 1%;">
	        <input type="checkbox" name="is_active" id="is_active" <?php if($is_active == true ) echo "checked"; ?> >
	        <label>تفعيل التسجيل لهذ الفصل</label>
	    </div>
	    <input type="submit" name="submit" class="btn-primary" value="حفظ">
  	</form>
</div>  
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">إغلاق</button>
</div>
