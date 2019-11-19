<?php
$this->breadcrumbs=array(
	'Regulations',
);


?>


<div class="row-fluid">
  <div class="span9">	
	<h4 class="pull-right span12">กฎ ระเบียบ พรบ. เกี่ยวกับงานก่อสร้างของภาครัฐ</h4>
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
	'id'=>'regulation-grid',
	'dataProvider'=>$model->search(),
	'type'=>'bordered condensed',
	'selectableRows' =>2,
	'filter'=>$model,
	'enablePagination' => true,
	'summaryText'=>'แสดงผล {start} ถึง {end} จากทั้งหมด {count} ข้อมูล',
	'template'=>"{items}<div class='row-fluid'><div class='span6'>{pager}</div><div class='span6'>{summary}</div></div>",
	'columns'=>array(
		/*'no'=>array(
				'name' => 'no',
				'filter'=>false,
				'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
		),*/
		'book_no'=>array(
				'name' => 'book_no',
			    'filter'=>CHtml::activeTextField($model, 'book_no',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("book_no"))),
				'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
		),
		'detail'=>array(
				'name' => 'detail',
				'filter'=>CHtml::activeTextField($model, 'detail',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("detail"))),
				'headerHtmlOptions' => array('style' => 'width:30%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
		),
		'date_added'=>array(
				'name' => 'date_added',
				'filter'=>false,
				'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
		),
		'category'=>array(
				'name' => 'category',
				'filter'=>false,
				'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
		),
		'filename'=>array(
				'name' => 'filename',
				'filter'=>false,
				'type'=> 'raw',
				'value'=>'CHtml::link("file", "export/".$data->id)',
				'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
		),
		'keyword'=>array(
				'name' => 'keyword',
				'filter'=>CHtml::activeTextField($model, 'keyword',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("keyword"))),
				'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            		  	
				'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
		),
		'count_click'=>array(
				'name' => 'count_click',
				'filter'=>false,
				'headerHtmlOptions' => array('style' => 'width:8%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center;')
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),
									'template' => '{update} {delete}'
		),
		
	),
)); 

?>
