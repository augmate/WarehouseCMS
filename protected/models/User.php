<?php

/**
 * This is the model class for table "User".
 *
 * The followings are the available columns in table 'User':
 * @property integer $idUser
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $role
 * @property integer $perms
 * @property string $name
 * @property integer $Company_idCompany
 *
 * The followings are the available model relations:
 * @property Order[] $orders
 * @property Company $companyIdCompany
 */
class User extends CActiveRecord
{
	const ADMIN 		= 1;
	const OWNER 		= 2;
	const EMPLOYEE 		= 4;
	const CUSTOMER 		= 8;
	
	const PERM_ORDER 	= 1;
	const PERM_PRODUCT 	= 2;
	const PERM_EMPLOYEE = 4;
	const PERM_CUSTOMER = 8;
	const PERM_COMPANY 	= 16;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'User';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Company_idCompany', 'required'),
			array('role, perms, Company_idCompany', 'numerical', 'integerOnly'=>true),
			array('username, email, name', 'length', 'max'=>45),
			array('password', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idUser, username, password, email, role, perms, name, Company_idCompany', 'safe', 'on'=>'search'),
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
			'orders' => array(self::HAS_MANY, 'Order', 'User_idUser'),
			'company' => array(self::BELONGS_TO, 'Company', 'Company_idCompany'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idUser' => 'Id User',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'role' => 'Role',
			'perms' => 'Perms',
			'name' => 'Name',
			'Company_idCompany' => 'Company Id Company',
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

		$criteria->compare('idUser',$this->idUser);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		
		$user=User::model()->findByPk(Yii::app()->user->id);
		if(isset($_GET['role']))
			$this->role=$_GET['role'];
		$this->Company_idCompany=$user->Company_idCompany;
		
		$criteria->compare('role',$this->role);
		$criteria->compare('perms',$this->perms);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('Company_idCompany',$this->Company_idCompany);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	
	/**
	 * @return array of users with role
	 * $perms es el total de todos los permisos que existen en total 1023 
	 * es la suma de los permisos individuales definidos en la cabecera
	 */
	public static function usernamesByRole($role, $perms=0){
		//$users = User::model()->findAllByAttributes(array('MyRol'=>$role));
		$users = User::model()->findAll();
		$usernames = array();
		foreach ($users as $user)
		{
			if($user->role & $role){
				if($user->role & User::ADMIN){
					$usernames[] = $user->username;
				}ELSE if($user->role & User::OWNER){
					$usernames[] = $user->username;
				}else{
					//comprobamos que el usuario tenga los permisos que se piden
					if($perms==0)//Si no se ha especificado que permiso le damos permiso
						$usernames[] = $user->username;
					else if($user->perms & $perms)//en caso de definir el permiso lo comprobamos
						$usernames[] = $user->username;
				}
			}
		}
		return $usernames;
	}

	public function checkPerms($perms){
		if($this->checkRole(User::ADMIN))
			return true;
		if($this->perms & $perms)
			return true;
		else
			return false;
	}

	public function checkRole($role){
		if($this->role & $role)
			return true;
		else
			return false;
	}	

	public function addRole($role){
		$this->role=($this->role | $role);
	}
	public function addPerms($perm){
		$this->perms=($this->perms | $perm);
	}
	
	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return md5($password)===$this->password;
	}
	
}