<?php
$this->breadcrumbs=array(
	'Vendor Prices'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List VendorPrice','url'=>array('index')),
	array('label'=>'Create VendorPrice','url'=>array('create')),
	array('label'=>'View VendorPrice','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage VendorPrice','url'=>array('admin')),
);
?>

<h1>Update VendorPrice <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>