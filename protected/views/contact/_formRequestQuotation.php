<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'contactlist-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data','class'=>'well'),
)); ?>

	<h4>เอกสารขอใบเสนอราคา</h4>
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-fluid ">
		<div class="span8">
			<?php echo $form->textFieldRow($model,'detail',array('class'=>'span12','maxlength'=>100)); ?>
		</div>
		<div class="span4">	
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

	<?php


					$this->widget('bootstrap.widgets.TbButton', array(
						    'buttonType'=>'link',
						    
						    'type'=>'success',
						    'label'=>'เพิ่มข้อมูล',
						    'icon'=>'plus-sign',
						    //'url'=>array('create'),
						    'htmlOptions'=>array('class'=>'pull-right','style'=>'margin-bottom:10px;',
						    	'onclick'=>'

						    		$.ajax({
		                                    url: "../createQuotationDetailTemp" ,
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
		                                                                      url: "../createQuotationDetailTemp" ,
		                                                                      dataType:"json",
		                                                                      data: $(".modal-body #quotation-form").serialize(),
		                                                                      success: function (data) {

		                                                                         $("#quotation-grid2").yiiGridView("update",{});
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

					$modelQuotation = new QuotationDetailTemp('search');
					$this->widget('bootstrap.widgets.TbGridView',array(
							'id'=>'quotation-grid2',
							'dataProvider'=>$modelQuotation->search(Yii::app()->user->ID),
							'type'=>'bordered condensed',
							//'filter'=>$model,
							'selectableRows' =>2,
							'htmlOptions'=>array('style'=>'padding-top:10px'),
						    'enablePagination' => true,
						    'summaryText'=>'แสดงผล {start} ถึง {end} จากทั้งหมด {count} ข้อมูล',
						    'template'=>"{items}<div class='row-fluid'><div class='span6'>{pager}</div><div class='span6'>{summary}</div></div>",
							'columns'=>array(
								'no'=>array(
									    'name' => 'no',
									    'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
									    'filter'=>false,

										'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:center;padding-left:10px;')
							  	),
							  	
							
							  	'name'=>array(
									    'name' => 'name',
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:70%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;'),
										'class' => 'editable.EditableColumn',
										'editable' => array( //editable section
										
											'title'=>'แก้ไข',
											'url' => $this->createUrl('updateQuotationDetailTemp'),
											'success' => 'js: function(response, newValue) {
																if(!response.success) return response.msg;

																$("#quotation-grid").yiiGridView("update",{});
															}',
											'options' => array(
												'ajaxOptions' => array('dataType' => 'json'),

											), 
											'placement' => 'right',
											'display' => 'js: function(value, sourceData) {
											    
											}'
										)
							  	),
							  	
							  	'amount'=>array(
									    'name' => 'amount',
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;'),
										'class' => 'editable.EditableColumn',
										'editable' => array( //editable section
										
											'title'=>'แก้ไข',
											'url' => $this->createUrl('updateQuotationDetailTemp'),
											'success' => 'js: function(response, newValue) {
																if(!response.success) return response.msg;

																$("#quotation-grid").yiiGridView("update",{});
															}',
											'options' => array(
												'ajaxOptions' => array('dataType' => 'json'),

											), 
											'placement' => 'right',
											'display' => 'js: function(value, sourceData) {
											    
											}'
										)
							  	),

							  	'unit'=>array(
									    'name' => 'unit',
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;'),
										'class' => 'editable.EditableColumn',
										'editable' => array( //editable section
										
											'title'=>'แก้ไข',
											'url' => $this->createUrl('updateQuotationDetailTemp'),
											'success' => 'js: function(response, newValue) {
																if(!response.success) return response.msg;

																$("#quotation-grid").yiiGridView("update",{});
															}',
											'options' => array(
												'ajaxOptions' => array('dataType' => 'json'),

											), 
											'placement' => 'right',
											'display' => 'js: function(value, sourceData) {
											    
											}'
										)
							  	),
							  
								array(
									'class'=>'bootstrap.widgets.TbButtonColumn',
									'visible'=>Yii::app()->user->isAdmin() ? true : false,
									'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),
									'template' => '{delete}',
									'buttons'=>array
								    (
								        'delete' => array
								        (
								        
								            'url'=>function($data){

													            return Yii::app()->createUrl('/Contact/deleteQuotationDetailTemp/',

													                    array('id'=>$data->id) /* <- customise that */

													            );

													        }, 
											'click'=>'js: function(data){
												$.ajax({
                                                                      type: "POST",
                                                                      url : this.getAttribute("href"),
                                                                      success: function (data) {

                                                                        $.fn.yiiGridView.update("quotation-grid",{});
                                                                      }
                                                 });
										         

										          return false;

										      }',		        
								        ),
								    ),
								),
							),

						));

	?>	
	


<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'บันทึก',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
