<?php
// Represents the accounts linked to a company

class Account extends AppModel {
	public $name = 'Account';

	public $belongsTo = array('AccountCategory', 'Company');

	public $actsAs = array('Containable');

	public $hasMany = array(
		'DebitBooking' => array(
            'className' => 'Booking',
            'foreignKey' => 'debit_account_id',
            'conditions' => array('DebitBooking.state' => 'booked')
        ),
        'CreditBooking' => array(
            'className' => 'Booking',
            'foreignKey' => 'credit_account_id',
            'conditions' => array('CreditBooking.state' => 'booked')
        ));

		// Used to activate the internationalization of the validation messages below
	public $validationDomain = 'validation';

	// Enforce the required validations rule when you create a new user
	public $validate = array(
		'number' => array(
			'unique_for_company' => array(
				'rule' => array('uniqueForCompany', 'number'),
				'message' => 'This number is already used.',
			),
			'range_of_category' => array(
				'rule' => array('rangeOfCategory', 'number'),
				'message' => 'This number is out of range.',
			),
		    '2999' => array(
		        'rule'    => array('comparison', '!=', 2999),
		        'message' => 'This account number is for internal use only.'
		    )
		),

		// 'VAT_paid' => array(
		// 	'only_one' => array(
		// 		'rule' => array('onlyOne', 'VAT_paid'),
		// 		'message' => 'You already have a VAT paid account.',
		// 	),
		// ),

		// 'VAT_owed' => array(
		// 	'only_one' => array(
		// 		'rule' => array('onlyOne', 'VAT_owed'),
		// 		'message' => 'You already have a VAT owed account.',
		// 	),
		// ),

		'title' => array(
			'rule' => array('notEmpty'),
			'message' => 'a name is required'
		),
	);

	public function onlyOne($value, $field) {
		if (!$value[$field]) {
			return true;
		}

		$count = $this->find('count', array(
		      'conditions' => array(
		          'Account.'.$field => 1,
		          'Account.company_id' => $this->data[$this->alias]['company_id'],
		          'Account.id <>' => (isset($this->data[$this->alias]['id'])) ? $this->data[$this->alias]['id'] : 0
		   )));
		return $count == 0;
	}

	public function uniqueForCompany($value) {
		$count = $this->find('count', array(
		      'conditions' => array(
		          'Account.number' => $value,
		          'Account.company_id' => $this->data[$this->alias]['company_id'],
		          'Account.id <>' => (isset($this->data[$this->alias]['id'])) ? $this->data[$this->alias]['id'] : 0
		   )));
		return $count == 0;
	}

	public function rangeOfCategory($value, $field) {
		$data = $this->AccountCategory->findById($this->data[$this->alias]['account_category_id']);
		if (empty($data)) {
			return false;
		}
		else {
			return (($data['AccountCategory']['range_bottom'] <= $value[$field]) &&
				($data['AccountCategory']['range_up'] >= $value[$field]));
		}
	}


	public function afterFind($results, $primary = false) {
		$language = Configure::read('Config.language');
		$lang_array = array('fra' => 'fr', 'eng' => 'en', 'deu' => 'de');
	    foreach ($results as $key => $val) {
	    	$item = '';
	    	if (isset($val['Account']['title'])) {
	    		$item = 'Account';
	    	}
	    	else if (isset($val['DebitAccount']['title'])) {
	    		$item = 'DebitAccount';
	    	}
	    	else if (isset($val['CreditAccount']['title'])) {
	    		$item = 'CreditAccount';
	    	}

	    	if (!empty($item) && isset($val[$item]['title'])) {
		    	if ($val[$item]['title'] == $val[$item]['title_en'] ||
		    		$val[$item]['title'] == $val[$item]['title_de'] ||
		    		$val[$item]['title'] == $val[$item]['title_fr']) {
		    		$results[$key][$item]['title'] = $val[$item]['title_'.$lang_array[$language]];
		    	}
	    	}
	    }
	    return $results;
	}
}