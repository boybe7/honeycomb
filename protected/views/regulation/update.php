<?php
$this->breadcrumbs=array(
	'Regulations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Regulation','url'=>array('index')),
	array('label'=>'Create Regulation','url'=>array('create')),
	array('label'=>'View Regulation','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Regulation','url'=>array('admin')),
);
?>

<h1>Update Regulation <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>