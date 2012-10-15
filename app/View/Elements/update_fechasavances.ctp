<script>
$(document).ready(function(){


	var items = [
		
		<?php foreach($fechas as $k => $v) { 
			echo '{ text: "'.$v.'", value: "'.$k.'" },';
		} ?> 
	];
	

	var fechas = $("#fechas").kendoDropDownList({
                        autoBind: false,
                        
                        optionLabel: "Seleccione fecha",
                        dataTextField: "fechafin",
                        dataValueField: "fechafin",
                        dataSource: items
                            }
                        }
                    }).data("kendoDropDownList");
});
</script>			                    