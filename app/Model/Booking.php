<?php
// Represents the bookings linked to a company

class Booking extends AppModel {
	public $name = 'Booking';

	public $actsAs = array('Containable');

	var $uses = array('Company');

	/* A booking is related to one debit account and one credit account */
	public $belongsTo = array('Company',

		'DebitAccount' => array(
			'className' => 'Account',
			'foreign_key' => 'debit_account_id'),

		'CreditAccount' => array(
			'className' => 'Account',
			'foreign_key' => 'credit_account_id'),

		'VatAccount'
		);

	public $hasOne = array(
		'VatBooking' => array(
			'className' => 'Booking',
			'foreignKey' => 'vat_booking_id'),
	);

	public function beforeValidate($options = array()) {
		
		//Replace ',' with '.'
		$this->data['Booking']['amount'] = strtr($this->data['Booking']['amount'], array (',' => '.'));

		return true;

	}

	public function beforeSave($options = array()) {
		
		//if multibooking
		if(isset($this->data['Booking']['source']) && $this->data['Booking']['source']=='multi'){

			//Find if there is a linked booking
			$bkMain = $this->find('first', array(
			'conditions' => array(
				'Booking.company_id' => $this->data['Booking']['company_id'],
				'Booking.custom_id' => $this->data['Booking']['custom_id'],
				'Booking.multi_id' => $this->data['Booking']['multi_id'],
				'Booking.user_id' => $this->data['Booking']['user_id']
			)
			));

			//If linked booking, set the id (vat)
			if(isset($bkMain) && $bkMain != null){
				$this->data['Booking']['vat_booking_id'] = $bkMain['Booking']['id'];
			}

		}

		if(isset($this->data['Booking']['vat_net']) && ($this->data['Booking']['vat_net']=='false' || $this->data['Booking']['vat_net']==0)){
			$this->data['Booking']['vat_net'] = false ;
		};
		if(isset($this->data['Booking']['vat_net']) && ($this->data['Booking']['vat_net']=='true' || $this->data['Booking']['vat_net']==1)){
			$this->data['Booking']['vat_net'] = true ;
		};

		return true;
	}	

	// Used to activate the internationalization of the validation messages below
	public $validationDomain = 'validation';

	// Enforce the required validations rule when you create a new user
	public $validate = array(
		'date' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'You need to provide a valid date.',
				'required' => false,
				'allowEmpty' => true,
			),
			'greaterThanBlockingDate' => array(
				'rule' => array('greaterThanBlockingDate', 'date'),
				'message' => 'The booking should not be earlier than the blocking date.'
			),
		),

		'custom_id' => array(
			'required' => array(
				'required' => true,
				'rule' => array('notEmpty'),
				'message' => 'You need to provide an id.'
			)
		),

		'debit_account_id' => array(
			'belongs_to_company' => array(
				'rule' => array('belongsToCompany', 'debit_account_id'),
				'message' => 'You need to select an account.'
			)
		),

		'credit_account_id' => array(
			'belongs_to_company' => array(
				'rule' => array('belongsToCompany', 'credit_account_id'),
				'message' => 'You need to select an account.'
			)
		),

		'amount' => array(
			 'required' => array(
			 	'rule' => array('notEmpty'),
			 	'message' => 'You need to provide an amount.'
			 ),
			'decimal' => array(
				'required' => false,
				'allowEmpty' => true,
				'rule' => array('decimal'),
				'message' => 'The amount need to be a valid decimal number'
			),
			'greaterThanZero' => array(
				'rule' => array('greaterThanZero', 'amount'),
				'message' => 'The amount need to be greater than 0.'
			),
			'rounding' => array(
				'rule' => array('rounding', 'amount'),
				'message' => 'The amount need to be rounded at 0.00 or 0.05.'
			),
		)

		// TODO:
		// ADD VAT
	);

	public function greaterThanZero($value, $field) {
		return $value[$field] > 0 || isset($this->data['Booking']['vat_booking_id']);
	}

	public function greaterThanBlockingDate($value, $field) {

		$comp = $this->Company->findById($this->data['Booking']['company_id']);
		$blocking_date = $comp['Company']['blocking_date'];

		//Blocking date
		if($blocking_date=="00-00-0000") {
			return true;	
		}
		else {
			if(strtotime($this->data['Booking']['date']) < strtotime($blocking_date)) {
				return false;
			}
			else {
				return true;
			}
		}
	}


	public function rounding($value, $field) {

		$this->Company->contain();

		$comp = $this->Company->findById($this->data['Booking']['company_id']);

		$dotPos = strpos($value[$field], '.');

		if ($dotPos > 0 && (strlen($value[$field]) - $dotPos) > 2) {
			$val = substr($value[$field], -1, 1);
		}
		else {
			return true;
		}
		return (($comp['Company']['rounding_option'] == '0.05' && ($val == '0' || $val == '5')) || ($comp['Company']['rounding_option'] == '0.01'));
	}

    public function belongsToCompany($id, $field) {
    	$exist = $this->DebitAccount->find('count', array(
    		'conditions' => array(
    			'DebitAccount.company_id' => $this->data['Booking']['company_id'],
    			'DebitAccount.id' => $id[$field]
    		),
    		'recursive' => -1
    	));
    	return ($exist == 1);
    }

    public function belongsToCompanyOrNull($id, $field) {
    	$exist = $this->DebitAccount->find('count', array(
    		'conditions' => array(
    			'DebitAccount.company_id' => $this->data['Booking']['company_id'],
    			'DebitAccount.id' => $id[$field]
    		),
    		'recursive' => -1
    	));
    	return ($exist == 1 || $id[$field] == NULL);
    }

    public function atLeastOneAccount($id, $field) {
    	return ($this->data['Booking']['debit_account_id'] != NULL || $this->data['Booking']['credit_account_id'] != NULL);
    }

}
