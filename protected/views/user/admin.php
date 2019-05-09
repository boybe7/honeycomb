
<?php
$this->breadcrumbs=array(
	'User'=>array('admin'),

);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");


Yii::app()->clientScript->registerScript('delete','
$("#buttonDel").click(function(){
	    //console.log($("#user-grid").yiiGridView("getChecked","username"))
        var checked=$("#user-grid").yiiGridView("getChecked","user-grid_c0");
        var count=checked.length;
        if(count>0 && confirm("Do you want to delete these "+count+" item(s)"))
        {
                $.ajax({
                        data:{checked:checked},
                        url:"'.CHtml::normalizeUrl(array('item/remove')).'",
                        success:function(data){$("#item-grid").yiiGridView("update",{});},              
                });
        }
        });


$("a[data-toggle=modal]").click(function(){
    var target = $(this).attr("data-target");
    var url = $(this).attr("href");
    if(url){
        $(target).find(".modal-body").load(url);
    }
});
');



?>

<div class="main_title">ผู้ใช้งานระบบ</div>



<?php 
$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    
    'type'=>'success',
    'label'=>'เพิ่ม user',
    'icon'=>'plus-sign',
    'url'=>array('create'),
    'htmlOptions'=>array('class'=>'pull-right','style'=>'margin:0px 10px 0px 10px;'),
)); 

$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    
    'type'=>'warning',
    'label'=>'Reset Password',
    'icon'=>'icon-repeat',
    //'url'=>array('create'),
    'htmlOptions'=>array(
    	'class'=>'pull-right',
    	'style'=>'margin:0px 0px 0px 10px;',
    	'onclick'=>'      
                       //console.log($.fn.yiiGridView.getSelection("user-grid").length);
                       if($.fn.yiiGridView.getSelection("user-grid").length==0)
                       		js:bootbox.alert("กรุณาเลือกแถวข้อมูลที่ต้องการ reset password?","ตกลง");
                       else  
                            js:bootbox.confirm("คุณต้องการจะ reset password เป็น 12345?","ยกเลิก","ตกลง",
			                   function(confirmed){
                                  if(confirmed)
                                  {	
			                   	      $.ajax({
										type: "POST",
										url: "resetPassword",
										data: { selectedID: $.fn.yiiGridView.getSelection("user-grid")}
										})
										.done(function( msg ) {
											$("#user-grid").yiiGridView("update",{});
										});
                                   }
			                  })',
        

    	),
));

$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    
    'type'=>'danger',
    'label'=>'ลบ user',
    'icon'=>'minus-sign',
    //'url'=>array('delAll'),
    //'htmlOptions'=>array('id'=>"buttonDel2",'class'=>'pull-right'),
    'htmlOptions'=>array(
        //'data-toggle'=>'modal',
        //'data-target'=>'#myModal',
        'onclick'=>'      
                       //console.log($.fn.yiiGridView.getSelection("user-grid").length);
                       if($.fn.yiiGridView.getSelection("user-grid").length==0)
                       		js:bootbox.alert("กรุณาเลือกแถวข้อมูลที่ต้องการลบ?","ตกลง");
                       else  
                          js:bootbox.confirm("คุณต้องการจะลบข้อมูล?","ยกเลิก","ตกลง",
			                   function(confirmed){
			                   	 	
			                   	 //console.log("Confirmed: "+confirmed);
			                   	 //console.log($.fn.yiiGridView.getSelection("user-grid"));
                                if(confirmed)
			                   	 $.ajax({
										type: "POST",
										url: "deleteSelected",
										data: { selectedID: $.fn.yiiGridView.getSelection("user-grid")}
										})
										.done(function( msg ) {
											$("#user-grid").yiiGridView("update",{});
										});
			                  })',
        'class'=>'pull-right'
    ),
)); 

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'user-grid',
    'type'=>'bordered condensed',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'selectableRows' => 2,
       // 'template'=>"{summary}{items}{pager}",
    'htmlOptions'=>array('style'=>'padding-top:40px'),
    'enablePagination' => true,
    'summaryText'=>'',//'Displaying {start}-{end} of {count} results.',
	'columns'=>array(
	
        'checkbox'=> array(
        	    'id'=>'selectedID',
            	'class'=>'CCheckBoxColumn',
            	//'selectableRows' => 2, 
        		 'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;'),
	  	         'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	            	  		)   	  		
            	),
		'username'=>array(
			    'header'=>'username', 
				// 'class' => 'editable.EditableColumn',
				'name' => 'username',
				'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;'),  	            	  		
				//'headerHtmlOptions' => array('style' => 'width: 110px'),
				'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	        ),

		),
	
		'name'=>array(
			    'header'=>'ชื่อ-นามสกุล', 
				// 'class' => 'editable.EditableColumn',
				'name' => 'name',
				'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;'),  	            	  		
				//'headerHtmlOptions' => array('style' => 'width: 110px'),
				'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	        ),

		),
		'position_id_1'=>array(
	  	            	  		'header'=>'ตำแหน่ง',
	  	            	  		// 'class' => 'editable.EditableColumn',
                                'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;'),
	  	            	  		'name'=> 'position_id_1',
	  	            	  		'value' => array($model,'getPosition'),
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	            	  		),
	  	
	  	            	  	),
		'position_id_2'=>array(
	  	            	  		'header'=>'ตำแหน่งรักษาการ',
	  	            	  		// 'class' => 'editable.EditableColumn',
                                'headerHtmlOptions' => array('style' => 'width:18%;text-align:center;'),
	  	            	  		'name'=> 'position_id_2',
	  	            	  		'value' => array($model,'getPosition2'),
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	            	  		),
	  	   
	  	            	  	),
			'u_group'=>array(
	  	            	  		'header'=>'ประเภท',
	  	            	  		//'class' => 'editable.EditableColumn',
                                'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;'),
	  	            	  		'name'=> 'u_group',
	  	            	  		'value' => array($model,'getGroup'),
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'
	  	            	  		 )	
	  	  
	  	            	  	),
				array(
							'class'=>'bootstrap.widgets.TbButtonColumn',
							'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;'),
							'template' => '{update}',
					
						),
	),
)); 


?>



<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Modal header</h4>
</div>
 
<div class="modal-body">
    <p>One fine body...</p>
</div>
 
<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'link',
        'type'=>'primary',
        'label'=>'Save changes',
        'url'=>array("create"),
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Close',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>