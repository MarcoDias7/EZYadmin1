<?php

class VatReport extends AppModel {
	public $name = 'VatReport';

	public $actsAs = array('Containable');

	public $belongsTo = array('Company', 'User');


	public $hasAndBelongsToMany = array('Booking');

	// Used to activate the internationalization of the validation messages below
	public $validationDomain = 'validation';

	// Enforce the required validations rule when you create a new user
	public $validate = array(		
		'from_date' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'You need to provide a valid date.'
			),
		),
		'end_date' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'You need to provide a valid date.'
			),
			'notBefore' => array(
				'rule' => array('notBefore', 'end_date'),
				'message' => 'The ending validity date need to be after the starting date'
			)
		),
		// 'description' => array(
		// 	'required' => array(
		// 		'rule' => array('notEmpty'),
		// 		'message' => 'You need to provide a description.'
		// 	)
		// ),


	);

	public function notBefore($value, $field) {
		return empty($value[$field]) ||
		(strtotime($value[$field]) - strtotime($this->data['VatReport']['from_date']) > 0);
	}
}