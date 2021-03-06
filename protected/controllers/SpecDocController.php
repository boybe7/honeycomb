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
				'actions'=>array('create','update','write','export','exportWrite','moc','download','search','compare','updateCompare','deleteCompare','sendSelected','exportSearch','exportCompare'),
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

				//check new material
				$model->material = empty($model->material) ? $_POST['material'] : $model->material ;
				$model->dimension = empty($model->dimension) ? $_POST['dimension'] : $model->dimension ;
				//$model->unit = empty($model->unit) ? $_POST['unit'] : $model->unit ;


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
							if($model_com2->brand!="" && $uploadFile !== null) {


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

	public function actionCompare()
	{
		$model=new SpecDoc;

		$compares[0] = new SpecDocCompareTemp;
		$compares[1] = new SpecDocCompareTemp;
		$compares[2] = new SpecDocCompareTemp;

		$specList = array();
	
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
				$model->is_written = 1;

				//check new material
				$model->material = empty($model->material) ? $_POST['material'] : $model->material ;
				$model->dimension = empty($model->dimension) ? $_POST['dimension'] : $model->dimension ;

				date_default_timezone_set("Asia/Bangkok");

				$model->create_date = date("Y-m-d H:i:s");
				$model->update_date = date("Y-m-d H:i:s");

				//header('Content-type: text/plain');

				//print_r($model);
				$specList = array();
				$spec_detail = "";
				if(isset($_POST['spec_list']))
				{
					$check_spec1 = isset($_POST['check_spec1']) ? $_POST['check_spec1']  : array();
					$check_spec2 = isset($_POST['check_spec2']) ? $_POST['check_spec2']  : array();
					$check_spec3 = isset($_POST['check_spec3']) ? $_POST['check_spec3']  : array();

					$note_spec1 = $_POST['note_spec1'];
					$note_spec2 = $_POST['note_spec2'];
					$note_spec3 = $_POST['note_spec3'];

					$index = 1;
					$spec_detail = "";
					$score = 0;
					foreach ($_POST['spec_list'] as $key => $value) {
						$m_list = new SpecList;
						$m_list->detail = $value;
						$m_list->spec_compare_id1 = !empty($check_spec1[$index]) ? $check_spec1[$index] : 0;
						$m_list->spec_compare_id2 = !empty($check_spec2[$index]) ? $check_spec2[$index] : 0;
						$m_list->spec_compare_id3 = !empty($check_spec3[$index]) ? $check_spec3[$index] : 0;
						$m_list->note1 =  $note_spec1[$index];
						$m_list->note2 =  $note_spec2[$index];
						$m_list->note3 =  $note_spec3[$index];

						//print_r($value);
						//exit;

						$score1 = !empty($check_spec1[$index]) ? 1 : 0;
						$score2 = !empty($check_spec2[$index]) ? 1 : 0;
						$score3 = !empty($check_spec3[$index]) ? 1 : 0;

						$score = $score1 + $score2 + $score3;
						if($score > 1 ) //detail more than 2 comapny
							$spec_detail .= $value."  ";
						
							
						$specList[] = $m_list;
						$index++;
					}
				}
				
				
				if(isset($_POST['SpecDocCompareTemp']) && !empty($_POST['SpecDocCompareTemp']))
				{

					$model->detail = $spec_detail;
					if($model->save())
					{
						//check material has exist
						$m = Material::model()->findAll(array("condition"=>"name = '".$model->material."' "));
						if(empty($m))
						{
							//insert new material
							$material = new Material;
							$material->name = $model->material;
							$material->detail = $model->detail; 
							$material->save();
						}
						else
						{
							$material = $m[0];
						}


						$i = 1;
						$ncompare_save = 0;
						$compare_id[0] = NULL;
						$compare_id[1] = NULL;
						$compare_id[2] = NULL;

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
							//$model_com2->material_id = $material->id;


							$uploadFile = CUploadedFile::getInstance($model_com, 'attach_file'.$i);
						
							
						    $filesave = '';
							if($uploadFile !== null) {


									$uploadFileName = time()."_".Yii::app()->user->ID.".".$uploadFile->getExtensionName();
									
									$filesave = Yii::app()->basePath .'/../specfile/'.iconv("UTF-8", "TIS-620",$uploadFileName);
									$model_com2->attach_file = $uploadFile;

									if($model_com2->attach_file->saveAs($filesave)){


										$model_com2->attach_file = $uploadFileName;																	
										if(!$model_com2->save())
											$saveOK = false;
										else
										{

											$ncompare_save++;

										}
										//print_r($model_com2);
										
									
									}
							
							}

							$compare_id[$i-1] = $model_com2->id;
							$i++;

							
						}

						if(isset($_POST['spec_list']))
						foreach ($specList as $key => $mlist) {
							// echo "<pre>";
							// print_r($mlist);
							// echo "</pre>";
							$mlist->spec_compare_id1 = !empty($mlist->spec_compare_id1) ? $compare_id[0] : 0;
							$mlist->spec_compare_id2 = !empty($mlist->spec_compare_id2) ? $compare_id[1] : 0;
							$mlist->spec_compare_id3 = !empty($mlist->spec_compare_id3) ? $compare_id[2] : 0;
							$mlist->spec_id = $model->id;

							$mlist->save();
							// header('Content-type: text/plain');
							//  echo "<pre>";
							//  print_r($mlist);
							//  echo "</pre>";
							//  exit;
						}

						if($saveOK && $ncompare_save>0)
						{
							$transaction->commit();
							$this->redirect(array('write'));
							
						}
						else
						{	
							$model->addError('contract', 'เกิดข้อผิดพลาดในการบันทึกข้อมูลคู่เทียบ.');
							//echo "<br><br><br><br>คู่เทียบควรnoว่าง".$ncompare_save;	

						}

					}
				}
				else
				{
					$model->addError('specdoc', 'คู่เทียบไม่ควรว่าง');
					//echo "<br><br><br><br>คู่เทียบไม่ควรว่าง";
				}
			
			
			}
		}
		catch(Exception $e)
	 	{
	 				$transaction->rollBack();	
	 				$model->addError('specdoc', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล.');
	 				Yii::trace(CVarDumper::dumpAsString($e->getMessage()));
	 	        	//you should do sth with this exception (at least log it or show on page)
	 	        	Yii::log( 'Exception when saving data: ' . $e->getMessage(), CLogger::LEVEL_ERROR );
	 
	 	}   	

		$this->render('compare',array(
			'model'=>$model,'compares'=>$compares,'specList'=>$specList
		));
	}

	public function actionUpdateCompare($id)
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
			  	  $compares[$i-1]->vendor_id = $m[0]->vendor_id;
			  	  $compares[$i-1]->brand = $m[0]->brand;
			  	  $compares[$i-1]->model = $m[0]->model;
			  	  $compares[$i-1]->price = $m[0]->price;
			  	  $compares[$i-1]->date_price = $m[0]->date_price;
			  	  
			  	  $compares[$i-1]->attach_file1 = $m[0]->attach_file;
			  	  $compares[$i-1]->attach_file2 = $m[0]->attach_file;
			  	  $compares[$i-1]->attach_file3 = $m[0]->attach_file;
			  }
		}

		$specList = array();
		$m = SpecList::model()->findAll(array("condition"=>"spec_id='$id' "));
		foreach ($m as $key => $value) {
			$specList[] = $value;
		}
	
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
				$model->is_written = 1;

				//check new material
				$model->material = empty($model->material) || $_POST['material']!=$model->material ? $_POST['material'] : $model->material ;
				$model->dimension = empty($model->dimension) || $_POST['dimension']!=$model->dimension  ? $_POST['dimension'] : $model->dimension ;

				date_default_timezone_set("Asia/Bangkok");

				$model->create_date = date("Y-m-d H:i:s");
				$model->update_date = date("Y-m-d H:i:s");

				//header('Content-type: text/plain');

				//print_r($model);
				$specList = array();
				$spec_detail = "";
				if(isset($_POST['spec_list']))
				{
					$check_spec1 = isset($_POST['check_spec1']) ? $_POST['check_spec1']  : array();
					$check_spec2 = isset($_POST['check_spec2']) ? $_POST['check_spec2']  : array();
					$check_spec3 = isset($_POST['check_spec3']) ? $_POST['check_spec3']  : array();

					$note_spec1 = $_POST['note_spec1'];
					$note_spec2 = $_POST['note_spec2'];
					$note_spec3 = $_POST['note_spec3'];

					$index = 1;
					
					$score = 0;
					foreach ($_POST['spec_list'] as $key => $value) {
						$m_list = new SpecList;//empty($value['id']) ? new SpecList : SpecList::model()->findByPk($value['id']);
						$m_list->detail = $value['detail'];
						$m_list->spec_compare_id1 = !empty($check_spec1[$index]) ? 1 : 0;
						$m_list->spec_compare_id2 = !empty($check_spec2[$index]) ? 1 : 0;
						$m_list->spec_compare_id3 = !empty($check_spec3[$index]) ? 1 : 0;
						$m_list->note1 =  $note_spec1[$index];
						$m_list->note2 =  $note_spec2[$index];
						$m_list->note3 =  $note_spec3[$index];
						$m_list->spec_id = $id;

						$score1 = !empty($check_spec1[$index]) ? 1 : 0;
						$score2 = !empty($check_spec2[$index]) ? 1 : 0;
						$score3 = !empty($check_spec3[$index]) ? 1 : 0;

						$score = $score1 + $score2 + $score3;
						if($score > 1 ) //detail more than 2 comapny
							$spec_detail .= $value['detail']."  ";
						//print_r($value);
						//exit;

						//update
						if(!empty($value['id']))
						{
							//$m_list->save();
							//print_r($m_list);
							//exit;
						}	
							
						$specList[] = $m_list;
						$index++;
					}
				}
				
				
				if(isset($_POST['SpecDocCompareTemp']))
				{

					$model->detail = $spec_detail;
					
					if($model->save())
					{
						//check material has exist
						$m = Material::model()->findAll(array("condition"=>"name = '".$model->material."' "));
						if(empty($m))
						{
							//insert new material
							$material = new Material;
							$material->name = $model->material;
							$material->detail = $model->detail; 
							$material->save();
						}
						else
						{
							$material = $m[0];
						}



						$i = 1;
						$compare_id[0] = NULL;
						$compare_id[1] = NULL;
						$compare_id[2] = NULL;
						$ncompare_save = 0;
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
							//$model_com2->material_id = $material->id;


							$uploadFile = CUploadedFile::getInstance($model_com, 'attach_file'.$i);
							$oldfile = isset($_POST['attach_file_old'.$i]) ? $_POST['attach_file_old'.$i] : "";
							//print_r($uploadFile);
							//exit;

							
					
							
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
											$ncompare_save++;
											
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
								{
									if($model_com2->save())
										$ncompare_save++;							
								}	

							}

							$compare_id[$i-1] = $model_com2->id;
							$i++;
							
						}

						//save speclist
						Yii::app()->db->createCommand('DELETE FROM spec_list WHERE spec_id='.$id)->execute();
						//print_r($compare_id);
						foreach ($specList as $key => $mlist) {
							// echo "<pre>";
							// print_r($mlist);
							// echo "</pre>";
							$mlist->spec_compare_id1 = !empty($mlist->spec_compare_id1) ? $compare_id[0] : 0;
							$mlist->spec_compare_id2 = !empty($mlist->spec_compare_id2) ? $compare_id[1] : 0;
							$mlist->spec_compare_id3 = !empty($mlist->spec_compare_id3) ? $compare_id[2] : 0;
							$mlist->spec_id = $id;

							$mlist->save();

							// echo "<pre>";
							// print_r($mlist);
							// echo "</pre>";
						}

						if($saveOK)
						{
							$transaction->commit();
							$this->redirect(array('write'));	
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

		$this->render('compare',array(
			'model'=>$model,'compares'=>$compares,'specList'=>$specList
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
			  	  $compares[$i-1]->vendor_id = $m[0]->vendor_id;
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

			
				
				if(isset($_POST['SpecDocCompareTemp']))
				{

					if($model->save())
					{

						//check material has exist
						$m = Material::model()->findAll(array("condition"=>"name = '".$model->material."' "));
						if(empty($m))
						{
							//insert new material
							$material = new Material;
							$material->name = $model->material;
							$material->detail = $model->detail; 
							$material->save();
						}
						else
						{
							$material = $m[0];
						}

						//header('Content-type: text/plain');
						$i = 1;
						foreach ($_POST['SpecDocCompareTemp'] as $key => $compare) {

							$model_com = new SpecDocCompareTemp;
							

							$model_com->attributes=$compare;	

							/*if(isset($compare['vendor_name']))
							{
								//print_r($compare['vendor_name']);
								//echo "<br>";
								$model_com->attributes=$compare;		
								$mv = Contact::model()->findAll(array("condition"=>"name='".$compare['vendor_name']."'"));

								if($model_com->vendor_id==0 || empty($model_com->vendor_id) || empty($mv))
								{
									//add new contact
									$new_contact = new Contact;
									$new_contact->name = $compare['vendor_name'];
									if($new_contact->save())
										$model_com->vendor_id = $new_contact->id;
									else
										$saveOK = false;


									//print_r($new_contact);

								}
							}*/

							//print_r($compare);


							if(!empty($compare))
							{
									
									$m = SpecDocCompare::model()->findAll(array("condition"=>"spec_id='$id' AND no='$i' "));
									$model_com2 = empty($m) ? new SpecDocCompare : $m[0];
									$model_com2->spec_id = $model->id;
									$model_com2->brand = $model_com->brand;
									$model_com2->vendor_id = $model_com->vendor_id;
									$model_com2->model  =$model_com->model;
									$model_com2->price  =$model_com->price;
									$model_com2->date_price  =$model_com->date_price;
									$model_com2->no = $i;

									
									$model_com2->material_id = $material->id;
									

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
										{	$model_com2->save();

											//print_r($model_com2);	
										}

									}

									
							}
						}

						
						//exit;	
						if($saveOK)
						{
							$transaction->commit();
							//exit;
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

	public function actionSendSelected()
    {
    	$autoIdAll = $_POST['selectedID'];
    	$type = $_POST['type'];
        if(count($autoIdAll)>0)
        {
            foreach($autoIdAll as $autoId)
            {
                $model = $this->loadModel($autoId);
                $model->send = 1;
                $model->work_category_id = $type;
                $model->save();
            }
        }    
    }


	public function actionDeleteCompare($id)
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

				//
				Yii::app()->db->createCommand('DELETE FROM spec_list WHERE spec_id='.$id)->execute();
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

	public function actionWrite()
	{
		$model=new SpecDoc('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SpecDoc']))
			$model->attributes=$_GET['SpecDoc'];
		$tab = 1;
		$this->render('write',array(
			'model'=>$model,'tab'=>$tab
		));
	}

	public function actionSearch()
	{

		//select moc_price
		//SELECT *, CONCAT(year,'-',LPAD(month,2,'00'),'-','01') AS monhtyear FROM `moc_price` p LEFT JOIN moc_price_map m ON m.code=p.code WHERE CONCAT(year,'-',LPAD(month,2,'00'),'-','01') BETWEEN '2562-07-01' AND '2562-10-01' ORDER BY material_id ASC,m.id ASC ,monhtyear DESC


		$model=new Material('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Material']))
			$model->attributes=$_GET['Material'];
		
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

			    // Force the download
				header("Content-Disposition: attachment; filename=" . basename($file));
				header("Content-Length: " . filesize($file));
				header("Content-Type: application/octet-stream;");
				readfile($file);

			    exit;

			}
			else{
				echo "File $file not exist";
			}
           
		    
		}

		
	}

	public function actionExportSearch()
	{
	
		$filename = "export_spec_".Yii::app()->user->ID.".pdf";
		$code = $_GET["code"];
		$str = explode("-", $_GET["category"]);
		$category = $str[0];
		$this->render('_formSearchPDF',array('code'=>$code,'category'=>$category,'date_start'=>$_GET['start_date'],'date_end'=>$_GET['end_date'],'material_id'=>$_GET['material_id'],'filename'=>$filename));

		echo json_encode($filename);
	}

	public function actionExportCompare($id)
	{
	
		$filename = "export_spec_".Yii::app()->user->ID.".pdf";
		
		$this->render('_formComparePDF',array('model'=>SpecDoc::model()->findByPk($id),'filename'=>$filename));

		echo json_encode($filename);
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

			    // Force the download
				header("Content-Disposition: attachment; filename=" . basename($file));
				header("Content-Length: " . filesize($file));
				header("Content-Type: application/octet-stream;");
				readfile($file);

			    exit;

			}
			else{
				echo "File $file not exist";
			}

             
    }

    public function actionExportWrite($id)
	{
		$model=SpecDoc::model()->findByPk($id);

		$filename = $_POST["filename"];
		$this->render('_formWritePDF',array('model'=>$model,'filename'=>$filename));

		echo json_encode($filename);
	}

}

