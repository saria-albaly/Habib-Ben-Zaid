<style type="text/css">
  .ui-autocomplete {
    position: absolute;
    z-index: 1000;
    cursor: default;
    padding: 0;
    list-style: none;
    background-color: #ffffff;
    border: 1px solid #ccc;
    padding: 0px 4px 0px 4px;
}
.ui-autocomplete > li {
  right: 0px;
  padding: 3px 20px;
}
.ui-autocomplete > li.ui-state-focus {
  background-color: #DDD;
}
.ui-helper-hidden-accessible {
  display: none;
}

</style>
<div class="row" style="overflow-x: scroll;">
  <div class="col-xs-12" style="width: -moz-fit-content;min-width: 100%;">
    <div class="box" style=" width: 100%; ">
      <div class="box-header">
        <div class="row">
          <div class="col-md-10 pull-right" style="text-align: right;">
            <h3 class="box-title">أخذ تسميعات الطالب</h3>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row" style="direction: rtl;text-align: right;">
          <div class="col-md-2 pull-right">        
            <div class="form-group" style="margin-top: 1%;">
                <label>رقم الطالب</label>
                <input type="text" name="student_id" id="student_id" class="form-control ui-autocomplete" autocomplete="off" >
            </div>
          </div>
          <div class="col-md-4 pull-right">        
            <div class="form-group" style="margin-top: 0.5%;margin-right: 2%">
                <label>اسم الطالب</label>
                <input type="text" name="student_name" id="student_name" class="form-control ui-autocomplete" autocomplete="off" >
            </div>
          </div>
          <div class="col-md-2 pull-right" style="margin-right: 4%">        
                <button class="btn btn-block btn-info" style="margin-top: 11%;" onclick="fetchUserInfo()"> بحث </button>
          </div>
        </div>
        <div class="row" style="direction: rtl;text-align: right;display: none;margin-top: 2%;" id="res_student_div" >
          <div class="col-md-2 pull-right">        
            <div class="form-group" style="margin-top: 1%;">
              <img src="../students/defualt.jpg" style="max-width: 250px;" id="res_student_image" />
            </div>
          </div>
          <div class="col-md-6 pull-right">        
            <div class="row">
              <div class="col-md-4 pull-right">
                <label>اسم الطالب</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <br>
                <label> اسم الأب</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <br>
                <label>رقم الهاتف</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <br>
                <label>معلومات الحلقة</label>&nbsp;: <br>
              </div>
              <div class="col-md-8 pull-right" style="margin-right: -20%;">
                <label id="res_student_name">لؤي الاسدي</label><br>
                <label id="res_student_father" >محمد</label><br>
                <label id="res_student_phone" >0115757398</label><br>
                <label id="res_student_classInfo" >0115757398</label><br>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 pull-right" > 
                <ul class='nav nav-pills' style="float: right;">
                  <li style="margin: 0 5px 0 5px"><a data-toggle='tab' href='#indirect' >تسميع مجموعة صفحات</a>
                  </li>
                  <li style="margin: 0 5px 0 5px" class="active"><a data-toggle='tab' href='#direct' >تسميع صفحة</a>
                  </li>
                </ul>
                <div class="tab-content" >
                  <div id='direct' class='tab-pane active' style="padding-top: 15%;">      
                      <button class="btn btn-block btn-success" onclick="registerStudentArrival('ontime',1)">تسجيل حضور ( على الوقت )</button>
                      <button class="btn btn-block btn-warning" onclick="registerStudentArrival('late',1)">تسجيل حضور (متأخر)</button>
                  </div>
                  <div id='indirect' class='tab-pane' style="padding-top: 15%;"> 
                      <div class="form-group">
                          <label>تاريخ ووقت وصول الطالب</label>
                          <input type="text" class="form-control float-right" id="student_arrival_time" name="student_arrival_time">
                      </div>    
                      <button class="btn btn-block btn-success" onclick="registerStudentArrival('ontime',0)">تسجيل حضور ( على الوقت )</button>
                      <button class="btn btn-block btn-warning" onclick="registerStudentArrival('late',0)">تسجيل حضور (متأخر)</button>
                  </div>
                </div>  
              </div>
            </div>           
          </div>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>

<div class="row" style="overflow-x: scroll;">
  <div class="col-xs-12" style="width: -moz-fit-content;min-width: 100%;">
    <div class="box" style=" width: 100%; ">
      <div class="box-header">
        <div class="row">
          <div class="col-md-10 pull-right" style="text-align: right;">
            <h3 class="box-title">جدول حضور الطلاب</h3>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped" style=" width: 100%;text-align: right;direction: rtl; ">
          <thead>
          <tr>
            <th style="direction:rtl;text-align: right">رقم الطالب</th>
            <th style="direction:rtl;text-align: right">اسم الطالب</th>
            <th style="direction:rtl;text-align: right">الحلقة</th>
            <th style="direction:rtl;text-align: right">تاريخ ووقت الحضور</th>
            <th style="direction:rtl;text-align: right">العمليات</th>
          </tr>
          </thead>
          <tbody id="refreshBodyTable">
          <?php $i=1 ?>  
          @isset($student_absence_array)
            @foreach ($student_absence_array as $absence_log)
              <tr>
                <td>{{$absence_log->student_id}}</td>
                <td style="direction:ltr">{{$absence_log->student->student_name}}</td>
                <td style="direction:ltr">{{$absence_log->course->class_name}}</td>
                <td style="direction:ltr">{{$absence_log->created_at}}</td>
                <td style="direction:ltr<?php if($absence_log->point->point_code == "ontime") echo ";color:green"; else echo ";color:red"; ?>" > {{$absence_log->point->point_name}}</td> 
                <td>
                  <form action="{{ url('/semester/absences/'.$absence_log->id) }}" method="POST" style="display: contents;" class="delete_form">
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

<script>
  $(document).ready(function() {  
    $('.delete_form').on('submit', function(e) {
      e.preventDefault();

      $.ajax({
          type: $(this).attr('method'),
          url: $(this).attr('action'),
          data: $(this).serialize(),
          success: function(data) {
            success_modal(data.message)
            refreshTable();
          }
      });
    });
  });
</script>

<script type="text/javascript">
  $(document).ready( function() {
    // Single Select
    $( "#student_id" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "{{url('student/find')}}",
        type: 'get',
        dataType: "json",
        data: {
         search: request.term,
         type : 'student_id'
        },
        success: function( data ) {
          if(data.length == 0){
            $("#res_student_div").hide();
            $('#student_name').val("لا يوجد نتائج بحث مطابقة");
          }
          else
            response( data );
        }
       });
      },
      select: function (event, ui) {
       // Set selection
        $('#student_id').val(ui.item.id); // display the selected text
        $('#student_name').val(ui.item.student_name); // display the selected text
        $("#res_student_div").show();
        $("#res_student_image").attr("src","../students/"+ui.item.student_image);
        $("#res_student_name").html(ui.item.student_name)
        $("#res_student_father").html(ui.item.father_name)
        $("#res_student_phone").html(ui.item.phone)
        $("#res_student_classInfo").html(ui.item.course.class_name)   
      
        return false;
      }
     });

     $( "#student_name" ).autocomplete({
        source: function( request, response ) {
         // Fetch data
         $.ajax({
          url: "{{url('student/find')}}",
          type: 'get',
          dataType: "json",
          data: {
           search: request.term,
           type : 'student_name'
          },
          success: function( data ) {
           response( data );
          }
         });
        },
        select: function (event, ui) {
         // Set selection
        $('#student_name').val(ui.item.student_name); // display the selected text
        $('#student_id').val(ui.item.id); // display the selected text
        $('#student_name').val(ui.item.student_name); // display the selected text
        $("#res_student_div").show();
        $("#res_student_image").attr("src","../students/"+ui.item.student_image);
        $("#res_student_name").html(ui.item.student_name)
        $("#res_student_father").html(ui.item.father_name)
        $("#res_student_phone").html(ui.item.phone)
        $("#res_student_classInfo").html(ui.item.course.class_name)   
         return false;
        }
       });
    })

  function split( val ) {
     return val.split( /,\s*/ );
  }
  function extractLast( term ) {
     return split( term ).pop();
  }

  function fetchUserInfo(){
    $.ajax({
      url: "{{url('student/find')}}",
      type: 'get',
      dataType: "json",
      data: {
       search1: $('#student_id').val(),
       search2: $('#student_name').val(),
       type  : 'all'
      },
      success: function( data ) {
        if(data.length == 0){
          $("#res_student_div").hide();
          error_modal("لا يوجد نتائج بحث مطابقة")
        }
        else{
          $('#student_name').val(data[0].student_name); // display the selected text
          $('#student_id').val(data[0].id); // display the selected text
          $('#student_name').val(data[0].student_name); // display the selected text
          $("#res_student_div").show();
          $("#res_student_image").attr("src","../students/"+data[0].student_image);
          $("#res_student_name").html(data[0].student_name)
          $("#res_student_father").html(data[0].father_name)
          $("#res_student_phone").html(data[0].phone)
          $("#res_student_classInfo").html(data[0].course.class_name)
        }
      }
     });
  }

  function registerStudentArrival(type, is_currentTimestamp){
    $.ajax({
      url: "{{url('/semester/absences')}}",
      type: 'post',
      dataType: "json",
      data: {
       student_id       : $('#student_id').val(),
       type             : type,
       now              : is_currentTimestamp,
       arrival_datetime : $('#student_arrival_time').val(),
      },
      success: function( data ) {
        if(data.error == true){
          //$("#res_student_div").hide();
          error_modal(data.message)
        }
        else{
          success_modal(data.message)
          refreshTable();
        }
      },
      error : function(data){
        error_modal("حدث خطا ما، تأكد من الاتصال بالشبكة وحاول مرة أخرى")
      }
     });
  }
</script>
<script type="text/javascript">
  function refreshTable(){
    $.ajax({
      url: "{{url('/semester/absences/refresh')}}",
      type: 'get',
      dataType: "html",
      data: {},
      success: function( template ) {
        document.getElementById("refreshBodyTable").innerHTML = template;       
        setTimeout($('#example1').DataTable({
          "oLanguage": {
            "sSearch": "_INPUT_ البحث",
            "sLengthMenu": "إظهار _MENU_ عنصر",
            "sZeroRecords": "لا يوجد عناصر",
            "oPaginate":{
              "sNext":"التالي",
              "sPrevious":"السابق"
            },
            "sInfo":"إظهار من _START_ حتى _END_ من بين _TOTAL_ عنصر",
            "sInfoFiltered": " (يوجد _TOTAL_ نتيجة بحث مطابقة من أصل _MAX_)",
            "sInfoEmpty":"",
            "sLoadingRecords": "جاري التحميل ...",
            "sProcessing":     "جاري المعالجة ...",
          }
        }), 700);
      },
      error : function(data){
        error_modal("حدث خطأ ما أثناء تحديث الجدول")
      }
     });
  }
</script>