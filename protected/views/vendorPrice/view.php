<?php
$this->breadcrumbs=array(
	'Vendor Prices'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List VendorPrice','url'=>array('index')),
	array('label'=>'Create VendorPrice','url'=>array('create')),
	array('label'=>'Update VendorPrice','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete VendorPrice','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage VendorPrice','url'=>array('admin')),
);
?>

<h1>View VendorPrice #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'moc_id',
		'category_id',
		'subcategory_id',
		'brand',
		'price',
		'attach_file',
		'date_record',
	),
)); ?>
