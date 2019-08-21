<?php
$this->breadcrumbs=array(
	'Labor Costs'=>array('index')
);


?>




<div class="row-fluid">
  <div class="span9">	
	<h4 class="pull-right span12">จัดการ : ราคาค่าแรงงานและค่าดำเนินการ</h4>
  </div>
  <div class="span3">
	<?php

	$this->widget('bootstrap.widgets.TbButton', array(
						    'buttonType'=>'link',
						    
						    'type'=>'success',
						    'label'=>'เพิ่มข้อมูล',
						    'icon'=>'plus-sign',
						    'url'=>array('create'),
						    'htmlOptions'=>array('class'=>'pull-right','style'=>'margin-bottom:10px'),
						)); 
	?>
  </div>	
</div>	



<?php 


$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'labor-cost-grid',
	'dataProvider'=>$model->search(),
	'type'=>'bordered condensed',
	'selectableRows' =>2,
	'filter'=>$model,
	'enablePagination' => true,
	'summaryText'=>'แสดงผล {start} ถึง {end} จากทั้งหมด {count} ข้อมูล',
	'template'=>"{items}<div class='row-fluid'><div class='span6'>{pager}</div><div class='span6'>{summary}</div></div>",
	'columns'=>array(
		'no'=>array(
				'name' => 'no',
				'filter'=>false,
				'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
		),
		'category'=>array(
				'name' => 'category',
				'value' => array($model,'getCategory'),
			    'filter'=>CHtml::activeDropDownList($model, 'category', array('0' => 'บัญชีค่าแรง (กรมบัญชีกลาง)', '1' => 'ค่าแรงสืบค้น','2'=>'ค่าแรงกำหนดเอง'),array('empty'=>'')),
				'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
		),
		'detail'=>array(
				'name' => 'detail',
				'filter'=>CHtml::activeTextField($model, 'detail',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("detail"))),
				'headerHtmlOptions' => array('style' => 'width:36%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
		),
		'unit'=>array(
				'name' => 'unit',
				'filter'=>false,
				'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
		),
		'cost'=>array(
				'name' => 'cost',
				'filter'=>false,
				'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
		),
		'remark'=>array(
				'name' => 'remark',
				'value' => array($model,'getRemark'),
				'type'=>'raw',
				'filter'=>CHtml::activeTextField($model, 'remark',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("remark"))),
				'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),
									'template' => '{update} {delete}'
		),
	),
)); 


?>
