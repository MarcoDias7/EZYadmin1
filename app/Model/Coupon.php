<?php

class Coupon extends AppModel {
	public $name = 'Coupon';

	public $actsAs = array('Containable');
	

/*
	public function beforeSave($options = array()) {

	//By default, the coupon is valid
    //$this->data['Coupon']['active'] = true;

		if($this->data['Coupon']['random']){
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	    	$randomCode = substr( str_shuffle( $chars ), 0, 12 );
	    	//TODO : check if $randomCode is unique

	    	$this->data['Coupon']['code'] = $randomCode;
		}

	    return true;
	
	}
	*/
	
	public function beforeValidate($options = array()) {

		//Generate code
		if ($this->data['Coupon']['rdm']=='true') {
	       $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	    	$randomCode = substr( str_shuffle( $chars ), 0, 12 );
	    	//TODO : check if $randomCode is unique

	    	$this->data['Coupon']['code'] = $randomCode;
	    } else {
	    	$this->validate = array_merge($this->validate, $this->validateCode);
	    }

	    //Set
	    $this->data['Coupon']['remaining'] = $this->data['Coupon']['created'];

	    return true;
	}


	public $validate = array(

		'valid_from' => array(
			'required' => array(
				'required' => false,
				'rule' => array('notEmpty'),
				'message' => 'The valid_until is not ok',
			),
			'date' => array(
				'rule'       => 'date',
				'message' => 'The date is not valid',
			),
        ),

		'valid_until' => array(
			'date' => array(
				'rule'       => 'date',
				'allowEmpty' => true,
				'message' => 'The date is not valid',
			),
			'customDateValidation' => array(
				'rule' => 'customDateValidation',
				'allowEmpty' => true,
				'message' => 'The valid_until not before valid_from.',
			),
		),

		//-1=unlimited, 0=no more coupons
		'created' => array(
			'required' => array(
				'required' => false,
				'rule' => array('notEmpty'),
				'message' => 'The number of coupons is required',
			),
			'comparison' => array(
				'required' => false,
				'rule' => array('comparison', 'greater or equal', -1),
				'message' => 'The number is not valid'
			)
		),

		'type' => array(
			'required' => array(
				'required' => false,
				'rule' => array('notEmpty'),
				'message' => 'The type is required',
			),
			'inList' => array(
		        'rule' => array('inList', array('percent', 'discount')),
		        'message' => 'Type must be percent or sum'
		    )
		),

		'value' => array(
			'required' => array(
				'required' => false,
				'rule' => array('notEmpty'),
				'message' => 'The value is required',
			),
			'positive' => array(
				'required' => false,
				'rule' => array('comparison', 'greater or equal', 0),
				'message' => 'Value must be positive'
			)
		),

		'validity' => array(
			'required' => array(
				'required' => false,
				'rule' => array('notEmpty'),
				'message' => 'The validity is required',
			),
			'inList' => array(
		        'rule' => array('inList', array('all', '1', '2', '3')),
		        'message' => "Validity must be 'all', '1', '2' or'3'"
		    )
		),

		'description' => array(
			'required' => array(
				'required' => false,
				'rule' => array('notEmpty'),
				'message' => 'The description is required',
			)
		),
		
	);

	public $validateCode = array(
      'code' => array(
         'required' => array(
				'required' => false,
				'rule' => array('notEmpty'),
				'message' => 'The code is required',
			),
         'unique' => array(
		        'rule' => 'isUnique',
		        'message' => 'This code already exists',
		    ),
		)
	);

	public function customDateValidation($field) {

	    return ($this->data[$this->alias]['valid_from'] <= $this->data[$this->alias]['valid_until']);
	
	}

	

}