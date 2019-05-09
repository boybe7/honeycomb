<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'menu-tree-form',
	 'htmlOptions' => array('class' => 'well'),
	'enableAjaxValidation'=>false,
)); 
  	
  	echo "<h4>".$title."</h4>";
  	echo "<hr>";	

?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'url',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'menu_group_id',array('class'=>'span5')); ?>

	<div class="form-actions">

	    <div class="pull-right">
		<?php

		 $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'บันทึก',
		)); 
		 echo "<span>  </span>";
		 $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'link',
					'type'=>'danger',
					'url'=>array("index"),
					'label'=>'ยกเลิก',
				)); 


		?>
		</div>
	</div>

<?php $this->endWidget(); ?>
