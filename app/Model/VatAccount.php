<?php
// Represents the accounts linked to a company

class VatAccount extends AppModel {
	public $name = 'VatAccount';

	public $belongsTo = array('Account');



	// Used to activate the internationalization of the validation messages below
	public $validationDomain = 'validation';

	// Enforce the required validations rule when you create a new user
	public $validate = array(		
		'code' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to provide a code.'
			),
			'decimal' => array(
				'rule' => array('alphaNumeric'),
				'message' => 'You need to provide a valid code.',
			),
		),
		'name' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to provide a name.'
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

		'due' => array(
			'bool' => array(
				'rule' => array('boolean'),
				'message' => 'Need to be yes or no',
			),
		),

		'selected' => array(
			'bool' => array(
				'rule' => array('boolean'),
				'message' => 'Need to be yes or no',
			),
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
		(strtotime($value[$field]) - strtotime($this->data['VatAccount']['valid_from']) > 0);
	}

	public function percent($value, $field) {
		return ($value[$field] >= 0 && $value[$field] <= 100);
	}

	public function afterFind($results, $primary = false) {
		$language = Configure::read('Config.language');
		$lang_array = array('fra' => 'fr', 'eng' => 'en', 'deu' => 'de');
	    foreach ($results as $key => $val) {
	    	if (isset($val['VatAccount']['name'])) {
		    	if ($val['VatAccount']['name'] == $val['VatAccount']['name_en'] ||
		    		$val['VatAccount']['name'] == $val['VatAccount']['name_de'] ||
		    		$val['VatAccount']['name'] == $val['VatAccount']['name_fr']) {
		    		$results[$key]['VatAccount']['name'] = $val['VatAccount']['name_'.$lang_array[$language]];
		    	}
	    	}
	    }
	    return $results;
	}
}