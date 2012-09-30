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

    
    	<div id="test" style="padding:10px;"></div>    	    	
    	<div class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" id="deselect">Reset item selection</div>
    	<div class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" id="undo">Undo to initial selection</div>
    	<div class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" id="selectall">Select all</div>
    	<div class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" id="deselectall">Deselect all</div>
    	<div class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" id="selectoption">Select option Luke</div>
    	<div class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" id="deselectoption">Deselect option Luke</div>
    	<div class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" id="getselected">Get selected (to debug.console)</div>    	
    	<div class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" id="getdata">Get data (to debug.console)</div>    	


    <script type="text/javascript">    
        $(function(){
        	var widget = $('#test').listpicker({
	        	'dictionary' : {
	        		"key1":"Luke Skywalker",
	        		"key2":"Anakin Skywalker",
	        		"key3":"Obi-Wan Kenobi"
	        	},
	        	'selected' : [
	        		"key2", "key3"
	        	],
		     	'size' : 12,
		     	'width' : 800,
		     	'multiple' : true,
				'sourcelistid' : 'sourcelist1',
				'selectedlistid' : 'selectedlist1',
				'sourcetitle' : 'JEDI',
				'selectedtitle' : 'THE DARK SIDE'
	        });

	        $('#deselect').click(function(){
	        	widget.listpicker('resetselection');
	        });

	        $('#undo').click(function(){
	        	widget.listpicker('undo');
	        });

	        $('#selectall').click(function(){
	        	widget.listpicker('selectall');
	        });

	      	$('#deselectall').click(function(){
	        	widget.listpicker('deselectall');
	        });

	        $('#selectoption').click(function(){
	        	widget.listpicker('selectoption','key1');
	        });

	        $('#deselectoption').click(function(){
	        	widget.listpicker('deselectoption','key1');
	        });

	        $('#getselected').click(function(){
	        	var result = widget.listpicker('getselected');
	        	console.debug(result);
	        });

	        $('#getdata').click(function(){
	        	var result = widget.listpicker('getdata');
	        	console.debug(result);
	        });
        });
    </script>   
    
    <style scoped>
    	.ui-widget {
    		font-size: 10px;	
    	}

    	.ui-button {
    		font-size: 12px;
    		padding: 4px;
    	}
    </style>