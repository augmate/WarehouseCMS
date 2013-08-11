<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RegistrationForm extends CFormModel
{
	public $userName;
	public $password;
	public $password_repeat;
	public $email;
	public $firstName;
	public $lastName;
	public $phone;
	public $organization;
	public $codOrganization;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('userName, password, email, firstName, lastName, phone, organization, codOrganization', 'required'),
			array('password_repeat', 'required'),
		        array('password', 'compare', 'compareAttribute'=>'password_repeat'),
			array('email','email'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
		);
	}

}
