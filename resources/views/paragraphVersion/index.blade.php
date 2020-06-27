<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" style="direction:rtl;text-align: right">@isset($document) {{ $document->document_name }}  @endisset > @isset($document_section) {{ strip_tags($document_section->section_title) }}  @endisset</h4>
</div>
<div class="modal-body" style="overflow-x: scroll;">
  <table id="example-modal" class="table table-bordered table-striped" style=" width: 100%;direction:rtl;text-align: right">
    <thead>
    <tr>
      <th style="direction:rtl;text-align: right">#</th>
      <th style="direction:rtl;text-align: right">عنوان طلب التعديل</th>
      <th style="direction:rtl;text-align: right">مرسل الطلب</th>
      <th style="direction:rtl;text-align: right">تاريخ إرسال الطلب</th>
      <th style="direction:rtl;text-align: right">تاريخ التعديل على الوثيقة</th>
      <th style="direction:rtl;text-align: right">حالة الطلب</th>
      <th style="direction:rtl;text-align: right">العمليات</th>
    </tr>
    </thead>
    <tbody>
    <?php $i=1; ?>  
    @isset($document_section_v)
      @foreach ($document_section_v as $doc_v)
        <tr>
          <td>{{$i++}}</td>
          <td>{{$doc_v->edit_request_name}}</td>
          <td>{{Auth::user()->name}}</td>
          <td>{{$doc_v->created_date}}</td>
          <td>{{$doc_v->edit_date}}</td>
          <td>{{$doc_v->status}}</td>
          <td>
            <a type="button" class="btn btn-primary btn-flat" title="عرض النسخة" href="{{url('document/'.$document->id.'/paraghraphs/'.$doc_v->id.'/view')}}"><i class="fa fa-eye"></i></a>
            <a type="button" class="btn btn-warning btn-flat" title="اعتماد هذه النسخة" href="{{url('document/'.$document->id.'/paraghraphs/'.$document_section->id.'/edit')}}"><i class="fa fa-paste"></i></a>
            <a type="button" class="btn btn-success btn-flat" title="معاينة النسخة" href="{{url('document/'.$document->id.'/paraghraphs/'.$document_section->id.'/version/view_only')}}"><i class="fa fa-history"></i></a>
          </td>
        </tr>
      @endforeach  
    @endisset 
    </tbody>
    <tfoot>
    <tr>
      <th style="direction:rtl;text-align: right">#</th>
      <th style="direction:rtl;text-align: right">عنوان طلب التعديل</th>
      <th style="direction:rtl;text-align: right">مرسل الطلب</th>
      <th style="direction:rtl;text-align: right">تاريخ إرسال الطلب</th>
      <th style="direction:rtl;text-align: right">تاريخ التعديل على الوثيقة</th>
      <th style="direction:rtl;text-align: right">حالة الطلب</th>
      <th style="direction:rtl;text-align: right">العمليات</th>
    </tr>
    </tfoot>
  </table>
</div>  
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">إغلاق</button>
</div>