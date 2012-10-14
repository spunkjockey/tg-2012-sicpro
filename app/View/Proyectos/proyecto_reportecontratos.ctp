<!-- File: /app/View/Proyectos/proyecto_reportecontratos.ctp -->

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
			?> » Reportes 
			» Contratos asociados a proyectos
			
		</div>
	</div>
<?php $this->end(); ?>

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Seleccionar Proyectos:</h2>
		<?php echo $this->Form->create('Proyecto'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('start',
					array(
						'label' => 'Fecha inicio:', 
						'id' => 'start',
						'div' => array('id' => 'startd', 'class' => 'requerido'),
						'value' => date('d/m/Y')
						)); ?>
				<script type="text/javascript">
		            var start = new LiveValidation( "start", { validMessage: " ", insertAfterWhatNode: "stard" } );
		            start.add(Validate.Presence, { failureMessage: "Selecciona una fecha de inicio" } );
		        </script>
			</li>
            <li>
				<?php echo $this->Form->input('end',
					array(
						'label' => 'Fecha fin:', 
						'id' => 'end',
						'div' => array('id' => 'endd', 'class' => 'requerido'),
						'value' => date('d/m/Y')
						)); ?>
				<script type="text/javascript">
		            var end = new LiveValidation( "end", { validMessage: " ", insertAfterWhatNode: "endd" } );
		            end.add(Validate.Presence, { failureMessage: "Selecciona una fecha de fin" } );
		        </script>
			</li> 
            
			</li>
			
			<li>
				<?php echo $this->Form->input('proyectos',
					array(
						'label' => 'Proyectos:', 
						'id' => 'proyectos',
						'div' => array('id' => 'proyectof', 'class' => 'requerido'),
						'class' => 'k-combobox'
						)); ?>
				<script type="text/javascript">
		            var proyectos = new LiveValidation( "proyectos", { validMessage: " ", insertAfterWhatNode: "proyectof" } );
		            proyectos.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		        </script>
			</li>
			<li>
				<div id="grid"></div>
			</li>
			<li>
				<?php echo $this->ajax->submit('Consultar', array(
					'url'=> array('controller'=>'Proyectos', 'action'=>'update_reportecontratos'), 
					'update' => 'post',
					'class' => 'k-button')); ?>
			</li>
			<!--<td><a class="k-button"><span class="k-icon k-i-pencil"></span></a> <a class="k-button"><span class="k-icon k-i-close"></span></a></td>-->
		</ul>
		
		<?php echo $this->form->end(); ?>
	</div>

	<div id="post"></div>

</div>
	
<style scoped>

                .k-textbox {
                    width: 70px;
                }
                
                .k-combobox {
                    width: 400px;
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
                
                #grid {
                	margin-top: 50px;
                }

            </style>

<script>
    $(document).ready(function() {
    	
    	var grid = $("#grid").kendoGrid({
          columns:[
              
             {
                  field: "Contrato.codigocontrato",
                  title: "Codigo",
                  width: 75
          	 },
          	 {
                  field: "Contrato.nombrecontrato",
                  title: "Contrato",
                  width: 200
          	 },
          	 {
                  field: "Contrato.plazoejecucion",
                  title: "Plazo",
                  width: 50
          	 },
          	 {
                  field: "Contrato.montooriginal",
                  title: "Monto",
                  template: '#= kendo.toString(kendo.parseFloat(Contrato.montooriginal),"c2") #',
                  width: 100
          	 },
          	 {
                  field: "Empresa.nombreempresa",
                  title: "Empresa"
          	 }
          	 
          	 
          ],
          dataSource: {
                type: "json",
                transport: {
                    read: {
                    	url: "/Proyectos/reportegridcontratosjson.json",
                    	dataType: "json"
                    }
                },
                schema: {
                	
                	//proyecto: "Proyecto", contrato: "Contrato"
                	model: {
			        	fields: {
			            	montooriginal: { type: "number" },
			             	creacion: { type: "date" }
			            }
			     	}
			   	}
			    
                            
         
          }
      });
      

    	
    	
 
		
		
		function filtrarGrid() {

			var proyecto = proy.value();
			
			if (proyecto) {
				grid.data("kendoGrid").dataSource.filter({ field: "Proyecto.idproyecto", operator: "eq", value: parseInt(proyecto)});
			} else {
				grid.data("kendoGrid").dataSource.filter({});
			}
		}
		
		function filtrarDrop() {
			var startDate = start.value();
			var endDate = end.value();
			alert('dafuq');
			/*proy.data("kendoDropDownList").dataSource.filter([
				     { field: "creacion", operator: "gte", value: startDate },
				     { field: "creacion", operator: "lte", value: endDate }
				]);
			*/
			
			proy.data("kendoDropDownList").dataSource.filter({ field: "idproyecto", operator: "eq", value: 5});
		}
		
		
		function startChange() {
	        var startDate = start.value();
	
	        if (startDate) {
	        	
                
                //grid.data("kendoGrid").dataSource.filter({ field: "creacion", operator: "gte", value: startDate });
                
	            startDate = new Date(startDate);
	            startDate.setDate(startDate.getDate() + 1);
	            end.min(startDate);
	            
	            
                
                   // grid.data("kendoGrid").dataSource.filter({});
	        }
	    }
	
	    function endChange() {
	        var endDate = end.value();
	
	        if (endDate) {
	        	
	        	
	        	
	        	//grid.data("kendoGrid").dataSource.filter({ field: "creacion", operator: "lte", value: endDate });
	        	
	            endDate = new Date(endDate);
	            endDate.setDate(endDate.getDate() - 1);
	            start.max(endDate);
	        }
	    }
	
	    var start = $("#start").kendoDatePicker({
	        culture: "es-ES",
		   	format: "dd/MM/yyyy",
	        change: startChange,
	        close: filtrarDrop
	    }).data("kendoDatePicker");
	
	    var end = $("#end").kendoDatePicker({
	        culture: "es-ES",
		   	format: "dd/MM/yyyy",
	        change: endChange,
	        close: filtrarDrop
	    }).data("kendoDatePicker");
	
	    start.max(end.value());
	    end.min(start.value());
		
		
		var proy = $("#proyectos").kendoDropDownList({
			optionLabel: "Seleccione proyecto",
            
            dataTextField: "nombreproyecto",
            dataValueField: "idproyecto",
            
            <?php if(isset($idproyecto)) { echo 'value: ' . $idproyecto . ','; } ?> 
            dataSource: {
                            type: "json",
                            transport: {
                                read: "/Proyectos/reportecontratosjson.json"
                            }
                       },
             change: filtrarGrid
        }).data("kendoDropDownList");
		proy.list.width(400);
		
		
    });
</script>

