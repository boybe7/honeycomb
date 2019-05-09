<?php
$this->breadcrumbs=array(
	'Spec Docs'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SpecDoc','url'=>array('index')),
	array('label'=>'Create SpecDoc','url'=>array('create')),
	array('label'=>'View SpecDoc','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage SpecDoc','url'=>array('admin')),
);
?>

<h1>Update SpecDoc <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>