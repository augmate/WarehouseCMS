<?php

class OrderController extends Controller
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
				'actions'=>array('create','update','admin','delete','pickProduct','reset'),
				'users'=>User::usernamesByRole(( User::ADMIN | User::OWNER | User::EMPLOYEE ), User::PERM_ORDER),
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
                $mobile="";
                if (Yii::app()->mobileDetect->isMobile() || Yii::app()->mobileDetect->isTablet()  || isset($_GET['m']) ) {
                    $mobile="_mobile";
                }
            
		$model= new OrderHasProduct;
		$user=User::model()->findByPk(Yii::app()->user->id);
		
		if(isset($_POST['OrderHasProduct']))
		{
			$model->attributes=$_POST['OrderHasProduct'];
			$model->save();
				
		}

		
		$this->render('view'.$mobile,array(
			'model'=>$this->loadModel($id),
			'modelProductQty'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Order;
		$user=User::model()->findByPk(Yii::app()->user->id);
		$model->Company_idCompany=$user->Company_idCompany;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Order']))
		{
			$model->attributes=$_POST['Order'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idOrder));
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

		if(isset($_POST['Order']))
		{
			$model->attributes=$_POST['Order'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idOrder));
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
		$dataProvider=new CActiveDataProvider('Order');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
                $mobile="";
                if (Yii::app()->mobileDetect->isMobile() || Yii::app()->mobileDetect->isTablet()   || isset($_GET['m']) ) {
                    $mobile="_mobile";
                }
            
                $model=new Order('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Order']))
			$model->attributes=$_GET['Order'];
		$model->status=Order::NOT_STARTED;
                
                $this->render('admin'.$mobile,array(
			'model'=>$model,
		));
	}
        
        public function actionPickProduct() {
            $idProd=$_POST['idProd'];
            $idOrd=$_POST['idOrder'];
            $model=  OrderHasProduct::model()->findByPk(array('Order_idOrder'=>$idOrd,'Product_idProduct'=>$idProd));
            $model->Picked=$model->Quantity;
            $model->save();
            echo "Ok";
            Yii::app()->end();
            
        }

        /* Reset all orders to put as status completed and qty products as 0 */
        public function actionReset(){
      		$user=User::model()->findByPk(Yii::app()->user->id);
      		Order::resetOrders($user);
//      		$model =Order::model()->findAll("Company_idCompany=".$user->Company_idCompany);
//                foreach($model as $order){
//                    $order->status=Order::NOT_STARTED;
//                    $order->save();
//                    $products=  OrderHasProduct::model()->findAll('Order_idOrder='.$order->idOrder);
//                    foreach($products as $product){
//                        $product->Picked=0;
//                        $product->save();
//                    }
//                }
          $this->render('reset');
        }
        
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Order::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='order-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
