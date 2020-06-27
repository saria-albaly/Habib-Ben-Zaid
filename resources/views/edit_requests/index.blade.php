<div class="row" style="overflow-x: scroll;">
  <div class="col-xs-12" style="width: -moz-fit-content;min-width: 100%;">
    <div class="box" style=" width: 100%; ">
      <div class="box-header">
        <div class="row">
          <div class="col-md-10 pull-right" style="direction:rtl;text-align: right">
            <h3 class="box-title">طلبات التعديل</h3>
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
            <th style="direction:rtl;text-align: right">مرسل طلب التعديل</th>
            <th style="direction:rtl;text-align: right">سبب التعديل</th>
            <th style="direction:rtl;text-align: right">تفاصيل التعديل</th>
            <th style="direction:rtl;text-align: right">عنوان الوثيقة</th>
            <th style="direction:rtl;text-align: right">نوع الوثيقة</th>
            <th style="direction:rtl;text-align: right">تاريخ بدء التعديل</th>
            <th style="direction:rtl;text-align: right">تاريخ انتهاء التعديل</th>
            <th style="direction:rtl;text-align: right">حالة الطلب</th>
            <th style="direction:rtl;text-align: right">العمليات</th>
          </tr>
          </thead>
          <tbody>
          <?php $i=1; ?>  
          @isset($editRequests)
            @foreach ($editRequests as $editReq)
              <tr>
                <td>{{$i++}}</td>
                <td>{{$editReq->edit_request_name}}</td>
                <td>{{Auth::user()->name}}</td>
                <td>{{$editReq->edit_request_reason}}</td>
                <td>{{$editReq->edit_request_details}}</td>
                <td>{{$editReq->document->document_name}}</td>
                <td>{{$editReq->document->document_type->doc_type_name}}</td>
                <td>{{$editReq->start_date}}</td>
                <td>{{$editReq->expire_date}}</td>
                <td>{{$editReq->request_status}}</td>
                <td id="btn_{{$editReq->id}}">
                @if($editReq->request_status == 'pending')  
                  <button type="button" class="btn btn-success btn-flat" title="قبول طلب التعديل" onclick="viewEditRequest({{$editReq->id}})"><i class="fa fa-check"></i></button>
                  <button type="button" class="btn btn-warning btn-flat" title="رفض طلب التعديل" onclick="rejectEditRequest({{$editReq->id}},'{{$editReq->edit_request_name}}')"><i class="fa fa-ban"></i></button>
                @elseif($editReq->request_status == 'rejected')  
                  <button type="button" class="btn btn-success btn-flat" title="قبول طلب التعديل" onclick="viewEditRequest({{$editReq->id}})"><i class="fa fa-check"></i></button>
                @elseif($editReq->request_status == 'accepted') 
                  <button type="button" class="btn btn-warning btn-flat" title="رفض طلب التعديل" onclick="rejectEditRequest({{$editReq->id}},'{{$editReq->edit_request_name}}')"><i class="fa fa-ban"></i></button>
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
        $('.select2').select2()
        $('#modal-default').modal('show');

      }
    };
    xhttp.open("GET", "{{url('DocumentEditRequest')}}/"+req_id , true);
    xhttp.send(); 
  }

  function acceptEditRequest(req_id) {
    // body...
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(id) {
      if (this.readyState == 4 && this.status == 200) {
        const serverRes = JSON.parse(this.responseText);
        console.log(serverRes);
        if(serverRes.status_code == 200){
          $('#modal-default').modal('toggle');
          success_modal('تم قبول الطلب بنجاح ');
          btn = document.getElementById("btn_"+req_id);
          var row = btn.parentNode;
              row.parentNode.removeChild(row);
        }
        else{
          error_modal('فشلت عملية قبول الطلب  ')
        }
      }
    };
    const reservationtime = document.getElementById('reservationtime').value;
    var values = []
    $("input[name='userName[]']").each(function() {
      if($(this).val()!='user_id_dyn_i')
        values.push($(this).val());
    });
    if(values.length > 0){
      xhttp.open("GET", "{{url('DocumentEditRequest/accept')}}?id="+req_id+"&daterange="+reservationtime+"&users="+values , true);
      xhttp.send(); 
    }
    else
      alert('لا يمكنكم قبول الطلب بدون تحديد مسار الوثيقة')
  }

  function rejectEditRequest(req_id,req_name) {
    // body...
    modalConfirm("سيتم رفض طلب التعديل التالي: "+"<br>"+req_name, function(confirm){
      if(confirm){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(id) {
          if (this.readyState == 4 && this.status == 200) {
            const serverRes = JSON.parse(this.responseText);
            if(serverRes.status_code == 200){
              success_modal('تم رفض الطلب بنجاح ');

              btn = document.getElementById("btn_"+req_id);
              var row = btn.parentNode;
                return row.parentNode.removeChild(row);
            }
            else{
              return error_modal('فشلت عملية رفض الطلب  ')
            }
          }
        };
        xhttp.open("GET", "{{url('DocumentEditRequest/reject')}}?id="+req_id , true);
        xhttp.send(); 
      }
      else
        return 0;
    });
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
  var userFlow = [];
  var i = 0;
  function addNewUser(){
    i++;
    var e = document.getElementById("users_id");
    var strUser = e.options[e.selectedIndex].value;

    var templateOfUser = document.getElementById("user_template").innerHTML;
    var instanceOfUser = templateOfUser.split("user_id_dyn").join(strUser+"-"+i).replace(strUser+"-"+i+'_i',strUser);
    const divInnerHTML = instanceOfUser.replace("user_name",e.options[e.selectedIndex].text)
    $( "#appendUsersHere" ).append( divInnerHTML );
  }

  function delete_CurrentUser(myID){
    var divToDelete = document.getElementById("user_"+myID);
    var row = divToDelete.parentNode;
    return row.removeChild(divToDelete);
  }

</script>