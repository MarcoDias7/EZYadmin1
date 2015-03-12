<?php
// Represents the currencies 

class Currency extends AppModel {
	public $name = 'Currency';

	//public $actsAs = array('Containable');

	public function beforeValidate($options = array()) {
		
		//Replace ',' with '.'
		$this->data['Currency']['rate'] = strtr($this->data['Currency']['rate'], array (',' => '.'));

		if($this->data['Currency']['valid_until']=='') {
			$this->data['Currency']['valid_until'] = NULL;
		}

	}

	// Used to activate the internationalization of the validation messages below
	public $validationDomain = 'validation';

	// Enforce the required validations rule when you create a new currency
	public $validate = array(
		'name' => array(
			'required' => array(
				'required' => true,
				'rule' => array('notEmpty'),
				//Length
				'message' => 'This field is required.'
			)
		),

		'rate' => array(
			'decimal' => array(
				'required' => true,
				'allowEmpty' => false,
				'rule' => array('decimal'),
				'message' => 'The amount need to be a valid decimal number'
			),
			'betweenRule' => array(
				'rule' => array('percent', 'rate'),
				'message' => 'The rate need to be between 0 and 100%.'
			)
		),
		'valid_from' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to provide a valid starting date.'
			),
			'date' => array(
				'rule' => array('date'),
				'message' => 'You need to provide a valid date.',
			),
		),

		'valid_until' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'You need to provide a valid date.',
				'allowEmpty' => true
			),
			'notBefore' => array(
				'rule' => array('notBefore', 'valid_until'),
				'message' => 'The ending date needs to be after the starting date'
			)
		),
	);


	public function notBefore($value, $field) {
		return empty($value[$field]) ||
		(strtotime($value[$field])-strtotime($this->data['Currency']['valid_from']) >= 0);
	}

	public function percent($value, $field) {
		return ($value[$field] >= 0 && $value[$field] <= 100);
	}
	
}




