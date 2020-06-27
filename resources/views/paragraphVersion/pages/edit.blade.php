<style>
  #editor1 p {
    text-align:right !important;
    margin-bottom:1px;
    margin-top:1px;
    line-height:1.8!important;
  }
  #editor1 li{
    text-align:right !important;
  }
</style>
<style type="text/css">
  .panel-box-header-class {
    padding: 10px 16px;
  }

  /* The sticky class is added to the header with JS when it reaches its scroll position */
  .panel-box-sticky {
    position: fixed;
    top: 0;
    width: 85%
  }

  /* Add some top padding to the page content to prevent sudden quick movement (as the header gets a new position at the top of the page (position:fixed and top:0) */
  .panel-box-sticky + .pad {
    padding-top: 102px;
  }
</style>

<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header panel-box-header-class" id="myHeader" style="background-color: white;z-index: 999;border-bottom: solid aliceblue;">
        <h3 class="box-title"> @isset($document) {{ $document->document_name }}  @endisset <br>
          <small>@isset($document_section) {{ strip_tags($document_section->section_title) }}  @endisset</small>
        </h3>
        <!-- tools box -->
        <div class="pull-right box-tools panel-box-header-class">
          <button type="button" class="btn btn-success btn-sm" title="مسار الوثيقة" onclick="viewWorkFlowModal()">
                  عرض مسار الوثيقة والملاحظات
            <i class="fa fa-sitemap"></i></button>  
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
          <!-- Auth User -->
          @isset($document_section_last_version)
            @if($document_section_last_version->status == 'draft' && $requestDetails->request_user_id != Auth::user()->id)
              <div class="callout callout-danger">
                <h4>عذراً، لا تستطيع التعديل الآن </h4>

                <p>تم التعديل على هذه النسخة من قبل أحد ما ،وما زالت في حالة مسودة ولا يمكنكم التعديل  حتى يتم قبول التعديلات على النسخة السابقة  <br> الرجاء التواصل مع مدير النظام </p>
              </div>
            @elseif($document_section_last_version->status == 'unpublished' && ($requestDetails->request_user_id != $requestDetails->current_user_id) )
            <!-- Not sya your edition if Auth not Equal to current--->
              <div class="callout callout-warning">
                <h4>عذراً، لا تستطيع التعديل الآن </h4>

                <p>تم التعديل على هذه النسخة من قبلكم  ،وما زالت في حالة مسودة ولا يمكنكم التعديل  حتى يتم قبول التعديلات على النسخة السابقة  <br> الرجاء التواصل مع مدير النظام </p>
                <br>
                <p><button type="button" class="btn btn-success btn-sm" title="مسار الوثيقة" onclick="viewWorkFlowModal()">
                  عرض مسار الوثيقة والملاحظات
            <i class="fa fa-sitemap"></i></button> </p>
              </div>
            @else
          <form method="POST" action="{{ url('document/'.$document_section->document_id.'/paraghraphs/'.$requestDetails->id.'/edit') }}" >
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="section_id" value="@isset($document_section){{ $document_section->id }}@endisset">
              <input type="hidden" name="document_id" value="@isset($document_section){{ $document_section->document_id }}@endisset">
              <div class="row" style="width : 800px">
                <div class="col-md-4 pull-right">
                  <div class="form-group">
                    <button class="btn btn-block btn-success" style="margin-top: 11%;" 
                      @isset($document_section_last_version) 
                        @if($document_section_last_version->status == 'draft'  && $requestDetails->request_user_id != Auth::user()->id)
                          disabled
                        @endif
                      @endisset
                      
                      >حفظ التعديلات</button>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="section_title" style="float:left">Paragraph Title</label>
                    <!-- <input type="text"  class="form-control" id="section_title" name="section_title" value="@isset($document_section){{ $document_section->section_title }}@endisset"> -->
                    <br>
                    <textarea class="textarea" placeholder="Place some text here" name="section_title"
                          style="width: 100%;font-size:7px; height: 75px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">@isset($document_section_last_version){{ $document_section_last_version->section_title }}@endisset</textarea>
                  </div>
                  <div class="form-group">
                    <label for="section_position" style="float:left">Paragraph Position <small>After The Paragraph</small></label>
                    <select class="form-control select2" style="width: 100%;" name="section_order_id" id='section_position'>
                      <option value="0" <?php if($document_section_last_version->section_order_id == 0) echo "selected" ?> >أول عنصر في الوثيقة </option>
                      @isset($document_sections)
                        @foreach ($document_sections as $doc_sec)
                          @if($doc_sec->id != $document_section_last_version->id)
                            <option value="{{ $doc_sec->section_order_id+1 }}" <?php if($doc_sec->section_order_id == $document_section_last_version->section_order_id -1 ) echo "selected" ?> >{{ $doc_sec->section_order_id.' - '.$doc_sec->section_title }}</option>
                          @endif
                        @endforeach  
                      @endisset
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="header_level" style="float:left">Paragraph Header Level </label>
                    <select class="form-control select2" name="header_level" id='header_level'>
                      <option value="h1"> Level 1</option>
                      <option value="h2"> Level 2</option>
                      <option value="h3"> Level 3</option>
                      <option value="h4"> Level 4</option>
                      <option value="h5"> Level 5</option>
                    </select>
                  </div>
                </div>
              </div>
              <textarea id="editor1" name="section_html_body" rows="10" cols="80" style="direction: rtl;text-align: right;">
                @isset($document_section_last_version)
                  {{ $document_section_last_version->section_body }}
                @endisset      
              </textarea>
          </form>
            @endif
          @endisset
        </center>  
      </div>
    </div>
  </div>
</div>


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
  // When the user scrolls the page, execute myFunction
  window.onscroll = function() {myFunction()};

  // Get the header
  var header = document.getElementById("myHeader");

  // Get the offset position of the navbar
  var sticky = header.offsetTop;

  // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
  function myFunction() {
    if (window.pageYOffset > sticky) {
      header.classList.add("panel-box-sticky");
    } else {
      header.classList.remove("panel-box-sticky");
    }
  } 

  var request = false;
  function viewWorkFlowModal(){
    // body...
    if(!request){
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function(id) {
        if (this.readyState == 4 && this.status == 200) {
          request = true;
          document.getElementById("modalBody").innerHTML = this.responseText;
          $('#modal-default').modal('show');
        }
      };
      xhttp.open("GET", "{{ url('DocumentEditRequest/'.$requestDetails->id.'/viewrequestflow?modal=true') }}" , true);
      xhttp.send(); 
    }
    else
      $('#modal-default').modal('show');
  }
</script>