<!-- File: /app/View/Estimacions/estimacion_detalles.ctp -->
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
			?> » Control y Seguimiento » Detalles Estimación de Avance
		</div>
	</div>
<?php $this->end(); ?>
<div id="example" class="k-content">
	<div id="formulario">
		

		<h3>Archivos asociados</h3>
				<?php
					$results = $this->Upload->listing ('Estimacion', $idestimacion);
					$directory = $results['directory'];
					$baseUrl = $results['baseUrl'];
					$files = $results['files'];
					echo "<table>";
					foreach ($files as $file) {
					    $type = pathinfo($file, PATHINFO_EXTENSION);
					    $f = basename($file);
					    $url = $baseUrl . "/$f";
					    echo "<tr><td>";
					    echo "<img src='" . Router::url("/") . "ajax_multi_upload/img/fileicons/$type.png' /> <a href='$url'>" . $f . "</a><br />\n";
						echo "</td></tr>";
					}
					echo "</table>";
				?>
	</div>
</div>
 <style scoped>

                .k-textbox {
                    width: 300px;   
                }
                
				form .requerido label:after {
                	font-size: 1.4em;
					color: #e32;
					content: '*';
					display:inline;
				}
                
			
                #formulario {
                    width: 600px;
                    /*height: 323px;*/
                    margin: 15px 0;
                    padding: 10px 20px 20px 0px;
                    /*background: url('../../content/web/validator/ticketsOnline.png') transparent no-repeat 0 0;*/
                }

                #formulario h3 {
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
                    width: 140px;
                    text-align: right;
                    margin-right: 5px;
                    
                }


                .accept, .status {
                	padding-top: 15px;
                    padding-left: 150px;
                }

                
            </style>