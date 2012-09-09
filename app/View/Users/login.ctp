<div class="container">
	<section class="login">
    	<h1>iniciar sesion</h1>
    	
      	<?php echo $this->Form->create('User'); ?>
      	<?php $this->Form->inputDefaults(array('label' => false,'div' => false,)); ?>
	    
	    <p><?php echo $this->Form->input('username', array('placeholder'=>'Nombre de Usuario')); ?></p>
	    
	    <p><?php echo $this->Form->input('password', array('placeholder'=>'Contraseña')); ?></p>
	    
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
        
        <?php echo $this->Session->flash('auth'); ?>
        <?php echo $this->Session->flash(); ?>
    
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
      &copy; 2012 SICPRO &ndash;
      <a href="http://www.webinterfacelab.com/mit-license" target="_blank" rel="nofollow">Licencia MIT</a><br>
      Powered by CakePHP
  </section>


