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
		<p>
			Proyectos en Seguimiento 
		</p>
		<?php if(isset($proyectos)) { ?>
			<?php foreach ($proyectos as $proy): ?>
				<table>
					<tr>
						<td colspan="2"><h3><?php echo $proy['Proyecto']['nombreproyecto'] ?></h3></td>
					</tr>
					<tr>
						<td>Monto Planeado:</td>
						<td><?php echo number_format($proy['Proyecto']['montoplaneado'],2) ?></td>
					</tr>
					<tr>
							<br />
							<table>
							<thead>
							<tr>
								<th style="width: 100px">Código</th>
								<th style="width: 400px">Contrato</th>
								<th style="width: 100px">Estado</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($contratos as $ctr): ?>
								<?php if($proy['Proyecto']['idproyecto']==$ctr['Contrato']['idproyecto']) { ?>
									<tr>
										<td style="text-align: center"><?php echo $ctr['Contrato']['codigocontrato'] ?></td>
										<td><?php echo $ctr['Contrato']['nombrecontrato'] ?></td>
										<td style="text-align: center"><?php echo $ctr['Contrato']['estadocontrato'] ?></td>
									</tr>
								<?php } ?>
							<?php endforeach ?>
							</tbody>
							</table>
							<br />
					</tr>
				</table>
			<?php endforeach ?>
		<?php } ?>
		
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

