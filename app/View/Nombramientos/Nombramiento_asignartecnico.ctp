<!-- File: /app/View/Nombramientos/Nombramiento_asignartecnico.ctp -->
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
			?> » Bienvenido a SICPRO
			
		</div>
	</div>
	
<?php $this->end(); ?>

<div class="multiselect">
	
	
</div>

<script>
	$(document).ready(function() {
		$(".multiselect").twosidedmultiselect();
	}
</script>
<style>
	.tsmsselect {
                        width: 40%;
                        float: left;
                }
                
                .tsmsselect select {
                        width: 100%;
                }
                
                .tsmsoptions {
                        width: 20%;
                        float: left;
                }
                
                .tsmsoptions p {
                        margin: 2px;
                        text-align: center;
                        font-size: larger;
                        cursor: pointer;
                }
                
                .tsmsoptions p:hover {
                        color: White;
                        background-color: Silver;
                }
</style>