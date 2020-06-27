<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal-confirm-start" style="text-align: right;direction: rtl;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">هل أنت متأكد </h4>
      </div>
      <div class="modal-body">
        <p>
          <p id="dynamic_text_confirm"></p>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="modal-btn-si">نعم </button>
        <button type="button" class="btn btn-primary" id="modal-btn-no"> إلغاء العملية</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var modalConfirm = function _confirm_modal(dynamic_text,callback) {
    // body...
    document.getElementById("dynamic_text_confirm").innerHTML = dynamic_text
    $('#modal-confirm-start').modal('show');

    $("#modal-btn-si").off("click");
    $("#modal-btn-no").off("click");
    
    $("#modal-btn-si").on("click", function(){
      callback(true);
      $("#modal-confirm-start").modal('hide');
    });
    
    $("#modal-btn-no").on("click", function(){
      callback(false);
      $("#modal-confirm-start").modal('hide');
    });
  }
</script>