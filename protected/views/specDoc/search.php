<?php
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
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
			<p class="brand2 pull-left">รายละเอียดแบบประกอบงานก่อสร้าง</p>
		
			<form class="navbar-form pull-right" id="search-form" action="/honeycomb/SpecDoc/search" method="get" enctype="application/x-www-form-urlencoded">

			  <input type="text" name="search_key" id='search_key' class="search-query span3" placeholder="ค้นหา" style="margin-right:5px;">
			  <!-- <input type="text" name="search_key2" id='search_key2' class="search-query span2" placeholder="ค้นหาบริษัท รุ่น" style="margin-right:5px;"> -->
			  <?php

			  		$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : 'วันที่เริ่ม';
			  		$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : 'วันที่สิ้นสุด';
			  	

			  		echo '<span  style="margin-top:10px;margin-right:5px;">'; //ใส่ icon ลงไป
                        $this->widget('zii.widgets.jui.CJuiDatePicker',

		                        array(
		                            'name'=>'startDate',
		                            'attribute'=>'startDate',
		                            
		                            'defaultOptions' => array(
		                                              'mode'=>'focus',
		                                              'showOn' => 'both',
		                                              'dateFormat'=>'mm.yy',

       										 			'minDate'=>0,
		                                              'showAnim' => 'slideDown',
		                                              ),
		                            'value'=>$startDate,
		                            'htmlOptions'=>array('class'=>'span2'),  // ใส่ค่าเดิม ในเหตุการ Update 
		                         )
                    );
                    echo '</span>';

                    echo '<span  style="margin-top:10px;margin-right:5px;">'; //ใส่ icon ลงไป
                        $this->widget('zii.widgets.jui.CJuiDatePicker',

		                        array(
		                            'name'=>'endDate',
		                            'attribute'=>'endDate',
		                            
		                            'defaultOptions' => array(
		                                              'mode'=>'focus',
		                                              'showOn' => 'both',
		                                              'dateFormat'=>'mm.yy',

       										 			'minDate'=>0,
		                                              'showAnim' => 'slideDown',
		                                              ),
		                            'value'=>$endDate,
		                            'htmlOptions'=>array('class'=>'span2'),  // ใส่ค่าเดิม ในเหตุการ Update 
		                         )
                    );
                    echo '</span>';

                    	$this->widget('bootstrap.widgets.TbButton', array(
						    'buttonType'=>'submit',
						    
						    'type'=>'info',
						    'label'=>'ค้นหา',
						    'icon'=>'search',
						 
						    'htmlOptions'=>array('class'=>'','style'=>'margin-right:10px;',

						    

							),
						)); 

				//if(Yii::app()->user->getAccess(Yii::app()->request->url))
				//{
				  //  $this->widget('bootstrap.widgets.TbButton', array(
						//     'buttonType'=>'link',
						    
						//     'type'=>'success',
						//     'label'=>'เพิ่มข้อมูล',
						//     'icon'=>'plus-sign',
						//     'url'=>array('create'),
						//     'htmlOptions'=>array('class'=>'pull-right','style'=>'margin-bottom:10px;'),
						// )); 
				//}
			?>

			</form>
			
		</div>	
	</div>	
</div>



<div style="padding-top: 10px;">
 

  	<?php

  	
  						$model = new Material('search');
  						

  						$this->widget('ext.groupgridview.BootGroupGridView',array(
							'id'=>'search-grid',
							'dataProvider'=>$model->search(),
							'itemsCssClass'=>'table table-bordered table-condensed',
							'mergeColumns' => array('material_name','category','detail'), 
							//'selectableRows' =>2,
							'htmlOptions'=>array('style'=>'padding-top:10px'),
						    'enablePagination' => true,
						    'summaryText'=>'แสดงผล {start} ถึง {end} จากทั้งหมด {count} ข้อมูล',
						    'template'=>"{items}<div class='row-fluid'><div class='span6'>{pager}</div><div class='span6'>{summary}</div></div>",
							'columns'=>array(
								
							  	'material_name'=>array(
									    'name' => 'material_name',
									    'value' => '$data["material_name"]',
									   'header' => '<a class="sort-link">วัสดุ</a>',
										'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
							
							  	'detail'=>array(
									    'name' => 'detail',
									    //'value' => '$data["detail"]',
									    'header' => '<a class="sort-link">รายละเอียด</a>',
									    'type'=>'html',
									    
									     'value' => function($model){
									    	
									    	return $model->detail.'<font color="white">-'.$model->material_id.'</font>';
									    },
										'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
							  	'category'=>array(
									    'name' => 'category',
									    'header' => '<a class="sort-link">ประเภทข้อมูล</a>',
									    //'value' => '$data["category"]',
									    'type'=>'html',
									    
									     'value' => function($model){
									    	$str = explode("-", $model->category);
									    	
									    	return $str[0]==1 ? 'ราคากลางกระทรวงพานิชย์ <font color="white">-'.$str[1].'</font>': 'สืบราคา <font color="white">-'.$str[1].'</font>';
									    },
										'headerHtmlOptions' => array('style' => 'width:13%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
							
							  	'dimension'=>array(
									    'name' => 'dimension',
									    'value' => '$data["dimension"]',
									   'header' => '<a class="sort-link">ขนาด/ชนิด/ประเภท</a>',
										'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
							  	'unit'=>array(
									    'name' => 'unit',
									    'value' => '$data["unit"]',
									    'header' => '<a class="sort-link">หน่วย</a>',
										'headerHtmlOptions' => array('style' => 'width:7%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:center;padding-left:10px;')
							  	),
							  
							  	'price'=>array(
									    'name' => 'price',
									    //'value' => '$data["date"]',
									    'type'=>'html',
									    'value'=>'$data->getPrice($data)',
									    'header' => '<a class="sort-link">ราคากลางวัสดุ</a>',
										'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							  	),
								// 'spec_id'=>array(
								// 	    'name' => 'spec_id',
								// 	    'header' => '<a class="sort-link">ราคากลางวัสดุ</a>',
								// 	    'type'=>'raw', 
								// 	    'value' => function($model){
								// 	    		if(empty($model->spec_id))
								// 	    		   return $model->dimension;		
								// 	    		else
							 //                  	   return SpecDoc::model()->findByPK($model->spec_id)->dimension;
							 //                },
								// 	    'filter'=>false,
								// 		'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #f5f5f5'),  	            	  	
								// 		'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
							 //  	),
							 
								'export'=>array(
									    'name' => 'filename',
									    'header' => 'Export',
									    'type'=> 'raw',
									    'value'=>'CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/images/download.png"),"'.Yii::app()->createUrl('/SpecDoc/exportSearch').'?code=$data->code&category=$data->category&start_date=$data->date_start&end_date=$data->date_end&material_id=$data->material_id",array("target"=>"_blank","class"=>"export"))',
									    'filter'=>false,
										'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),  	            	  	
										'htmlOptions'=>array('style'=>'text-align:center;')
							  	),
							  
								// array(
								// 	'class'=>'bootstrap.widgets.TbButtonColumn',
								// 	'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),
								// 	'template' => '{update} {delete}'
								// ),
							),

						));


  	?>
    

</div>	

<?php
Yii::app()->clientScript->registerScript('printReport', '
$(".export").click(function(e){
    e.preventDefault();
    filename = "export_spec_'.Yii::app()->user->ID.'.pdf";

   

    $.ajax({

			type: "POST",

			url: $(this).attr("href"),

			data: {filename: filename},

			success: function(res){
				window.open("../report/temp/"+filename, "_blank", "fullscreen=yes");       
				},

			error: function(res){}

		});

});
');
?>