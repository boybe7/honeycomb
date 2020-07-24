<?php
$this->breadcrumbs=array(
	'Other Costs',
);

$this->menu=array(
	array('label'=>'Create OtherCost','url'=>array('create')),
	array('label'=>'Manage OtherCost','url'=>array('admin')),
);
?>

<h1>Other Costs</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
