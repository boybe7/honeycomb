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

			<?php echo $form->textFieldRow($model,'detail',array('class'=>'span12','maxlength'=>500)); ?>

			<?php echo $form->textFieldRow($model,'telephone',array('class'=>'span12','maxlength'=>20)); ?>

			<?php echo $form->textFieldRow($model,'website',array('class'=>'span12','maxlength'=>255)); ?>

		</div>	 
		<div class="span4">
			<div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
              <div class="text-center img-placeholder"  onClick="triggerClick()">
                
              </div>
             <?php 
             	 $card = 'http://localhost/honeycomb/specfile/'.$model->card;
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
	                $modelList = new ContactList('search');
					$this->widget('bootstrap.widgets.TbGridView',array(
							'id'=>'list-grid',
							'dataProvider'=>$modelList->search(),
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
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
							  	'telephone'=>array(
									    'name' => 'telephone',
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
							  	'line'=>array(
									    'name' => 'line',
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
							  	'email'=>array(
									    'name' => 'email',
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
							  
								array(
									'class'=>'bootstrap.widgets.TbButtonColumn',
									'visible'=>Yii::app()->user->isAdmin() ? true : false,
									'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),
									'template' => '{update} {delete}'
								),
							),

						));

	?>
	

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
