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

        //$this->writeHTMLCell(145, 550, 70, 200, '-'.$this->getAliasNumPage().'/'.$this->getAliasNbPages().'-', 0, 1, false, true, 'C', false);
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
$details = QuotationDetail::model()->findAll(array('condition'=>'request_id='.$model->id));
// Set some content to print
$html = "";    
$html .= '<div style="text-align:right">เอกสารขอใบเสนอราคา/Spec. สินค้า</div>';
$html .= '<table border="1" width="100%">';
    $html .= '<tr>';
        $html .= '<td  width="20%" rowspan="2" style="text-align:center"><img src="http://localhost/honeycomb/images/mwa-logo.png" width="100px"></td>';
        $html .= '<td width="60%" style="text-align:center;border-bottom:1px solid white;"><h4>การประปานครหลวง</h4></td>';
        $html .= '<td width="20%">  เลขที่หนังสือ .................</td>';
    $html .= '</tr>';
    $html .= '<tr>';
        $html .= '<td style="text-align:center">ฝ่ายออกแบบระบบผลิตส่งน้ำและงานโยธา<br>400 ถนนประชาชื่น แขวงทุ่งสองห้อง เขตหลักสี่ กรุงเทพฯ 10210</td>';
        $html .= '<td >  วันที่</td>';
    $html .= '</tr>';
    $html .= '<tr>';
        $html .= '<td colspan="3" >&nbsp;&nbsp;&nbsp;เรียน<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;การประปานครหลวงมี่ความสนใจในสินค้า/บริการของท่านในรายการดังต่อไปนี้<br></td>';
    $html .= '</tr>';
$html .= '</table>';
$html .= '<table border="1" width="100%">';    
    $no = 1;
    foreach ($details as $key => $value) {
        $html .= '<tr>';
            $html .= '<td width="5%" style="text-align:center">'.$no.'</td>';
            $html .= '<td width="40%" >&nbsp;&nbsp;'.$value->name.'</td>';
            $html .= '<td width="10%" style="text-align:center">จำนวน</td>';
            $html .= '<td width="15%" style="text-align:center">'.$value->amount.'</td>';
            $html .= '<td width="10%" style="text-align:center">หน่วย</td>';
            $html .= '<td width="20%" style="text-align:center">'.$value->unit.'</td>';
        $html .= '</tr>';

        $no++;
    }

    if($no<10)
    {
        for ($i=$no; $i <11 ; $i++) { 
             $html .= '<tr>';
                $html .= '<td width="5%" style="text-align:center">'.$i.'</td>';
                $html .= '<td width="40%" ></td>';
                $html .= '<td width="10%" style="text-align:center">จำนวน</td>';
                $html .= '<td width="15%" style="text-align:center"></td>';
                $html .= '<td width="10%" style="text-align:center">หน่วย</td>';
                $html .= '<td width="20%" style="text-align:center"></td>';
            $html .= '</tr>';
        }
    }
$html .= '</table><br>';
$html .= '<table border="1" collapse="0" width="100%">';    
    $html .= '<tr>';
        $html .= '<td width="2%" style="border-right:1px solid white;border-bottom:1px solid white;"></td><td width="98%" style="border-bottom:1px solid white;"><br><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เพื่อใช้ประกอบในงาน......'.$model->detail.'.....โดยขอให้ท่านส่ง <b><u>Spec.สินค้า วิธีการใช้/ติดตั้ง และราคา</u></b> ตามรายการข้างต้น เพื่อใช้ประกอบการจัดทำ Spec. /จัดทำราคากลางต่อไป<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;กปน. ขอขอบพระคุณในความอนุเคราะห์ดังกล่าว และหากมีข้อสงสัยหรือต้องการรายละเอียดเพิ่มเติม สามารถิดต่อเจ้าหน้าที่ กปน. ได้ที่</td>';
    $html .= '</tr>';
$html .= '</table>'; 
$html .= '<table border="0" width="100%">';    
    $html .= '<tr>';
       $html .= '<td width="40%" style="border-left:1px solid black;">&nbsp;&nbsp;1. คุณ</td>';
       $html .= '<td width="30%">ตำแหน่ง</td>';
       $html .= '<td width="30%"  style="border-right:1px solid black;">เบอร์มือถือ</td>'; 
    $html .= '</tr>';
    $html .= '<tr>';
       $html .= '<td width="40%" style="border-left:1px solid black;">&nbsp;&nbsp;เบอร์โต๊ะ 02-504-0123 ต่อ </td>';
       $html .= '<td width="30%">E-mail</td>';
       $html .= '<td width="30%"  style="border-right:1px solid black;">ID Line</td>'; 
    $html .= '</tr>';
    $html .= '<tr>';
       $html .= '<td width="40%" style="border-left:1px solid black;">&nbsp;&nbsp;2. คุณ</td>';
       $html .= '<td width="30%">ตำแหน่ง</td>';
       $html .= '<td width="30%"  style="border-right:1px solid black;">เบอร์มือถือ</td>'; 
    $html .= '</tr>';
    $html .= '<tr>';
       $html .= '<td width="40%" style="border-left:1px solid black;">&nbsp;&nbsp;เบอร์โต๊ะ 02-504-0123 ต่อ </td>';
       $html .= '<td width="30%">E-mail</td>';
       $html .= '<td width="30%" style="border-right:1px solid black;">ID Line</td>'; 
    $html .= '</tr>';

$html .= '</table>';   
$html .= '<table border="1" width="100%">';    
    $html .= '<tr>';
        $html .= '<td width="2%" style="border-right:1px solid white;border-top:1px solid white;"></td><td style="border-left:1px solid white;border-top:1px solid white;" width="98%"><br><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ทั้งนี้ได้แนบเอกสารดังนี้ &nbsp;&nbsp;&nbsp;&nbsp;  &#9711;  Spec. งานก่อสร้างเบื้องต้น    &nbsp;&nbsp;&nbsp;&nbsp;  &#9711; แบบก่อสร้าง &nbsp;&nbsp;&nbsp;&nbsp; มาใน E-mail ฉบับนี้ หากสินค้าและบริการของท่านไม่สามารถดำเนินการได้ดัง Spec./แบบก่อสร้างที่แนบมานี้ กรุณาแจ้งเจ้าหน้าที่ กปน. ที่ระบุไว้ข้างต้น เพื่อให้ปรับปรุงแก้ไข Spec. ต่อไป</td>';
    $html .= '</tr>';
$html .= '</table>'; 

   
   
//echo $html;
  
$pdf->AddPage();
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$pdf->Output($_SERVER['DOCUMENT_ROOT'].'/honeycomb/report/temp/'.$filename,'F');

ob_end_clean() ;

exit;
?>