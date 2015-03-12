<?php
App::uses('AuthComponent', 'Controller/Component');

// Represents the users on the website

class User extends AppModel {
	public $name = 'User';

	public $hasMany = array('Company',
		'Permission' => array(
			'dependent' => true
		),
		'Order');

	public $actsAs = array('Containable');
	
	// Used to activate the internationalization of the validation messages below
	public $validationDomain = 'validation';
	
	// Enforce the required validations rule when you create a new user
	public $validate = array(
		'email' => array(
			'required' => array(
				'required' => false,
				'allowEmpty' => false,
				'rule' => array('notEmpty'),
				'message' => 'An email is required.'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'The email address belongs to an existing account.'
			),

			'email' => array(
				'rule' => 'email',
				'message' => 'Please provide a valid email address.'
			)
		),
		
		
		'password' => array(
			'required' => array(
				'required' => false,
				'rule' => array('minLength', 6),
				'message' => 'The password has to be at least 6 characters long.',
			),
			'notonly' => array(
				'rule' => array('notonly', 'password'),
				'message' => 'The password has to be made of at least 1 number and 1 letter.',
			),
		),

		'confirm_password' => array(
			'required' => array(
				'rule' => array('samePassword', 'confirm_password'),
				'message' => 'The passwords are different.',
			),
		),


		'first_name' => array(
			'required' => array(
				'required' => true,
				'rule' => array('notEmpty'),
				'message' => 'This field is required.'
			)
		),
		
		'last_name' => array(
			'required' => array(
				'required' => true,
				'rule' => array('notEmpty'),
				'message' => 'This field is required.'
			)
		),
		
		/*
		'street' => array(
			'required' => array(
				'required' => true,
				'rule' => array('notEmpty'),
				'message' => 'This field is required.'
			)
		),
		*/
		'title' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'This field is required.'
			)
		),

		'country' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'This field is required.'
			)
		)
	);

	public function samePassword($value, $field) {
		return ($value[$field] == $this->data['User']['password']);
	}

	public function notonly($value, $field) {
		return (!preg_match('/^([A-Za-z])+$/', $value[$field]) && !preg_match('/^([0-9])+$/', $value[$field]));
	}
	
	// Hash the password before putting it in the database
	public function beforeSave($options = array()) {
		if (!empty($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}
}


class UserLogin extends User {

}