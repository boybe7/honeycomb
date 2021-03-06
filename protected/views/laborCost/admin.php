<?php
// $this->breadcrumbs=array(
// 	''=>array('index')
// );

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){

	$.fn.yiiGridView.update('labor-cost-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
    console.log('submit')
    $.fn.yiiGridView.update('labor-cost-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
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
    .caret{
    	border-top: 4px solid white;
    }
   
</style>

<div class="navbar">
	<div class="navbar-inner2 navbar-header">
		<div class="container" style="padding-top:5px">
			<p class="brand2 pull-left">ราคาค่าแรงงานและค่าดำเนินการ</p>
		
			<form class="navbar-form pull-right" id="search-form" action="/honeycomb/laborCost/admin" method="get">
			  <input type="hidden" name="LaborCost[subgroup_detail]" id='subgroup_detail'>	
			  <input type="text" name="LaborCost[detail]" id='search_detail' class="search-query" placeholder="Search" style="margin-right:10px;">
			
			  <?php


			  		$this->widget('bootstrap.widgets.TbButton', array(
						    'buttonType'=>'submit',
						    
						    'type'=>'info',
						    'label'=>'',
						    'icon'=>'search',
						    //'url'=>array('searchLaborCost'),
						    'htmlOptions'=>array('class'=>'','style'=>'margin-right:10px;',

						    		'onclick'=>'
		                                     $("#subgroup_detail").val($("#search_detail").val()); 
		                                  '

							),
						)); 

				//if(Yii::app()->user->getAccess(Yii::app()->request->url))
				//{
				   $this->widget('bootstrap.widgets.TbButton', array(
						    'buttonType'=>'link',
						    
						    'type'=>'success',
						    'label'=>'เพิ่มข้อมูล',
						    'icon'=>'plus-sign',
						    'url'=>array('create'),
						    'htmlOptions'=>array('class'=>'pull-right','style'=>'margin-bottom:10px;'),
						)); 
				//}
			?>

			</form>
		</div>	
	</div>	
</div>


<?php 

$this->widget('ext.groupgridview.BootGroupGridView', array(
      'id' => 'labor-cost-grid',
      'itemsCssClass'=>'table table-bordered table-condensed',
      'dataProvider' => $model->search(),
      //'filter'=>$model,
      'extraRowColumns' => array('category','subgroup_detail'),
      'extraRowExpression' => array($model,"getCategoryFormat"),
      //'mergeColumns' => array('group_detail','subgroup_detail'), 
      'enablePagination' => true,
	  'summaryText'=>'แสดงผล {start} ถึง {end} จากทั้งหมด {count} ข้อมูล',
	  'template'=>"{items}<div class='row-fluid'><div class='span6'>{pager}</div><div class='span6'>{summary}</div></div>",
      'columns' => array(
  //     	'group_detail'=>array(
		// 		'name' => 'group_detail',
		// 		'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #f5f5f5'),  	          
		// 		'htmlOptions'=>array('style'=>'text-align:left;padding-center:10px;')
		// ),
		// 'subgroup_detail'=>array(
		// 		'name' => 'subgroup_detail',
		// 		'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	          
		// 		'htmlOptions'=>array('style'=>'text-align:left;padding-center:10px;')
		// ),
        'detail'=>array(
				'name' => 'detail',
				//'filter'=>CHtml::activeTextField($model, 'detail',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("detail"))),
				'headerHtmlOptions' => array('style' => 'width:26%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
		),
		'unit'=>array(
				'name' => 'unit',
				'filter'=>false,
				'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center;padding-left:10px;')
		),
		'cost'=>array(
				'name' => 'cost',
				'filter'=>false,
				'value'=>function ($data) {
					    return number_format($data->cost,2);
					},
				'headerHtmlOptions' => array('style' => 'width:7%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:right;padding-right:10px;')
		),
		'remark'=>array(
				'name' => 'remark',
				'value' => array($model,'getRemark'),
				'type'=>'raw',
				'filter'=>CHtml::activeTextField($model, 'remark',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("remark"))),
				'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),
			'template' => '{update} {delete}',
			'buttons'=>array(
				'update'=> array('visible' =>'Yii::app()->user->isAdmin()' ),
				'delete'=> array('visible' =>'Yii::app()->user->isAdmin()' ),
			)

		),
      
      ),
    ));





?>
