<?php

class ProductController extends Controller
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
        'users'=>array('@'),
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

  public function uploadFile($model, $attribute){
    $uploadDir=dirname(__FILE__)."/../../upload/";
     //Create time encoded filename
        $fileNewName=date("Ymdhis");
    Yii::log("Uploading new file with name: ".$fileNewName, "warning");
        //Upload image to server
        $myfile=CUploadedFile::getInstance($model, $attribute);
    if(isset($myfile)){
          if (file_exists($myfile->getTempName())) {
              Yii::log("Exist file with tempname: ".$myfile->getTempName(), "warning");
                  $fileNewName=$fileNewName.".".$myfile->getExtensionName();
          Yii::log("Saving file with tempname: ".$myfile->getTempName(), "warning");
          $myfile->saveAs($uploadDir.$fileNewName);
                  Yii::log("Cropping: ".$myfile->getTempName(), "warning");
                  //Create and save a small croped image
                  /*$image = Yii::app()->image->load($uploadDir.$fileNewName);
                  $aspect=$image->width/$image->height;
                  if($aspect>1)
                          $image->resize(75, 75, Image::HEIGHT)->crop(75,75,'center','center');
                  else
                          $image->resize(75, 75, Image::WIDTH)->crop(75,75,'center','center');
          
          Yii::log("Save low image: ".$myfile->getTempName(), "warning");
                  $image->save($uploadDir."low_".$fileNewName);
          Yii::log("Return name file: ".$fileNewName, "warning");
           */
          return $fileNewName;
      }else{
        return "";
      }
    }
    return "";
    
  }

  /**
   * Creates a new model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   */
  public function actionCreate()
  {
    $model=new Product;
    
    $user=User::model()->findByPk(Yii::app()->user->id);
    $model->Company_idCompany=$user->Company_idCompany;
    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if(isset($_POST['Product']))
    {
      $model->attributes=$_POST['Product'];
      
      $model->image=$this->uploadFile($model, 'image');
            
      if($model->save())
        $this->redirect(array('view','id'=>$model->idProduct));
    }

    $this->render('create',array(
      'model'=>$model,
    ));
  }

  /*
   * Updates a particular model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id the ID of the model to be updated
   */
  public function actionUpdate($id)
  {
    $model=$this->loadModel($id);

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if(isset($_POST['Product']))
    {
      $oldImage=$model->image;
      
      $model->attributes=$_POST['Product'];
      
      $newFileName=$this->uploadFile($model, 'image');
      if($newFileName!=""){
        $model->image=$newFileName;
      }else{
        $model->image=$oldImage;
          }
      
      
      if($model->save())
        $this->redirect(array('view','id'=>$model->idProduct));
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
    $dataProvider=new CActiveDataProvider('Product');
    $this->render('index',array(
      'dataProvider'=>$dataProvider,
    ));
  }

  /**
   * Manages all models.
   */
  public function actionAdmin()
  {
    $model=new Product('search');
    $model->unsetAttributes();  // clear any default values
    if(isset($_GET['Product']))
      $model->attributes=$_GET['Product'];
    
    $user=User::model()->findByPk(Yii::app()->user->id);
    $model->Company_idCompany=$user->Company_idCompany;

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
    $model=Product::model()->findByPk($id);
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
    if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
    {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}
