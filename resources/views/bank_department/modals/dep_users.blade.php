<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">عرض مستخدمي القسم  - <strong> {{ $dep_users->department_name }}</strong></h4>
</div>
<div class="modal-body">
	<div class="row" style="margin: 1%;">
		<h5>إضافة مستخدم إلى القسم </h5>
		<div class="col-md-6 pull-right">
      <input type="hidden" id="_token__id" value="{{csrf_token()}}">
			<!-- <div class="form-group" style="margin-top: 1%;">
		        <label>ادخل اسم المستخدم</label>*
		        <div class="input-group">
			        <input id="user_name" class="form-control" autocomplete="on">
			        <span class="input-group-btn">
					    <button class="btn btn-success btn-flat delete" title="إضافة مستخدم جديد"><i class="fa fa-plus"></i></button>
					</span>
			    </div>    
		    </div> -->
      <div class="input-group ">
        <select class="form-control select2" name="add_users" id="add_users_id" style="width: 100%;border-radius:0px">
          @isset($users)
              @foreach ($users as $user)
                  <option value="{{$user->id}}" > {{ $user->name }} </option>
              @endforeach  
            @endisset
        </select>
        <span class="input-group-btn">
          <button class="btn btn-success btn-flat" onclick="addNewUser({{ $dep_users->id }})">+</button>
        </span>  
      </div>
		</div>
	</div>
  	<table id="modal_table_example" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>Employee Name</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody id="user_table_body_to_append">
          <?php $i=1; ?>  
          @isset($dep_users)
            @foreach ($dep_users->active_user as $user)
              <tr>
                <td>{{$i++}}</td>
                <td>{{$user->name}}</td>
                <td>
                	<form>
                		<input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token_{{$user->id}}_id">
                  		<button type="button" class="btn btn-danger btn-flat delete" title="حذف الحساب من القسم " id="dep_user_btn_{{$user->id}}" onclick="deleteUserFromDep('{{$user->id}}','{{$user->name}}','{{ $dep_users->department_name }}','{{ $dep_users->id }}')"><i class="fa fa-trash-o"></i></button>
                	</form>
                </td>
              </tr>
            @endforeach  
          @endisset 
          </tbody>
        </table>
</div>  
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">إغلاق</button>
</div>
