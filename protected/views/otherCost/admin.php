<?php

?>
<div class="navbar">
	<div class="navbar-inner2 navbar-header">
		<div class="container" style="padding-top:5px">
			<p class="brand2 pull-left">ค่าใช้จ่ายอื่น ๆ</p>
		
			<form class="navbar-form pull-right" id="search-form" action="" method="get">

			  <!-- <input type="text" name="search_key" id='search_key' class="search-query" placeholder="Search" style="margin-right:10px;"> -->
			
			  <?php

                  
		
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

<?php

 		$types = OtherCostType::model()->findAll();
  		$i = 0;
  		echo '<ul class="nav nav-tabs" >';
  		foreach ($types as $key => $value) {
  			if($i==0)
  				echo  '<li  class="active"><a  data-toggle="tab" href="#types'.$value->id.'">'.$value->name.'</a></li>';
  			else
  				echo  '<li  ><a data-toggle="tab" href="#types'.$value->id.'">'.$value->name.'</a></li>';
  			$i++;
  		}
  		echo '</ul>';



 

?>


<div class="tab-content">
  	<?php
  		
  		$i = 0;
  		foreach ($types as $key => $value) {
  			if($i==0)
  				echo  '<div id="types'.$value->id.'" class="tab-pane fade in active">';
  			else
  				echo  '<div id="types'.$value->id.'" class="tab-pane fade in ">';

  				$this->widget('bootstrap.widgets.TbGridView',array(
					'id'=>'other-cost-grid',
					'dataProvider'=>$model->searchByType($i+1),
					'filter'=>$model,
					'type'=>'bordered condensed',
					'selectableRows' =>2,
					'htmlOptions'=>array('style'=>'padding-top:10px'),
					'enablePagination' => true,
					'summaryText'=>'แสดงผล {start} ถึง {end} จากทั้งหมด {count} ข้อมูล',
					'template'=>"{items}<div class='row-fluid'><div class='span6'>{pager}</div><div class='span6'>{summary}</div></div>",
					'columns'=>array(
						'id',
						'contract_no',
						'filename',
						
						array(
							'class'=>'bootstrap.widgets.TbButtonColumn',
						),
					),
				)); 

  			echo '</div>';
  			
  			
  			$i++;
  		}	
  	?>
</div>  	