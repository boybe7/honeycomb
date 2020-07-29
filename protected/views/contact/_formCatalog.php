<script type="text/javascript">
function checkFile(electObject){

  
  if((/\.(doc|docx|xls|xlsx|pdf)$/i).test(electObject.value) ) {
      
   }else {
  	 alert("Invalid file!!!!!");  
   } 
}

</script> 
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'catalog-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data','class'=>''),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<?php echo $form->textFieldRow($model,'detail',array('class'=>'span5','maxlength'=>100)); ?>

	<div class="row-fluid ">
		<div class="span5">
			  <label for="attach_file1" >ไฟล์แนบ</label>

			<?php
			if(!empty($model->filename))
			{	
				echo "<input type='hidden' name='attach_file' value='".$model->filename."'>";
				echo CHtml::link('download',array('catalog/download','filename'=>$model->filename), array('target'=>'_blank'));
				echo "<br>";
			}
			echo $form->fileField($model,'filename',array('style'=>'width:200px;','onChange'=>'checkFile(this)','title'=>'Only document allowed'));?>
		
			
		</div>
	</div>	

	

<?php $this->endWidget(); ?>