<?php
$this->breadcrumbs=array(
	'Other Costs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OtherCost','url'=>array('index')),
	array('label'=>'Manage OtherCost','url'=>array('admin')),
);
?>

<h1>Create OtherCost</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>