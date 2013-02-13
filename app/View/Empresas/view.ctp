<!-- File: /app/View/Empresas/view.ctp -->
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
			?> » Mantenimiento » Empresa » Detalle Empresa
			
		</div>
	</div>
	
<?php $this->end(); ?>
<h2>Detalles Empresa</h2>
<table id="grid2">
    <tr>
        <th data-field="nitempresa">NIT empresa: </th>
        <td>
	        <?php 
						$nit1 = substr($empresas['Empresa']['nitempresa'],0 , -10);
						$nit2 = substr($empresas['Empresa']['nitempresa'],4 , -4);
						$nit3 = substr($empresas['Empresa']['nitempresa'],10 , -1);
						$nit4 = substr($empresas['Empresa']['nitempresa'],-1);
						echo $nit1 .'-'. $nit2 . '-'.$nit3 .'-'.$nit4; 
			?>
		</td>
    </tr>
    <tr>
    	<th data-field="nombreempresa">Nombre empresa: </th>
    	<td><?php echo $empresas['Empresa']['nombreempresa']; ?></td>
    </tr>
    <tr>
    	<th data-field="direccionoficina">Direccion: </th>
    	<td><?php echo ($empresas['Empresa']['direccionoficina']); ?></td>
    </tr>
    <tr>
    	<th data-field="representantelegal">Representante: </th>
    	<td><?php echo ($empresas['Empresa']['representantelegal']); ?></td>
    </tr>
    <tr>
    	<th data-field="telefonoempresa">Telefono: </th>
    	<td>
    		 <?php 
						$tel1 = substr($empresas['Empresa']['telefonoempresa'],0 , 4);
						$tel2 = substr($empresas['Empresa']['telefonoempresa'], -4);
						echo $tel1 .'-'. $tel2; 
			?>
    	</td>
    </tr>
    <tr>
    	<th data-field="correorepresentante">E-mail: </th>
    	<td><?php echo ($empresas['Empresa']['correorepresentante']); ?></td>
    </tr>
</table>
<br />
<table id="grid3">
	<tr>
		<td align="right">
			<?php echo $this->Html->link(
					'Regresar', 
					array('controller' => 'Empresas', 'action' => 'index'),
					array('class'=>'k-button')
			); ?>
		</td>
	</tr>
</table>			

<style>
	#grid2 {
		color: black;
	}
	
	#grid2 tr {
		height: 40px;
	}
	#grid2 th {
		width: 150px;
		text-align: right;
		padding-right:20px;
	}  
	
	#grid2 td {
		width: 400px;
	}
	
	#grid3 td {
		width: 550px;
		text-align: right;
	}
	
</style>		






<!--
<script>
	$(document).ready(function() {
		
		<?php echo 'var idempresa = '.$emp["Empresa"]["idempresa"].';'; ?>
		
    	$("#grid2").kendoGrid({
            	dataSource: {
	           		pageSize: 10,
            	},
            	pageable: true,
            	pageable: {
            		messages: {
            			display: "{0} - {1} de {2} Empresas",
            			empty: "No empresas a mostrar",
            			page: "Página",
            			of: "de {0}",
            			itempsPerPage: "Empresas por página",
            			first: "Ir a la primera página",
            			previous: "Ir a la página anterior",
            			next: "Ir a la siguiente página",
            			last: "Ir a la última página",
            			refresh: "Actualizar"
            		}
            	},
            	sortable: true,
            	sortable: {
 			    	mode: "single", // enables multi-column sorting
        			allowUnsort: true
				},
				scrollable: false
            	
            	
        	});
        	
    var idemp = 0;
	 function cambiarid(usuario) {
		alert("hola mundo");
		return false;
	}
	 
    var win = $("#window").kendoWindow({
	    draggable: false,
	    modal: true,
        title: "Centered Window",
        content: "empresas/view_w/"+idemp,
        visible: false
    }).data("kendoWindow");

	<?php //echo '$("#openButton"'.$emp['Empresa']['idempresa'].').click(function(){'; ?>
	$("#popup a.k-button").click(function(){
		var win = $("#window").data("kendoWindow");
		win.center();
		win.open();
	});
	

        });
</script>-->