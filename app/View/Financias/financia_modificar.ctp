<!-- File: /app/View/Financias/financia_modificar.ctp -->

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
			?> » Financia » Asignación de Fondos » Modificar Financiamiento
			
		</div>
	</div>
	
<?php $this->end(); ?>

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Modificar Fondos Asignados</h2>
		<?php echo $this->Form->create('Financia'); ?>
		<ul>
			<li>
				<?php echo '<label>Nombre de Proyecto:</label> '.$this->request->data['Proyecto']['nombreproyecto']; ?>
			</li>
			<li>
				<?php echo '<label>Monto del Proyecto:</label> $'.number_format($this->request->data['Proyecto']['montoplaneado'],2); ?>
			</li>
			<li>
				<?php echo '<label>Fuente de Financiamiento:</label> '.$this->request->data['Fuentefinanciamiento']['nombrefuente']; ?>
			</li>
			<li>
				<?php echo '<label>Financiamiento Disponible:</label> $'. number_format($this->request->data['Fuentefinanciamiento']['montodisponible'],2); ?>
			</li>
			<li> 
				
				<?php echo $this->Form->input('montoparcial',
					array(
						'label' => 'Monto:',
						'div' => array('id' => 'mparcial','class' => 'requerido'), 
						'id' => 'monto', 
						'type' => 'text',
						'class' => 'k-textbox',
						'maxlength' => 13,
						'error' => array('attributes' => array('wrap' => 'span', 'class' => 'LV_validation_message LV_invalid', "id" => 'errormonto'))
					)); ?>
					
				
				<script type="text/javascript">
					var monto = new LiveValidation( "monto", { validMessage: " ", insertAfterWhatNode: "mparcial" } );
		            monto.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            monto.add( Validate.Numericality, { minimum: 0.01, maximum: 999999999.99, tooLowMessage: "El monto no puede ser menor a $0.01", tooHighMessage: "El monto no puede ser mayor a $999,999,999.99", notANumberMessage: "Debe ser un número" } );
		        </script>	
			</li>
			<li  class="accept">
				<?php echo $this->Form->input('idfuentefinanciamiento',array('type' => 'hidden')); ?>
				<?php echo $this->Form->input('fuente_proyecto',array('type' => 'hidden')); ?>
				<?php echo $this->Form->input('userm', array('type' => 'hidden', 'value'=> $this->Session->read('User.username') )); ?>
				<?php echo $this->Form->input('modificacion', array('type' => 'hidden', 'value'=> date('Y-m-d h:i:s') )); ?>
				<table>
					<tr>
						<td>
							<?php echo $this->Form->end(array('label' => 'Modificar Fondo', 'class' => 'k-button', 'id' => 'button')); ?>
						</td>
						<td>
							<?php echo $this->Html->link('Cancelar',array('action' => 'index'),array('class'=>'k-button')); ?>
						</td>
					</tr>
				</table>
			</li>
		</ul>				
	</div>
</div>
<style scoped>

    
    .k-textbox {
        width: 250px;
    }
    
	#formulario #divdos{
        width: 600px;
        margin: 15px 0;
        padding: 10px 20px 20px 0px;
    }

    #formulario h3 {
        font-weight: normal;
        font-size: 1.4em;
        border-bottom: 1px solid #ccc;
    }
    
    #tablafinancia h3 {
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
        width: 160px;
        text-align: right;
        margin-right: 5px; 
    }
    
    .etiqueta {
        display: inline-block;
        width: 150px;
        
        margin-right: 5px; 
    }
    
    
    form .requerido label:after {
    	font-size: 1.4em;
		color: #e32;
		content: '*';
		display:inline;
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
    
    #tablafinancia {
        width: 600px;
        margin: 15px 0;
        padding: 10px 20px 20px 0px;
    }
    
    
    .LV_validation_message{
	   
	    margin:0 0 0 5px;
	}
	
	.LV_valid {
	    color:#00CC00;
	    margin-left: 10px;
	    display: none;
	}
		
	.LV_invalid {
	    color:#CC0000;
		clear:both;
   		display:inline-block;
   		margin-left: 165px; 
   
	}
	    

    
    
    
</style>
            
<script>
    $(document).ready(function() {
        $("#monto").kendoNumericTextBox({
		    min: 0,
			format: "c2",
			placeholder: "Ingrese un monto",
			spinners: false
		});
    
      	$("form").focusin(function () {
			$("#flashMessage").fadeOut("slow");
		});
    	
    	$("#monto").focusin(function () {
			$("#errormonto").fadeOut("slow");
		});
    });
</script>