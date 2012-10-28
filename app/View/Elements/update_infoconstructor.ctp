<?php 
	if(isset($info['Contratoconstructor']['nombrecontrato']))
	{
		$nomcon = $info['Contratoconstructor']['nombrecontrato'];
		$inicon = $info['Contratoconstructor']['fechainiciocontrato'];
		$fincon = $info['Contratoconstructor']['fechafincontrato'];
		$placon = $info['Contratoconstructor']['plazoejecucion'];
	}
	else 
	{
		$nomcon ='';
		$inicon ='';
		$fincon ='';
		$placon ='';
	}
?>
<table>
	<tr>
		<td width="150px" style="text-align: right">Contrato Construcción:</td><td><?php echo $nomcon; ?></td>
	</tr>
	<tr>
		<td style="text-align: right">Vigencia: </td><td><?php echo date('d/m/Y',strtotime( $inicon)); ?> Al <?php echo date('d/m/Y',strtotime($fincon)); ?></td>
	</tr>
	<tr>
		<td style="text-align: right">Plazo de ejecución: </td><td><?php echo $placon; ?></td>
	</tr>
</table>

<style scoped>

                .k-textbox {
                    width: 300px;
                    
                    
                }
				
				.k-textbox:focus{background-color: rgba(255,255,255,.8);}
				
				.k-combobox {
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
                    width: 150px;
                    text-align: right;
                    margin-right: 5px;
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
				    margin:0 0 0 5px;
				}
				
				.LV_valid {
				    color:#00CC00;
				    display:none;
				}
					
				.LV_invalid {
				    color:#CC0000;
					clear:both;
               		display:inline-block;
               		margin-left: 155px; 
               
				}
				    
</style>