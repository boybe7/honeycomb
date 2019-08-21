<?php
$this->breadcrumbs=array(
	'Labor Costs',
);

?>

<h1>Labor Costs</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
