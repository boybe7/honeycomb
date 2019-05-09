<?php
$this->breadcrumbs=array(
	'รายงาน',
	 //----ไม่ต้องแก้-----
);


?>

<style>

.reportTable thead th {
	text-align: center;
	font-weight: bold;
	background-color: #eeeeee;
	vertical-align: middle;
	}

.reportTable td {
	
}

</style>
<!-- <script type="text/javascript" src="/pea_track/themes/bootstrap/js/pdfobject.js"></script> -->
<!-- <script type="text/javascript" src="/pea_track/themes/bootstrap/js/pdf.js"></script> -->
<!-- <script type="text/javascript" src="/pea_track/themes/bootstrap/js/compatibility.js"></script> -->


<h4>รายงานสรุปใบรับรองคุณภาพและรายละเอียดท่อ/อุปกรณ์(Excel)</h4>

<div class="well">
  <div class="row-fluid">
	
	<div class="span2">
		<?php

		   
    
            echo CHtml::label('ประเภท','workcat');  
            echo CHtml::dropDownList('workcat', '', 
                            array(0=>"ผู้ผลิต",1=>"ผู้จัดส่ง"),array('empty' => 'ทั้งหมด','class'=>'span12'
                            	,
                              	'ajax' => array(
  							                'type' => 'POST', //request type
  							                'url' => CController::createUrl('ajax/getVendor'), //url to call.                
  							                'update' => '#vendor', //selector to update   
  							                'data' => array('workcat_id' => 'js:this.value'),
  							                 )	
                            	));
             	
		?>

	</div>
	<div class="span3">
		<?php
             
            $vendors = Vendor::model()->findAll();
            $list = CHtml::listData($vendors,'id','name');
    
            echo CHtml::label('ผู้ผลิต/ผู้จัดส่ง','vendor');  
            echo CHtml::dropDownList('vendor', '', 
                            $list,array('empty' => 'ทั้งหมด','class'=>'span12'
                              ));
              
             	
		?>

	</div>
  <div class="span1">
               
              <?php
                echo CHtml::label('ณ เดือน','monthEnd');  
                $list = array("1" => "ม.ค.", "2" => "ก.พ.", "3" => "มี.ค.","4" => "เม.ย.", "5" => "พ.ค.", "6" => "มิ.ย.","7" => "ก.ค.", "8" => "ส.ค.", "9" => "ก.ย.","10" => "ต.ค.", "11" => "พ.ย.", "12" => "ธ.ค.");
                $mm = date("n");
                echo CHtml::dropDownList('monthEnd', '', 
                        $list,array('class'=>'span12',"options"=>array($mm=>array("selected"=>true))
                    ));
               

              ?>
    </div>
    <div class="span1">
            <?php
                
                echo CHtml::label('ปี','yearEnd');  
                $yy = date("Y")+543;
                $list = array($yy-2=>$yy-2,$yy-1=>$yy-1,$yy=>$yy,$yy+1=>$yy+1,$yy+2=>$yy+2);
                echo CHtml::dropDownList('yearEnd', '', 
                        $list,array('class'=>'span12',"options"=>array($yy=>array("selected"=>true))
                  
                    ));

              ?>
    </div>
	<div class="span3">
      <?php
        $this->widget('bootstrap.widgets.TbButton', array(
              'buttonType'=>'link',
              
              'type'=>'inverse',
              'label'=>'view',
              'icon'=>'list-alt white',
              
              'htmlOptions'=>array(
                'class'=>'span4',
                'style'=>'margin:25px 10px 0px 0px;',
                'id'=>'gentReport'
              ),
          ));
      ?>
    <!-- </div> -->
    <!-- <div class="span1"> -->

      <?php
      /*
        $this->widget('bootstrap.widgets.TbButton', array(
              'buttonType'=>'link',
              
              'type'=>'success',
              'label'=>'Excel',
              'icon'=>'excel',
              
              'htmlOptions'=>array(
                'class'=>'span4',
                'style'=>'margin:25px 10px 0px 0px;padding-left:0px;padding-right:0px',
                'id'=>'exportExcel'
              ),
          ));

    $this->widget('bootstrap.widgets.TbButton', array(
              'buttonType'=>'link',
              
              'type'=>'info',
              'label'=>'',
              'icon'=>'print white',
              
              'htmlOptions'=>array(
                'class'=>'span3',
                'style'=>'margin:25px 0px 0px 0px;',
                'id'=>'printReport'
              ),
          ));
        */
      ?>


    </div>
  </div>


    
</div>


<div id="printcontent" style=""></div>


<?php
//Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScript('gentReport', '
$("#gentReport").click(function(e){
    e.preventDefault();

       
        $.ajax({
            url: "genVendor",
            cache:false,
            data: {vendor: $("#vendor").val(),monthEnd:$("#monthEnd").val(),yearEnd:$("#yearEnd").val(),workcat:$("#workcat").val()
              },
            success:function(response){
               
               $("#printcontent").html(response);                 
            }

        });
    
});
', CClientScript::POS_END);

Yii::app()->clientScript->registerScript('printReport', '
$("#printReport").click(function(e){
    e.preventDefault();

    $.ajax({
        url: "printVendor",
        data: {fiscalyear:$("#fiscalyear").val(),project: $("#project").val(),monthEnd:$("#monthEnd").val(),yearEnd:$("#yearEnd").val(),workcat:$("#workcat").val()
              },
        success:function(response){
            window.open("../tempReport.pdf", "_blank", "fullscreen=yes");              
            
        }

    });

});
', CClientScript::POS_END);

Yii::app()->clientScript->registerScript('exportExcel', '
$("#exportExcel").click(function(e){
    e.preventDefault();
    window.location.href = "genVendorExcel?fiscalyear="+$("#fiscalyear").val()+"&project="+$("#project").val()+"&monthEnd="+$("#monthEnd").val()+"&yearEnd="+$("#yearEnd").val()+"&workcat="+$("#workcat").val();
              


});
', CClientScript::POS_END);


?>