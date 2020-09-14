<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'request-quotation-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data','class'=>'well span7'),
)); ?>

	<h4>เอกสารขอใบเสนอราคา</h4>
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="row-fluid ">
		<div class="span11">
			<?php echo $form->textFieldRow($model,'project',array('class'=>'span12','maxlength'=>200)); ?>
		</div>
	</div>	
	<div class="row-fluid ">
		<div class="span8">
			<?php echo $form->textFieldRow($model,'detail',array('class'=>'span12','maxlength'=>100)); ?>
		</div>
		<div class="span3">	
			<?php 
			 echo $form->labelEx($model,'date',array('class'=>'span12','style'=>'text-align:left;padding-right:10px;'));
			 echo '<div class="input-append" style="margin-top:-10px;">'; //ใส่ icon ลงไป
                        $form->widget('zii.widgets.jui.CJuiDatePicker',

		                        array(
		                            'name'=>'date',
		                            'attribute'=>'date',
		                            'model'=>$model,
		                            'defaultOptions' => array(
		                                              'mode'=>'focus',
		                                              'showOn' => 'both',
		                                              //'language' => 'th',
		                                              'format'=>'dd/mm/yyyy', //กำหนด date Format
		                                              'showAnim' => 'slideDown',
		                                              ),
		                            'value'=>$model->date,
		                            'htmlOptions'=>array('class'=>'span12'),  // ใส่ค่าเดิม ในเหตุการ Update 
		                         )
                    );
                    echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

			 ?>
		</div>
	</div>	
	<br>
    <hr>
	<div class="row-fluid">
		<div class="span8">
			<label for="detail">รายการ</label>
			<input type="text" class="span12" name="detail" id="Quatation_detail">
		</div>	
		<div class="span2">
			<label for="amount">จำนวน</label>
			<input type="text" class="span12" name="amount" id="Quatation_amount">
		</div>	
		<div class="span2">

	<?php


	?>
		</div>	
	</div>
	<?php				

				

	?>	
	


<!-- <div class="form-actions">
		<?php

		 $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'บันทึก',
		)); ?>
	</div> -->

<?php $this->endWidget(); ?>
