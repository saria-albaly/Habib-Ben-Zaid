<style type="text/css">
  @page:left{
    @bottom-left {
      content: "Page " counter(page) " of " counter(pages);
    }
  }
</style>
<style>
   body{counter-reset: section}
     #content-details h2{counter-reset: sub-section;direction: rtl;}
     #content-details h3{counter-reset: composite;direction: rtl;}
     #content-details h4{counter-reset: detail;direction: rtl;}

     #content-details h2:before{
       counter-increment: section;
       page-break-before : always;
       content: counter(section) " ";
     }
     #content-details h3:before{
       counter-increment: sub-section;
       /*content: counter(section) "." counter(sub-section) " ";*/
       content: counter(sub-section) "." counter(section) " " ;
     }
     #content-details h4:before{
       counter-increment: composite;
       content: counter(composite) "." counter(sub-section) "." counter(section) " ";
     }
     #content-details h5:before{
       counter-increment: detail;
       content: counter(detail) "." counter(composite) "." counter(sub-section) "." counter(section) " ";
   }
</style>
<style>
  .ice-del {display: none}
</style>
<style>
  div.sticky {
    position: -webkit-sticky;
    position: sticky;
    top: 0;
    padding: 50;
    margin-bottom: 2%;
  }

  .img-thumbnail
  {
    width: 100%;
  }

  img {
  width: 100%;
  }
  #content-details div>p {
    text-align:right !important;
    margin-bottom:1px;
    margin-top:1px;
    line-height:1.8!important;
  }
  .Section0 > p {
    text-align:right !important;
    margin-bottom:1px;
    margin-top:1px;
    line-height:1.8!important;
  }
  #content-details li{
    text-align:right !important;
  }
  table{
    direction: ltr;
  }

  .Section0>span, .Section0>p>span{
    text-align:right !important;
    direction: rtl !important;
    margin-bottom:1px;
    margin-top:1px;
    line-height:1.8!important;
  }
</style>

<!-- <style type="text/css">
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 210mm;
        height: 297mm;
        padding: 20mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
</style> -->
<!-- <link rel="stylesheet" href='{{ asset("src/reset.css")}}' type="text/css" media="screen" charset="utf-8" /> -->
<style type="text/css">
.page{ width: 800px; height: 1262px; border: 1px solid black; margin: 20px; padding: 47px; position: relative; }
.page .content .column{ text-align:justify; font-size: 10pt; }
.page .content .column blockquote{ border-left: 2px solid #999999; background: #DEDEDE; padding: 10px; margin: 4px 20px; clear: both; }
.page .content .column img{ float: left; margin: 10px; }
.page .content .column p{ padding: 0 10px; margin: 10px 0; }
.page .content .column h1{ padding: 0 10px; }
.page .header{ text-align: center; font-size: 18pt; font-family: helvetica, arial; padding: 20px 0 0; }
.page .footer{ text-align: center; }
.page .footer span{ position: absolute; bottom: 10px; right: 10px; }
.page_template{ display: none; }

.enclosure {border:1px dashed black}    
</style>

<!-- Back To Top Button Style -->
<style>
  #myBtn {
    display: none;
    position: fixed;
    bottom: 20px;
    right: 30px;
    z-index: 1200;
    font-size: 18px;
    border: none;
    outline: none;
    background-color: red;
    color: white;
    cursor: pointer;
    padding: 15px;
    border-radius: 4px;

  }

  #myBtn:hover {
    background-color: #555;
  }
  </style>

<button onclick="topFunction()" id="myBtn" title="العودة إلى الأعلى" style="height: 35px;"><span class="fa fa-sort-up"></span></button>

<div class="page_template">  
  <div class='header'><!-- This is a header<hr> --></div>  
  <div class='content'></div>  
  <div class='footer'><!-- <hr><span>Page: </span>This is the footer. --></div>  
</div> 
<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header">
        <center> <h3 class="box-title">  @isset($document) {{ $document->document_name }}  @endisset </h3></center>
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
        <div class="col-md-4 sticky" style="background-color: white;border-right: solid;z-index: 10000;">
          @isset($_TOC) {!!html_entity_decode($_TOC)!!}   @endisset
        </div>
        <div class="col-md-8" style="overflow-x: scroll;">
          <?php $privCons = $document->document_priv_actions(); ?>
          @if($privCons->filter(function($r){return $r->action_name == 'print';})->count() > 0)
           <button class="btn-info" onclick="PrintElem('myDivToPrint')">طباعة الوثيقة</button>
          @else 
          <style type="text/css" media="print">
            BODY {display:none;visibility:hidden;}
          </style> 
          @endif 
          <div class="row pull-right" style="width : 800px;direction: rtl;text-align: right;" id="content-details" >
<!--             <center>@isset($document) {{ strip_tags($document->document_name) }}  @endisset</center>
            <hr> -->
            @isset($_CONTENT) {!!html_entity_decode($_CONTENT)!!}   @endisset
          </div>
          <div class="row" style="width : 800px" id="content-details_pages" >
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function PrintElem(elem)
  {
      var mywindow = window.open('', 'PRINT', 'width= 800px,height= 1200px;');

      mywindow.document.write('<html><head><title>' + document.title  + '</title>');
      mywindow.document.write('</head><body style="padding: 3mm;direction: rtl;text-align: right;">');
      mywindow.document.write('<style>@media print {h2 {page-break-before: always;}}</style>');
      mywindow.document.write('<style> @page { size: A4;  margin: 12.5mm; }'+    
          'body{counter-reset: section;font-family: "Janna LT";}' +
          'h2{counter-reset: sub-section;direction: rtl;}' +
          'h3{counter-reset: composite;direction: rtl;}' +
          'h4{counter-reset: detail;direction: rtl;}' +
          'h2:before{' +
             'page-break-before : always;'+
             'counter-increment: section;' +
             'content: counter(section) " ";' +
           '}' +
          'h3:before{' +
             'counter-increment: sub-section;' +
             'content: counter(section) "." counter(sub-section) " ";' +
           '}' +
          'h4:before{' +
             'counter-increment: composite;' +
             'content: counter(section) "." counter(sub-section) "." counter(composite) " ";' +
           '}' +
          'h5:before{' +
             'counter-increment: detail;' +
             'content: counter(section) "." counter(sub-section) "." counter(composite) "." counter(detail) " ";' +
          '}' +
          '.ice-del {display: none}   </style>'+
          '<style>'+
            '.img-thumbnail'+
            '{' +
              'width: 100%;' +
            '}' +
            'img {' +
              'width: 100%;' +
            '}' +
            '#content-details div>p {' +
              'text-align:right !important;' +
              'margin-bottom:1px;' +
              'margin-top:1px;' +
              'line-height:1.8!important;' +
            '}' +
            '.Section0 > p {' +
              'text-align:right !important;' +
              'margin-bottom:1px;' +
              'margin-top:1px;' +
              'line-height:1.8!important;' +
            '}' +
            '#content-details li{' +
              'text-align:right !important;' +
            '}' +
            'table{' +
              'direction: ltr;' +
          '}</style>'
          )
      mywindow.document.write(document.getElementById(elem).innerHTML);
      mywindow.document.write('</body></html>');

      mywindow.document.close(); // necessary for IE >= 10
      mywindow.focus(); // necessary for IE >= 10*/

      mywindow.print();
      mywindow.close();

      return true;
  }
</script>

<script>
  //Get the button
  var mybutton = document.getElementById("myBtn");

  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      mybutton.style.display = "block";
    } else {
      mybutton.style.display = "none";
    }
  }

  // When the user clicks on the button, scroll to the top of the document
  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
</script>