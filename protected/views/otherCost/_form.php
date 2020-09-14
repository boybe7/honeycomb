<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'other-cost-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data','class'=>'well'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-fluid">
		<div class="span3">
			<?php 
					$type = OtherCostType::model()->findAll();
				     
				    $typelist = CHtml::listData($type,'id','name');
				    echo $form->dropDownListRow($model, 'type_id', $typelist,array('class'=>'span12'), array('options' => array('work_category_id'=>array('selected'=>true)))); 

			 ?>
		</div>
		
		<div class="span5">
			<?php echo $form->textFieldRow($model,'contract_no',array('class'=>'span12','maxlength'=>255)); ?>
		</div>
	 </div>

	<div class="row-fluid ">
		<div class="span4">
			  <label for="filename" >ไฟล์แนบ</label>

			<?php
			if(!empty($model->filename))
			{	
				echo "<input type='hidden' name='attach_file_old1' value='".$model->filename."'>";
				//echo CHtml::link('download',array('othercost/download','filename'=>$model->filename), array('target'=>'_blank'));
				echo "<br>";
			}
			echo $form->fileField($model,'filename',array('style'=>'width:200px;','onChange'=>'checkFile(this)','title'=>'Only document allowed'));?>
		
			
		</div>
	</div>

	

	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'บันทึก',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
