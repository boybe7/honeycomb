<?php
$this->breadcrumbs=array(
	'Spec Docs'=>array('index'),
	'Update',
);


?>

<h4>แก้ไขข้อมูลรายละเอียดประกอบแบบทั่วไป</h4>

<?php echo $this->renderPartial('_form',array('model'=>$model,'compares'=>$compares)); ?>