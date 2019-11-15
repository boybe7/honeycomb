<?php
$this->breadcrumbs=array(
	'Labor Costs'=>array('index')
);


?>

<style type="text/css">
	 /* grid border */
    .grid-view table.items th, .grid-view table.items td {
        border: 1px solid gray !important;
    } 

    /* disable selected for merged cells */     
    .grid-view td.merge {
       background: none repeat scroll 0 0 #F8F8F8; 
    }     
    
    /* disable selected for extrarow in bootstrap */     
    table.table td.extrarow, table.table td.extrarow:hover {
       background: none repeat scroll 0 0 #E0E0E0; 
    } 
</style>


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

$this->widget('ext.groupgridview.BootGroupGridView', array(
      'id' => 'labor-cost-grid',
      'itemsCssClass'=>'table table-bordered table-condensed',
      'dataProvider' => $model->search(),
      //'filter'=>$model,
      'extraRowColumns' => array('category'),
      'extraRowExpression' => array($model,"getCategoryFormat"),
      'enablePagination' => true,
	  'summaryText'=>'แสดงผล {start} ถึง {end} จากทั้งหมด {count} ข้อมูล',
	  'template'=>"{items}<div class='row-fluid'><div class='span6'>{pager}</div><div class='span6'>{summary}</div></div>",
      'columns' => array(
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
				'htmlOptions'=>array('style'=>'text-align:center;padding-left:10px;')
		),
		'cost'=>array(
				'name' => 'cost',
				'filter'=>false,
				'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:right;padding-right:10px;')
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
