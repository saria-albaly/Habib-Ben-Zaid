<div class="row" style="overflow-x: scroll;">
  <div class="col-xs-12" style="width: -moz-fit-content;min-width: 100%;">
    <div class="box">
      <div class="box-header">
        <div class="row">
          <div class="col-md-10 pull-right" style="direction:rtl;text-align: right">
            <h3 class="box-title"> أدوار المستخدمين</h3>
          </div>
          <div class="col-md-2">
            <!-- <button class="pull-right btn btn-info" onclick="view_create_role_modal()"> إضافة  مستخدم جديد <span class="fa fa-plus"></span></button> -->
          </div>  
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped" style=" width: 100%;direction:rtl;text-align: right">
          <thead>
          <tr>
            <th style="direction:rtl;text-align: right">#</th>
            <th style="direction:rtl;text-align: right">اسم المستخدم</th>
            <th style="direction:rtl;text-align: right">البريد الالكتروني</th>
            <th style="direction:rtl;text-align: right">صلاحيات المستخدم</th>
            <th style="direction:rtl;text-align: right">العمليات</th>
          </tr>
          </thead>
          <tbody>
          <?php $i=1; ?>  
          @isset($users)
            @foreach ($users as $user)
              <tr>
                <td>{{$i++}}</td>
                <td style="direction:rtl">{{$user->name}}</td>
                <td style="direction:rtl">{{$user->email}}</td>
                @if(isset($user->role->name))
                  <td>{{$user->role->name}}</td>
                @else  
                  <td> Without Role </td>
                @endif  
                <td>
                  <!-- <a type="button" class="btn btn-warning btn-flat" title="عرض الحسابات"><i class="fa fa-edit"></i></a> -->
                  @if(isset($user->role->name))
                    <a type="button" class="btn btn-info btn-flat" title="عرض بيانات الدور" onclick="view_edit_user_modal({{$user->id}},{{$user->role->id}})"><i class="fa fa-eye"></i></a>
                  @endif
                    <a type="button" class="btn btn-warning btn-flat" title="تحديد الصلاحيات" onclick="view_create_user_role_modal({{$user->id}})"><i class="fa fa-key"></i></a> 
<!--                   <form action="{{ url('roles/'.$user->id) }}" method="POST" style="display: contents;">
                    {{ method_field('DELETE') }}
                    @csrf
                    <button type="submit" class="btn btn-danger btn-flat delete" title="حذف الوثيقة"><i class="fa fa-trash-o"></i></button>
                  </form> -->
                </td>
              </tr>
            @endforeach  
          @endisset 
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg" style="width: 80%;">
    <div class="modal-content" id="modalBody" style="direction: rtl;text-align: right;">

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
  function view_create_user_role_modal(user_id) {
    // body...
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(id) {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("modalBody").innerHTML = this.responseText;
        $('#example-modal').DataTable()
        $('.select2').select2()
        $('#modal-default').modal('show');
      }
    };
    xhttp.open("GET", "{{url('users/create')}}?user_id="+user_id , true);
    xhttp.send(); 
  }

  function view_edit_user_modal(user_id,role_id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(id) {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("modalBody").innerHTML = this.responseText;
        $('.select2').select2()
        $('#modal-default').modal('show');
      }
    };
    xhttp.open("GET", "{{url('roles/view_only')}}/"+role_id+"?user_id="+user_id , true);
    xhttp.send(); 
  }
</script>