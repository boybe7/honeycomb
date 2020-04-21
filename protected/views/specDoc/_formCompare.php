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
    		<input type="text" name="spec_list_add" id="spec_list_add" class="span12">
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
			<?php
			    $no = 1;
				foreach ($specList as $key => $value) {
					$listname = 'spec_list['.$no.']';
				     $check1 = 'check_spec1['.$no.']';
				     $note1 = 'note_spec1['.$no.']';
				     $check2 = 'check_spec2['.$no.']';
				     $note2 = 'note_spec2['.$no.']';
				     $check3 = 'check_spec3['.$no.']';
				     $note3 = 'note_spec3['.$no.']';

				     $check1_checked = $value->spec_compare_id1>=1 ? '  checked' : '';
				     $check2_checked = $value->spec_compare_id2>=1 ? '  checked' : '';
				     $check3_checked = $value->spec_compare_id3>=1 ? '  checked' : '';

					echo "<tr id='rec-".$no."'><td style='text-align: center'>".$no."</td><td width='40%'>&nbsp;<input size='500' name=".$listname." type='hidden' value=".$value->detail.">".$value->detail."</td><td width='15%'><input type='checkbox' name='".$check1."'  ".$check1_checked."> มี <input type='text' style='height:30px' name='".$note1."' value=".$value->note1."></td><td width='15%'><input type='checkbox' name='".$check2."' ".$check2_checked."> มี <input  style='height:30px' type='text'  name='".$note2."' value='".$value->note2."'></td><td width='15%'><input type='checkbox' name='".$check3."'  ".$check3_checked."> มี <input  style='height:30px' type='text'  name='".$note3."' value='".$value->note3."'></td><td><a class='btn btn-xs delete-record' data-id=".$no."><i class='icon icon-trash'></i></a></td></tr>";
					$no++;
				}

			?>
		</tbody>
	</table>


</style>
<style type="text/css">
	table {
   
    /*border-collapse:collapse;*/
    /*table-layout: fixed;*/
}

td input {
    width: 100%;
    height: 25px;
    line-height: 25px;
    box-sizing: border-box;
}
</style>
<script type="text/javascript">
	

	$("#addButton").click(function(){  

	   
		if($("#spec_list_add").val()!="")
		{
		    // var content = jQuery('#sample_table tr'),
		     size = jQuery('#spec-list-table >tbody >tr').length + 1;
		     listname = 'spec_list['+size+']';
		     check1 = 'check_spec1['+size+']';
		     note1 = 'note_spec1['+size+']';
		     check2 = 'check_spec2['+size+']';
		     note2 = 'note_spec2['+size+']';
		     check3 = 'check_spec3['+size+']';
		     note3 = 'note_spec3['+size+']';

		     content = "<tr id='rec-"+size+"'><td style='text-align: center'>"+size+"</td><td width='40%'>&nbsp;<input size='500' name="+listname+" type='hidden' value="+$("#spec_list_add").val()+">"+$("#spec_list_add").val()+"</td><td width='15%'><input type='checkbox' name='"+check1+"'> มี <input type='text' style='height:30px' name='"+note1+"'></td><td width='15%'><input type='checkbox' name='"+check2+"'> มี <input  style='height:30px' type='text'  name='"+note2+"'></td><td width='15%'><input type='checkbox' name='"+check3+"'> มี <input  style='height:30px' type='text'  name='"+note3+"'></td><td><a class='btn btn-xs delete-record' data-id="+size+"><i class='icon icon-trash'></i></a></td></tr>";   

		     
		     $(content).appendTo('#tbl_posts_body');
		     $("#spec_list_add").val("");
		}
		else{
			bootbox.alert("คุณสมบัติไม่ควรเป็นค่าว่าง");
	     
	    //$(newRowContent).appendTo($("#spec-list-table"));
		}
	});


	jQuery(document).delegate('a.delete-record', 'click', function(e) {
		     e.preventDefault();    
		     var didConfirm = confirm("Are you sure You want to delete");
		     if (didConfirm == true) {
		      var id = jQuery(this).attr('data-id');
		      var targetDiv = jQuery(this).attr('targetDiv');
		      jQuery('#rec-' + id).remove();
		      
		    //regnerate index number on table
		    $('#tbl_posts_body tr').each(function(index) {
		      //alert(index);
		      $(this).find('span.sn').html(index+1);
		    });
		    return true;
		  } else {
		    return false;
		  }
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
