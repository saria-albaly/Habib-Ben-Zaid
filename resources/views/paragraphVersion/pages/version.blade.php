<script src="{{ asset('dist/js/diff-checker.js') }}"></script>
<style>
  .ice-del {color: red;}
  .ice-ins {color: blue;}
  .highlight {background-color: #B4D5FF}
  ins {
      text-decoration: none;
      background-color: #d4fcbc;
  }

  del {
      text-decoration: line-through;
      background-color: #fbb6c2;
      color: #555;
  }
</style>
<style>
  #old p,#new p,#old span, #new span{
    text-align:right !important;
    direction: rtl !important;
    margin-bottom:1px;
    margin-top:1px;
    line-height:1.8!important;
  }
  
  .Section0 p{
    text-align:right !important;
    direction: rtl !important;
    margin-bottom:1px;
    margin-top:1px;
    line-height:1.8!important;
  }

  .Section0>span, .Section0>p>span{
    text-align:right !important;
    direction: rtl !important;
    margin-bottom:1px;
    margin-top:1px;
    line-height:1.8!important;
  }

  .Section0 li{
    text-align:right !important;
    direction: rtl !important;
  }
  
  .Section0 ul{
    text-align:right !important;
    direction: rtl !important;
  }
</style>


<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header" style="direction: rtl;text-align: right;">
        <h3 class="box-title" style="margin-right: 5%">@isset($document) {{ $document->document_name }}  @endisset <br>
          <small> Compare paragraph @isset($document_section) {{ strip_tags($document_section->section_title) }}  @endisset versions </small>
        </h3>
        <!-- tools box -->
        <div class="pull-right box-tools">
          <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
<!--           <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                  title="Remove">
            <i class="fa fa-times"></i></button> -->
        </div>
        <!-- /. tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body pad">
        <div class="row">
          <center>
            <div class="row" >
            <button type="button" class="btn btn-block btn-info btn-sm" 
                  title="" style="width: 5%;">
            <i class="fa fa-arrow-left"></i></button>
          </div>
          </center>
          <div class="col-md-6 pull-right">
            <div class="box-body pad">
              <div class="box box-success">
                <div class="box-header" style="direction: rtl;text-align: right;">
                  <h3 class="box-title">قبل التعديل<br>
                    <small> رقم النسخة  @isset($document) {{ $document->doc_num_prefix .'-'. $document->doc_num .'.'.$document->doc_v }}  @endisset </small>
                  </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body pad" id="before_edition" style="overflow-x: auto;">
                  <input type="text" disabled class="form-control" value="{{ strip_tags($bf_section_title)  }}" style="direction: rtl;text-align: right;">
                  <br>
                  <input type="text" disabled class="form-control" value="{{ $bf_section_order  }}" style="direction: rtl;text-align: right;">
                  <br>
                  <div id="old" style="direction: rtl;">
                    @isset($document_section_pure) {!!html_entity_decode($document_section_pure->section_html_body)!!}   @endisset
                  </div>  
                </div>
              </div>
            </div>
          </div>
<!--           <div class="col-md-1" style="position: absolute;top: 50%;left: 48%;transform: translateY(-50%);">
            <button type="button" class="btn btn-block btn-info " data-widget="remove" data-toggle="tooltip"
                  title="Remove" style="width: 36%;">
            <i class="fa fa-arrow-right"></i></button>
          </div> -->
          <div class="col-md-6">
            <div class="box-body pad">
              <div class="box box-warning">
                <div class="box-header" style="direction: rtl;text-align: right;">
                  <h3 class="box-title">بعد التعديل<br>
                    <?php
                      if($document->doc_v >= ($document->document_inc_value -1 )){
                        $document->doc_v   = 1;
                        $document->doc_num += 1;
                      }
                      else
                        $document->doc_v   += 1;
                    ?>
                    <small> رقم النسخة  @isset($document) {{ $document->doc_num_prefix .'-'. $document->doc_num .'.'.$document->doc_v }}  @endisset </small>
                  </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body pad" style="overflow-x: auto;">
                  <input type="text" disabled class="form-control" value="{{ strip_tags($document_section->section_title) }}" <?php if(strip_tags($bf_section_title) != strip_tags($document_section->section_title)) echo 'style="background-color: antiquewhite;direction: rtl;text-align: right;"'; else echo 'style="direction: rtl;text-align: right;"';?> >
                  <br>
                  <input type="text" disabled class="form-control" value="{{ $af_section_order  }}" <?php if($af_section_order != $bf_section_order) echo 'style="background-color: antiquewhite;direction: rtl;text-align: right;"'; else echo 'style="direction: rtl;text-align: right;"';?>>
                  <br>
                  <div id="new" style="direction: rtl;">
                    @isset($document_section) {!!html_entity_decode($document_section->section_body)!!}   @endisset
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @if(!isset($viewOnlyMode) || $viewOnlyMode === false)
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title"> @isset($document) {{ $document->document_name }}  @endisset <br>
          <small>@isset($document_section) {{ strip_tags($document_section->section_title) }}  @endisset</small>
        </h3>
        <!-- tools box -->
        <div class="pull-right box-tools">
          <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
<!--           <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                  title="Remove">
            <i class="fa fa-times"></i></button> -->
        </div>
        <!-- /. tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body pad">
        <center>
          @if($requestDetails->isLastNode)
            <form method="POST" action="{{ url('paraghraph',$document_section->document_section_id) }}" >
              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="id" value="@isset($document_section){{ $document_section->document_section_id }}@endisset">
              <input type="hidden" name="iseditrequest" value="true">
              <input type="hidden" name="request_id" value="{{$requestDetails->id}}">
          @else    
            <form method="POST" action="{{ url('DocumentEditRequest/next') }}" method="POST" id="dec_edit_req_form_id" > 
              <input type="hidden" name="id" value="{{$document_section->request_id}}">
              <input type="hidden" name="request_id" value="{{$document_section->request_id}}">
          @endif    
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <!-- <input type="hidden" name="id" value="@isset($document_section){{ $document_section->document_section_id }}@endisset"> -->
              @if($requestDetails->isLastNode)
                <div class="row" style="width : 800px">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label for="section_title" style="float:left">Paragraph Title</label>
                      <!-- <input type="text"  class="form-control" id="section_title" name="section_title" value="@isset($document_section){{ strip_tags($document_section->section_title) }}@endisset"> -->

                      <textarea class="textarea" placeholder="Place some text here" id="section_title" name="section_title"
                            style="width: 100%;font-size:7px; height: 75px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">@isset($document_section){{ $document_section->section_title }}@endisset</textarea>

                    </div>
                    <div class="form-group">
                      <label for="section_position" style="float:left">Paragraph Position <small>After The Paragraph</small></label>
                      <select class="form-control select2" style="width: 100%;" name="section_order_id">
                        <option value="0" <?php if($document_section->section_order_id == 0) echo "selected" ?> >أول عنصر في الوثيقة </option>
                        @isset($document_sections)
                          @foreach ($document_sections as $doc_sec)
                            @if($doc_sec->id != $document_section->id)
                              <option value="{{ $doc_sec->section_order_id+1 }}" <?php if($doc_sec->section_order_id == $document_section->section_order_id -1 ) echo "selected" ?> style="direction: rtl;">{{ $doc_sec->section_order_id.' - '.strip_tags($doc_sec->section_title) }}</option>
                            @endif
                          @endforeach  
                        @endisset
                      </select>
                    </div>
                  </div>
                </div>
                <textarea id="editor1" name="section_html_body" style="direction: rtl;text-align: right;" > <!-- rows="10" cols="80"  -->
                  @isset($document_section) {{ $document_section->section_body }}  @endisset
                </textarea>
              @endif
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <div class="form-group" style="margin-top: 1%;direction: rtl;text-align: right;">
                    <label style="right: 0px">ملاحظات </label>*
                    <textarea name="edit_request_notes" id="edit_request_notes"  class="form-control"></textarea>
                    <input type="hidden" name="edit_request_next" id="edit_request_next" value="0">
                  </div>  
                </div>
              </div>
              <div class="row">
                  <div class="col-md-3"></div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <button class="btn btn-block btn-danger" style="margin-top: 11%;" onclick="nextFlow(event,0)">
                      رفض التعديلات وإرسال الملاحظات
                      <i class="fa fa-window-close"></i>
                      </button>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <button class="btn btn-block btn-success" style="margin-top: 11%;" onclick="nextFlow(event,1)">
                      قبول ومتابعة
                       <i class="fa fa-paper-plane"></i>
                      </button>
                    </div>
                  </div>
                  <div class="col-md-3"></div>
              </div>
          </form>
        </center>  
      </div>
    </div>
    @endif
  </div>
</div>


<script type="text/javascript" >
  let lastNodeAttribute = {{$requestDetails->isLastNode}};
  function nextFlow(event,direction){
    event.preventDefault() // Don't post the form, unless confirmed
    const text = document.getElementById("edit_request_notes").value;
    console.log(text)
    if(direction == 0 && text.length <= 1)
      error_modal('لا يمكنكم ترك حقل الملاحظات فارغاً عند رفض الطلب')
    else if (confirm('Are you sure?')) {
        // Post the form
        document.getElementById("edit_request_next").value = direction;
        if(direction == 1 && lastNodeAttribute){
          if($("#cke_74").hasClass("cke_button_on")){
            error_modal('يوجد بعض التعديلات غير معاينة أو وضع التحقق من التعديلات مفعل')
          }
          else
            $(event.target).closest('form').submit() // Post the surrounding form  
        }
        else  
          $(event.target).closest('form').submit() // Post the surrounding form
    }
  }
</script>
<script type="text/javascript">
  let originalHTML = `<?php if(isset($document_section_pure)) echo ($document_section_pure->section_html_body) ?>`
  let newHTML = `<?php if(isset($document_section)) echo ($document_section->section_body) ?>`

  // Diff HTML strings
  let output = htmldiff(originalHTML, newHTML);

  // Show HTML diff output as HTML (crazy right?)!
  document.getElementById("new").innerHTML = output;
</script>