<?php
$this->breadcrumbs=array(
	'Materials',
);

$this->menu=array(
	array('label'=>'Create Material','url'=>array('create')),
	array('label'=>'Manage Material','url'=>array('admin')),
);
?>

<h1>Materials</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
