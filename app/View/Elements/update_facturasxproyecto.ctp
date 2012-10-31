<?php if(!empty($facturas) && !empty($proyectos)) {?>
	
	<div id="tablas" style="margin-bottom: 50px">
		<h3>Proyecto: </h3>
		<table id="Proyecto">
			<tr> <td class="primerac">Número:</td>  <td><?php echo $proyectos['0']['numeroproyecto']; ?></td> </tr>
			<tr> <td class="primerac">Proyecto:</td>  <td><?php echo $proyectos['0']['nombreproyecto']; ?></td> </tr>
			<tr> <td class="primerac">Monto Planeado:</td>  <td><?php echo '$'.number_format($proyectos['0']['montoplaneado'],2); ?></td> </tr>
			<tr> <td class="primerac">Estado:</td>  <td><?php echo $proyectos['0']['estadoproyecto']; ?></td> </tr>
		</table>
		<br />
		<br />
		
		
		<h3>Contratos: </h3>
		<ul id="panelBar">
    	<?php foreach ($facturasa as $fac): ?>
		<li> Contrato: <?php echo $fac['Facturaxcontrato']['codigocontrato']; ?> 
		<div style="padding: 30px 20px;">
			<table id="Contrato">
				<tr> <td class="primerac">Codigo:</td>  <td><?php echo $fac['Facturaxcontrato']['codigocontrato']; ?></td> </tr>
				<tr> <td class="primerac">Contrato:</td>  <td><?php echo $fac['Facturaxcontrato']['nombrecontrato']; ?></td> </tr>
				<tr> <td class="primerac">Tipo:</td>  <td><?php echo $fac['Facturaxcontrato']['tipocontrato']; ?></td> </tr>
				<tr> <td class="primerac">Monto:</td>  <td><?php echo '$'.number_format($fac['Facturaxcontrato']['montooriginal'],2); ?></td> </tr>
				<?php if($fac['Facturaxcontrato']['tipocontrato']!='Supervisión de obras') { ?>
					<tr> <td class="primerac">Estado:</td>  <td><?php echo $fac['Facturaxcontrato']['estadocontrato']; ?></td> </tr>
				<?php } else { ?>
					<tr> <td class="primerac">Contrato a Supervisar:</td>  <td><?php echo $fac['Facturaxcontrato']['con_idcontrato']; ?></td> </tr>
				<?php } ?>
			</table>
		
		<br />
		<h4>Facturas: </h4>
		<div id="tablagrid">
		<table id="grid">
		    <thead>
		    <tr>
		        <th data-field="numerofactura" width="15%">Factura</th>
		        <th data-field="descripcionfactura" width="40%">Concepto</th>
		        <th data-field="montofactura" width="20%">Monto</th>
		        <th data-field="fechafactura" width="25%">Fecha facturada</th>
		    </tr>
		    </thead>
		    <tbody>
		    <?php $suma = 0;?>
		    <?php foreach ($facturas as $factu): ?>
		    	<?php if($factu['Facturaxcontrato']['idcontrato']==$fac['Facturaxcontrato']['idcontrato']) {?>
			    <?php $suma = $suma + $factu['Facturaxcontrato']['montofactura'];?>
			    <tr>
			        <td><?php echo $factu['Facturaxcontrato']['numerofactura']; ?></td>
			        <td style="text-align: left;"><?php echo $factu['Facturaxcontrato']['descripcionfactura']; ?></td>
			        <td><?php echo '$'.number_format($factu['Facturaxcontrato']['montofactura'],2); ?></td>        
			        <td><?php echo  date('d/m/Y',strtotime($factu['Facturaxcontrato']['fechafactura'])); ?></td>
			    </tr>
		    <?php } endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
			        <td></td>
			        <td></td>
			        <td><?php echo '$'.number_format($suma,2); ?></td>        
			        <td></td>
			    </tr>
			</tfoot>
		</table>
		</div>
		</div>
		</li>
		<?php endforeach; ?>
		<!--<table id="grid">
		    <tr>
		        <th data-field="idfuentefinanciamiento">Fuente</th>
		        <th data-field="montoparcial">Monto</th>
		        <th data-field="userc">Usuario</th>
		        <th data-field="creacion">Fecha Asignación</th>
		    </tr>
		    <?php foreach ($facturas as $fac): ?>
			    <tr>
			        <td><?php echo $fac['Facturaxcontrato']['codigocontrato']; ?></td>
			        <td><?php echo $fac['Facturaxcontrato']['nombrecontrato']; ?></td>
			        <td><?php echo $fac['Facturaxcontrato']['estadocontrato']; ?></td>        
			        <td><?php echo $fac['Facturaxcontrato']['montooriginal']; ?></td>
			        <td><?php echo $fac['Facturaxcontrato']['variacion']; ?></td>
			    </tr>
		    <?php endforeach; ?>
		    <?php unset($proyectos); ?>
		</table>-->
	
	

        

    
</ul>
	
	
	</div>
<?php } else {
	echo 'No se han facturas asociadas al proyecto';
} ?>




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
		text-align: right;
		padding-right: 10px;
		min-width: 80px;
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

<script>
	
	$(document).ready(function() {
    $("#panelBar").kendoPanelBar({
    	 expandMode: "single"
    });
});
</script>

