<style>
  .Section0 div>p {
    text-align:right !important;
    direction: rtl !important;
    margin-bottom:1px;
    margin-top:1px;
    line-height:1.8!important;
  }
  .Section0>p {
    text-align:right !important;
    direction: rtl !important;
    margin-bottom:1px;
    margin-top:1px;
    line-height:1.8!important;
  }
  .Section0 div>li{
    text-align:right !important;
    direction: rtl !important;
  }
  
  .Section0 div>ul{
    text-align:right !important;
    direction: rtl !important;
  }
</style>

<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title"> @isset($document) {{ $document->document_name }}  @endisset <br> </h3>
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
          <!-- Auth User -->
              <form method="POST" action="{{ url('document/pure/'.$document->id.'/paraghraphs/create') }}" >
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="document_id" value="@isset($document){{ $document->id }}@endisset">
                  <div class="row" style="width : 800px">
                    <div class="col-md-4 pull-right">
                      <div class="form-group">
                        <button class="btn btn-block btn-success" style="margin-top: 11%;">save</button>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="section_title" style="float:left">Paragraph Title</label>
                        <br>
                        <textarea class="textarea" placeholder="Place some text here" name="section_title"
                              style="width: 100%;font-size:7px; height: 75px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="section_position" style="float:left">Paragraph Position <small>After The Paragraph</small></label>
                        <select class="form-control select2" style="width: 100%;" name="section_order_id" id='section_position'>
                          <option value="0" selected="true">أول عنصر في الوثيقة </option>
                          @isset($document_sections)
                            @foreach ($document_sections as $doc_sec)
                              <option value="{{ $doc_sec->section_order_id+1 }}">{{ $doc_sec->section_order_id.' - '.$doc_sec->section_title }}</option>
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
                  <textarea id="editor1" name="section_html_body" rows="10" cols="80">
                  </textarea>
              </form>
        </center>  
      </div>
    </div>
  </div>
</div>    