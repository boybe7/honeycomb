<?php

class UserController extends Controller
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
				'actions'=>array('create','update','password','delete','deleteSelected'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','updateuser','getusergroup','getuserposition','resetPassword'),
				//'expression'=>'Yii::app()->user->isAdmin()',
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
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			
			if($model->save())
                            $this->redirect(array('index'));
				//$this->redirect(array('view','id'=>$model->staff_id));
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



		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
		

			if($model->save())
				$this->redirect(array('index'));
		}

		$model->password =  "";

		$this->render('update',array(
			'model'=>$model,
		));
	}
        
    public function actionPassword($id)
	{
		$model = new ChangePasswordForm;
                if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
                {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
                }

                // collect user input data
                if(isset($_POST['ChangePasswordForm']))
                {
                    $model->attributes=$_POST['ChangePasswordForm'];
                   
                    if($model->validate() && $model->changePassword())
                    {
                        Yii::app()->user->setFlash('success', '');
                        //$this->redirect( $this->action->id );
                        $this->redirect(array('site/logout'));
                    }
                }
                
                $this->render('password',array('model'=>$model));

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
		/*$dataProvider=new CActiveDataProvider('Staff');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
        $model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Staff']))
			$model->attributes=$_GET['Staff'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

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
		$model=User::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionUpdateUser()
    {
	    $es = new EditableSaver('User');

	 
	    try {
	    	   // header('Content-type: text/plain');
         //    print_r($es);                    
         // exit;
	    	$es->update();

	    } catch(CException $e) {
	    	echo CJSON::encode(array('success' => false, 'msg' => $e->getMessage()));
	    	return;
	    }
	    echo CJSON::encode(array('success' => true));
    }

    public function actionGetUserGroup()
    {
    	
    	$models=UserGroup::model()->findAll();
    	$data = array();
    	foreach ($models as $key => $value) {
    		$data[] = array(
                        'value'=>$value['id'],
                        'text'=>$value['name'],
                     );
    	}
    	//$data = array(array("value"=>"1","text"=>"Admin"),array("value"=>"2","text"=>"SuperUser"),array("value"=>"3","text"=>"User"),array("value"=>"4","text"=>"Executive"));
       // $data = array(array("value"=>"1","text"=>"Admin"),array("value"=>"2","text"=>"user"),array("value"=>"3","text"=>"xxx"));
       //$data = [{"value":"1","text":"admin"},{"value":"2","text":"user"},{"value":"6","text":"xxx"}];
        echo CJSON::encode($data);
    }

       public function actionGetUserPosition()
    {
    	
    	$models=Position::model()->findAll();
    	$data = array();
    	foreach ($models as $key => $value) {
    		$data[] = array(
                        'value'=>$value['id'],
                        'text'=>$value['name'],
                     );
    	}
    	//$data = array(array("value"=>"1","text"=>"Admin"),array("value"=>"2","text"=>"SuperUser"),array("value"=>"3","text"=>"User"),array("value"=>"4","text"=>"Executive"));
       // $data = array(array("value"=>"1","text"=>"Admin"),array("value"=>"2","text"=>"user"),array("value"=>"3","text"=>"xxx"));
       //$data = [{"value":"1","text":"admin"},{"value":"2","text":"user"},{"value":"6","text":"xxx"}];
        echo CJSON::encode($data);
    }


    public function actionDeleteSelected()
    {
    	$autoIdAll = $_POST['selectedID'];
        if(count($autoIdAll)>0)
        {
            foreach($autoIdAll as $autoId)
            {
                $this->loadModel($autoId)->delete();
            }
        }    
    }

    public function actionResetPassword()
    {
    	$autoIdAll = $_POST['selectedID'];
        if(count($autoIdAll)>0)
        {
            foreach($autoIdAll as $autoId)
            {
                $model = $this->loadModel($autoId);
                $model->password = "12345";
			    if($model->save())
			    	echo "success";
			    else
			        echo "error";	 
            }
        }    
    }
}
