<!-- File: /app/View/Contratos/contrato_detalle.ctp -->
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
			?> » Contratos » Consultar Contrato
			
		</div>
	</div>
	
<?php $this->end(); ?>

<!--<?php Debugger::dump($contratos); ?>-->
<!--<?php Debugger::dump($ordenes); ?>-->
<p>
	<h2>Información Contrato</h2>
	<div id="Proyecto">
		<table id="grid">
		<tbody>
		<tr>
			<td width="30%" class="primerac">Codigo Contrato:</td><td width="60%"><?php echo $contratos['Contrato']['codigocontrato']?></td>
		</tr>
		<tr>
			<td class="primerac">Contrato:</td><td><?php echo $contratos['Contrato']['nombrecontrato']?></td>
		</tr>
		<tr>
			<td class="primerac">Monto Original:</td><td><?php echo '$' . number_format($contratos['Contrato']['montooriginal'],2)?></td>
		</tr>
		<tr>
			<td class="primerac">Tipo Contrato:</td><td><?php echo $contratos['Contrato']['tipocontrato']?></td>
		</tr>
		<tr>
			<td class="primerac">Plazo Ejecucion:</td><td><?php echo $contratos['Contrato']['plazoejecucion']?> días</td>
		</tr>
		<tr>
			<td class="primerac">Orden de Inicio:</td><td>
			<?php 
			if(isset($contratos['Contrato']['ordeninicio'])){
			echo date('d/m/Y',strtotime($contratos['Contrato']['ordeninicio']));
			}
			else {
				{echo "Orden de Inicio no disponible";}
			}
			?>
			</td>
		</tr>
		<tr>
			<td class="primerac">Detalle de Obras:</td><td><?php echo $contratos['Contrato']['detalleobras']?></td>
		</tr>
		<tr>
			<td class="primerac">Estado contrato:</td><td>
			<?php 
			if(isset($contratos['Contrato']['estadocontrato'])){
			echo $contratos['Contrato']['estadocontrato'];
			}
			else {
				echo "Estado no disponible";
			}
			?>
			</td>
		</tr>
		<tr>
			<td class="primerac">Administrador de Contrato:</td><td><?php echo $contratos['Persona']['nombrespersona']. ' '.$contratos['Persona']['apellidospersona']?></td>
		</tr>
		<tr>
			<td class="primerac">Empresa:</td><td><?php echo $contratos['Empresa']['nombreempresa']?></td>
		</tr>
		</tbody>
		</table>
		</div>	
			
		<?php 
			if(($contratos['Contrato']['tipocontrato']=='Construcción de obras')&& !empty($ordenes)){ ?>
		<h2>Ordenes de Cambio</h2>
		<div id="tablagrid">
		<table id="grid">
		<thead>
		<tr>
		   <th data-field="Titulo" width="15%">Titulo</th>
		   <th data-field="Monto" width="35%">Monto</th>
		   <th data-field="Descripcion">Descripcion</th>
		   <th data-field="Fecha" width="15%">Fecha</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($ordenes as $oc): ?>
		<tr>
			<td><?php echo $oc['Ordendecambio']['tituloordendecambio']?></td>
			<td><?php echo $oc['Ordendecambio']['montoordencambio']?></td>
			<td><?php echo $oc['Ordendecambio']['descripcionordencambio']?></td>
			<td><?php echo $oc['Ordendecambio']['fecharegistroorden']?></td>
		</tr>
		<?php endforeach ?>
		</tbody>
		</table>
		</div>
			<?php }
		?>
		<br />
		<?php echo $this->Html->link('Regresar',
					array('controller' => 'Contratos', 'action' => 'contrato_consultar'),
					array('id' => 'regresar','class'=>'k-button')); 
		?>	
			
</p>


<style>
	#tablas {
		width: 500px;
		margin-left: 30px;
	}
	
	#Proyecto, #Contrato {
		border-collapse: collapse;
		color: black;
	}
	
	#Proyecto .primerac, #Contrato .primerac {
		font-family: "Trebuchet MS", Arial, sans-serif;
		font-weight: bold;
		text-align: left;
		/*padding-right: 10px;
		min-width: 80px;*/
	}
	
	/* 
	Cusco Sky table styles
	written by Braulio Soncco http://www.buayacorp.com
	*/

	#tablagrid table, #tablagrid th, #tablagrid td {
		border: 1px solid #D4E0EE;
		border-collapse: collapse;
		font-family: "Trebuchet MS", Arial, sans-serif;
		color: #555;
	}
	
	#tablagrid caption {
		font-size: 150%;
		font-weight: bold;
		margin: 5px;
	}
	
	#tablagrid td, #tablagrid th {
		padding: 4px;
		text-align: center;
	}
	
	#tablagrid thead th {
		text-align: center;
		background: #E6EDF5;
		color: #4F76A3;
		font-size: 100% !important;
	}
	
	#tablagrid tbody th {
		font-weight: bold;
	}
	
	#tablagrid tbody tr { background: #FCFDFE; }
	
	#tablagrid tbody tr.odd { background: #F7F9FC; }
	
	#tablagrid table a:link {
		color: #718ABE;
		text-decoration: none;
	}
	
	#tablagrid table a:visited {
		color: #718ABE;
		text-decoration: none;
	}
	
	#tablagrid table a:hover {
		color: #718ABE;
		text-decoration: underline !important;
	}
	
	#tablagrid tfoot th, #tablagrid tfoot td {
		font-size: 100%;
		font-weight: bold;
	}

</style>
