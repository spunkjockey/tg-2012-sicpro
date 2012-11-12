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
	
	public function Tablacontratos($header, $datos)
	{
		// Colors, line width and bold font
        $this->SetFillColor(230, 237, 245);
        $this->SetTextColor(79,118,163);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        //$header = array('Código','Monto','Orden de inicio','Plazo(días)','Administrador','Empresa supervisada');
        $w = array(20,25,30,25,30,40);
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
		foreach ($datos as $dat) 
        {
            //codigo
            $this->Cell($w[0], 12, $dat['Empresaconsuper']['codigosuper'], 'LR', 0, 'C', $fill);
			//monto
            $this->MultiCell($w[1], 12, '$'.number_format($dat['Empresaconsuper']['montooriginal'],2), 'LR', 'C', $fill, 0, '', '', true, 0, false, true, 6,'M',true);
            //orden inicio
			if(isset($dat['Empresaconsuper']['ordeninicio']))
				$fecha = date('d/m/Y',strtotime($dat['Empresaconsuper']['ordeninicio']));
			else
			    $fecha= 'No definida'; 
			$this->MultiCell($w[2], 12, $fecha,'LR', 'C', $fill, 0, '', '', true, 0, false, true, 6,'M',true);
			//plazo
            $this->Cell($w[3], 12, $dat['Empresaconsuper']['plazoejecucion'], 'LR', 0, 'C', $fill);
			//admin
			$this->MultiCell($w[4], 12, $dat['Empresaconsuper']['nomcompleto'], 'LR', 'C', $fill, 0, '', '', true, 0, false, true, 12,'M',true);
            //constructora
            $this->MultiCell($w[5], 12, $dat['Empresaconsuper']['constructora'], 'LR', 'C', $fill, 0, '', '', true, 0, false, true, 12,'M',true);
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
$pdf->Cell(0, 10, 'Historial de empresa', 0, false, 'C', 0, '', 0, false, 'T', 'M');
$pdf->Ln(20);
$fill = 0;
$pdf->SetFont('helvetica', '', 11);
$pdf->Cell(160, 10, $nombre, 0, false, 'C', 0, '', 0, false, 'T', 'M');
$pdf->Ln(20);
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 10, 'Contratos que ha desarrollado', 0, false, 'C', 0, '', 0, false, 'T', 'M');
$pdf->Ln(10);
$header = array('Código','Monto','Orden de inicio','Plazo(días)','Administrador','Empresa supervisada');
$pdf->Tablacontratos($header,$datos);
$pdf->Output('example_001.pdf', 'I');
exit;
//============================================================+
// END OF FILE
//============================================================+
?>