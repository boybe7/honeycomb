<?php

class LaborCostController extends Controller
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
				'actions'=>array('index','view','import'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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
		$model=new LaborCost;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['LaborCost']))
		{
			$model->attributes=$_POST['LaborCost'];
			$uploadFile = CUploadedFile::getInstance($model, 'filename');
			$filesave = '';
			if($uploadFile !== null) {
					$uploadFileName = mktime()."_".Yii::app()->user->ID.".".$uploadFile->getExtensionName();
					$filesave = Yii::app()->basePath .'/../fileuploads/labor_cost/'.iconv("UTF-8", "TIS-620",$uploadFileName);
					$model->filename = $uploadFile;

					if($model->filename->saveAs($filesave)){

						$model->filename = $uploadFileName;
						if($model->save())
						    $this->redirect(array('index'));
						

					}
			
			}
		}

		$this->render('create',array(
			'model'=>$model,
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['LaborCost']))
		{
			$model->attributes=$_POST['LaborCost'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
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
			$this->loadModel($id)->delete();

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
		$model=new LaborCost('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LaborCost']))
			$model->attributes=$_GET['LaborCost'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new LaborCost('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LaborCost']))
			$model->attributes=$_GET['LaborCost'];

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
		$model=LaborCost::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='labor-cost-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


	public function actionImport()
	{
		Yii::import('ext.phpexcel.XPHPExcel');    
		$objPHPExcel= XPHPExcel::createPHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');

		$objPHPExcel = $objReader->load("test.xlsx");

		$worksheet  = $objPHPExcel->setActiveSheetIndex(0);
		$highestRow = $worksheet->getHighestRow();

		for ($i=1; $i <= $highestRow ; $i++) { 
			
			$group = $worksheet->getCell("A".$i)->getCalculatedValue();
			$subgroup = $worksheet->getCell("B".$i)->getCalculatedValue();
			$detail = $worksheet->getCell("D".$i)->getCalculatedValue();
			$unit = $worksheet->getCell("E".$i)->getCalculatedValue();
			$cost = $worksheet->getCell("F".$i)->getCalculatedValue();
			$remark = $worksheet->getCell("G".$i)->getCalculatedValue();

			$model = new LaborCost();
			$model->group_detail = $group;
			$model->subgroup_detail = $subgroup;
			$model->detail = $detail;
			$model->unit = $unit;
			$model->cost = $cost;
			$model->remark = $remark;
			$model->category = 0;
			$model->save();
		}


		//print_r($model);
	}
}
