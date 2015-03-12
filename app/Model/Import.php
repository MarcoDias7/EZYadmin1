<?php

class Import extends AppModel {
	public $name = 'Import';

	public $hasMany = array(
		'Booking'  => array('dependent' => true)
	);
	public $belongsTo = array('Account');

	// Used to activate the internationalization of the validation messages below
	public $validationDomain = 'validation';

	// Enforce the required validations rule when you create a new import
	public $validate = array(

		'date' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to provide a date.'
			),
			'date' => array(
				'rule' => array('date'),
				'message' => 'This is not a valid date.'
			)
		),

		'account' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to provide a date.'
			),
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
		)

	);

}