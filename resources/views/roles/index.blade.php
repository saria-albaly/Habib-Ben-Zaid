<div class="row" style="overflow-x: scroll;">
  <div class="col-xs-12" style="width: -moz-fit-content;min-width: 100%;">
    <div class="box">
      <div class="box-header">
        <div class="row">
          <div class="col-md-10 pull-right" style="direction:rtl;text-align: right">
            <h3 class="box-title"> أدوار المستخدمين</h3>
          </div>
          <div class="col-md-2">
            @if(isset($grant['131']))
              <button class="pull-right btn btn-info" onclick="view_create_role_modal()"> إضافة دور مستخدم جديد <span class="fa fa-plus"></span></button>
            @endif  
          </div>  
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped" style=" width: 100%;direction:rtl;text-align: right">
          <thead>
          <tr>
            <th style="direction:rtl;text-align: right">#</th>
            <th style="direction:rtl;text-align: right">اسم الدور</th>
            <th style="direction:rtl;text-align: right">توصيف صلاحيات الدور</th>
            <th style="direction:rtl;text-align: right">العمليات</th>
          </tr>
          </thead>
          <tbody>
          <?php $i=1; ?>  
          @isset($roles)
            @foreach ($roles as $role)
              <tr>
                <td>{{$i++}}</td>
                <td style="direction:rtl">{{$role->name}}</td>
                <td style="direction:rtl">{{$role->description}}</td>
                <td>
                  <!-- <a type="button" class="btn btn-warning btn-flat" title="عرض الحسابات"><i class="fa fa-edit"></i></a> -->
                  <a type="button" class="btn btn-info btn-flat" title="عرض بيانات الدور" onclick="view_edit_role_modal({{$role->id}})"><i class="fa fa-eye"></i></a>
                  <form action="{{ url('roles/'.$role->id) }}" method="POST" style="display: contents;">
                    {{ method_field('DELETE') }}
                    @csrf
                    <button type="submit" class="btn btn-danger btn-flat delete" title="حذف الدور"><i class="fa fa-trash-o"></i></button>
                  </form>
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
  function view_create_role_modal() {
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
    xhttp.open("GET", "{{url('roles/create')}}" , true);
    xhttp.send(); 
  }

  function view_edit_role_modal(role_id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(id) {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("modalBody").innerHTML = this.responseText;
        $('.select2').select2()
        $('#modal-default').modal('show');
      }
    };
    xhttp.open("GET", "{{url('roles/')}}/"+role_id+"/edit" , true);
    xhttp.send(); 
  }
</script>

<script>
    $('.delete').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        if (confirm('Are you sure?')) {
            // Post the form
            $(e.target).closest('form').submit() // Post the surrounding form
        }
    });
</script>


<script type="text/javascript">
  $("body").on("click", "#submit", function (e) {
    alert("sss")
    e.preventDefault();//
    const department_name = document.getElementById("department_name").value;
    if(department_name.length < 1){
      error_modal('لا يمكنكم ترك حقل  اسم الوثيقة فارغا أو مكونا من الأحرف المميزة')
    }
    else{
      //get the action-url of the form
        var actionurl = e.currentTarget.action;
        //$(this).submit();
        var form = $('#create_role_form_id')[0];
        form.submit()
    }
  });
</script>