<div class="row" style="overflow-x: scroll;">
  <div class="col-xs-12" style="width: -moz-fit-content;min-width: 100%;">
    <div class="box" style=" width: 100%; ">
      <div class="box-header">
        <div class="row">
          <div class="col-md-10 pull-right" style="text-align: right;">
            <h3 class="box-title">إدارة أسماء  الفصول</h3>
          </div>
          <div class="col-md-2 pull-right">
              <button class="pull-right btn btn-info" onclick="view_create_semester_modal()">إضافة  اسم فصل جديد<span class="fa fa-plus"></span></button>
          </div>  
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped" style=" width: 100%;text-align: right;direction: rtl; ">
          <thead>
          <tr>
            <th style="direction:rtl;text-align: right">#</th>
            <th style="direction:rtl;text-align: right">الفصل</th>
            <th style="direction:rtl;text-align: right">تاريخ الإنشاء</th>
            <th style="direction:rtl;text-align: right">العمليات</th>
          </tr>
          </thead>
          <tbody>
          <?php $i=1 ?>  
          @isset($semesters)
            @foreach ($semesters as $semester)
              <tr>
                <td>{{$i++}}</td>
                <td style="direction:ltr">{{$semester->semester_name}}</td>
                <td style="direction:ltr">{{$semester->created_at}}</td>
                <!-- <td style="direction:ltr"><?php if($semester->is_active) echo "مفعل "; else echo "غير مفعل"; ?></td> -->
                <td>
                  <button type="button" class="btn btn-warning btn-flat" title=" تعديل " onclick="view_edit_semester_modal({{$semester->id}})"><i class="fa fa-edit"></i></button>
                  <form action="{{ url('semesters/'.$semester->id) }}" method="POST" style="display: contents;">
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

<div class="row" style="overflow-x: scroll;">
  <div class="col-xs-12" style="width: -moz-fit-content;min-width: 100%;">
    <div class="box" style=" width: 100%; ">
      <div class="box-header">
        <div class="row">
          <div class="col-md-10 pull-right" style="text-align: right;">
            <h3 class="box-title">إدارة الفصول</h3>
          </div>
          <div class="col-md-2 pull-right">
              <button class="pull-right btn btn-info" onclick="view_create_year_semester_modal()">إضافة فصل جديد<span class="fa fa-plus"></span></button>
          </div>  
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example2" class="table table-bordered table-striped" style=" width: 100%;text-align: right;direction: rtl; ">
          <thead>
          <tr>
            <th style="direction:rtl;text-align: right">#</th>
            <th style="direction:rtl;text-align: right">العام</th>
            <th style="direction:rtl;text-align: right">الفصل</th>
            <th style="direction:rtl;text-align: right">تاريخ بدء الفصل</th>
            <th style="direction:rtl;text-align: right">تاريخ انتهاء الفصل</th>
            <th style="direction:rtl;text-align: right">عدد جلسات الفصل</th>
            <th style="direction:rtl;text-align: right">تاريخ الإنشاء</th>
            <th style="direction:rtl;text-align: right">حالة الفصل</th>
            <th style="direction:rtl;text-align: right">العمليات</th>
          </tr>
          </thead>
          <tbody>
          <?php $i=1 ?>  
          @isset($semester_years)
            @foreach ($semester_years as $s_y)
              <tr>
                <td>{{$i++}}</td>
                <td style="direction:ltr">{{$s_y->year->year_name}}</td>
                <td style="direction:ltr">{{$s_y->semester->semester_name}}</td>
                <td style="direction:ltr">{{$s_y->startdate}}</td>
                <td style="direction:ltr">{{$s_y->enddate}}</td>
                <td style="direction:ltr">{{$s_y->session_number}}</td>
                <td style="direction:ltr">{{$s_y->created_at}}</td>
                <td style="direction:ltr"><?php if($s_y->is_active) echo "مفعل "; else echo "غير مفعل"; ?></td>
                <td>
                  <button type="button" class="btn btn-warning btn-flat" title=" تعديل " onclick="view_edit_year_semester_modal({{$s_y->id}})"><i class="fa fa-edit"></i></button>
                  <form action="{{ url('semesters/instance/'.$s_y->id) }}?id={{$s_y->id}}" method="POST" style="display: contents;">
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
  function view_create_semester_modal() {
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
    xhttp.open("GET", "{{url('semesters/create')}}" , true);
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
  function view_edit_semester_modal(semester_id){
    // body...
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(id) {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("modalBody").innerHTML = this.responseText;
        $('.select2').select2();
        $('#modal-default').modal('show');
      }
    };
    xhttp.open("GET", "{{url('semesters')}}/"+semester_id+"/edit" , true);
    xhttp.send(); 
  }
</script>

<script type="text/javascript">
  function view_create_year_semester_modal() {
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
    xhttp.open("GET", "{{url('semesters/instance/create')}}" , true);
    xhttp.send(); 
  }
</script>
<script type="text/javascript">
  function view_edit_year_semester_modal(semester_id){
    // body...
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(id) {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("modalBody").innerHTML = this.responseText;
        $('.select2').select2();
        $('#modal-default').modal('show');
      }
    };
    xhttp.open("GET", "{{url('semesters/instance')}}/"+semester_id+"/edit?id="+semester_id , true);
    xhttp.send(); 
  }
</script>