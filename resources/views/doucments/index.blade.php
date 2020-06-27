<div class="row" style="overflow-x: scroll;">
  <div class="col-xs-12" style="width: -moz-fit-content;min-width: 100%;">
    <div class="box" style=" width: 100%; ">
      <div class="box-header">
        <div class="row">
          <div class="col-md-10 pull-right" style="text-align: right;">
            <h3 class="box-title">السياسات والإجراءات</h3>
          </div>
          <div class="col-md-2 pull-right">
              <button class="pull-right btn btn-info" onclick="view_create_doc_modal()">إنشاء وثيقة جديدة <span class="fa fa-plus"></span></button>
          </div>  
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped" style=" width: 100%;text-align: right;direction: rtl; ">
          <thead>
          <tr>
            <th style="direction:rtl;text-align: right">#</th>
            <th style="direction:rtl;text-align: right">رقم الوثيقة</th>
            <th style="direction:rtl;text-align: right">اسم الإجراء</th>
            <th style="direction:rtl;text-align: right">توصيف الملف</th>
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
              @if(isset($privCons) && $privCons->count() > 0)
                <tr>
                  <td>{{$i++}}</td>
                  <td style="direction:ltr">{{$document->doc_num_prefix .'-'. $document->doc_num}}</td>
                  <td style="direction:rtl">{{$document->document_name}}</td>
                  <td style="direction:rtl">{{$document->document_desc}}</td>
                  <td>{{$document->bank_department->department_name}}</td>
                  <td>{{$document->publishing_date}}</td>
                  <td>{{$document->doc_v}}</td>
                  <td>{{$document->created_date}}</td>
                  <!-- <td>{{ Auth::user()->name }}</td> -->
                  <td>
                    @if($privCons->filter(function($r){return $r->action_name == 'view';})->count() > 0)
                    <a type="button" class="btn btn-primary btn-flat" title="عرض الفقرات " href="{{url('document/'.$document->id.'/paraghraphs')}}"><i class="fa fa-eye"></i></a>
                    @endif
                    @if($privCons->filter(function($r){return $r->action_name == 'create_new_section';})->count() > 0)
                    <a type="button" class="btn btn-info btn-flat" title="إنشاء فقرة جديدة" href="{{url('document/pure/'.$document->id.'/paraghraphs/create')}}"><i class="fa fa-plus"></i></a>
                    @endif
                    @if($privCons->filter(function($r){return $r->action_name == 'edit' && $r->array_section_ids==null;})->count() > 0)
                    <button type="button" class="btn btn-warning btn-flat" title=" تعديل " onclick="view_edit_document_modal({{$document->id}})"><i class="fa fa-edit"></i></button>
                    @endif

                    @if($privCons->filter(function($r){return $r->action_name == 'edit_request';})->count() > 0)
                    <button type="button" class="btn btn-success btn-flat" title="طلب تعديل " onclick="createEditRequest({{$document->id}},{{$document->doc_type_id}})"><i class="fa fa-ticket"></i></button>
                    @endif

                    @if($privCons->filter(function($r){return $r->action_name == 'download_pdf';})->count() > 0)
                    <a type="button" class="btn btn-info btn-flat" title="تحميل الملف"  href="{{url('test/download/'.$document->id)}}"><i class="fa fa-download"></i></a>
                    @endif

                    @if( ($privCons->filter(function($r){return $r->action_name == 'print';})->count() > 0) || ($privCons->filter(function($r){return $r->action_name == 'view';})->count() > 0))
                    <a type="button" class="btn btn-defualt btn-flat" title="طباعة الوثيقة " href="{{url('test/'.$document->id)}}" style="background-color: #aeaeb5;"><i class="fa fa-print" style="color: white;"></i></a>
                    @endif

                    @if($privCons->filter(function($r){return $r->action_name == 'delete' && $r->array_section_ids==null;})->count() > 0)
                      <form action="{{ url('document/'.$document->id) }}" method="POST" style="display: contents;">
                        {{ method_field('DELETE') }}
                        @csrf
                        <button type="submit" class="btn btn-danger btn-flat delete" title="حذف الوثيقة"><i class="fa fa-trash-o"></i></button>
                      </form>
                    @endif
                    @if( isset($grant['115']) && $grant['115'] || ($privCons->filter(function($r){return $r->action_name == 'priv' && $r->array_section_ids==null;})->count() > 0))
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
    xhttp.open("GET", "{{url('document/create?type=document')}}" , true);
    xhttp.send(); 
  }

  //
  const document_types = {}
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

  $("body").on("submit", "#create_doc_form_id", function (e) {
/*    e.preventDefault();//*/
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
        if(file_type != 'document'){
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
        //var actionurl = e.currentTarget.action;
        return true;
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
</script>


<script type="text/javascript">
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
            console.log(data)
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

  function submitEditRequest(){
      var document_id = document.getElementById('document_id').value;
      var edit_request_name = document.getElementById('edit_request_name').value;
      var edit_request_reason = document.getElementById('edit_request_reason').value;
      var edit_request_details = document.getElementById('edit_request_details').value;
      var edit_request_section = document.getElementById('section_id').value;
      // For section editions
      if(document_id &&  edit_request_name.length > 1 &&  edit_request_reason.length > 1 && edit_request_details.length > 1 && edit_request_section)
        document.getElementById("create_edit_req_form_id").submit();
      else{
        alert("يجب ملئ جميع الحقول")
        return false;
      }

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