<?php

class AuthenController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'expression'=>'Yii::app()->user->isSuperUser()',
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
		
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		$model=new Authen("search");

		

		if(isset($_POST['user_group']) )
		{
		
		  $transaction=Yii::app()->db->beginTransaction();
		  try {	
				//case 1 : check exist user_group
				$model_group = UserGroup::model()->findAll('name=:group', array(':group' =>$_POST['user_group'] )); 
				
				

					if(!empty($model_group))
					{
							Yii::app()->db->createCommand('DELETE FROM authens WHERE user_group_id='.$model_group[0]->id)->execute();
							$group_id = $model_group[0]->id;

                           if(!empty($_POST['authen_rule']))  
							foreach ($_POST['authen_rule'] as $key => $rule) {
								$m_rule = new Authen("search");
								$m_rule->user_group_id = $group_id;
								$m_rule->menu_id = $rule;
							

								$m_rule->save();



							}
					}	
					else
					{
						$model_group = new UserGroup("search");
						$model_group->name = $_POST['user_group'];
						if($model_group->save())
						{
							$group_id = $model_group->id;

                            if(!empty($_POST['authen_rule']))
							foreach ($_POST['authen_rule'] as $key => $rule) {
								$m_rule = new Authen("search");
								$m_rule->user_group_id = $group_id;
								$m_rule->menu_id = $rule;
							

								$m_rule->save();
							}
						}
					}
				
					
					
				


				$transaction->commit();
			    $this->redirect(array('index'));
		  }
		  catch(Exception $e)
	 	  {
	 				$transaction->rollBack();	
	 				$model->addError('Rules', "Error with save rules");
	 				Yii::trace(CVarDumper::dumpAsString($e->getMessage()));
	 	        	//you should do sth with this exception (at least log it or show on page)
	 	        	Yii::log( 'Exception when saving data: ' . $e->getMessage(), CLogger::LEVEL_ERROR );
	 
	 	  }    	
			
		}

		$this->render('_form',array(
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
			Yii::app()->db->createCommand('DELETE FROM user_groups WHERE id='.$id)->execute();

			Yii::app()->db->createCommand('DELETE FROM authens WHERE user_group_id='.$id)->execute();

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
		$model=new UserGroup('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserGroup']))
			$model->attributes=$_GET['UserGroup'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Authen('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Authen']))
			$model->attributes=$_GET['Authen'];

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
		$model=Authen::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='authen-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
