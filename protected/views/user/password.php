<?php
$this->breadcrumbs=array(
	//'User'=>array('index'),
  'Change Password'
);

?>

<center><h3>เปลี่ยนรหัสผ่าน</h3></center>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'changePassword-form',
    'inlineErrors'=>true,
    'enableClientValidation'=>true,
    'clientOptions'=>array(
      'validateOnSubmit'=>true,
    ),
    'htmlOptions'=>  array('class'=>'well','style'=>'margin:0 auto;width:270px'),
)); ?>


<?php echo $form->passwordFieldRow($model, 'currentPassword', array('class'=>'span3','placeholder'=>'')); ?>
<?php echo $form->passwordFieldRow($model, 'newPassword', array('class'=>'span3','placeholder'=>'')); ?>
<?php echo $form->passwordFieldRow($model, 'newPassword_repeat', array('class'=>'span3','placeholder'=>'')); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'htmlOptions'=>array('style'=>'margin-left:200px'),'label'=>'ตกลง', 'type'=>'primary')); ?>
<?php $this->endWidget(); ?>

<?php 
  $this->widget('bootstrap.widgets.TbAlert', array(
      'block'=>true, // display a larger alert block?
      'fade'=>true, // use transitions?
      'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
      'alerts'=>array( // configurations per alert type
        'success'=>array(
          'block'=>true,
          'fade'=>true,
          'closeText'=>'&times;',
        ), // success, info, warning, error or danger
      ),
    )
  );
?>
