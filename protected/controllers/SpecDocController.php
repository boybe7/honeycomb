<?php

class SpecDocController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','export','moc','download','search'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new SpecDoc;

		$compares[0] = new SpecDocCompareTemp;
		$compares[1] = new SpecDocCompareTemp;
		$compares[2] = new SpecDocCompareTemp;
	
		$saveOK = true;
		$transaction=Yii::app()->db->beginTransaction();
		try 
		{

			if(isset($_POST['SpecDoc']))
			{
				$model->attributes=$_POST['SpecDoc'];
				$model->dimension = trim($_POST['SpecDoc']['dimension']);
				$model->unit = trim($_POST['SpecDoc']['unit']);
				$model->created_by = Yii::app()->user->ID;

				date_default_timezone_set("Asia/Bangkok");

				$model->create_date = date("Y-m-d H:i:s");
				$model->update_date = date("Y-m-d H:i:s");

				//header('Content-type: text/plain');

				//print_r($model);
				
				
				if(isset($_POST['SpecDocCompareTemp']))
				{

					if($model->save())
					{
						$i = 1;
						foreach ($_POST['SpecDocCompareTemp'] as $key => $compare) {

							$model_com = new SpecDocCompareTemp;
							$model_com2 = new SpecDocCompare;

							$model_com->attributes=$compare;
							$compares[$i-1] = $model_com;
						
							//print_r($model_com);
							
							$model_com2->spec_id = $model->id;
							$model_com2->brand = $model_com->brand;
							$model_com2->model  =$model_com->model;
							$model_com2->price  =$model_com->price;
							$model_com2->date_price  =$model_com->date_price;
							$model_com2->no = $i;


							$uploadFile = CUploadedFile::getInstance($model_com, 'attach_file'.$i);
							
							//print_r($uploadFile);
							//exit;

							$i++;
					
							
						    $filesave = '';
							if($uploadFile !== null) {


									$uploadFileName = time()."_".Yii::app()->user->ID.".".$uploadFile->getExtensionName();
									
									$filesave = Yii::app()->basePath .'/../specfile/'.iconv("UTF-8", "TIS-620",$uploadFileName);
									$model_com2->attach_file = $uploadFile;

									if($model_com2->attach_file->saveAs($filesave)){


										$model_com2->attach_file = $uploadFileName;																	
										if(!$model_com2->save())
											$saveOK = false;
										//print_r($model_com2);
										
									
									}
							
							}
							
						}

						if($saveOK)
						{
							$transaction->commit();
							$this->redirect(array('index'));	
						}
						else
						{	$model->addError('contract', 'เกิดข้อผิดพลาดในการบันทึกข้อมูลคู่เทียบ.');}

					}
				}

			
			
			}
		}
		catch(Exception $e)
	 	{
	 				$transaction->rollBack();	
	 				$model->addError('contract', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล.');
	 				Yii::trace(CVarDumper::dumpAsString($e->getMessage()));
	 	        	//you should do sth with this exception (at least log it or show on page)
	 	        	Yii::log( 'Exception when saving data: ' . $e->getMessage(), CLogger::LEVEL_ERROR );
	 
	 	}   	

		$this->render('create',array(
			'model'=>$model,'compares'=>$compares
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$compares[0] = new SpecDocCompareTemp;
		$compares[1] = new SpecDocCompareTemp;
		$compares[2] = new SpecDocCompareTemp;

		for ($i=1; $i <= 3; $i++) { 
			  $m = SpecDocCompare::model()->findAll(array("condition"=>"spec_id='$id' AND no='$i' "));

			  if(!empty($m))
			  {
			  	  $compares[$i-1]->spec_id = $id;
			  	  $compares[$i-1]->brand = $m[0]->brand;
			  	  $compares[$i-1]->model = $m[0]->model;
			  	  $compares[$i-1]->price = $m[0]->price;
			  	  $compares[$i-1]->date_price = $m[0]->date_price;
			  	  
			  	  $compares[$i-1]->attach_file1 = $m[0]->attach_file;
			  	  $compares[$i-1]->attach_file2 = $m[0]->attach_file;
			  	  $compares[$i-1]->attach_file3 = $m[0]->attach_file;
			  }
		}
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$saveOK = true;
		$transaction=Yii::app()->db->beginTransaction();
		try 
		{

			if(isset($_POST['SpecDoc']))
			{
				$model->attributes=$_POST['SpecDoc'];
				$model->dimension = trim($_POST['SpecDoc']['dimension']);
				$model->created_by = Yii::app()->user->ID;

				date_default_timezone_set("Asia/Bangkok");

				$model->create_date = date("Y-m-d H:i:s");
				$model->update_date = date("Y-m-d H:i:s");

				//header('Content-type: text/plain');

				//print_r($model);
				
				
				if(isset($_POST['SpecDocCompareTemp']))
				{

					if($model->save())
					{
						$i = 1;
						foreach ($_POST['SpecDocCompareTemp'] as $key => $compare) {

							$model_com = new SpecDocCompareTemp;

							$m = SpecDocCompare::model()->findAll(array("condition"=>"spec_id='$id' AND no='$i' "));

			 				if(empty($m))			 	
								$model_com2 = new SpecDocCompare;
							else
								$model_com2 = $m[0];

							$model_com->attributes=$compare;
						
							//print_r($model_com);
							
							$model_com2->spec_id = $model->id;
							$model_com2->brand = $model_com->brand;
							$model_com2->model  =$model_com->model;
							$model_com2->price  =$model_com->price;
							$model_com2->date_price  =$model_com->date_price;
							$model_com2->no = $i;


							$uploadFile = CUploadedFile::getInstance($model_com, 'attach_file'.$i);
							$oldfile = isset($_POST['attach_file_old'.$i]) ? $_POST['attach_file_old'.$i] : "";
							
							//print_r($uploadFile);
							//exit;

							$i++;
					
							
						    $filesave = '';
							if($uploadFile !== null) {


									$uploadFileName = time()."_".Yii::app()->user->ID.".".$uploadFile->getExtensionName();
									
									$filesave = Yii::app()->basePath .'/../specfile/'.iconv("UTF-8", "TIS-620",$uploadFileName);
									$filesaveold = Yii::app()->basePath .'/../specfile/'.$oldfile;
									$model_com2->attach_file = $uploadFile;

									if($model_com2->attach_file->saveAs($filesave)){


										$model_com2->attach_file = $uploadFileName;		

																					
										if($model_com2->save())
										{

											
											if (!empty($oldfile) && file_exists($filesaveold)) 
											{
												//print_r($filesaveold);
												unlink($filesaveold);
											}
										}
										else{
											$saveOK = false;	
										}
																			
										
									}
							
							}
							else
							{ 
								$model_com2->attach_file = $oldfile;	
								if($model_com2->brand!="")						
									$model_com2->save();

							}

							//print_r($model_com2);	
						}

						if($saveOK)
						{
							$transaction->commit();
							$this->redirect(array('index'));	
						}
						else
						{	$model->addError('contract', 'เกิดข้อผิดพลาดในการบันทึกข้อมูลคู่เทียบ.');}


					}
				}

			
			
			}
		}
		catch(Exception $e)
	 	{
	 				$transaction->rollBack();	
	 				$model->addError('contract', 'Error occured while savings.');
	 				Yii::trace(CVarDumper::dumpAsString($e->getMessage()));
	 	        	//you should do sth with this exception (at least log it or show on page)
	 	        	Yii::log( 'Exception when saving data: ' . $e->getMessage(), CLogger::LEVEL_ERROR );
	 
	 	} 

	 	//exit;

		$this->render('update',array(
			'model'=>$model,'compares'=>$compares
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			if($this->loadModel($id)->delete()){
				//delete spec_compare
				$spec_compares = SpecDocCompare::model()->findAll(array("condition"=>"spec_id='$id'"));

				foreach ($spec_compares as $key => $value) {
					//delete file
					$file = Yii::app()->basePath .'/../specfile/'.$value->attach_file;
					if(file_exists($file))
						unlink($file);
					
					$value->delete();
				}
			}

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new SpecDoc('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SpecDoc']))
			$model->attributes=$_GET['SpecDoc'];
		$tab = 1;
		$this->render('admin',array(
			'model'=>$model,'tab'=>$tab
		));
	}

	public function actionSearch()
	{
		$model=new SpecSearch('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SpecSearch']))
			$model->attributes=$_GET['SpecSearch'];
		
		$this->render('search',array(
			'model'=>$model
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SpecDoc('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SpecDoc']))
			$model->attributes=$_GET['SpecDoc'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=SpecDoc::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='spec-doc-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionExport($id)
	{
	
		$model = $this->loadModel($id);
		if(!empty($model))
		{
			$file =Yii::getPathOfAlias('webroot')."/specfile/".$model->filename;
			//$this->redirect("../../specfile/".$model->filename);

			//$file = "honeycomb/specfile/".$model->filename;
			//echo $model->filename;
			//$this->redirect("../../specfile/".$model->filename);

			$file = Yii::app()->basePath .'/../specfile/'.$model->filename;
			if (file_exists($file)) {

			    header('Content-Description: File Transfer');

			    header('Content-Type: application/octet-stream');

			    header('Content-Disposition: attachment; filename='.basename($file));
			    header('Content-Transfer-Encoding: binary');

			    header('Expires: 0');

			    header('Cache-Control: must-revalidate');

			    header('Pragma: public');

			    header('Content-Length: ' . filesize($file));

			    ob_clean();

			    flush();

			    readfile($file);

			    exit;

			}
			else{
				echo "File $file not exist";
			}
           
		    
		}

		
	}

	public function actionMoc()
	{
		 ini_set('max_execution_time', 300); //300 seconds = 5 minutes
		 Yii::import('ext.phpexcel.XPHPExcel');   
		 $objPHPExcel= XPHPExcel::createPHPExcel();
		
		

		$row = 1;
	
		$month_str = "06";
		$year = 2562;
		$url="http://203.209.116.53/PRICE_PRESENT/tablecsi_month_region.asp?DDMonth=".$month_str."&DDYear=".$year."&DDProvince=10&B1=%B5%A1%C5%A7";

	
		$data = array('Submit' => '1');
		$options = array(
				'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data),
			)
		);

		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		//print_r($result);
		$result = iconv( 'windows-874','UTF-8', $result);

		
		$src = new DOMDocument('1.0', 'utf-8');
		$src->formatOutput = true;
		$src->preserveWhiteSpace = false;
		$content = file_get_contents($url, false, $context);
		@$src->loadHTML($content);
		$xpath = new DOMXPath($src);
		$values=$xpath->query('//tr[ contains (@class, "") ]');
		$i = 0;

		$json_data = array();
		$rows= $xpath->query('//table/tr');
        $group = "";
        $group_id = 0;
        $id = 1;
		for( $i = 1, $max = $rows->length ; $i < $max; $i++)
		{
			
		    $ro = $rows->item( $i);
		    $cols = $xpath->query( 'td', $ro);
		   
		    $column = 'A';
		   
		    foreach( $cols as $col) {
		        //echo $col->textContent."<br>";
		        $data = trim($col->textContent);
		       
		        $objPHPExcel->getActiveSheet()->setCellValue($column.$row, "'".$data."'");
		        $column++;

		    }


		                           
			$row++;
		}

		ob_end_clean();
		ob_start();

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="test.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');  //
		Yii::app()->end(); 

		//$objWriter->save('testExportFile.csv');
	}

	public function actionDownload($filename)
    {
   
			$file = Yii::app()->basePath .'/../specfile/'.$filename;
			if (file_exists($file)) {

			    header('Content-Description: File Transfer');

			    header('Content-Type: application/octet-stream');

			    header('Content-Disposition: attachment; filename='.basename($file));
			    header('Content-Transfer-Encoding: binary');

			    header('Expires: 0');

			    header('Cache-Control: must-revalidate');

			    header('Pragma: public');

			    header('Content-Length: ' . filesize($file));

			    ob_clean();

			    flush();

			    readfile($file);

			    exit;

			}
			else{
				echo "File $file not exist";
			}

             
    }
}
