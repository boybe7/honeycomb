<div class="navbar">
	<div class="navbar-inner2 navbar-header">
		<div class="container" style="padding-top:5px">
			<p class="brand2 pull-left">Contact List</p>
		
			<form class="navbar-form pull-right" id="search-form" action="/honeycomb/Contact/admin" method="get">

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
					 if(Yii::app()->user->isAdmin())
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
  <ul class="nav nav-tabs" >
  	<?php
  		$workcats = WorkCategory::model()->findAll();
  		$i = 0;
  		foreach ($workcats as $key => $value) {
  			if($i==0)
  				echo  '<li  class="active"><a  data-toggle="tab" href="#workcat'.$value->id.'">'.$value->name.'</a></li>';
  			else
  				echo  '<li  ><a data-toggle="tab" href="#workcat'.$value->id.'">'.$value->name.'</a></li>';
  			$i++;
  		}
  	?>
   
  </ul>

  <div class="tab-content">
  	<?php
  		
  		$i = 0;
  		foreach ($workcats as $key => $value) {
  			if($i==0)
  				echo  '<div id="workcat'.$value->id.'" class="tab-pane fade in active">';
  			else
  				echo  '<div id="workcat'.$value->id.'" class="tab-pane fade in ">';
  					
  						$this->widget('bootstrap.widgets.TbGridView',array(
							'id'=>'detail-grid-'.$value->id,
							'dataProvider'=>$model->searchByID($value->id),
							'type'=>'bordered condensed',
							//'filter'=>$model,
							'selectableRows' =>2,
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
									    'filter'=>CHtml::activeTextField($model, 'detail',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("detail"))),
										'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
							  	'detail'=>array(
									    'name' => 'detail',
									    'filter'=>CHtml::activeTextField($model, 'detail',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("detail"))),
										'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
							  	'telephone'=>array(
									    'name' => 'telephone',
									    'filter'=>CHtml::activeTextField($model, 'telephone',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("telephone"))),
										'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
							  	'website'=>array(
									    'name' => 'website',
									    'filter'=>CHtml::activeTextField($model, 'website',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("website"))),
										'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
							  
								array(
									'class'=>'bootstrap.widgets.TbButtonColumn',
									'visible'=>Yii::app()->user->isAdmin() ? true : false,
									'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),
									'template' => '{update} {delete}'
								),
							),

						));
  			echo '</div>';
  			
  			
  			$i++;
  		}
  	?>
    
     
  </div>


</div>	
