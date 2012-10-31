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



<div id="example" class="k-content">
	<div id="formulario">
		<h2><span>Bienvenido a SICPRO</span></h2>
		<div style="display: inline-block; color: #3A90CA; -moz-border-radius:15px 55px 5px;
-webkit-border-radius: 15px 55px 5px; background: #CFCFCF;">
			<div style="float: left; width: 500px">
			Sistema Informático para control y seguimiento de proyectos para la Dirección 
			General de Ordenamiento Forestal, Cuenca y Riego del 
			Ministerio de Agricultura y Ganadería
			</div>
			<div style="float: left; width: 10px">
				
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
					<td><?php echo $proy['0']['nombreproyecto'] ?></td>
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

