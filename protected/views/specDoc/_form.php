<script type="text/javascript">
function checkFile(electObject){

  
  if((/\.(doc|docx|xls|xlsx|pdf)$/i).test(electObject.value) ) {
      
   }else {
  	 alert("Invalid file!!!!!");  
   } 
}

  
  $(function(){
      

      $( "input[name*='dimension']" ).autocomplete({
       
                minLength: 0
      }).bind('focus', function () {
           
                $(this).val('');
                $(this).autocomplete("search");
        
      });

   
  });

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
			<input type="hidden" id="material_id" name="material_id">
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
		                                           $("#SpecDoc_material").val(ui.item.label);
		                                           $("#material_id").val(ui.item.id);
		                                           
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
		                              if($("#material_id").val()!="")	
		                                $.ajax({
		                                    url: "'.$this->createUrl('material/GetDimension').'",
		                                    dataType: "json",
		                                    data: {
		                                        term: request.term,
		                                        material :  $("#material_id").val()
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
		                                           $("#SpecDoc_dimension").val(ui.item.label);
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
		<?php
			 		$this->widget('bootstrap.widgets.TbButton', array(
						    'buttonType'=>'link',
						    
						    'type'=>'success',
						    'label'=>'เพิ่มบริษัท',
						    'icon'=>'plus-sign',
						    //'url'=>array('create'),
						    'htmlOptions'=>array('class'=>'pull-right','style'=>'margin-bottom:10px;',
						    	'onclick'=>'

						    		$.ajax({
		                                    url: "'.$this->createUrl('contact/CreateContact').'" ,
		                                    type: "POST",
		                                    success: function (data) {
							

		                                            bootbox.dialog({
		                                               
		                                                message: data,
		                                            
		                                                buttons: {
		                                                    cancel: {
		                                                        label: "ปิด",
		                                                        className: "btn-danger",
		                                                        callback: function(){
		                                                           
		                                                        }
		                                                    },
		                                                    save: {
		                                                        label: "บันทึก",
		                                                        className: "btn-info",
		                                                        callback: function(){
		                                                             $.ajax({
		                                                                      type: "POST",
		                                                                      url: "'.$this->createUrl('contact/CreateContact').'" ,
		                                                                      dataType:"json",
		                                                                      data: $(".modal-body #contact-form").serialize(),
		                                                                      success: function (data) {

		                                                                       
		                                                                      }
		                                                                  });
		                                                            
		                                                        }
		                                                    },
		                                                   
		                                                }
		                                            });
											}			
									});					


						    	'	

							),
						)); 
		?>
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
			<?php 


								$contact1 = Contact::model()->findByPk($compares[0]->vendor_id);
								$contact_name = empty($contact1) ? "" : $contact1->name;
								echo "<label for='SpecDocCompareTemp_0_vendor_name'>บริษัท *</label>";
								$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
		                            'name'=>'SpecDocCompareTemp[0][vendor_name]',//'SpecDocCompareTemp[0][vendor_id]',
		                            'id'=>'SpecDocCompareTemp_0_vendor_name',//'SpecDocCompareTemp_0_vendor_id',			
		                            'value'=> $contact_name,	                   
		                            'source'=>'js: function(request, response) {
		                                $.ajax({
		                                    url: "'.$this->createUrl('contact/GetContact').'",
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
		                                          
		                                           $("#SpecDocCompareTemp_0_vendor_id").val(ui.item.id);
		                                           
		                                     }',
		                                
		                                     
		                            ),
		                           'htmlOptions'=>array(
		                                'class'=>'span12'
		                            ),
		                                  
		                        ));
								echo $form->hiddenField($compares[0],'vendor_id',array('class'=>'span12','name'=>'SpecDocCompareTemp[0][vendor_id]'));

			 ?>
		</div>
		<div class="span4">
			<?php 

								$contact1 = Contact::model()->findByPk($compares[1]->vendor_id);
								$contact_name = empty($contact1) ? "" : $contact1->name;
								echo "<label for='SpecDocCompareTemp_1_vendor_name'>บริษัท *</label>";
								$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
		                            'name'=>'SpecDocCompareTemp[1][vendor_name]',//'SpecDocCompareTemp[0][vendor_id]',
		                            'id'=>'SpecDocCompareTemp_1_vendor_name',//'SpecDocCompareTemp_0_vendor_id',				
		                            'value'=> $contact_name,	                   
		                            'source'=>'js: function(request, response) {
		                                $.ajax({
		                                    url: "'.$this->createUrl('contact/GetContact').'",
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
		                                          
		                                           $("#SpecDocCompareTemp_1_vendor_id").val(ui.item.id);
		                                           
		                                     }',
		                                
		                                     
		                            ),
		                           'htmlOptions'=>array(
		                                'class'=>'span12'
		                            ),
		                                  
		                        ));
								echo $form->hiddenField($compares[1],'vendor_id',array('class'=>'span12','name'=>'SpecDocCompareTemp[1][vendor_id]'));
			                   //echo $form->textFieldRow($compares[1],'vendor_id',array('class'=>'span12','name'=>'SpecDocCompareTemp[1][vendor_id]')); ?>
		</div>
		<div class="span4">
			<?php 

								$contact1 = Contact::model()->findByPk($compares[2]->vendor_id);
								//print_r($compares[2]);
								$contact_name = empty($contact1) ? "" : $contact1->name;
								echo "<label for='SpecDocCompareTemp_2_vendor_name'>บริษัท *</label>";
								$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
		                            'name'=>'SpecDocCompareTemp[2][vendor_name]',//'SpecDocCompareTemp[0][vendor_id]',
		                            'id'=>'SpecDocCompareTemp_2_vendor_name',//'SpecDocCompareTemp_0_vendor_id',		
		                            'value'=> $contact_name,	                   
		                            'source'=>'js: function(request, response) {
		                                $.ajax({
		                                    url: "'.$this->createUrl('contact/GetContact').'",
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
		                                          
		                                           $("#SpecDocCompareTemp_2_vendor_id").val(ui.item.id);
		                                           
		                                     }',
		                                
		                                     
		                            ),
		                           'htmlOptions'=>array(
		                                'class'=>'span12'
		                            ),
		                                  
		                        ));
								echo $form->hiddenField($compares[2],'vendor_id',array('class'=>'span12','name'=>'SpecDocCompareTemp[2][vendor_id]'));
								//echo $form->textFieldRow($compares[2],'vendor_id',array('class'=>'span12','name'=>'SpecDocCompareTemp[2][vendor_id]')); ?>
		</div>
	</div>

	<div class="row-fluid ">
		<div class="span4">
			<?php echo $form->textFieldRow($compares[0],'brand',array('class'=>'span12','name'=>'SpecDocCompareTemp[0][brand]')); ?>
		</div>
		<div class="span4">
			<?php echo $form->textFieldRow($compares[1],'brand',array('class'=>'span12','name'=>'SpecDocCompareTemp[1][brand]')); ?>
		</div>
		<div class="span4">
			<?php echo $form->textFieldRow($compares[2],'brand',array('class'=>'span12','name'=>'SpecDocCompareTemp[2][brand]')); ?>
		</div>
	</div>

	<div class="row-fluid ">
		<div class="span4">
			<?php echo $form->textFieldRow($compares[0],'model',array('class'=>'span12','name'=>'SpecDocCompareTemp[0][model]')); ?>
		</div>
		<div class="span4">
			<?php echo $form->textFieldRow($compares[1],'model',array('class'=>'span12','name'=>'SpecDocCompareTemp[1][model]')); ?>
		</div>
		<div class="span4">
			<?php echo $form->textFieldRow($compares[2],'model',array('class'=>'span12','name'=>'SpecDocCompareTemp[2][model]')); ?>
		</div>
	</div>

	<div class="row-fluid ">
		<div class="span4">
			<?php echo $form->textFieldRow($compares[0],'price',array('class'=>'span12','name'=>'SpecDocCompareTemp[0][price]')); ?>
		</div>
		<div class="span4">
			<?php echo $form->textFieldRow($compares[1],'price',array('class'=>'span12','name'=>'SpecDocCompareTemp[1][price]')); ?>
		</div>
		<div class="span4">
			<?php echo $form->textFieldRow($compares[2],'price',array('class'=>'span12','name'=>'SpecDocCompareTemp[2][price]')); ?>
		</div>
	</div>

	<div class="row-fluid ">
		<div class="span4">
			
			    <label for="SpecDocCompareTemp_0_date_price" style='text-align:left;padding-bottom:10px;'>วันที่</label>
            
              <?php       

               
                    echo '<div class="input-append" style="margin-top:-10px;">'; //ใส่ icon ลงไป
                        $form->widget('zii.widgets.jui.CJuiDatePicker',

		                        array(
		                            'name'=>'SpecDocCompareTemp[0][date_price]',
		                            //'attribute'=>'date_price',
		                            'model'=>$compares[0],
		                            'defaultOptions' => array(
		                                              'mode'=>'focus',
		                                              'showOn' => 'both',
		                                              //'language' => 'th',
		                                              'format'=>'dd/mm/yyyy', //กำหนด date Format
		                                              'showAnim' => 'slideDown',
		                                              ),
		                            'value'=>$compares[0]->date_price,
		                            'htmlOptions'=>array('class'=>'span12'),  // ใส่ค่าเดิม ในเหตุการ Update 
		                         )
                    );
                    echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

                 ?>
		</div>
		<div class="span4">
				
                 <label for="SpecDocCompareTemp_1_date_price" style='text-align:left;padding-bottom:10px;'>วันที่</label>
              <?php              
                    echo '<div class="input-append" style="margin-top:-10px;">'; //ใส่ icon ลงไป
                        $form->widget('zii.widgets.jui.CJuiDatePicker',

                        array(
                            'name'=>'SpecDocCompareTemp[1][date_price]',
                            //'attribute'=>'date_price',
                            'model'=>$compares[1],
                            'defaultOptions' => array(
                                              'mode'=>'focus',
                                              'showOn' => 'both',
                                              //'language' => 'th',
                                              'format'=>'dd/mm/yyyy', //กำหนด date Format
                                              'showAnim' => 'slideDown',
                                              ),
                            'value'=>$compares[1]->date_price,
		                    'htmlOptions'=>array('class'=>'span12'),  // ใส่ค่าเดิม ในเหตุการ Update 
                         )
                    );
                    echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

                 ?>
		</div>
		<div class="span4">
				
                <label for="SpecDocCompareTemp_2_date_price" style='text-align:left;padding-bottom:10px;'>วันที่</label>
              
              <?php              
                    echo '<div class="input-append" style="margin-top:-10px;">'; //ใส่ icon ลงไป
                        $form->widget('zii.widgets.jui.CJuiDatePicker',

                        array(
                            'name'=>'SpecDocCompareTemp[2][date_price]',
                            //'attribute'=>'date_price',
                            'model'=>$compares[2],
                            'defaultOptions' => array(
                                              'mode'=>'focus',
                                              'showOn' => 'both',
                                              //'language' => 'th',
                                              'format'=>'dd/mm/yyyy', //กำหนด date Format
                                              'showAnim' => 'slideDown',
                                              ),

                            'value'=>$compares[2]->date_price,
		                    'htmlOptions'=>array('class'=>'span12'),  // ใส่ค่าเดิม ในเหตุการ Update 
                         )
                    );
                    echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

                 ?>
		</div>
	</div>

	<div class="row-fluid ">
		<div class="span4">
			  <label for="attach_file1" >ไฟล์แนบ</label>

			<?php
			if(!empty($compares[0]->attach_file1))
			{	
				echo "<input type='hidden' name='attach_file_old1' value='".$compares[0]->attach_file1."'>";
				echo CHtml::link('download',array('specdoc/download','filename'=>$compares[0]->attach_file1), array('target'=>'_blank'));
				echo "<br>";
			}
			echo $form->fileField($compares[0],'attach_file1',array('style'=>'width:200px;','onChange'=>'checkFile(this)','title'=>'Only document allowed'));?>
		
			
		</div>
		<div class="span4">
			 <label for="attach_file2" >ไฟล์แนบ</label>

			<?php 
			if(!empty($compares[1]->attach_file2))
			{	
				echo "<input type='hidden' name='attach_file_old2' value='".$compares[1]->attach_file2."'>";
				echo CHtml::link('download',array('specdoc/download','filename'=>$compares[1]->attach_file2), array('target'=>'_blank'));
				echo "<br>";
			}
			echo $form->fileField($compares[1],'attach_file2',array('style'=>'width:200px;','onChange'=>'checkFile(this)','title'=>'Only document allowed'));?>
			
		</div>
		<div class="span4">
			 <label for="attach_file3" >ไฟล์แนบ</label>

			<?php 
			if(!empty($compares[2]->attach_file3))
			{	
				echo "<input type='hidden' name='attach_file_old3' value='".$compares[2]->attach_file3."'>";
				echo CHtml::link('download',array('specdoc/download','filename'=>$compares[2]->attach_file3), array('target'=>'_blank'));
				echo "<br>";
			}
			echo $form->fileField($compares[2],'attach_file3',array('style'=>'width:200px;','onChange'=>'checkFile(this)','title'=>'Only document allowed'));?>
			
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
