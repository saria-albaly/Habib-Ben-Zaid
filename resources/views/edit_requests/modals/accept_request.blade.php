<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">قبول طلب التعديل</h4>
</div>
<div class="modal-body">
  		<label>معلومات الطلب</label>
  		<br>
  		<input type="hidden" name="id" value="{{ $editRequest->id }}">
	    <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th style="text-align: right;">#</th>
            <th style="text-align: right;">اسم الطلب</th>
            <th style="text-align: right;">تم الطلب من قبل</th>
            <th style="text-align: right;">سبب التعديل</th>
            <th style="text-align: right;">تفاصيل التعديل</th>
            <th style="text-align: right;">عنوان الوثيقة</th>
            <th style="text-align: right;">نوع الوثيقة</th>
          </tr>
          </thead>
          <tbody>
          <?php $i=1; ?>    
          @isset($editRequest)
              <tr>
                <td>{{$i++}}</td>
                <td>{{$editRequest->edit_request_name}}</td>
                <td>{{Auth::user()->name}}</td>
                <td>{{$editRequest->edit_request_reason}}</td>
                <td>{{$editRequest->edit_request_details}}</td>
                <td>{{$editRequest->document->document_name}}</td>
                <td>{{$editRequest->document->document_type->doc_type_name}}</td>
              </tr>
          @endisset 
          </tbody>
        </table>
        <div class="row" style="margin-left: 1%">
        	<div class="col-md-4 col-md-4 pull-right">
		    	<div class="form-group" style="direction: ltr;">
			        <label>فترة التعديل المتاحة </label>

			        <div class="input-group">
			          <div class="input-group-addon">
			            <i class="fa fa-clock-o"></i>
			          </div>
			          <input type="text" class="form-control pull-right" id="reservationtime" name="daterange" style="text-align: left;direction: ltr;">
			        </div>
			        <!-- /.input group -->
			    </div>
         	</div>
        </div>
        <div class="row" style="margin-left: 1%">
          <div class="col-md-6 pull-right">
            <div class="form-group">
              <label>اختر مسار الوثيقة</label>
              <div class="input-group margin">
                <select class="form-control select2" name="users" id="users_id" style="width: 100%;border-radius:0px">
                  @isset($users)
                      @foreach ($users as $user)
                          <option value="{{$user->id}}" > {{ $user->name }} </option>
                      @endforeach  
                    @endisset
                </select>
                <span class="input-group-btn">
                  <button class="btn btn-success btn-flat" onclick="addNewUser()">+</button>
                </span>  
              </div>  
            </div>
          </div>
        </div>
        <div class="row" style="margin-left: 1%;display: none" id="user_template">
          <div class="col-md-12 pull-right" id="user_user_id_dyn">
            <div class="input-group margin">
              <input type="text" name="nullname" disabled="" style="width: 100%;height: 34px;" value="user_name">
              <input type="hidden" name="userName[]" disabled="" style="width: 100%;height: 34px;" value="user_id_dyn_i">
              <span class="input-group-btn">
                <button class="btn btn-danger btn-flat delete" onclick="delete_CurrentUser('user_id_dyn')">-</button>
              </span>  
            </div> 
          </div>   
        </div>
        <div class="row" style="margin-left: 1%;" id="appendUsersHere">
          
        </div>
	    <button class="btn btn-info" onclick="acceptEditRequest({{$editRequest->id}})"> قبول الطلب  </button>
</div>  
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">إغلاق</button>
</div>

