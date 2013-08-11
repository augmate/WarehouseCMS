<?php

/**
 * This is the model class for table "Order_has_Product".
 *
 * The followings are the available columns in table 'Order_has_Product':
 * @property integer $Order_idOrder
 * @property integer $Product_idProduct
 * @property integer $Quantity
 * @property integer $Picked
 */
class OrderHasProduct extends CActiveRecord
{
    /**
     *
     * @var int Order id
     * @soap
     */
    public $Order_idOrder;
    /**
     *
     * @var int product id
     * @soap
     */
    public $Product_idProduct;
    /**
     *
     * @var int Quantity
     * @soap
     */
    public $Quantity;
    /**
     *
     * @var int picked product
     * @soap
     */
    public $Picked;
    
    public $name;
    public $idProduct;
    public $price;
    public $description;
    public $image;
    public $mapX;
    public $mapY;
    public $aisle;
    public $shelf_unit;
    public $shelf;
    public $quantity;
    public $min_quantity_alert;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OrderHasProduct the static model class
	 */
	 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Order_has_Product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Order_idOrder, Product_idProduct', 'required'),
			array('Order_idOrder, Product_idProduct, Quantity, Picked', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Order_idOrder, Product_idProduct, Quantity', 'safe', 'on'=>'search'),
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
			'product' => array(self::BELONGS_TO, 'Product', 'Product_idProduct'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Order_idOrder' => 'Order Id Order',
			'Product_idProduct' => 'Product Id Product',
			'Quantity' => 'Quantity',
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

		$criteria->compare('Order_idOrder',$this->Order_idOrder);
		$criteria->compare('Product_idProduct',$this->Product_idProduct);
		$criteria->compare('Quantity',$this->Quantity);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function afterFind()
	{
		//if(!Yii::app()->user->isGuest){
			$this->name=$this->product->name;
			$this->sku=$this->product->sku;
                        $this->price=$this->product->price;
                        $this->description=$this->product->description;
			$this->image=$this->product->image;
                        $this->mapX=$this->product->mapX;
			$this->mapY=$this->product->mapY;
			$this->aisle=$this->product->aisle;
			$this->shelf_unit=$this->product->shelf_unit;
			$this->shelf=$this->product->shelf;
                        $this->quantity=$this->product->quantity;
			$this->min_quantity_alert=$this->product->min_quantity_alert;
                //}
		return parent::beforeFind();
	}
	
}