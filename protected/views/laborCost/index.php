<?php
$this->breadcrumbs=array(
	'Labor Costs',
);

?>

<h1>Labor Costs</h1>

<?php 

$this->widget('bootstrap.widgets.TbGridView',array(
    	'id'=>'management-cost-grid',
    	'type'=>'bordered condensed',
    	'dataProvider'=>$model->search(),
    	//'filter'=>$model,
    	//'selectableRows' =>2,
    	'htmlOptions'=>array('style'=>'padding-top:40px;width:100%'),
        'enablePagination' => true,
        'enableSorting'=>true,
        'summaryText'=>'xสดงผล {start} ถึง {end} จากทั้งหมด {count} ข้อมูล',
        'template'=>"{items}<div class='row-fluid'><div class='span6'>{pager}</div><div class='span6'>{summary}</div></div>",
    	'columns'=>array(
    		'checkbox'=> array(
            	    'id'=>'selectedID',
                	'class'=>'CCheckBoxColumn',
                	//'selectableRows' => 2, 
            		 'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),
    	  	         'htmlOptions'=>array(
    	  	            	  			'style'=>'text-align:center'

    	  	            	  		)   	  		
            ),
    	
    		'detail'=>array(
    			    'name' => 'detail',
    			    'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #f5f5f5'),  	            	  	
    				'htmlOptions'=>array('style'=>'text-align:left')
    	  	),
       
   
    	),
    ));


?>
