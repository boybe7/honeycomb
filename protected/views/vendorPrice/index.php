<?php
$this->breadcrumbs=array(
	'Vendor Prices',
);

$this->menu=array(
	array('label'=>'Create VendorPrice','url'=>array('create')),
	array('label'=>'Manage VendorPrice','url'=>array('admin')),
);
?>

<h1>Vendor Prices</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
