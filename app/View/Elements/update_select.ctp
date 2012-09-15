<?php //print_r($options) 
/*if(!empty($options)) {
  foreach($options as $k => $v) {
    echo "<option value='$k'>$v</option>";
  }
 }
*/
?>

<script>
	
	



$(document).ready(function(){


	var items = [
		
		<?php foreach($options as $k => $v) { 
			echo '{ text: "'.$v.'", value: "'.$k.'" },';
		} ?> 
		
	
	];
	
	$("#select2").kendoComboBox({
	    dataTextField: "text",
	    dataValueField: "value",
	    dataSource: items,
	    index: 0,
	    suggest: true,
	    filter: 'none'
	});


});




	
</script>
