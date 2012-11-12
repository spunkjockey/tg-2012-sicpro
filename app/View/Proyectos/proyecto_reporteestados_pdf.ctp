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
		$escudo_file = K_PATH_IMAGES.'escudo.jpg';
		$this->Image($escudo_file, 168, 20, 22, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
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
$pdf->Cell(0, 10, 'Estado de Proyectos y Contratos para la Division '.$nombredivision['Division']['divison'], 0, false, 'C', 0, '', 0, false, 'T', 'M');
$pdf->Ln(20);
$fill = 0;


 $anterior = null; 
 $ultimo = end($proyectos);
	 
foreach ($proyectos as $proy): 
 if($proy['Proyecto']['idproyecto']!=$anterior){
 		// Colors, line width and bold font
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.3);
        $pdf->SetFont('', 'B');
		
				
		$pdf->SetFont('helvetica', '', 10);
								
		$pdf->Ln(5);
		$pdf->MultiCell(135, 12, 'Proyecto: '.$proy['Proyecto']['numeroproyecto'], 
				0, 'L', $fill, 0, '', '', true, 0, false, true, 12,'T',true); 	 
	//Proyecto: $proy['Proyecto']['numeroproyecto'];
		$pdf->Ln(5);
		$pdf->MultiCell(135, 12, 'Nombre Proyecto: '.$proy['Proyecto']['nombreproyecto'], 
				0, 'L', $fill, 0, '', '', true, 0, false, true, 12,'T',true);
				
		$pdf->Ln(15);
		$pdf->MultiCell(135, 12, 'Estado Proyecto: '.$proy['Proyecto']['estadoproyecto'], 
				0, 'L', $fill, 0, '', '', true, 0, false, true, 12,'T',true);
				
			//NombreProyecto:  $proy['Proyecto']['nombreproyecto'];
			//Estado: $proy['Proyecto']['estadoproyecto'];
		
		$pdf->Ln(10);
		$pdf->MultiCell(135, 12, 'Fuentes Asignadas: ', 
				0, 'L', $fill, 0, '', '', true, 0, false, true, 12,'T',true);
		$pdf->Ln(10);
						
		// Colors, line width and bold font
        $pdf->SetFillColor(230, 237, 245);
        $pdf->SetTextColor(79,118,163);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.3);
        $pdf->SetFont('', 'B');
		
		
		$pdf->Cell(65, 7, 'Nombre Fuente', 1, 0, 'C', 1);
		$pdf->Cell(35, 7, 'Monto', 1, 0, 'C', 1);
		$pdf->ln();
        // Color and font restoration
        $pdf->SetFillColor(247, 249, 252);
        $pdf->SetTextColor(0,5,85);
        $pdf->SetFont('');
        // Data
        $fill = 0;
		
		foreach ($proyectos as $fuentes): 
			{
						if($fuentes['Proyecto']['idproyecto']==$proy['Proyecto']['idproyecto'])
						 {
							$pdf->MultiCell(65, 7, $fuentes['Fuentefinanciamiento']['nombrefuente'], 'LR', 'C', $fill, 0, '', '', true, 0, false, true, 12,'M',true);
							$pdf->MultiCell(35, 7, "$ ".$fuentes['Financia']['montoparcial'], 'LR', 'C', $fill, 0, '', '', true, 0, false, true, 12,'M',true);
							$pdf->ln();	
				   	 	}
        $fill=!$fill; 
		}
		endforeach;
		$pdf->Cell(100, 0, '', 'T');
		$pdf->Ln(5);	

		$pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.3);
		
		$pdf->Ln(10);
		$pdf->MultiCell(135, 12, 'Contratos: ', 
				0, 'L', $fill, 0, '', '', true, 0, false, true, 12,'T',true);
		$pdf->Ln(10);
						
		// Colors, line width and bold font
        $pdf->SetFillColor(230, 237, 245);
        $pdf->SetTextColor(79,118,163);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.3);
        $pdf->SetFont('', 'B');
		
		
		$pdf->Cell(20, 7, 'Codigo', 1, 0, 'C', 1);
		$pdf->Cell(70, 7, 'Nombre Contrato', 1, 0, 'C', 1);
		$pdf->Cell(25, 7, 'Estado', 1, 0, 'C', 1);
		$pdf->Cell(25, 7, 'Fecha Inicio', 1, 0, 'C', 1);
		$pdf->Cell(25, 7, 'Fecha fin', 1, 0, 'C', 1);
		$pdf->ln();
        // Color and font restoration
        $pdf->SetFillColor(247, 249, 252);
        $pdf->SetTextColor(0,5,85);
        $pdf->SetFont('');
        // Data
        $fill = 0;
		
		foreach ($contratos as $contra): 
			{
				if($contra['idproyecto']==$proy['Proyecto']['idproyecto']) {
					$pdf->MultiCell(20, 12, $contra['codigocontrato'], 'LR', 'C', $fill, 0, '', '', true, 0, false, true, 12,'M',true);
					$pdf->MultiCell(70, 12, $contra['nombrecontrato'], 'LR', 'C', $fill, 0, '', '', true, 0, false, true, 12,'M',true);
					if (isset($contra['estadocontrato']))
						$estado = $contra['estadocontrato'];
					else 
						$estado = "No Iniciado";
					$pdf->MultiCell(25, 12, $estado, 'LR', 'C', $fill, 0, '', '', true, 0, false, true, 12,'M',true);
					$pdf->MultiCell(25, 12,  date('d/m/Y',strtotime($contra['fechainiciocontrato'])), 'LR', 'C', $fill, 0, '', '', true, 0, false, true, 12,'M',true);
					$pdf->MultiCell(25, 12,  date('d/m/Y',strtotime($contra['fechafincontrato'])), 'LR', 'C', $fill, 0, '', '', true, 0, false, true, 12,'M',true);
					$pdf->ln();	
				}
			$fill=!$fill; 
			} 
		endforeach;
		$pdf->Cell(165, 0, '', 'T');
		$pdf->Ln(5);
					
			// add a page
			if($proy['Proyecto']['idproyecto']!=$ultimo['Proyecto']['idproyecto'])
			{
			 $pdf->AddPage();
			 $pdf->SetFont('helvetica', 'B', 14);
			 $pdf->SetTextColor(0,0,0);
			 $pdf->Cell(0, 10, 'Estado de Proyectos y Contratos para la Division '.$nombredivision['Division']['divison'], 0, false, 'C', 0, '', 0, false, 'T', 'M');
			 $pdf->Ln(20);
			 $fill = 0;
			}
			$anterior= $proy['Proyecto']['idproyecto'];
			}
			endforeach; 
$pdf->Output('EstadoProyectoContrato.pdf', 'I');
exit;
//============================================================+
// END OF FILE
//============================================================+
?>