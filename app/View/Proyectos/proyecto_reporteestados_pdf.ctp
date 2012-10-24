<!-- File: /app/View/Proyectos/proyecto_reporteestados_pdf.ctp -->
<?php 
App::import('Vendor','tcpdf/tcpdf');  
ob_clean();

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $logo_file = K_PATH_IMAGES.'logo_mag.jpg';
		$this->Image($logo_file, 20, 20, 40, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Fuente
        $this->SetFont('helvetica', 'B', 10);
        // Titulo
        $this->MultiCell(98, 15, 'MINISTERIO DE AGRICULTURA Y GANADERIA DIRECCION GENERAL DE ORDENAMIENTO FORESTAL, CUENCAS Y RIEGO ',
        				 0, 'C', false, 1, 65, 20, true, 0, false, true, 0, 'M', false);
		
		
		//$this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		
		// escudo
		$escudo_file = K_PATH_IMAGES.'escudo.gif';
		$this->Image($escudo_file, 168, 20, 22, '', 'GIF', '', 'T', false, 300, '', false, false, 0, false, false, false);
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		
		$this->Cell(0, 10, date("d/m/yy H:i:s"), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
	
	

} // fin class MYPDF


// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('TG2012 - SICPRO');
$pdf->SetTitle('Reporte Estados de Proyectos y Contratos');
$pdf->SetSubject('Proyecto');
$pdf->SetKeywords('Proyecto, Contrato, MAG');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(25, 50, 20);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// add a page
$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, 'Estado de Proyectos y Contratos', 0, false, 'C', 0, '', 0, false, 'T', 'M');
$pdf->Ln(20);
$fill = 0;

/*
$pdf->SetFont('helvetica', '', 11);

$pdf->MultiCell(160, 12, $dataproy[0]['Proyecto']['nombreproyecto'], 
				0, 'C', $fill, 0, '', '', true, 0, false, true, 12,'T',true);
$pdf->Ln(15);
$pdf->MultiCell(135, 12, 'Número de proyecto: '.$dataproy[0]['Proyecto']['numeroproyecto'], 
				0, 'L', $fill, 0, '', '', true, 0, false, true, 12,'T',true);
$pdf->Ln(5);
$pdf->MultiCell(135, 12, 'Estado actual: '.$dataproy[0]['Proyecto']['estadoproyecto'], 
				0, 'L', $fill, 0, '', '', true, 0, false, true, 12,'T',true);
$pdf->Ln(5);
$pdf->MultiCell(135, 12, 'División responsable: '.$dataproy[0]['Division']['divison'], 
				0, 'L', $fill, 0, '', '', true, 0, false, true, 12,'T',true);
$pdf->Ln(20);

$pdf->SetFont('helvetica', '', 10);

$pdf->Cell(0, 10, 'Fuentes asignadas', 0, false, 'C', 0, '', 0, false, 'T', 'M');
$pdf->Ln(10);
$header = array('Fuente financiamiento', 'Monto destinado');
$pdf->Tablafuentes($header,$fuentes);
$pdf->Ln(10);
$pdf->Cell(0, 10, 'Contratos', 0, false, 'C', 0, '', 0, false, 'T', 'M');
$pdf->Ln(10);
$header = array('Código','Tipo','Monto','Plazo','Orden de inicio','Administrador');
$pdf->Tablacontratos($header,$contratos);
$pdf->Ln(20);
*/
 $anterior = null; 
foreach ($proyectos as $proy): 
 if($proy['Proyecto']['idproyecto']!=$anterior){
 	
		$pdf->Ln(20);
		
		$pdf->SetFont('helvetica', '', 10);
		$pdf->Ln(5);
		$pdf->MultiCell(135, 12, 'Proyecto: '.$proy['Proyecto']['numeroproyecto'], 
				0, 'L', $fill, 0, '', '', true, 0, false, true, 12,'T',true); 	 
	//Proyecto: $proy['Proyecto']['numeroproyecto'];
		$pdf->Ln(25);
		$pdf->MultiCell(135, 12, 'Nombre Proyecto: '.$proy['Proyecto']['nombreproyecto'], 
				0, 'L', $fill, 0, '', '', true, 0, false, true, 12,'T',true);
				
			//NombreProyecto:  $proy['Proyecto']['nombreproyecto'];
			//Estado: $proy['Proyecto']['estadoproyecto'];
			
			
		/*	<!--<h4>Fuentes Asignadas: </h4>
				<div id="tablagrid">
				<table id="grid">
				    <thead>
				    <tr>
				        <th data-field="Nombrefuente" width="85%">Nombre fuente</th>
				        <th data-field="Montofuente" width="20%">Monto</th>
				    </tr>
				    </thead>
				    <tbody>
				    <?php foreach ($proyectos as $fuentes): 
						if($fuentes['Proyecto']['idproyecto']==$proy['Proyecto']['idproyecto']) {?>
				   	<tr>
				   		<td><?php echo $fuentes['Fuentefinanciamiento']['nombrefuente'];?></td>
				   		<td><?php echo $fuentes['Financia']['montoparcial'];?></td>
				   	</tr>
				   	<?php } 
					endforeach?>
					</tbody>
				</table>
				</div>

			<h4>Contratos: </h4>
				<div id="tablagrid">
				<table id="grid">
				    <thead>
				    <tr>
				        <th data-field="Codigocontrato" width="15%">Codigo Contrato</th>
				        <th data-field="Nombrecontrato" width="35%">Nombre Contrato</th>
				        <th data-field="Estadocontrato">Estado Contrato</th>
				        <th data-field="fechaini" width="15%">Fecha Inicio</th>
				        <th data-field="fechafin" width="15%">Fecha Fin</th>
				    </tr>
				    </thead>
				    <tbody>
					<?php foreach ($contratos as $contra): 
						if($contra['idproyecto']==$proy['Proyecto']['idproyecto']) {?>
				   	<tr>
				   		<td><?php echo $contra['codigocontrato'];?></td>
				   		<td><?php echo $contra['nombrecontrato'];?></td>
				   		<td><?php echo $contra['estadocontrato'];?></td>
				   		<td><?php echo $contra['fechainiciocontrato'];?></td>
				   		<td><?php echo $contra['fechafincontrato'];?></td>
				   	</tr>
				   	<?php } 
					endforeach?>
					</tbody>
				</table>
				</div>-->		*/						
		
			$anterior= $proy['Proyecto']['idproyecto'];
			}
			endforeach; 
$pdf->Output('example_001.pdf', 'I');
exit;
//============================================================+
// END OF FILE
//============================================================+
?>