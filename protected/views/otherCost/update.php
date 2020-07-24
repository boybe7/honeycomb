<?php
$this->breadcrumbs=array(
	'Other Costs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List OtherCost','url'=>array('index')),
	array('label'=>'Create OtherCost','url'=>array('create')),
	array('label'=>'View OtherCost','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage OtherCost','url'=>array('admin')),
);
?>

<h1>Update OtherCost <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>