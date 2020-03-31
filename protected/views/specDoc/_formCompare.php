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
    
    <h4>คุณสมบัติเฉพาะ</h4>
    <div class="row-fluid">
    	<div class="span9">
    		<input type="text" name="spec_list" id="spec_list" class="span12">
    	</div>
    	<div class="span3">
    		<button id="addButton" type="button" class=" btn btn-success">เพิ่มคุณสมบัติ</button>
    		
    	</div>	
	</div>
	<table id="spec-list-table" class="table table-bordered table-condensed table">
		<thead>
			<tr><th width='5%'>No.</th><th width='40%'></th><th width='18%' style="text-align: center">คู่เทียบ 1</th><th style="text-align: center" width='18%'>คู่เทียบ 2</th><th style="text-align: center" width='18%'>คู่เทียบ 3</th><th width='6%'></th></tr>
		</thead>
		<tbody id="tbl_posts_body">
			
		</tbody>
	</table>


<script type="text/javascript">
	

	$("#addButton").click(function(){  

	   

	    // var content = jQuery('#sample_table tr'),
	     size = jQuery('#spec-list-table >tbody >tr').length + 1;
	     content = "<tr><td style='text-align: center'>"+size+"</td><td width='40%'>"+$("#spec_list").val()+"</td><td width='15%'><input type='checkbox' id='vehicle2' name='vehicle2'> มี <input type='text'></td><td width='15%'><input type='checkbox' id='vehicle2' name='vehicle2'> มี <input type='text'></td><td width='15%'><input type='checkbox' id='vehicle2' name='vehicle2'> มี <input type='text'></td></tr>";   

	     
	     $(content).appendTo('#tbl_posts_body');
	     
	    //$(newRowContent).appendTo($("#spec-list-table"));
	});
</script>
	

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