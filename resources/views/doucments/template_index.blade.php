<div class="row" style="overflow-x: scroll;">
  <div class="col-xs-12" style="width: -moz-fit-content;min-width: 100%;">
    <div class="box" style=" width: 100%; ">
      <div class="box-header">
        <div class="row">
          <div class="col-md-10 pull-right" style="direction:rtl;text-align: right">
            <h3 class="box-title">النماذج</h3>
          </div>
          <div class="col-md-2">
            @if(isset($grant['79']))
              <button class="pull-right btn btn-info" onclick="view_create_doc_modal()">إنشاء وثيقة جديدة <span class="fa fa-plus"></span></button>
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
            <th style="direction:rtl;text-align: right">رقم الوثيقة</th>
            <th style="direction:rtl;text-align: right">اسم النموذج</th>
            <th style="direction:rtl;text-align: right">توصيف النموذج</th>
            <th style="direction:rtl;text-align: right">القسم التابع له</th>
            <th style="direction:rtl;text-align: right">تاريخ الإصدار</th>
            <th style="direction:rtl;text-align: right">رقم الإصدار</th>
            <th style="direction:rtl;text-align: right">تاريخ  الإنشاء</th>
            <!-- <th>Last Modified User</th> -->
            <th style="direction:rtl;text-align: right">العمليات</th>
          </tr>
          </thead>
          <tbody>
          <?php $i=1 ?>  
          @isset($documents)
            @foreach ($documents as $document)
              <?php $privCons = $document->document_priv_actions(); ?>
              @if($privCons->count() > 0)
                <tr>
                  <td>{{$i++}}</td>
                  <td style="direction:ltr">{{$document->doc_num_prefix .'-'. $document->doc_num}}</td>
                  <td>{{$document->document_name}}</td>
                  <td>{{$document->document_desc}}</td>
                  <td>{{$document->bank_department->department_name}}</td>
                  <td>{{$document->publishing_date}}</td>
                  <td>{{$document->doc_v}}</td>
                  <td>{{$document->created_date}}</td>
                  <!-- <td>{{Auth::user()->name}}</td> -->
                  <td>
                    @if($privCons->filter(function($r){return $r->action_name == 'edit' && $r->array_section_ids==null;})->count() > 0)
                      <button type="button" class="btn btn-warning btn-flat" title=" تعديل " onclick="view_edit_document_modal({{$document->id}})"><i class="fa fa-edit"></i></button>
                    @endif
                    
                    @if($privCons->filter(function($r){return $r->action_name == 'edit_request';})->count() > 0)
                      <!-- CREATE NEW EDIT REQUEST -->
                      @if( $document->view_edit_request_btn )
                        <button type="button" class="btn btn-success btn-flat" title="طلب تعديل " onclick="createEditRequest({{$document->id}},{{$document->doc_type_id}})"><i class="fa fa-ticket"></i></button>
                      @elseif( $document->otherUser )
                        <a type="button" class="btn btn-primary btn-flat" title="هناك طلب تعديل جاري" href=""><i class="fa fa-info"></i></a>
                      @endif   
                      
                      <!-- USER HAS A VALID EDIT REQUEST -->
                      @if($document->view_edit_request_btn_pending)
                        <form action="{{url('DocumentEditRequest')}}/1?document_id={{$document->id}}&ref=templates" method="POST" style="display: contents;">
                          {{ method_field('DELETE') }}
                          @csrf
                          <button type="submit" class="btn btn-danger btn-flat delete" title="إلغاء الطلب"><i class="fa fa-window-close"></i></button>
                        </form>
                      @endif
                    @endif
                    
                    @if($privCons->filter(function($r){return $r->action_name == 'download_doc';})->count() > 0)
                      <a type="button" class="btn btn-info btn-flat" title="تحميل الملف نسخة محررة"  href="{{url('document/edit_word/'.$document->id.'?type=document&pure=true')}}"><i class="fa fa-download"></i></a>
                    @endif

                    @if($privCons->filter(function($r){return $r->action_name == 'download_pdf';})->count() > 0)
                      <a type="button" class="btn btn-warning btn-flat" title="تحميل الملف نسخة غير قابلة للتعديل"  href="{{url('document/edit_word/'.$document->id.'?type=pdf')}}"><i class="fa fa-download"></i></a>
                    @endif

                    @if($privCons->filter(function($r){return $r->action_name == 'delete' && $r->array_section_ids==null;})->count() > 0)
                      <form action="{{ url('document/'.$document->id) }}" method="POST" style="display: contents;">
                        {{ method_field('DELETE') }}
                        @csrf
                        <button type="submit" class="btn btn-danger btn-flat delete" title="حذف الوثيقة"><i class="fa fa-trash-o"></i></button>
                      </form>
                    @endif

                    @if(isset($grant['115']) && $grant['115'] || ($privCons->filter(function($r){return $r->action_name == 'priv' && $r->array_section_ids==null;})->count() > 0))
                      <a type="button" class="btn btn btn-flat" title="تعديل الصلاحيات" style="background-color: #ff0060;" onclick="view_document_priv_modal({{$document->id}})"><i class="fa fa-key" style="color: white;"></i></a>
                    @endif
                  </td>
                </tr>
              @endif  
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
  function createEditRequest(documentID,DocType){
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
    xhttp.open("GET", "{{url('DocumentEditRequest/create?documentID')}}="+documentID+"&doc_type="+DocType , true);
    xhttp.send(); 
  }

  function view_create_doc_modal() {
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
    xhttp.open("GET", "{{url('document/create?type=template')}}" , true);
    xhttp.send(); 
  }

  //
  const document_types = <?php $tt = json_encode($document_types); echo $tt; ?>;
  const file_uploads = ['pdf','image','visio','sheet','document'];
  var current_allowed_types = null;
  function document_type_changed() {
    // body...
    v = document.getElementById("doc_type_id").value;
    for (var i = 0; i < document_types.length; i++) {
      if(document_types[i].id == v){
        document.getElementById("help_notes").innerHTML = "الملفات المسموح بها هي "+document_types[i].allowed_types
        document.getElementById("uploadedFile").accept = document_types[i].allowed_types
        current_allowed_types = document_types[i].doc_type_code;
        if(file_uploads.includes(document_types[i].doc_type_code)){
          document.getElementById("file_uploads").style.display = '';
          document.getElementById("web_editor_note").style.display = 'none';
        }
        else{
          if(document.getElementById("allow_file_upload_flag").checked)
            document.getElementById("file_uploads").style.display = '';
          else
            document.getElementById("file_uploads").style.display = 'none';
          document.getElementById("web_editor_note").style.display = '';
        }
        return;
      }
    }
    current_allowed_types = null;
    alert("لا يمكنكم اختيار هذا الحقل")
  }

  function upload_document_flag() {
    // body...
    document.getElementById("uploadedFile").accept = '.docx'
    if(document.getElementById("allow_file_upload_flag").checked)
      document.getElementById("file_uploads").style.display = '';
    else{
      document.getElementById("file_uploads").style.display = 'none';
      document.getElementById("uploadedFile").value = '';
    }
  }

  $("body").on("click", "#submit", function (e) {
    console.log(e);
    e.preventDefault();//
    var files = document.getElementById("uploadedFile").files;
    if(current_allowed_types == null){
      error_modal('لا يمكنك اختيار هذا النوع من الملفات')
      return
    }
    else{
      if(files.length == 1){
        var temp_type = files[0].type.split('/');
        var _file_type= temp_type[1].split('.');
        var file_type = _file_type.length > 0 ?  _file_type[_file_type.length-1] : _file_type;
        if(file_type != current_allowed_types){
          error_modal('لا يمكنك اختيار هذا النوع من الملفات')
          return;
        }
      }
      else if(files.length > 1) {
        error_modal('لا يمكنك اختيار أكثر من ملف')
        return;
      }
      else {
        if(document.getElementById("doc_type_id").value == '-1'){
            error_modal('يجب اختر نوع الوثيقة')
            return;
        }
        if(document.getElementById("allow_file_upload_flag").checked){
          error_modal('يجب اختيار ملف للرفع')
          return;
        }
      }
    }
    const document_name = document.getElementById("document_name").value;
    if(document_name.replace(/[&\/\\#, +()$~%.'":*?<>{}]/g, '').length < 1)
      error_modal('لا يمكنكم ترك حقل  اسم الوثيقة فارغا أو مكونا من الأحرف المميزة')
    else{
      //get the action-url of the form
        var actionurl = e.currentTarget.action;
        //$(this).submit();
        var form = $('#create_doc_form_id')[0];
        form.submit()

/*      var formData = new FormData();
          formData.append('file', $('#uploadedFile')[0].files[0]);
          formData.append('allow_file_upload_flag', $('#allow_file_upload_flag').val());
          formData.append('doc_type_id', $('#doc_type_id').val());
          formData.append('document_desc', $('#document_desc').val());
          formData.append('document_name', $('#document_name').val());
          formData.append('bank_dep_id', $('#bank_dep_id').val());*/
      //do your own request an handle the results
/*      $.ajax({
          url: actionurl,
          type: 'post',
          enctype: 'multipart/form-data',
          headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
          data: $("#create_doc_form_id").serialize(),
          processData: false,
          contentType: false,
          success: function(data) {
            success_modal('تمت العملية بنجاح'+"<br> جاري إعادة إنشاء الصفحة ",true)
          },
          error: function(response){
            const errorThrown = JSON.parse(response.responseText)
            console.log(errorThrown)
            console.log(errorThrown.status)
            console.log(errorThrown.status == 200)
            if(errorThrown.status == 200)
              success_modal('تمت العملية بنجاح'+"<br> جاري إعادة إنشاء الصفحة ",true)
            else
              error_modal('حدث خطأ أثناء إرسال الطلب' +'<br>'+errorThrown.message)
          }
      });*/
    }
  });
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
    function submitEditRequest(){
      var document_id = document.getElementById('document_id').value;
      var edit_request_name = document.getElementById('edit_request_name').value;
      var edit_request_reason = document.getElementById('edit_request_reason').value;
      var edit_request_details = document.getElementById('edit_request_details').value;
      console.log(document_id)
      console.log(edit_request_name)
      console.log(edit_request_details)
      console.log(edit_request_reason)
      if(document_id &&  edit_request_name.length > 1 &&  edit_request_reason.length > 1 && edit_request_details.length > 1 )
        document.getElementById("create_edit_req_form_id").submit();
      else
        alert("يجب ملئ جميع الحقول")
    }

</script>


<script type="text/javascript">
  function view_edit_document_modal(document_id){
    // body...
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(id) {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("modalBody").innerHTML = this.responseText;
        $('.select2').select2();
        $('#modal-default').modal('show');
      }
    };
    xhttp.open("GET", "{{url('document/')}}/"+document_id+"/edit" , true);
    xhttp.send(); 
  }

  function cancelEditRequest(document_id) {
    // body...
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(id) {
      if (this.readyState == 4 && this.status == 200) {
        success_modal('تمت العملية بنجاح'+"<br> جاري إعادة إنشاء الصفحة ",true)
      }
    };
    xhttp.open("DELETE", "{{url('DocumentEditRequest')}}/1/?document_id="+document_id , true);
    xhttp.send(); 
  }

    function view_document_priv_modal(document_id){
    // body...
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(id) {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("modalBody").innerHTML = this.responseText;
        $('.select2').select2()
        $('#modal-default').modal('show');
      }
    };
    xhttp.open("GET", "{{url('document/priv?type=document')}}&id="+document_id , true);
    xhttp.send(); 
  }


  function addNewPriv(document_id){
      /* get the action attribute from the <form action=""> element */
      var $form = $("#document_priv_form_id"),
          url = $form.attr( 'action' );
      var pending = true;     
      /* Send the data using post with element id name and name2*/
      var posting = $.post( url, { document_id:document_id, _token:$('#_token_id').val(), actions: $('#actions').val(), bank_deps: $('#bank_deps').val(), users: $('#users').val(), privs: $('#privs').val() , sections:$('#sections').val(), expire_date:$('#expire_date').val()} );

      /* Alerts the results */
      posting.done(function( data ) {
        //alert('success');
            if(data.status == 505){
              error_modal('تاريخ الانتهاء غير صالح');
            }
            else{
              success_modal('تمت إضافة الصلاحيات ');
              //priv_dep_table_body_to_append
              serverRes = data;
              var tableBody = document.getElementById("priv_dep_table_body_to_append");
              if(document.getElementById('priv_dep_table_body_to_append').lastElementChild)
                var LastID    = document.getElementById('priv_dep_table_body_to_append').lastElementChild.childElementCount + 1
              else
                var LastID    = 0
              for (var i = 0; i < serverRes.department.length; i++) {
                var newRow   = tableBody.insertRow();
                // Insert a cell in the row at index 0
                var newCell_0  = newRow.insertCell(0);
                var newText  = document.createTextNode(LastID+1);
                newCell_0.appendChild(newText)

                var newCell_1  = newRow.insertCell(1);
                var newText  = document.createTextNode(serverRes.department[i].department_name);
                newCell_1.appendChild(newText)
                
                var newCell_2  = newRow.insertCell(2);
                var newText  = document.createTextNode(serverRes.department[i].doc_name);
                newCell_2.appendChild(newText)

                var newCell_3  = newRow.insertCell(3);
                var newText  = document.createTextNode(serverRes.department[i].priv_name);
                newCell_3.appendChild(newText)

                var newCell_4  = newRow.insertCell(4);
                var newText  = document.createTextNode('لا يمكنكم الحذف الآن');
                newCell_4.appendChild(newText)
              }
              //USER
              var tableBody = document.getElementById("priv_user_table_body_to_append");
              if(document.getElementById('priv_user_table_body_to_append').lastElementChild)
                var LastID    = document.getElementById('priv_user_table_body_to_append').lastElementChild.childElementCount + 1
              else
                var LastID    = 1

              for (var i = 0; i < serverRes.user.length; i++) {
                var newRow   = tableBody.insertRow();
                // Insert a cell in the row at index 0
                var newCell_0  = newRow.insertCell(0);
                var newText  = document.createTextNode(LastID+1);
                newCell_0.appendChild(newText)

                var newCell_1  = newRow.insertCell(1);
                var newText  = document.createTextNode(serverRes.user[i].name);
                newCell_1.appendChild(newText)
                
                var newCell_2  = newRow.insertCell(2);
                var newText  = document.createTextNode(serverRes.user[i].doc_name);
                newCell_2.appendChild(newText)

                var newCell_3  = newRow.insertCell(3);
                var newText  = document.createTextNode(serverRes.user[i].priv_name);
                newCell_3.appendChild(newText)

                var newCell_4  = newRow.insertCell(4);
                var newText  = document.createTextNode('لا يمكنكم الحذف الآن');
                newCell_4.appendChild(newText)
              }
            pending = false;
        }
      });
  }
</script>
<script type="text/javascript">
  function deletePrivFromDoc(depAc_id,type){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(id) {
      if (this.readyState == 4 && this.status == 200) {
        var divToDelete = document.getElementById("priv_"+depAc_id+'_'+type);
        var row = divToDelete.parentNode;
        return row.removeChild(divToDelete);
      }
    };
    xhttp.open("GET", "{{ url('document/priv/delete') }}?type="+type+"&id="+depAc_id , true);
    xhttp.send(); 
  }
</script>