<style>
	.flowchart {
		display: block;
		text-align: center;
		margin: 0 auto;
	}
</style>


<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <div class="row">
          <div class="col-md-10">
            <h3 class="box-title">Edit Request Flow</h3>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

<div id="layout">
  	<div class="flowchart">
st=>start: إنشاء طلب تعديل
op=>operation: قبول الطلب وتحديد مسار الوثيقة
<?php 
	$i=0;
	foreach ($editFlowusers as $row) {
		# code...
		echo "node".$i++."=>operation: ".$row->name."\n";
	}
?>
e=>end: اعتماد التعديلات

st->op
op->node1
<?php 
	$i=0;
	foreach ($flow as $action) {
		# code...
		if($i+1 < sizeof($_arrayFlow))
			echo "node".$i++."->node".($i+1)."\n";
		else
			echo "node".$i++."->e ";
	}

/*	for ($i=1; $i < sizeof($_arrayFlow); $i++) { 
		# code...
		echo "cond".$i."(رفض التعديلات)->cond".$_arrayFlow[$i-1]."\n";
		if(isset($_arrayFlow[$i+1]))
			echo "cond".$i."(قبول التعديلات)->cond".$_arrayFlow[$i+1]."\n";
		else
			echo "cond".$i."(قبول التعديلات)->e";
	}*/
?>
	</div>
</div>	

		
	  </div>
	</div>
  </div>	
</div>  

<script src="{{ asset('flow/raphael.min.js') }}" > </script>
<script src="{{ asset('flow/jquery.min.js') }}" > </script>
<script src="{{ asset('flow/flowchart.min.js') }}" > </script>
<script src="{{ asset('flow/jquery.flowchart.js') }}" > </script>
<script type="text/javascript">
    $(function() {
		$(".flowchart").flowChart({
			"line-color"    : "#E91E63",
			"element-color" : "#263238",
			"symbols"       : {
				"start"     : {
					"element-color" : "#E91E63",
					"fill"          : "#E91E63"
				}
			},
		});
    });
</script>
