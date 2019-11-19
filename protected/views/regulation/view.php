<?php
$this->breadcrumbs=array(
	'Regulations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Regulation','url'=>array('index')),
	array('label'=>'Create Regulation','url'=>array('create')),
	array('label'=>'Update Regulation','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Regulation','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Regulation','url'=>array('admin')),
);
?>

<h1>View Regulation #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'book_no',
		'detail',
		'date_added',
		'category',
		'filename',
		'keyword',
		'count_click',
	),
)); ?>
