<!-- File: /app/View/Facturas/index.ctp -->

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
			?> » Facturas 
			» Administración de Facturas 
			
			
		</div>
	</div>
	
<?php $this->end(); ?>



<div id="example" class="k-content">
	<div id="formulario">
		<h2>Seleccionar Contrato:</h2>
		<?php echo $this->Form->create('Facturas'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('proyectos',
					array(
						'label' => 'Proyectos:', 
						'id' => 'proyectos',
						'class' => 'k-combobox'
					)); ?>
				<div id="error1" class="error-message"></div>
			</li>
			<li>
				<?php echo $this->Form->input('contratos',
					array(
						'label' => 'Contratos:', 
						'id' => 'contratos',
						'class' => 'k-combobox'
					)); ?>
				<div id="error2" class="error-message"></div>
			</li>
						<!--<td><a class="k-button"><span class="k-icon k-i-pencil"></span></a> <a class="k-button"><span class="k-icon k-i-close"></span></a></td>-->
		</ul>
	</div>

	<div id='facturas'>
	
	</div>
	
		<?php echo $this->ajax->observeForm( 'FacturasIndexForm', 
    		array(
        		'url' => array( 'action' => 'update_facturas'),
        		'update' => 'facturas'
    		) 
		); ?>
	
	<style scoped>
	
		.k-textbox {
		    width: 70px;
		}
		
		.k-combobox {
		    width: 200px;
		}
		
		#tablat {
			vertical-align: top;
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
		    width: 150px;
		    text-align: right;
		    margin-right: 5px; 
		}
		
		.etiqueta {
		    display: inline-block;
		    width: 150px;
		    
		    margin-right: 5px; 
		}
		
		
		form .required label:after {
			font-size: 1.4em;
			color: #e32;
			content: '*';
			display:inline;
		}
		
		.required {
		    font-weight: bold;
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
		
		</style>
		
	<script>
		$(document).ready(function() {
		    
			$("#proyectos").kendoDropDownList({
				optionLabel: "Seleccione proyecto",
		        
		        dataTextField: "numeroproyecto",
		        dataValueField: "idproyecto",
		        dataSource: {
		                        type: "json",
		                        transport: {
		                            read: "/Facturas/proyectojson.json"
		                        }
		                    }
		    });
		    
		    var proyectos = $("#proyectos").data("kendoDropDownList");
		    
		    var contratos = $("#contratos").kendoDropDownList({
		                    autoBind: true,
		                    
		                    cascadeFrom: "proyectos",
		                    optionLabel: "Seleccione contrato",
		                    dataTextField: "codigocontrato",
		                    dataValueField: "idcontrato",
		                    dataSource: {
		                        type: "json",
		                        transport: {
		                            read: "/Facturas/contratojson.json"
		                        }
		                    }
		                }).data("kendoDropDownList");
		                
			$("#AvanceprogramadoIndexForm").submit( function(){
		        var selectpro = $("#proyectos").val();
		        var selectfue = $("#contratos").val();
		 			
		            if(selectpro == ""){
		                $('#error1').text("Seleccione un Proyecto");
		                return false;
		            } else if(selectfue == ""){
		                $('#error2').text("Seleccione un Contrato");
		                return false;
		            } else {
		                $('.error-message').hide();
		                alert('Ok!');
		                return true;
		            }
		    });
		});
	</script>

</div>
