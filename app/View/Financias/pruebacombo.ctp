            <p>
                <label for="proyectos">Proyectos:</label>
                <input id="proyectos" />
            </p>
            <p>
                <label for="contratos">Contratos:</label>
                <input id="contratos" disabled="disabled" />
            </p>

<script type="text/javascript">
    $(document).ready(function () {
       
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