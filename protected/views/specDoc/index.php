<?php
$this->breadcrumbs=array(
	'Spec Docs',
);

$this->menu=array(
	array('label'=>'Create SpecDoc','url'=>array('create')),
	array('label'=>'Manage SpecDoc','url'=>array('admin')),
);
?>

<h1>Spec Docs</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
