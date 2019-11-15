<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'vendor-price-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php 
	// $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
 //                           'name'=>'category_id',
 //                           'id'=>'category_id',
 //                           'value'=>'',
 //                           'source'=>'js: function(request, response) {
 //                                $.ajax({
 //                                    url: "'.$this->createUrl('VendorPrice/GetCategory').'",
 //                                    dataType: "json",
 //                                    data: {
 //                                        term: request.term,
                                       
 //                                    },
 //                                    success: function (data) {
 //                                            response(data);

 //                                    }
 //                                })
 //                             }',
 //                            'options'=>array(
 //                                     'showAnim'=>'fold',
 //                                     'minLength'=>0,
 //                                     'select'=>'js: function(event, ui) {
                                        
 //                                           //console.log(ui.item.id)
                                           
 //                                     }',
                                    
 //                            ),
 //                           'htmlOptions'=>array(
 //                                'class'=>$model->hasErrors('pc_vendor_id')?'span12 error':'span12'
 //                            ),
                                  
 //                        ));

	$workcat = WorkCategory::model()->findAll();
     
    $typelist = CHtml::listData($workcat,'id','name');
    echo $form->dropDownListRow($model, 'category_id', $typelist,array('class'=>'span4'), array('options' => array('category_id'=>array('selected'=>true)))); 

	//echo $form->textFieldRow($model,'moc_id',array('class'=>'span5')); 

	 ?>

	<?php echo $form->textFieldRow($model,'subcategory_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'brand',array('class'=>'span5','maxlength'=>500)); ?>

	<?php echo $form->textFieldRow($model,'price',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'attach_file',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'date_record',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
