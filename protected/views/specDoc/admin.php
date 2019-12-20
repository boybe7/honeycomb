<div class="navbar">
	<div class="navbar-inner2 navbar-header">
		<div class="container" style="padding-top:5px">
			<p class="brand2 pull-left">รายละเอียดแบบประกอบงานก่อสร้าง</p>
		
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



<div style="padding-top: 10px;">
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
							'htmlOptions'=>array('style'=>'padding-top:10px'),
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
									    'name' => 'detail',
									    'filter'=>CHtml::activeTextField($model, 'detail',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("detail"))),
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
									    'name' => 'detail',
									    'filter'=>CHtml::activeTextField($model, 'detail',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("detail"))),
										'headerHtmlOptions' => array('style' => 'width:50%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
								'export'=>array(
									    'name' => 'filename',
									    'header' => 'Export',
									    'type'=> 'raw',
									    'value'=>'CHtml::link($data->filename, "export/".$data->id)',
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



  