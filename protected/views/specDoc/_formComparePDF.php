<?php


function renderDate($value)
{
    $th_month = array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $dates = explode("/", $value);
    $d=0;
    $mi = 0;
    $yi = 0;
    foreach ($dates as $key => $value) {
         $d++;
         if($d==2)
            $mi = $value;
         if($d==3)
            $yi = $value;
    }
    if(substr($mi, 0,1)==0)
        $mi = substr($mi, 1);
    if(substr($dates[0], 0,1)==0)
        $d = substr($dates[0], 1);


    $renderDate = $d." ".$th_month[$mi]." ".$yi;
    if($renderDate==0)
        $renderDate = "";   

    return $renderDate;             
}


function renderDate2($value)
{
    $th_month = array("01"=>"ม.ค.","02"=>"ก.พ.","03"=>"มี.ค.","04"=>"เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $str = explode(" ", $value);
    $dates = explode("-", $str[0]);
    
    $renderDate = $dates[2]." ".$th_month[$dates[1]]." ".($dates[0]+543);

    return $renderDate;             
}



// Include the main TCPDF library (search for installation path).
Yii::import('ext.tcpdf.tcpdf',true);
//require_once('tcpdf.php');

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        
        // Set font
        //$this->SetFont('helvetica', 'B', 20);
        // Title
        //$this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
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
        //$this->Cell(0, 5, date("d/m/Y"), 0, false, 'R', 0, '', 0, false, 'T', 'M');
        $html = '<table>';
        $html .= '<tr>';
        $html .= '<td width="60%" style="text-align:left"><b>เงื่อนไขระบบจัดทำ Spec.</b><br>คุณสมบัติที่แสดงใน spec. ต้องมีมากกว่า 2 รายขึ้นไป</td>';
        $html .= '<td width="40%" style="text-align:right">'.date('M').' '.date('Y').'<br>กอย.ฝอผ.</td>';
        $html .= '</tr>';
        $html .= '</table>';
        //$this->writeHTMLCell(145, 550, 10, 270, $html, 0, 1, false, true, 'C', false);
        //writeHTMLCell ($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=false, $reseth=true, $align='', $autopadding=true)
    }
}

// create new PDF document
//$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Boybe');
$pdf->SetTitle(' report');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setPrintHeader(false);
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
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
$pdf->SetFont('thsarabun', '', 14, '', true);


// Add a page
// This method has several options, check the source code documentation for more information.
//$pdf->AddPage();

// set text shadow effect
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
//$details = QuotationDetail::model()->findAll(array('condition'=>'request_id='.$model->id));
// Set some content to print

$html = "";
$short_month = array('0'=>'','1' => 'ม.ค.', '2' => 'ก.พ.', '3' => 'มี.ค.', '4' => 'เม.ย.','5' => 'พ.ค.', '6' => 'มิ.ย.', '7' => 'ก.ค.', '8' => 'ส.ค.', '9' => 'ก.ย.', '10' => 'ต.ค.', '12' => 'ธ.ค.'); 


            $html .= "วัสดุ : ".$model->material.'<br>';
            $html .= "รายละเอียด : ".$model->detail.'<br>'; 
            $html .= "ขนาด/ชนิด/ประเภท : ".$model->dimension.'<br>';
            $html .= "หน่วย : ".$model->unit.'<br>';
            $html .= "สืบราคาจาก : <br>";

            $spec = SpecDocCompare::model()->findAll(array("condition"=>"spec_id=".$model->id));
            $ncompare = count($spec);
            $html .= '<table border="1"><tr><td colspan="'.$ncompare.'" style="text-align:center">คู่เทียบ</td></tr><tr>';
            for ($i=0; $i < $ncompare ; $i++) { 
                $html .= '<td  style="text-align:center">'.($i+1).'</td>';
            }

            $html .= "</tr><tr>";

            foreach ($spec as $key => $value) {
                $html .= '<td style="text-align:center">';
                $html .= $value['brand']." รุ่น ".$value['model']."<br>ราคา ";
                $html .= number_format($value['price'])." บาท <br> วันที่ ".renderDate($value['date_price']);
                $html .= "</td>";
            }
            $html .= "</tr></table>";



//$html .= '</table>';
   
//echo $html;
  
$pdf->AddPage();
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$pdf->Output($_SERVER['DOCUMENT_ROOT'].'/honeycomb/report/temp/'.$filename,'F');

ob_end_clean() ;

exit;
?>