<?php
// Represents the users on the website

class Company extends AppModel {
	public $name = 'Company';
	
	public $hasMany = array(
		'Account' => array('dependent' => true), 
		'Booking'  => array('dependent' => true),
		'Permission'  => array('dependent' => true),
		'Notification'  => array('dependent' => true),
		'VatAccount' => array('dependent' => true));

	public $belongsTo = array('User');

	public $actsAs = array('Containable',
	    'Upload.Upload' => array(
	    	'logo' => array(
	    		'maxHeight' => 100,
	    		'maxWidth' => 200,
	    	)
	    )
	);

	public function beforeSave($options = array()) {
		
		//If no blocking date
		if(empty($this->data['Company']['blocking_date']) || $this->data['Company']['blocking_date']=='') {
			$this->data['Company']['blocking_date'] = NULL;
		}

	}

	public $virtualFields = array(
	    'is_expired' => '(Company.expiration_date < NOW())'
	);

	// Used to activate the internationalization of the validation messages below
	public $validationDomain = 'validation';

	// Enforce the required validations rule when you create a new company
	public $validate = array(

	    'logo' => array(
	    	'size' => array(
	        	'rule' => array('isBelowMaxSize'),
	        	'message' => 'File exceeds upload filesize limit.',
	        	'allowEmpty' => true,
	        ),
		    'photo' => array(
		        'rule' => array('isValidExtension', array('jpg', 'jpeg', 'png', 'gif'), false),
		        'message' => 'File does not have a jpg, png, or gif extension'
		    ),
		    'completeupload' => array(
		        'rule' => 'isCompletedUpload',
		        'message' => 'File was not successfully uploaded, please retry.'
		    ),
		    'maxHeight' => array(
		        'rule' => array('isBelowMaxHeight', 100, false),
		        'message' => 'File is above the maximum height.'
		    ),
		    'maxWidth' => array(
		        'rule' => array('isBelowMaxWidth', 200, false),
		        'message' => 'File is above the maximum width.'
		    )
	    ),

		// FIRST STEP
		'name' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to provide a name for your company.'
			)
		),
		
		'number' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to provide a number.'
			)
		),

		'street' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to provide a street.'
			)
		),

		'zip' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to provide a street.'
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'The zip code has to be a number.'
			),
		),


		'city' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to provide a city.'
			)
		),


		'country' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to provide a country.'
			)
		),


		'phone' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to provide a phone number.'
			)
		),
		
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'You need to provide a email address.'
			)
		),

		'type' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to provide a type.'
			)
		),

		// SECOND STEP

		'first_accounting_year' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to provide a starting date.'
			),
			'date' => array(
				'rule' => array('date'),
				'message' => 'This is not a valid date.'
			)
		),

		'closing_date' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to provide a closing date.'
			),
			'date' => array(
				'rule' => array('date'),
				'message' => 'This is not a valid date.'
			)
		),

		'valid_until' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'You need to provide a valid date.',
				'allowEmpty' => true
			),
		),

		'currency' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to provide a base currency.'
			)
		),

		// THIRD STEP

		'vat_registered' => array(
			'required' => array(
				'rule' => array('boolean'),
				'message' => 'Please fill this information.'
			)
		),

		'vat_model' => array(
			'required' => array(
				'rule' => array('boolean'),
				'message' => 'Please fill this information.'
			)
		),


		// SIXTH STEP

		'booking_amount' => array(
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


	);

	public function getChartCompanyType($id = '') {
		$company = $this->findById($id);
		$type = $company['Company']['type'];

		if ($type == 'Sole trader') {
			return 'sole proprietorship';
		} 
		else if ($type == 'General partnership') {
			return 'private company';
		}
		else {
			return 'legal person';
		}
	}

}