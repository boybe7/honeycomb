<?php
	Yii::app()->clientScript->registerScript('search', "



		$('.search-button').click(function(){
			$('.search-form').toggle();
			return false;
		});
		$('.search-form form').submit(function(){

	
			var active = $('.tab-pane.active').attr('id');
			id = active.replace('workcat','')
		
		    $.fn.yiiGridView.update('detail-grid-'+id, {
		        data: {search: $('#search_key').val(), work_id : id}
		    });

			return false;
		});
		");

		Yii::app()->clientScript->registerScript('search', "


		$('#search-form').submit(function(){

			var active = $('.tab-pane.active').attr('id');
			id = active.replace('workcat','')
			

			for (id = 1; id < 8; id++) {
			    $.fn.yiiGridView.update('detail-grid-'+id, {
			        data: {search: $('#search_key').val(), work_id : id}
			    });
			}    
		 
		    return false;
		});
	");

?>



<div class="navbar">
	<div class="navbar-inner2 navbar-header">
		<div class="container" style="padding-top:5px">
			<p class="brand2 pull-left">รายละเอียดจัดทำ Spec.</p>
		
			<form class="navbar-form pull-right" id="search-form" action="/honeycomb/specdoc/admin" method="get">

			  <input type="text" name="search_key" id='search_key' class="search-query" placeholder="Search" style="margin-right:10px;">
			
			  <?php

                  
			  		$this->widget('bootstrap.widgets.TbButton', array(
						    'buttonType'=>'submit',
						    
						    'type'=>'info',
						    'label'=>'',
						    'icon'=>'search',
						 
						    'htmlOptions'=>array('class'=>'','style'=>'margin-right:10px;',

						    

							),
						)); 

				//if(Yii::app()->user->getAccess(Yii::app()->request->url))
				//{
					 if(Yii::app()->user->isAdmin())
					 {

				         $this->widget('bootstrap.widgets.TbButton', array(
						    'buttonType'=>'link',
						    
						    'type'=>'info',
						    'label'=>'ส่งเข้าระบบจัดเก็บ Spec',
						    'icon'=>'share-alt',
						    //'url'=>array('sendCompare'),
						    'htmlOptions'=>array('class'=>'pull-right','style'=>'margin-bottom:10px;',
						    	
							            'onclick'=>'js:bootbox.prompt({
						                      title: "เลือกประเภทงาน",
						                      inputType: "select",
						                      inputOptions: [
						                        {
						                            text: "งานโครงสร้าง",
						                            value: 1,
						                        },
						                        {
						                            text: "งานสถาปัตย์",
						                            value: 2,
						                        },
						                        {
						                            text: "งานสุขาภิบาล",
						                            value: 3,
						                        },
						                        {
						                            text: "งานไฟฟ้า",
						                            value: 4,
						                        }
						                        ,
						                        {
						                            text: "งานถนน",
						                            value: 5,
						                        },
						                        {
						                            text: "รายละเอียดประกอบแบบทั่วไป",
						                            value: 6,
						                        }
						                        ],
						                      callback: function (result) {
						                        if(result>0)
						                        {
						                            $.ajax({
						                                    url: "'.$this->createUrl('specDoc/sendSelected').'",
						                                    type: "POST",
						                                    data: { selectedID: $.fn.yiiGridView.getSelection("write-grid"),type: result},
						                                    success: function (msg) {
						                                           
						                                          $("#write-grid").yiiGridView("update",{});
						                                    }
						                                })
						                               
						                        }
						                      }

						                  });'
						),
						)); 


				         $this->widget('bootstrap.widgets.TbButton', array(
						    'buttonType'=>'link',
						    
						    'type'=>'success',
						    'label'=>'เพิ่มข้อมูล',
						    'icon'=>'plus-sign',
						    'url'=>array('compare'),
						    'htmlOptions'=>array('class'=>'pull-right','style'=>'margin-bottom:10px;margin-right:10px;',
						    	

							),
						)); 
				      }    
				//}
			?>

			</form>
		</div>	
	</div>	
</div>



<div style="padding-top: 10px;">
 

  	<?php
  		
  		
  						$this->widget('bootstrap.widgets.TbGridView',array(
							'id'=>'write-grid',
							'dataProvider'=>$model->searchWrite(),
							'type'=>'bordered condensed',
							//'filter'=>$model,
							'selectableRows' =>2,
							'htmlOptions'=>array('style'=>'padding-top:10px'),
						    'enablePagination' => true,
						    'summaryText'=>'แสดงผล {start} ถึง {end} จากทั้งหมด {count} ข้อมูล',
						    'template'=>"{items}<div class='row-fluid'><div class='span6'>{pager}</div><div class='span6'>{summary}</div></div>",
							'columns'=>array(
								'checkbox'=> array(
						        	    'id'=>'selectedID',
						            	'class'=>'CCheckBoxColumn',
						            	//'selectableRows' => 2, 
						        		 'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),
							  	         'htmlOptions'=>array(
							  	            	  			'style'=>'text-align:center'

							  	            	  		)   	  		
						        ),
								'no'=>array(
									    'name' => 'no',
									    'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
									    'filter'=>false,

										'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:center;padding-left:10px;')
							  	),
							  	'material'=>array(
									    'name' => 'material',
									    'filter'=>CHtml::activeTextField($model, 'material',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("material"))),
										'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
								'name'=>array(
									    'name' => 'detail',
									    //'value'=> '$data->getWriteDetail()',
									    'filter'=>CHtml::activeTextField($model, 'detail',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("detail"))),
										'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
							  	'dimension'=>array(
									    'name' => 'dimension',
									    'filter'=>CHtml::activeTextField($model, 'dimension',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("dimension"))),
										'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:center;padding-left:10px;')
							  	),
							  	'unit'=>array(
									    'name' => 'unit',
									    'filter'=>CHtml::activeTextField($model, 'unit',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("unit"))),
										'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:center;padding-left:10px;')
							  	),
							  	'compare1'=>array(
									    'name' => 'compare1',
									    'header' => '<a class="sort-link">คู่เทียบ 1</a>',
									    'type'=>'raw', 
									    'value' => function($model){
							                  return $model->getCompare($model,1);
							                },
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:center;padding-left:10px;')
							  	),
							  	'compare2'=>array(
									    'name' => 'compare2',
									    'header' => '<a class="sort-link">คู่เทียบ 2</a>',
									    'value' => function($model){
							                  return $model->getCompare($model,2);
							                },
							            'type'=>'raw', 
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:center;padding-left:10px;')
							  	),
							  	'compare3'=>array(
									    'name' => 'compare3',

									    'header' => '<a class="sort-link">คู่เทียบ 3</a>',
									    'type'=>'raw', 
									    'value' => function($model){
									    	   return $model->getCompare($model,3);
							                },
									    'filter'=>false,

										'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:center;padding-left:10px;')
							  	),
							  	'send'=>array(
									    'name' => 'send',								
									    'value' => function($model){
							                  return $model->send==0 ? "<i class=' icon-ban-circle icon-red'></i>" : "<i class='icon-ok icon-green'></i>";
							                },
							            'type'=>'raw', 
							            'visible'=>Yii::app()->user->isAdmin() ? true : false,
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:center;')
							  	),
								'export'=>array(
									    'name' => 'filename',
									    'header' => 'Export',
									    'type'=> 'raw',
									    'value'=>'CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/images/download.png"), "export/".$data->id)',
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
								            'label'=>'แก้ไข',
								            //'visible'=>'$data->status != "Approved" && $data->status != "Cancel"',
								            'url'=>function($data){

													            return Yii::app()->createUrl('/SpecDoc/updateCompare/',

													                    array('id'=>$data->id) /* <- customise that */

													            );

													        }, 
								            
								        ),
								        'delete' => array
								        (
								            'label'=>'ลบ',
								            //'visible'=>'$data->status != "Approved" && $data->status != "Cancel"',
								            'url'=>function($data){

													            return Yii::app()->createUrl('/SpecDoc/deleteCompare/',

													                    array('id'=>$data->id) /* <- customise that */

													            );

													        }, 
								            
								        ),
								       
								    ),
								),
							),

						));
  			
  	?>
    
     
 