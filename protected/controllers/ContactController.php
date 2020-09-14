<?php

class ContactController extends Controller
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
				'actions'=>array('create','update','createCatalog','deleteCatalog','createContactList','updateContactList','deleteContactList','createContactListTemp','updateContactListTemp','deleteContactListTemp','delete','createRequestQuotation','updateRequestQuotation','deleteRequestQuotation','createQuotationDetailTemp','deleteQuotationDetailTemp','deleteQuotationDetail','createQuotationDetail','updateQuotationDetail','updateQuotationDetailTemp','exportQuotation','download','exportCatalog','getContact','createContact'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
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
		$model=new Contact;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);


		if(isset($_POST['Contact']))
		{
			$model->attributes=$_POST['Contact'];
			
			$profileImageName = time() . '-' . $_FILES["profileImage"]["name"];
			$filesave = Yii::app()->basePath .'/../specfile/'.$profileImageName;

			if(move_uploaded_file($_FILES["profileImage"]["tmp_name"], $filesave)) {
		        $model->card = $profileImageName;
		        
		    } 

		    if($model->save())
		        {
		        	$m = ContactListTemp::model()->findAll(array("condition"=>"user_id = '".Yii::app()->user->ID."' "));
		        	foreach ($m as $key => $value) {
		        		$contact = new ContactList;
		        		$contact->name = $value->name;
		        		$contact->telephone = $value->telephone;
		        		$contact->line = $value->line;
		        		$contact->email = $value->email;
		        		$contact->contact_id = $model->id;

		        		if($contact->save())
		        			$value->delete();

		        	}
				    $this->redirect(array('index'));	
		        }

			
		}
		else if(!isset($_GET['ajax']))
			Yii::app()->db->createCommand('DELETE FROM contact_list_temp WHERE user_id='.Yii::app()->user->ID)->execute();

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionCreateCatalog($id)
	{
		$model=new Catalog;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Catalog']))
		{
			$model->attributes=$_POST['Catalog'];
			$model->contact_id = $id;
	
				$uploadFile = CUploadedFile::getInstance($model, 'filename');
				$filesave = '';
				//header('Content-type: text/plain');
				if($uploadFile !== null) {


									$uploadFileName = "catalog_".time()."_".Yii::app()->user->ID.".".$uploadFile->getExtensionName();
									
									$filesave = Yii::app()->basePath .'/../specfile/'.iconv("UTF-8", "TIS-620",$uploadFileName);
									$model->filename = $uploadFile;
									

									if($model->filename->saveAs($filesave)){


										$model->filename = $uploadFileName;																	
										
										if($model->save())
											echo CJSON::encode(array('success' => true));
										else
											echo CJSON::encode(array('fail' => true));
										
									
									}
							
				}
				

				//print_r($model);
		   		//exit;	
			
		}
		else
			$this->renderPartial('_formCatalog', array('model'=>$model), false, true);
	
	}

	public function actionCreateContact()
	{
		$model=new Contact;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Contact']))
		{
			$model->attributes=$_POST['Contact'];
			
			if($model->save())
				echo CJSON::encode(array('success' => true));
			else
				echo CJSON::encode(array('fail' => true));
		   
			
		}
		else
			$this->renderPartial('_form2', array('model'=>$model), false, true);
	
	}


	public function actionCreateContactList($id)
	{
		$model=new ContactList;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ContactList']))
		{
			$model->attributes=$_POST['ContactList'];
			$model->contact_id = $id;
			if($model->save())
				echo CJSON::encode(array('success' => true));
			else
				echo CJSON::encode(array('fail' => true));
		   
			
		}
		else
			$this->renderPartial('_formContactList', array('model'=>$model), false, true);
	
	}

	public function actionCreateRequestQuotation($id)
	{
		$model=new RequestQuotation;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RequestQuotation']))
		{
			$model->attributes=$_POST['RequestQuotation'];
			$model->contact_id = $id;
			if($model->save())
			{
				$m = QuotationDetailTemp::model()->findAll(array("condition"=>"user_id = '".Yii::app()->user->ID."' "));
		        foreach ($m as $key => $value) {
		        		$detail = new QuotationDetail;
		        		$detail->name = $value->name;
		        		$detail->amount = $value->amount;
		        		$detail->unit = $value->unit;
		        		$detail->request_id = $model->id;

		        		if($detail->save())
		        			$value->delete();

		        }
		        if(Yii::app()->request->isAjaxRequest)
		        	echo CJSON::encode(array('success' => true));
		        else	
					$this->redirect(array('Contact/update/'.$id,));
			}
		   
			
		}
		else
		{
			//Yii::app()->db->createCommand('DELETE FROM quotation_detail_temp WHERE user_id='.Yii::app()->user->ID)->execute();
			//$this->renderPartial('_formRequestQuotationAjax', array('model'=>$model), false, true);
			$this->render('_formRequestQuotation', array('model'=>$model), false, true);
		}
	
	}

	public function actionUpdateRequestQuotation($id)
	{
		$model=RequestQuotation::model()->findByPk($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RequestQuotation']))
		{
			$model->attributes=$_POST['RequestQuotation'];

			$uploadFile = CUploadedFile::getInstance($model, 'filename');
			
			if($uploadFile !== null) {


				$uploadFileName = "quotation_".time()."_".Yii::app()->user->ID.".".$uploadFile->getExtensionName();
									
				$filesave = Yii::app()->basePath .'/../specfile/'.iconv("UTF-8", "TIS-620",$uploadFileName);
				$model->filename = $uploadFile;
									

				if($model->filename->saveAs($filesave)){


					$model->filename = $uploadFileName;																	
		
									
				}
							
			}
			
			if($model->save())
			{
				

				$this->redirect(array('Contact/update/'.$model->contact_id,));
			}
		   
			
		}
		else
			$this->render('_formUpdateRequestQuotation', array('model'=>$model), false, true);
	
	}

	public function actionCreateContactListTemp()
	{
		$model=new ContactListTemp;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ContactListTemp']))
		{
			$model->attributes=$_POST['ContactListTemp'];
			$model->user_id = Yii::app()->user->ID;
			if($model->save())
				echo CJSON::encode(array('success' => true));
			else
				echo CJSON::encode(array('fail' => true));
		   
			
		}
		else
			$this->renderPartial('_formContactList', array('model'=>$model), false, true);
	
	}

	public function actionCreateQuotationDetailTemp()
	{
		$model=new QuotationDetailTemp;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['QuotationDetailTemp']))
		{
			$model->attributes=$_POST['QuotationDetailTemp'];
			$model->user_id = Yii::app()->user->ID;
			if($model->save())
				echo CJSON::encode(array('success' => true));
			else
				echo CJSON::encode(array('fail' => true,'error'=>$model->getErrors()));


		   
			
		}
		else if(Yii::app()->request->isAjaxRequest)
		{
			$model->name = $_POST['detail'];
			$model->amount = $_POST['amount'];
			$model->user_id = Yii::app()->user->ID;
			if($model->save())
				echo CJSON::encode(array('success' => true));
			else
				echo CJSON::encode(array('fail' => true,'error'=>$model->getErrors()));
		}
		else
		{
			//if(!isset($_GET['ajax']))
			//   Yii::app()->db->createCommand('DELETE FROM quotation_detail_temp WHERE user_id='.Yii::app()->user->ID)->execute();

			$this->renderPartial('_formQuotationDetail', array('model'=>$model), false, true);
		}
	
	}

	public function actionCreateQuotationDetail($id)
	{
		$model=new QuotationDetail;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['QuotationDetail']))
		{
			$model->attributes=$_POST['QuotationDetail'];
			$model->request_id = $id;
			if($model->save())
				echo CJSON::encode(array('success' => true));
			else
				echo CJSON::encode(array('fail' => true));
		   
			
			
		}
		else
		{
			//if(!isset($_GET['ajax']))
			//   Yii::app()->db->createCommand('DELETE FROM quotation_detail_temp WHERE user_id='.Yii::app()->user->ID)->execute();

			$this->renderPartial('_formQuotationDetail', array('model'=>$model), false, true);
		}
	
	}


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$transaction=Yii::app()->db->beginTransaction();
		try 
		{
			if(isset($_POST['Contact']))
			{
				$model->attributes=$_POST['Contact'];

				$profileImageName = time() . '-' . $_FILES["profileImage"]["name"];
				$filesave = Yii::app()->basePath .'/../specfile/'.$profileImageName;

				if(move_uploaded_file($_FILES["profileImage"]["tmp_name"], $filesave)) {
			        $model->card = $profileImageName;
			        
			    } 
			    //header('Content-type: text/plain');
			    
			    $model->tax_id = $_POST['Contact']['tax_id'];
				if($model->save())
				{
					Yii::app()->db->createCommand('DELETE FROM contact_map WHERE contact_id='.$id)->execute();
					
					if(isset($_POST['detail']))
						foreach ($_POST['detail'] as $key => $value) {
					    	//echo $value."<br>";
					    	$m = new ContactMap;
					    	$m->contact_id = $id;
					    	$m->map_id = $value;
					    	$m->type = 0;
					    	$m->save();
					    }

					if(isset($_POST['category']))    
					    foreach ($_POST['category'] as $key => $value) {
					    	$m = new ContactMap;
					    	$m->contact_id = $id;
					    	$m->map_id = $value;
					    	$m->type = 1;
					    	$m->save();
					    }
				    //print_r($model);
				    //exit;

				    $transaction->commit();

					$this->redirect(array('index'));	
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



		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionUpdateContactList()
    {
	    $es = new EditableSaver('ContactList');
	    try {
	    	$es->update();
	    } catch(CException $e) {
	    	echo CJSON::encode(array('success' => false, 'msg' => $e->getMessage()));
	    	return;
	    }
	    echo CJSON::encode(array('success' => true));
    }

    public function actionUpdateQuotationDetail()
    {
	    $es = new EditableSaver('QuotationDetail');
	    try {
	    	$es->update();
	    } catch(CException $e) {
	    	echo CJSON::encode(array('success' => false, 'msg' => $e->getMessage()));
	    	return;
	    }
	    echo CJSON::encode(array('success' => true));
    }

     public function actionUpdateQuotationDetailTemp()
    {
	    $es = new EditableSaver('QuotationDetailTemp');
	    try {
	    	$es->update();
	    } catch(CException $e) {
	    	echo CJSON::encode(array('success' => false, 'msg' => $e->getMessage()));
	    	return;
	    }
	    echo CJSON::encode(array('success' => true));
    }

    public function actionUpdateContactListTemp()
    {
	    $es = new EditableSaver('ContactListTemp');
	    try {
	    	$es->update();
	    } catch(CException $e) {
	    	echo CJSON::encode(array('success' => false, 'msg' => $e->getMessage()));
	    	return;
	    }
	    echo CJSON::encode(array('success' => true));
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
			$this->loadModel($id)->delete();
			Yii::app()->db->createCommand('DELETE FROM contact_list WHERE contact_id='.$id)->execute();

			//delete request quotations
			$requests = RequestQuotation::model()->findAll(array('condition'=>'contact_id='.$id));
			foreach ($requests as $key => $req) {
				$req->delete();
				Yii::app()->db->createCommand('DELETE FROM quotation_detail WHERE request_id='.$req->id)->execute();
			}

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}


	
	
	public function actionDeleteRequestQuotation($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			RequestQuotation::model()->findByPk($id)->delete();

			Yii::app()->db->createCommand('DELETE FROM quotation_detail WHERE request_id='.$id)->execute();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionDeleteContactList($id)
	{
		
			ContactList::model()->findByPk($id)->delete();
			return true;
		   // $this->redirect( $_POST['returnUrl'] );
		
	}

	public function actionGetContact(){
            $request=trim($_GET['term']);
                    
            $models=Contact::model()->findAll(array("condition"=>"name like '%$request%' "));
            $data=array();
            foreach($models as $model){
             
                $data[] = array(
                        'id'=>$model['id'],
                        'label'=>$model['name'],
                );

            }
            $this->layout='empty';
            echo json_encode($data);
        
    }

	public function actionDeleteCatalog($id)
	{
		

			$model = Catalog::model()->findByPk($id);
			$filename = Yii::app()->basePath .'/../specfile/'.$model->filename;
			if($model->delete())
			{
				if (file_exists($filename)) 
						unlink($filename);
											
			}
			return true;
		   // $this->redirect( $_POST['returnUrl'] );
		
	}

	public function actionDeleteQuotationDetail($id)
	{
		
			QuotationDetail::model()->findByPk($id)->delete();
			return true;
		   // $this->redirect( $_POST['returnUrl'] );
		
	}

	public function actionDeleteQuotationDetailTemp($id)
	{
		
			QuotationDetailTemp::model()->findByPk($id)->delete();
			return true;
		   // $this->redirect( $_POST['returnUrl'] );
		
	}

	public function actionDeleteContactListTemp($id)
	{
		
			ContactListTemp::model()->findByPk($id)->delete();
			return true;
		   // $this->redirect( $_POST['returnUrl'] );
		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Contact('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contact']))
			$model->attributes=$_GET['Contact'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Contact('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contact']))
			$model->attributes=$_GET['Contact'];

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
		$model=Contact::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='contact-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionExportQuotation($id)
	{
		$model=RequestQuotation::model()->findByPk($id);

		//$filename = $_POST["filename"];
		$filename = "export_".Yii::app()->user->ID.".pdf";
		$this->render('_formPDF',array('model'=>$model,'filename'=>$filename));

		echo json_encode($filename);
	}

	public function actionExportCatalog($id)
	{
		$model=Catalog::model()->findByPk($id);

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

	public function actionDownload()
    {
   			$filename = $_GET["filename"];
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

}
