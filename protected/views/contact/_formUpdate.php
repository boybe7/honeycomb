<style type="text/css">
	.row-fluid .fix_margin {
		margin-left : 0px;
	}

	.select2-container-multi .select2-choices .select2-search-choice {
	    color: #555555;
	    background: #ffe9b9;
	    border-color: #cccccc;
	    filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
	    -webkit-box-shadow: none;
	    box-shadow: none;
	}
	.modal {
	    width: 800px !important;
	}
</style>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'contact-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data','class'=>'well'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-fluid ">
		<div class="span8">
			<?php echo $form->textFieldRow($model,'name',array('class'=>'span12','maxlength'=>500)); ?>
			<?php echo $form->textFieldRow($model,'address',array('class'=>'span12','maxlength'=>500)); ?>
		
			 <div class="row-fluid ">
			 	<div class="span4">
					<?php echo $form->textFieldRow($model,'tax_id',array('class'=>'span12','maxlength'=>13)); ?>
				</div>
			 	<div class="span3">
					<?php echo $form->textFieldRow($model,'telephone',array('class'=>'span12','maxlength'=>20)); ?>
				</div>	
				<div class="span5">
					<?php echo $form->textFieldRow($model,'website',array('class'=>'span12','maxlength'=>255)); ?>
				</div>	
			</div>	

			<?php 

			//echo $form->textFieldRow($model,'detail',array('class'=>'span12','maxlength'=>500));
				$workcat = MaterialCategory::model()->findAll();
		     
		        $typelist = CHtml::listData($workcat,'id','name');
		        //echo $form->dropDownListRow($model, 'detail', $typelist,array('class'=>'span12'), array('options' => array('detail'=>array('selected'=>true)))); 	
		        echo "<label for='detail'>ประเภทสินค้า/บริการ</label>";

		        $m = ContactMap::model()->findAll(array("condition"=>"type=0 AND contact_id = ".$model->id));		     	
		     	$type_selected2 = [];
		     	foreach ($m as $key => $value) {
		     		$type_selected2[] = $value->map_id;
		     	}
		     	
				$this->widget('ext.select2.ESelect2',array(
				  'name'=>'detail',
				  'data'=>$typelist,
				  'value'=>$type_selected2,
				  'htmlOptions'=>array(
				  	'class'=>'span12 fix_margin',
				    'multiple'=>'multiple',
				  ),
				));

			 ?>

			<?php 
				
				$workcat = WorkCategory::model()->findAll();
		     
		        $typelist = CHtml::listData($workcat,'id','name');
		       // echo $form->dropDownListRow($model, 'category', $typelist,array('class'=>'span12'), array('multiple' => true,'options' => array('work_category_id'=>array('selected'=>true)))); 
		     	$m = ContactMap::model()->findAll(array("condition"=>"type=1 AND contact_id = ".$model->id));		     	
		     	$type_selected = [];
		     	foreach ($m as $key => $value) {
		     		$type_selected[] = $value->map_id;
		     	}

				// Multiple data
				echo "<label for='category'>ประเภทงาน</label>";
				$this->widget('ext.select2.ESelect2',array(
				  'name'=>'category',
				  'data'=>$typelist,
				  'value'=>$type_selected,
				  'htmlOptions'=>array(
				  	'class'=>'span12 fix_margin',
				    'multiple'=>'multiple',
				  ),
				));

			 ?>
		</div>	 
		<div class="span4">
			<div class="form-group text-center" style="position: relative;" >
				แนบไฟล์นามบัตร
            <span class="img-div">
              <div class="text-center img-placeholder"  onClick="triggerClick()">
                
              </div>
             <?php 
             	 $card = empty($model->card) ? Yii::app()->baseUrl.'/images/empty.jpg' : Yii::app()->baseUrl.'/specfile/'.$model->card;
                 echo '<img src="'.$card.'" onClick="triggerClick()" id="profileDisplay" class="img-polaroid">'; ?>
            </span>
            <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
            
            </div>
		</div>
	</div>	

<style type="text/css">
	.form-div { margin-top: 100px; border: 1px solid #e0e0e0; }
#profileDisplay { display: block; width: 300px; margin: 0px auto;  }
.img-placeholder {
  width: 300px;
  color: white;

  background: black;
  opacity: .7;
 
  z-index: 2;
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  display: none;
}
.img-placeholder h4 {
  margin-top: 40%;
  color: white;
}

</style>

<script type="text/javascript">
	function triggerClick(e) {
  document.querySelector('#profileImage').click();
}
function displayImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}
</script>

			



	<?php
		echo "<br><b>ผู้ติดต่อ</b>";

					 $this->widget('bootstrap.widgets.TbButton', array(
						    'buttonType'=>'link',
						    
						    'type'=>'success',
						    'label'=>'เพิ่มผู้ติดต่อ',
						    'icon'=>'plus-sign',
						    //'url'=>array('create'),
						    'htmlOptions'=>array('class'=>'pull-right','style'=>'margin-bottom:10px;',
						    	'onclick'=>'

						    		$.ajax({
		                                    url: "../createContactList/'.$model->id.'" ,
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
		                                                                      url: "../createContactList/'.$model->id.'" ,
		                                                                      dataType:"json",
		                                                                      data: $(".modal-body #contactlist-form").serialize(),
		                                                                      success: function (data) {

		                                                                         $("#list-grid").yiiGridView("update",{});
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


	                $modelList = new ContactList('search');
					$this->widget('bootstrap.widgets.TbGridView',array(
							'id'=>'list-grid',
							'dataProvider'=>$modelList->search($model->id),
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
										'headerHtmlOptions' => array('style' => 'width:30%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;'),
										'class' => 'editable.EditableColumn',
										'editable' => array( //editable section
										
											'title'=>'แก้ไข',
											'url' => $this->createUrl('updateContactList'),
											'success' => 'js: function(response, newValue) {
																if(!response.success) return response.msg;

																$("#list-grid").yiiGridView("update",{});
															}',
											'options' => array(
												'ajaxOptions' => array('dataType' => 'json'),

											), 
											'placement' => 'right',
											'display' => 'js: function(value, sourceData) {
											    
											}'
										)
							  	),
							  	'telephone'=>array(
									    'name' => 'telephone',
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;'),
										'class' => 'editable.EditableColumn',
										'editable' => array( //editable section
										
											'title'=>'แก้ไข',
											'url' => $this->createUrl('updateContactList'),
											'success' => 'js: function(response, newValue) {
																if(!response.success) return response.msg;

																$("#list-grid").yiiGridView("update",{});
															}',
											'options' => array(
												'ajaxOptions' => array('dataType' => 'json'),

											), 
											'placement' => 'right',
											'display' => 'js: function(value, sourceData) {
											    
											}'
										)
							  	),
							  	'line'=>array(
									    'name' => 'line',
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;'),
										'class' => 'editable.EditableColumn',
										'editable' => array( //editable section
										
											'title'=>'แก้ไข',
											'url' => $this->createUrl('updateContactList'),
											'success' => 'js: function(response, newValue) {
																if(!response.success) return response.msg;

																$("#list-grid").yiiGridView("update",{});
															}',
											'options' => array(
												'ajaxOptions' => array('dataType' => 'json'),

											), 
											'placement' => 'right',
											'display' => 'js: function(value, sourceData) {
											    
											}'
										)
							  	),
							  	'email'=>array(
									    'name' => 'email',
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;'),
										'class' => 'editable.EditableColumn',
										'editable' => array( //editable section
										
											'title'=>'แก้ไข',
											'url' => $this->createUrl('updateContactList'),
											'success' => 'js: function(response, newValue) {
																if(!response.success) return response.msg;

																$("#list-grid").yiiGridView("update",{});
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

													            return Yii::app()->createUrl('/Contact/deleteContactList/',

													                    array('id'=>$data->id) /* <- customise that */

													            );

													        }, 
											'click'=>'js: function(data){
												$.ajax({
                                                                      type: "POST",
                                                                      url : this.getAttribute("href"),
                                                                      success: function (data) {

                                                                        $.fn.yiiGridView.update("list-grid",{});
                                                                      }
                                                 });
										         

										          return false;

										      }',		        
								        ),
								    ),
								),
							),

						));


	echo "<br><b>แคตตาล็อก</b>";

					 $this->widget('bootstrap.widgets.TbButton', array(
						    'buttonType'=>'link',
						    
						    'type'=>'success',
						    'label'=>'เพิ่มแคตตาล็อก',
						    'icon'=>'plus-sign',
						    //'url'=>array('create'),
						    'htmlOptions'=>array('class'=>'pull-right','style'=>'margin-bottom:10px;',
						    	'onclick'=>'
						    		
						    		$.ajax({
		                                    url: "../createCatalog/'.$model->id.'" ,
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
		                                                        	var form = $(".modal-body #catalog-form")[0];
        															var formData = new FormData(form);
		                                                             $.ajax({
		                                                                      type: "POST",
		                                                                      url: "../createCatalog/'.$model->id.'" ,
		                                                                      dataType:"json",
		                                                                      data: formData,
		                                                                      processData: false,
																			  contentType: false,
		                                                                      
		                                                                      success: function (data) {

		                                                                         $("#catalog-grid").yiiGridView("update",{});
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


	                $modelList = new Catalog('search');
					$this->widget('bootstrap.widgets.TbGridView',array(
							'id'=>'catalog-grid',
							'dataProvider'=>$modelList->search($model->id),
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
							  	
								'detail'=>array(
									    'name' => 'detail',
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:70%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;'),
										'class' => 'editable.EditableColumn',
										'editable' => array( //editable section
										
											'title'=>'แก้ไข',
											'url' => $this->createUrl('updateCatalog'),
											'success' => 'js: function(response, newValue) {
																if(!response.success) return response.msg;

																$("#catalog-grid").yiiGridView("update",{});
															}',
											'options' => array(
												'ajaxOptions' => array('dataType' => 'json'),

											), 
											'placement' => 'right',
											'display' => 'js: function(value, sourceData) {
											    
											}'
										)
							  	),
							  
							  	'export'=>array(
									    'name' => 'filename',
									    'header' => 'Export',
									    'type'=> 'raw',
									    'value'=>'CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/images/download.png"),"'.Yii::app()->createUrl('/Contact/exportCatalog').'/$data->id",array("target"=>"_blank","class"=>"export"))',
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:center;')
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

													            return Yii::app()->createUrl('/Contact/deleteContactList/',

													                    array('id'=>$data->id) /* <- customise that */

													            );

													        }, 
											'click'=>'js: function(data){
												$.ajax({
                                                                      type: "POST",
                                                                      url : this.getAttribute("href"),
                                                                      success: function (data) {

                                                                        $.fn.yiiGridView.update("list-grid",{});
                                                                      }
                                                 });
										         

										          return false;

										      }',		        
								        ),
								    ),
								),
							),

						));

	echo "<b>เอกสารขอใบเสนอราคา/Spec. สินค้า</b>";

			 $this->widget('bootstrap.widgets.TbButton', array(
						    'buttonType'=>'link',
						    
						    'type'=>'success',
						    'label'=>'เพิ่มข้อมูล',
						    'icon'=>'plus-sign',
						    //'url'=>array('/Contact/createRequestQuotation/'.$model->id),
						    'htmlOptions'=>array('class'=>'pull-right','style'=>'margin-bottom:10px;',
						    	'onclick'=>'
						    		
						    		$.ajax({
		                                    url: "../createRequestQuotation/'.$model->id.'" ,
		                                    type: "POST",
		                                    success: function (data) {
							

		                                            bootbox.dialog({
		                                               
		                                                message: data,
		                                                className: "modal-xl",
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
		                                                        	var form = $(".modal-body #request-quotation-form")[0];
        															var formData = new FormData(form);
		                                                             $.ajax({
		                                                                      type: "POST",
		                                                                      url: "../createRequestQuotation/'.$model->id.'" ,
		                                                                      dataType:"json",
		                                                                      data: formData,
		                                                                      processData: false,
																			  contentType: false,
		                                                                      
		                                                                      success: function (data) {

		                                                                         $("#quotation-grid").yiiGridView("update",{});
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

					$modelQuotation = new RequestQuotation('search');
					$this->widget('bootstrap.widgets.TbGridView',array(
							'id'=>'quotation-grid',
							'dataProvider'=>$modelQuotation->search($model->id),
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
							  	
							
							  	'detail'=>array(
									    'name' => 'detail',
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:40%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;'),
										
							  	),
							  	
							  	'date'=>array(
									    'name' => 'date',
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:center;'),
										
							  	),
							  	'export'=>array(
									    'name' => 'filename',
									    'header' => 'Export',
									    'type'=> 'raw',
									    'value'=>'CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/images/download.png"),"'.Yii::app()->createUrl('/Contact/exportQuotation').'/$data->id",array("target"=>"_blank","class"=>"export"))',
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:center;')
							  	),
							  
								array(
									'class'=>'bootstrap.widgets.TbButtonColumn',
									'visible'=>Yii::app()->user->isAdmin() ? true : false,
									'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),
									'template' => '{update} {delete}',
									'buttons'=>array
								    (
								    	'update' => array
								        (
								        
								            'url'=>function($data){

													            return Yii::app()->createUrl('/Contact/updateRequestQuotation/',

													                    array('id'=>$data->id) /* <- customise that */

													            );

											   }
								        ),
								        'delete' => array
								        (
								        
								            'url'=>function($data){

													            return Yii::app()->createUrl('/Contact/deleteRequestQuotation/',

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

<?php 

Yii::app()->clientScript->registerScript('printReport', '
$(".export").click(function(e){
    e.preventDefault();
    filename = "export_'.Yii::app()->user->ID.'.pdf";

   

    $.ajax({

			type: "POST",

			url: $(this).attr("href"),

			data: {filename: filename},

			success: function(res){
				window.open("../../report/temp/"+filename, "_blank", "fullscreen=yes");       
				},

			error: function(res){}

		});

});
');




$this->endWidget(); ?>
