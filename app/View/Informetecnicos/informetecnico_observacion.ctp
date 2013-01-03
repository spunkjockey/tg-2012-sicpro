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
			?> Control y seguimiento » Informe técnico » Consultar informe técnico 
			
		</div>
	</div>

<?php $this->end(); ?>
<div id="example" class="k-content">
	<div id="formulario">
		<h2>Consultar informe técnico</h2>
		<?php echo $this->Form->create('Informetecnico',array('action' => 'informetecnico_observacion')); ?>
		<!---- Datos informe  ---->
		<?php
			if(isset($info['Informetecnico']['antecedentes']))
			{
				$antec=$info['Informetecnico']['antecedentes'];
				$anota=$info['Informetecnico']['anotacion'];
			}
			else {
				$antec='';
				$anota='';
			}
		?>
		<ul>
			<li>
				<h3>Contenido informe:</h3> 
				<p><strong>Antecedentes</strong>:<br>
					<?php echo $antec?>
				</p>
			</li>
			<li>
				<p><strong>Cuerpo del informe:</strong><br>
					<?php echo $anota?></p>
			</li>
		<!--- Fotos --->
			<h3>Fotografías de la visita</h3>
				<?php
					$results = $this->Upload->listing ('Informetecnico', $idinfo);
					$directory = $results['directory'];
					$baseUrl = $results['baseUrl'];
					$files = $results['files'];
					echo "<table>";
					foreach ($files as $file) {
					    $type = pathinfo($file, PATHINFO_EXTENSION);
					    $f = basename($file);
					    $url = $baseUrl . "/$f";
					    echo "<tr><td>";
					    echo "<img src='" . Router::url("/") . "ajax_multi_upload/img/fileicons/$type.png' /> <a href='$url'>" . $f . "</a><br />\n";
						echo "</td></tr>";
					}
					echo "</table>";
				?>
		<!--- Otras observaciones --->
			<h3>Observaciones de otros:</h3>
			<?php
				if($otros!=false)
				{
					foreach ($otros as $ot):?>
						<p>
							<strong class:'etiqueta'>
							<?php echo $ot['Persona']['nombrespersona']." ".$ot['Persona']['apellidospersona'].
									" (".$ot['Observacion']['userc'].") el "
									.date('d/m/Y',strtotime( $ot['Observacion']['fechaingresoobservacion']))." dijo:";?></strong><br>
							<?php echo $ot['Observacion']['observacioninforme']; ?><br>
						</p>
					<?php endforeach; 
				}
				else
					echo "No hay observaciones de otros usuarios a este informe técnico";
				?>
			<!--- Formulario -->
			<?php
				if(isset($datos['User']['idpersona']))
				{
					$idper=$datos['User']['idpersona'];
					$rolus=$datos['Rol']['rol'];
				}
				else {
					$idper='';
					$rolus='';
				}
			?>
			<h3>Añada su observación:</h3>
			<?php
				switch ($rolus) {
					case 'Director':
					case 'Admincon':
					case 'Tecproy':
						echo "<li>";
						echo $this->Form->create('Informetecnico',array('action' => 'informetecnico_observacion_info'));
						echo $this->Form->input('Informetecnico.observ', 
								array(
									'label' => 'Observaciones:', 
									'id' => 'obser',
									'class'=>'k-textbox',
									'placeholder'=>'Ingrese sus observaciones a este informe',
									'rows'=>'5',
									'div' => array('class' => 'requerido')
									));
							 
						echo "</li>";
						echo $this->Form->input('Informetecnico.idpersona', 
								array(
								'value'=>$idper,
								'type' => 'hidden'));
						echo $this->Form->input('Informetecnico.idinformetecnico', 
								array(
								'value'=>$idinfo,
								'type' => 'hidden'));
						?>
						<li  class="accept">
							<table>
								<tr>
									<td>
										<?php echo $this->Form->end(array('label' => 'Registrar', 
												'class' => 'k-button', 'id' => 'button')); ?>
									</td>
									<td>	
										<?php echo $this->Html->link('Regresar', 
											array('controller' => 'Informetecnicos','action' => 'informetecnico_consultar'),
											array('class'=>'k-button')); ?>
									</td>
								</tr>
							</table>
						</li>
						<?php
						break;
					default:
						echo "<strong>Lo sentimos!</strong><br>
							   Usted no se encuentra habilitado para ingresar observaciones a este informe técnico<br>";
						
						
						echo "<li class=\"accept\">".
								$this->Html->link('Regresar', 
								array('controller' => 'Informetecnicos','action' => 'informetecnico_consultar'),
								array('class'=>'k-button'))."</li>";
							
						break;
				}
			?>
							
				<script type="text/javascript">
					var obser= new LiveValidation( "obser", { validMessage: " " } );
					obser.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
					obser.add(Validate.Length, { maximum: 250, tooLongMessage:"Longitud máxima de 250 caracteres" } );
				</script>
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
				    font-weight:bold;
				    margin:0 0 0 5px;
				}
				
				.LV_valid {
				    color:#00CC00;
				}
					
				.LV_invalid {
				    color:#CC0000;
					clear:both;
               		display:inline-block;
               		margin-left: 170px; 
               
				}
				    
				.LV_valid_field,
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
        
		});
                
</script>