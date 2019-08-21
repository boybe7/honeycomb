<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'labor-cost-form',
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    
	<?php 
	 echo $form->labelEx($model,'category'); 
	echo $form->dropDownList($model,'category',array('1' => 'ค่าแรงสืบค้น','2'=>'ค่าแรงกำหนดเอง'),array('class'=>'span5','maxlength'=>2)); ?>

	<?php echo $form->textFieldRow($model,'detail',array('class'=>'span8','maxlength'=>500)); ?>

	<div class="row-fluid ">
		<div class="span3">
			<?php echo $form->textFieldRow($model,'unit',array('class'=>'span12','maxlength'=>100)); ?>
		</div>
		<div class="span5">
			<?php echo $form->textFieldRow($model,'cost',array('class'=>'span12')); ?>
		</div>
	</div>	


	<?php echo $form->textAreaRow($model,'remark',array('rows'=>2, 'cols'=>50, 'class'=>'span8')); ?>

	<div class="row" id="fileUpload">
		<div class="span8">
		<label for="LaborCost_filename">ไฟล์แนบ</label>

		<?php echo $form->fileField($model,'filename',array('style'=>'width:200px;','onChange'=>'checkFile(this)','title'=>'Only document allowed'));?>

		<span id="filecheck" class="help-block error"></span>

		<?php echo CHtml::hiddenField('errorVal','0');?>
		</div>
	</div>

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
