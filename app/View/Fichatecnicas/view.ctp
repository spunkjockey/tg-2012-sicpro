<!-- File: /app/View/Fichatecnicas/view.ctp -->
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
			?> » Proyectos » Ficha Tecnica » Registrar Ficha Tecnica
			
		</div>
	</div>
	
<?php $this->end(); ?>
	<h2>Registrar Ficha Tecnica</h2>
	<div style="color: #959595;">Paso 2 de 2</div>
	<h2>Ubicaciones</h2>			   
	<?php foreach ($ubicaciones as $ubi): ?>
    	<li class='capa2'>
        <?php echo $ubi['Ubicacion']['direccion']; 
        if(!empty($ubi['Ubicacion']['direccion']))
		{
			echo ", ";
		}
        ?>
        <?php echo $ubi['Municipio']['municipio']; ?>,
        <?php echo $ubi['Departamento']['departamento']; ?>
        </li> 
    <?php endforeach; ?>
    <?php unset($ubicaciones); ?>
			<br>
			<p style="text-align: right">
			<?php echo $this->Html->link(
            	'<span class="k-icon k-i-plus"></span> Agregar Ubicacion', 
            	array('controller' => 'Ubicacions','action' => 'ubicacion_registrar',$fichatecnicas['Fichatecnica']['idfichatecnica']),
            	array('class'=>'k-button', 'escape' => false)
			);?>
			</p>
			<br> 
			<br>
			<h2>Componentes y Metas</h2>
			<?php 
			if(isset($fichatecnicas['Componente'])){
			foreach ($fichatecnicas['Componente'] as $compo):?>
				<h3 id='titulo'><?php echo $compo['nombrecomponente']; ?></h3>
				<div id='capa1'><?php echo $compo['descripcioncomponente']; ?></div>
				<?php foreach ($compo['Meta'] as $metas):
					if($compo['idcomponente']=$metas['idcomponente'])?>
					<div class='capa2'><li><?php echo $metas['descripcionmeta']; ?></li></div>
				<?php endforeach; ?>
			<?php endforeach; 
			}
			?>
			<br>
			<p style="text-align: right">
			<?php echo $this->Html->link(
            	'<span class="k-icon k-i-plus"></span> Agregar Componentes', 
            	array('controller' => 'Componentes','action' => 'componente_registrar',$fichatecnicas['Fichatecnica']['idfichatecnica']),
            	array('class'=>'k-button', 'escape' => false)
			);?>
			<?php echo $this->Html->link('<span class="k-icon k-i-tick"></span> Terminar',
				array('controller' => 'Mains', 'action' => 'index'),array('id' => 'regresar','class'=>'k-button','escape' => false)); 
			?>	
			</p>

<style scoped>
				#titulo {
					color:#3A90CA;
				}
				#capa1{
					margin-left: 20px;
					color:#000000;
				}
				.capa2{
					margin-left: 40px;
					color:#3E3E3E;
				}
                .k-textbox {
                    width: 11.8em;
                }
				
				#formulario {
                    width: 600px;
                    margin: 15px 0;
                    padding: 10px 20px 20px 0px;
                }

                h3 {
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
                    width: 150px;
                    text-align: right;
                    margin-right: 5px; 
                }
                
                .etiqueta {
                    display: inline-block;
                    width: 150px;
                    
                    margin-right: 5px; 
                }
                
                
                form .required label:after {
                	font-size: 1.4em;
					color: #e32;
					content: '*';
					display:inline;
				}
                
                .required {
                    font-weight: bold;
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
                
                #tablafinancia {
                    width: 600px;
                    margin: 15px 0;
                    padding: 10px 20px 20px 0px;
                }
</style>
<script>
	$(document).ready(function() {
    	$("#tabla").kendoGrid({
            	dataSource: {
	           		pageSize: 10,
            	},
            	sortable: true,
            	sortable: {
 			    	mode: "single", // enables multi-column sorting
        			allowUnsort: true
				},
				scrollable: false
            	
            	
        	});
		$("#tabla2").kendoGrid({
            	dataSource: {
	           		pageSize: 10,
            	},
            	sortable: true,
            	sortable: {
 			    	mode: "single", // enables multi-column sorting
        			allowUnsort: true
				},
				scrollable: false
            	
            	
        	});
        });
</script>