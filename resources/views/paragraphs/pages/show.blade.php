<style>
  .ice-del {display: none}
</style>
<style>
  #paraghraph-contonet p{
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
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title"> @isset($document) {{ $document->document_name }}  @endisset <br>
          <small>@isset($document_section) {{ strip_tags($document_section->section_title) }}  @endisset</small>
        </h3>
        <!-- tools box -->
        <div class="pull-right box-tools">
          <a class="btn btn-success btn-sm" href="{{url('document/'.$document->id.'/paraghraphs')}}" title="عودة إلى فقرات الوثيقة">
               عودة إلى فقرات الوثيقة </a>
          <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
        <!-- /. tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body pad">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="row preventcopy" style="width : 100%;direction: rtl;" id="paraghraph-contonet" unselectable="on">
            <center>@isset($document_section) {{ strip_tags($document_section->section_title) }}  @endisset</center>
            <!-- \\{ \\! \\! html_entity_decode($document_section->section_html_body) \\! \\ ! \\} -->
            @isset($document_section)  <?php echo $document_section->section_html_body ?>  @endisset
          </div>
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>
  </div>
</div>    


<script type="text/javascript">
  document.onkeydown = function(e) {
        if (e.ctrlKey && 
            (
              e.keyCode === 67 || //copy
              e.keyCode === 85 || //cut
              e.keyCode === 117)) {
            return false;
        } else {
            return true;
        }
    };
</script>