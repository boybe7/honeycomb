<?php

	require_once($_SERVER['DOCUMENT_ROOT'].'/engstd/protected/tcpdf/tcpdf.php');

	class MYPDF extends TCPDF {

		    //Page header
			private $date_start;
		    private $date_end;


		    public function setDate($start, $end) {
		        $this->date_start = $start;
		        $this->date_end = $end;
		    }

		    public function Header() {
		        
		        // Set font
		        $this->SetFont('thsarabun', 'B', 20);
		        // Title
		        //$this->Cell(0, 5, 'รายงานสรุปยอดรับรองท่อ/อุปกรณ์', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		        $this->writeHTMLCell(145, 20, 40, 10, 'รายงานสรุปยอดรับรองท่อ/อุปกรณ์<br>การประปานครหลวง<div style="font-size:16px;">วันที่ดำเนินการ '.$this->date_start." ถึง ".$this->date_end."</div>", 0, 1, false, true, 'C', false);
		        $image_file = $_SERVER['DOCUMENT_ROOT'].'/engstd/images/mwa_logo.png';
		        $this->Image($image_file, 180, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		    }   

		    // Page footer
		    public function Footer() {
		        // Position at 15 mm from bottom
		        $this->SetY(-10);
		        // Set font
		        $this->SetFont('thsarabun', '', 11);
		        // Page number
		        //$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		        // Logo
		        //$image_file = 'bank/image/mwa2.jpg';
		        //$this->Image($image_file, 170, 270, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		        $this->Cell(0, 5, date("d/m/Y"), 0, false, 'R', 0, '', 0, false, 'T', 'M');

		        $this->writeHTMLCell(145, 550, 40, 287, '-'.$this->getAliasNumPage().'/'.$this->getAliasNbPages().'-', 0, 1, false, true, 'C', false);
		        //writeHTMLCell ($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=false, $reseth=true, $align='', $autopadding=true)
		    }
		}

		// create new PDF document
		//$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


		$str_date = explode("/", $date_start);
		if(count($str_date)>1)
		    $date_start = $str_date[2]."-".$str_date[1]."-".$str_date[0];

		$str_date = explode("/", $date_end);
		if(count($str_date)>1)
		    $date_end = $str_date[2]."-".$str_date[1]."-".$str_date[0];

		if(empty($date_end))
			$date_end = $date_start;
		if(empty($date_start))
			$date_start = $date_end;

		$models = Yii::app()->db->createCommand()
					->select('sum(ct.quantity) as sum, detail,prod_code,ct.prod_size as size,prod_unit')
					->from('c_cer_doc cd')	
					->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
          ->join('m_product p', 'p.prod_name=ct.detail')
					->where('cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"')		
          ->group('detail')			                   
					->queryAll();

		$pdf->setDate($date_start,$date_end);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Boybe');
		$pdf->SetTitle('TCPDF Example 001');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
		$pdf->setPrintHeader(true);
		$pdf->setFooterData(array(0,64,0), array(0,64,128));

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, 40, 10);
		//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set default font subsetting mode
		$pdf->setFontSubsetting(true);

		// Set font
		// dejavusans is a UTF-8 Unicode font, if you only need to
		// print standard ASCII chars, you can use core fonts like
		// helvetica or times to reduce file size.
		
		$pdf->AddPage();


		
		$html = "";
		$pdf->SetFont('thsarabun', '', 12, '', true);
		
	
		$html .= '<table>';
	    $html .= '<thead>';
	    $html .= '  <tr style="line-height: 40px;backg" bgcolor="#f5f5f5">';
	    $html .= '    <th style="font-size:18px;font-weight:bold;border:1px solid black;text-align:center;width:25%">รหัสท่อ/อุปกรณ์</th>';
	    $html .= '    <th style="font-size:18px;font-weight:bold;border:1px solid black;text-align:center;width:35%">รายละเอียดท่อ/อุปกรณ์</th>';
	    $html .= '    <th style="font-size:18px;font-weight:bold;border:1px solid black;text-align:center;width:20%">ขนาด '.TCPDF_FONTS::unichr(248).' มม.</th>';
	    $html .= '    <th style="font-size:18px;font-weight:bold;border:1px solid black;text-align:center;width:10%">จำนวน</th>';
	    $html .= '    <th style="font-size:18px;font-weight:bold;border:1px solid black;text-align:center;width:10%">หน่วย</th>';
	    $html .= '  </tr>';
	    $html .= '</thead>';
	    $html .= '<tbody>';
	       
	                  foreach ($models as $key => $model) {
	                     $html .= ' <tr>';
	                     $html .= '<td style="border:1px solid black;width:25%"> '.$model["prod_code"].'</td><td style="border:1px solid black;width:35%"> '.$model["detail"].'</td><td style="border:1px solid black;text-align:center;width:20%">'.$model["size"].'</td><td style="border:1px solid black;text-align:center;width:10%">'.$model["sum"].'</td><td style="border:1px solid black;text-align:center;width:10%">'.$model["prod_unit"].'</td>';
	                     $html .= '</tr>';
	                  }
	       
	     
	    $html .= '</tbody>';
	  	$html .= '</table>';

		//$html .= '<div align="center" style="font-size:25px;font-weight:bold">ใบรับรองท่อและอุปกรณ์ประปาเลขที่ </div>';
		//$html .= '<div align="center" style="font-size:16px;">แนบท้ายหนังสือกมว.ที่.................. </div>';
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

       

        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/engstd/print/'.'tempReport.pdf'))
		{    
		    if(unlink($_SERVER['DOCUMENT_ROOT'].'/engstd/print/'.'tempReport.pdf'))
		        $pdf->Output($_SERVER['DOCUMENT_ROOT'].'/engstd/print/'.'tempReport.pdf','F');
		}else{
		   $pdf->Output($_SERVER['DOCUMENT_ROOT'].'/engstd/print/'.'tempReport.pdf','F');
		}

		
		ob_end_clean() ;

		exit;


       

?>
