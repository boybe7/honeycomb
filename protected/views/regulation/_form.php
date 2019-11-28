
<script type="text/javascript">
function checkFile(electObject){

  
  if((/\.(doc|docx|xls|xlsx|pdf)$/i).test(electObject.value) ) {
      
   }else {
  	 alert("Invalid file!!!!!");  
   } 
}
</script>




<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'regulation-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data','class'=>'well span8'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<?php echo $form->textFieldRow($model,'book_no',array('class'=>'span4','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'detail',array('class'=>'span8','maxlength'=>255)); ?>

	<div class="row-fluid">
		<div class="span5">
			<?php echo $form->textFieldRow($model,'category',array('class'=>'span12','maxlength'=>300)); ?>
	    </div>
		<div class="span6">
			 <?php echo $form->labelEx($model,'date_added',array('class'=>'span12','style'=>'text-align:left;padding-right:10px;'));?>
    					
    			<?php 

      			 
		                echo '<div class="input-append" style="margin-top:-10px;">'; //ใส่ icon ลงไป
		                    $form->widget('zii.widgets.jui.CJuiDatePicker',

		                    array(
		                        'name'=>'date_added',
		                        'attribute'=>'date_added',
		                        'model'=>$model,
		                        'options' => array(
		                                          'mode'=>'focus',
		                                          //'language' => 'th',
		                                          'format'=>'dd/mm/yyyy', //กำหนด date Format
		                                          'showAnim' => 'slideDown',
		                                          ),
		                        'htmlOptions'=>array('class'=>'span12', 'value'=>$model->date_added),  // ใส่ค่าเดิม ในเหตุการ Update 
		                     )
		                );
		                echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

		      	?>
		</div>


	</div>	

	

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
	echo $form->textAreaRow($model,'keyword',array('rows'=>2, 'cols'=>50, 'class'=>'span8')); 
	 ?>


	

	<div class="row-fluid ">
		<div class="span12">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'htmlOptions'=>array('class'=>'pull-right','style'=>''),
			'type'=>'primary',
			'label'=>'บันทึก',
		)); 

			$this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
			'htmlOptions'=>array('class'=>'pull-right','style'=>'margin-right:10px'),
			'type'=>'danger',
			'label'=>'ยกเลิก',
			'url'=>array("index"), 
		)); 

		?>
		</div>
	</div>

<?php $this->endWidget(); ?>

