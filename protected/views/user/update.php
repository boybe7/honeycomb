<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Update',
);

?>

<center><h3>แก้ไขผู้ใช้งานระบบ</h3></center>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>