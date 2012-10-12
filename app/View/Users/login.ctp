<div class="container">
	
	<section class="login">
    	<h1>iniciar sesion</h1>
    	
      	<?php echo $this->Form->create('User'); ?>
      	
      	<!--<?php echo $this->Session->flash('auth'); ?>-->
        <?php echo $this->Session->flash(); ?>
      	
      	<?php $this->Form->inputDefaults(array('label' => false,'div' => false,)); ?>
	    
	    
	    
	    <p><?php echo $this->Form->input('username', array(
	    	'id' => 'username',
	    	'placeholder'=>'Nombre de Usuario')); ?></p>
	    
	    <!--
	    <script type="text/javascript">
					var username = new LiveValidation( "username", { validMessage: " " } );
					username.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		</script>
	    -->
	    
	    
	    <p><?php echo $this->Form->input('password', array(
	    	'id' => 'password',
	    	'placeholder'=>'Contraseña')); ?></p>
	    
	    <!--
	    <script type="text/javascript">
					var password = new LiveValidation( "password", { validMessage: " " } );
					password.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		</script>
		-->
		
	    <p class="remember_me">
			<label>
		    	<input type="checkbox" name="remember_me" id="remember_me">
		        Recordarme en esta computadora
		    </label>
	    </p>
	    
	    <p class="submit">
        	<?php echo $this->Form->end(array('label' => 'Login', 'name' => 'commit', 'div' => false)); ?>
        	<?php //echo $this->Form->end(__('Login'), array( 'name'=>'commit')); ?>
        </p>
        
        
    
    </section>

    <section class="login-help">
      <p>¿Ha olvidado su contraseña? Contacte al Administrador.</p>
    </section>
  </div>

  <section class="about">
    <!--<p class="links">
      <a href="http://www.webinterfacelab.com/snippets/login-form" target="_parent">View Article</a>
      <a href="http://www.webinterfacelab.com/snippets/login-form.zip" target="_parent">Download Snippet</a>
    </p> -->
    <p class="author">
      <a href="#" target="_blank" rel="nofollow"> &copy; 2012 SICPRO </a><br>
      <a href="#" target="_blank" rel="nofollow">Propiedad de la Universidad de El Salvador</a><br>
      
  </section>

			<style scoped>

 				.LV_validation_message{
				    /*font-weight:bold;*/
				    margin:0 0 0 5px;
				}
				
				.LV_valid {
				    color:#00CC00;
				    margin-left: 10px;
				}
					
				.LV_invalid {
				    color:#CC0000;
				    
					clear:both;
               		display:inline-block;
               		margin-left: 20px; 
               
				}
				
				.message {
				    color:#CC0000;
				    
					clear:both;
               		display:inline-block;
               		margin-left: 10px; 
               
				}
/*				    
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
*/                

            </style>


<script>
	
			$("input").focusin(function () {
  						$("#flashMessage").fadeOut("slow");
  				});
                
                
            
	
</script>