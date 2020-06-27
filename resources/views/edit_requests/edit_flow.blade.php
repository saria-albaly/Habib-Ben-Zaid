<div class="row" style="overflow-x: scroll;">
  <div class="col-xs-12" style="width: -moz-fit-content;min-width: 100%;">
    <div class="box" style=" width: 100%; " >
      <div class="box-header">
        <div class="row">
          <div class="col-md-12" style="direction:rtl;text-align: right">
            <h3 class="box-title">مسار طلب التعديل</h3>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped" style=" width: 100%;direction:rtl;text-align: right">
          <thead>
          <tr>
            <th style="direction:rtl;text-align: right">#</th>
            <th style="direction:rtl;text-align: right">اسم المسؤول</th>
            <th style="direction:rtl;text-align: right">تاريخ الارسال</th>
            <th style="direction:rtl;text-align: right">المرسل له</th>
            <th style="direction:rtl;text-align: right">الملاحظات</th>
            <th style="direction:rtl;text-align: right">نوع العملية</th>
          </tr>
          </thead>
          <tbody>
          <?php $i=1; $first=true; $password=''?>
          @isset($flow)
            @foreach ($flow as $editReqFlow)
              @if($editReqFlow->file_password != null)
                <?php $password=$editReqFlow->file_password; ?>
              @endif
              @isset($edit_request)
                @if($first == true)
                  <tr>
                    <?php $first= false; ?>
                    <td>{{$i++}}</td>
                    <td>{{$edit_request->user->name }}</td>
                    <td>{{$edit_request->created_date}}</td>
                    <td>مدير النظام</td>
                    <td>{{$edit_request->edit_request_name}}</td>
                    <td>Create Edit Request</td>
                  </tr>
                @endif  
              @endisset
              <tr>
                <td>{{$i++}}</td>
                <td>{{$editReqFlow->user->name}}</td>
                <td>{{$editReqFlow->created_at}}</td>
                @if($editReqFlow->next_user!==null)
                  <td>{{$editReqFlow->next_user->name}}</td>
                @else  
                  <td>-</td>
                @endif  
                <td>
                  {{$editReqFlow->note}}  <br>
                  <!-- $edit_request->current_user_id == Auth::user()->id && -->
                  @if($edit_request->isLastNode &&  $edit_request->document->doc_type_id == 1 && $edit_request->current_user_id == Auth::user()->id && $i==sizeof($flow)+1)
                    password is: {{$password}}
                  @endif
                </td>
                <td>{{$editReqFlow->action_name}}</td>
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