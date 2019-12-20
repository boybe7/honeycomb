<?php
$this->breadcrumbs=array(
	'Spec Docs'=>array('index'),
	'Create',
);


?>

<h4>ข้อมูลรายละเอียดประกอบแบบทั่วไป</h4>

<?php echo $this->renderPartial('_form', array('model'=>$model,'compares'=>$compares)); ?>