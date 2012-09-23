<!-- File: /app/View/Estimacions/RegistrarEstimacion.ctp -->

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Registrar Estimación de Avance}</h2>
		
				<?php echo $this->Form->create('Estimacion'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('proyectos',
					array(
						'label' => 'Seleccione Proyecto:', 
						'id' => 'select',
						//'selected' => '05',
						'empty' => 'Seleccione...', 
						'required' 
						, 
						'validationMessage' => 'Seleccione Proyecto')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('contratos',
					array(
						'label' => 'Seleccione Contrato:', 
						'id' => 'select',
						//'selected' => '05',
						'empty' => 'Seleccione...', 
						'required' 
						, 
						'validationMessage' => 'Seleccione Contrato')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('tituloestimacion', 
					array(
						'label' => 'Título Estimación: ', 
						'class' => 'k-textbox', 
						'placeholder' => 'Título Estimación',
						"rows"=>"5", 
						'required', 
						'validationMessage' => 'Ingrese el Título de la Esimación')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('fechainicioestimacion', 
					array(
						'label' => 'Inicio Estimación:', 
						'id'	=> 'datePicker1',
						'type'  => 'Text'
						 ) ); ?>
			</li>
			<li>
				<?php echo $this->Form->input('fechafinestimacion', 
					array(
						'label' => 'Fin Estimación:', 
						'id'	=> 'datePicker1',
						'type'  => 'Text'
						 ) ); ?>
			</li>
			<li>
				<?php echo $this->Form->input('montoestimado', 
					array(
						'label' => 'Monto Estimado:',
						'id'    => 'moneda',
						'placeholder' => 'Monto Estimado', 
						'validationMessage' => 'Ingrese el Monto Estimado')); ?>
		    </li>
		    <li>
				<?php echo $this->Form->input('porcentajeestimadoavance', 
					array(
						'label' => 'Porcentaje Estimación: ', 
						'class' => 'k-textbox1', 
						'placeholder' => 'Porcentaje Estimado',
						"rows"=>"5", 
						'required', 
						'validationMessage' => 'Ingrese el Porcentaje Esimado')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('documentoestimacion', 
					array(
						'label' => 'Subir Documentos: ', 
						'class' => 'k-textbox', 
						'placeholder' => 'Subir Documentos',
						"rows"=>"5", 
						'required', 
						'validationMessage' => 'Cargue los Documentos')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('fechaestimacion', 
					array(
						'label' => 'Fecha Estimación:', 
						'id'	=> 'datePicker1',
						'type'  => 'Text'
						 ) ); ?>
			</li>
			<li  class="accept">
				<?php echo $this->Form->input('userc', array('type' => 'hidden', 'value'=> $this->Session->read('User.username') )); ?>
				<?php echo $this->Form->end(array('label' => 'Registrar Estimación', 'class' => 'k-button')); ?>
			</li>
			 <li class="status">
            </li>
		</ul>
		
	</div>
</div>

            <style scoped>

                .k-textbox {
                    width: 300px;
                    margin-left: 5px;
                    
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
                    width: 150px;
                    text-align: right;
                    
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
                    color: gray;
                }
                span.k-tooltip {
                    margin-left: 6px;
                }
            </style>
            
            <script>
                $(document).ready(function() {
                    var validator = $("#formulario").kendoValidator().data("kendoValidator"),
                    status = $(".status");

                    $("button").click(function() {
                        if (validator.validate()) {
                            //status.text("Hooray! Your tickets has been booked!").addClass("valid");
                            } else {
                            //status.text("Oops! There is invalid data in the form.").addClass("invalid");
                        }
                    });


		$("#datePicker1").kendoDatePicker({
		   format: "yyyy/MM/dd" //Define el formato de fecha
		});
         $("#moneda").kendoNumericTextBox({
		     format: "c2", //Define currency type and 2 digits precision
		     spinners: false
		 });
		 
		 $("#select").kendoComboBox({
			         //placeholder: "Seleccionar...",
			         //index: -1,
			         suggest: true
			    });
			    
			    $("#k-textbox1").kendoNumericTextBox({
     format: "p",
     value: 0.15 // 15 %
 });
	         
	                });
            </script>
			
			
