<div class="row" style="overflow-x: scroll;">
  <div class="col-xs-12" style="width: -moz-fit-content;min-width: 100%;">
    <div class="box" style=" width: 100%; ">
      <div class="box-header">
        <div class="row">
          <div class="col-md-10 pull-right" style="text-align: right;">
            <h3 class="box-title">إدارة الحلقات</h3>
          </div>
          <div class="col-md-2 pull-right">
              <button class="pull-right btn btn-info" onclick="view_create_course_modal()">إضافة حلقة جديدة<span class="fa fa-plus"></span></button>
          </div>  
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped" style=" width: 100%;text-align: right;direction: rtl; ">
          <thead>
          <tr>
            <th style="direction:rtl;text-align: right">#</th>
            <th style="direction:rtl;text-align: right">اسم الحلقة</th>
            <th style="direction:rtl;text-align: right">الاستاذ</th>
            <th style="direction:rtl;text-align: right">عدد الطلاب</th>
            <th style="direction:rtl;text-align: right">تاريخ الإنشاء</th>
            <th style="direction:rtl;text-align: right">العمليات</th>
          </tr>
          </thead>
          <tbody>
          <?php $i=1 ?>  
          @isset($courses)
            @foreach ($courses as $course)
              <tr>
                <td>{{$i++}}</td>
                <td style="direction:ltr">{{$course->class_name}}</td>
                <td style="direction:ltr">{{$course->teacher->teacher_name}}</td>
                <td style="direction:ltr">{{$course->students->count()}}</td>
                <td style="direction:ltr">{{$course->created_at}}</td>
                <td>
                  <a class="btn btn-info btn-flat" title="عرض طلاب الحلقة" href=""><i class="fa fa-info"></i></a>
                  <button type="button" class="btn btn-warning btn-flat" title=" تعديل " onclick="view_edit_course_modal({{$course->id}})"><i class="fa fa-edit"></i></button>
                  <form action="{{ url('courses/'.$course->id) }}" method="POST" style="display: contents;">
                    {{ method_field('DELETE') }}
                    @csrf
                    <button type="submit" class="btn btn-danger btn-flat delete" title="حذف الوثيقة"><i class="fa fa-trash-o"></i></button>
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
  function view_create_course_modal() {
    // body...
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(id) {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("modalBody").innerHTML = this.responseText;
        $('#example-modal').DataTable();
        $('.select2').select2();
        $('#modal-default').modal('show');
      }
    };
    xhttp.open("GET", "{{url('courses/create')}}" , true);
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
  function view_edit_course_modal(course_id){
    // body...
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(id) {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("modalBody").innerHTML = this.responseText;
        $('.select2').select2();
        $('#modal-default').modal('show');
      }
    };
    xhttp.open("GET", "{{url('courses')}}/"+course_id+"/edit" , true);
    xhttp.send(); 
  }
</script>