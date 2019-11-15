<?php
$this->breadcrumbs=array(
	'Materials'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Material','url'=>array('index')),
	array('label'=>'Create Material','url'=>array('create')),
	array('label'=>'Update Material','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Material','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Material','url'=>array('admin')),
);
?>

<h1>View Material #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
