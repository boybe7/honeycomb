<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'spec-doc-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	

	<div class="row" id="fileUpload">
		<div class="span8">
		<?php echo $form->labelEx($model,'filename<span style="color:red">&nbsp;*</span>'); ?>

		<?php echo $form->fileField($model,'filename',array('style'=>'width:200px;','onChange'=>'checkFile()','title'=>'Only xls allowed'));?>

		<div id="filecheck" style="color: red;font-size:0.9em;"></div>

		<?php //echo $form->error($model,'uploadFile',array('style'=>$styleDataError.';margin-top:20px;')); ?> 

		<?php echo CHtml::hiddenField('errorVal','0');?>
		</div>
	</div>

	
	<?php 
		$workcat = WorkCategory::model()->findAll();
     
        $typelist = CHtml::listData($workcat,'id','name');
        echo $form->dropDownListRow($model, 'work_category_id', $typelist,array('class'=>'span8'), array('options' => array('work_category_id'=>array('selected'=>true)))); 
	 ?>

	<?php echo $form->textFieldRow($model,'contract_id',array('class'=>'span8')); ?>

	<?php 
	echo $form->textAreaRow($model,'detail_approve',array('rows'=>2, 'cols'=>50, 'class'=>'span8')); 
	 ?>


	

	<div class="row-fluid ">
		<div class="span8">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'htmlOptions'=>array('class'=>'pull-right','style'=>''),
			'type'=>'primary',
			'label'=>'บันทึก',
		)); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>
