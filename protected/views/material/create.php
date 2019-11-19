<?php
$this->breadcrumbs=array(
	'Materials'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Material','url'=>array('index')),
	array('label'=>'Manage Material','url'=>array('admin')),
);
?>

<h1>Create Material</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>