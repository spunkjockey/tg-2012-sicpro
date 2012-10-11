<!-- File: /app/View/Metas/add.ctp -->

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Registrar Metas</h2>
		
				<?php echo $this->Form->create('Metas'); ?>
		<ul>
			<?php echo $this->Form->input('descripcionmeta', 
					array(
						'label' => 'Descripcion de la meta:', 
						'class' => 'k-textbox', 
						'id' => 'descmeta',
						'div' => array('class' => 'requerido'),
						'placeholder' => 'Descripcion de la Meta')); ?>
				<script type="text/javascript">
		            var descmeta = new LiveValidation( "descmeta", { validMessage: " " } );
		            descmeta.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		        </script> 
			</li>
			<li  class="accept">
				<?php echo $this->Form->end(array('label' => 'Registrar Meta', 'class' => 'k-button')); ?>

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
				
				.k-dropdownlist{
                    width: 200px;
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
                    
                    $("#phone").mask("9999-9999");
                    
                   $("#nit").mask("9999-999999-999-9");
                });
</script>