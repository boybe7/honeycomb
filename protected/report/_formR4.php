
<style type="text/css">
.table-fixed thead {
  width: 100%;

}

.table-fixed tbody {
  height: 600px;
  overflow-y: auto;
  width: 100%;
}
.table-fixed thead, .table-fixed tbody, .table-fixed tr, .table-fixed td, .table-fixed th {
  display: block;
}
.table-fixed tbody td {
  float: left;
  border-bottom-width: 0;
  border-style: solid;
  border-width: thin;
  border-color: #e3e3e3;
  }



.table-fixed thead > tr> th {
  float: left;
  text-align: center;
  
  background-color: #f5f5f5;

}


</style>

<?php
$thai_mm=array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

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

$date_s = new DateTime($date_start);
$date_st =(int)($date_s->format('d'))."&nbsp;".$thai_mm[(int)$date_s->format('m')-1]."&nbsp;".($date_s->format('y'));
$date_e = new DateTime($date_end);
$date_en =(int)($date_e->format('d'))."&nbsp;".$thai_mm[(int)$date_e->format('m')-1]."&nbsp;".($date_e->format('y'));
echo"เงื่อนไขรายงาน&nbsp;:&nbsp;วันดำเนินการจาก&nbsp;".$date_st."&nbsp;ถึง&nbsp;".$date_en."<br><br>";


//$models=CerDoc::model()->findAll(array("condition"=>"cer_date BETWEEN '$date_start' AND '$date_end'  "));
$models = Yii::app()->db->createCommand()
					->select('sum(ct.quantity) as sum, detail,prod_code,ct.prod_size as size,prod_unit')
					->from('c_cer_doc cd')	
					->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
          ->join('m_product p', 'p.prod_name=ct.detail')
					->where('cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"')		
          ->group('detail')			                   
					->queryAll();
//print_r($m);					

?>

  <table class="table">
    <thead>
      <tr>
        <th style="text-align:center">รหัสท่อ/อุปกรณ์</th>
        <th style="text-align:center">รายละเอียดท่อ/อุปกรณ์</th>
        <th style="text-align:center">ขนาด &#8709 มม.</th>
        <th style="text-align:center">จำนวน</th>
        <th style="text-align:center">หน่วย</th>
      </tr>
    </thead>
    <tbody>
          <?php
                 
                  foreach ($models as $key => $model) {
                      echo "<tr>";
                        echo '<td style="">'.$model["prod_code"].'</td><td style="">'.$model["detail"].'</td><td style="text-align:center;">'.$model["size"].'</td><td style="text-align:center;">'.$model["sum"].'</td><td style="text-align:center;">'.$model["prod_unit"].'</td>';
                      echo "</tr>";
                  }
                

            ?> 
            
     
    </tbody>
  </table>
<?php
echo"รายงานสรุปยอดรับรองท่อ/อุปกรณ์จำนวน&nbsp;".count($models)."&nbsp;รายการ";
$t= date('H:i:s', time()); // 10:00:00

$m_d = date("d");
$m_m = date("m")-1;
$m_y = date("Y")+543;

$date_mm =$m_d."&nbsp;".$thai_mm[(int)$m_m]."&nbsp;".$m_y;

echo"<br>ออกเมื่อ&nbsp;:&nbsp;".$date_mm."&nbsp;เวลา&nbsp;".$t."&nbsp;น.";
?>
