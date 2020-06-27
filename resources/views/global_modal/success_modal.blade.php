<!-- <div class="modal fade" id="modal-success-start">
  <div class="modal-dialog">
    <div class="modal-content" style="direction: rtl;text-align: right;">
    	<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		    <span aria-hidden="true">&times;</span></button>
		  <h4 class="modal-title" style="margin-right: 1%">نجحت العملية</h4>
		</div>
		<div class="modal-body">
		  	<p id="dynamic_text_success"></p>
		</div>  
		<div class="modal-footer">
		  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
		</div>
    </div>

  </div>

</div>
 -->
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

<div class="myAlert-top alert alert-success" style="direction: rtl;text-align: right;z-index: 1000" id="success_modal">
  <strong>نجحت العملية !</strong> <span id="dynamic_text_success"></span>
</div>

<script type="text/javascript">
	function success_modal(dynamic_text,reload) {
		// body...
// 		document.getElementById("dynamic_text_success").innerHTML = dynamic_text
// 		$('#modal-success-start').modal('show');
// 		setTimeout(function(){ 
// 			$('#modal-success-start').modal('toggle');
// /*			if(reload)
// 				setTimeout(location.reload(),1000)*/
// 		}, 2000);
		document.getElementById("dynamic_text_success").innerHTML = dynamic_text
		$("#success_modal").show();
		  setTimeout(function(){
		    $("#success_modal").hide(); 
		  }, 3000);
	}
</script>