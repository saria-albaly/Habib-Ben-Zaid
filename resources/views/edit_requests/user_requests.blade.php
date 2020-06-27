<div class="row" style="overflow-x: scroll;">
  <div class="col-xs-12" style="width: -moz-fit-content;min-width: 100%;">
    <div class="box" style=" width: 100%; ">
      <div class="box-header">
        <div class="row">
          <div class="col-md-10 pull-right" style="direction:rtl;text-align: right">
            <h3 class="box-title">طلبات تعديل - النماذج والملفات</h3>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped" style=" width: 100%;direction:rtl;text-align: right">
          <thead>
          <tr>
            <th style="direction:rtl;text-align: right">#</th>
            <th style="direction:rtl;text-align: right">اسم الطلب</th>
            <th style="direction:rtl;text-align: right">سبب التعديل</th>
            <th style="direction:rtl;text-align: right">تفاصيل التعديل</th>
            <th style="direction:rtl;text-align: right">عنوان الملف</th>
            <th style="direction:rtl;text-align: right">نوع الملف</th>
            <th style="direction:rtl;text-align: right">تاريخ بدء التعديل</th>
            <th style="direction:rtl;text-align: right">تاريخ انتهاء التعديل</th>
            <th style="direction:rtl;text-align: right">الوقت المتبقي</th>
            <th style="direction:rtl;text-align: right">حالة الطلب</th>
            <th style="direction:rtl;text-align: right">العمليات</th>
          </tr>
          </thead>
          <tbody>
          <?php $i=1; ?>  
          @isset($editRequests)
            @foreach ($editRequests as $editReq)
              <?php
                $downloadUrl ="";
                $allowExt =".doc,.docx,document";
                if($editReq->document->doc_type_id == 1){
                  $downloadUrl = url('document/edit_word/'.$editReq->edit_request_doc_id.'?type=document&d_edit_req=true');
                  $allowExt = ".doc,.docx,msword,document";
                }
                else if(in_array($editReq->document->doc_type_id,[2 , 3 , 4 , 6])){
                  $downloadUrl = url('document/download/'.$editReq->document->id.'?d_edit_req=true');
                  $allowExt = $editReq->document->document_type->allowed_types; //".tif,.jpg,.gif,.png,.pdf,.xls,.xlsx,.vsdx,.jpeg";
                }
              ?>
              <tr>
                <td>{{$i++}}</td>
                <td>{{$editReq->edit_request_name}}</td>
                <td>{{$editReq->edit_request_reason}}</td>
                <td>{{$editReq->edit_request_details}}</td>
                <td>{{$editReq->document->document_name}}</td>
                <td>{{$editReq->document->document_type->doc_type_name}}</td>
                <td>{{$editReq->start_date}}</td>
                <td>{{$editReq->expire_date}}</td>
                <td style="text-align: right;direction: rtl;">
                  <?php 
                    $checkDates= true;
                    if(isset($editReq->expire_date)){
                      $date1 = new DateTime($editReq->start_date);
                      $date2 = new DateTime($editReq->expire_date);
                      $currentDate = new DateTime();
                      $currentDate->setTimeZone(new DateTimeZone('Asia/Damascus'));
                      $diff = $date2->diff($currentDate);
                      echo $diff->format('%a يوماً و %h ساعة');
                    }
                    else{
                      $checkDates= false;
                      if($editReq->request_status == 'pending')
                        echo "بانتظار الحصول على الموافقة" ;
                      if($editReq->request_status == 'cancelled')
                        echo "تم إلغاء الطلب" ;
                    }
                  ?>
                </td>
                <td>{{$editReq->request_status}}</td>
                <td id="btn_{{$editReq->id}}">
                @if($editReq->request_status == 'pending')
                    <form action="{{url('DocumentEditRequest')}}/1?ref=true&document_id={{$editReq->document->id}}" method="POST" style="display: contents;">
                      {{ method_field('DELETE') }}
                      @csrf
                      <button type="submit" class="btn btn-danger btn-flat delete" title="إلغاء الطلب"><i class="fa fa-window-close"></i></button>
                    </form>
                @endif
                @if($checkDates && (($currentDate >= $date1) && ($currentDate <= $date2)))
                  @if( ($editReq->request_status == 'accepted' || $editReq->request_status == 'ongoing' ) && $editReq->current_user_id==$editReq->request_user_id && Auth::user()->id==$editReq->request_user_id )
                    <!-- Allow to download protected version and upload new one -->
                    <a type="button" class="btn btn-warning btn-flat" title="تحميل الملف للتعديل " href="{{$downloadUrl}}"><i class="fa fa-pencil-square"></i></a>
                    @if($editReq->request_status == 'ongoing')
                      <br>
                      <form action="{{ url('DocumentEditRequest/'.$editReq->id.'/new_version') }}" method="POST" enctype="multipart/form-data" id="formuploadedFile_{{$editReq->id}}">
                        @csrf
                        <div class="row">
                          <div class="col-md-6">
                            <input type="hidden" id="allowedType_{{$editReq->id}}" value="{{$allowExt}}">
                            <input type="file" id="uploadedFile_{{$editReq->id}}" accept="{{$allowExt}}" name="file" >
                          </div>
                          <div class="col-md-6">
                            <input type="submit" name="uploadFile" class="btn btn-info submit" value="رفع النسخة المعدلة">
                          </div>
                        </div>
                      </form>
                    @endif
                  @endif
                  @if($editReq->request_status == 'ongoing' && $editReq->current_user_id!=$editReq->request_user_id && !$editReq->isLastNode && Auth::user()->id==$editReq->current_user_id )
                    <!-- Allow to download last edited version & accept or refused edition-->
                    <a type="button" class="btn btn-warning btn-flat" title="تحميل التعديلات"  href="{{ url('DocumentEditRequest/'.$editReq->id.'/new_version/'.$editReq->lastActions()->id) }}"><i class="fa fa-download"></i></a>
                      @if($editReq->document->doc_type_id == 1)
                        <a type="button" class="btn btn-info btn-flat" title="تحميل الملف نسخة غير قابلة للتعديل"  href="{{url('document/edit_word/'.$editReq->edit_request_doc_id.'?type=pdf')}}"><i class="fa fa-download"></i></a>
                      @else
                        <a type="button" class="btn btn-info btn-flat" title="تحميل النسخة الأصلية" href="{{url('document/download/'.$editReq->document->id)}}"><i class="fa fa-download"></i></a>  
                      @endif
                    <button type="button" class="btn btn-success btn-flat" title="قبول / رفض التعديلات"  onclick="view_edition_decision_modal('{{$editReq->id}}')"><i class="fa fa-code-fork"></i></button>
                    
                  @endif
                  @if($editReq->request_status == 'ongoing' && $editReq->current_user_id!=$editReq->request_user_id  && $editReq->isLastNode && Auth::user()->id==$editReq->current_user_id )
                    <!-- Allow to download last edited version upload accepted version & accept or refused edition-->
                    <a type="button" class="btn btn-warning btn-flat" title="تحميل التعديلات"  href="{{ url('DocumentEditRequest/'.$editReq->id.'/new_version/'.$editReq->lastActions()->id) }}"><i class="fa fa-download"></i></a>
                    <br>
                      <form action="{{ url('DocumentEditRequest/'.$editReq->id.'/last_version') }}" method="POST" enctype="multipart/form-data" id="formuploadedFile_{{$editReq->id}}">
                        @csrf
                        <div class="row">
                          <div class="col-md-6">
                            <input type="hidden" id="allowedType_{{$editReq->id}}" value="{{$allowExt}}">
                            <input type="file" id="uploadedFile_{{$editReq->id}}" accept="{{$allowExt}}" name="file" >
                          </div>
                          <div class="col-md-6">
                            <input type="submit" name="uploadFile" class="btn btn-info submit" value="رفع النسخة النهائية">
                          </div>
                        </div>
                      </form>
                  @endif
                @else
                  لا يمكنكم التعديل الآن  <br>
                @endif  
                  <a type="button" class="btn btn-info btn-flat" title="" href="{{ url('DocumentEditRequest/'.$editReq->id.'/viewrequestflow') }}"><i class="fa fa-sitemap"></i></a>
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
  function viewEditRequest(req_id) {
    // body...
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(id) {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("modalBody").innerHTML = this.responseText;
        $('#example-modal').DataTable();
        $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
        $('#modal-default').modal('show');

      }
    };
    xhttp.open("GET", "{{url('DocumentEditRequest')}}/"+req_id , true);
    xhttp.send(); 
  }

  function view_edition_decision_modal(req_id) {
    // body...
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(id) {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("modalBody").innerHTML = this.responseText;
        $('#modal-default').modal('show');

      }
    };
    xhttp.open("GET", "{{url('DocumentEditRequest/decision')}}/"+req_id , true);
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

    $('.submit').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        const textId = $(e.target).closest('form').attr('id')
        var id     = textId.replace('form','')
        var _id    = id.replace("uploadedFile_",'');
        var allowedType = document.getElementById("allowedType_"+_id).value.split(",");
        if (confirm('Are you sure?')) {
            // Post the form
            //$(e.target).closest('form').submit() // Post the surrounding form
            console.log(allowedType);
            var files = document.getElementById(id).files;
            if(files.length == 1){
              var temp_type = files[0].type.split('/');
              var _file_type= temp_type[1].split('.');
              var file_type = _file_type.length > 0 ?  _file_type[_file_type.length-1] : _file_type;
              console.log(file_type)
              if(!allowedType.includes(file_type) && !allowedType.includes("."+file_type)){
                error_modal('لا يمكنك اختيار هذا النوع من الملفات')
                return;
              }
              else{
                console.log("Sending")
                $(e.target).closest('form').submit()
              }
            }
            else if(files.length > 1) {
              error_modal('لا يمكنك اختيار أكثر من ملف')
              return;
            }
        }
    });
</script>

<script type="text/javascript" >
  function nextFlow(event,direction){
    event.preventDefault() // Don't post the form, unless confirmed
    const text = document.getElementById("edit_request_notes").value;
    console.log(text)
    if(direction == 0 && text.length <= 1)
      error_modal('لا يمكنكم ترك حقل الملاحظات فارغاً عند رفض الطلب')
    else if (confirm('Are you sure?')) {
        // Post the form
        document.getElementById("edit_request_next").value = direction;
        $(event.target).closest('form').submit() // Post the surrounding form
    }
  }
</script>