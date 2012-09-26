<script>
$(document).ready(function(){


	var items = [
		
		<?php foreach($options as $k => $v) { 
			echo '{ text: "'.$v.'", value: "'.$k.'" },';
		} ?> 
		
	
	];
	
	$("#selectcon").kendoComboBox({
					dataTextField: "text",
				    dataValueField: "value",
				    dataSource: items,
				    index: 0,
			        suggest: true,
			        filter: 'none'
				});

});
</script>