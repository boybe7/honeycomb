<?php
	Yii::app()->clientScript->registerScript('search', "



		$('.search-button').click(function(){
			$('.search-form').toggle();
			return false;
		});
		$('.search-form form').submit(function(){

	
			var active = $('.tab-pane.active').attr('id');
			id = active.replace('workcat','')
		
		    $.fn.yiiGridView.update('detail-grid-'+id, {
		        data: {search: $('#search_key').val(), work_id : id}
		    });

			return false;
		});
		");

		Yii::app()->clientScript->registerScript('search', "


		$('#search-form').submit(function(){

			var active = $('.tab-pane.active').attr('id');
			id = active.replace('workcat','')
			

			for (id = 1; id < 8; id++) {
			    $.fn.yiiGridView.update('detail-grid-'+id, {
			        data: {search: $('#search_key').val(), work_id : id}
			    });
			}    
		 
		    return false;
		});
	");

?>



<div class="navbar">
	<div class="navbar-inner2 navbar-header">
		<div class="container" style="padding-top:5px">
			<p class="brand2 pull-left">รายละเอียดแบบประกอบงานก่อสร้าง</p>
		
			<form class="navbar-form pull-right" id="search-form" action="/honeycomb/specdoc/admin" method="get">

			  <input type="text" name="search_key" id='search_key' class="search-query" placeholder="Search" style="margin-right:10px;">
			
			  <?php


			  		$this->widget('bootstrap.widgets.TbButton', array(
						    'buttonType'=>'submit',
						    
						    'type'=>'info',
						    'label'=>'',
						    'icon'=>'search',
						 
						    'htmlOptions'=>array('class'=>'','style'=>'margin-right:10px;',

						    

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



<div style="padding-top: 10px;">
 

  	<?php

  						$model = new Material('search');
  						
  	
  						$this->widget('ext.groupgridview.BootGroupGridView',array(
							'id'=>'search-grid',
							'dataProvider'=>$model->search(),
							//'type'=>'bordered condensed',
							'mergeColumns' => array('name'), 
							//'selectableRows' =>2,
							'htmlOptions'=>array('style'=>'padding-top:10px'),
						    'enablePagination' => true,
						    'summaryText'=>'แสดงผล {start} ถึง {end} จากทั้งหมด {count} ข้อมูล',
						    'template'=>"{items}<div class='row-fluid'><div class='span6'>{pager}</div><div class='span6'>{summary}</div></div>",
							'columns'=>array(
								'no'=>array(
									    'name' => 'no',
									    'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:center;padding-left:10px;')
							  	),
							  	'name'=>array(
									    'name' => 'name',
									    'filter'=>CHtml::activeTextField($model, 'name',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("name"))),
										'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
							
							  	'detail'=>array(
									    'name' => 'detail',
									    'filter'=>CHtml::activeTextField($model, 'detail',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("detail"))),
										'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:center;padding-left:10px;')
							  	),
								'price'=>array(
									    'name' => 'price',
									    'header' => '<a class="sort-link">ราคากลางวัสดุ</a>',
									    'type'=>'raw', 
									    'value' => function($model){
							                  return $model->getPrice($model);
							                },
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:center;padding-left:10px;')
							  	),
							 
								'export'=>array(
									    'name' => 'filename',
									    'header' => 'Export',
									    'type'=> 'raw',
									    'value'=>'CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/images/download.png"), "export/".$data->id)',
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),  	            	  	
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
    

</div>	

<?php
/*
$widget=$this->createWidget('ext.EDataTables.EDataTables', array(
 'id'            => 'products',
 'dataProvider'  => $model->searchByID(1),
 'ajaxUrl'       => $this->createUrl('/products/index'),
 'columns'       => array(
								'no'=>array(
									    'name' => 'no',
									    'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:center;padding-left:10px;')
							  	),
							  	'material'=>array(
									    'name' => 'material',
									    'filter'=>CHtml::activeTextField($model, 'material',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("material"))),
										'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
								'name'=>array(
									    'name' => 'detail',
									    'filter'=>CHtml::activeTextField($model, 'detail',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("detail"))),
										'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
							  	'dimension'=>array(
									    'name' => 'dimension',
									    'filter'=>CHtml::activeTextField($model, 'dimension',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("dimension"))),
										'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:center;padding-left:10px;')
							  	),
							  	'unit'=>array(
									    'name' => 'unit',
									    'filter'=>CHtml::activeTextField($model, 'unit',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("unit"))),
										'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:center;padding-left:10px;')
							  	),
							  )
));

$widget->run();
*/
?>