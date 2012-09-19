<!-- /app/views/elements/update_fuentefinanciamiento.ctp --> 
<script>
	$(document).ready(function(){
		var items = [
			<?php foreach($fuentes as $k => $v) { 
				echo '{ value: "'.$k.'", text: "'.$v.'" },';
			} ?> 
		];
	
		$("#selectfufin").kendoComboBox({
		    dataTextField: "text",
		    dataValueField: "value",
		    dataSource: items,
		    index: 0,
		    suggest: true,
		    filter: 'none'
		});
		
		var combobox = $("#selectfufin").data("kendoComboBox");
        combobox.list.width(400);
	
	});
</script> 

<!-- /app/views/elements/update_select.ctp -->
<!-- <?php
	if(!empty($fuentes)) {
  		foreach($fuentes as $k => $v) {
    		echo "<option value='$k'>$v</option>";
  		}
 	}
?> -->