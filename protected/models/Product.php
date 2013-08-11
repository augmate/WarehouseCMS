<?php

/**
 * This is the model class for table "Product".
 *
 * The followings are the available columns in table 'Product':
 * @property integer $idProduct
 * @property string $name
 * @property double $price
 * @property string $description
 * @property string $image
 * @property integer $Company_idCompany
 * @property string $sku
 * @property float $mapX
 * @property float $mapY
 * @property string $aisle
 * @property string $shelf_unit
 * @property string $shelf
 * @property integer $quantity
 * @property integer $min_quantity_alert
 * 
 * The followings are the available model relations:
 * @property Order[] $orders
 * @property Company $companyIdCompany
 */
class Product extends CActiveRecord
{
    /**
     *
     * @var int Product id
     * @soap
     */
    public $idProduct;
    
    /**
     *
     * @var string Product name
     * @soap
     */
    public $name;
    
    /**
     *
     * @var float price
     * @soap
     */
    public $price;
    
    /**
     *
     * @var string Product Description
     * @soap
     */
    public $description;
    
    /**
     *
     * @var string Product image
     * @soap
     */
    public $image;
    
    /**
     *
     * @var string Product SKU
     * @soap
     */
    public $sku;
    
    /**
     *
     * @var float Product location X in map
     * @soap
     */
    public $mapX;
    
    /**
     *
     * @var float Product location Y in map
     * @soap
     */
    public $mapY;
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Product the static model class
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
		return 'Product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Company_idCompany, sku', 'required'),
			array('Company_idCompany, quantity, min_quantity_alert', 'numerical', 'integerOnly'=>true),
			array('price, mapX, mapY', 'numerical'),
			array('name, image, sku, aisle, shelf_unit, shelf', 'length', 'max'=>255),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idProduct, name, price, description, image, Company_idCompany, sku, mapX, mapY, aisle, shelf_unit, shelf, quantity, min_quantity_alert', 'safe', 'on'=>'search'),
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
			'orders' => array(self::MANY_MANY, 'Order', 'Order_has_Product(Product_idProduct, Order_idOrder)'),
			'companyIdCompany' => array(self::BELONGS_TO, 'Company', 'Company_idCompany'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idProduct' => '#',
			'name' => 'Name',
			'price' => 'Price',
			'description' => 'Description',
			'image' => 'Image',
			'Company_idCompany' => 'Company Id Company',
			'sku' => 'Sku',
                        'mapX' => 'Map X',
			'mapY' => 'Map Y',
			'aisle' => 'Aisle',
			'shelf_unit' => 'Shelf Unit',
			'shelf' => 'Shelf',
                        'quantity' => 'Quantity',
			'min_quantity_alert' => 'Min Quantity Alert',
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

		$criteria->compare('idProduct',$this->idProduct);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('Company_idCompany',$this->Company_idCompany);
		$criteria->compare('sku',$this->sku,true);
                $criteria->compare('mapX',$this->mapX);
		$criteria->compare('mapY',$this->mapY);
		$criteria->compare('aisle',$this->aisle);
		$criteria->compare('shelf_unit',$this->shelf_unit);
		$criteria->compare('shelf',$this->shelf);
                $criteria->compare('quantity',$this->quantity);
		$criteria->compare('min_quantity_alert',$this->min_quantity_alert);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}