<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">إنشاء طلب تعديل </h4>
</div>
<div class="modal-body">
    <form action="{{ url('DocumentEditRequest/next') }}" method="POST" id="dec_edit_req_form_id">
      @csrf
      <input type="hidden" name="document_type" value="{{$editRequest->document->document_type}}"> 
      <input type="hidden" name="edit_request_next" id="edit_request_next" value="0">
      <input type="hidden" name="id" value="{{$editRequest->id}}">
      <div class="form-group" style="margin-top: 1%;">
          <label>اسم الوثيقة</label>
          <input type="text" id="document_name" class="form-control" value="{{$editRequest->document->document_name}}" readonly="readonly">
      </div>
      <div class="form-group" style="margin-top: 1%;">
          <label>اسم الطلب</label>
          <input type="text" class="form-control" readonly="readonly" value="{{$editRequest->edit_request_name}}">
      </div>
      <div class="form-group" style="margin-top: 1%;">
          <label>سبب التعديل</label>
          <textarea id="edit_request_reason"  class="form-control" readonly="readonly">{{$editRequest->edit_request_reason}}</textarea>
      </div>
      <div class="form-group" style="margin-top: 1%;">
          <label>ملاحظات </label>*
          <textarea name="edit_request_notes" id="edit_request_notes"  class="form-control"></textarea>
      </div>
      <div class="row">
        <div class="col-md-6">
          <button type="button" class="btn btn-danger" onclick="nextFlow(event,0)" style="width: 80%;margin-right: 10%;">
            <i class="fa fa-window-close"></i>
            رفض الطلب
          </button>
        </div>
        <div class="col-md-6">
          <button type="button" class="btn btn-success" onclick="nextFlow(event,1)" style="width: 80%;margin-right: 10%;">
            <i class="fa fa-paper-plane"></i>
            قبول الطلب
          </button>
        </div>
      </div>
    </form>
</div>  
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">إغلاق</button>
</div>

