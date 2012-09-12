<!-- File: /app/View/Componentes/add.ctp -->

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Registrar Componentes</h2>
		
				<?php echo $this->Form->create('Componentes'); ?>
		<ul>
			
			
			
			<li  class="accept">
				<?php echo $this->Form->end(array('label' => 'Registrar Empresa', 'class' => 'k-button')); ?>
				<?php echo $this->Form->button('Reset', array('type' => 'reset','class' => 'k-button')); ?>
			</li>
            
            <li class="status">
            </li>
		</ul>
	</div>
</div>