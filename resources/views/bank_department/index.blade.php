<div class="row" style="overflow-x: scroll;">
  <div class="col-xs-12" style="width: -moz-fit-content;min-width: 100%;">
    <div class="box">
      <div class="box-header">
        <div class="row">
          <div class="col-md-10 pull-right" style="direction:rtl;text-align: right">
            <h3 class="box-title">أقسام البنك</h3>
          </div>
          <div class="col-md-2">
            @if(isset($grant['87']))
              <button class="pull-right btn btn-info" onclick="view_create_dep_modal()">إضافة قسم جديد<span class="fa fa-plus"></span></button>
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
            <th style="direction:rtl;text-align: right">اسم القسم</th>
            <th style="direction:rtl;text-align: right">توصيف القسم</th>
            <th style="direction:rtl;text-align: right">عدد موظفي القسم</th>
            <th style="direction:rtl;text-align: right">العمليات</th>
          </tr>
          </thead>
          <tbody>
          <?php $i=1; ?>  
          @isset($departments)
            @foreach ($departments as $dep)
              <tr>
                <td>{{$i++}}</td>
                <td style="direction:rtl">{{$dep->department_name}}</td>
                <td style="direction:rtl">{{$dep->department_description}}</td>
                <td>{{$dep->active_user->count()}}</td>
                <td>
                  <a type="button" class="btn btn-info btn-flat" title="عرض حسابات المستخدمين" onclick="openUsersModal('{{$dep->id}}')"><i class="fa fa-users"></i></a>
                  <!-- <a type="button" class="btn btn-warning btn-flat" title="تعديل"><i class="fa fa-edit"></i></a> -->
                  <form action="{{ url('BankDepartment/'.$dep->id) }}" method="POST" style="display: contents;">
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
  function view_create_dep_modal() {
    // body...
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(id) {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("modalBody").innerHTML = this.responseText;
        $('#example-modal').DataTable()
        setTimeout(function(){ $('.select2').select2() }, 500);
        $('#modal-default').modal('show');
      }
    };
    xhttp.open("GET", "{{url('BankDepartment/create')}}" , true);
    xhttp.send(); 
  }

  function openUsersModal(dep_id) {
    // body...
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(id) {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("modalBody").innerHTML = this.responseText;
        $('#modal_table_example').DataTable()
        $('.select2').select2();
        setTimeout(function(){ $('.select2').select2() }, 500);
        $('#modal-default').modal('show');
      }
    };
    xhttp.open("GET", "{{ url('BankDepartment') }}/"+dep_id+"/users" , true);
    xhttp.send(); 
  }

  
  function deleteUserFromDep(user_id,userName,DepName,DepId) {
    // body...
    modalConfirm("سيتم حذف المستخدم  <strong> "+userName+" </strong>من القسم التالي "+"<br>"+DepName, function(confirm){
      if(confirm){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(id) {
          if (this.readyState == 4 && this.status == 200) {
            try{
              const serverRes = JSON.parse(this.responseText);
              if(serverRes.status_code == 200){
                success_modal('تم حذف المستخدم '+userName+' من القسم  '+DepName);

                btn = document.getElementById("dep_user_btn_"+user_id);
                var row = btn.parentNode.parentNode.parentNode;
                  return row.parentNode.removeChild(row);
              }
              else{
                return error_modal('لم يتم حذف المستخدم من القسم ')
              }
            }
            catch(e){
              return error_modal('لم يتم حذف المستخدم من القسم ')
            }
          }
          else if(this.readyState == 4 && this.status != 200){
            return error_modal('لم يتم حذف المستخدم من القسم ')
          }
        };
        xhttp.open("DELETE", "{{url('BankDepartment')}}/"+DepId+"/user/"+user_id , true);
        xhttp.setRequestHeader("X-CSRF-TOKEN", document.getElementById('_token_'+user_id+'_id').value);
        xhttp.send('_token='+document.getElementById('_token_'+user_id+'_id').value); 
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
  $("body").on("click", "#submit", function (e) {
    alert("sss")
    e.preventDefault();//
    const department_name = document.getElementById("department_name").value;
    if(department_name.length < 1){
      alert('ss')
      error_modal('لا يمكنكم ترك حقل  اسم الوثيقة فارغا أو مكونا من الأحرف المميزة')
    }
    else{
      //get the action-url of the form
      alert("sss")
        var actionurl = e.currentTarget.action;
        //$(this).submit();
        var form = $('#create_dep_form_id')[0];
        form.submit()
    }
  });
</script>


<script type="text/javascript">
    function addNewUser(DepId){
      var e = document.getElementById("add_users_id");
      var user_id = e.options[e.selectedIndex].value;

      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function(id) {
        if (this.readyState == 4 && this.status == 200) {
          const serverRes = JSON.parse(this.responseText);
          if(serverRes.status_code == 200){
            success_modal('تمت إضافة المستخدم '+serverRes.user.name+' إلى القسم  '+serverRes.DepName);
            var tableBody = document.getElementById("user_table_body_to_append");
            var LastID    = document.getElementById('user_table_body_to_append').lastElementChild._DT_RowIndex + 1
            var newRow   = tableBody.insertRow();
            // Insert a cell in the row at index 0
            var newCell_0  = newRow.insertCell(0);
            var newText  = document.createTextNode(LastID+1);
            newCell_0.appendChild(newText)

            var newCell_1  = newRow.insertCell(1);
            var newText  = document.createTextNode(serverRes.user.name);
            newCell_1.appendChild(newText)
            
            var newCell_2  = newRow.insertCell(2);
            var newText  = document.createTextNode('لا يمكنكم الحذف الآن');
            newCell_2.appendChild(newText)
          }
          else{
            return error_modal('فشلت العملية، حاول مرة أخرى')
          }
        }
        else if(this.readyState == 4 && this.status != 200){
          return error_modal('المستخدم موجود في هذا القسم سابقاً')
        }
      };
      xhttp.open("POST", "{{url('BankDepartment')}}/"+DepId+"/user/"+user_id , true);
      xhttp.setRequestHeader("X-CSRF-TOKEN", document.getElementById('_token__id').value);
      xhttp.send('_token='+document.getElementById('_token__id').value); 
    }
</script>