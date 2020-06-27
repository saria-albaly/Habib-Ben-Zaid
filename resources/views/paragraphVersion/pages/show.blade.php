<style>
  .ice-del {display: none}
</style>

<style>
  #content-details div>p {
    text-align:right !important;
    margin-bottom:1px;
    margin-top:1px;
    line-height:1.8!important;
  }
  #content-details li{
    text-align:right !important;
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
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="row preventcopy" style="width : 800px" style="direction: rtl;text-align: right;" id="content-details">
            <center>@isset($document_section) {{ $document_section->section_title }}  @endisset</center>
            @isset($document_section) {!!html_entity_decode($document_section->section_body)!!}   @endisset
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