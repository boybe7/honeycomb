<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
  'type'=>'horizontal',
  'htmlOptions'=>  array('class'=>'well span6 offset1','style'=>''),
)); ?>

	<?php echo $form->errorSummary($model); ?>

  
  <div class="row-fluid">
   
    <div class="span12">
      <?php echo $form->textFieldRow($model,'username',array('class'=>'span12','maxlength'=>100)); ?>
    </div>
    
  </div>
  <div class="row-fluid">
    <div class="span12">
      <?php echo $form->passwordFieldRow($model,'password',array('class'=>'span12','maxlength'=>100)); ?>
      
    </div>
  </div>

  <div class="row-fluid">
   
    <div class="span12">
      <?php echo $form->textFieldRow($model,'name',array('class'=>'span12','maxlength'=>100)); ?>
    </div>
    
  </div>
 
  <div class="row-fluid">
    
    <div class="span12">
      <?php //echo $form->textFieldRow($model,'type_id',array('class'=>'span12','maxlength'=>1)); ?>
       <?php 

        $models=UserGroup::model()->findAll();
        $data = array();
        foreach ($models as $key => $value) {
          $data[] = array(
                          'value'=>$value['id'],
                          'text'=>$value['name'],
                       );
        } 
        $typelist = CHtml::listData($data,'value','text');
        echo $form->dropDownListRow($model, 'user_group_id', $typelist,array('class'=>'span12','prompt'=>'--กรุณาเลือก--')); 
       ?>   
    </div>
   
  </div>	

  <div class="row-fluid">
   
    <div class="span12">
      <?php 

       $models=Position::model()->findAll();
        $data = array();
        foreach ($models as $key => $value) {
          $data[] = array(
                          'value'=>$value['id'],
                          'text'=>$value['name'],
                       );
        } 
        $typelist = CHtml::listData($data,'value','text');
        echo $form->dropDownListRow($model, 'positions_id_1', $typelist,array('class'=>'span12')); 
    
       ?>
    </div>
    
  </div>

  <div class="row-fluid">
   
    <div class="span12">
      <?php 
      $models = Yii::app()->db->createCommand()
                        ->select('id,name')
                        ->from('positions')
                        ->where('name LIKE  "%รักษาการแทน%"')
                        ->queryAll();


       //$models=Position::model()->findAll();
        $data = array();
        foreach ($models as $key => $value) {
          $data[] = array(
                          'value'=>$value['id'],
                          'text'=>$value['name'],
                       );
        } 
        $typelist = CHtml::listData($data,'value','text');
        echo $form->dropDownListRow($model, 'positions_id_2', $typelist,array('class'=>'span12','empty'=>"")); 
     // echo $form->textFieldRow($model,'position2',array('class'=>'span12','maxlength'=>100)); 

      ?>
    </div>
    
  </div>

   
  <div class="row-fluid">
	<div class="span12 form-actions ">
		<?php 
                
      
      $this->widget('bootstrap.widgets.TbButton', array(
			   'buttonType'=>'link',
			   'type'=>'danger',
			   'label'=>'ยกเลิก',
         'htmlOptions'=>array('class'=>'pull-right'),               
          'url'=>array("index"), 
		  )); 
     $this->widget('bootstrap.widgets.TbButton', array(
         'buttonType'=>'submit',
         'htmlOptions'=>array('class'=>'pull-right','style'=>'margin:0px 10px 0px 10px;'),
         'type'=>'primary',
         'label'=>'บันทึก',
                    
      )); 
         
    ?>
	</div>
  </div>
<?php $this->endWidget(); ?>
