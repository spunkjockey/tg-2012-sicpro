<div id="example" class="k-content">
	<div id="formulario">
		<h2><span>Bienvenido a SICPRO</span></h2>
		<div class="ventana">
			<div style="float: left; width: 580px">
			Sistema Informático para control y seguimiento de proyectos para la Dirección 
			General de Ordenamiento Forestal, Cuenca y Riego del 
			Ministerio de Agricultura y Ganadería
			</div>
		</div>
		<br />
		<p>
			<h2>Últimos Proyectos:</h2> 
		</p>
		<?php  if(isset($proyectos)) { ?>
			<?php $monto = array(); ?>
				<table border="1px">
				<thead>
				<tr>
					<th rowspan="2"> Numero </th>
					<th rowspan="2"> Proyecto </th>
					<th rowspan="2"> Estado </th>
					
					<th colspan="3"> Montos </th>
					
				</tr>
				<tr>
					<th> Planeado </th>
					<th> Asignado </th>
					<th> Contratado </th>
				</tr>
				</thead>
				<tbody>
			<?php $monto['montoplaneado'] = 0 ?>
			<?php $monto['montoreal'] = 0 ?>
			<?php $monto['montocontratos'] = 0 ?>
			<?php foreach ($proyectos as $proy): ?>
				<tr>
					<td><?php echo $proy['0']['numeroproyecto'] ?></td>
					
					<td>
					
					<?php echo $this->Html->link(
		            	$proy['0']['nombreproyecto'], 
		            	array('controller' => 'Fichatecnicas', 'action' => 'consultarproyo', $proy['0']['idproyecto']),
		            	array('class'=>'detalles')
					);?>
					
					</td>
					
					<td><?php echo $proy['0']['estadoproyecto'] ?></td>
					
					<td><?php echo '$' . number_format($proy['0']['montoplaneado'],2) ?></td>
					<td><?php echo '$' . number_format($proy['0']['montoreal'],2) ?></td>
					<td><?php echo '$' . number_format($proy['0']['montocontratos'],2) ?></td>
					
					<?php $monto['montoplaneado'] = $monto['montoplaneado'] + $proy['0']['montoplaneado'] ?>
					<?php $monto['montoreal'] = $monto['montoreal'] + $proy['0']['montoreal'] ?>
					<?php $monto['montocontratos'] = $monto['montocontratos'] + $proy['0']['montocontratos'] ?>
					
				</tr>
			<?php endforeach ?>
				</tbody>
				<tfoot>
					<td colspan="3"> Total Montos: </td>
					
					
					<td><?php echo '$' . number_format($monto['montoplaneado'],2) ?></td>
					<td><?php echo '$' . number_format($monto['montoreal'],2) ?></td>
					<td><?php echo '$' . number_format($monto['montocontratos'],2) ?></td>
				</tfoot>
				</table>
		<?php } ?>
		
		<style scoped>
			

			table {
					border-collapse:collapse;
					/*background:#EFF4FB url(http://www.roscripts.com/images/teaser.gif) repeat-x;*/
					background: white;
					border-left:1px solid #686868;
					border-right:1px solid #686868;
					font:0.9em/145% 'Trebuchet MS',helvetica,arial,verdana;
					color: #333;
			}
			
			td, th {
					padding:5px;
			}
			
			caption {
					padding: 0 0 .5em 0;
					text-align: left;
					font-size: 1.4em;
					font-weight: bold;
					text-transform: uppercase;
					color: #333;
					background: transparent;
			}
			
			/* =links
			----------------------------------------------- */
			
			table a {
					color:#950000;
					text-decoration:none;
			}
			
			table a:link {}
			
			table a:visited {
					font-weight:normal;
					color:#666;
					text-decoration: line-through;
			}
			
			table a:hover {
					border-bottom: 1px dashed #bbb;
			}
			
			/* =head =foot
			----------------------------------------------- */
			
			thead th, tfoot th, tfoot td {
					background:#e1f0f6;
					color: black;
			}
			
			tfoot td {
					text-align:right
			}
			
			/* =body
			----------------------------------------------- */
			
			tbody th, tbody td {
					border-bottom: dotted 1px #333;
			}
			
			tbody th {
					white-space: nowrap;
			}
			
			tbody th a {
					color:#333;
			}
			
			.odd {}
			
			tbody tr:hover {
					background:#fafafa
			}
			
		</style>
		
	</div>
</div>









<style scoped>

        	.ventana {
				border: 1px solid #000000;
				-moz-border-radius: 10px;
				-webkit-border-radius: 10px;
				padding: 10px;
				display: inline-block; 
				color: #3A90CA; 
				background: #EDEDED;
			}
        
        
        .k-textbox {
            width: 120px;
        }
		
		#tablat {
			vertical-align: top;
		}
		
		#formulario {
            width: 600px;
            margin: 15px 0;
            padding: 10px 20px 20px 0px;
        }

        #formulario h3 {
            font-weight: normal;
            font-size: 1.4em;
            border-bottom: 1px solid #ccc;
        }
        
        #tablafinancia h3 {
            font-weight: normal;
            font-size: 1.4em;
            border-bottom: 1px solid #ccc;
        }

        #formulario ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        
        #formulario li {
            margin: 10px 0 0 0;
        }

        label {
            display: inline-block;
            width: 125px;
            text-align: right;
            margin-right: 5px; 
        }
        
                        
        .etiqueta {
            display: inline-block;
            width: 150px;
            
            margin-right: 5px; 
        }
        
        
        form .requerido label:after {
        	font-size: 1.4em;
			color: #e32;
			content: '*';
			display:inline;
		}

        .accept, .status {
        	padding-top: 15px;
            padding-left: 150px;
        }

        .valid {
            color: green;
        }

        .invalid {
            color: red;
        }
        
        span.k-tooltip {
            margin-left: 6px;
        }

		.LV_validation_message{
		    /*font-weight:bold;*/
		    margin:0 0 0 5px;
		}
		
		.LV_valid {
		    color:#00CC00;
		    margin-left: 10px;
		    display: none;
		}
			
		.LV_invalid {
		    color:#CC0000;
       		display:block;
       		margin-left: 130px;
		}
		
		
				
</style>

<!--
<script>
	$(document).ready(function() {
		jQuery.fx.interval = 100;
		
		$("div.ventana").mouseleave(function(){
      		//alert("alejate! BACK OFF");
      		$("div.ventana").toggle( 3000 );
   		});
   });
</script>
-->
