<?php if(!empty($contrato)) {?>
	
	<table>
		<tr>
			<td colspan="2" style="text-align: right; width: 550px">
				<?php echo $this->Html->link(
					'<span class="k-icon k-i-plus"></span> Generar PDF', 
					array('action' => 'avancecontrato_pdf',$contrato['Contratoconstructor']['idcontrato']),
					array('class'=>'k-button', 'escape' => false, 'target' => '_blank')
				); ?>
			</td>
		</tr>
	</table>
	
	<div id="proyectos" style="margin-bottom: 50px">
		<h2>Resumen de Contrato </h2>
		<table id="Proyecto">
			<tr> <td class="primerac">Número:</td>  <td><?php echo $contrato['Proyecto']['numeroproyecto']; ?></td> </tr>
			<tr> <td class="primerac">Proyecto:</td>  <td><?php echo $contrato['Proyecto']['nombreproyecto']; ?></td> </tr>
			<!--<tr> <td class="primerac">Estado:</td>  <td><?php echo $contrato['Proyecto']['estadoproyecto']; ?></td> </tr>-->
			<!--<tr> <td class="primerac">Monto:</td>  <td><?php echo '$'.number_format($contrato['Proyecto']['montoplaneado'],2); ?></td> </tr>-->
			
			<tr> <td class="primerac">Código:</td>  <td><?php echo $contrato['Contratoconstructor']['codigocontrato']; ?></td> </tr>
			<tr> <td class="primerac">Contrato:</td>  <td><?php echo $contrato['Contratoconstructor']['nombrecontrato']; ?></td> </tr>
			<tr> <td class="primerac">Monto Planeado:</td>  <td><?php echo '$'.number_format($contrato['Contratoconstructor']['montooriginal'],2); ?></td> </tr>
			<tr> <td class="primerac">Estado:</td>  <td><?php echo $contrato['Contratoconstructor']['estadocontrato']; ?></td> </tr>
			<tr> <td class="primerac">Orden de Inicio:</td>  <td><?php echo $contrato['Contratoconstructor']['ordeninicio']; ?></td> </tr>
			
			<tr> <td class="primerac">Empresa:</td>  <td><?php echo $contrato['Empresa']['nombreempresa']; ?></td> </tr>
			<!--<tr> <td class="primerac">Representante:</td>  <td><?php echo $contrato['Empresa']['representantelegal']; ?></td> </tr>-->
			
			<tr> <td class="primerac">Administrador de Contrato:</td>  <td><?php echo $contrato['Persona']['nombrecompleto']; ?></td> </tr>
			
		</table>
		
		
		
		<!--		
		<br />
		<?php if(!empty($avances)) { ?>
			<table>
				<tr>
					<td>plazoejecuciondias</td>
					<td>fechaavance</td>
					<td>porcentajeavfisicoprog</td>
					<td>montoavfinancieroprog</td>
				</tr>
				<?php foreach ($avances as $ava): ?>
				<tr>
					<td><?php echo $ava['Avanceprogramado']['plazoejecuciondias']; ?></td>
					<td><?php echo $ava['Avanceprogramado']['fechaavance']; ?></td>
					<td><?php echo $ava['Avanceprogramado']['porcentajeavfisicoprog']; ?></td>
					<td><?php echo $ava['Avanceprogramado']['montoavfinancieroprog']; ?></td>	
				</tr>
				<?php endforeach; ?>
				</table>
		<?php } else { ?>	
			No hay avances asociados a este contrato
		<?php } ?>
		
		<br />
		<?php if(!empty($supervisiones)) { ?>
			<table>
				<tr>
					<td>fechainiciosupervision</td>
					<td>fechafinsupervision</td>
					<td>porcentajeavancefisico</td>
					<td>valoravancefinanciero</td>
				</tr>
				<?php foreach ($supervisiones as $supi): ?>
				<tr>
					<td><?php echo $supi['Informesupervisor']['fechainiciosupervision']; ?></td>
					<td><?php echo $supi['Informesupervisor']['fechafinsupervision']; ?></td>
					<td><?php echo $supi['Informesupervisor']['porcentajeavancefisico']; ?></td>
					<td><?php echo $supi['Informesupervisor']['valoravancefinanciero']; ?></td>	
				</tr>
				<?php endforeach; ?>
				</table>
		<?php } else { ?>	
			No hay informes de supervision asociados a este contrato
		<?php } ?>
		-->
		
		<br />
		<h2>Avance Fisico y Financiero</h2>
		<div id = 'tablagrid'>
		<?php if(!empty($avancesupervision)) { ?>
			<table>
				<caption>Tabla de Avances Programados vs Informes de Avance a la fecha </caption>
				<thead>
				<tr>
					<th rowspan=2 style="width: 100px">Fecha</th>
					<th colspan=2>Físico </th>
					<th colspan=2>Financiero</th>
					
				</tr>
				<tr>
					
					<!--<th style="width: 50px"></th>-->
					<!--<th style="width: 100px">Fecha </th>-->
					<th style="width: 100px">Prog.</th>
					<th style="width: 100px">Ejecutado</th>
					<th style="width: 100px">Prog.</th>
					<th style="width: 100px">Ejecutado</th>
				</tr>
				</thead>
				<?php foreach ($avancesupervision as $supi): ?>
				<tr>
					<!--<td><?php echo $supi['0']['plazoejecuciondias']; ?></td>-->
					<td><?php echo date('d/m/Y',strtotime($supi['0']['fechaavance'])); ?></td>
					<td><?php echo number_format($supi['0']['porcentajeavfisicoprog'],2).'%'; ?></td>
					<td><?php echo number_format($supi['0']['porcentajeavancefisico'],2).'%'; ?></td>	
					<td><?php echo '$'.number_format($supi['0']['montoavfinancieroprog'],2); ?></td>
					<td><?php echo '$'.number_format($supi['0']['valoravancefinanciero'],2); ?></td>
				</tr>
				<?php endforeach; ?>
				</table>
		<?php } else { ?>	
			No hay avances asociados a este contrato en particular
		<?php } ?>
		
		
		<br />
		<?php $acumulado = 0 ?>
		<?php $pacumulado = 0 ?>
		<?php $estiacumulado=array(); ?>
		<?php if(!empty($estimaciones)) { ?>
			<table>
				<caption>Tabla Estimaciones a la fecha </caption>
				<thead>
				<tr>
					<th colspan=2>Periodo Estimación</th>
					<th colspan=2>Físico </th>
					<th colspan=2>Financiero</th>
					
				</tr>
				<tr>
					<th style="width: 100px">Inicio</th>
					<th style="width: 100px">Fin</th>
					<th style="width: 100px">Estimado</th>
					<th style="width: 100px">Acumumulado</th>
					<th style="width: 100px">Estimado</th>
					<th style="width: 100px">Acumumulado</th>
				</tr>
				</thead>
				<?php foreach ($estimaciones as $esti => $value): ?>
				<?php $acumulado = $acumulado + $value['Estimacion']['montoestimado']; ?>
				<?php $pacumulado = $pacumulado + $value['Estimacion']['porcentajeestimadoavance']; ?>
				<?php $estiacumulado[$esti]['Estimacion'] = array(
								'fechafinestimacion' => $value['Estimacion']['fechafinestimacion']
								,'porcentajeestimadoavance' => $pacumulado
								,'montoestimado' => $acumulado); ?>
				<tr>
					<td><?php echo date('d/m/Y',strtotime($value['Estimacion']['fechainicioestimacion'])); ?></td>
					<td><?php echo date('d/m/Y',strtotime($value['Estimacion']['fechafinestimacion'])); ?></td>
					<td><?php echo number_format($value['Estimacion']['porcentajeestimadoavance'],2).'%'; ?></td>
					<td><?php echo number_format($pacumulado,2).'%'; ?></td>
					<td><?php echo '$'.number_format($value['Estimacion']['montoestimado'],2); ?></td>	
					<td><?php echo '$'.number_format($acumulado,2); ?></td>	
				</tr>
				<?php endforeach; ?>
				</table>
		<?php } else { ?>	
			No hay estimaciones asociadas a este contrato
		<?php } ?>
		</div>


		

<br />

<h2>Gráficos de Avance Fisico y Financiero</h2>

<div id="tabstrip">
					<ul>
						<li class="k-state-active">
							Avance Financiero
						</li>
						<li>
							Avance Fisico
						</li>

					</ul>
					<div>




   <div id="container" style="width:600px;height:300px;margin-bottom:20px;"></div>




					</div>
					<div>

    <div id="container1" style="width:600px;height:300px;margin-bottom:20px;"></div>



					</div>

				</div>
			</div>


<?php } else { ?>
		<div id="noresults">
			<?php echo "No hay resultados"; ?>
		</div>
<?php } ?>



<!--
<?php
echo '<p>';
$loc_es = setlocale(LC_ALL, 'esp_esp', 'esp_spain', 'spanish_esp', 'spanish_spain');
echo "Preferred locale for spanish on this system is '$loc_es'";
echo '<br/>' . strftime("%A %d %B %Y", mktime(0, 0, 0, 12, 22, 1978));
?>
-->







<script type="text/javascript">



  $(document).ready(function() {
                    $("#tabstrip").kendoTabStrip({
						animation:	{
							open: {
								effects: "fadeIn"
							}
						}
					
					});
                });
    
 
   


$(function () {

	
    var chart;
    $(document).ready(function() {
    	
    	//alert((new Date()).getTime());

Highcharts.setOptions({
        lang: {
            
            downloadJPEG: 'Descargar imagen JPEG',
            downloadPDF: 'Descargar documento PDF',
            downloadPNG: 'Descargar imagen PNG',
            downloadSVG: 'Descargar imagen SVG',
            exportButtonTitle: 'Exportar a imagen o pdf',
            printButtonTitle: 'Imprimir el gráfico',
            months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 
			'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            shortMonths: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
            
            
			
        }
    });


        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'line'
            },
            
            title: {
                text: 'Gráfico de Avance Financiero'
            },
            subtitle: {
                text: 'correspondiente a ' + Highcharts.dateFormat('%B %Y',(new Date()).getTime()) 
            },
            credits: {
            	href: "",
            	text: "MAG/SICPRO"
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                }
            },
            yAxis: {
                title: {
                    text: 'Cantidad en dólares ($)'
                },
                min: 0
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%e. %b', this.x) +': $'+ Highcharts.numberFormat(this.y,2);
                }
            },
            
            series: [{
                name: 'Monto Financiero Real',
                // Define the data points. All series have a dummy year
                // of 1970/71 in order to be compared on the same x axis. Note
                // that in JavaScript, months start at 0 for January, 1 for February etc.
                data: [ 
                	<?php echo '['.(strtotime($contrato['Contratoconstructor']['ordeninicio']) * 1000).', 0],'; ?>
                   	<?php foreach ($supervisiones as $supi): 
                        			echo '['.(strtotime($supi['Informesupervisor']['fechafinsupervision']) * 1000).', '.$supi['Informesupervisor']['valoravancefinanciero'].'],'; 
                        		endforeach; ?>
                ]
            }, {
                name: 'Avance Financiero Programado',
                data: [
                    <?php echo '['.(strtotime($contrato['Contratoconstructor']['ordeninicio']) * 1000).', 0],'; ?>
                    <?php foreach ($avances as $ava): 
                    	echo '['.(strtotime($ava['Avanceprogramado']['fechaavance']) * 1000).', '.$ava['Avanceprogramado']['montoavfinancieroprog'].'],'; 
                    endforeach; ?>
                ]
            }, {
                name: 'Monto Estimacion',
                data: [
            		<?php echo '['.(strtotime($contrato['Contratoconstructor']['ordeninicio']) * 1000).', 0],'; ?>
            		<?php foreach ($estiacumulado as $esti): 
            			echo '['.(strtotime($esti['Estimacion']['fechafinestimacion']) * 1000).', '.$esti['Estimacion']['montoestimado'].'],'; 
            		endforeach; ?>
            		]
            }]
        });
    });
    
});
    
    
$(function () {
    var chart;
    $(document).ready(function() {
        
        Highcharts.setOptions({
        lang: {
            
            downloadJPEG: 'Descargar imagen JPEG',
            downloadPDF: 'Descargar documento PDF',
            downloadPNG: 'Descargar imagen PNG',
            downloadSVG: 'Descargar imagen SVG',
            exportButtonTitle: 'Exportar a imagen o pdf',
            printButtonTitle: 'Imprimir el gráfico',
            months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 
			'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            shortMonths: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
            
            
			
        }
    });
        
        
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container1',
                type: 'line'
            },
            title: {
                text: 'Gráfico de Avance Fisico'
            },
            subtitle: {
                text: 'correspondiente a ' + Highcharts.dateFormat('%B %Y',(new Date()).getTime())  
            },
            credits: {
            	href: "",
            	text: "MAG/SICPRO"
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                }
            },
            yAxis: {
                title: {
                    text: 'Avance en %'
                },
                min: 0
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%e. %b', this.x) +': $'+ Highcharts.numberFormat(this.y,2)+'%';
                }
            },
            
            series: [{
                name: 'Avance Fisico Real',
                // Define the data points. All series have a dummy year
                // of 1970/71 in order to be compared on the same x axis. Note
                // that in JavaScript, months start at 0 for January, 1 for February etc.
                data: [ 
                	<?php echo '['.(strtotime($contrato['Contratoconstructor']['ordeninicio']) * 1000).', 0],'; ?>
                   	<?php foreach ($supervisiones as $supi): 
                        			echo '['.(strtotime($supi['Informesupervisor']['fechafinsupervision']) * 1000).', '.$supi['Informesupervisor']['porcentajeavancefisico'].'],'; 
                        		endforeach; ?>
                ]
            }, {
                name: 'Avance Fisico Programado',
                data: [
                    <?php echo '['.(strtotime($contrato['Contratoconstructor']['ordeninicio']) * 1000).', 0],'; ?>
                    <?php foreach ($avances as $ava): 
                    	echo '['.(strtotime($ava['Avanceprogramado']['fechaavance']) * 1000).', '.$ava['Avanceprogramado']['porcentajeavfisicoprog'].'],'; 
                    endforeach; ?>
                ]
            }, {
                name: 'Avance Estimacion',
                data: [
            		<?php echo '['.(strtotime($contrato['Contratoconstructor']['ordeninicio']) * 1000).', 0],'; ?>
            		<?php foreach ($estiacumulado as $esti): 
            			echo '['.(strtotime($esti['Estimacion']['fechafinestimacion']) * 1000).', '.$esti['Estimacion']['porcentajeestimadoavance'].'],'; 
            		endforeach; ?>
            		]
            }]
        });
    });
    
});

</script>





<style>
	
	
	#Proyecto {
		border-collapse: collapse;
		color: black;
	}
	
	#Proyecto .primerac {
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
	
	
	#noresults {
		margin-left: 40px;
	}
	
	
	#tablagrid caption {
		font-size: 100%;
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