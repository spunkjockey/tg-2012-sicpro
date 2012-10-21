<?php if(!empty($facturas) && !empty($proyectos)) {?>
	
	<div id="tablas" style="margin-bottom: 50px">
		<h3>Proyecto: </h3>
		<table id="Proyecto">
			<tr> <td style="width: 100px;">Número:</td>  <td><?= $proyectos['0']['numeroproyecto']; ?></td> </tr>
			<tr> <td>Proyecto:</td>  <td><?= $proyectos['0']['nombreproyecto']; ?></td> </tr>
			<tr> <td>Monto Planeado:</td>  <td><?= '$'.number_format($proyectos['0']['montoplaneado'],2); ?></td> </tr>
			<tr> <td>Estado:</td>  <td><?= $proyectos['0']['estadoproyecto']; ?></td> </tr>
		</table>
		<br />
		<br />
		
		
		<h3>Contratos: </h3>
		<ul id="panelBar">
    	<?php foreach ($facturas as $fac): ?>
		<li> Contrato: <?= $fac['Facturaxcontrato']['codigocontrato']; ?> 
		<div style="padding: 30px 20px;">
			<table id="Contrato">
				<tr> <td style="width: 100px;">Codigo:</td>  <td><?= $fac['Facturaxcontrato']['codigocontrato']; ?></td> </tr>
				<tr> <td>Contrato:</td>  <td><?= $fac['Facturaxcontrato']['nombrecontrato']; ?></td> </tr>
				<tr> <td>Tipo:</td>  <td><?= $fac['Facturaxcontrato']['tipocontrato']; ?></td> </tr>
				<tr> <td>Monto:</td>  <td><?= '$'.number_format($fac['Facturaxcontrato']['montooriginal'],2); ?></td> </tr>
				<tr> <td>Estado:</td>  <td><?= $fac['Facturaxcontrato']['estadocontrato']; ?></td> </tr>
				
			</table>
		
		<br />
		<h4>Facturas: </h4>
		<div id="tablagrid">
		<table id="grid">
		    <thead>
		    <tr>
		        <th data-field="numerofactura">ID</th>
		        <th data-field="descripcionfactura">Concepto</th>
		        <th data-field="montofactura">Monto</th>
		        <th data-field="fechafactura">Fecha facturada</th>
		    </tr>
		    </thead>
		    <tbody>
		    <?php $suma = 0;?>
		    <?php foreach ($facturas as $factu): ?>
		    	<?php if($factu['Facturaxcontrato']['idcontrato']==$fac['Facturaxcontrato']['idcontrato']) {?>
			    <?php $suma = $suma + $factu['Facturaxcontrato']['montofactura'];?>
			    <tr>
			        <td><?= $factu['Facturaxcontrato']['numerofactura']; ?></td>
			        <td><?= $factu['Facturaxcontrato']['descripcionfactura']; ?></td>
			        <td><?= '$'.number_format($factu['Facturaxcontrato']['montofactura'],2); ?></td>        
			        <td><?= $factu['Facturaxcontrato']['fechafactura']; ?></td>
			    </tr>
		    <?php } endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
			        <td></td>
			        <td></td>
			        <td><?= '$'.number_format($suma,2); ?></td>        
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
		font-size: 85%;
	}

</style>

<script>
	
	$(document).ready(function() {
    $("#panelBar").kendoPanelBar();
});
</script>

<!--<script>
	
	var grid =  $("#grid").kendoGrid({
    	sortable: false,
    	scrollable: false,
		dataSource: {
        	aggregate: [{ field: "montofactura", aggregate: "sum" }],
        	schema: {
		    	model: {
		        	fields: {
		            	montofactura: {
		                	editable: false,
		                	type: "number"
		             	},
		             	fechafactura: {
		             		type: "date"
		             	}
		            }
		     	}
		   	}
		},
        columns: [
        	{ field: "numerofactura" },
        	{ field: "descripcionfactura" },
            { field: "montofactura", format: "{0:c}", footerTemplate: <?php echo "<strong>#= kendo.toString(sum,'c2') #</strong>"; ?>},
            { field: "fechafactura", format: "{0:dd/MM/yyyy}"}
		]
          
	}).data("kendoGrid");

	
</script>-->