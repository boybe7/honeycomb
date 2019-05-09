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

//echo "วันเริ่มต้น--".$date_start;
//echo "--วันสิ้นสุด--".$date_end;

//print_r($model);
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
echo"เงื่อนไขรายงาน : วันที่ออกใบรับรองจาก&nbsp;".$date_st."&nbsp;ถึง&nbsp;".$date_en."<br><br>";


//-----------------------
$models_m = Yii::app()->db->createCommand()
					->select('cer_name')
					->from('c_cer_doc')
					->where('cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"')
					->queryAll();
foreach ($models_m as $key => $model_m) {
        echo"<u>";
        echo $model_m["cer_name"]."</u><br>";
        //------------------------------
                              $models = Yii::app()->db->createCommand()
					->select('sum(ct.quantity) as sum, detail,prod_code,ct.prod_size as size,prod_unit')
					->from('c_cer_doc cd')
					->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
                                        ->join('m_product p', 'p.prod_name=ct.detail')
					->where('cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"')
                                        ->group('detail')
					->queryAll();
?>
  <table class="table">
    <thead>
      <tr>
        <th style="text-align:center">เลขที่ใบรับรองคุณภาพ</th>
        <th style="text-align:center">เลขที่สัญญา</th>
        <th style="text-align:center">เลขที่</th>
        <th style="text-align:center">คู่สัญญา</th>
        <th style="text-align:center">ผู้ผลิต/จัดส่ง</th>
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

}
//-----------------------


echo"รายงานสรุปใบรับรองคุณภาพแยกตามผู้ออกใบรับรองจำนวน&nbsp;".count($models)."&nbsp;รายการ";
$t= date('H:i:s', time()); // 10:00:00
$m_d = date("d");
$m_m = date("m")-1;
$m_y = date("Y")+543;

$date_mm =$m_d."&nbsp;".$thai_mm[(int)$m_m]."&nbsp;".$m_y;
echo"<br>ออกเมื่อ&nbsp;:&nbsp;".$date_mm."&nbsp;เวลา&nbsp;".$t."&nbsp;น.";
?>
