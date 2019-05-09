<?php
$this->breadcrumbs=array(
	'Spec Docs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SpecDoc','url'=>array('index')),
	array('label'=>'Manage SpecDoc','url'=>array('admin')),
);
?>

<h1>Create SpecDoc</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>