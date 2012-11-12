<!-- File: /app/View/Proyectos/proyecto_resultados_repgen_pdf.ctp -->
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
	
	// Tabla de fuentes de financiamiento
	public function Tablafuentes($header,$fuentes)
	{
		// Colors, line width and bold font
        $this->SetFillColor(230, 237, 245);
        $this->SetTextColor(79,118,163);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(60, 30);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
		$this->Ln();
        // Color and font restoration
        $this->SetFillColor(247, 249, 252);
        $this->SetTextColor(0,5,85);
        $this->SetFont('');
        // Data
        $fill = 0;
        foreach ($fuentes as $ff) 
        {
            $this->Cell($w[0], 12, $ff['Fuentefinanciamiento']['nombrefuente'], 'LR', 0, 'C', $fill);
            $this->MultiCell($w[1], 12, '$'.number_format($ff['Financia']['montoparcial'],2), 'LR', 'C', $fill, 0, '', '', true, 0, false, true, 6,'M',true);
            $this->Ln();
            $fill=!$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
        
	}

	public function Tablacontratos($header, $contratos)
	{
		// Colors, line width and bold font
        $this->SetFillColor(230, 237, 245);
        $this->SetTextColor(79,118,163);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(20,35,25,15,35,35);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
		$this->Ln();
        // Color and font restoration
        $this->SetFillColor(247, 249, 252);
        $this->SetTextColor(0,5,85);
        $this->SetFont('');
        // Data
        $fill = 0;
		//$header = array('Código','Tipo','Monto','Plazo','Orden de inicio','Administrador');
        foreach ($contratos as $con) 
        {
            //codigo
            $this->Cell($w[0], 12, $con['Contrato']['codigocontrato'], 'LR', 0, 'C', $fill);
			//tipo
			$this->MultiCell($w[1], 12, $con['Contrato']['tipocontrato'], 'LR', 'C', $fill, 0, '', '', true, 0, false, true, 12,'M',true);
            //monto
            $this->MultiCell($w[2], 12, '$'.number_format($con['Contrato']['montooriginal'],2), 'LR', 'C', $fill, 0, '', '', true, 0, false, true, 6,'M',true);
            //plazo
            $this->Cell($w[3], 12, $con['Contrato']['plazoejecucion'], 'LR', 0, 'C', $fill);
			//orden inicio
			if(isset($con['Contrato']['ordeninicio']))
				$fecha = date('d/m/Y',strtotime($con['Contrato']['ordeninicio']));
			else
			    $fecha= 'No definida'; 
			$this->MultiCell($w[4], 12, $fecha,'LR', 'C', $fill, 0, '', '', true, 0, false, true, 6,'M',true);
			//admin
			$this->MultiCell($w[5], 12, $con['Persona']['nombrespersona'].' '.$con['Persona']['apellidospersona'], 'LR', 'C', $fill, 0, '', '', true, 0, false, true, 12,'M',true);
            $this->Ln();
            $fill=!$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
	}
	

} // fin class MYPDF

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('TG2012 - SICPRO');
$pdf->SetTitle('Reporte general de proyecto');
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
$pdf->Cell(0, 10, 'Reporte general', 0, false, 'C', 0, '', 0, false, 'T', 'M');
$pdf->Ln(20);
$fill = 0;
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

$pdf->Output('example_001.pdf', 'I');
exit;
//============================================================+
// END OF FILE
//============================================================+
?>