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
	'htmlOptions' => array('enctype' => 'multipart/form-data','class'=>'well'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="row-fluid ">
		<div class="span8">
			<?php 
				$workcat = WorkCategory::model()->findAll();
		     
		        $typelist = CHtml::listData($workcat,'id','name');
		        echo $form->dropDownListRow($model, 'work_category_id', $typelist,array('class'=>'span12'), array('options' => array('work_category_id'=>array('selected'=>true)))); 
			 ?>
		</div>	 
		<div class="span4">
			<?php echo $form->textFieldRow($model,'contract_id',array('class'=>'span12')); ?>
		</div>
	</div>			
	<div class="row-fluid ">
		<div class="span8">
			
			<?php

							echo CHtml::activeHiddenField($model, 'material'); 
                    		echo CHtml::activeLabelEx($model, 'material'); 
		 					$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
		                            'name'=>'material',
		                            'id'=>'material',		
		                            'value'=> $model->material,	                   
		                            'source'=>'js: function(request, response) {
		                                $.ajax({
		                                    url: "'.$this->createUrl('material/GetMaterial').'",
		                                    dataType: "json",
		                                    data: {
		                                        term: request.term,
		                                       
		                                    },
		                                    success: function (data) {
		                                            response(data);

		                                    }
		                                })
		                             }',
		                           
		                            'options'=>array(
		                                     'showAnim'=>'fold',
		                                     'minLength'=>0,
		                                     'select'=>'js: function(event, ui) {
		                                           $("#SpecDoc_material").val(ui.item.id);
		                                         
		                                           
		                                     }',
		                                
		                                     
		                            ),
		                           'htmlOptions'=>array(
		                                'class'=>'span12'
		                            ),
		                                  
		                        ));
			?>
		</div>
	</div>
	<div class="row-fluid ">
		<div class="span8">
		
			<?php
							echo CHtml::activeHiddenField($model, 'dimension'); 
                    		echo CHtml::activeLabelEx($model, 'dimension'); 

		 					$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
		                            'name'=>'dimension',
		                            'id'=>'dimension',
		                             'value'=> $model->dimension,		                   
		                            'source'=>'js: function(request, response) {
		                                $.ajax({
		                                    url: "'.$this->createUrl('material/GetDimension').'",
		                                    dataType: "json",
		                                    data: {
		                                        term: request.term,
		                                       
		                                    },
		                                    success: function (data) {
		                                            response(data);

		                                    }
		                                })
		                             }',
		                           
		                            'options'=>array(
		                                     'showAnim'=>'fold',
		                                     'minLength'=>0,
		                                     'select'=>'js: function(event, ui) {
		                                           $("#SpecDoc_dimension").val(ui.item.id);
		                                           $("#SpecDoc_unit").val(ui.item.unit);
		                                           
		                                     }',
		                                
		                                     
		                            ),
		                           'htmlOptions'=>array(
		                                'class'=>'span12'
		                            ),
		                                  
		                        ));
			?>
		</div>
		<div class="span4">
			<?php echo $form->textFieldRow($model,'unit',array('class'=>'span12')); ?>
		</div>
	</div>

	

	<div class="row-fluid ">
		<div class="span12">
			<?php echo $form->textAreaRow($model,'detail',array('rows'=>2, 'cols'=>10, 'class'=>'span12')); ?>
		</div>
	</div>		
	<div class="row-fluid ">
		<div class="span4">
			<h5>คู่เทียบ 1</h5>
		</div>
		<div class="span4">
			<h5>คู่เทียบ 2</h5>
		</div>
		<div class="span4">
			<h5>คู่เทียบ 3</h5>
		</div>
	</div>

	<div class="row-fluid ">
		<div class="span4">
			<?php echo $form->textFieldRow($compares[0],'brand',array('class'=>'span12')); ?>
		</div>
		<div class="span4">
			<?php echo $form->textFieldRow($compares[1],'brand',array('class'=>'span12')); ?>
		</div>
		<div class="span4">
			<?php echo $form->textFieldRow($compares[2],'brand',array('class'=>'span12')); ?>
		</div>
	</div>

	<div class="row-fluid ">
		<div class="span4">
			<?php echo $form->textFieldRow($compares[0],'model',array('class'=>'span12')); ?>
		</div>
		<div class="span4">
			<?php echo $form->textFieldRow($compares[1],'model',array('class'=>'span12')); ?>
		</div>
		<div class="span4">
			<?php echo $form->textFieldRow($compares[2],'model',array('class'=>'span12')); ?>
		</div>
	</div>

	<div class="row-fluid ">
		<div class="span4">
			<?php echo $form->textFieldRow($compares[0],'price',array('class'=>'span12')); ?>
		</div>
		<div class="span4">
			<?php echo $form->textFieldRow($compares[1],'price',array('class'=>'span12')); ?>
		</div>
		<div class="span4">
			<?php echo $form->textFieldRow($compares[2],'price',array('class'=>'span12')); ?>
		</div>
	</div>

	<div class="row-fluid ">
		<div class="span4">
			
                <?php echo $form->labelEx($compares[0],'date_price',array('class'=>'span12','style'=>'text-align:left;padding-right:10px;'));?>
              
              <?php              
                    echo '<div class="input-append" style="margin-top:-10px;">'; //ใส่ icon ลงไป
                        $form->widget('zii.widgets.jui.CJuiDatePicker',

                        array(
                            'name'=>'date_price',
                            'attribute'=>'date_price',
                            'model'=>$compares[0],
                            'defaultOptions' => array(
                                              'mode'=>'focus',
                                              'showOn' => 'both',
                                              //'language' => 'th',
                                              'format'=>'dd/mm/yyyy', //กำหนด date Format
                                              'showAnim' => 'slideDown',
                                              ),
                            'htmlOptions'=>array('class'=>'span12 d-picker', 'value'=>$compares[0]->date_price),  // ใส่ค่าเดิม ในเหตุการ Update 
                         )
                    );
                    echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

                 ?>
		</div>
		<div class="span4">
				
                <?php echo $form->labelEx($compares[1],'date_price',array('class'=>'span12','style'=>'text-align:left;padding-right:10px;'));?>
              
              <?php              
                    echo '<div class="input-append" style="margin-top:-10px;">'; //ใส่ icon ลงไป
                        $form->widget('zii.widgets.jui.CJuiDatePicker',

                        array(
                            'name'=>'date_price',
                            'attribute'=>'date_price',
                            'model'=>$compares[1],
                            'defaultOptions' => array(
                                              'mode'=>'focus',
                                              'showOn' => 'both',
                                              //'language' => 'th',
                                              'format'=>'dd/mm/yyyy', //กำหนด date Format
                                              'showAnim' => 'slideDown',
                                              ),
                            'htmlOptions'=>array('class'=>'span12 d-picker', 'value'=>$compares[1]->date_price),  // ใส่ค่าเดิม ในเหตุการ Update 
                         )
                    );
                    echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

                 ?>
		</div>
		<div class="span4">
				
                <?php echo $form->labelEx($compares[2],'date_price',array('class'=>'span12','style'=>'text-align:left;padding-right:10px;'));?>
              
              <?php              
                    echo '<div class="input-append" style="margin-top:-10px;">'; //ใส่ icon ลงไป
                        $form->widget('zii.widgets.jui.CJuiDatePicker',

                        array(
                            'name'=>'date_price',
                            'attribute'=>'date_price',
                            'model'=>$compares[2],
                            'defaultOptions' => array(
                                              'mode'=>'focus',
                                              'showOn' => 'both',
                                              //'language' => 'th',
                                              'format'=>'dd/mm/yyyy', //กำหนด date Format
                                              'showAnim' => 'slideDown',
                                              ),
                            'htmlOptions'=>array('class'=>'span12 d-picker', 'value'=>$compares[2]->date_price),  // ใส่ค่าเดิม ในเหตุการ Update 
                         )
                    );
                    echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

                 ?>
		</div>
	</div>

	<div class="row-fluid ">
		<div class="span4">
			<?php echo $form->labelEx($compares[0],'ไฟล์แนบ<span style="color:red">&nbsp;*</span>'); ?>

			<?php echo $form->fileField($compares[0],'attach_file',array('style'=>'width:200px;','onChange'=>'checkFile(this)','title'=>'Only document allowed'));?>
			<span id="filecheck" class="help-block error"></span>
			<?php echo CHtml::hiddenField('errorVal','0');?>
		</div>
		<div class="span4">
			<?php echo $form->labelEx($compares[1],'ไฟล์แนบ<span style="color:red">&nbsp;*</span>'); ?>

			<?php echo $form->fileField($compares[1],'attach_file',array('style'=>'width:200px;','onChange'=>'checkFile(this)','title'=>'Only document allowed'));?>
			<span id="filecheck" class="help-block error"></span>
			<?php echo CHtml::hiddenField('errorVal','0');?>
		</div>
		<div class="span4">
			<?php echo $form->labelEx($compares[2],'ไฟล์แนบ<span style="color:red">&nbsp;*</span>'); ?>

			<?php echo $form->fileField($compares[2],'attach_file',array('style'=>'width:200px;','onChange'=>'checkFile(this)','title'=>'Only document allowed'));?>
			<span id="filecheck" class="help-block error"></span>
			<?php echo CHtml::hiddenField('errorVal','0');?>
		</div>
	</div>
	<div class="row-fluid ">
		<div class="span12">
		<?php 
		echo $form->textAreaRow($model,'detail_approve',array('rows'=>2, 'cols'=>10, 'class'=>'span12')); 
		 ?>
		</div>
	</div>	 

	

	<div class="row-fluid ">
		<div class="span12">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'htmlOptions'=>array('class'=>'pull-right','style'=>''),
			'type'=>'primary',
			'label'=>'บันทึก',
		)); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>
