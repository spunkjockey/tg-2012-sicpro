            <p>
                <label for="proyectos">Proyectos:</label>
                <input id="proyectos" />
            </p>
            <p>
                <label for="contratos">Contratos:</label>
                <input id="contratos" disabled="disabled" />
            </p>
            
            <div id="test" style="padding:10px;"></div> 
            
            <form method="post" action="">
				<select name="myselect[]" id="myselect" class="multiselect" size="6" multiple="true">
				<option value="1">One</option>
				<option value="2">Two</option>
				<option value="3">Three</option>
				<option value="4">Four</option>
				<option value="5">Five</option>
				<option value="6">Six</option>
				</select>
				<div style="clear: both;">
					<input type="submit" value="Go">
				</div>
			</form>
			
			
			
	<style type="text/css">
		/* Recommended styles */
		.tsmsselect {
			width: 40%;
			float: left;
		}
		
		.tsmsselect select {
			width: 100%;
		}
		
		.tsmsoptions {
			width: 20%;
			float: left;
		}
		
		.tsmsoptions p {
			margin: 2px;
			text-align: center;
			font-size: larger;
			cursor: pointer;
		}
		
		.tsmsoptions p:hover {
			color: White;
			background-color: Silver;
		}
	</style>

<script type="text/javascript">
    $(document).ready(function () {

    	
       	$(".multiselect").twosidedmultiselect();
       	
        $("#proyectos").kendoDropDownList({
            optionLabel: "Seleccione proyecto...",
            dataTextField: "nombreproyecto",
            dataValueField: "idproyecto",
            dataSource: {
                            type: "json",
                            transport: {
                                read: "/Financias/jsondata.json"
                            }
                        }
        });
        
        var proyectos = $("#proyectos").data("kendoDropDownList");
        proyectos.list.width(400);
        
        var contratos = $("#contratos").kendoDropDownList({
                        autoBind: false,
                        cascadeFrom: "proyectos",
                        optionLabel: "Seleccione contrato...",
                        dataTextField: "nombrecontrato",
                        dataValueField: "idcontrato",
                        dataSource: {
                            type: "json",
                            transport: {
                                read: "/Financias/jsondatad.json"
                            }
                        }
                    }).data("kendoDropDownList");
                    
                    contratos.list.width(400);
                          
    });
</script>