<?php $this->start('menu');
	switch ($this->Session->read('User.idrol')) {
		case 9:
	        echo $this->element('menu/menu_all');
	        break;
	    case 8:
	        echo $this->element('menu/menu_observer');
	        break;
	    case 7:
	        echo $this->element('menu/menu_jefeplan');
	        break;
		case 6:
	        echo $this->element('menu/menu_tecproy');
	        break;
	    case 5:
	        echo $this->element('menu/menu_tecplan');
	        break;
	    case 4:
	        echo $this->element('menu/menu_adminsys');
	        break;
		case 3:
	        echo $this->element('menu/menu_admincon');
	        break;
	    case 2:
	        echo $this->element('menu/menu_adminproy');
	        break;
	    case 1:
	        echo $this->element('menu/menu_director');
	        break;			
	}
$this->end(); ?>

<?php $this->start('breadcrumb'); ?>
	
	<div id="menuderastros">
		<div id="rastros">
			
			<?php
			echo $this->Html->image("home.png", array(
	    		"alt" => "Inicio",
	    		'url' => array('controller' => 'mains'),
				'width' => '30px',
				'class' => 'homeimg'
			));
			?> Control y seguimiento » Actualizar porcentaje de avance de meta
			
		</div>
	</div>
<?php $this->end(); ?>

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Actualizar meta</h2>
		
		<?php echo $this->Form->create('Meta',array('action' => 'meta_actualizarpje')); ?>
		
		<ul>
			<li>
				<table>
					<tr>
					<td><label>Componente:</label></td><td><?php echo $this->data['Componente']['nombrecomponente'];?></td>
					</tr>
					
					<tr>
					<td><label>Meta:</label></td><td><?php echo $this->data['Meta']['descripcionmeta'];?></td>
					</tr>
					
					<tr>
					<td><label>Porcentaje Actual:</label></td><td><?php echo $this->data['Meta']['porcestimado'] . '%';?></td>
					</tr>
				</table>
			</li>
			<li>
				<?php echo $this->Form->input('porcestimado', 
					array(
						'label' => 'Porcentaje de avance (%)', 
						'type'=>'text',  
						'id' => 'porcestimado',
						'div' => array('id' => 'porcentaje', 'class' => 'requerido'),
						'maxlength'=>'5')); ?>
				<script type="text/javascript">
					var porcestimado = new LiveValidation( "porcestimado", { validMessage: " ", insertAfterWhatNode: "porcentaje" } );
		            porcestimado.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            porcestimado.add( Validate.Numericality,{ minimum: 0, maximum: 100, tooLowMessage: "El porcentaje no puede ser menor a 0 %", tooHighMessage: "El porcentaje no debe ser mayor al 100 %", notANumberMessage:"Debe ser un número"} );
		        </script>
			</li>
			<?php echo $this->Form->input('idc', array('type' => 'hidden','value'=>$idc)); ?>
			<li  class="accept">
				<table>
					<tr>
						<td>
							<?php echo $this->Form->end(array('label' => 'Actualizar', 'class' => 'k-button')); ?>
						</td>
						<td>
							<?php echo $this->Html->link('Regresar', 
									array('controller' => 'Metas','action' => 'meta_indexmetas',$idc),
									array('class'=>'k-button')); ?>
						</td>
					</tr>
				</table>
			</li>
            
            <li class="status">
            </li>
		</ul>
	</div>
</div>

<style scoped>
	.k-textbox {
    	width: 300px;
	}  

	.k-textbox:focus{background-color: rgba(255,255,255,.8);}

	.k-combobox {
	    width: 300px;
	}
	
	form .requerido label:after {
		font-size: 1.4em;
		color: #e32;
		content: '*';
		display:inline;
		}
	
	#formulario {
	    width: 600px;
	    margin: 15px 0;
	    padding: 10px 20px 20px 0px;
	}
	
	#formulario h3 {
	    font-weight: normal;
	    font-size: 1.4em;
	    border-bottom: 1px solid #ccc;
	}
	
	#formulario ul {
	    list-style-type: none;
	    margin: 0;
	    padding: 0;
	}
	#formulario li {
	    margin: 10px 0 0 0;
	}
	
	label {
	    display: inline-block;
	    width: 150px;
	    text-align: right;
	    margin-right: 5px;
	}
	
	.accept, .status {
		padding-top: 15px;
	    padding-left: 150px;
	}
	
	.valid {
	    color: green;
	}
	
	.invalid {
	    color: red;
	}
	span.k-tooltip {
	    margin-left: 6px;
	}
	
	.LV_validation_message{
	    
	    margin:0 0 0 5px;
	}
	
	.LV_valid {
	    color:#00CC00;
	    display:none;
	}
		
	.LV_invalid {
	    color:#CC0000;
		clear:both;
		display:inline-block;
		margin-left: 155px; 
	               
	}
</style>
            
<script>
	$(document).ready(function() {
    	$("#porcestimado").kendoNumericTextBox({
        	decimals: 2,
            min: 0,
			spinners: false
        });
	});
</script>