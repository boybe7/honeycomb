<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'quotation-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data','class'=>''),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'amount',array('class'=>'span2','maxlength'=>25)); ?>
	<?php echo $form->textFieldRow($model,'unit',array('class'=>'span3','maxlength'=>100)); ?>
	


<?php $this->endWidget(); ?>