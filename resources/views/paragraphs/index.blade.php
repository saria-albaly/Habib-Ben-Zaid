<div class="row" style="overflow-x: scroll;">
  <div class="col-xs-12" style="width: -moz-fit-content;min-width: 100%;">
    <div class="box" >
      <div class="box-header" style="text-align: right;direction: rtl;">
        <div class="col-md-10 pull-right">
          <h3 class="box-title">تصفح  فقرات@isset($document) {{ $document->document_name }}  @endisset </h3>
        </div>
        <div class="col-md-2">
          <?php $privCons = $document->document_priv_actions(); ?>
          @if($privCons != null && $privCons->filter(function($r){return $r->action_name == 'create_new_section';})->count() > 0)
            <a type="button" class="btn btn-info btn-flat" title="إنشاء فقرة جديدة" href="{{url('document/pure/'.$document->id.'/paraghraphs/create')}}"><i class="fa fa-plus"></i> إنشاء فقرة جديدة</a>
          @endif
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped" style=" width: 100%;text-align: right;direction: rtl;">
          <thead>
          <tr>
            <th style="text-align: right;direction: rtl;">#</th>
            <th style="text-align: right;direction: rtl;">عنوان الفقرة</th>
            <th style="text-align: right;direction: rtl;">تاريخ الإنشاء</th>
            <th style="text-align: right;direction: rtl;">عدد التعديلات</th>
            <th style="text-align: right;direction: rtl;">تاريخ آخر تعديل</th>
            <!-- <th style="text-align: right;direction: rtl;">Last Modified User</th> -->
            <th style="text-align: right;direction: rtl;">العمليات</th>
          </tr>
          </thead>
          <tbody>
          @isset($document_sections)
            <?php $privCons = $document->document_priv_actions(); ?>
              @foreach ($document_sections as $document_section)
                @if($privCons->count() > 0)
                <tr>
                  <td>{{$document_section->section_order_id}}</td>
                  <td style="direction:rtl">{{strip_tags($document_section->section_title)}}</td>
                  <td>{{$document_section->created_date}}</td>
                  <td>{{$document_section->editRequests()->count()}}</td>
                  <td>{{$document_section->modified_date}}</td>
                  <!-- <td>{{Auth::user()->name}}</td> -->
                  <td>

                    <a type="button" class="btn btn-primary btn-flat" title="عرض الفقرة " href="{{url('document/'.$document->id.'/paraghraphs/'.$document_section->id)}}"><i class="fa fa-eye"></i></a>
                    @if($privCons->filter(function($r) use($document_section) {return $r->action_name == 'edit' && ($r->array_section_ids==null || in_array($document_section->id,explode(",",$r->array_section_ids))) ;})->count() > 0)
                      <a type="button" class="btn btn-warning btn-flat" title=" تعديل " href="{{url('document/pure/'.$document->id.'/paraghraphs/'.$document_section->id.'/edit')}}"><i class="fa fa-edit"></i></a>
                    @endif  
                    @if($document_section->editRequests()->count() > 0 && $privCons->filter(function($r) use($document_section) {return $r->action_name == 'old_versions' && ($r->array_section_ids==null || in_array($document_section->id,explode(",",$r->array_section_ids))) ;})->count() > 0)
                      <button class="btn btn-success btn-flat" title="النسخ السابقة" onclick="getParagraphVersions({{$document_section->id}})"><i class="fa fa-history"></i></button>
                    @endif
                    <!-- SHOW only if there are draft version -->

                      <!-- <a type="button" class="btn btn-warning btn-flat" title="معاينة التعديلات" href="{{url('document/'.$document->id.'/paraghraphs/'.$document_section->id.'/version')}}"><i class="fa fa-code-fork"></i></a> -->

                    <!-- END -->
                    @if($privCons->filter(function($r) use($document_section) {return $r->action_name == 'delete' && ($r->array_section_ids==null || in_array($document_section->id,explode(",",$r->array_section_ids))) ;})->count() > 0)
                      <form action="{{ url('paraghraph/'.$document_section->id) }}" method="POST" style="display: contents;">
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="id" value="{{$document_section->id}}">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-flat delete" title="حذف الوثيقة"><i class="fa fa-trash-o"></i></button>
                      </form>
                    @endif  
                  </td>
                </tr>
              @endif  
            @endforeach  
          @endisset 
          </tbody>
          <tfoot>
          <tr>
            <th style="text-align: right;direction: rtl;">#</th>
            <th style="text-align: right;direction: rtl;">عنوان الفقرة</th>
            <th style="text-align: right;direction: rtl;">تاريخ الإنشاء</th>
            <th style="text-align: right;direction: rtl;">تاريخ آخر تعديل</th>
            <!-- <th>Last Modified User</th> -->
            <th style="text-align: right;direction: rtl;">العمليات</th>
          </tr>
          </tfoot>
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
    <div class="modal-content" id="modalBody">

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
  function getParagraphVersions(section_id) {
    // body...
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(id) {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("modalBody").innerHTML = this.responseText;
        $('#example-modal').DataTable()
        $('#modal-default').modal('show');
      }
    };
    xhttp.open("GET", "{{url('document/'.$document->id.'/paraghraphs/')}}/"+section_id+"/versions" , true);
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