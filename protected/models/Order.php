<?php

/**
 * This is the model class for table "Order".
 *
 * The followings are the available columns in table 'Order':
 * @property integer $idOrder
 * @property integer $User_idUser
 * @property integer $Company_idCompany
 * @property string $date
 * @property integer $status
 * @property integer $employee
 *
 * The followings are the available model relations:
 * @property Company $companyIdCompany
 * @property User $userIdUser
 * @property Product[] $products
 */
class Order extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Order the static model class
	 */
	 const NOT_STARTED  =0;
	 const IN_PROGRESS  =1;
	 const DELIVERY_TO_PACKAGING =2;
         const COMPLETED    =3;
         
         /**
          *
          * @var integer Order id
          * @soap
          */
         public $idOrder;
         
         /**
          *
          * @var date Order date
          * @soap
          */
         public $date;
         
         /**
          *
          * @var int Order status 0-Not started 1- In progress 2- Completed
          * @soap
          */
         public $status;
         
         /**
          *
          * @var int id Employee that is picking order
          * @soap
          */
         public $employee;
         
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('User_idUser, Company_idCompany, date', 'required'),
			array('User_idUser, Company_idCompany, employee, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idOrder, User_idUser, Company_idCompany, date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'companyIdCompany' => array(self::BELONGS_TO, 'Company', 'Company_idCompany'),
			'userIdUser' => array(self::BELONGS_TO, 'User', 'User_idUser'),
			'products' => array(self::MANY_MANY, 'Product', 'Order_has_Product(Order_idOrder, Product_idProduct)'),
			'productsQty' => array(self::HAS_MANY, 'OrderHasProduct', 'Order_idOrder'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idOrder' => 'Id Order',
			'User_idUser' => 'Customer',
			'Company_idCompany' => 'Company Id Company',
			'date' => 'Date (YYYY-MM-DD)',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idOrder',$this->idOrder);
		$criteria->compare('User_idUser',$this->User_idUser);
		$criteria->compare('Company_idCompany',$this->Company_idCompany);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeFind()
	{
		if(!Yii::app()->user->isGuest){
			$user=User::model()->findByPk(Yii::app()->user->id);
	        $this->getDbCriteria()->mergeWith(array(
	                'condition'=>"Company_idCompany=".$user->Company_idCompany,
	        ));
	    }
		return parent::beforeFind();
	}

}
