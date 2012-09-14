<!-- /app/views/elements/update_fuentefinanciamiento.ctp -->
<!-- <h3>Div Dos</h3> --> 
<?php echo $this->Form->input('fuentes',
					array(
						'label' => 'Fuentes de financiamiento:', 
						'id' => 'selectfufin'//,
						//'empty'=>'Seleccione...'
						)); ?> 
<?php
//echo print_r($fuentes);

/*if(!empty($fuentes)) {
  foreach($fuentes as $k => $v) {
    echo "<option value='".$k."'>".$v."</option>";
  }
 }*/

?>

<script>
	$("#selectfufin").kendoComboBox({
    	highLightFirst: true,
    	filter: "contains"
    });
    
    var combobox = $("#selectfufin").data("kendoComboBox");
    combobox.list.width(400);
</script>