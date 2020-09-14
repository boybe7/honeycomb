	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'contact-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data','class'=>'well'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-fluid ">
		<div class="span12">
			<?php echo $form->textFieldRow($model,'name',array('class'=>'span12','maxlength'=>500)); ?>

			<?php echo $form->textFieldRow($model,'detail',array('class'=>'span12','maxlength'=>500)); ?>

			<?php echo $form->textFieldRow($model,'telephone',array('class'=>'span12','maxlength'=>20)); ?>

			<?php echo $form->textFieldRow($model,'website',array('class'=>'span12','maxlength'=>255)); ?>

			<?php 
				$workcat = WorkCategory::model()->findAll();
		     
		        $typelist = CHtml::listData($workcat,'id','name');
		        echo $form->dropDownListRow($model, 'category', $typelist,array('class'=>'span12'), array('options' => array('work_category_id'=>array('selected'=>true)))); 
			 ?>

		</div>	 
		
	</div>	


<?php $this->endWidget(); ?>
