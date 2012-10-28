<!-- File: /app/View/Ubicacions/ubicacion_rep_proy_depmuni_pdf.ctp -->
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
	
	public function Tabladatos($header, $departamentos)
	{
		// Colors, line width and bold font
        $this->SetFillColor(230, 237, 245);
        $this->SetTextColor(79,118,163);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        //$header = array('Proyecto','Número de proyecto','Beneficiarios','Empleos generados');
        $w = array(50,40);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 6, $header[$i], 1, 0, 'C', 1);
        }
		$this->Ln();
        // Color and font restoration
        $this->SetFillColor(247, 249, 252);
        $this->SetTextColor(0,5,85);
        $this->SetFont('');
        // Data
        $fill = 0;
		foreach ($departamentos as $dep) 
        {
            //nombre
            $this->MultiCell($w[0], 6, $dep['departamento'], 'LR', 'C', $fill, 0, '', '', true, 0, false, true, 6,'M',true);
			$this->Cell($w[1], 6, $dep['cantidep'], 'LR', 0, 'C', $fill);
			
			 $this->Ln();
            $fill=!$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
	}
	
	public function Tablamun($header, $municipios)
	{
		// Colors, line width and bold font
        $this->SetFillColor(230, 237, 245);
        $this->SetTextColor(79,118,163);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        //$header = array('Proyecto','Número de proyecto','Beneficiarios','Empleos generados');
        $w = array(50,40);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 6, $header[$i], 1, 0, 'C', 1);
        }
		$this->Ln();
        // Color and font restoration
        $this->SetFillColor(247, 249, 252);
        $this->SetTextColor(0,5,85);
        $this->SetFont('');
        // Data
        $fill = 0;
		foreach ($municipios as $mun) 
        {
            //nombre
            $this->MultiCell($w[0], 6, $mun['municipio'], 'LR', 'C', $fill, 0, '', '', true, 0, false, true, 6,'M',true);
			$this->Cell($w[1], 6, $mun['cantmuni'], 'LR', 0, 'C', $fill);
			
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
$pdf->SetTitle('Historial de empresa');
$pdf->SetSubject('Empresa supervisora');
$pdf->SetKeywords('Empresa, Supervisora, Supervisión, Contrato, MAG');

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
$pdf->Cell(0, 10, 'Zonas beneficiadas con el desarrollo de proyectos', 0, false, 'C', 0, '', 0, false, 'T', 'M');
$pdf->Ln(10);
$fill = 0;
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(160, 10, 'Comprendidos entre el período del '.$inicio." al ".$fin, 
			0, false, 'C', 0, '', 0, false, 'T', 'M');
$pdf->Ln(10);
$header = array('Departamentos','Proyectos realizados');
$pdf->Tabladatos($header, $departamentos);
$pdf->Ln(10);
$header = array('Municipios','Proyectos realizados');
$pdf->Tablamun($header, $municipios);

$pdf->Output('example_001.pdf', 'I');
exit;
//============================================================+
// END OF FILE
//============================================================+
?>