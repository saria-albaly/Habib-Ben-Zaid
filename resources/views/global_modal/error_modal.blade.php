<!-- <div class="modal fade" id="modal-error-start">
  <div class="modal-dialog">
    <div class="modal-content" style="direction: rtl;text-align: right;">
    	<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		    <span aria-hidden="true">&times;</span></button>
		  <h4 class="modal-title" style="margin-right: 1%">عذراً</h4>
		</div>
		<div class="modal-body">
		  	<p> حدث خطأ ما أثناء إتمام هذه العملية  </p>
		  	<p id="dynamic_text_error"></p>
		</div>  
		<div class="modal-footer">
		  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
		</div>
    </div>
  </div>
</div> -->
<style type="text/css">
	.myAlert-top{
    position: fixed;
    bottom: 5px;
    left:2%;
    width: 30%;
	}

	.alert{
	    display: none;
	}
</style>

<div class="myAlert-top alert alert-danger" style="direction: rtl;text-align: right;z-index: 1000" id="error_modal">
  <strong>فشلت العملية  !</strong> <span id="dynamic_text_error"></span>
</div>

<script type="text/javascript">
	function error_modal(dynamic_text) {
		// // body...
		// document.getElementById("dynamic_text_error").innerHTML = dynamic_text
		// $('#modal-error-start').modal('show');
		document.getElementById("dynamic_text_error").innerHTML = dynamic_text
		$("#error_modal").show();
		  setTimeout(function(){
		    $("#error_modal").hide(); 
		  }, 3000);
	}
</script>