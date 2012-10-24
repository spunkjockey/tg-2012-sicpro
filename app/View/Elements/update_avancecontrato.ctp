<?php if(!empty($contrato)) {?>
	
	
	<div id="tablas" style="margin-bottom: 50px">
		<h3>Contrato: </h3>
		<table id="Proyecto">
			<tr> <td class="primerac">Número:</td>  <td><?php echo $contrato['Proyecto']['numeroproyecto']; ?></td> </tr>
			<tr> <td class="primerac">Proyecto:</td>  <td><?php echo $contrato['Proyecto']['nombreproyecto']; ?></td> </tr>
			<tr> <td class="primerac">Estado:</td>  <td><?php echo $contrato['Proyecto']['estadoproyecto']; ?></td> </tr>
			<tr> <td class="primerac">Monto:</td>  <td><?php echo '$'.number_format($contrato['Proyecto']['montoplaneado'],2); ?></td> </tr>
			
			<tr> <td class="primerac">Código:</td>  <td><?php echo $contrato['Contratoconstructor']['codigocontrato']; ?></td> </tr>
			<tr> <td class="primerac">Contrato:</td>  <td><?php echo $contrato['Contratoconstructor']['nombrecontrato']; ?></td> </tr>
			<tr> <td class="primerac">Monto Planeado:</td>  <td><?php echo '$'.number_format($contrato['Contratoconstructor']['montooriginal'],2); ?></td> </tr>
			<tr> <td class="primerac">Estado:</td>  <td><?php echo $contrato['Contratoconstructor']['estadocontrato']; ?></td> </tr>
			<tr> <td class="primerac">Orden de Inicio:</td>  <td><?php echo $contrato['Contratoconstructor']['ordeninicio']; ?></td> </tr>
			
			<tr> <td class="primerac">Empresa:</td>  <td><?php echo $contrato['Empresa']['nombreempresa']; ?></td> </tr>
			<tr> <td class="primerac">Representante:</td>  <td><?php echo $contrato['Empresa']['representantelegal']; ?></td> </tr>
			
			<tr> <td class="primerac">Administrador de Contrato:</td>  <td><?php echo $contrato['Persona']['nombrecompleto']; ?></td> </tr>
			
		</table>
		
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
		
		<br />
		<?php if(!empty($estimaciones)) { ?>
			<table>
				<tr>
					<td>fechainicioestimacion</td>
					<td>fechafinestimacion</td>
					<td>porcentajeestimadoavance</td>
					<td>montoestimado</td>
				</tr>
				<?php foreach ($estimaciones as $esti): ?>
				<tr>
					<td><?php echo $esti['Estimacion']['fechainicioestimacion']; ?></td>
					<td><?php echo $esti['Estimacion']['fechafinestimacion'] ?></td>
					<td><?php echo $esti['Estimacion']['porcentajeestimadoavance']; ?></td>
					<td><?php echo $esti['Estimacion']['montoestimado']; ?></td>	
				</tr>
				<?php endforeach; ?>
				</table>
		<?php } else { ?>	
			No hay estimaciones asociadas a este contrato
		<?php } ?>
		
<?php } ?>






<div id="tabstrip">
					<ul>
						<li class="k-state-active">
							Paris
						</li>
						<li>
							New York
						</li>

					</ul>
					<div>


<h2>Flot Examples</h2>

    <div id="placeholder" style="width:600px;height:300px"></div>

    <p>You can add crosshairs that'll track the mouse position, either
    on both axes or as here on only one.</p>

    <p>If you combine it with listening on hover events, you can use
    it to track the intersection on the curves by interpolating
    the data points (look at the legend).</p>

    <p id="hoverdata"></p>




					</div>
					<div>
<h2>Flot Examples</h2>

    <div id="placeholder1" style="width:600px;height:300px;"></div>

    <p>Here is an example with real data: military budgets for
        various countries in constant (2005) million US dollars (source: <a href="http://www.sipri.org/">SIPRI</a>).</p>

    <p>Since all data is available client-side, it's pretty easy to
       make the plot interactive. Try turning countries on/off with the
       checkboxes below.</p>

    <p id="choices">Show:</p>



					</div>

				</div>
			</div>


<div id="placeholder3" style="width:600px;height:300px;margin-bottom:20px;"></div>


 <input type="button" id="convertpngbtn" value="Export Image" />

<div id="main" style="margin-top:20px;"/>

    <script>
        function saveFlotGraphAsPNG(placeholderID, targetID) {

          var divobj = document.getElementById(placeholderID);

          var oImg = Canvas2Image.saveAsPNG(divobj.childNodes[0], true);

          if (!oImg) {
              alert("Sorry, this browser is not capable of saving PNG files!");
              return false;
          }

          oImg.id = "canvasimage";

          document.getElementById(targetID).removeChild(document.getElementById(targetID).childNodes[0]);
          document.getElementById(targetID).appendChild(oImg);

        }

    </script>








<script type="text/javascript">
var plot;



$(function () {


	/* $(document).ready(function() {
                    $("#tabstrip").kendoTabStrip({
						animation:	{
							open: {
								effects: "fadeIn"
							}
						}
					
					});
                });*/
    
 
    plot = $.plot($("#placeholder"),
                      [ /*{ data: sin, label: "sin(x) = -0.00"},*/
                        { data:   [ <?php echo '['.(strtotime($contrato['Contratoconstructor']['ordeninicio']) * 1000).', 0],'; ?>
                        	
                        		<?php foreach ($supervisiones as $supi): 
                        			echo '['.(strtotime($supi['Informesupervisor']['fechafinsupervision']) * 1000).', '.$supi['Informesupervisor']['valoravancefinanciero'].'],'; 
                        		endforeach; ?>
                        		] , label: "Monto Financiero Real = $-000,000,000.00" },
                        		
                        		{ data:   [
                        		<?php echo '['.(strtotime($contrato['Contratoconstructor']['ordeninicio']) * 1000).', 0],'; ?>
                        		<?php foreach ($avances as $ava): 
                        			echo '['.(strtotime($ava['Avanceprogramado']['fechaavance']) * 1000).', '.$ava['Avanceprogramado']['montoavfinancieroprog'].'],'; 
                        		endforeach; ?>
                        		] , label: "Avance Financiero Programado = $-000,000,000.00" },  
                        
                        { data:   [
                        		<?php echo '['.(strtotime($contrato['Contratoconstructor']['ordeninicio']) * 1000).', 0],'; ?>
                        		<?php foreach ($estimaciones as $esti): 
                        			echo '['.(strtotime($esti['Estimacion']['fechafinestimacion']) * 1000).', '.$esti['Estimacion']['montoestimado'].'],'; 
                        		endforeach; ?>
                        		] , label: "Monto Estimacion = $-000,000,000.00" } 
                       
                       ], 
                       {
                            series: {
                                lines: { show: true },
                                points: { show: true }
                            },
                            crosshair: { mode: "x" },
                            grid: { hoverable: true, autoHighlight: false },
                            xaxis: { mode: "time",  timeformat: "%d/%m/%y" }/*,
                            yaxis: { min: -1.2, max: 1.2 }*/
                        });
                        
     
    
    var legends = $("#placeholder .legendLabel");
    legends.each(function () {
        // fix the widths so they don't jump around
        $(this).css('width', $(this).width());
    });

    var updateLegendTimeout = null;
    var latestPosition = null;
    
    function updateLegend() {
        updateLegendTimeout = null;
        
        var pos = latestPosition;
        
        var axes = plot.getAxes();
        if (pos.x < axes.xaxis.min || pos.x > axes.xaxis.max ||
            pos.y < axes.yaxis.min || pos.y > axes.yaxis.max)
            return;

        var i, j, dataset = plot.getData();
        for (i = 0; i < dataset.length; ++i) {
            var series = dataset[i];

            // find the nearest points, x-wise
            for (j = 0; j < series.data.length; ++j)
                if (series.data[j][0] > pos.x)
                    break;
            
            // now interpolate
            var y, p1 = series.data[j - 1], p2 = series.data[j];
            if (p1 == null)
                y = p2[1];
            else if (p2 == null)
                y = p1[1];
            else
                y = p1[1] + (p2[1] - p1[1]) * (pos.x - p1[0]) / (p2[0] - p1[0]);

            legends.eq(i).text(series.label.replace(/=.*/, "= " + y.toFixed(2)));
        }
    }
    
    $("#placeholder").bind("plothover",  function (event, pos, item) {
        latestPosition = pos;
        if (!updateLegendTimeout)
            updateLegendTimeout = setTimeout(updateLegend, 50);
    });
});


$(function () {
    var datasets = {
        "Supervision": {
            label: "Supervision",
            data:   [ <?php echo '['.(strtotime($contrato['Contratoconstructor']['ordeninicio']) * 1000).', 0],'; ?>
                        	
                        		<?php foreach ($supervisiones as $supi): 
                        			echo '['.(strtotime($supi['Informesupervisor']['fechafinsupervision']) * 1000).', '.$supi['Informesupervisor']['valoravancefinanciero'].'],'; 
                        		endforeach; ?>
                        		]
        },        
        "Estimacion": {
            label: "Estimacion",
            data:   [
                        		<?php echo '['.(strtotime($contrato['Contratoconstructor']['ordeninicio']) * 1000).', 0],'; ?>
                        		<?php foreach ($estimaciones as $esti): 
                        			echo '['.(strtotime($esti['Estimacion']['fechafinestimacion']) * 1000).', '.$esti['Estimacion']['montoestimado'].'],'; 
                        		endforeach; ?>
                        		]
        },
        "Avance Programado": {
            label: "Avance Programado",
            data:   [
                        		<?php echo '['.(strtotime($contrato['Contratoconstructor']['ordeninicio']) * 1000).', 0],'; ?>
                        		<?php foreach ($avances as $ava): 
                        			echo '['.(strtotime($ava['Avanceprogramado']['fechaavance']) * 1000).', '.$ava['Avanceprogramado']['montoavfinancieroprog'].'],'; 
                        		endforeach; ?>
                        		]
        }
    };

    // hard-code color indices to prevent them from shifting as
    // countries are turned on/off
    var i = 0;
    $.each(datasets, function(key, val) {
        val.color = i;
        ++i;
    });
    
    // insert checkboxes 
    var choiceContainer = $("#choices");
    $.each(datasets, function(key, val) {
        choiceContainer.append('<br/><input type="checkbox" name="' + key +
                               '" checked="checked" id="id' + key + '">' +
                               '<label for="id' + key + '">'
                                + val.label + '</label>');
    });
    choiceContainer.find("input").click(plotAccordingToChoices);

    
    function plotAccordingToChoices() {
        var data = [];

        choiceContainer.find("input:checked").each(function () {
            var key = $(this).attr("name");
            if (key && datasets[key])
                data.push(datasets[key]);
        });

        if (data.length > 0)
            $.plot($("#placeholder1"), data, {
                series: {
                                lines: { show: true },
                                points: { show: true }
                            },
                /*valueLabels: {
				   show: true,
				   showAsHtml: false,
				   showLastValue: true
				  },*/
                yaxis: { min: 0 },
                xaxis: { mode: "time",  timeformat: "%d/%m/%y" }
            });
    }

    plotAccordingToChoices();
    
    
});



$(function () {
        var d1 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.25)
            d1.push([i, Math.sin(i)]);
    
        var d2 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.25)
            d2.push([i, Math.cos(i)]);

        var d3 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.1)
            d3.push([i, Math.tan(i)]);
    
        // ticks: [0, [Math.PI/2, "\u03c0/2"], [Math.PI, "\u03c0"], [Math.PI * 3/2, "3\u03c0/2"], [Math.PI * 2, "2\u03c0"]]

        $.plot($("#placeholder3"), [
            { label: "sin(x)",  data: d1},
            { label: "cos(x)",  data: d2},
            { label: "tan(x)",  data: d3}
        ], {
            series: {
                lines: { show: true },
                points: { show: true }
            },
            xaxis: {
                ticks: [0, [Math.PI/2, "pi/2"], [Math.PI, "pi"], [Math.PI * 3/2, "3pi/2"], [Math.PI * 2, "2pi"]]
            },
            yaxis: {
                ticks: 10,
                min: -2,
                max: 2
            },
            grid: {
                backgroundColor: { colors: ["#fff", "#eee"]},   
                canvasText: {show: true, font: "sans 9px"}         
            },
            legend: {
                position: "se",
                backgroundColor: "#ff4",
                backgroundOpacity: 0.35
            }
        });

        if ($.support.cssFloat) {   // currently evals to False in IE
             var s = document.createElement("script");
             s.setAttribute("type", "text/javascript");
             s.setAttribute("src", "base64.js");
             var h = document.getElementById("head");
             h.appendChild(s);

             var s2 = document.createElement("script");
             s2.setAttribute("type", "text/javascript");
             s2.setAttribute("src", "canvas2image.js");
             h.appendChild(s2);

             document.getElementById("convertpngbtn").onclick = function() {
                 saveFlotGraphAsPNG("placeholder3", "main");
             }
         } else {
             document.getElementById("convertpngbtn").onclick = function() {
                 alert("Image Exporting not available in IE");
             }
         }

    });


</script>


