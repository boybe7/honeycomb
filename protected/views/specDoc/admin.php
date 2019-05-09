<?php
$this->breadcrumbs=array(
	'Spec Docs'=>array('index'),
	'Manage',
);


?>

<h4>Manage Spec Docs</h4>



<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'spec-doc-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'filename',
		'detail_approve',
		'work_category_id',
		'contract_id',
		/*
		'created_by',
		'create_date',
		'update_date',
		'status',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
