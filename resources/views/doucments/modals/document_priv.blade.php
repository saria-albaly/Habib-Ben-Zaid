<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">صلاحيات الوصول إلى الوثيقة</h4>
</div>
<div class="modal-body">
	<div class="row" style="text-align: right;direction: rtl;">
		<form action="{{ url('document/priv?type=document') }}" method="POST" id="document_priv_form_id">
			<input type="hidden" id="_token_id" name="_token" value="{{csrf_token()}}">
				<div class="col-md-4">
					@if(isset($isPolicies) && $isPolicies)
					    <div class="form-group">
					        <label>اختر فقرات محددة من الوثيقة</label>
					        <select class="form-control select2" multiple="multiple" data-placeholder=""
					                style="width: 100%;" name="sections[]" id="sections">
					          	@isset($sections)
							      @foreach ($sections as $section)
					          		<option value="{{$section->id}}"> {{strip_tags($section->section_title) }} </option>
							      @endforeach  
							    @endisset 
					        </select>
					    </div>
					@endif	
		 			<div class="row" style="margin-right: 0%;margin-top: 8%;">
						<!-- <button class="btn btn-info" onclick="addNewPriv({{$document_id}})">إضافة الصلاحية</button> -->
						<input type="button" name="" class="btn btn-info" onclick="addNewPriv({{$document_id}})" value="إضافة الصلاحية">
					</div>
				</div>

			<div class="col-md-4">
				<div class="row">
					<div class="form-group">
				        <label>أقسام البنك</label>
				        <select class="form-control select2" multiple="multiple" data-placeholder=""
				                style="width: 100%;" name="bank_deps[]" id="bank_deps">
				          	@isset($bank_deps)
						      @foreach ($bank_deps as $bank_dep)
				          		<option value="{{$bank_dep->id}}"> {{ $bank_dep->department_name }} </option>
						      @endforeach  
						    @endisset 
				        </select>
				    </div>
				</div>
				<div class="row"> 
				    <div class="form-group">
				        <label>المستخدمين</label>
				        <select class="form-control select2" multiple="multiple" data-placeholder=""
				                style="width: 100%;" name="users[]" id="users">
				          	@isset($users)
						      @foreach ($users as $user)
				          		<option value="{{$user->id}}"> {{ $user->name }} </option>
						      @endforeach  
						    @endisset 
				        </select>
				    </div>
				</div>    
			</div>
			<div class="col-md-4">
			    <div class="form-group">
			        <label>اختر الصلاحيات</label>
			        <select class="form-control select2" multiple="multiple" data-placeholder=""
			                style="width: 100%;" name="privs[]" id="privs">
			          	@isset($actions)
					      @foreach ($actions as $action)
			          		<option value="{{$action->id}}"> {{ $action->action_arabic_name }} </option>
					      @endforeach  
					    @endisset 
			        </select>
			    </div>
			</div>
			<div class="col-md-4">
			    <div class="form-group">
			        <label>تاريخ انتهاء الصلاحية</label>
			        <input type="date" class="form-control" id="expire_date" name="expire_date" style="background-color:white;border:1px solid #aaa;border-radius:4px;cursor:text">
			        <label style="color: #c40505c9;margin: 1%;font-size: 12px;text-decoration-line: underline;">ترك حقل تاريخ انتهاء الصلاحية فارغاً يعطي الصلاحيات بشكل دائم</label>
			    </div>
			</div>
		</form>	
	</div>
	<div class="row" style="padding: 10px;">
		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#fa-icons" data-toggle="tab">صلاحيات الأقسام</a></li>
              <li><a href="#glyphicons" data-toggle="tab">صلاحيات المستخدمين</a></li>
            </ul>
            <div class="tab-content">
              <!-- Font Awesome Icons -->
              <div class="tab-pane active" id="fa-icons">
      		  	<table id="modal_table_example_1" class="table table-bordered table-striped">
		          <thead>
		          <tr>
		            <th style="direction: rtl;text-align: right;">#</th>
		            <th style="direction: rtl;text-align: right;">اسم القسم </th>
		            <th style="direction: rtl;text-align: right;">فقرات الوثيقة</th>
		            <th style="direction: rtl;text-align: right;">الصلاحية</th>
		            <th style="direction: rtl;text-align: right;">العمليات</th>
		          </tr>
		          </thead>
		          <tbody id="priv_dep_table_body_to_append">
		          <?php $i=1; ?>	
		          @isset($department_actions)
		            @foreach ($department_actions as $department_action)
		              <tr id="priv_{{$department_action->id}}_1">
		              	<td>{{$i++}}</td>
		                <td>{{$department_action->bank_department()->first()->department_name}}</td>
		                <td style="width: 50%;"><?php 
		                		if(isset($department_action->array_section_ids)){
		                			$arrayOfSections = $department_action->sections($department_action->id)->get(); 
		                			foreach ($arrayOfSections as $row) {
		                				# code...
		                				echo "<a href='".url('document/'.$document_id.'/paraghraphs/'.$row->id)."'>".strip_tags($row->section_title)."</a> , ";
		                			}
		                		}
		                		else 
		                			echo "جميع المستند"; 
		                		?>
		                </td>
		                @if($department_action->expire_date == null)
		                	<td>{{$department_action->document_action()->first()->action_arabic_name}} <span style="text-decoration-line: underline;color: green;"> بشكل دائم </span></td>
		                @else 
		                	<td>{{$department_action->document_action()->first()->action_arabic_name}} <span style="text-decoration-line: underline;color: orange;">حتى تاريخ {{date('Y-m-d', strtotime($department_action->expire_date))}}</span></td>
		                @endif	
		                <td>
		                	<form>
		                		<input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token_{{$user->id}}_id">
		                  		<button type="button" class="btn btn-danger btn-flat delete" title="حذف الصلاحية" id="dep_user_btn_{{$user->id}}" onclick="deletePrivFromDoc('{{$department_action->id}}',1)"><i class="fa fa-trash-o"></i></button>
		                	</form>
		                </td>
		              </tr>
		            @endforeach  
		          @endisset 
		          </tbody>
		        </table>
              </div>
              <!-- /#fa-icons -->

              <!-- glyphicons-->
              <div class="tab-pane" id="glyphicons">
      		  	<table id="modal_table_example_2" class="table table-bordered table-striped">
		          <thead>
		          <tr>
		            <th style="direction: rtl;text-align: right;">#</th>
		            <th style="direction: rtl;text-align: right;">اسم المستخدم </th>
		            <th style="direction: rtl;text-align: right;">فقرات الوثيقة</th>
		            <th style="direction: rtl;text-align: right;">الصلاحية</th>
		            <th style="direction: rtl;text-align: right;">العمليات</th>
		          </tr>
		          </thead>
		          <tbody id="priv_user_table_body_to_append">
		          <?php $i=1; ?>	
		          @isset($user_actions)
		            @foreach ($user_actions as $user_action)
		              <tr id="priv_{{$user_action->id}}_0">
		              	<td>{{$i++}}</td>
		                <td>{{$user_action->user()->first()->name}}</td>
		                <td style="width: 50%;"><?php 
		                		if(isset($user_action->array_section_ids)){
		                			$arrayOfSections = $user_action->sections($user_action->id)->get(); 
		                			foreach ($arrayOfSections as $row) {
		                				# code...
		                				echo "<a href='".url('document/'.$document_id.'/paraghraphs/'.$row->id)."'>".strip_tags($row->section_title)."</a> , ";
		                			}
		                		}
		                		else 
		                			echo "جميع المستند"; 
		                		?>
		                </td>
		                @if($user_action->expire_date == null)
		                	<td>{{$user_action->document_action()->first()->action_arabic_name}} <span style="text-decoration-line: underline;color: green;">بشكل دائم </span></td>
		                @else 
		                	<td>{{$user_action->document_action()->first()->action_arabic_name}} <span style="text-decoration-line: underline;color: orange;">حتى تاريخ {{date('Y-m-d', strtotime($user_action->expire_date))}}</span></td>
		                @endif	
		                <td>
		                	<form>
		                		<input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token_{{$user->id}}_id">
		                  		<button type="button" class="btn btn-danger btn-flat delete" title="حذف الصلاحية" id="dep_user_btn_{{$user->id}}" onclick="deletePrivFromDoc('{{$user_action->id}}',0)"><i class="fa fa-trash-o"></i></button>
		                	</form>
		                </td>
		              </tr>
		            @endforeach  
		          @endisset 
		          </tbody>
		        </table>
                
              </div>
              <!-- /#ion-icons -->

            </div>
            <!-- /.tab-content -->
        </div>
    </div>
</div>  

<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">إغلاق</button>
</div>