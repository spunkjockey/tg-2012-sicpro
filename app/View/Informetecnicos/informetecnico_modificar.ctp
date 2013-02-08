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
			?> Control y seguimiento » Informe técnico » Modificar informe técnico 
			
		</div>
	</div>
	
<?php $this->end(); ?>

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Modificar informe técnico</h2>
		<?php echo $this->Form->create('Informetecnico'); ?>
		<ul>
			<li>
				<label>Código de Contrato: </label> <?php echo $info['Contratoconstructor']['codigocontrato']; ?>
				<?php echo $this->Form->hidden('idinformetecnico'); ?>
			</li>
			<li>
				<?php echo $this->Form->input('fechavisita', 
					array(
						'label' => 'Fecha de visita:', 
						'id'	=> 'datePicker1',
						'type'  => 'Text',
						
						'maxlength'=> 10,
						'div' => array('id' => 'iniciofecha', 'class' => 'requerido')
						 ) ); ?>
					<script type="text/javascript">
		            var datePicker1 = new LiveValidation( "datePicker1", { validMessage: " ", insertAfterWhatNode: "iniciofecha" } );
		            datePicker1.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            datePicker1.add(Validate.Format, { pattern: /^\d\d\/\d\d\/\d\d\d\d$/, failureMessage: "La Fecha debe contener un formato un formato DD/MM/AAAA"  } );
		        </script> 
			</li>
			<li>
				<?php echo $this->Form->input('fechaelaboracion', 
					array(
						'label' => 'Fecha de elaboración:', 
						'id'	=> 'datePicker2',
						
						'type'  => 'Text',
						'maxlength'=> 10,
						'div' => array('id' => 'finfecha', 'class' => 'requerido')
						 ) ); ?>
				<script type="text/javascript">
		            var datePicker2 = new LiveValidation( "datePicker2", { validMessage: " ", insertAfterWhatNode: "finfecha" } );
		            datePicker2.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            datePicker2.add(Validate.Format, { pattern: /^\d\d\/\d\d\/\d\d\d\d$/, failureMessage: "La Fecha debe contener un formato un formato DD/MM/AAAA"  } );
		        </script>  
			</li>
			<li>
				<?php echo $this->Form->input('antecedentes', 
					array(
						'label' => 'Antecedentes:', 
						'class' => 'k-textbox',
						'id'=> 'txantecedentes', 
						'div' => array('class' => 'requerido'),
						'rows' => 4, 
						'placeholder' => 'Descripción de antecedentes')); ?>
					<script type="text/javascript">
						var txantecedentes = new LiveValidation( "txantecedentes", { validMessage: " " } );
				        txantecedentes.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
				    </script>
			</li>
			<li>
				<?php echo $this->Form->input('anotacion', 
					array(
						'label' => 'Anotaciones:', 
						'class' => 'k-textbox',
						'id'=> 'txanotacion',
						'div' => array('class' => 'requerido'), 
						'rows' => 4, 
						'placeholder' => 'Observaciones de la visita')); ?>
					<script type="text/javascript">
						var txanotacion = new LiveValidation( "txanotacion", { validMessage: " " } );
				        txanotacion.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
				    </script>
			</li>
			<li  class="accept">
			<table>
			<tr><td>			    
				<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
				<?php echo $this->Form->input('userm', array('type' => 'hidden', 'value'=> $this->Session->read('User.username') )); ?>
				<?php echo $this->Form->end(array('label' => 'Editar', 'class' => 'k-button')); ?>
				</td><td>
				<?php echo $this->Html->link('Regresar', array('controller' => 'Informetecnicos','action' => 'informetecnico_index'),
            	array('class'=>'k-button'));?> </td></tr>
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
                
				form .requerido label:after {
                	font-size: 1.4em;
					color: #e32;
					content: '*';
					display:inline;
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
                    width: 140px;
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
                    color: gray;
                }
                span.k-tooltip {
                    margin-left: 6px;
                }
                
 				.LV_validation_message{
				    /*font-weight:bold;*/
				    margin:0 0 0 5px;
				}
				
				.LV_valid {
				    color:#00CC00;
				    margin-left: 10px;
				    display: none;
				}
					
				.LV_invalid {
				    color:#CC0000;
               		display:block;
               		margin-left: 145px;
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
				}
                */
            </style>
            
            <script>
                $(document).ready(function() {
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
	
	    var start = $("#datePicker1").kendoDatePicker({
	        culture: "es-ES",
		   	format: "dd/MM/yyyy",
	        change: startChange,
	        <?php if(isset( $this->request->data['Informetecnico']['fechavisita'] )) 
						{
							 echo 'value: kendo.parseDate("'. $this->request->data['Informetecnico']['fechavisita'] .'", "yyyy-MM-dd"),'; } 
						
						?>
	    }).data("kendoDatePicker");
		
	    var end = $("#datePicker2").kendoDatePicker({
	        culture: "es-ES",
		   	format: "dd/MM/yyyy",
	        change: endChange,
	        <?php if(isset( $this->request->data['Informetecnico']['fechaelaboracion'] )) 
						{
							 echo 'value: kendo.parseDate("'. $this->request->data['Informetecnico']['fechaelaboracion'] .'", "yyyy-MM-dd"),'; } 
						
						?>	
	        	
	    }).data("kendoDatePicker");
		
	    start.max(end.value());
	    end.min(start.value());

		
         
	         
	                });
            </script>