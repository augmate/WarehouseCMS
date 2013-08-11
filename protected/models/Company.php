<?php

/**
 * This is the model class for table "Company".
 *
 * The followings are the available columns in table 'Company':
 * @property integer $idCompany
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $state
 * @property string $country
 * @property string $logotype
 * @property string $map;
 * 
 * The followings are the available model relations:
 * @property Order[] $orders
 * @property Product[] $products
 * @property User[] $users
 */
class Company extends CActiveRecord
{
    /**
     *
     * @var integer Company id
     * @soap
     */
    public $idCompany;
    
    /**
     *
     * @var string Company name
     * @soap
     */
    public $name;
    
    /**
     *
     * @var string Company Address
     * @soap
     */
    public $address;
    
    /**
     *
     * @var string Company phone
     * @soap
     */
    public $phone;
    
    /**
     *
     * @var string Company state
     * @soap
     */
    public $state;
    
    /**
     *
     * @var string Company country
     * @soap
     */
    public $country;
    
    /**
     *
     * @var string Company brand
     * @soap
     */
    public $logotype;
    
    /**
     *
     * @var string Company floor plan image
     * @soap
     */
    public $map;
    
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Company the static model class
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
		return 'Company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, address, state, country, logotype, map', 'length', 'max'=>255),
			array('phone', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idCompany, name, address, phone, state, country, logotype', 'safe', 'on'=>'search'),
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
			'orders' => array(self::HAS_MANY, 'Order', 'Company_idCompany'),
			'products' => array(self::HAS_MANY, 'Product', 'Company_idCompany'),
			'users' => array(self::HAS_MANY, 'User', 'Company_idCompany'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idCompany' => 'Id Company',
			'name' => 'Name',
			'address' => 'Address',
			'phone' => 'Phone',
			'state' => 'State',
			'country' => 'Country',
			'logotype' => 'Logotype',
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

		$criteria->compare('idCompany',$this->idCompany);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('logotype',$this->logotype,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}