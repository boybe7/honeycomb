<?php
$this->breadcrumbs=array(
	'Vendor Prices'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List VendorPrice','url'=>array('index')),
	array('label'=>'Manage VendorPrice','url'=>array('admin')),
);
?>

<h1>Create VendorPrice</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>