<script type="text/javascript">
function checkFile(electObject){

  
  if((/\.(doc|docx|xls|xlsx|pdf)$/i).test(electObject.value) ) {
      
   }else {
  	 alert("Invalid file!!!!!");  
   } 
}
</script>




<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'spec-doc-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	

	<div class="row" id="fileUpload">
		<div class="span8">
		<?php echo $form->labelEx($model,'filename<span style="color:red">&nbsp;*</span>'); ?>

		<?php echo $form->fileField($model,'filename',array('style'=>'width:200px;','onChange'=>'checkFile(this)','title'=>'Only document allowed'));?>

		<span id="filecheck" class="help-block error"></span>

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
