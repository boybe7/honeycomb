

<?php
$this->breadcrumbs=array(
	''=>array(''),

);


?>

<h4 class="pull-right">รายละเอียดแบบประกอบทั่วไป</h4>


<div style="padding-top: 30px;">
  <ul class="nav nav-tabs">
  	<?php
  		$workcats = WorkCategory::model()->findAll();
  		$i = 0;
  		foreach ($workcats as $key => $value) {
  			if($i==0)
  				echo  '<li class="active"><a data-toggle="tab" href="#workcat'.$value->id.'">'.$value->name.'</a></li>';
  			else
  				echo  '<li ><a data-toggle="tab" href="#workcat'.$value->id.'">'.$value->name.'</a></li>';
  			$i++;
  		}
  	?>
   
  </ul>

  <div class="tab-content">
  	<?php
  		
  		$i = 0;
  		foreach ($workcats as $key => $value) {
  			if($i==0)
  			{

  				echo  '<div id="workcat'.$value->id.'" class="tab-pane fade in active">';
  						$this->widget('bootstrap.widgets.TbGridView',array(
							'id'=>'detail-grid-'.$value->id,
							'dataProvider'=>$model->searchByID($value->id),
							'type'=>'bordered condensed',
							'filter'=>$model,
							'selectableRows' =>2,
							'htmlOptions'=>array('style'=>'padding-top:40px'),
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
								'name'=>array(
									    'name' => 'name',
									    'filter'=>CHtml::activeTextField($model, 'name',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("name"))),
										'headerHtmlOptions' => array('style' => 'width:50%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
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
								'detail_approve'=>array(
									    'name' => 'detail_approve',
									    
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
							  	'created_by'=>array(
									    'name' => 'created_by',
									    
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
								array(
									'class'=>'bootstrap.widgets.TbButtonColumn',
									'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),
									'template' => '{update} {delete}'
								),
							),
						));
  				echo '</div>';
  			}
  			else
  			{

  				echo  '<div id="workcat'.$value->id.'" class="tab-pane fade ">';
  					$this->widget('bootstrap.widgets.TbGridView',array(
							'id'=>'detail-grid-'.$value->id,
							'dataProvider'=>$model->searchByID($value->id),
							'type'=>'bordered condensed',
							'filter'=>$model,
							'selectableRows' =>2,
							'htmlOptions'=>array('style'=>'padding-top:40px'),
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
								'name'=>array(
									    'name' => 'name',
									    'filter'=>CHtml::activeTextField($model, 'name',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("name"))),
										'headerHtmlOptions' => array('style' => 'width:50%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
								'export'=>array(
									    'name' => 'filename',
									    'header' => 'Export',
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
								'detail_approve'=>array(
									    'name' => 'detail_approve',
									    
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
							  	'created_by'=>array(
									    'name' => 'created_by',
									    
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
								array(
									'class'=>'bootstrap.widgets.TbButtonColumn',
									'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),
									'template' => '{update} {delete}'
								),
							),
						));
  				echo '</div>';
  			}
  			$i++;
  		}
  	?>
    
     
  </div>


</div>	



  