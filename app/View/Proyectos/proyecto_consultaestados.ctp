<!-- File: /app/View/Proyectos/proyecto_consultaestados.ctp -->

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
			?> Proyecto » Consultar Estados
			
		</div>
	</div>
<?php $this->end(); ?>

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Consultar Estados</h2>
		<?php echo $this->ajax->form(array('type' => 'post',
		    'options' => array(
		        'model'=>'Proyecto',
		        'update'=>'consultaestados',
		        'url' => array(
		        	'controller' => 'Proyectos',
		            'action' => 'update_consultaestados'
		        )
		    )
		)); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('start',
					array(
						'label' => 'Fecha inicio:', 
						'id' => 'start',
						'div' => array('id' => 'startd', 'class' => 'requerido'),
						'value' => date('d/m/Y')
						)); ?>
				<script type="text/javascript">
		            var start = new LiveValidation( "start", { validMessage: " ", insertAfterWhatNode: "stard" } );
		            start.add(Validate.Presence, { failureMessage: "Selecciona una fecha de inicio" } );
		        </script>
			</li>
            <li>
				<?php echo $this->Form->input('end',
					array(
						'label' => 'Fecha fin:', 
						'id' => 'end',
						'div' => array('id' => 'endd', 'class' => 'requerido'),
						'value' => date('d/m/Y')
						)); ?>
				<script type="text/javascript">
		            var end = new LiveValidation( "end", { validMessage: " ", insertAfterWhatNode: "endd" } );
		            end.add(Validate.Presence, { failureMessage: "Selecciona una fecha de fin" } );
		        </script>
			</li>
			<li>
				<?php echo $this->Form->input('divisiones',
					array(
						'label' => 'Division:', 
						'div' => array('id' => 'divi', 'class' => 'requerido'),
						'class' => 'k-dropdownlist',
						'id' => 'division'
					)); ?>
				<script type="text/javascript">
		            var division = new LiveValidation( "division", { validMessage: " ", insertAfterWhatNode: "divi" } );
		            division.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		        </script> 
			</li>
			<li  class="accept">
				<table>
				<tr><td>
				<?php //echo $this->Form->end(array('label' => 'Consultar', 'class' => 'k-button', 'id' => 'submit')); ?>
				
				<?php echo $this->Ajax->submit('Buscar', array('class' => 'k-button','url'=> array('controller'=>'Proyectos', 'action'=>'update_consultaestados'), 'update' => 'consultaestados')); ?>
				<?php echo $this->Form->end();?> 
				</td>
				<td>
				<?php echo $this->Html->link('Regresar',
					array('controller' => 'Mains', 'action' => 'index'),array('id' => 'regresar','class'=>'k-button')); 
				?>	
				</td></tr>
				</table>
				</li>
            
            <li class="status">
            </li>
		</ul>
		<div id="consultaestados"></div>
	</div>
</div>

<style scoped>

                .k-textbox {
                    width: 300px;
               }
				
				.k-dropdownlist{
                    width: 300px;
                }
			
			
                #formulario {
                    width: 600px;
                    /*height: 323px;*/
                    margin: 15px 0;
                    padding: 10px 20px 20px 0px;
                    /*background: url('../../content/web/validator/ticketsOnline.png') transparent no-repeat 0 0;*/
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
                    width: 160px;
                    text-align: right;
                    margin-right: 5px;
                    
                }

                /*.required {
                    font-weight: bold;
                }*/
                
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
                
               
               
                
				
				.LV_validation_message{
				    /*font-weight:bold;*/
				    margin:0 0 0 5px;
				}
				
				.LV_valid {
				    color:#00CC00;
				}
					
				.LV_invalid {
				    color:#CC0000;
					clear:both;
               		display:inline-block;
               		margin-left: 165px; 
               
				}
				    
			/*	.LV_valid_field,
				input.LV_valid_field:hover, 
				input.LV_valid_field:active,
				textarea.LV_valid_field:hover, 
				textarea.LV_valid_field:active {
				    border: 1px solid #00CC00;
				}
				    
				.LV_invalid_field, 
				input.LV_invalid_field:hover, 
				input.LV_invalid_field:active,
				textarea.LV_invalid_field:hover, 
				textarea.LV_invalid_field:active {
				    border: 1px solid #CC0000;
				}*/
                
                
                #errorproyecto {
                	display: none;
                }
</style>

<script>
	$(document).ready(function() {
    	
    	var proyo =$("#division").kendoDropDownList({
			optionLabel: "Seleccione Division",
            dataTextField: "divison",
            dataValueField: "iddivision",
            dataSource: {
                            type: "json",
                            transport: {
                                read: "/Proyectos/divisionesjson.json"
                            }
                       }
        }).data("kendoDropDownList");

	function filtrarDrop() {
		var startDate = start.value();
		var endDate = end.value();
			//alert('dafuq');
			/*proy.data("kendoDropDownList").dataSource.filter([
				     { field: "creacion", operator: "gte", value: startDate },
				     { field: "creacion", operator: "lte", value: endDate }
				]);
			*/
			
			//proy.data("kendoDropDownList").dataSource.filter({ field: "idproyecto", operator: "eq", value: 5});
	}    
        
	function startChange() {
		var startDate = start.value();
		if (startDate) {
            startDate = new Date(startDate);
            startDate.setDate(startDate.getDate() + 1);
            end.min(startDate);
    	}
    }
	
	function endChange() {
		var endDate = end.value();
	    if (endDate) {
	        endDate = new Date(endDate);
	        endDate.setDate(endDate.getDate() - 1);
	        start.max(endDate);
	    }
	}

    var start = $("#start").kendoDatePicker({
        culture: "es-ES",
	   	format: "dd/MM/yyyy",
        change: startChange,
        close: filtrarDrop
    }).data("kendoDatePicker");
	
    var end = $("#end").kendoDatePicker({
        culture: "es-ES",
	   	format: "dd/MM/yyyy",
        change: endChange,
        close: filtrarDrop
    }).data("kendoDatePicker");
	
    start.max(end.value());
    end.min(start.value());
    });                    
</script>