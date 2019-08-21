<?php
$this->breadcrumbs=array(
	'Labor Costs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List LaborCost','url'=>array('index')),
	array('label'=>'Create LaborCost','url'=>array('create')),
	array('label'=>'View LaborCost','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage LaborCost','url'=>array('admin')),
);
?>

<h1>Update LaborCost <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>